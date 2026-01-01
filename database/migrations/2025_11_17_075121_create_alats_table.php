<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->string('tipe'); // dump_truck atau excavator
            $table->year('tahun');
            $table->bigInteger('harga_sewa');
            $table->integer('kapasitas')->nullable(); // ton
            $table->string('foto')->nullable();
            $table->enum('status', ['tersedia', 'disewa'])->default('tersedia');
            $table->string('lokasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
