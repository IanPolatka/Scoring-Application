<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Softball extends Model
{
    
	protected $table = 'softball';

    public function year()
    {
    	return $this->belongsTo('App\Year');
    }

    public function home_team()
    {
    	return $this->belongsTo('App\Team', 'home_team_id');
    }

    public function away_team()
    {
    	return $this->belongsTo('App\Team', 'away_team_id');
    }

    public function currentyear()
    {
        return $this->belongsTo('App\CurrentYear', 'year_id');
    }
    
	protected $fillable = [

        'year_id',
        'date',
        'team_level',
        'scrimmage',
        'tournament_title',
        'away_team_id',
        'home_team_id',
        'time_id',
        'district_game',
        'away_team_first_inning_score',
        'away_team_second_inning_score',
        'away_team_third_inning_score',
        'away_team_fourth_inning_score',
        'away_team_fifth_inning_score',
        'away_team_sixth_inning_score',
        'away_team_seventh_inning_score',
        'away_team_extra_inning_score',
        'away_team_final_score',
        'home_team_first_inning_score',
        'home_team_second_inning_score',
        'home_team_third_inning_score',
        'home_team_fourth_inning_score',
        'home_team_fifth_inning_score',
        'home_team_sixth_inning_score',
        'home_team_seventh_inning_score',
        'home_team_extra_inning_score',
        'home_team_final_score',
        'game_status',
        'at_bat',
        'winning_team',
        'losing_team'

    ];

}
