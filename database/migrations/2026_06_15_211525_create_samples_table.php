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
        Schema::create('samples', function (Blueprint $table) {

            $table->id();

            $table->foreignId('category_id')
                ->constrained('sample_categories')
                ->cascadeOnDelete();

            $table->string('title');

            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->string('preview_audio');

            $table->string('file_path');

            $table->string('cover')->nullable();

            $table->integer('token_price')
                ->default(1);

            $table->integer('downloads')
                ->default(0);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('samples');
    }
};
