<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CurrentYear;
use App\Year;
use Session;

use DB;


class CurrentyearController extends Controller
{

	public function __construct() 
	{
	  $this->middleware('auth', ['except' => ['showcurrentyear']]);
	}

	public function index()
	{

		$year = \DB::table('current_year')->pluck('year_id');

		$showyear = Year::find($year);

		return view('currentyear.index', compact('currentyear', 'showyear'));

	}



	public function edit()
	{

		//$year = \DB::table('current_year')->pluck('year_id');

		$currentyear = CurrentYear::find(1);

		$years	=	Year::all();

		return view('currentyear.edit', compact('currentyear', 'years'));

	}



	public function update(Request $request)
	{

		$currentyear = CurrentYear::find(1);

		$currentyear->update($request->all());

		Session::flash('success', 'The current year has been updated.');

		return redirect('/current-year');

	}



	public function showcurrentyear()
	{

		$year = \DB::table('current_year')->pluck('year_id');

		$showyear = Year::find($year);

		return $showyear;

	}

}
