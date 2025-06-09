<?php

namespace App\Http\Controllers\Services\Convert;

use App\Exports\DosenExport;
use App\Exports\StudentExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenExportRequest;
use App\Http\Requests\MahasiswaExportRequest;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Mahasiswa;
use App\Http\Requests\UsersExportRequest;
use App\Models\Dosen;

class ExportController extends Controller
{
    public function exportUsers(UsersExportRequest $request)
    {
        $filename = 'daftar-users-' . date('d-m-Y');

        return match ($request->extension) {
            'xlsx' => Excel::download(new UsersExport, $filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX),
            'xls' => Excel::download(new UsersExport, $filename . '.xls', \Maatwebsite\Excel\Excel::XLS),
            'csv' => Excel::download(new UsersExport, $filename . '.csv', \Maatwebsite\Excel\Excel::CSV),
            'html' => Excel::download(new UsersExport, $filename . '.html', \Maatwebsite\Excel\Excel::HTML),
        };
    }

    public function exportStudent(MahasiswaExportRequest $request)
    {
        $filename = 'daftar-mahasiswa-' . date('d-m-Y');

        return match ($request->extension) {
            'xlsx' => Excel::download(new StudentExport, $filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX),
            'xls' => Excel::download(new StudentExport, $filename . '.xls', \Maatwebsite\Excel\Excel::XLS),
            'csv' => Excel::download(new StudentExport, $filename . '.csv', \Maatwebsite\Excel\Excel::CSV),
            'html' => Excel::download(new StudentExport, $filename . '.html', \Maatwebsite\Excel\Excel::HTML),
        };
    }

    public function exportDosens(DosenExportRequest $request)
    {
        $filename = 'daftar-dosen-' . date('d-m-Y');

        return match ($request->extension) {
            'xlsx' => Excel::download(new DosenExport, $filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX),
            'xls' => Excel::download(new DosenExport, $filename . '.xls', \Maatwebsite\Excel\Excel::XLS),
            'csv' => Excel::download(new DosenExport, $filename . '.csv', \Maatwebsite\Excel\Excel::CSV),
            'html' => Excel::download(new DosenExport, $filename . '.html', \Maatwebsite\Excel\Excel::HTML),
        };
    }
}
