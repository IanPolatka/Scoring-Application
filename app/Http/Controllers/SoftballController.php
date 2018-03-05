<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Softball;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

use Image;

use Session;

class SoftballController extends Controller
{

	public function index()
	{

		//  Query All Teams
		$teams = Team::all();

		//  Query All Years
		$years = Year::all();

		//  Query The Current Year
		$currentyear = CurrentYear::find(1)->pluck('year_id');
		$showcurrentyear = Year::where('id', $currentyear)->pluck('year');

		//  Query All Games By The Current Year
		$softball = Softball::where('year_id', $currentyear)->orderBy('date')->select('softball.*')->get();

		return view('sports.softball.index', compact('softball', 'showcurrentyear', 'teams', 'years'));

	}



	public function show($id)
	{

 		//  Query All Games By The Game ID
		$softball = Softball::find($id);

		return view('sports.softball.show', compact('softball'));

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

		return view('sports.softball.create', compact('thecurrentyear', 'years', 'teams', 'times', 'displayyear'));

	}



	public function store(Softball $softball)
	{

		$this->validate(request(), [
        	'year_id' 			=> 	'required',
        	'date' 				=> 	'required',
        	'away_team_id'		=>	'required',
        	'home_team_id'		=>	'required'
    	]);
		
		Softball::create([

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

		return redirect('/softball');

	}



	public function edit($id)
	{

		$softball = Softball::find($id);

		//  Display the current year
		$thecurrentyear	= Year::find(1);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::orderBy('school_name')->get();

		//  Display the game times
		$times = Time::all();

		return view('sports.softball.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'softball'));

	}



	public function update(Request $request, softball $softball)
	{

		$softball->update($request->all());

		return redirect()->back();

	}



	public function delete($id)
	{
		$softball = Softball::find($id);
		$softball->delete();
		return redirect('/softball');
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
		$softball = Softball::join('years', 'softball.year_id', 'years.id')
							->select('softball.*')
							->where('year_id', '=', $selectedyearid)
							->where('team_level', '=', 1)
							->where(function ($query) use ($selectedteamid) {
						        $query->where('away_team_id', '=' , $selectedteamid)
						            ->orWhere('home_team_id', '=', $selectedteamid);
						    })
						    ->orderBy('date')
							->get();

		//  Display schedule for team based on selected year
		$jvsoftball = Softball::join('years', 'softball.year_id', 'years.id')
							->select('softball.*')
							->where('year_id', '=', $selectedyearid)
							->where('team_level', '=', 2)
							->where(function ($query) use ($selectedteamid) {
						        $query->where('away_team_id', '=' , $selectedteamid)
						            ->orWhere('home_team_id', '=', $selectedteamid);
						    })
						    ->orderBy('date')
							->get();

		$region 		= Team::where('school_name', $team)->pluck('region_baseball');
		$standings		= Team::where('region_baseball', $region)->orderBy('school_name')->get();

		return view('sports.softball.teamschedule', compact('softball',
															'jvsoftball', 
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
		$softball = Softball::join('years', 'softball.year_id', 'years.id')
							->select('softball.*')
							->where('year', '=', $year)
							->orderBy('date')
							->get();

		return view('sports.softball.yearschedule', compact('softball', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

	}








	public function apiteamschedule($year, $team, $teamlevel)
	{

		$theteam = Team::where('school_name', '=', $team)->pluck('id');

		$softball = Softball::join('teams as home_team', 'softball.home_team_id', '=', 'home_team.id')
							->join('teams as away_team', 'softball.away_team_id', '=', 'away_team.id')
							->join('years', 'softball.year_id', '=', 'years.id')
							->join('times', 'softball.time_id', '=', 'times.id')
							->leftjoin('teams as winner', 'softball.winning_team', '=', 'winner.id')
							->leftjoin('teams as loser', 'softball.losing_team', '=', 'loser.id')
							->select(
									'softball.id',
									'softball.date',
									'year',
									'scrimmage',
									'time',
									'softball.tournament_title',
									'away_team.school_name as away_team',
									'away_team.logo as away_team_logo',
									'away_team.mascot as away_team_mascot',
									'away_team.district_softball as away_team_softball_district',
									'away_team.region_softball as away_team_softball_region',
									'softball.away_team_first_inning_score',
									'softball.away_team_second_inning_score',
									'softball.away_team_third_inning_score',
									'softball.away_team_fourth_inning_score',
									'softball.away_team_fifth_inning_score',
									'softball.away_team_sixth_inning_score',
									'softball.away_team_seventh_inning_score',
									'softball.away_team_extra_inning_score',
									'softball.away_team_final_score',
									'home_team.school_name as home_team',
									'home_team.logo as home_team_logo',
									'home_team.mascot as home_team_mascot',
									'home_team.district_softball as home_team_softball_district',
									'home_team.region_softball as home_team_softball_region',
									'softball.home_team_first_inning_score',
									'softball.home_team_second_inning_score',
									'softball.home_team_third_inning_score',
									'softball.home_team_fourth_inning_score',
									'softball.home_team_fifth_inning_score',
									'softball.home_team_sixth_inning_score',
									'softball.home_team_seventh_inning_score',
									'softball.home_team_extra_inning_score',
									'softball.home_team_final_score',
									'softball.game_status',
									'softball.winning_team',
									'softball.losing_team',
									'softball.team_level',
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

		return $softball;

	}


}
