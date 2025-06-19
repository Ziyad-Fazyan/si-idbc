<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RoleTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use RealRashid\SweetAlert\Facades\Alert;

class TrashController extends Controller
{
    use RoleTrait;

    /**
     * Menampilkan daftar model yang mendukung soft delete
     */
    public function index()
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();

        // Daftar model yang menggunakan SoftDeletes
        $data['models'] = [
            'AbsensiDosen' => 'Absensi Dosen',
            'AbsensiMahasiswa' => 'Absensi Mahasiswa',
            'Balance' => 'Balance',
            'Commodity' => 'Commodity',
            'CommodityAcquisition' => 'Commodity Acquisition',
            'CommodityLocation' => 'Commodity Location',
            'DocsResource' => 'Docs Resource',
            'Dosen' => 'Dosen',
            'Fakultas' => 'Fakultas',
            'GalleryAlbum' => 'Gallery Album',
            'Gedung' => 'Gedung',
            'HasilStudi' => 'Hasil Studi',
            'HistoryTagihan' => 'History Tagihan',
            'JadwalKuliah' => 'Jadwal Kuliah',
            'Kelas' => 'Kelas',
            'KotakSaran' => 'Kotak Saran',
            'Kurikulum' => 'Kurikulum',
            'Mahasiswa' => 'Mahasiswa',
            'MahasiswaDetails' => 'Mahasiswa Details',
            'MataKuliah' => 'Mata Kuliah',
            'MessageSupport' => 'Message Support',
            'Mutabaah' => 'Mutabaah',
            'MutabaahField' => 'Mutabaah Field',
            'NewsCategory' => 'News Category',
            'NewsPost' => 'News Post',
            'Notification' => 'Notification',
            'ProgramKuliah' => 'Program Kuliah',
            'ProgramStudi' => 'Program Studi',
            'Ruang' => 'Ruang',
            'StudentScore' => 'Student Score',
            'StudentTask' => 'Student Task',
            'TagihanKuliah' => 'Tagihan Kuliah',
            'TahunAkademik' => 'Tahun Akademik',
            'TicketSupport' => 'Ticket Support',
            'UAttendance' => 'U Attendance',
            'User' => 'User',
        ];
        
        return view('user.admin.trash.index', $data);
    }

    /**
     * Menampilkan data yang telah dihapus (soft delete) untuk model tertentu
     */
    public function show($model)
    {
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['prefix'] = $this->setPrefix();

        // Validasi model
        if (!$this->isValidModel($model)) {
            Alert::error('Error', 'Model tidak valid');
            return redirect()->route('web-admin.trash.index');
        }

        $modelClass = "App\\Models\\$model";
        $data['model'] = $model;
        $data['items'] = $modelClass::onlyTrashed()->get();
        $data['modelName'] = $this->getModelDisplayName($model);

        return view('user.admin.trash.show', $data);
    }

    /**
     * Memulihkan data yang telah dihapus (soft delete)
     */
    public function restore($model, $id)
    {
        // Validasi model
        if (!$this->isValidModel($model)) {
            Alert::error('Error', 'Model tidak valid');
            return redirect()->route('web-admin.trash.index');
        }

        $modelClass = "App\\Models\\$model";
        $item = $modelClass::onlyTrashed()->findOrFail($id);
        $item->restore();

        Alert::success('Berhasil', 'Data berhasil dipulihkan');
        return redirect()->route('web-admin.trash.show', $model);
    }

    /**
     * Menghapus data secara permanen
     */
    public function forceDelete($model, $id)
    {
        // Validasi model
        if (!$this->isValidModel($model)) {
            Alert::error('Error', 'Model tidak valid');
            return redirect()->route('web-admin.trash.index');
        }

        $modelClass = "App\\Models\\$model";
        $item = $modelClass::onlyTrashed()->findOrFail($id);
        $item->forceDelete();

        Alert::success('Berhasil', 'Data berhasil dihapus permanen');
        return redirect()->route('web-admin.trash.show', $model);
    }

    /**
     * Memulihkan semua data yang telah dihapus (soft delete) untuk model tertentu
     */
    public function restoreAll($model)
    {
        // Validasi model
        if (!$this->isValidModel($model)) {
            Alert::error('Error', 'Model tidak valid');
            return redirect()->route('web-admin.trash.index');
        }

        $modelClass = "App\\Models\\$model";
        $modelClass::onlyTrashed()->restore();

        Alert::success('Berhasil', 'Semua data berhasil dipulihkan');
        return redirect()->route('web-admin.trash.show', $model);
    }

    /**
     * Menghapus semua data secara permanen untuk model tertentu
     */
    public function emptyTrash($model)
    {
        // Validasi model
        if (!$this->isValidModel($model)) {
            Alert::error('Error', 'Model tidak valid');
            return redirect()->route('web-admin.trash.index');
        }

        $modelClass = "App\\Models\\$model";
        $modelClass::onlyTrashed()->forceDelete();

        Alert::success('Berhasil', 'Semua data berhasil dihapus permanen');
        return redirect()->route('web-admin.trash.show', $model);
    }

    /**
     * Validasi apakah model valid dan menggunakan SoftDeletes
     */
    private function isValidModel($model)
    {
        $modelClass = "App\\Models\\$model";
        
        // Cek apakah class model ada
        if (!class_exists($modelClass)) {
            return false;
        }
        
        // Cek apakah model menggunakan SoftDeletes
        $traits = class_uses_recursive($modelClass);
        return in_array('Illuminate\\Database\\Eloquent\\SoftDeletes', $traits);
    }

    /**
     * Mendapatkan nama tampilan untuk model
     */
    private function getModelDisplayName($model)
    {
        $models = [
            'AbsensiDosen' => 'Absensi Dosen',
            'AbsensiMahasiswa' => 'Absensi Mahasiswa',
            'Balance' => 'Balance',
            'Commodity' => 'Commodity',
            'CommodityAcquisition' => 'Commodity Acquisition',
            'CommodityLocation' => 'Commodity Location',
            'DocsResource' => 'Docs Resource',
            'Dosen' => 'Dosen',
            'Fakultas' => 'Fakultas',
            'GalleryAlbum' => 'Gallery Album',
            'Gedung' => 'Gedung',
            'HasilStudi' => 'Hasil Studi',
            'HistoryTagihan' => 'History Tagihan',
            'JadwalKuliah' => 'Jadwal Kuliah',
            'Kelas' => 'Kelas',
            'KotakSaran' => 'Kotak Saran',
            'Kurikulum' => 'Kurikulum',
            'Mahasiswa' => 'Mahasiswa',
            'MahasiswaDetails' => 'Mahasiswa Details',
            'MataKuliah' => 'Mata Kuliah',
            'MessageSupport' => 'Message Support',
            'Mutabaah' => 'Mutabaah',
            'MutabaahField' => 'Mutabaah Field',
            'NewsCategory' => 'News Category',
            'NewsPost' => 'News Post',
            'Notification' => 'Notification',
            'ProgramKuliah' => 'Program Kuliah',
            'ProgramStudi' => 'Program Studi',
            'Ruang' => 'Ruang',
            'StudentScore' => 'Student Score',
            'StudentTask' => 'Student Task',
            'TagihanKuliah' => 'Tagihan Kuliah',
            'TahunAkademik' => 'Tahun Akademik',
            'TicketSupport' => 'Ticket Support',
            'UAttendance' => 'U Attendance',
            'User' => 'User',
        ];
        
        return $models[$model] ?? $model;
    }
}