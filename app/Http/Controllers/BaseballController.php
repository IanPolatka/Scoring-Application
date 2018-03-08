<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Baseball;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

use Image;

use Session;

class BaseballController extends Controller
{
    
	public function index()
	{

		//  Query All Teams
		$teams = Team::all()->sortBy('school_name');

		//  Query All Years
		$years = Year::all();

		//  Query The Current Year
		$currentyear = CurrentYear::find(1)->pluck('year_id');
		$showcurrentyear = Year::where('id', $currentyear)->pluck('year');

		//  Query All Games By The Current Year
		$baseball = Baseball::where('year_id', $currentyear)->orderBy('date')->select('baseball.*')->get();

		return view('sports.baseball.index', compact('baseball', 'showcurrentyear', 'teams', 'years'));

	}



	public function show($id)
	{

 		//  Query All Games By The Game ID
		$baseball = Baseball::find($id);

		return view('sports.baseball.show', compact('baseball'));

	}



	public function create()
	{

		//  Display the current year
		$thecurrentyear	= CurrentYear::find(1)->pluck('year_id');

		$displayyear = Year::find($thecurrentyear);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::orderBy('school_name')->get();

		//  Display the game times
		$times = Time::all();

		return view('sports.baseball.create', compact('thecurrentyear', 'years', 'teams', 'times', 'displayyear'));

	}



	public function store(Baseball $baseball)
	{

		$this->validate(request(), [
        	'year_id' 			=> 	'required',
        	'date' 				=> 	'required',
        	'away_team_id'		=>	'required',
        	'home_team_id'		=>	'required'
    	]);
		
		Baseball::create([

			'year_id'					=>	request('year_id'),
			'team_level'				=>  request('team_level'),
			'date'						=>	request('date'),
			'scrimmage'					=>	request('scrimmage'),
			'tournament_title'			=>	request('tournament_title'),
			'away_team_id'				=>	request('away_team_id'),
			'home_team_id'				=>	request('home_team_id'),
			'time_id'					=>	request('time_id'),
			'district_game'				=>	request('district_game')

		]);

		Session::flash('success', 'Game Has Been Added');

		return redirect('/baseball');

	}



	public function edit($id)
	{

		$baseball = Baseball::find($id);

		//  Display the current year
		$thecurrentyear	= Year::find(1);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::orderBy('school_name')->get();

		//  Display the game times
		$times = Time::all();

		return view('sports.baseball.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'baseball'));

	}



	public function update(Request $request, baseball $baseball)
	{

		$baseball->update($request->all());

		return redirect()->back();

	}



	public function delete($id)
	{
		$baseball = Baseball::find($id);
		$baseball->delete();
		return redirect('/baseball');
	}



	public function teamschedule($year, $team)
	{

		// return $year;
		$selectedyear = Year::where('year', $year)->pluck('year');
		$selectedyearid = Year::where('year', $year)->pluck('id');

		$selectedteam = Team::where('school_name', $team)->get();
		$selectedteamid	=	Team::where('school_name', $team)->pluck('id');



		//  Select All Teams
		$teams = Team::all();



		//  Select All Years
		$years = Year::all();



		//  Display schedule for team based on selected year
		$baseball = Baseball::join('years', 'baseball.year_id', 'years.id')
							->select('baseball.*')
							->where('year_id', '=', $selectedyearid)
							->where(function ($query) use ($selectedteamid) {
						        $query->where('away_team_id', '=' , $selectedteamid)
						            ->orWhere('home_team_id', '=', $selectedteamid);
						    })
						    ->orderBy('date')
							->get();

		$region 		= Team::where('school_name', $team)->pluck('region_baseball');
		$standings		= Team::where('region_baseball', $region)->orderBy('school_name')->get();

		return view('sports.baseball.teamschedule', compact('baseball', 
															'selectedteam',
															'selectedteamid',
															'selectedyear',
															'selectedyearid',
															'standings',
															'teams',
															'year',
															'years'
															));

	}



	public function yearschedule($year)
	{

		//  Get id of the selected year
		$selectedyear = Year::where('year', $year)->pluck('year');
		$selectedyearid = Year::where('year', $year)->pluck('id');



		//  Select All Teams
		$teams = Team::all();



		//  Select All Years
		$years = Year::all();

		//  Display schedule for team based on selected year
		$baseball = Baseball::join('years', 'baseball.year_id', 'years.id')
							->select('baseball.*')
							->where('year', '=', $year)
							->orderBy('date')
							->get();

		return view('sports.baseball.yearschedule', compact('baseball', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

	}







	public function apiteamschedule($year, $team, $teamlevel)
	{

		$theteam = Team::where('school_name', '=', $team)->pluck('id');

		$baseball = Baseball::join('teams as home_team', 'baseball.home_team_id', '=', 'home_team.id')
							->join('teams as away_team', 'baseball.away_team_id', '=', 'away_team.id')
							->join('years', 'baseball.year_id', '=', 'years.id')
							->join('times', 'baseball.time_id', '=', 'times.id')
							->leftjoin('teams as winner', 'baseball.winning_team', '=', 'winner.id')
							->leftjoin('teams as loser', 'baseball.losing_team', '=', 'loser.id')
							->select(
									'baseball.id',
									'baseball.date',
									'year',
									'scrimmage',
									'time',
									'baseball.tournament_title',
									'away_team.school_name as away_team',
									'away_team.logo as away_team_logo',
									'away_team.mascot as away_team_mascot',
									'away_team.district_baseball as away_team_baseball_district',
									'away_team.region_baseball as away_team_baseball_region',
									'baseball.away_team_first_inning_score',
									'baseball.away_team_second_inning_score',
									'baseball.away_team_third_inning_score',
									'baseball.away_team_fourth_inning_score',
									'baseball.away_team_fifth_inning_score',
									'baseball.away_team_sixth_inning_score',
									'baseball.away_team_seventh_inning_score',
									'baseball.away_team_extra_inning_score',
									'baseball.away_team_final_score',
									'home_team.school_name as home_team',
									'home_team.logo as home_team_logo',
									'home_team.mascot as home_team_mascot',
									'home_team.district_baseball as home_team_baseball_district',
									'home_team.region_baseball as home_team_baseball_region',
									'baseball.home_team_first_inning_score',
									'baseball.home_team_second_inning_score',
									'baseball.home_team_third_inning_score',
									'baseball.home_team_fourth_inning_score',
									'baseball.home_team_fifth_inning_score',
									'baseball.home_team_sixth_inning_score',
									'baseball.home_team_seventh_inning_score',
									'baseball.home_team_extra_inning_score',
									'baseball.home_team_final_score',
									'baseball.game_status',
									'baseball.winning_team',
									'baseball.losing_team',
									'baseball.team_level',
									'winner.school_name as winning_team',
									'loser.school_name as losing_team'
								)
							->where('year', '=', $year)
							->where(function ($query) use ($theteam) {
						        $query->where('away_team_id', '=' , $theteam)
						            ->orWhere('home_team_id', '=', $theteam);
						    })
							->where('team_level', '=', $teamlevel)
							->orderBy('date')
					    	->get();

		return $baseball;

	}




}
