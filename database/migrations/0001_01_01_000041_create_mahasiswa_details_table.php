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
        Schema::create('mahasiswa_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->string('mhs_birthplace')->nullable();
            $table->date('mhs_birthdate')->nullable();
            $table->string('mhs_reli')->nullable();
            $table->string('mhs_addr_domisili')->nullable();
            $table->string('mhs_addr_kelurahan')->nullable();
            $table->string('mhs_addr_kecamatan')->nullable();
            $table->string('mhs_addr_kota')->nullable();
            $table->string('mhs_addr_provinsi')->nullable();            // DATA ORANG TUA / WALI
            $table->string('mhs_parent_mother')->nullable();
            $table->string('mhs_parent_father')->nullable();
            $table->string('mhs_parent_mother_phone')->nullable();
            $table->string('mhs_parent_father_phone')->nullable();
            $table->string('mhs_wali_name')->nullable();
            $table->string('mhs_wali_phone')->nullable();
            $table->string('mhs_biometric')->nullable(); // misal link atau path data biometrik
            $table->integer('mhs_iq')->nullable(); // IQ dalam angka
            $table->integer('mhs_logic')->nullable(); // Tes logika
            $table->string('mhs_riwayat_kesehatan')->nullable(); // keterangan teks
            $table->string('mhs_goldar', 3)->nullable(); // misal: A, B, O, AB
            $table->float('mhs_tinggi_badan')->nullable(); // cm
            $table->float('mhs_berat_badan')->nullable(); // kg
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_details');
    }
};
