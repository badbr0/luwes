<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{

    public function index(Request $request)
    {
        $pesanans = Pesanan::with('alat')
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load('alat');
        return view('admin.pesanan.show', compact('pesanan'));
    }

    // upgrade updateStatus()
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,selesai',
        ]);

        $statusBaru = $request->status;
        $alat = $pesanan->alat;

        // GUARD: jangan nerima pesanan kalau alat sudah disewa
        if ($statusBaru === 'diterima' && $alat->status === 'disewa') {
            return back()->with('error', 'Alat sedang disewa, tidak bisa diterima.');
        }

        if ($statusBaru === 'selesai' && $pesanan->status !== 'diterima') {
            return back()->with('error', 'Pesanan harus diterima dulu sebelum diselesaikan.');
        }

        // UPDATE STATUS PESANAN
        $pesanan->update(['status' => $statusBaru]);

        // SIDE EFFECT KE ALAT
        if ($statusBaru === 'diterima') {
            $alat->update(['status' => 'disewa']);
        }

        if ($statusBaru === 'selesai') {
            $alat->update(['status' => 'tersedia']);
        }

        return redirect()
            ->route('admin.pesanan.index')
            ->with('success', 'Status pesanan berhasil diupdate!');
    }
}
