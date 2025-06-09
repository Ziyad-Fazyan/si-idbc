<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    /**
     * Specify the headings for the exported file.
     */
    public function headings(): array
    {
        return [
            'Username',
            'Email',
            'Phone',
            'FullName',
            'Gender',
            'Religion',
            'BirthPlace',
            'BirthDate',
            'TypeUser',
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
            $row->user,
            $row->email,
            $row->phone,
            $row->name,
            $row->gend,
            $row->raw_reli,
            $row->birth_place,
            $row->birth_date,
            $row->raw_type,
            $row->status,
        ];
    }
}
