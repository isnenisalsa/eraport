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
        Schema::create('eskul', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_nik')->index();
            $table->string('nama_eskul', 30);
            $table->string('tempat', 45);
            $table->timestamps();
            $table->foreign('guru_nik')->references('nik')->on('guru')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eskul');
    }
};
