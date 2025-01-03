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
        Schema::create('siswa_kelas', function (Blueprint $table) {
            $table->id();
            $table->string("siswa_id");
            $table->string("kelas_id");
            $table->foreign("siswa_id")->references("nis")->on("siswa")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("kelas_id")->references("kode_kelas")->on("kelas")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_kelas');
    }
};
