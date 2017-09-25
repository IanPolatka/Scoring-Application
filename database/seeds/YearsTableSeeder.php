<?php

use Illuminate\Database\Seeder;

class YearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	$year = new \App\Year([

    		'year'	=>	'1900-1901'

    	]);

    	$year->save();

        $year = new \App\Year([

            'year'  =>  '1901-1902'

        ]);

        $year->save();

        $year = new \App\Year([

            'year'  =>  '1902-1903'

        ]);

        $year->save();

        $year = new \App\Year([

            'year'  =>  '1903-1904'

        ]);

        $year->save();

        $year = new \App\Year([

            'year'  =>  '1904-1905'

        ]);

        $year->save();

        $year = new \App\Year([

            'year'  =>  '1905-1906'

        ]);

        $year->save();

        $year = new \App\Year([

            'year'  =>  '1906-1907'

        ]);

        $year->save();

        $year = new \App\Year([

            'year'  =>  '1907-1908'

        ]);

        $year->save();

    }
}
