<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('tournament_id')->unsigned();
            $table->bigInteger('home_id')->unsigned();
            $table->bigInteger('away_id')->unsigned();
            $table->string('winner')->nullable();

            $table->foreign('tournament_id')
                ->references('id')
                ->on('tournaments')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('home_id')
                ->references('id')
                ->on('teams')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('away_id')
                ->references('id')
                ->on('teams')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
