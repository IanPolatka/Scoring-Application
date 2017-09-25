<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crosscountry extends Model
{
    
	protected $table = 'cross_country';

    public function year()
    {
    	return $this->belongsTo('App\Year');
    }

    public function currentyear()
    {
        return $this->belongsTo('App\CurrentYear', 'year_id');
    }

    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    public function host()
    {
        return $this->belongsTo('App\Team', 'host_id');
    }
    
	protected $fillable = [

        'team_id',
        'year_id',
        'team_level',
        'date',
        'scrimmage',
        'tournament_title',
        'host_id',
        'meet_location',
        'time_id',
        'boys_result',
        'girls_result'

    ];

}
