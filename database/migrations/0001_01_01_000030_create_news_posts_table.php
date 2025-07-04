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
        Schema::create('news_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('news_categories');                     // KATEGORI ID
            $table->foreignId('author_id')->default(0)->constrained('users');                     // KATEGORI ID
            $table->string('name');                             // JUDUL POSTINGAN
            $table->string('code')->unique();                   // KODE POSTINGAN
            $table->string('slug');                             // SLUG POSTINGAN
            $table->string('image');                            // FEATURED IMAGE
            $table->longText('content');                        // ISI KONTEN
            $table->string('keywords');                         // KEYWORDS
            $table->string('metadesc');                         // META DESKRIPSI
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_posts');
    }
};
