<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekamMedisController extends Controller
{
    /**
     * Menampilkan daftar riwayat rekam medis.
     */
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter'])
            ->latest()
            ->paginate(10);

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

        // Variabel $tindakans DIHAPUS
        return view('rekam_medis.create', compact('pasiens', 'dokters', 'obats', 'newRegNumber'));
    }

    /**
     * Menyimpan data rekam medis & resep obat.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Bagian Tindakan DIHAPUS)
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id_pasien',
            'dokter_id' => 'required|exists:dokters,id_dokter',
            'tgl_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            // Validasi Resep Obat tetap ada
            'resep' => 'nullable|array',
            'resep.*.obat_id' => 'required_with:resep|exists:obats,id_obat',
            'resep.*.jumlah' => 'required_with:resep|integer|min:1',
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
                if ($request->has('resep')) {
                    foreach ($request->resep as $item) {
                        if (!empty($item['obat_id'])) {
                            // Ambil data obat untuk update stok
                            $obatDB = Obat::find($item['obat_id']);
                            
                            // Simpan ke tabel pivot rekam_medis_obat
                            $rm->obats()->attach($item['obat_id'], [
                                'jumlah' => $item['jumlah'],
                                'aturan_pakai' => $item['aturan_pakai'] ?? '-'
                            ]);

                            // Kurangi Stok
                            $obatDB->decrement('stok', $item['jumlah']);
                        }
                    }
                }


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
        $rm = RekamMedis::with(['pasien', 'dokter', 'obats'])
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
        $rm = RekamMedis::with('obats', 'pasien')->findOrFail($id);
        $dokters = Dokter::all();
        $obats = Obat::all(); // Ambil semua obat (termasuk stok 0, jaga-jaga kalau obat lama stoknya habis)

        return view('rekam_medis.edit', compact('rm', 'dokters', 'obats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter_id' => 'required',
            'tgl_kunjungan' => 'required|date',
            'keluhan' => 'required',
            'diagnosa' => 'required',
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
            });

            return redirect()->route('rekam-medis.index')->with('success', 'Data berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }
}