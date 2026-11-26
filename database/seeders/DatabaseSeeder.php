<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Panggil seeder lowongan
        $this->call([
            JobVacancySeeder::class,
        ]);

        // Bikin Akun Admin HRD
        User::create([
            'name' => 'Admin HRD',
            'email' => 'hrd@pks.co.id',
            'password' => Hash::make('password123'),
            'role' => 'hrd',
        ]);
    }
}