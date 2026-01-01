<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class FrontendAlatController extends Controller
{
    public function index()
    {
        $alats = Alat::all();
        return view('home', compact('alats'));
    }
}