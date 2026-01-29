<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    public function show(Alat $alat)
    {
        return view('sewa.form', compact('alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'no_hp'     => 'required|string|max:20',
            'tgl_mulai' => 'required|date|after_or_equal:today',
            'tgl_sewa'  => 'required|date|after:tgl_mulai',
            'alat_id'   => 'required|exists:alats,id',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        // Cek konflik tanggal: HANYA PESANAN DITERIMA
        $conflict = Pesanan::where('alat_id', $alat->id)
            ->where('status', 'diterima')
            ->where('tgl_mulai', '<=', $request->tgl_sewa)
            ->where('tgl_selesai', '>=', $request->tgl_mulai)
            ->exists();

        if ($conflict) {
            return back()->with('error', 'Tanggal tersebut sudah dibooking.');
        }

        //Hitung biaya
        $mulai   = \Carbon\Carbon::parse($request->tgl_mulai);
        $selesai = \Carbon\Carbon::parse($request->tgl_sewa);
        $hari    = $mulai->diffInDays($selesai) + 1;
        $total   = $hari * $alat->harga_sewa;

        // Simpan pesanan
        Pesanan::create([
            'alat_id'      => $alat->id,
            'nama_penyewa' => $request->nama,
            'no_hp'        => $request->no_hp,
            'tgl_mulai'    => $mulai,
            'tgl_selesai'  => $selesai,
            'total_hari'   => $hari,
            'total_biaya'  => $total,
            'status'       => 'pending',
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Permintaan sewa diterima. Menunggu konfirmasi admin.');
    }
}
