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
        Schema::create('products', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->generatedAs('START WITH 1000')->always();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->nullOnDelete();
            $table->foreignId('brand_id')->constrained()->nullOnDelete();
            $table->text('title_description');
            $table->text('main_description');
            $table->json('images')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};