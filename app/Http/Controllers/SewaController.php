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
            'nama'        => 'required|string|max:255',
            'no_hp'       => 'required|string|max:20',
            'tgl_mulai'   => 'required|date|after_or_equal:today',
            'tgl_sewa'    => 'required|date|after:tgl_mulai',
            'alat_id'     => 'required|exists:alats,id',
        ]);

        $alat      = Alat::find($request->alat_id);
        $mulai     = \Carbon\Carbon::parse($request->tgl_mulai);
        $selesai   = \Carbon\Carbon::parse($request->tgl_sewa);
        $hari      = $mulai->diffInDays($selesai) + 1;
        $total     = $hari * $alat->harga_sewa;

        Pesanan::create([
            'alat_id'      => $alat->id,
            'nama_penyewa' => $request->nama,
            'no_hp'        => $request->no_hp,
            'tgl_mulai'    => $request->tgl_mulai,
            'tgl_selesai'  => $request->tgl_sewa,
            'total_hari'   => $hari,
            'total_biaya'  => $total,
        ]);

        return redirect()->route('home')->with('success', 'Pemesanan berhasil! Kami akan hubungi Anda segera.');
    }
}
