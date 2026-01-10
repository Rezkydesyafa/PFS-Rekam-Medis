<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of obat with search, filter, and sort.
     */
    public function index(Request $request)
    {
        $query = Obat::query();
        
        // Search by nama obat atau kode obat
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_obat', 'like', "%{$search}%")
                  ->orWhere('kode_obat', 'like', "%{$search}%");
            });
        }
        
        // Filter by satuan
        if ($request->filled('satuan')) {
            $query->where('satuan', $request->satuan);
        }
        
        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        $allowedSortColumns = ['nama_obat', 'kode_obat', 'stok', 'harga', 'tanggal_kadaluarsa', 'created_at'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }
        
        $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');
        $obats = $query->paginate(10)->withQueryString();
        
        return view('obat.index', compact('obats'));
    }

    /**
     * Show the form for creating a new obat.
     */
    public function create()
    {
        return view('obat.create');
    }

    /**
     * Store a newly created obat in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kode_obat' => 'required|string|max:50|unique:obats,kode_obat',
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'tanggal_kadaluarsa' => 'required|date|after:today',
        ]);

        Obat::create([
            'kode_obat' => $request->kode_obat,
            'nama_obat' => $request->nama_obat,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
        ]);

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil ditambahkan.');
    }

    /**
     * Display the specified obat.
     */
    public function show(string $id)
    {
        $obat = Obat::findOrFail($id);
        return view('obat.show', compact('obat'));
    }

    /**
     * Show the form for editing the specified obat.
     */
    public function edit(string $id)
    {
        $obat = Obat::findOrFail($id);
        return view('obat.edit', compact('obat'));
    }

    /**
     * Update the specified obat in storage.
     */
    public function update(Request $request, string $id)
    {
        $obat = Obat::findOrFail($id);
        
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kode_obat' => 'required|string|max:50|unique:obats,kode_obat,' . $obat->id_obat . ',id_obat',
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

        $obat->update([
            'kode_obat' => $request->kode_obat,
            'nama_obat' => $request->nama_obat,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
        ]);

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil diperbarui.');
    }

    /**
     * Remove the specified obat from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil dihapus.');
    }
}
