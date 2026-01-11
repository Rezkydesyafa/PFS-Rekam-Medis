<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan package dompdf sudah terinstall

class TagihanController extends Controller
{
    /**
     * Menampilkan daftar tagihan (Kasir).
     */
    public function index(Request $request)
    {
        $query = Tagihan::with(['rekamMedis.pasien', 'rekamMedis.dokter'])
            ->latest();

        // Fitur Pencarian (Nama Pasien / No Tagihan)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('id_tagihan', 'like', "%$search%")
                  ->orWhereHas('rekamMedis.pasien', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%")
                        ->orWhere('no_rm', 'like', "%$search%");
                  });
        }

        // Fitur Filter Status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $tagihans = $query->paginate(10);

        return view('tagihan.index', compact('tagihans'));
    }

    /**
     * Menampilkan form buat tagihan baru.
     */
    public function create()
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter'])->latest()->get();
        return view('tagihan.create', compact('rekamMedis'));
    }

    /**
     * Menyimpan tagihan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rekam_medis_id' => 'required|exists:rekam_medis,id_rm',
            'biaya_dokter' => 'required|numeric|min:0',
            'biaya_obat' => 'required|numeric|min:0',
            'biaya_tindakan' => 'required|numeric|min:0',
            'status' => 'required|in:Lunas,Belum Lunas',
            'metode_pembayaran' => 'nullable|string',
        ], [
            'rekam_medis_id.required' => 'Rekam Medis wajib dipilih.',
            'rekam_medis_id.exists' => 'Data Rekam Medis tidak valid.',
            'biaya_dokter.required' => 'Biaya Dokter wajib diisi.',
            'biaya_obat.required' => 'Biaya Obat wajib diisi.',
            'biaya_tindakan.required' => 'Biaya Tindakan wajib diisi.',
            'status.required' => 'Status pembayaran wajib dipilih.',
        ]);

        $total_biaya = $request->biaya_dokter + $request->biaya_obat + $request->biaya_tindakan;

        Tagihan::create([
            'rekam_medis_id' => $request->rekam_medis_id,
            'biaya_dokter' => $request->biaya_dokter,
            'biaya_obat' => $request->biaya_obat,
            'biaya_tindakan' => $request->biaya_tindakan,
            'total_biaya' => $total_biaya,
            'status' => $request->status,
            'metode_pembayaran' => $request->status == 'Lunas' ? $request->metode_pembayaran : null,
            'waktu_pembayaran' => $request->status == 'Lunas' ? now() : null,
        ]);

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dibuat.');
    }

    /**
     * Menampilkan detail tagihan (Invoice).
     */
    public function show($id)
    {
        $tagihan = Tagihan::with(['rekamMedis.pasien', 'rekamMedis.dokter', 'rekamMedis.obats', 'rekamMedis.tindakans'])
            ->findOrFail($id);

        return view('tagihan.show', compact('tagihan'));
    }

    /**
     * Mengupdate status pembayaran menjadi LUNAS.
     */
    public function updateStatus($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        
        $tagihan->update([
            'status' => 'Lunas',
            'waktu_pembayaran' => now(), // Pastikan kolom ini ada di database, atau hapus baris ini jika tidak ada
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi. Status: LUNAS.');
    }

    /**
     * Mencetak Struk / Invoice ke PDF.
     */
    public function print($id)
    {
        $tagihan = Tagihan::with(['rekamMedis.pasien', 'rekamMedis.dokter', 'rekamMedis.obats', 'rekamMedis.tindakans'])
            ->findOrFail($id);

        // Load view PDF yang tadi Anda buat
        $pdf = Pdf::loadView('tagihan.pdf', compact('tagihan'));
        
        // Atur ukuran kertas (misal A5 landscape untuk struk atau A4 portrait)
        $pdf->setPaper('a5', 'landscape'); 

        return $pdf->stream('Invoice-' . $tagihan->id_tagihan . '.pdf');
    }
    
    /**
     * Menghapus Tagihan (Hati-hati, biasanya data keuangan tidak boleh dihapus).
     */
    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->delete();

        return redirect()->route('tagihan.index')->with('success', 'Data tagihan berhasil dihapus.');
    }
}