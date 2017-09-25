<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketballGirlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('basketball_girls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year_id');
            $table->integer('team_level');
            $table->date('date');
            $table->integer('scrimmage');
            $table->string('tournament_title')->nullable();
            $table->integer('away_team_id');
            $table->integer('home_team_id');
            $table->integer('time_id');
            $table->integer('district_game');
            $table->integer('away_team_first_qrt_score')->nullable();
            $table->integer('away_team_second_qrt_score')->nullable();
            $table->integer('away_team_third_qrt_score')->nullable();
            $table->integer('away_team_fourth_qrt_score')->nullable();
            $table->integer('away_team_overtime_score')->nullable();
            $table->integer('away_team_final_score')->nullable();
            $table->integer('home_team_first_qrt_score')->nullable();
            $table->integer('home_team_second_qrt_score')->nullable();
            $table->integer('home_team_third_qrt_score')->nullable();
            $table->integer('home_team_fourth_qrt_score')->nullable();
            $table->integer('home_team_overtime_score')->nullable();
            $table->integer('home_team_final_score')->nullable();
            $table->integer('game_status')->nullable();
            $table->string('minutes_remaining')->nullable();
            $table->string('seconds_remaining')->nullable();
            $table->integer('winning_team')->nullable();
            $table->integer('losing_team')->nullable();
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
        
        Schema::dropIfExists('basketball_girls');

    }
}
