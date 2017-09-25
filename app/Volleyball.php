<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volleyball extends Model
{
    
	protected $table = 'volleyball';

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
        'away_team_first_game_score',
        'away_team_second_game_score',
        'away_team_third_game_score',
        'away_team_fourth_game_score',
        'away_team_fifth_game_score',
        'home_team_first_game_score',
        'home_team_second_game_score',
        'home_team_third_game_score',
        'home_team_fourth_game_score',
        'home_team_fifth_game_score',
        'game_one_winner',
        'game_two_winner',
        'game_three_winner',
        'game_four_winner',
        'game_five_winner',
        'game_status',
        'winning_team',
        'losing_team'

    ];

}
