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
        Schema::create('student_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stask_id')->constrained('student_tasks');
            $table->foreignId('student_id')->constrained('mahasiswas');
            $table->foreignId('dosen_id')->nullable()->constrained('dosens');
            $table->integer('score',)->nullable();
            $table->longText('desc');
            $table->string('file_1')->nullable();
            $table->string('file_2')->nullable();
            $table->string('file_3')->nullable();
            $table->string('file_4')->nullable();
            $table->string('file_5')->nullable();
            $table->string('file_6')->nullable();
            $table->string('file_7')->nullable();
            $table->string('file_8')->nullable();
            $table->string('status')->default('Terkumpul');        // Status tugas: Terkumpul, Sudah dinilai
            $table->string('comment')->nullable();                 // Komentar dosen
            $table->string('code', 6);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_scores');
    }
};
