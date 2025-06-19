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
        Schema::create('ruangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gedung_id')->constrained('gedungs'); // FOREIGN KEY KE TABEL GEDUNG
            $table->integer('type');            // TIPE RUANGAN => 0 = RUANG KELAS ; 1 = RUANG LABORATORIUM ; 2 = RUANG KERJA ; 3 = RUANG PRIBADI ; 4 = FASILITAS UMUM
            $table->integer('floor');           // LANTAI RUANGAN
            $table->string('name');             // NAMA RUANGAN
            $table->string('code')->unique();   // CODE RUANGAN
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangs');
    }
};
