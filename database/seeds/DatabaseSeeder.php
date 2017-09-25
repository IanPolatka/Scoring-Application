<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(YearsTableSeeder::class);
        $this->call(CurrentYearSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(TimesTableSeeder::class);
        $this->call(FootballTableSeeder::class);
    
    }
}
