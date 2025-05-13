<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use App\Models\Mahasiswa;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessFaceComparison implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels, Dispatchable;

    protected $inputToken;

    // Konstruktor untuk menerima input token wajah
    public function __construct($inputToken)
    {
        $this->inputToken = $inputToken;
    }

    public function handle()
    {
        // Ambil data mahasiswa yang memiliki face_token
        $users = Mahasiswa::whereNotNull('face_token')->get();
        $results = [];

        // Proses perbandingan wajah untuk setiap mahasiswa
        foreach ($users as $user) {
            $comparisonResult = $this->compareFaces($user, $this->inputToken);
            $results[] = [
                'mahasiswa' => $user->mhs_name,
                'similarity' => $comparisonResult['similarity'],
                'status' => $comparisonResult['status'],
                'user_id' => $user->id,
            ];
        }

        // Log hasil perbandingan wajah atau simpan di tempat lain, misalnya session
        Log::info('Hasil perbandingan wajah:', $results);
    }

    // Fungsi untuk membandingkan wajah
    private function compareFaces($user, $inputToken)
    {
        $client = new Client();
        $res = $client->post('https://api-us.faceplusplus.com/facepp/v3/compare', [
            'form_params' => [
                'api_key' => env('FACE_API_KEY'),
                'api_secret' => env('FACE_API_SECRET'),
                'face_token1' => $user->face_token,
                'face_token2' => $inputToken,
            ]
        ]);

        $data = json_decode($res->getBody(), true);
        $similarity = $data['confidence'] ?? 0;

        return [
            'similarity' => $similarity,
            'status' => $similarity >= 80 ? '✅ Cocok' : '❌ Tidak Cocok',
        ];
    }
}
