<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\TindakanMedis;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class RekamMedisController extends Controller
{
    /**
     * Cetak Rekam Medis ke PDF
     */
    public function print($id)
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter', 'tindakans', 'obats'])->findOrFail($id);
        
        $pdf = Pdf::loadView('rekam_medis.pdf', compact('rekamMedis'));
        
        $fileName = 'Rekam-Medis-' . str_replace('/', '-', $rekamMedis->pasien->no_rm) . '-' . $rekamMedis->id_rekam_medis . '.pdf';
        
        return $pdf->stream($fileName);
    }
    /**
     * Menampilkan daftar riwayat rekam medis.
     */
    public function index(Request $request)
    {
        $query = RekamMedis::with(['pasien', 'dokter', 'tagihan']);

        // Search (Pasien, Dokter, Diagnosa)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('pasien', function($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('no_rm', 'like', "%{$search}%");
                })
                ->orWhereHas('dokter', function($sub) use ($search) {
                    $sub->where('nama_dokter', 'like', "%{$search}%");
                })
                ->orWhere('diagnosa', 'like', "%{$search}%");
            });
        }

        // Filter Status Bayar
        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'Lunas') {
                $query->whereHas('tagihan', function($q) { $q->where('status', 'Lunas'); });
            } elseif ($status === 'Belum Lunas') {
                $query->whereHas('tagihan', function($q) { $q->where('status', 'Belum Lunas'); })
                      ->orWhereDoesntHave('tagihan'); // Asumsi jika belum ada tagihan = Belum bayar? Atau handle default creation.
            }
        }

        // Sorting
        if ($request->sort == 'oldest') {
            $query->oldest('tgl_kunjungan');
        } else {
            $query->latest('tgl_kunjungan');
        }

        $rekamMedis = $query->paginate(10)->withQueryString();

        return view('rekam_medis.index', compact('rekamMedis'));
    }

    /**
     * Menampilkan form input pemeriksaan baru.
     */
    public function create()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        // Hanya ambil obat yang stoknya > 0
        $obats = Obat::where('stok', '>', 0)->get();

        // Generate Nomor Registrasi Otomatis
        $today = Carbon::now()->format('Ymd');
        $random = rand(100, 999);
        $newRegNumber = "REG-{$today}-{$random}";

        $tindakans = TindakanMedis::all(); // Ambil semua data tindakan

        return view('rekam_medis.create', compact('pasiens', 'dokters', 'obats', 'newRegNumber', 'tindakans'));
    }

    /**
     * Menyimpan data rekam medis & resep obat.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id_pasien',
            'dokter_id' => 'required|exists:dokters,id_dokter',
            'tgl_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            // Validasi Resep Obat - lebih permisif untuk dynamic rows
            'resep' => 'nullable|array',
            'resep.*.obat_id' => 'nullable|exists:obats,id_obat',
            'resep.*.jumlah' => 'nullable|integer|min:1',
            // Validasi Tindakan
            'actions' => 'nullable|array',
            'actions.*' => 'nullable|exists:tindakan_medis,id_tindakan',
        ]);

        try {
            DB::transaction(function () use ($request) {
                
                // A. SIMPAN HEADER REKAM MEDIS
                $rm = RekamMedis::create([
                    'pasien_id' => $request->pasien_id,
                    'dokter_id' => $request->dokter_id,
                    'tgl_kunjungan' => $request->tgl_kunjungan,
                    'keluhan' => $request->keluhan,
                    'diagnosa' => $request->diagnosa,
                    'tensi' => $request->tensi,
                    'suhu' => $request->suhu,
                    'berat_badan' => $request->berat_badan,
                    'tinggi_badan' => $request->tinggi_badan,
                    'catatan_tambahan' => $request->catatan_tambahan,
                ]);

                // B. SIMPAN RESEP OBAT & KURANGI STOK
                $totalBiayaObat = 0;
                if ($request->has('resep')) {
                    foreach ($request->resep as $item) {
                        if (!empty($item['obat_id'])) {
                            // Ambil data obat
                            $obatDB = Obat::find($item['obat_id']);
                            if ($obatDB) {
                                // Simpan pivot
                                $rm->obats()->attach($item['obat_id'], [
                                    'jumlah' => $item['jumlah'],
                                    'aturan_pakai' => $item['aturan_pakai'] ?? '-'
                                ]);
    
                                // Kurangi Stok
                                $obatDB->decrement('stok', $item['jumlah']);
                                
                                // Hitung Biaya
                                $totalBiayaObat += ($obatDB->harga * $item['jumlah']);
                            }
                        }
                    }
                }

                // C. SIMPAN TINDAKAN MEDIS
                $totalBiayaTindakan = 0;
                if ($request->has('actions') && is_array($request->actions)) {
                    $cleanActions = array_filter($request->actions, function($v) { return !empty($v); });
                    foreach ($cleanActions as $tindakanId) {
                        $tindakanDB = TindakanMedis::find($tindakanId);
                        if ($tindakanDB) {
                            $rm->tindakans()->attach($tindakanId, [
                                'harga' => $tindakanDB->tarif
                            ]);
                            $totalBiayaTindakan += $tindakanDB->tarif;
                        }
                    }
                }

                // D. CREATE TAGIHAN
                $dokter = Dokter::find($request->dokter_id);
                $biayaDokter = $dokter ? $dokter->tarif : 0;
                $grandTotal = $biayaDokter + $totalBiayaObat + $totalBiayaTindakan;

                Tagihan::create([
                    'rekam_medis_id' => $rm->id_rm,
                    'biaya_dokter' => $biayaDokter,
                    'biaya_obat' => $totalBiayaObat,
                    'biaya_tindakan' => $totalBiayaTindakan,
                    'total_bayar' => $grandTotal,
                    'status' => 'Belum Lunas'
                ]);

            }); // End Transaction

            return redirect()->route('rekam-medis.index')->with('success', 'Pemeriksaan berhasil disimpan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menampilkan detail rekam medis.
     */
    public function show($id)
    {
        $rm = RekamMedis::with(['pasien', 'dokter', 'obats', 'tindakans'])
            ->findOrFail($id);

        return view('rekam_medis.show', compact('rm'));
    }

    /**
     * Menghapus data rekam medis.
     */
    public function destroy($id)
    {
        try {
            $rm = RekamMedis::findOrFail($id);
            $rm->delete(); // Pivot obat otomatis terhapus jika di migration pakai onDelete('cascade')

            return redirect()->route('rekam-medis.index')->with('success', 'Data rekam medis berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $rm = RekamMedis::with('obats', 'pasien', 'tindakans')->findOrFail($id);
        $dokters = Dokter::all();
        $obats = Obat::all(); // Ambil semua obat (termasuk stok 0, jaga-jaga kalau obat lama stoknya habis)
        $tindakans = TindakanMedis::all();

        return view('rekam_medis.edit', compact('rm', 'dokters', 'obats', 'tindakans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter_id' => 'required',
            'tgl_kunjungan' => 'required|date',
            'keluhan' => 'required',
            'diagnosa' => 'required',
            'actions' => 'nullable|array',
            'actions.*' => 'nullable|exists:tindakan_medis,id_tindakan',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $rm = RekamMedis::findOrFail($id);

                // 1. Update Data Header
                $rm->update([
                    'dokter_id' => $request->dokter_id,
                    'tgl_kunjungan' => $request->tgl_kunjungan,
                    'keluhan' => $request->keluhan,
                    'diagnosa' => $request->diagnosa,
                    'tensi' => $request->tensi,
                    'suhu' => $request->suhu,
                    'berat_badan' => $request->berat_badan,
                    'tinggi_badan' => $request->tinggi_badan,
                    'catatan_tambahan' => $request->catatan_tambahan,
                ]);

                // 2. Kelola Resep Obat (Logika: Restore Stok Lama -> Hapus Lama -> Simpan Baru)
                
                // A. Kembalikan stok obat lama dulu
                foreach ($rm->obats as $oldObat) {
                    $oldObat->increment('stok', $oldObat->pivot->jumlah);
                }
                
                // B. Hapus semua resep lama di pivot
                $rm->obats()->detach();

                // C. Simpan resep baru & kurangi stok baru
                if ($request->has('resep')) {
                    foreach ($request->resep as $item) {
                        if (!empty($item['obat_id'])) {
                            $obatDB = Obat::find($item['obat_id']);
                            
                            $rm->obats()->attach($item['obat_id'], [
                                'jumlah' => $item['jumlah'],
                                'aturan_pakai' => $item['aturan_pakai'] ?? '-'
                            ]);

                            $obatDB->decrement('stok', $item['jumlah']);
                        }
                    }
                }

                // 3. Kelola Tindakan Medis (Sync)
                $dataTindakan = [];
                $totalBiayaTindakan = 0;
                
                if ($request->has('actions') && is_array($request->actions)) {
                    $cleanActions = array_filter($request->actions, function($v) { return !empty($v); });
                    foreach ($cleanActions as $tindakanId) {
                        $tindakanDB = TindakanMedis::find($tindakanId);
                        if ($tindakanDB) {
                            $dataTindakan[$tindakanId] = ['harga' => $tindakanDB->tarif];
                            $totalBiayaTindakan += $tindakanDB->tarif;
                        }
                    }
                }
                $rm->tindakans()->sync($dataTindakan);

                // 4. Update Tagihan
                // Hitung ulang Biaya Obat
                $totalBiayaObat = 0;
                 if ($request->has('resep')) {
                    foreach ($request->resep as $item) {
                        if (!empty($item['obat_id'])) {
                             $obatDB = Obat::find($item['obat_id']);
                             $totalBiayaObat += ($obatDB->harga * $item['jumlah']);
                        }
                    }
                }
                
                $dokter = Dokter::find($request->dokter_id);
                $biayaDokter = $dokter->tarif;
                $grandTotal = $biayaDokter + $totalBiayaObat + $totalBiayaTindakan;

                // Cek apakah tagihan sudah ada (create or update)
                // Asumsi 1 Rekam Medis punya 1 Tagihan (One to One)
                Tagihan::updateOrCreate(
                    ['rekam_medis_id' => $rm->id_rm],
                    [
                        'biaya_dokter' => $biayaDokter,
                        'biaya_obat' => $totalBiayaObat,
                        'biaya_tindakan' => $totalBiayaTindakan,
                        'total_bayar' => $grandTotal,
                        // Status tidak direset, biarkan apa adanya atau default 'Belum Lunas' jika baru create
                    ]
                );
            });

            return redirect()->route('rekam-medis.index')->with('success', 'Data berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }
}