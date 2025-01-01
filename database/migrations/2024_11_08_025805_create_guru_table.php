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
        Schema::create('guru', function (Blueprint $table) {
            $table->id("nik");
            $table->string("nama");
            $table->string('nip')->nullable();
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->string("jenis_kelamin");
            $table->string("nama_ibu");
            $table->string("agama");
            $table->string("alamat");
            $table->string("status_perkawinan");
            $table->string("jabatan");
            $table->string("status")->default('Aktif');
            $table->string("pendidikan_terakhir");
            $table->string("no_telp");
            $table->string("email");
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
        Schema::dropIfExists('guru');
    }
};
