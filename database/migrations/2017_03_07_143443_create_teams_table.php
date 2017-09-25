<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_name')->unique();
            $table->string('abbreviated_name')->nullable();
            $table->string('mascot')->nullable();
            $table->string('logo')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->integer('region_baseball')->nullable();
            $table->integer('district_baseball')->nullable();
            $table->integer('region_basketball')->nullable();
            $table->integer('district_basketball')->nullable();
            $table->integer('class_football')->nullable();
            $table->integer('district_football')->nullable();
            $table->integer('region_soccer')->nullable();
            $table->integer('district_soccer')->nullable();
            $table->integer('region_softball')->nullable();
            $table->integer('district_softball')->nullable();
            $table->integer('region_volleyball')->nullable();
            $table->integer('district_volleyball')->nullable();
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
        
        Schema::dropIfExists('teams');

    }
}
