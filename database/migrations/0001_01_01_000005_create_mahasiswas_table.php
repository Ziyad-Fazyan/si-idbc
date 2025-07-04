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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            // KONEK MODEL
            $table->foreignId('taka_id')->nullable()->constrained('tahun_akademiks');
            $table->foreignId('year_id')->nullable()->constrained('tahun_akademiks');
            // DATA PRIBADI
            $table->integer('mhs_stat')->default(0);
            $table->string('mhs_nim')->unique()->nullable();
            $table->string('mhs_name');
            $table->string('mhs_code')->unique();
            $table->string('mhs_image')->default('default/default-profile.jpg');
            $table->string('mhs_gend')->nullable(); // Value L = Laki-laki ; P = Perempuan

            // DATA AKUN
            $table->string('mhs_user')->unique();
            $table->string('password');
            $table->string('mhs_mail')->unique();
            $table->string('mhs_phone')->unique();

            // VERIFIED TOKEN
            $table->string('verify_token')->nullable();
            $table->string('face_token')->nullable();
            $table->json('face_embedding')->nullable();
            $table->timestamp('token_created_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
