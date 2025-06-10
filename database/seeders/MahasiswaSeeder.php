<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'taka_id' => '1',
            'years_id' => '1',
            'mhs_nim' => str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT),
            'mhs_name' => 'Mahasiswa A',
            'mhs_stat' => '1',
            'mhs_gend' => 'L',
            'mhs_code' => Str::random(6),
            'mhs_user' => 'mahasiswa.a',
            'mhs_mail' => 'mahasiswa.a@example.com',
            'mhs_phone' => '080012345670',
            'password' => Hash::make('Mahasiswa123'),
        ]);
        Mahasiswa::create([
            'taka_id' => '1',
            'years_id' => '1',
            'mhs_nim' => str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT),
            'mhs_name' => 'Mahasiswa B',
            'mhs_stat' => '1',
            'mhs_gend' => 'L',
            'mhs_code' => Str::random(6),
            'mhs_user' => 'mahasiswa.b',
            'mhs_mail' => 'mahasiswa.b@example.com',
            'mhs_phone' => '080012345671',
            'password' => Hash::make('Mahasiswa123'),
        ]);
        Mahasiswa::create([
            'taka_id' => '2',
            'years_id' => '1',
            'mhs_nim' => str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT),
            'mhs_name' => 'Mahasiswa C',
            'mhs_stat' => '1',
            'mhs_gend' => 'P',
            'mhs_code' => Str::random(6),
            'mhs_user' => 'mahasiswa.c',
            'mhs_mail' => 'mahasiswa.c@example.com',
            'mhs_phone' => '080012345672',
            'password' => Hash::make('Mahasiswa123'),
        ]);
        Mahasiswa::create([
            'taka_id' => '2',
            'years_id' => '1',
            'mhs_nim' => str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT),
            'mhs_name' => 'Mahasiswa D',
            'mhs_stat' => '1',
            'mhs_gend' => 'L',
            'mhs_code' => Str::random(6),
            'mhs_user' => 'mahasiswa.d',
            'mhs_mail' => 'mahasiswa.d@example.com',
            'mhs_phone' => '080012345673',
            'password' => Hash::make('Mahasiswa123'),
        ]);
    }
}
