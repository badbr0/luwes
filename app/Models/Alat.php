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

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function activePesanans()
    {
        return $this->pesanans->whereIn('status', ['pending', 'diterima']);
    }

    public function hasPending()
    {
        return $this->activePesanans()->where('status', 'pending')->count() > 0;
    }

    public function hasDiterima()
    {
        return $this->activePesanans()->where('status', 'diterima')->count() > 0;
    }
}
