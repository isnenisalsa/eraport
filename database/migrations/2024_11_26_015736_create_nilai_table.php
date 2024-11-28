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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->string("pembelajaran_id");
            $table->unsignedBigInteger("siswa_id");
            $table->unsignedBigInteger('tupel_id')->nullable();
            $table->string("nilai")->default('0');
            $table->string('uts')->default('0');
            $table->string('uas')->default('0');
            $table->timestamps();
            $table->foreign("pembelajaran_id")->references("id_pembelajaran")->on("pembelajaran")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("siswa_id")->references("id")->on("siswa_kelas")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("tupel_id")->references("id")->on("tupel")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
