<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'merk',
        'tipe',
        'tahun',
        'harga_sewa',
        'kapasitas',
        'status',
        'lokasi',
        'foto', // nanti buat upload foto
    ];
}
