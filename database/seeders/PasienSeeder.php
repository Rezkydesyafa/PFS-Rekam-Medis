<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = [
            [
                'name' => 'Ahmad Fauzi Rahman',
                'nik' => '3201050508900001',
                'no_rm' => 'RM-2024-001',
                'tgl_lahir' => '1990-08-05',
                'jenis_kelamin' => 'L',
                'gol_darah' => 'A',
                'status_nikah' => 'Menikah',
                'no_hp' => '081234567890',
                'email' => 'ahmad.fauzi@email.com',
                'alamat' => 'Jl. Merdeka No. 45, RT 03/RW 05, Kelurahan Sukamaju, Kecamatan Ciracas, Jakarta Timur, DKI Jakarta 13740',
                'status' => 'active',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'nik' => '3201050612850002',
                'no_rm' => 'RM-2024-002',
                'tgl_lahir' => '1985-12-06',
                'jenis_kelamin' => 'P',
                'gol_darah' => 'B',
                'status_nikah' => 'Menikah',
                'no_hp' => '082345678901',
                'email' => 'siti.nurhaliza@email.com',
                'alamat' => 'Jl. Anggrek Indah No. 12, RT 02/RW 08, Kelurahan Cipinang, Kecamatan Pulo Gadung, Jakarta Timur, DKI Jakarta 13240',
                'status' => 'active',
            ],
            [
                'name' => 'Budi Santoso',
                'nik' => '3201051503780003',
                'no_rm' => 'RM-2024-003',
                'tgl_lahir' => '1978-03-15',
                'jenis_kelamin' => 'L',
                'gol_darah' => 'O',
                'status_nikah' => 'Menikah',
                'no_hp' => '083456789012',
                'email' => 'budi.santoso@email.com',
                'alamat' => 'Jl. Raya Bogor KM 25, RT 01/RW 03, Kelurahan Ciracas, Kecamatan Ciracas, Jakarta Timur, DKI Jakarta 13750',
                'status' => 'active',
            ],
            [
                'name' => 'Dewi Kartika Sari',
                'nik' => '3201052207920004',
                'no_rm' => 'RM-2024-004',
                'tgl_lahir' => '1992-07-22',
                'jenis_kelamin' => 'P',
                'gol_darah' => 'AB',
                'status_nikah' => 'Belum Menikah',
                'no_hp' => '084567890123',
                'email' => 'dewi.kartika@email.com',
                'alamat' => 'Jl. Mawar Putih No. 8, RT 04/RW 02, Kelurahan Cibubur, Kecamatan Ciracas, Jakarta Timur, DKI Jakarta 13720',
                'status' => 'active',
            ],
            [
                'name' => 'Muhammad Rizki Pratama',
                'nik' => '3201050110000005',
                'no_rm' => 'RM-2024-005',
                'tgl_lahir' => '2000-10-01',
                'jenis_kelamin' => 'L',
                'gol_darah' => 'A',
                'status_nikah' => 'Belum Menikah',
                'no_hp' => '085678901234',
                'email' => 'rizki.pratama@email.com',
                'alamat' => 'Jl. Kenanga Raya No. 33, RT 06/RW 04, Kelurahan Duren Sawit, Kecamatan Duren Sawit, Jakarta Timur, DKI Jakarta 13440',
                'status' => 'pending',
            ],
            [
                'name' => 'Ratna Wulandari',
                'nik' => '3201051408880006',
                'no_rm' => 'RM-2024-006',
                'tgl_lahir' => '1988-08-14',
                'jenis_kelamin' => 'P',
                'gol_darah' => 'B',
                'status_nikah' => 'Janda',
                'no_hp' => '086789012345',
                'email' => 'ratna.wulan@email.com',
                'alamat' => 'Jl. Melati No. 17, RT 05/RW 06, Kelurahan Klender, Kecamatan Duren Sawit, Jakarta Timur, DKI Jakarta 13470',
                'status' => 'active',
            ],
            [
                'name' => 'Agus Setiawan',
                'nik' => '3201052805750007',
                'no_rm' => 'RM-2024-007',
                'tgl_lahir' => '1975-05-28',
                'jenis_kelamin' => 'L',
                'gol_darah' => 'O',
                'status_nikah' => 'Duda',
                'no_hp' => '087890123456',
                'email' => 'agus.setiawan@email.com',
                'alamat' => 'Jl. Flamboyan No. 21, RT 08/RW 01, Kelurahan Jatinegara, Kecamatan Jatinegara, Jakarta Timur, DKI Jakarta 13310',
                'status' => 'inactive',
            ],
            [
                'name' => 'Putri Anggraeni',
                'nik' => '3201050309950008',
                'no_rm' => 'RM-2024-008',
                'tgl_lahir' => '1995-09-03',
                'jenis_kelamin' => 'P',
                'gol_darah' => 'A',
                'status_nikah' => 'Menikah',
                'no_hp' => '088901234567',
                'email' => 'putri.anggraeni@email.com',
                'alamat' => 'Jl. Cempaka No. 9, RT 03/RW 07, Kelurahan Makasar, Kecamatan Makasar, Jakarta Timur, DKI Jakarta 13570',
                'status' => 'active',
            ],
            [
                'name' => 'Hendra Gunawan',
                'nik' => '3201051712820009',
                'no_rm' => 'RM-2024-009',
                'tgl_lahir' => '1982-12-17',
                'jenis_kelamin' => 'L',
                'gol_darah' => 'AB',
                'status_nikah' => 'Menikah',
                'no_hp' => '089012345678',
                'email' => 'hendra.gunawan@email.com',
                'alamat' => 'Jl. Teratai Indah No. 55, RT 02/RW 09, Kelurahan Kramat Jati, Kecamatan Kramat Jati, Jakarta Timur, DKI Jakarta 13510',
                'status' => 'active',
            ],
            [
                'name' => 'Sri Wahyuni',
                'nik' => '3201050801700010',
                'no_rm' => 'RM-2024-010',
                'tgl_lahir' => '1970-01-08',
                'jenis_kelamin' => 'P',
                'gol_darah' => 'B',
                'status_nikah' => 'Menikah',
                'no_hp' => '081123456789',
                'email' => 'sri.wahyuni@email.com',
                'alamat' => 'Jl. Dahlia No. 7, RT 07/RW 03, Kelurahan Cakung, Kecamatan Cakung, Jakarta Timur, DKI Jakarta 13910',
                'status' => 'pending',
            ],
        ];

        foreach ($patients as $patient) {
            Pasien::firstOrCreate(
                ['nik' => $patient['nik']], // Kunci pencarian
                $patient // Data yang akan diinsert jika tidak ditemukan
            );
        }
    }
}
