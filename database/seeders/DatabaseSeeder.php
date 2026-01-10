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
        // 1. Create Users (Admin & Petugas)
        // Cek dulu apakah user sudah ada untuk menghindari error duplicate entry saat seeding ulang
        if (!User::where('username', 'admin')->exists()) {
            User::create([
                'name' => 'Dr. Hendra S.',
                'username' => 'admin',
                'email' => 'admin@medrecord.pro',
                'password' => bcrypt('password'),
                'role' => 'superadmin',
            ]);
        }

        if (!User::where('username', 'petugas')->exists()) {
            User::create([
                'name' => 'Sarah Wijaya',
                'username' => 'petugas',
                'email' => 'petugas@medrecord.pro',
                'password' => bcrypt('password'),
                'role' => 'petugas',
            ]);
        }

        // 2. Panggil Seeder Lainnya
        $this->call([
            PasienSeeder::class, // Data Pasien
            DokterSeeder::class, // Data Dokter (Baru)
            ObatSeeder::class,   // Data Obat (Baru)
            RekamMedisSeeder::class, // Data Rekam Medis (Baru)
        ]);
    }
}