<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	$team = new \App\Team([

    		'school_name'		=>	'Campbell County',
    		'mascot'			=>	'Camels',
    		'state'				=>	'KY',
    		'city'				=>	'Alexandria',
    		'region_baseball'	=>	10

    	]);

    	$team->save();

    	$team = new \App\Team([

    		'school_name'		=>	'Ryle',
    		'mascot'			=>	'Raiders',
    		'state'				=>	'KY',
    		'city'				=>	'Union',
    		'region_baseball'	=>	10

    	]);

    	$team->save();

    	$team = new \App\Team([

    		'school_name'		=>	'Dixie Heights',
    		'mascot'			=>	'Colonels',
    		'state'				=>	'KY',
    		'city'				=>	'Erlanger',
    		'region_baseball'	=>	9

    	]);

    	$team->save();

    	$team = new \App\Team([

    		'school_name'		=>	'Boone County',
    		'mascot'			=>	'Rebels',
    		'state'				=>	'KY',
    		'city'				=>	'Florence',
    		'region_baseball'	=>	9

    	]);

    	$team->save();

    	$team = new \App\Team([

    		'school_name'		=>	'Holmes',
    		'mascot'			=>	'Bulldogs',
    		'state'				=>	'KY',
    		'city'				=>	'Covington',
    		'region_baseball'	=>	10

    	]);

    	$team->save();

    	$team = new \App\Team([

    		'school_name'		=>	'Highlands',
    		'mascot'			=>	'Bluebirds',
    		'state'				=>	'KY',
    		'city'				=>	'Fort Thomas',
    		'region_baseball'	=>	9

    	]);

    	$team->save();

    	$team = new \App\Team([

    		'school_name'		=>	'Pendleton County',
    		'mascot'			=>	'Wildcats',
    		'state'				=>	'KY',
    		'city'				=>	'Falmouth',
    		'region_baseball'	=>	10

    	]);

    	$team->save();

    	$team = new \App\Team([

    		'school_name'		=>	'Simon Kenton',
    		'mascot'			=>	'Pioneers',
    		'state'				=>	'KY',
    		'city'				=>	'Independence',
    		'region_baseball'	=>	9

    	]);

    	$team->save();

    }
}
