<?php

use Illuminate\Database\Seeder;

class FootballTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	$football = new \App\Football([

    		'year_id'	        =>	1,
            'team_level'        => 1,
            'date'              =>  '2017-04-17',
            'scrimmage'         =>  1,
            'tournament_title'  => 'KHSAA State Tournament',
            'away_team_id'      => 4,
            'home_team_id'      => 1,
            'time_id'           => 1,
            'district_game'     => 1

    	]);

    	$football->save();



        $football = new \App\Football([

            'year_id'           =>  1,
            'team_level'        => 1,
            'date'              =>  '2017-04-17',
            'scrimmage'         =>  0,
            'away_team_id'      => 7,
            'home_team_id'      => 2,
            'time_id'           => 1,
            'district_game'     => 0

        ]);

        $football->save();



        $football = new \App\Football([

            'year_id'           =>  1,
            'team_level'        => 1,
            'date'              =>  '2017-04-17',
            'scrimmage'         =>  0,
            'away_team_id'      => 5,
            'home_team_id'      => 4,
            'time_id'           => 1,
            'district_game'     => 0

        ]);

        $football->save();  



        $football = new \App\Football([

            'year_id'           =>  1,
            'team_level'        => 1,
            'date'              =>  '2017-04-17',
            'scrimmage'         =>  0,
            'away_team_id'      => 2,
            'home_team_id'      => 3,
            'time_id'           => 1,
            'district_game'     => 0

        ]);

        $football->save();      

    }
}
