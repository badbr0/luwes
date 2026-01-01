<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'alat_id',
        'nama_penyewa',
        'no_hp',
        'tgl_mulai',
        'tgl_selesai',
        'total_hari',
        'total_biaya',
        'status',
    ];

    protected $casts = [
        'tgl_mulai'   => 'date',
        'tgl_selesai' => 'date',
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}