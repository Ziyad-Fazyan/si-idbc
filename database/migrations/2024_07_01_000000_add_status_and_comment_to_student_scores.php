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
        Schema::table('student_scores', function (Blueprint $table) {
            if (!Schema::hasColumn('student_scores', 'status')) {
                $table->string('status')->default('Terkumpul')->after('file_8');  // Status tugas: Terkumpul, Sudah dinilai
            }
            
            if (!Schema::hasColumn('student_scores', 'comment')) {
                $table->string('comment')->nullable()->after('status');  // Komentar dosen
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_scores', function (Blueprint $table) {
            if (Schema::hasColumn('student_scores', 'status')) {
                $table->dropColumn('status');
            }
            
            if (Schema::hasColumn('student_scores', 'comment')) {
                $table->dropColumn('comment');
            }
        });
    }
};