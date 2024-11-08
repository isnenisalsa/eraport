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
        Schema::create('siswa', function (Blueprint $table) {
            $table->unsignedBigInteger("nis")->primary();
            $table->integer("nisn");
            $table->string("nama");
            $table->string("jenis_kelamin");
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->string("alamat");
            $table->string("nama_ayah");
            $table->string("pekerjaan_ayah");
            $table->string("nama_ibu");
            $table->string("pekerjaan_ibu");
            $table->string("username")->nullable();
            $table->string("password")->nullable();
            $table->unsignedBigInteger("kelas_id");
            $table->timestamps();
            $table->foreign("kelas_id")->references('id')->on("kelas");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
