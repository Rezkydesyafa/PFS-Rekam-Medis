<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display list of doctors
     */
    public function index(Request $request)
    {
        $query = Dokter::query();
        
        // Search by name, SIP, or phone
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_dokter', 'like', "%{$search}%")
                  ->orWhere('no_sip', 'like', "%{$search}%")
                  ->orWhere('no_telepon', 'like', "%{$search}%");
            });
        }
        
        // Filter by specialization
        if ($request->filled('spesialisasi') && $request->spesialisasi !== 'all') {
            $query->where('spesialisasi', $request->spesialisasi);
        }
        
        // Sorting
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }
        $dokters = $query->paginate(10)->withQueryString();
        
        return view('dokter.index', compact('dokters'));
    }
    
    /**
     * Show create form
     */
    public function create()
    {
        return view('dokter.create');
    }
    
    /**
     * Store new doctor
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required|string|max:255',
            'spesialisasi' => 'required|string',
            'tarif' => 'required|numeric|min:0',
            'no_sip' => 'required|string|max:50|unique:dokters,no_sip',
            'no_telepon' => 'required|string|max:20',
        ], [
            'nama_dokter.required' => 'Nama Dokter wajib diisi.',
            'spesialisasi.required' => 'Spesialisasi wajib dipilih.',
            'tarif.required' => 'Tarif jasa medis wajib diisi.',
            'tarif.min' => 'Tarif tidak boleh kurang dari 0.',
            'no_sip.required' => 'Nomor SIP wajib diisi.',
            'no_sip.unique' => 'Nomor SIP sudah terdaftar.',
            'no_telepon.required' => 'Nomor Telepon wajib diisi.',
        ]);
        
        Dokter::create([
            'nama_dokter' => $request->nama_dokter,
            'spesialisasi' => $request->spesialisasi,
            'tarif' => $request->tarif,
            'no_sip' => $request->no_sip,
            'no_telepon' => $request->no_telepon,
        ]);
        
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }
    
    /**
     * Show doctor details
     */
    public function show(string $id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('dokter.show', compact('dokter'));
    }
    
    /**
     * Show edit form
     */
    public function edit(string $id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('dokter.edit', compact('dokter'));
    }
    
    /**
     * Update doctor
     */
    public function update(Request $request, string $id)
    {
        $dokter = Dokter::findOrFail($id);
        
        $request->validate([
            'nama_dokter' => 'required|string|max:255',
            'spesialisasi' => 'required|string',
            'tarif' => 'required|numeric|min:0',
            'no_sip' => 'required|string|max:50|unique:dokters,no_sip,' . $dokter->id_dokter . ',id_dokter',
            'no_telepon' => 'required|string|max:20',
        ], [
            'nama_dokter.required' => 'Nama Dokter wajib diisi.',
            'spesialisasi.required' => 'Spesialisasi wajib dipilih.',
            'tarif.required' => 'Tarif jasa medis wajib diisi.',
            'tarif.min' => 'Tarif tidak boleh kurang dari 0.',
            'no_sip.required' => 'Nomor SIP wajib diisi.',
            'no_sip.unique' => 'Nomor SIP sudah terdaftar.',
            'no_telepon.required' => 'Nomor Telepon wajib diisi.',
        ]);
        
        $dokter->update([
            'nama_dokter' => $request->nama_dokter,
            'spesialisasi' => $request->spesialisasi,
            'tarif' => $request->tarif,
            'no_sip' => $request->no_sip,
            'no_telepon' => $request->no_telepon,
        ]);
        
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }
    
    /**
     * Delete doctor
     */
    public function destroy(string $id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();
        
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}
