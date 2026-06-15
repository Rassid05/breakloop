<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->enum('role',[
                'admin',
                'artist',
                'listener'
            ])->default('listener');

            $table->integer('token')
                ->default(10);

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('role');
            $table->dropColumn('token');

        });
    }
};
