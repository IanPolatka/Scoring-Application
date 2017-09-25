<?php

use Illuminate\Database\Seeder;

class TimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
    	$time = new \App\Time([

    		'time'		=>	'12:00pm'

    	]);

    	$time->save();
    	

    	$time = new \App\Time([

    		'time'		=>	'12:15pm'

    	]);

    	$time->save();


    	$time = new \App\Time([

    		'time'		=>	'12:30pm'

    	]);

    	$time->save();


    	$time = new \App\Time([

    		'time'		=>	'12:45pm'

    	]);

    	$time->save();


    	$time = new \App\Time([

    		'time'		=>	'1:00pm'

    	]);

    	$time->save();


    	$time = new \App\Time([

    		'time'		=>	'1:15pm'

    	]);

    	$time->save();


    	$time = new \App\Time([

    		'time'		=>	'1:30pm'

    	]);

    	$time->save();

    }
}
