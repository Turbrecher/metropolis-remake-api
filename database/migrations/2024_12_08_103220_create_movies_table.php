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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->unique;
            $table->longText('synopsis');
            $table->longText('actors');
            $table->longText('directors');
            $table->integer('duration');
            $table->string('releaseDate');
            $table->longText('genres');
            $table->string('pegi');
            $table->string('portrait');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
