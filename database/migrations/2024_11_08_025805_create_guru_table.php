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
            $table->id();
            $table->string("nik");
            $table->string("nama");
            $table->string("tempat_lahir");
            $table->string("tanggal_lahir");
            $table->string("jenis_kelamin");
            $table->string("nama_ibu_kandung");
            $table->string("agama");
            $table->string("status_perkawinan");
            $table->string("email");
            $table->string("username")->default(nama);
            $table->string("password");
            $table->unsignedBigInteger("roles_id");
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
