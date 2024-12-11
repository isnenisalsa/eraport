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
            $table->unsignedBigInteger('capel_id')->nullable();
            $table->string("nilai")->default('0');
            $table->string('rata_rata_capel')->default('0');
            $table->string('uts')->default('0');
            $table->string('uas')->default('0');
            $table->string('rata_rata_uts_uas')->default('0');
            $table->string('nilai_rapor')->default('0');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->timestamps();
            $table->foreign("pembelajaran_id")->references("id_pembelajaran")->on("pembelajaran")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("siswa_id")->references("id")->on("siswa_kelas")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("capel_id")->references("id")->on("capel")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("tahun_ajaran_id")->references("id")->on("tahun_ajaran")->cascadeOnDelete()->cascadeOnUpdate();
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
