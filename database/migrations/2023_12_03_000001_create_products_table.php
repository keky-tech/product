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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'published', 'rejected'])->default('draft');
            $table->string('external_id');
            $table->string('thumbnail')->nullable();

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
