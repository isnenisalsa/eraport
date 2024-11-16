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
        Schema::create('kelas', function (Blueprint $table) {
            $table->string('kode_kelas')->primary();
            $table->unsignedBigInteger('guru_nik');
            $table->string('nama_kelas');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->timestamps();
            $table->foreign('guru_nik')->references('nik')->on('guru')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
