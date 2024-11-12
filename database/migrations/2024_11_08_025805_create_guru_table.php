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
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->string("jenis_kelamin");
            $table->string("nama_ibu");
            $table->string("agama");
            $table->string("status_perkawinan");
            $table->string("jabatan");
            $table->string("status");
            $table->string("pendidikan_terakhir");
            $table->integer("no_telp");
            $table->string("email");
            $table->string("username")->nullable();
            $table->string("password")->nullable();
            $table->unsignedBigInteger("roles_id")->nullable();
            $table->timestamps();
            $table->foreign("roles_id")->references("id")->on("roles")->cascadeOnDelete()->cascadeOnUpdate();
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
