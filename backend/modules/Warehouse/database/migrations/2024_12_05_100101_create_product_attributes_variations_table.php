<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*Schema::create('product_attributes_combo', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->generatedAs()->always();
            $table->foreignId('attribute_1_id')->nullable()->constrained('product_attributes')->nullOnDelete();
            $table->foreignId('attribute_2_id')->nullable()->constrained('product_attributes')->nullOnDelete();
            $table->foreignId('attribute_3_id')->nullable()->constrained('product_attributes')->nullOnDelete();
            $table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity')->nullable();
            $table->decimal('price_in_cents')->nullable();
            $table->primary('id');
        });*/

        Schema::create('product_variations', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->generatedAs()->always()->primary();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->integer('quantity')->default(0);
            $table->decimal('price_in_cents')->nullable();
            $table->timestamps();
        });

        Schema::create('variation_attribute_values', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->generatedAs()->always()->primary();
            $table->foreignId('variation_id')->constrained('product_variations')->cascadeOnDelete();
            $table->foreignId('attribute_id')->constrained('product_attributes')->cascadeOnDelete();
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes_combo');
    }
};