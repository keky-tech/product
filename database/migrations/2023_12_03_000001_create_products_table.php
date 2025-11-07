<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Keky\Product\Enums\Currency;
use Keky\Product\Enums\ProductStatus;
use Keky\Product\Enums\ProductUnit;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ProductStatus::values())->default(ProductStatus::DRAFT());
            $table->string('external_id');
            $table->string('thumbnail')->nullable();

            $table->decimal('price')->nullable();
            $table->decimal('buy_price')->nullable();
            $table->string('sku')->unique()->nullable();
            $table->string('unit')->default(ProductUnit::PIECE());
            $table->string('currency')->default(Currency::XOF());

            $table->decimal('weight', 12)->nullable();
            $table->decimal('height', 12)->nullable();
            $table->decimal('width', 12)->nullable();

            $table->string('type_id')->nullable();
            $table->jsonb('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
