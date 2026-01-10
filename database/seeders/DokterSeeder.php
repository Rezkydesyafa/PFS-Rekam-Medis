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
        $data = [
            [
                'nama_dokter' => 'dr. Andi Pratama, Sp.PD',
                'spesialisasi' => 'Penyakit Dalam',
                'no_sip' => '551/SIP-DS/2023/001',
                'no_telepon' => '081234567890',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dokter' => 'drg. Siti Aminah',
                'spesialisasi' => 'Gigi',
                'no_sip' => '446/SIP-DG/2024/015',
                'no_telepon' => '081398765432',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dokter' => 'dr. Budi Santoso, Sp.A',
                'spesialisasi' => 'Anak',
                'no_sip' => '332/SIP-DA/2022/089',
                'no_telepon' => '081987654321',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dokter' => 'dr. Citra Lestari, Sp.JP',
                'spesialisasi' => 'Jantung',
                'no_sip' => '221/SIP-DJ/2023/112',
                'no_telepon' => '085678901234',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_dokter' => 'dr. Eka Wijaya',
                'spesialisasi' => 'Umum',
                'no_sip' => '115/SIP-DU/2024/055',
                'no_telepon' => '081233344455',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('dokters')->insert($data);
    }
}