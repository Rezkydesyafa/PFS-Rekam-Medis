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
        // 1. Create Users for each Role
        $users = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'role' => 'admin', // Was superadmin
            ],
            [
                'name' => 'Staff Pendaftaran',
                'username' => 'pendaftaran',
                'role' => 'unit_pendaftaran',
            ],
            [
                'name' => 'Petugas RM',
                'username' => 'petugas',
                'role' => 'petugas_rekam_medis',
            ],
            [
                'name' => 'dr. Budi Santoso',
                'username' => 'dokter',
                'role' => 'dokter',
            ],
            [
                'name' => 'Apoteker Siti',
                'username' => 'apoteker',
                'role' => 'apoteker',
            ],
            [
                'name' => 'Kasir Andi',
                'username' => 'kasir',
                'role' => 'kasir',
            ]
        ];

        foreach ($users as $user) {
            if (!User::where('username', $user['username'])->exists()) {
                User::create([
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'email' => $user['username'] . '@sirm.com',
                    'password' => bcrypt('password'), // Access with generic password
                    'role' => $user['role'],
                ]);
            }
        }

        // 2. Call Other Seeders
        $this->call([
            PasienSeeder::class, // Data Pasien
            DokterSeeder::class, // Data Dokter (Baru)
            ObatSeeder::class,   // Data Obat (Baru)
            TindakanMedisSeeder::class, // Data Tindakan (Baru)
            RekamMedisSeeder::class, // Data Rekam Medis (Baru)
        ]);
    }
}