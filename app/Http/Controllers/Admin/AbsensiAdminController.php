<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Helpers\RoleTrait;
use App\Models\MataKuliah;
use App\Models\AbsensiDosen;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\AbsensiMahasiswa;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiAdminController extends Controller
{
    /**
     * Menampilkan halaman absensi dosen dengan filter
     */

    use RoleTrait;

    public function indexDosen(Request $request)
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['tahun_akademik'] = TahunAkademik::orderBy('year_start', 'desc')->get();
        $data['dosen'] = Dosen::orderBy('dsn_name', 'asc')->get();
        $data['matakuliah'] = MataKuliah::orderBy('name', 'asc')->get();
        
        $query = AbsensiDosen::with(['dosen', 'jadkul.matkul']);
        
        // Filter berdasarkan dosen
        if ($request->has('dosen_id') && $request->dosen_id != '') {
            $query->where('dosen_id', $request->dosen_id);
        }
        
        // Filter berdasarkan tanggal
        if ($request->has('tanggal_mulai') && $request->tanggal_mulai != '') {
            $query->where('absen_date', '>=', $request->tanggal_mulai);
        }
        
        if ($request->has('tanggal_akhir') && $request->tanggal_akhir != '') {
            $query->where('absen_date', '<=', $request->tanggal_akhir);
        }
        
        // Filter berdasarkan status absensi
        if ($request->has('status') && $request->status != '') {
            $query->where('absen_type', $request->status);
        }
        
        // Filter berdasarkan mata kuliah
        if ($request->has('matkul') && $request->matkul != '') {
            $jadkuls = JadwalKuliah::where('makul_id', $request->matkul)->pluck('id');
            $query->whereIn('jadkul_id', $jadkuls);
        }
        
        $data['absensi'] = $query->orderBy('absen_date', 'desc')->paginate(15);
        
        return view('user.admin.pages.absen.dosen-index', $data);
    }
    
    /**
     * Menampilkan halaman absensi mahasiswa dengan filter
     */
    public function indexMahasiswa(Request $request)
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['tahun_akademik'] = TahunAkademik::orderBy('year_start', 'desc')->get();
        $data['mahasiswa'] = Mahasiswa::orderBy('mhs_name', 'asc')->get();
        $data['matakuliah'] = MataKuliah::orderBy('name', 'asc')->get();
        
        $query = AbsensiMahasiswa::with(['mahasiswa', 'jadkul.matkul']);
        
        // Filter berdasarkan mahasiswa
        if ($request->has('mahasiswa_id') && $request->mahasiswa_id != '') {
            $query->where('author_id', $request->mahasiswa_id);
        }
        
        // Filter berdasarkan tanggal
        if ($request->has('tanggal_mulai') && $request->tanggal_mulai != '') {
            $query->where('absen_date', '>=', $request->tanggal_mulai);
        }
        
        if ($request->has('tanggal_akhir') && $request->tanggal_akhir != '') {
            $query->where('absen_date', '<=', $request->tanggal_akhir);
        }
        
        // Filter berdasarkan status absensi
        if ($request->has('status') && $request->status != '') {
            $query->where('absen_type', $request->status);
        }
        
        // Filter berdasarkan mata kuliah
        if ($request->has('matkul') && $request->matkul != '') {
            $jadkuls = JadwalKuliah::where('makul_id', $request->matkul)->pluck('id');
            $query->whereIn('jadkul_id', $jadkuls);
        }
        
        $data['absensi'] = $query->orderBy('absen_date', 'desc')->paginate(15);
        
        return view('user.admin.pages.absen.mahasiswa-index', $data);
    }
    
    /**
     * Menampilkan detail absensi dosen
     */
    public function showDosen($id)
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['absensi'] = AbsensiDosen::with(['dosen', 'jadkul.matkul'])->findOrFail($id);
        
        return view('user.admin.pages.absen.dosen-show', $data);
    }
    
    /**
     * Menampilkan detail absensi mahasiswa
     */
    public function showMahasiswa($id)
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();
        $data['absensi'] = AbsensiMahasiswa::with(['mahasiswa', 'jadkul.matkul'])->findOrFail($id);
        
        return view('user.admin.pages.absen.mahasiswa-show', $data);
    }
    
    /**
     * Mengubah status absensi dosen
     */
    public function updateStatusDosen(Request $request, $id)
    {
        $request->validate([
            'absen_type' => 'required|in:H,I,S',
            'absen_desc' => 'nullable|string',
        ]);
        
        $absensi = AbsensiDosen::findOrFail($id);
        $absensi->absen_type = $request->absen_type;
        $absensi->absen_desc = $request->absen_desc;
        $absensi->save();
        
        Alert::success('Berhasil', 'Status absensi dosen berhasil diperbarui');
        return redirect()->route('absen.dosen.show', $id);
    }
    
    /**
     * Mengubah status absensi mahasiswa
     */
    public function updateStatusMahasiswa(Request $request, $id)
    {
        $request->validate([
            'absen_type' => 'required|in:H,I,S,A',
            'absen_desc' => 'nullable|string',
        ]);
        
        $absensi = AbsensiMahasiswa::findOrFail($id);
        $absensi->absen_type = $request->absen_type;
        $absensi->absen_desc = $request->absen_desc;
        $absensi->save();
        
        Alert::success('Berhasil', 'Status absensi mahasiswa berhasil diperbarui');
        return redirect()->route('absen.mahasiswa.show', $id);
    }
    
    /**
     * Menghapus absensi dosen
     */
    public function destroyDosen($id)
    {
        $absensi = AbsensiDosen::findOrFail($id);
        $absensi->delete();
        
        Alert::success('Berhasil', 'Data absensi dosen berhasil dihapus');
        return redirect()->route('absen.dosen.index');
    }
    
    /**
     * Menghapus absensi mahasiswa
     */
    public function destroyMahasiswa($id)
    {
        $absensi = AbsensiMahasiswa::findOrFail($id);
        $absensi->delete();
        
        Alert::success('Berhasil', 'Data absensi mahasiswa berhasil dihapus');
        return redirect()->route('absen.mahasiswa.index');
    }
}