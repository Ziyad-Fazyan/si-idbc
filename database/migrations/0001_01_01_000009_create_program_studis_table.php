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
        Schema::create('program_studis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faku_id')->constrained('fakultas');  // ID Fakultas
            $table->foreignId('head_id')->constrained('dosens');  // Kepala Program Studi
            $table->string('name');      // Nama Program Studi
            $table->string('cnim')->unique()->nullable();      // Kode Nomor Induk Mahasiswa
            $table->string('code')->unique();      // Kode Program Studi
            $table->string('slug')->unique();      // Slug Program Studi
            $table->string('title')->nullable();     // Gelar Program Studi
            $table->string('level')->nullable();     // Jenjang Program Studi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_studis');
    }
};
