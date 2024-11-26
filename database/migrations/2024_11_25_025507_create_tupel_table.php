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
        Schema::create('tupel', function (Blueprint $table) {
            $table->id();
            $table->string('pembelajaran_id');
            $table->string('nama_tupel');
            $table->foreign('pembelajaran_id')->references('id_pembelajaran')->on('pembelajaran')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tupel');
    }
};
