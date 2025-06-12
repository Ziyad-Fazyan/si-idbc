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

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dosen::create([
            'dsn_nidn' => str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT),
            'dsn_stat' => '1',
            'dsn_name' => 'Dosen A',
            'dsn_code' => Str::random(6),
            'dsn_user' => 'dosen.a',
            'dsn_gend' => 'L',
            'dsn_mail' => 'dosen.a@example.com',
            'dsn_phone' => '080012345671',
            'password' => Hash::make('Dosen123'),
        ]);
        Dosen::create([
            'dsn_nidn' => str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT),
            'dsn_stat' => '1',
            'dsn_name' => 'Dosen B',
            'dsn_code' => Str::random(6),
            'dsn_user' => 'dosen.b',
            'dsn_gend' => 'P',
            'dsn_mail' => 'dosen.b@example.com',
            'dsn_phone' => '080012345672',
            'password' => Hash::make('Dosen123'),
        ]);
        Dosen::create([
            'dsn_nidn' => str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT),
            'dsn_stat' => '1',
            'dsn_name' => 'Dosen C',
            'dsn_code' => Str::random(6),
            'dsn_user' => 'dosen.c',
            'dsn_gend' => 'P',
            'dsn_mail' => 'dosen.c@example.com',
            'dsn_phone' => '080012345673',
            'password' => Hash::make('Dosen123'),
        ]);
        Dosen::create([
            'dsn_nidn' => str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT),
            'dsn_stat' => '1',
            'dsn_name' => 'Dosen D',
            'dsn_code' => Str::random(6),
            'dsn_user' => 'dosen.d',
            'dsn_gend' => 'P',
            'dsn_mail' => 'dosen.d@example.com',
            'dsn_phone' => '080012345674',
            'password' => Hash::make('Dosen123'),
        ]);
    }
}
