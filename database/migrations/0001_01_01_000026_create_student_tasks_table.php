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
        Schema::create('student_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained('dosens');
            $table->foreignId('jadkul_id')->constrained('jadwal_kuliahs');
            $table->string('code');
            $table->string('title');
            $table->longText('detail_task');
            $table->date('exp_date');
            $table->time('exp_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_tasks');
    }
};
