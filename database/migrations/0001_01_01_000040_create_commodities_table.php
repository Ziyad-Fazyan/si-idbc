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
        Schema::create('commodities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruang_id')->constrained();
            $table->foreignId('commodity_acquisition_id')->constrained()->nullable();
            $table->string('item_code')->unique();
            $table->string('name');
            $table->string('brand');
            $table->string('material');
            $table->bigInteger('year_of_purchase');
            $table->tinyInteger('condition');
            $table->bigInteger('quantity');
            $table->bigInteger('price');
            $table->bigInteger('price_per_item');
            $table->longText('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commodities');
    }
};
