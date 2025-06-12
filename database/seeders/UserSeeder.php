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

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'code' => Str::random(6),
            'user' => 'admin',
            'gend' => 'L',
            'email' => 'ziyad@gmail.com',
            'phone' => '080012345660',
            'password' => Hash::make('Admin123'),
            'status' => 1,
        ]);
        User::create([
            'name' => 'Staff Finance',
            'code' => Str::random(6),
            'user' => 'finance',
            'gend' => 'L',
            'type' => 1,
            'email' => 'finance@example.com',
            'phone' => '080012345661',
            'password' => Hash::make('Admin123'),
            'status' => 1,
        ]);
        User::create([
            'name' => 'Staff Absen',
            'code' => Str::random(6),
            'user' => 'absen',
            'gend' => 'L',
            'type' => 2,
            'email' => 'absen@example.com',
            'phone' => '080012345662',
            'password' => Hash::make('Admin123'),
            'status' => 1,
        ]);
        User::create([
            'name' => 'Staff Akademik',
            'code' => Str::random(6),
            'user' => 'academic',
            'gend' => 'L',
            'type' => 3,
            'email' => 'academic@example.com',
            'phone' => '080012345663',
            'password' => Hash::make('Admin123'),
            'status' => 1,
        ]);
        User::create([
            'name' => 'Staff Musyrif',
            'code' => Str::random(6),
            'user' => 'musyrif',
            'gend' => 'L',
            'type' => 4,
            'email' => 'musyrif@example.com',
            'phone' => '080012345664',
            'password' => Hash::make('Admin123'),
            'status' => 1,
        ]);
        User::create([
            'name' => 'Staff Support',
            'code' => Str::random(6),
            'user' => 'support',
            'gend' => 'L',
            'type' => 5,
            'email' => 'support@example.com',
            'phone' => '080012345665',
            'password' => Hash::make('Admin123'),
            'status' => 1,
        ]);
        User::create([
            'name' => 'Staff Site Manager',
            'code' => Str::random(6),
            'user' => 'sitemanager',
            'gend' => 'L',
            'type' => 6,
            'email' => 'sitemanager@example.com',
            'phone' => '080012345666',
            'password' => Hash::make('Admin123'),
            'status' => 1,
        ]);
    }
}
