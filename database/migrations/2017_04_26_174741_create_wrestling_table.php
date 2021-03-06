<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWrestlingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('wrestling', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id');
            $table->integer('team_level');
            $table->integer('year_id');
            $table->date('date');
            $table->integer('scrimmage');
            $table->string('tournament_title')->nullable();
            $table->integer('time_id');
            $table->string('result')->nullable();
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
        
        Schema::dropIfExists('wrestling');

    }
}
