<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Tennisboys;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

class TennisboysController extends Controller
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
		$tennis = Tennisboys::where('year_id', $currentyear)->orderBy('date')->select('tennis_boys.*')->get();

		return view('sports.tennis_boys.index', compact('tennis', 'showcurrentyear', 'teams', 'years'));

	}



	public function show(tennisboys $tennisboys)
	{

		return view('sports.tennis_boys.show', compact('tennisboys'));
		
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

		return view('sports.tennis_boys.create', compact('thecurrentyear', 'years', 'teams', 'times'));

	}



	public function store(Request $request)
	{

		Tennisboys::create([

			'year_id'					=>	request('year_id'),
			'team_level'				=>  request('team_level'),
			'date'						=>	request('date'),
			'scrimmage'					=>	request('scrimmage'),
			'tournament_title'			=>	request('tournament_title'),
			'away_team_id'				=>	request('away_team_id'),
			'home_team_id'				=>	request('home_team_id'),
			'time_id'					=>	request('time_id')

		]);

		return redirect('/tennis-boys');

	}



	public function edit($id)
	{

		$tennis = Tennisboys::find($id);

		//  Display the current year
		$thecurrentyear	= Year::find(1);

		//  Display all the years
		$years = Year::all();

		//  Display all teams
		$teams = Team::all();

		//  Display the game times
		$times = Time::all();

		return view('sports.tennis_boys.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'tennis', 'away_team'));

	}



	public function update(Request $request, tennisboys $tennisboys)
	{

		$tennisboys->update($request->all());

		return redirect('/tennis-boys');

	}



	public function delete($id)
	{
		$tennis = Tennisboys::find($id);
		$tennis->delete();
		return redirect('/tennis-boys');
	}



	public function teamschedule($year, $team)
	{

		$selectedyear = Year::where('year', $year)->pluck('year');
		$selectedyearid = Year::where('year', $year)->pluck('id');

		$selectedteam = Team::where('school_name', $team)->get();
		$selectedteamid	=	Team::where('school_name', $team)->pluck('id');


		// Select All Teams
		$teams = Team::all();



		//  Select All Years
		$years = Year::all();



		//  Display schedule for team based on selected year
		$tennis = Tennisboys::join('years', 'tennis_boys.year_id', 'years.id')
							->select('tennis_boys.*')
							->where('year_id', '=', $selectedyearid)
							->where(function ($query) use ($selectedteamid) {
						        $query->where('away_team_id', '=' , $selectedteamid)
						            ->orWhere('home_team_id', '=', $selectedteamid);
						    })
						    ->orderBy('date')
							->get();



		return view('sports.tennis_boys.teamschedule', compact('tennis', 'selectedteam', 'selectedteamid', 'selectedyear', 
			'selectedyearid', 'teams', 'year', 'years' ));

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
		$tennis = Tennisboys::join('years', 'tennis_boys.year_id', 'years.id')
							->select('tennis_boys.*')
							->where('year', '=', $year)
							->orderBy('date')
							->get();

		return view('sports.tennis_boys.yearschedule', compact('tennis', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

	}



	public function apiteamschedule($year, $team, $teamlevel)
    {

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $tennis = Tennisboys::join('teams as home_team', 'tennis_boys.home_team_id', '=', 'home_team.id')
                            ->join('teams as away_team', 'tennis_boys.away_team_id', '=', 'away_team.id')
                            ->join('years', 'tennis_boys.year_id', '=', 'years.id')
                            ->join('times', 'tennis_boys.time_id', '=', 'times.id')
                            ->leftjoin('teams as winning', 'tennis_boys.winner', '=', 'winning.id')
                            ->leftjoin('teams as losing', 'tennis_boys.loser', '=', 'losing.id')
                            ->select(
                                    'tennis_boys.id',
                                    'tennis_boys.date',
                                    'year',
                                    'scrimmage',
                                    'time',
                                    'tennis_boys.tournament_title',
                                    'away_team.school_name as away_team',
                                    'away_team.logo as away_team_logo',
                                    'away_team.mascot as away_team_mascot',
                                    'home_team.school_name as home_team',
                                    'home_team.logo as home_team_logo',
                                    'home_team.mascot as home_team_mascot',
                                    'winning.school_name as winner_team',
                                    'losing.school_name as losing_team',
                                    'tennis_boys.match_score'
                                )
                            ->where('year', '=', $year)
                            ->where(function ($query) use ($theteam) {
                                $query->where('away_team_id', '=' , $theteam)
                                    ->orWhere('home_team_id', '=', $theteam);
                            })
                            ->where('team_level', '=', $teamlevel)
                            ->orderBy('date')
                            ->get();

        return $tennis;

    }



    public function todaysevents($team)
    {

        $today = Carbon::today();

        // return $today;

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $tennis = Tennisboys::join('teams as home_team', 'tennis_boys.home_team_id', '=', 'home_team.id')
                            ->join('teams as away_team', 'tennis_boys.away_team_id', '=', 'away_team.id')
                            ->join('years', 'tennis_boys.year_id', '=', 'years.id')
                            ->join('times', 'tennis_boys.time_id', '=', 'times.id')
                            ->select(
                                    'tennis_boys.id',
                                    'tennis_boys.date',
                                    'year',
                                    'scrimmage',
                                    'time',
                                    'away_team.school_name as away_team',
                                    'away_team.logo as away_team_logo',
                                    'home_team.school_name as home_team',
                                    'home_team.logo as home_team_logo',
                                    'tennis_boys.team_level'
                                )
                            ->where('tennis_boys.team_level', '=', 1)
                            ->where(function ($query) use ($theteam) {
                                $query->where('away_team_id', '=' , $theteam)
                                    ->orWhere('home_team_id', '=', $theteam);
                            })
                            ->where('date', '=', $today)
                            ->orderBy('time')
                            ->get();

        return $tennis;

    }

}
