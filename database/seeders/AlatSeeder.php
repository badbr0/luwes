<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alat;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alat::create([
            'merk'        => 'Komatsu',
            'tipe'        => 'dump_truck',
            'tahun'       => 2023,
            'harga_sewa'  => 3000000,
            'kapasitas'   => 25,
            'status'      => 'tersedia',
            'lokasi'      => 'Jakarta',
        ]);

        Alat::create([
            'merk'        => 'Hitachi',
            'tipe'        => 'excavator',
            'tahun'       => 2022,
            'harga_sewa'  => 5000000,
            'kapasitas'   => 20,
            'status'      => 'tersedia',
            'lokasi'      => 'Surabaya',
        ]);

        Alat::create([
            'merk'        => 'Caterpillar',
            'tipe'        => 'dump_truck',
            'tahun'       => 2024,
            'harga_sewa'  => 3500000,
            'kapasitas'   => 30,
            'status'      => 'tersedia',
            'lokasi'      => 'Bandung',
        ]);
    }
}
