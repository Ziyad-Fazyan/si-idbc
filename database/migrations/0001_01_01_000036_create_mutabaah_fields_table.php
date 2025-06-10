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
        Schema::create('mutabaah_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name')->unique();
            $table->string('label');
            $table->string('field_type'); // contoh: boolean, text, integer
            $table->json('options')->nullable(); // kalau ada pilihan opsional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutabaah_fields');
    }
};
