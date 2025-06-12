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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taka_id')->constrained('tahun_akademiks');  // Tahun Akademik ID
            $table->foreignId('pstudi_id')->constrained('program_studis'); // Program Studi
            $table->foreignId('proku_id')->constrained('program_kuliahs'); // Program Studi
            $table->foreignId('dosen_id')->constrained('dosens'); // Program Studi
            $table->integer('capacity')->nullable();    // Kapasitas Mahasiswa 
            $table->string('name');                     // Nama Kelas
            $table->string('code')->unique();           // Kode Kelas => Jurusan-Tahun-Proku-Semester(A-Z)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
