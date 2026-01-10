<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Dr. Hendra S.',
            'username' => 'admin',
            'email' => 'admin@medrecord.pro',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);

        // Create Petugas Rekam Medis
        User::create([
            'name' => 'Sarah Wijaya',
            'username' => 'petugas',
            'email' => 'petugas@medrecord.pro',
            'password' => bcrypt('password'),
            'role' => 'petugas',
        ]);

        // Seed patients data
        $this->call([
            PasienSeeder::class,
        ]);
    }
}
