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
            $table->decimal("nilai", 5, 2);
            $table->decimal('uts', 5, 2);
            $table->decimal('uas', 5, 2);
            $table->timestamps();
            $table->foreign("pembelajaran_id")->references("id_pembelajaran")->on("pembelajaran")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("siswa_id")->references("id")->on("siswa_kelas")->cascadeOnDelete()->cascadeOnUpdate();
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
