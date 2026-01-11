<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
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