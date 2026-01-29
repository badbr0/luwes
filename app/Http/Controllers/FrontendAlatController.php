<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class FrontendAlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with(['pesanans' => function ($q) {
            $q->where('status', 'diterima')
                ->orderBy('tgl_mulai');
        }])->get();

        return view('home', compact('alats'));
    }
}
