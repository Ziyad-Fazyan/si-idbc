<?php

namespace App\Exports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DosenExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Dosen::all();
    }

    /**
     * Specify the headings for the exported file.
     */
    public function headings(): array
    {
        return [
            'No',
            'NIDN',
            'Kode Dosen',
            'Nama Lengkap',
            'Username',
            'Email',
            'No. Telepon',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Status',
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
            $row->dsn_nidn ?? '-',
            $row->dsn_code ?? '-',
            $row->dsn_name ?? '-',
            $row->dsn_user ?? '-',
            $row->dsn_mail ?? '-',
            $row->dsn_phone ?? '-',
            $row->dsn_birthplace ?? '-',
            $row->dsn_birthdate ?? '-',
            $row->dsn_gend ?? '-',
            $row->getDsnStatAttribute($row->dsn_stat) ?? '-',
        ];
    }
}
