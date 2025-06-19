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
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuri_id')->constrained('kurikulums');                 // ID Kurikulum
            $table->foreignId('taka_id')->constrained('tahun_akademiks');                 // ID Tahun Akademik
            $table->foreignId('pstudi_id')->constrained('program_studis');               // ID Program Studi
            $table->foreignId('dosen_1')->constrained('dosens');                 // Dosen Utama
            $table->foreignId('dosen_2')->nullable()->constrained('dosens');     // Dosen Cadangan 1
            $table->foreignId('dosen_3')->nullable()->constrained('dosens');     // Dosen Cadangan 2
            $table->string('name');                     // Nama Mata Kuliah
            $table->string('code')->unique();           // Kode Mata Kuliah
            $table->longText('desc');                   // Deskripsi Mata Kuliah
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliahs');
    }
};
