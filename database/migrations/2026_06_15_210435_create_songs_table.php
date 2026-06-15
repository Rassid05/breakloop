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
        Schema::create('songs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('artist_id')
                ->constrained('artist_profiles')
                ->cascadeOnDelete();

            $table->foreignId('album_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('genre_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');

            $table->string('slug')->unique();

            $table->string('audio_file');

            $table->string('cover')->nullable();

            $table->integer('duration')->default(0);

            $table->bigInteger('plays')->default(0);

            $table->boolean('is_premium')->default(false);

            $table->enum('status',[
                'pending',
                'published',
                'rejected'
            ])->default('pending');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
