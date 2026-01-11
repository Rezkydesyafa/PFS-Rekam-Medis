<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TindakanMedisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_tindakan' => 'Pemeriksaan Umum', 'tarif' => 50000, 'kategori' => 'Pemeriksaan'],
            ['nama_tindakan' => 'Pemeriksaan Gigi', 'tarif' => 100000, 'kategori' => 'Pemeriksaan'],
            ['nama_tindakan' => 'Suntik Vitamin C', 'tarif' => 75000, 'kategori' => 'Suplemen'],
            ['nama_tindakan' => 'Nebulizer', 'tarif' => 60000, 'kategori' => 'Tindakan Medis'],
            ['nama_tindakan' => 'Rawat Luka Ringan', 'tarif' => 45000, 'kategori' => 'Tindakan Medis'],
            ['nama_tindakan' => 'Jahit Luka (1-3 jahitan)', 'tarif' => 150000, 'kategori' => 'Bedah Minor'],
            ['nama_tindakan' => 'EKG Jantung', 'tarif' => 120000, 'kategori' => 'Pemeriksaan Penunjang'],
            ['nama_tindakan' => 'Cek Gula Darah', 'tarif' => 25000, 'kategori' => 'Laboratorium'],
        ];

        foreach ($data as $item) {
            \App\Models\TindakanMedis::create($item);
        }
    }
}
