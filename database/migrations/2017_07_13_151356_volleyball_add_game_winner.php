<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VolleyballAddGameWinner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('volleyball', function (Blueprint $table) {
            $table->integer('game_one_winner')->nullable();
            $table->integer('game_two_winner')->nullable();
            $table->integer('game_three_winner')->nullable();
            $table->integer('game_four_winner')->nullable();
            $table->integer('game_five_winner')->nullable();
        });
    }

}
