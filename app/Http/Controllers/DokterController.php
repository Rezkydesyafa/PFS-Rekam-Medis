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
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        $allowedSortColumns = ['nama_dokter', 'no_sip', 'spesialisasi', 'created_at'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }
        
        $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');
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
    'tarif' => 'required|numeric|min:0', // <--- Tambahkan validasi ini
    'no_sip' => 'required...',
    'no_telepon' => 'required...',
]);
        
        Dokter::create([
            'nama_dokter' => $request->nama_dokter,
            'spesialisasi' => $request->spesialisasi,
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
    'tarif' => 'required|numeric|min:0', // <--- Tambahkan validasi ini
    'no_sip' => 'required...',
    'no_telepon' => 'required...',
]);
        
        $dokter->update([
            'nama_dokter' => $request->nama_dokter,
            'spesialisasi' => $request->spesialisasi,
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
