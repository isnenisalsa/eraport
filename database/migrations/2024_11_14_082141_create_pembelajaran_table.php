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
        Schema::create('pembelajaran', function (Blueprint $table) {
            $table->string('id_pembelajaran')->primary();
            $table->string('mata_pelajaran');
            $table->string('nama_kelas');
            $table->unsignedBigInteger('nama_guru');
            $table->timestamps();
            $table->foreign('mata_pelajaran')->references('kode_mapel')->on('mapel')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('nama_kelas')->references('kode_kelas')->on('kelas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('nama_guru')->references('nik')->on('guru')->cascadeOnDelete()->cascadeOnUpdate();
            
           
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelajaran');
    }
};
