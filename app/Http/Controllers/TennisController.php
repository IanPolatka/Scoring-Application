<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Tennis;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;



class TennisController extends Controller
{
    
	public function index()
	{

		$tennis = Tennis::all();

		//return $tennis;

		return view('sports.tennis.index', compact('tennis'));

	}



	public function show(tennis $tennis)
	{

		return view('sports.tennis.show', compact('tennis'));
		
	}



	public function create()
	{

		//  Display the current year
		$thecurrentyear	= Year::find(1);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::all();

		//  Display the game times
		$times = Time::all();

		return view('sports.tennis.create', compact('thecurrentyear', 'years', 'teams', 'times'));

	}



	public function store(Tennis $tennis)
	{

		Tennis::create([

			'year_id'					=>	request('year_id'),
			'date'						=>	request('date'),
			'scrimmage'					=>	request('scrimmage'),
			'tournament_title'			=>	request('tournament_title'),
			'away_team_id'				=>	request('away_team_id'),
			'home_team_id'				=>	request('home_team_id'),
			'time_id'					=>	request('time_id')

		]);

		return redirect('/tennis');

	}



	public function edit($id)
	{

		$tennis = Tennis::find($id);

		//  Display the current year
		$thecurrentyear	= Year::find(1);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::all();

		//  Display the game times
		$times = Time::all();

		return view('sports.tennis.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'tennis', 'away_team'));

	}



	public function update(Request $request, tennis $tennis)
	{

		$tennis->update($request->all());

		return redirect('/tennis');

	}



	public function delete($id)
	{
		$tennis = Tennis::find($id);
		$tennis->delete();
		return redirect('/tennis');
	}



	public function teamschedule($id)
	{

		$team = Team::find($id);

		$tennis = Tennis::where('home_team_id', $id)->orWhere('away_team_id', $id)->get();

		return view('sports.tennis.teamschedule', compact('team', 'tennis'));

	}



}
