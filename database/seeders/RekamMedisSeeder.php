<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Tagihan;
use Carbon\Carbon;
use Faker\Factory as Faker;

class RekamMedisSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Pastikan ada data master dulu
        if (Pasien::count() == 0 || Dokter::count() == 0 || Obat::count() == 0) {
            $this->command->info('Harap jalankan PasienSeeder, DokterSeeder, dan ObatSeeder terlebih dahulu!');
            return;
        }

        // Ambil semua data master
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $obats = Obat::all();

        // Kita buat 10 Transaksi Rekam Medis Dummy
        for ($i = 0; $i < 10; $i++) {
            
            // 1. Pilih Pasien & Dokter Acak
            $pasien = $pasiens->random();
            $dokter = $dokters->random();
            $tgl = Carbon::now()->subDays(rand(0, 30)); // Random tanggal 30 hari terakhir

            // 2. Simpan Rekam Medis (Header)
            $rm = RekamMedis::create([
                'pasien_id' => $pasien->id_pasien,
                'dokter_id' => $dokter->id_dokter,
                'tgl_kunjungan' => $tgl,
                'keluhan' => $faker->sentence(6), // Contoh: "Sakit kepala disertai mual sejak kemarin"
                'diagnosa' => 'Suspect ' . $faker->word, // Contoh: "Suspect Febris"
                'tensi' => rand(100, 140) . '/' . rand(70, 90),
                'suhu' => rand(36, 39),
                'berat_badan' => rand(45, 80),
                'catatan_tambahan' => 'Istirahat yang cukup',
                'created_at' => $tgl,
                'updated_at' => $tgl,
            ]);

            // 3. Simpan Obat (Detail) & Hitung Biaya Obat
            // Kita acak, 1 pasien bisa dapat 1 sampai 3 jenis obat
            $randomObats = $obats->random(rand(1, 3)); 
            $totalBiayaObat = 0;

            foreach ($randomObats as $obat) {
                $jumlah = rand(5, 15); // Jumlah butir obat
                
                // Masukkan ke Pivot Table
                DB::table('rekam_medis_obat')->insert([
                    'rekam_medis_id' => $rm->id_rm,
                    'obat_id' => $obat->id_obat,
                    'jumlah' => $jumlah,
                    'aturan_pakai' => rand(2,3) . 'x1 Sesudah Makan',
                    'created_at' => $tgl,
                    'updated_at' => $tgl,
                ]);

                // Hitung subtotal harga obat
                $totalBiayaObat += ($obat->harga * $jumlah);
            }

            // 4. Simpan Tagihan (Billing)
            // Biaya Dokter diambil dari tarif dokter yang dipilih
            $biayaDokter = $dokter->tarif;
            $grandTotal = $biayaDokter + $totalBiayaObat;

            Tagihan::create([
                'rekam_medis_id' => $rm->id_rm,
                'biaya_dokter' => $biayaDokter,
                'biaya_obat' => $totalBiayaObat,
                'total_bayar' => $grandTotal,
                'status' => $faker->randomElement(['Lunas', 'Belum Lunas']),
                'created_at' => $tgl,
                'updated_at' => $tgl,
            ]);
        }
    }
}