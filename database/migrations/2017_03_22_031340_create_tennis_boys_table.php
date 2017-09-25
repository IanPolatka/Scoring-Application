<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTennisBoysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('tennis_boys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year_id');
            $table->integer('team_level');
            $table->date('date');
            $table->integer('scrimmage');
            $table->string('tournament_title')->nullable();
            $table->integer('away_team_id');
            $table->integer('home_team_id');
            $table->integer('time_id');
            $table->integer('winner')->nullable();
            $table->integer('loser')->nullable();
            $table->string('match_score')->nullable();
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
        
        Schema::dropIfExists('tennis_boys');

    }
}
