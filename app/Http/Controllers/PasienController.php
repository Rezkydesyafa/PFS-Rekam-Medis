<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $query = Pasien::query();

        // Search by name, NIK, or No. RM
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('no_rm', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Sorting
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $pasiens = $query->paginate(10)->withQueryString();
        
        return view('pasien.index', compact('pasiens'));
    }

    /**
     * Create pasien
     */
    public function create()
    {
        return view('pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:pasiens,nik',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'email' => 'nullable|email',
        ], [
            'name.required' => 'Nama Pasien wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar dalam sistem.',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Pilihan Jenis Kelamin tidak valid.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'email.email' => 'Format email tidak valid (contoh: user@mail.com).',
        ]);

        // Generate No RM Otomatis (Format: RM-YYYY-XXXX)
        $year = date('Y');
        $lastPasien = Pasien::where('no_rm', 'like', "RM-$year-%")->orderBy('no_rm', 'desc')->first();
        
        if ($lastPasien) {
            $lastNumber = intval(substr($lastPasien->no_rm, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        $no_rm = 'RM-' . $year . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        Pasien::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'no_rm' => $no_rm,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'gol_darah' => $request->gol_darah,
            'status_nikah' => $request->status_nikah,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'status' => 'active',
        ]);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    /**
     * Show the specified pasien.
     */
    public function show(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.show', compact('pasien'));
    }

    /**
     * Show the form for editing the specified pasien.
     */
    public function edit(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified pasien.
     */
    public function update(Request $request, string $id)
    {
        $pasien = Pasien::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:pasiens,nik,' . $pasien->id_pasien . ',id_pasien',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'email' => 'nullable|email',
            'status' => 'required|in:active,inactive,pending',
        ]);

        $pasien->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'gol_darah' => $request->gol_darah,
            'status_nikah' => $request->status_nikah,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'status' => $request->status,
        ]);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}
