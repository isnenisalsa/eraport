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
            $table->id("nis");
            $table->string("nisn");
            $table->string("nama");
            $table->string("status")->default('Aktif');
            $table->string("pedidikan_terakhir");
            $table->string("jenis_kelamin");
            $table->string("agama");
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->string("alamat");
            $table->string("jalan")->nullable();
            $table->string("kelurahan")->nullable();
            $table->string("kecamatan")->nullable();
            $table->string("kota")->nullable();
            $table->string("provinsi")->nullable();
            $table->string("nama_ayah")->nullable();
            $table->string("pekerjaan_ayah")->nullable();
            $table->string("no_telp_ayah")->nullable();
            $table->string("nama_ibu")->nullable();
            $table->string("pekerjaan_ibu")->nullable();
            $table->string("no_telp_ibu")->nullable();
            $table->string("nama_wali")->nullable();
            $table->string("pekerjaan_wali")->nullable();
            $table->string("no_telp_wali")->nullable();
            $table->string("alamat_wali")->nullable();
            $table->string("username")->nullable();
            $table->string("password")->nullable();
            $table->timestamps();
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
