<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Year;

class CurrentYear extends Model
{
    
	protected $table = 'current_year';

	protected $fillable = ['year_id'];

}
