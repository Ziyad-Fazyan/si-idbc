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
        Schema::create('jadwal_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('makul_id')->constrained('mata_kuliahs');            // ID MATA KULIAH
            $table->foreignId('kelas_id')->constrained('kelas');            // ID KELAS
            $table->foreignId('dosen_id')->constrained('dosens');            // ID DOSEN
            $table->foreignId('ruang_id')->constrained('ruangs');            // ID RUANGAN
            $table->integer('days_id');             // ID HARI
            $table->time('start');                  // WAKTU MULAI PERKULIAHAN
            $table->time('ended');                  // WAKTU SELESAI PERKULIAHAN
            $table->string('code')->unique();       // CODE JADWAL KULIAH
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kuliahs');
    }
};
