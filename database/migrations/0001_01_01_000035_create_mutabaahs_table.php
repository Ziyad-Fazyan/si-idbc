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
        Schema::create('mutabaahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->date('tanggal');
            $table->json('data'); // data mutabaah disimpan dalam JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutabaahs');
    }
};
