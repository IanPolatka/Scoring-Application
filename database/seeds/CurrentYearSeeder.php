<?php

use Illuminate\Database\Seeder;

class CurrentYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	$currentyear = new \App\CurrentYear([

    		'year_id'	=>	1

    	]);

    	$currentyear->save();

    }
}
