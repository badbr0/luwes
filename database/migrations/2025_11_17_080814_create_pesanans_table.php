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
        Schema::create('pesanans', function (Blueprint $table) {
           $table->id();
            $table->foreignId('alat_id')->constrained()->cascadeOnDelete();
            $table->string('nama_penyewa');
            $table->string('no_hp');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->integer('total_hari');
            $table->bigInteger('total_biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
