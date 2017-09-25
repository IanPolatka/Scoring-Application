<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Volleyball;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

use Session;

class VolleyballController extends Controller
{
    
	public function index()
	{

		//  Query All Teams
		$teams = Team::all();

		//  Query All Years
		$years = Year::all();

		$date = date('l d, Y');

		$currentyear = CurrentYear::find(1)->pluck('year_id');

		$yesterday = date("Y-m-d", strtotime( '-1 days' ) );
		$countYesterday = Volleyball::where('year_id', $currentyear)
						->where('team_level', 1)
						->whereDate('date', Carbon::yesterday())
						->orderBy('date', Carbon::today())
						->get();

		$tomorrow = date("Y-m-d", strtotime( '+1 days' ) );
		$countTomorrow = Volleyball::where('year_id', $currentyear)
						->where('team_level', 1)
						->whereDate('date', Carbon::tomorrow('America/New_York'))
						->orderBy('date')
						->get();

		//  Query The Current Year
		$currentyear = CurrentYear::find(1)->pluck('year_id');
		$showcurrentyear = Year::where('id', $currentyear)->pluck('year');

		//  Query All Games By The Current Year
		$volleyball = Volleyball::where('year_id', $currentyear)
						->where('team_level', 1)
						->whereDate('date', Carbon::today())
						->orderBy('date')
						->get();

		// return $volleyball;

		return view('sports.volleyball.index', compact('date','countYesterday', 'countTomorrow', 'yesterday', 'tomorrow', 'volleyball', 'showcurrentyear', 'teams', 'years'));

	}



	public function show($id)
	{

 		//  Query All Games By The Game ID
		$volleyball = Volleyball::find($id);

		// return $volleyball;

		return view('sports.volleyball.show', compact('volleyball'));

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

		return view('sports.volleyball.create', compact('thecurrentyear', 'years', 'teams', 'times', 'displayyear'));

	}



