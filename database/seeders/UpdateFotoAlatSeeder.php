<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alat;

class UpdateFotoAlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alat::where('id', 1)->update(['foto' => 'alat/komatsu-dump.jpg']);
        Alat::where('id', 2)->update(['foto' => 'alat/hitachi-exca.jpg']);
        Alat::where('id', 3)->update(['foto' => 'alat/caterpillar-dump.jpg']);
    }
}
