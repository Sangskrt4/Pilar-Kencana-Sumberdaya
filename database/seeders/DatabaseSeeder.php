<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            JobVacancySeeder::class,
            TrainingModuleSeeder::class,
        ]);

        User::firstOrCreate(
            ['email' => 'hrd@pks.co.id'],
            [
                'name' => 'Admin HRD',
                'password' => Hash::make('password123'),
                'role' => 'hrd',
            ]
        );
    }
}