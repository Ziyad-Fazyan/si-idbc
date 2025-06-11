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
        Schema::create('absensi_dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadkul_id')->constrained('jadwal_kuliahs');                   // ID DOSEN
            $table->foreignId('dosen_id')->constrained('dosens');                   // ID DOSEN
            $table->string('image')->nullable();           // BUKTI KEHADIRAN
            $table->string('absen_type')->default('H');    // TYPE ABSEN DOSEN => H = Hadir ; I = Izin ; S = Sakit
            $table->string('code')->unique();              // KODE ABSENSI
            $table->date('absen_date');                    // TANGGAL ABSEN  
            $table->time('absen_time');                    // WAKTU ABSEN
            $table->text('absen_desc')->nullable();        // KETERANGAN ABSEN
            $table->string('mata_kuliah');                 // NAMA MATA KULIAH
            $table->text('deskripsi_materi');              // DESKRIPSI MATERI YANG DIAJARKAN
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_dosens');
    }
};
