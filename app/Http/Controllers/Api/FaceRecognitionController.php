<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FaceRecognitionApiController extends Controller
{
    protected $faceApiUrl;
    protected $faceApiKey;

    public function __construct()
    {
        $this->faceApiUrl = rtrim(env('FACE_API_URL'), '/') . '/';
        $this->faceApiKey = env('FACE_API_KEY');
        
        if (empty($this->faceApiKey)) {
            throw new \RuntimeException('FACE_API_KEY is not configured');
        }
    }

    /**
     * @OA\Get(
     *     path="/api/face-recognition/mahasiswa",
     *     tags={"Face Recognition"},
     *     summary="Get list of registered students",
     *     @OA\Response(
     *         response=200,
     *         description="List of students",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Mahasiswa")
     *             )
     *         )
     *     )
     * )
     */
    public function getStudents()
    {
        try {
            $mahasiswas = Mahasiswa::whereNotNull('face_token')
                ->orderBy('mhs_name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $mahasiswas
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to get student list: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve student list'
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/face-recognition/register",
     *     tags={"Face Recognition"},
     *     summary="Register student face",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"mahasiswa_id", "foto"},
     *                 @OA\Property(
     *                     property="mahasiswa_id",
     *                     type="integer",
     *                     description="Student ID"
     *                 ),
     *                 @OA\Property(
     *                     property="foto",
     *                     type="string",
     *                     format="binary",
     *                     description="Face image file"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Face registered successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Face registered successfully"),
     *             @OA\Property(property="face_token", type="string", example="abc123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error or invalid request"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $mhs = Mahasiswa::findOrFail($request->mahasiswa_id);
            
            $fileStream = fopen($request->file('foto')->getRealPath(), 'r');
            
            try {
                $client = new Client([
                    'timeout' => 15,
                    'connect_timeout' => 10,
                ]);

                $response = $client->post($this->faceApiUrl . 'api/register', [
                    'headers' => [
                        'x-api-key' => $this->faceApiKey
                    ],
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => $fileStream,
                            'filename' => $request->file('foto')->getClientOriginalName(),
                        ],
                    ],
                ]);

                $data = json_decode($response->getBody(), true);
                
                if (empty($data['face_token'])) {
                    throw new \Exception('Invalid response from face recognition API');
                }

                $mhs->face_token = $data['face_token'];
                $mhs->save();

                return response()->json([
                    'success' => true,
                    'message' => "Face registered for {$mhs->mhs_name}",
                    'face_token' => $data['face_token']
                ]);
            } finally {
                if (is_resource($fileStream)) {
                    fclose($fileStream);
                }
            }
        } catch (\Exception $e) {
            Log::error('Face registration failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to register face: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/face-recognition/verify",
     *     tags={"Face Recognition"},
     *     summary="Verify student face",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"foto"},
     *                 @OA\Property(
     *                     property="foto",
     *                     type="string",
     *                     format="binary",
     *                     description="Face image file to verify"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Face verification result",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="match_found", type="boolean", example=true),
     *             @OA\Property(property="similarity", type="number", format="float", example=0.85),
     *             @OA\Property(property="mahasiswa", ref="#/components/schemas/Mahasiswa"),
     *             @OA\Property(property="jadwal_hari_ini", ref="#/components/schemas/JadwalKuliah")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error or no match found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function cekWajah(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // Process and save image
            $fotoName = 'face_recognition_' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $fotoPath = $this->simpanGambar($request->file('foto'), $fotoName);

            // Get all registered students
            $mahasiswas = Mahasiswa::whereNotNull('face_token')->with('kelas.pstudi')->get();

            $bestMatch = null;
            $highestSimilarity = 0.5; // Minimum threshold

            foreach ($mahasiswas as $mhs) {
                $verificationResult = $this->verifyFaceWithApi(
                    $request->file('foto')->getRealPath(),
                    $mhs->face_token,
                    $request->file('foto')->getClientOriginalName()
                );

                if ($verificationResult['matched'] && $verificationResult['similarity'] > $highestSimilarity) {
                    $highestSimilarity = $verificationResult['similarity'];
                    $bestMatch = $mhs;
                }
            }

            if (!$bestMatch) {
                return response()->json([
                    'success' => false,
                    'message' => 'No matching student found (similarity > 0.5 required)'
                ], 400);
            }

            // Check today's schedule
            $jadwalHariIni = $this->getJadwalHariIni($bestMatch->id);

            return response()->json([
                'success' => true,
                'match_found' => true,
                'similarity' => $highestSimilarity,
                'mahasiswa' => $bestMatch,
                'jadwal_hari_ini' => $jadwalHariIni,
                'image_path' => $fotoPath
            ]);
        } catch (\Exception $e) {
            Log::error('Face verification failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to verify face: ' . $e->getMessage()
            ], 500);
        }
    }

    // Helper methods (same as original controller)
    protected function simpanGambar($file, $filename)
    {
        $destinationPath = storage_path('app/public/images/presensi');
        
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file->getRealPath());
        $image->scaleDown(height: 300);
        $image->save($destinationPath . '/' . $filename);

        return 'presensi/' . $filename;
    }

    protected function verifyFaceWithApi($imagePath, $faceToken, $originalFilename)
    {
        $fileStream = fopen($imagePath, 'r');
        
        try {
            $client = new Client([
                'timeout' => 15,
                'connect_timeout' => 10,
            ]);

            $response = $client->post($this->faceApiUrl . 'api/verify', [
                'headers' => [
                    'x-api-key' => $this->faceApiKey
                ],
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => $fileStream,
                        'filename' => $originalFilename,
                    ],
                    [
                        'name' => 'face_token',
                        'contents' => $faceToken
                    ]
                ],
            ]);

            return json_decode($response->getBody(), true);
        } finally {
            if (is_resource($fileStream)) {
                fclose($fileStream);
            }
        }
    }

    protected function getJadwalHariIni($mahasiswaId)
    {
        $now = Carbon::now();
        $mahasiswa = Mahasiswa::with('kelas')->find($mahasiswaId);

        if (!$mahasiswa || $mahasiswa->kelas->isEmpty()) {
            return null;
        }

        return JadwalKuliah::where('kelas_id', $mahasiswa->kelas->first()->id)
            ->where('days_id', $now->dayOfWeekIso)
            ->where('start', '<=', $now->format('H:i:s'))
            ->where('ended', '>=', $now->format('H:i:s'))
            ->first();
    }
}