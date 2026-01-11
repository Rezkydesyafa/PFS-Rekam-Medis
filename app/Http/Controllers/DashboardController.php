<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\Dokter; // Opsional jika dibutuhkan
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. FILTER TANGGAL
        // Jika user memilih tanggal, gunakan itu. Jika tidak, gunakan hari ini.
        $selectedDate = $request->has('date') ? Carbon::parse($request->date) : Carbon::today();
        
        // Cek apakah tanggal masa depan (untuk validasi tampilan)
        $isFuture = $selectedDate->gt(Carbon::today());

        // 2. HITUNG STATISTIK UTAMA (Cards)
        if ($isFuture) {
            // Jika tanggal masa depan, datanya 0 semua
            $total_pasien = 0;
            $kunjungan_hari_ini = 0;
            $total_rm = 0;
            $rm_tercetak = 0;
        } else {
            // A. Total Pasien (Akumulasi sampai tanggal dipilih)
            $total_pasien = Pasien::whereDate('created_at', '<=', $selectedDate)->count();
            
            // B. Kunjungan Pada Tanggal Tersebut
            // PENTING: Menggunakan kolom 'tgl_kunjungan' bukan 'tanggal_kunjungan'
            $kunjungan_hari_ini = RekamMedis::whereDate('tgl_kunjungan', $selectedDate)->count();
            
            // C. Total Rekam Medis (Akumulasi)
            $total_rm = RekamMedis::whereDate('created_at', '<=', $selectedDate)->count();
            
            // D. Rekam Medis Tercetak (Real-time Count from DB)
            $rm_tercetak = RekamMedis::where('status_cetak', 'Sudah Dicetak')
                                     ->whereDate('created_at', '<=', $selectedDate)
                                     ->count(); 
        } 

        // 3. LOGIKA TAMBAHAN (Queue & Activity)
        $antrian_aktif = $kunjungan_hari_ini; // Asumsi antrian = jumlah kunjungan hari ini
        $kelengkapan_rm = 95; // Nilai statis atau bisa dibuat dinamis nanti

        // 4. CHART: STATISTIK KUNJUNGAN (7 Hari Terakhir dari Tanggal Dipilih)
        $endDate = $selectedDate->copy();
        $startDate = $endDate->copy()->subDays(6);
        
        // Query Group By Tanggal
        // PENTING: Perbaikan nama kolom 'tgl_kunjungan'
        $visits = RekamMedis::select(DB::raw('DATE(tgl_kunjungan) as date'), DB::raw('count(*) as count'))
            ->whereBetween('tgl_kunjungan', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Siapkan Data Chart (Isi 0 jika tanggal kosong)
        $chart_data = [];
        $categories = [];
        
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dateString = $date->format('Y-m-d');
            $count = 0;
            
            foreach ($visits as $visit) {
                if ($visit->date == $dateString) {
                    $count = $visit->count;
                    break;
                }
            }
            
            $chart_data[] = $count;
            $categories[] = $date->format('d M'); // Label Sumbu X (Contoh: 12 Jan)
        }

        // 5. CHART: DEMOGRAFI PASIEN (Pie Chart Umur)
        // Ambil semua tanggal lahir pasien
        $ages = Pasien::select('tgl_lahir')->get()->map(function ($pasien) {
            return Carbon::parse($pasien->tgl_lahir)->age;
        });

        // Kelompokkan Umur
        $age_18_35 = $ages->filter(fn($age) => $age >= 18 && $age <= 35)->count();
        $age_36_55 = $ages->filter(fn($age) => $age > 35 && $age <= 55)->count();
        $age_gt_55 = $ages->filter(fn($age) => $age > 55)->count();
        
        // Hitung Persentase (Untuk Pie Chart)
        $total_for_pie = $age_18_35 + $age_36_55 + $age_gt_55;
        $total_for_pie = $total_for_pie == 0 ? 1 : $total_for_pie; // Hindari pembagian dengan 0

        $age_stats = [
            '18_35' => round(($age_18_35 / $total_for_pie) * 100),
            '36_55' => round(($age_36_55 / $total_for_pie) * 100),
            'gt_55' => round(($age_gt_55 / $total_for_pie) * 100),
            'counts' => [$age_18_35, $age_36_55, $age_gt_55] // Data mentah untuk tooltip chart
        ];
        
        // 6. PASIEN TERBARU (Tabel kecil di dashboard)
        $latest_patients = Pasien::latest()->take(5)->get();

        // 7. RETURN VIEW
        return view('dashboard', compact(
            'total_pasien', 
            'kunjungan_hari_ini', 
            'total_rm', 
            'rm_tercetak',
            'antrian_aktif',
            'kelengkapan_rm',
            'chart_data',
            'categories',
            'age_stats',
            'latest_patients',
            'selectedDate'
        ));
    }
}