<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel dulu agar tidak duplikat saat seeding ulang (Opsional)
        // DB::table('dokters')->truncate(); 

        $data = [
            [
                'nama_dokter' => 'dr. Andi Pratama, Sp.PD',
                'spesialisasi' => 'Penyakit Dalam',
                'tarif' => 200000, // Tarif Spesialis
                'no_sip' => '551/SIP-DS/2023/001',
                'no_telepon' => '081234567890',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dokter' => 'drg. Siti Aminah',
                'spesialisasi' => 'Gigi',
                'tarif' => 150000, // Tarif Dokter Gigi
                'no_sip' => '446/SIP-DG/2024/015',
                'no_telepon' => '081398765432',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dokter' => 'dr. Budi Santoso, Sp.A',
                'spesialisasi' => 'Anak',
                'tarif' => 200000, // Tarif Spesialis
                'no_sip' => '332/SIP-DA/2022/089',
                'no_telepon' => '081987654321',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dokter' => 'dr. Citra Lestari, Sp.JP',
                'spesialisasi' => 'Jantung',
                'tarif' => 250000, // Tarif Spesialis Jantung (biasanya lebih tinggi)
                'no_sip' => '221/SIP-DJ/2023/112',
                'no_telepon' => '085678901234',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dokter' => 'dr. Eka Wijaya',
                'spesialisasi' => 'Umum',
                'tarif' => 100000, // Tarif Dokter Umum
                'no_sip' => '115/SIP-DU/2024/055',
                'no_telepon' => '081233344455',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($data as $dokter) {
            DB::table('dokters')->updateOrInsert(
                ['no_sip' => $dokter['no_sip']], // Unique Key
                $dokter
            );
        }
    }
}