<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_obat' => 'PCT-500',
                'nama_obat' => 'Paracetamol 500mg',
                'satuan' => 'Tablet',
                'stok' => 150,
                'harga' => 5000.00,
                'tanggal_kadaluarsa' => Carbon::now()->addYears(2), // Aman
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_obat' => 'AMX-500',
                'nama_obat' => 'Amoxicillin 500mg',
                'satuan' => 'Kapsul',
                'stok' => 8, // Stok Kritis (akan merah di UI)
                'harga' => 12000.00,
                'tanggal_kadaluarsa' => Carbon::now()->addYear(), 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_obat' => 'OBH-SYR',
                'nama_obat' => 'OBH Combi Sirup',
                'satuan' => 'Botol',
                'stok' => 45, // Stok Terbatas (akan kuning di UI)
                'harga' => 25000.00,
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(6),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_obat' => 'VTC-100',
                'nama_obat' => 'Vitamin C 1000mg',
                'satuan' => 'Tablet',
                'stok' => 200,
                'harga' => 2000.00,
                'tanggal_kadaluarsa' => Carbon::now()->addDays(20), // Hampir Kadaluarsa (warning)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_obat' => 'BTL-DIN',
                'nama_obat' => 'Betadine 30ml',
                'satuan' => 'Botol',
                'stok' => 60,
                'harga' => 35000.00,
                'tanggal_kadaluarsa' => Carbon::now()->subDays(5), // Sudah Kadaluarsa (danger)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($data as $item) {
            DB::table('obats')->updateOrInsert(
                ['kode_obat' => $item['kode_obat']],
                $item
            );
        }
    }
}