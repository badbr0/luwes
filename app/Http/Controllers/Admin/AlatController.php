<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::all();
        return view('admin.alat.index', compact('alats'));
    }

    public function create()
    {
        return view('admin.alat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'merk' => 'required|string|max:255',
            'tipe' => 'required|in:dump_truck,excavator',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'harga_sewa' => 'required|integer|min:100000',
            'kapasitas' => 'nullable|integer',
            'lokasi' => 'nullable|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('alat', 'public');
            $validated['foto'] = $path;
        }

        $validated['status'] = 'tersedia'; // default

        Alat::create($validated);

        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function show(Alat $alat)
    {
        // Ga wajib, tapi biar ga error kalau ada route show
        return abort(404);
    }

    public function edit(Alat $alat)  // ← INI YANG SERING KURANG!
    {
        return view('admin.alat.edit', compact('alat'));
    }

    public function update(Request $request, Alat $alat)
    {
        $validated = $request->validate([
            'merk' => 'required|string|max:255',
            'tipe' => 'required|in:dump_truck,excavator',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'harga_sewa' => 'required|integer|min:100000',
            'kapasitas' => 'nullable|integer',
            'lokasi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($alat->foto) {
                Storage::disk('public')->delete($alat->foto);
            }
            $path = $request->file('foto')->store('alat', 'public');
            $validated['foto'] = $path;
        }

        $alat->update($validated);

        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil diupdate!');
    }

    public function destroy(Alat $alat)
    {
        if ($alat->foto) {
            Storage::disk('public')->delete($alat->foto);
        }
        $alat->delete();
        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil dihapus!');
    }
}