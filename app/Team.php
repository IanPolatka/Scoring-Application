<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    
	protected $fillable = [

		'school_name',
		'abbreviated_name',
		'mascot',
		'logo',
		'state',
		'city',
		'region_baseball',
		'district_baseball',
		'region_basketball',
		'district_basketball',
		'class_football',
		'district_football',
		'region_soccer',
		'district_soccer',
		'region_volleyball',
		'district_volleyball'

	];


	public function scopeFilter($query, $filters)
	{

		if ($schoolname = $filters['schoolname']) {

				$query->where('school_name', 'like', $schoolname . '%')->get();

		}	

	}


}
