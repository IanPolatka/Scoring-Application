<?php

namespace App;

class DisabledVeterans extends Model
{

	protected $table = 'disabled_veterans';

	protected $fillable = [

        'first_name',
        'last_name'

    ];

}
