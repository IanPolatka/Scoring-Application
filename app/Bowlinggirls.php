<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bowlinggirls extends Model
{

	protected $table = 'bowling_girls';

	public function home_team()
    {
    	return $this->belongsTo('App\Team', 'home_team_id');
    }

    public function year()
    {
    	return $this->belongsTo('App\Year');
    }

    public function away_team()
    {
    	return $this->belongsTo('App\Team', 'away_team_id');
    }
    
	protected $fillable = [

        'year_id',
        'team_level',
        'date',
        'scrimmage',
        'tournament_title',
        'away_team_id',
        'home_team_id',
        'time_id',
        'winner',
        'loser',
        'match_score'

    ];

}
