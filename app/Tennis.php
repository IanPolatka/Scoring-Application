<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tennis;
use App\Year;
use App\CurrentYear;
use App\Time;

class Tennis extends Model
{

	protected $table = 'tennis';

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
        'date',
        'scrimmage',
        'tournament_title',
        'away_team_id',
        'home_team_id',
        'time_id',
        'boys_winner',
        'boys_match_score',
        'girls_winner',
        'girls_match_score'

    ];

}
