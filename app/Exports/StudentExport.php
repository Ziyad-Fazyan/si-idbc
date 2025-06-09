<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class StudentExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Mahasiswa::with('mahasiswaDetails')->get();
    }

    /**
     * Specify the headings for the exported file.
     */
    public function headings(): array
    {
        return [
            'No',
            'NIM',
            'Nama Lengkap',
            'Username',
            'Email',
            'No. Telepon',
            'Jenis Kelamin',
            'Agama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Status',
            'Alamat Domisili',
            'Kelurahan',
            'Kecamatan',
            'Kota',
            'Provinsi',
            'Nama Ibu',
            'No. Telepon Ibu',
            'Nama Ayah',
            'No. Telepon Ayah',
            'Nama Wali',
            'No. Telepon Wali',
            'Golongan Darah',
            'Tinggi Badan (cm)',
            'Berat Badan (kg)',
            'Riwayat Kesehatan',
        ];
    }

    /**
     * Map each row of the collection to an array for export.
     */
    public function map($row): array
    {
        static $i = 0;
        $i++;

        return [
            $i,
            $row->mhs_nim ?? '-',
            $row->mhs_name,
            $row->mhs_user,
            $row->mhs_mail,
            $row->mhs_phone,
            $row->mhs_gend == 'L' ? 'Laki-laki' : ($row->mhs_gend == 'P' ? 'Perempuan' : '-'),
            $row->mahasiswaDetails?->agama ?? '-',
            $row->mahasiswaDetails?->mhs_birthplace ?? '-',
            $row->mahasiswaDetails?->mhs_birthdate ? date('d/m/Y', strtotime($row->mahasiswaDetails->mhs_birthdate)) : '-',
            $row->mhs_stat,
            $row->mahasiswaDetails?->mhs_addr_domisili ?? '-',
            $row->mahasiswaDetails?->mhs_addr_kelurahan ?? '-',
            $row->mahasiswaDetails?->mhs_addr_kecamatan ?? '-',
            $row->mahasiswaDetails?->mhs_addr_kota ?? '-',
            $row->mahasiswaDetails?->mhs_addr_provinsi ?? '-',
            $row->mahasiswaDetails?->mhs_parent_mother ?? '-',
            $row->mahasiswaDetails?->mhs_parent_mother_phone ?? '-',
            $row->mahasiswaDetails?->mhs_parent_father ?? '-',
            $row->mahasiswaDetails?->mhs_parent_father_phone ?? '-',
            $row->mahasiswaDetails?->mhs_wali_name ?? '-',
            $row->mahasiswaDetails?->mhs_wali_phone ?? '-',
            $row->mahasiswaDetails?->mhs_goldar ?? '-',
            $row->mahasiswaDetails?->mhs_tinggi_badan ?? '-',
            $row->mahasiswaDetails?->mhs_berat_badan ?? '-',
            $row->mahasiswaDetails?->mhs_riwayat_kesehatan ?? '-',
        ];
    }
}
