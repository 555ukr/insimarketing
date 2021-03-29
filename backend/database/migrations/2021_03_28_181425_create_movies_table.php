<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('tconst');
            $table->enum('type', ['short', 'movie', 'tvMovie', 'video', 'tvEpisode', 'tvSeries', 'tvShort', 'tvMiniSeries', 'tvSpecial', 'videoGame']);
            $table->string('primaryTitle');
            $table->string('originalTitle');
            $table->boolean('isAdult');
            $table->integer('startYear')->nullable();
            $table->integer('endYear')->nullable();
            $table->integer('runtimeMinutes')->nullable();
            $table->string('genres')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