	public function store(Request $request, Volleyball $volleyball)
	{

		$this->validate(request(), [
        	'year_id' 			=> 	'required',
        	'date' 				=> 	'required',
        	'away_team_id'		=>	'required',
        	'home_team_id'		=>	'required'
    	]);
		
		Volleyball::create([

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

		return redirect('/volleyball');

	}



	public function edit($id)
	{

		$volleyball = Volleyball::find($id);

		//  Display the current year
		$thecurrentyear	= Year::find(1);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::orderBy('school_name')->get();

		//  Display the game times
		$times = Time::all();

		return view('sports.volleyball.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'volleyball'));

	}



	public function update(Request $request, volleyball $volleyball)
	{

		$volleyball->update($request->all());

		return redirect()->back();

	}



	public function delete($id)
	{
		$volleyball = Volleyball::find($id);
		$volleyball->delete();
		return redirect('/volleyball');
	}



	public function teamschedule($year, $team)
	{

		// return $year;
		$selectedyear 		= Year::where('year', $year)->pluck('year');
		$selectedyearid 	= Year::where('year', $year)->pluck('id');

		$selectedteam 		= Team::where('school_name', $team)->get();
		$selectedteamid		= Team::where('school_name', $team)->pluck('id');



		//  Select All Teams
		$teams = Team::all();



		//  Select All Years
		$years = Year::all();



		//  Display schedule for team based on selected year
		$volleyball = Volleyball::leftjoin('teams as home_team', 'volleyball.home_team_id', '=', 'home_team.id')
								->leftjoin('teams as away_team', 'volleyball.away_team_id', '=', 'away_team.id')
								->join('years', 'volleyball.year_id', '=', 'years.id')
								->join('times', 'volleyball.time_id', '=', 'times.id')
								->leftjoin('teams as winner', 'volleyball.winning_team', '=', 'winner.id')
								->leftjoin('teams as loser', 'volleyball.losing_team', '=', 'loser.id')
								->leftjoin('teams as g_one_w', 'volleyball.game_one_winner', '=', 'g_one_w.id')
								->leftjoin('teams as g_two_w', 'volleyball.game_two_winner', '=', 'g_two_w.id')
								->leftjoin('teams as g_three_w', 'volleyball.game_three_winner', '=', 'g_three_w.id')
								->leftjoin('teams as g_four_w', 'volleyball.game_four_winner', '=', 'g_four_w.id')
								->leftjoin('teams as g_five_w', 'volleyball.game_five_winner', '=', 'g_five_w.id')
								->select(
										'volleyball.id',
										'volleyball.date',
										'year',
										'scrimmage',
										'time',
										'volleyball.tournament_title',
										'away_team_id',
										'away_team.school_name as away_team',
										'away_team.logo as away_team_logo',
										'away_team.mascot as away_team_mascot',
										'away_team.city as away_team_city',
										'away_team.state as away_team_state',
										'volleyball.away_team_first_game_score',
										'volleyball.away_team_second_game_score',
										'volleyball.away_team_third_game_score',
										'volleyball.away_team_fourth_game_score',
										'volleyball.away_team_fifth_game_score',
										'home_team_id',
										'home_team.school_name as home_team',
										'home_team.logo as home_team_logo',
										'home_team.mascot as home_team_mascot',
										'home_team.city as home_team_city',
										'home_team.state as home_team_state',
										'volleyball.home_team_first_game_score',
										'volleyball.home_team_second_game_score',
										'volleyball.home_team_third_game_score',
										'volleyball.home_team_fourth_game_score',
										'volleyball.home_team_fifth_game_score',
										'volleyball.game_status',
										'winner.school_name as winning_team',
										'loser.school_name as losing_team',
										'g_one_w.school_name as g_one_w',
										'g_two_w.school_name as g_two_w',
										'g_three_w.school_name as g_three_w',
										'g_four_w.school_name as g_four_w',
										'g_five_w.school_name as g_five_w'
									)
	    						->orderBy('date')
	    						->where(function ($query) use ($selectedteamid) {
							        $query->where('away_team_id', '=' , $selectedteamid)
							            ->orWhere('home_team_id', '=', $selectedteamid);
							    })
							    ->where('team_level', 1)
							    ->where('year', $selectedyear)
						    	->get();


		//  Display schedule for team based on selected year
		$jv_volleyball = Volleyball::leftjoin('teams as home_team', 'volleyball.home_team_id', '=', 'home_team.id')
								->leftjoin('teams as away_team', 'volleyball.away_team_id', '=', 'away_team.id')
								->join('years', 'volleyball.year_id', '=', 'years.id')
								->join('times', 'volleyball.time_id', '=', 'times.id')
								->leftjoin('teams as winner', 'volleyball.winning_team', '=', 'winner.id')
								->leftjoin('teams as loser', 'volleyball.losing_team', '=', 'loser.id')
								->leftjoin('teams as g_one_w', 'volleyball.game_one_winner', '=', 'g_one_w.id')
								->leftjoin('teams as g_two_w', 'volleyball.game_two_winner', '=', 'g_two_w.id')
								->leftjoin('teams as g_three_w', 'volleyball.game_three_winner', '=', 'g_three_w.id')
								->leftjoin('teams as g_four_w', 'volleyball.game_four_winner', '=', 'g_four_w.id')
								->leftjoin('teams as g_five_w', 'volleyball.game_five_winner', '=', 'g_five_w.id')
								->select(
										'volleyball.id',
										'volleyball.date',
										'year',
										'scrimmage',
										'time',
										'volleyball.tournament_title',
										'away_team_id',
										'away_team.school_name as away_team',
										'away_team.logo as away_team_logo',
										'away_team.mascot as away_team_mascot',
										'away_team.city as away_team_city',
										'away_team.state as away_team_state',
										'volleyball.away_team_first_game_score',
										'volleyball.away_team_second_game_score',
										'volleyball.away_team_third_game_score',
										'volleyball.away_team_fourth_game_score',
										'volleyball.away_team_fifth_game_score',
										'home_team_id',
										'home_team.school_name as home_team',
										'home_team.logo as home_team_logo',
										'home_team.mascot as home_team_mascot',
										'home_team.city as home_team_city',
										'home_team.state as home_team_state',
										'volleyball.home_team_first_game_score',
										'volleyball.home_team_second_game_score',
										'volleyball.home_team_third_game_score',
										'volleyball.home_team_fourth_game_score',
										'volleyball.home_team_fifth_game_score',
										'volleyball.game_status',
										'winner.school_name as winning_team',
										'loser.school_name as losing_team',
										'g_one_w.school_name as g_one_w',
										'g_two_w.school_name as g_two_w',
										'g_three_w.school_name as g_three_w',
										'g_four_w.school_name as g_four_w',
										'g_five_w.school_name as g_five_w'
									)
	    						->orderBy('date')
	    						->where(function ($query) use ($selectedteamid) {
							        $query->where('away_team_id', '=' , $selectedteamid)
							            ->orWhere('home_team_id', '=', $selectedteamid);
							    })
							    ->where('team_level', 2)
							    ->where('year', $selectedyear)
						    	->get();

		//  Display schedule for team based on selected year
		$fresh_volleyball = Volleyball::leftjoin('teams as home_team', 'volleyball.home_team_id', '=', 'home_team.id')
								->leftjoin('teams as away_team', 'volleyball.away_team_id', '=', 'away_team.id')
								->join('years', 'volleyball.year_id', '=', 'years.id')
								->join('times', 'volleyball.time_id', '=', 'times.id')
								->leftjoin('teams as winner', 'volleyball.winning_team', '=', 'winner.id')
								->leftjoin('teams as loser', 'volleyball.losing_team', '=', 'loser.id')
								->leftjoin('teams as g_one_w', 'volleyball.game_one_winner', '=', 'g_one_w.id')
								->leftjoin('teams as g_two_w', 'volleyball.game_two_winner', '=', 'g_two_w.id')
								->leftjoin('teams as g_three_w', 'volleyball.game_three_winner', '=', 'g_three_w.id')
								->leftjoin('teams as g_four_w', 'volleyball.game_four_winner', '=', 'g_four_w.id')
								->leftjoin('teams as g_five_w', 'volleyball.game_five_winner', '=', 'g_five_w.id')
								->select(
										'volleyball.id',
										'volleyball.date',
										'year',
										'scrimmage',
										'time',
										'volleyball.tournament_title',
										'away_team_id',
										'away_team.school_name as away_team',
										'away_team.logo as away_team_logo',
										'away_team.mascot as away_team_mascot',
										'away_team.city as away_team_city',
										'away_team.state as away_team_state',
										'volleyball.away_team_first_game_score',
										'volleyball.away_team_second_game_score',
										'volleyball.away_team_third_game_score',
										'volleyball.away_team_fourth_game_score',
										'volleyball.away_team_fifth_game_score',
										'home_team_id',
										'home_team.school_name as home_team',
										'home_team.logo as home_team_logo',
										'home_team.mascot as home_team_mascot',
										'home_team.city as home_team_city',
										'home_team.state as home_team_state',
										'volleyball.home_team_first_game_score',
										'volleyball.home_team_second_game_score',
										'volleyball.home_team_third_game_score',
										'volleyball.home_team_fourth_game_score',
										'volleyball.home_team_fifth_game_score',
										'volleyball.game_status',
										'winner.school_name as winning_team',
										'loser.school_name as losing_team',
										'g_one_w.school_name as g_one_w',
										'g_two_w.school_name as g_two_w',
										'g_three_w.school_name as g_three_w',
										'g_four_w.school_name as g_four_w',
										'g_five_w.school_name as g_five_w'
									)
	    						->orderBy('date')
	    						->where(function ($query) use ($selectedteamid) {
							        $query->where('away_team_id', '=' , $selectedteamid)
							            ->orWhere('home_team_id', '=', $selectedteamid);
							    })
							    ->where('team_level', 3)
							    ->where('year', $selectedyear)
						    	->get();

		$region 		= Team::where('school_name', $team)->pluck('region_volleyball');
		$standings		= Team::where('region_volleyball', $region)->orderBy('school_name')->get();


		//  Count All Wins		
    	$winning_team_by_id = Volleyball::where('winning_team', '=', $selectedteamid)
    									->where('year_id', '=', $selectedyearid)
    									->get();
		$wins = $winning_team_by_id->count();

		//  Count All District Wins
		$district_wins_by_team_id = Volleyball::where('winning_team', '=', $selectedteamid)
											->where('district_game', '=', 1)
											->where('year_id', '=', $selectedyearid)
											->get();
		$district_wins = $district_wins_by_team_id->count();

		//  Count All Losses	
		$losing_team_by_id = Volleyball::where('losing_team', '=', $selectedteamid)
										->where('year_id', '=', $selectedyearid)
										->get();
		$losses = $losing_team_by_id->count();


		//  Count All District losses
		$district_losses_by_team_id = Volleyball::where('losing_team', '=', $selectedteamid)
											->where('district_game', '=', 1)
											->where('year_id', '=', $selectedyearid)
											->get();
		$district_losses = $district_losses_by_team_id->count();



		$district 		= Team::where('school_name', $team)->pluck('district_volleyball');
		$standings		= Team::where('district_volleyball', $district)
								->orderBy('school_name')->get();

		// return $volleyball;


		return view('sports.volleyball.teamschedule', compact('volleyball', 
															'jv_volleyball',
															'fresh_volleyball',
															'selectedteam',
															'selectedteamid',
															'selectedyear',
															'selectedyearid',
															'standings',
															'teams',
															'year',
															'years',
															'wins',
															'losses',
															'district_wins',
															'district_losses'
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
		$volleyball = Volleyball::join('years', 'volleyball.year_id', 'years.id')
							->select('volleyball.*')
							->where('year', '=', $year)
							->orderBy('date')
							->get();

		return view('sports.volleyball.yearschedule', compact('volleyball', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

	}



	public function apiteamschedulesummary($year, $team)
	{

		$theteam = Team::where('school_name', '=', $team)->pluck('id');

		// return $theteam;

		$volleyball = Volleyball::leftjoin('teams as home_team', 'volleyball.home_team_id', '=', 'home_team.id')
							->leftjoin('teams as away_team', 'volleyball.away_team_id', '=', 'away_team.id')
							->join('years', 'volleyball.year_id', '=', 'years.id')
							->join('times', 'volleyball.time_id', '=', 'times.id')
							->leftjoin('teams as winner', 'volleyball.winning_team', '=', 'winner.id')
							->leftjoin('teams as loser', 'volleyball.losing_team', '=', 'loser.id')
							->leftjoin('teams as g_one_w', 'volleyball.game_one_winner', '=', 'g_one_w.id')
							->leftjoin('teams as g_two_w', 'volleyball.game_two_winner', '=', 'g_two_w.id')
							->leftjoin('teams as g_three_w', 'volleyball.game_three_winner', '=', 'g_three_w.id')
							->leftjoin('teams as g_four_w', 'volleyball.game_four_winner', '=', 'g_four_w.id')
							->leftjoin('teams as g_five_w', 'volleyball.game_five_winner', '=', 'g_five_w.id')
							->select(
									'volleyball.id',
									'volleyball.date',
									'year',
									'scrimmage',
									'time',
									'volleyball.tournament_title',
									'away_team.school_name as away_team',
									'away_team.logo as away_team_logo',
									'volleyball.away_team_first_game_score',
									'volleyball.away_team_second_game_score',
									'volleyball.away_team_third_game_score',
									'volleyball.away_team_fourth_game_score',
									'volleyball.away_team_fifth_game_score',
									'home_team.school_name as home_team',
									'home_team.logo as home_team_logo',
									'volleyball.home_team_first_game_score',
									'volleyball.home_team_second_game_score',
									'volleyball.home_team_third_game_score',
									'volleyball.home_team_fourth_game_score',
									'volleyball.home_team_fifth_game_score',
									'volleyball.game_status',
									'winner.school_name as winning_team',
									'loser.school_name as losing_team',
									'g_one_w.school_name as g_one_w',
									'g_two_w.school_name as g_two_w',
									'g_three_w.school_name as g_three_w',
									'g_four_w.school_name as g_four_w',
									'g_five_w.school_name as g_five_w',
									'team_level'
								)
							->where('year', '=', $year)
    						->where(function ($query) use ($theteam) {
                                $query->where('away_team_id', '=' , $theteam)
                                    ->orWhere('home_team_id', '=', $theteam);
                            })
                            ->where('team_level', '=', 1)
    						->where('date', '>=', Carbon::today()->toDateString())
    						->limit(4)
    						->orderBy('date', 'asc')
					    	->get();

		return $volleyball;

	}



	public function apiteamschedule($year, $team, $teamlevel)
	{

		$theteam = Team::where('school_name', '=', $team)->pluck('id');

		$volleyball = Volleyball::leftjoin('teams as home_team', 'volleyball.home_team_id', '=', 'home_team.id')
								->leftjoin('teams as away_team', 'volleyball.away_team_id', '=', 'away_team.id')
								->join('years', 'volleyball.year_id', '=', 'years.id')
								->join('times', 'volleyball.time_id', '=', 'times.id')
								->leftjoin('teams as winner', 'volleyball.winning_team', '=', 'winner.id')
								->leftjoin('teams as loser', 'volleyball.losing_team', '=', 'loser.id')
								->leftjoin('teams as g_one_w', 'volleyball.game_one_winner', '=', 'g_one_w.id')
								->leftjoin('teams as g_two_w', 'volleyball.game_two_winner', '=', 'g_two_w.id')
								->leftjoin('teams as g_three_w', 'volleyball.game_three_winner', '=', 'g_three_w.id')
								->leftjoin('teams as g_four_w', 'volleyball.game_four_winner', '=', 'g_four_w.id')
								->leftjoin('teams as g_five_w', 'volleyball.game_five_winner', '=', 'g_five_w.id')
								->select(
									'volleyball.id',
									'volleyball.date',
									'year',
									'scrimmage',
									'time',
									'volleyball.tournament_title',
									'away_team.school_name as away_team',
									'away_team.logo as away_team_logo',
									'volleyball.away_team_first_game_score',
									'volleyball.away_team_second_game_score',
									'volleyball.away_team_third_game_score',
									'volleyball.away_team_fourth_game_score',
									'volleyball.away_team_fifth_game_score',
									'home_team.school_name as home_team',
									'home_team.logo as home_team_logo',
									'volleyball.home_team_first_game_score',
									'volleyball.home_team_second_game_score',
									'volleyball.home_team_third_game_score',
									'volleyball.home_team_fourth_game_score',
									'volleyball.home_team_fifth_game_score',
									'volleyball.game_status',
									'winner.school_name as winning_team',
									'loser.school_name as losing_team',
									'g_one_w.school_name as g_one_w',
									'g_two_w.school_name as g_two_w',
									'g_three_w.school_name as g_three_w',
									'g_four_w.school_name as g_four_w',
									'g_five_w.school_name as g_five_w',
									'team_level'
								)
							->where('year', '=', $year)
							->where(function ($query) use ($theteam) {
                                $query->where('away_team_id', '=' , $theteam)
                                    ->orWhere('home_team_id', '=', $theteam);
                            })
                            ->where('team_level', '=', $teamlevel)
							->orderBy('date','asc')
					    	->get();

		return $volleyball;

	}



	public function apigame($id)
	{

		$volleyball = Volleyball::leftjoin('teams as home_team', 'volleyball.home_team_id', '=', 'home_team.id')
								->leftjoin('teams as away_team', 'volleyball.away_team_id', '=', 'away_team.id')
								->join('years', 'volleyball.year_id', '=', 'years.id')
								->join('times', 'volleyball.time_id', '=', 'times.id')
								->leftjoin('teams as winner', 'volleyball.winning_team', '=', 'winner.id')
								->leftjoin('teams as loser', 'volleyball.losing_team', '=', 'loser.id')
								->leftjoin('teams as g_one_w', 'volleyball.game_one_winner', '=', 'g_one_w.id')
								->leftjoin('teams as g_two_w', 'volleyball.game_two_winner', '=', 'g_two_w.id')
								->leftjoin('teams as g_three_w', 'volleyball.game_three_winner', '=', 'g_three_w.id')
								->leftjoin('teams as g_four_w', 'volleyball.game_four_winner', '=', 'g_four_w.id')
								->leftjoin('teams as g_five_w', 'volleyball.game_five_winner', '=', 'g_five_w.id')
								->select(
									'volleyball.id',
									'volleyball.date',
									'year',
									'scrimmage',
									'time',
									'volleyball.tournament_title',
									'away_team.school_name as away_team',
									'away_team.logo as away_team_logo',
									'away_team.mascot as away_team_mascot',
									'away_team.abbreviated_name as away_team_abbreviated_name',
									'volleyball.away_team_first_game_score',
									'volleyball.away_team_second_game_score',
									'volleyball.away_team_third_game_score',
									'volleyball.away_team_fourth_game_score',
									'volleyball.away_team_fifth_game_score',
									'home_team.school_name as home_team',
									'home_team.logo as home_team_logo',
									'home_team.mascot as home_team_mascot',
									'home_team.abbreviated_name as home_team_abbreviated_name',
									'volleyball.home_team_first_game_score',
									'volleyball.home_team_second_game_score',
									'volleyball.home_team_third_game_score',
									'volleyball.home_team_fourth_game_score',
									'volleyball.home_team_fifth_game_score',
									'volleyball.game_status',
									'winner.school_name as winning_team',
									'loser.school_name as losing_team',
									'g_one_w.school_name as g_one_w',
									'g_two_w.school_name as g_two_w',
									'g_three_w.school_name as g_three_w',
									'g_four_w.school_name as g_four_w',
									'g_five_w.school_name as g_five_w'
								)
							->where('volleyball.id', '=', $id)
					    	->get();

		return $volleyball;

	}



	public function todaysevents($team)
	{

		$today = Carbon::today();

		$theteam = Team::where('school_name', '=', $team)->pluck('id');

		$volleyball = Volleyball::leftjoin('teams as home_team', 'volleyball.home_team_id', '=', 'home_team.id')
							->leftjoin('teams as away_team', 'volleyball.away_team_id', '=', 'away_team.id')
							->join('years', 'volleyball.year_id', '=', 'years.id')
							->join('times', 'volleyball.time_id', '=', 'times.id')
							->leftjoin('teams as winner', 'volleyball.winning_team', '=', 'winner.id')
							->leftjoin('teams as loser', 'volleyball.losing_team', '=', 'loser.id')
							->leftjoin('teams as g_one_w', 'volleyball.game_one_winner', '=', 'g_one_w.id')
							->leftjoin('teams as g_two_w', 'volleyball.game_two_winner', '=', 'g_two_w.id')
							->leftjoin('teams as g_three_w', 'volleyball.game_three_winner', '=', 'g_three_w.id')
							->leftjoin('teams as g_four_w', 'volleyball.game_four_winner', '=', 'g_four_w.id')
							->leftjoin('teams as g_five_w', 'volleyball.game_five_winner', '=', 'g_five_w.id')
							->select(
									'volleyball.id',
									'volleyball.date',
									'year',
									'scrimmage',
									'time',
									'volleyball.tournament_title',
									'away_team.school_name as away_team',
									'away_team.logo as away_team_logo',
									'volleyball.away_team_first_game_score',
									'volleyball.away_team_second_game_score',
									'volleyball.away_team_third_game_score',
									'volleyball.away_team_fourth_game_score',
									'volleyball.away_team_fifth_game_score',
									'home_team.school_name as home_team',
									'home_team.logo as home_team_logo',
									'volleyball.home_team_first_game_score',
									'volleyball.home_team_second_game_score',
									'volleyball.home_team_third_game_score',
									'volleyball.home_team_fourth_game_score',
									'volleyball.home_team_fifth_game_score',
									'volleyball.game_status',
									'winner.school_name as winning_team',
									'loser.school_name as losing_team',
									'g_one_w.school_name as g_one_w',
									'g_two_w.school_name as g_two_w',
									'g_three_w.school_name as g_three_w',
									'g_four_w.school_name as g_four_w',
									'g_five_w.school_name as g_five_w',
									'team_level'
								)
    						->where(function ($query) use ($theteam) {
                                $query->where('away_team_id', '=' , $theteam)
                                    ->orWhere('home_team_id', '=', $theteam);
                            })
                            ->where('team_level', '=', 1)
    						->where('date', '=', $today)
    						->orderBy('time')
					    	->get();

		return $volleyball;

	}

}
