<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basketballboys extends Model
{
    
	protected $table = 'basketball_boys';

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
        'away_team_first_qrt_score',
        'away_team_second_qrt_score',
        'away_team_third_qrt_score',
        'away_team_fourth_qrt_score',
        'away_team_overtime_score',
        'away_team_final_score',
        'home_team_first_qrt_score',
        'home_team_second_qrt_score',
        'home_team_third_qrt_score',
        'home_team_fourth_qrt_score',
        'home_team_overtime_score',
        'home_team_final_score',
        'game_status',
        'minutes_remaining',
        'seconds_remaining',
        'winning_team',
        'losing_team'

    ];

}
