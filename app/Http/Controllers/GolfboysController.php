<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Golfboys;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

class GolfboysController extends Controller
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
        $golf = Golfboys::where('year_id', $currentyear)->orderBy('date')->select('golf_boys.*')->get();

        return view('sports.golf_boys.index', compact('golf', 'showcurrentyear', 'teams', 'years'));

    }



    public function show(golfboys $golfboys)
    {

        return view('sports.golf_boys.show', compact('golfboys'));
        
    }



    public function create()
    {

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all();

        //  Display the game times
        $times = Time::all();

        return view('sports.golf_boys.create', compact('thecurrentyear', 'years', 'teams', 'times'));

    }



    public function store(Request $request)
    {

        Golfboys::create([

            'year_id'                   =>  request('year_id'),
            'team_level'                =>  request('team_level'),
            'date'                      =>  request('date'),
            'scrimmage'                 =>  request('scrimmage'),
            'tournament_title'          =>  request('tournament_title'),
            'away_team_id'              =>  request('away_team_id'),
            'home_team_id'              =>  request('home_team_id'),
            'time_id'                   =>  request('time_id')

        ]);

        return redirect('/golf-boys');

    }



    public function edit($id)
    {

        $golf = Golfboys::find($id);

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all();

        //  Display the game times
        $times = Time::all();

        return view('sports.golf_boys.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'golf', 'away_team'));

    }



    public function update(Request $request, golfboys $golfboys)
    {

        $golfboys->update($request->all());

        return redirect('/golf-boys');

    }



    public function delete($id)
    {
        $golf = Golfboys::find($id);
        $golf->delete();
        return redirect('/golf-boys');
    }



    public function teamschedule($year, $team)
    {

        $selectedyear = Year::where('year', $year)->pluck('year');
        $selectedyearid = Year::where('year', $year)->pluck('id');

        $selectedteam = Team::where('school_name', $team)->get();
        $selectedteamid =   Team::where('school_name', $team)->pluck('id');

        // return $selectedteamid;


        // Select All Teams
        $teams = Team::all();



        //  Select All Years
        $years = Year::all();



        //  Display varsity schedule for team based on selected year
        $golf = Golfboys::leftjoin('teams as home_team', 'golf_boys.home_team_id', '=', 'home_team.id')
                        ->leftjoin('teams as away_team', 'golf_boys.away_team_id', '=', 'away_team.id')
                        ->join('years', 'golf_boys.year_id', 'years.id')
                        ->join('times', 'golf_boys.time_id', '=', 'times.id')
                        ->leftjoin('teams as winner', 'golf_boys.winner', '=', 'winner.id')
                        ->leftjoin('teams as loser', 'golf_boys.loser', '=', 'loser.id')
                        ->select(
                            'away_team_id',
                            'home_team_id',
                            'golf_boys.id',
                            'golf_boys.date',
                            'year',
                            'scrimmage',
                            'time',
                            'golf_boys.tournament_title',
                            'away_team.school_name as away_team',
                            'away_team.logo as away_team_logo',
                            'home_team.school_name as home_team',
                            'home_team.logo as home_team_logo',
                            'winner.school_name as winning_team',
                            'loser.school_name as losing_team',
                            'match_score',
                            'team_level'
                            )
                            ->where('year_id', '=', $selectedyearid)
                            ->where('team_level', '=', 1)
                            ->where(function ($query) use ($selectedteamid) {
                                $query->where('away_team_id', '=' , $selectedteamid)
                                    ->orWhere('home_team_id', '=', $selectedteamid);
                            })
                            ->orderBy('date')
                            ->get();


        //  Display schedule for team based on selected year
        $jvgolf = Golfboys::leftjoin('teams as home_team', 'golf_boys.home_team_id', '=', 'home_team.id')
                        ->leftjoin('teams as away_team', 'golf_boys.away_team_id', '=', 'away_team.id')
                        ->join('years', 'golf_boys.year_id', 'years.id')
                        ->join('times', 'golf_boys.time_id', '=', 'times.id')
                        ->leftjoin('teams as winner', 'golf_boys.winner', '=', 'winner.id')
                        ->leftjoin('teams as loser', 'golf_boys.loser', '=', 'loser.id')
                        ->select(
                            'away_team_id',
                            'home_team_id',
                            'golf_boys.id',
                            'golf_boys.date',
                            'year',
                            'scrimmage',
                            'time',
                            'golf_boys.tournament_title',
                            'away_team.school_name as away_team',
                            'away_team.logo as away_team_logo',
                            'home_team.school_name as home_team',
                            'home_team.logo as home_team_logo',
                            'winner.school_name as winning_team',
                            'loser.school_name as losing_team',
                            'match_score',
                            'team_level'
                            )
                            ->where('year_id', '=', $selectedyearid)
                            ->where('team_level', '=', 2)
                            ->where(function ($query) use ($selectedteamid) {
                                $query->where('away_team_id', '=' , $selectedteamid)
                                    ->orWhere('home_team_id', '=', $selectedteamid);
                            })
                            ->orderBy('date')
                            ->get();

        //  Display schedule for team based on selected year
        $freshgolf = Golfboys::leftjoin('teams as home_team', 'golf_boys.home_team_id', '=', 'home_team.id')
                        ->leftjoin('teams as away_team', 'golf_boys.away_team_id', '=', 'away_team.id')
                        ->join('years', 'golf_boys.year_id', 'years.id')
                        ->join('times', 'golf_boys.time_id', '=', 'times.id')
                        ->leftjoin('teams as winner', 'golf_boys.winner', '=', 'winner.id')
                        ->leftjoin('teams as loser', 'golf_boys.loser', '=', 'loser.id')
                        ->select(
                            'away_team_id',
                            'home_team_id',
                            'golf_boys.id',
                            'golf_boys.date',
                            'year',
                            'scrimmage',
                            'time',
                            'golf_boys.tournament_title',
                            'away_team.school_name as away_team',
                            'away_team.logo as away_team_logo',
                            'home_team.school_name as home_team',
                            'home_team.logo as home_team_logo',
                            'winner.school_name as winning_team',
                            'loser.school_name as losing_team',
                            'match_score',
                            'team_level'
                            )
                            ->where('year_id', '=', $selectedyearid)
                            ->where('team_level', '=', 3)
                            ->where(function ($query) use ($selectedteamid) {
                                $query->where('away_team_id', '=' , $selectedteamid)
                                    ->orWhere('home_team_id', '=', $selectedteamid);
                            })
                            ->orderBy('date')
                            ->get();



        return view('sports.golf_boys.teamschedule', compact('golf', 'jvgolf', 'freshgolf', 'selectedteam', 'selectedteamid', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years' ));

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
        $golf = Golfboys::join('years', 'golf_boys.year_id', 'years.id')
                            ->select('golf_boys.*')
                            ->where('year', '=', $year)
                            ->orderBy('date')
                            ->get();

        return view('sports.golf_boys.yearschedule', compact('golf', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

    }



    public function apiteamschedulesummary($year, $team)
    {

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        // return $theteam;

        $golf = Golfboys::leftjoin('teams as home_team', 'golf_boys.home_team_id', '=', 'home_team.id')
                        ->leftjoin('teams as away_team', 'golf_boys.away_team_id', '=', 'away_team.id')
                        ->join('years', 'golf_boys.year_id', 'years.id')
                        ->join('times', 'golf_boys.time_id', '=', 'times.id')
                        ->leftjoin('teams as winner', 'golf_boys.winner', '=', 'winner.id')
                        ->leftjoin('teams as loser', 'golf_boys.loser', '=', 'loser.id')
                        ->select(
                            'away_team_id',
                            'home_team_id',
                            'golf_boys.id',
                            'golf_boys.date',
                            'year',
                            'scrimmage',
                            'time',
                            'golf_boys.tournament_title',
                            'away_team.school_name as away_team',
                            'away_team.logo as away_team_logo',
                            'home_team.school_name as home_team',
                            'home_team.logo as home_team_logo',
                            'winner.school_name as winning_team',
                            'loser.school_name as losing_team',
                            'match_score',
                            'team_level'
                            )
                            ->where('year', '=', $year)
                            ->where('team_level', '=', 1)
                            ->where(function ($query) use ($theteam) {
                                $query->where('away_team_id', '=' , $theteam)
                                    ->orWhere('home_team_id', '=', $theteam);
                            })
                            ->where('date', '>=', Carbon::today()->toDateString())
                            ->limit(4)
                            ->orderBy('date', 'asc')
                            ->get();

        return $golf;

    }



    public function apiteamschedule($year, $team, $teamlevel)
    {

        $selectedyear = Year::where('year', $year)->pluck('year');
        $selectedyearid = Year::where('year', $year)->pluck('id');

        $selectedteam = Team::where('school_name', $team)->get();
        $selectedteamid =   Team::where('school_name', $team)->pluck('id');


        // Select All Teams
        $teams = Team::all();



        //  Select All Years
        $years = Year::all();



        //  Display schedule for team based on selected year
        $golf = Golfboys::leftjoin('teams as home_team', 'golf_boys.home_team_id', '=', 'home_team.id')
                        ->leftjoin('teams as away_team', 'golf_boys.away_team_id', '=', 'away_team.id')
                        ->join('years', 'golf_boys.year_id', 'years.id')
                        ->join('times', 'golf_boys.time_id', '=', 'times.id')
                        ->leftjoin('teams as winner', 'golf_boys.winner', '=', 'winner.id')
                        ->leftjoin('teams as loser', 'golf_boys.loser', '=', 'loser.id')
                        ->select(
                            'away_team_id',
                            'home_team_id',
                            'golf_boys.id',
                            'golf_boys.date',
                            'year',
                            'scrimmage',
                            'time',
                            'golf_boys.tournament_title',
                            'away_team.school_name as away_team',
                            'away_team.logo as away_team_logo',
                            'home_team.school_name as home_team',
                            'home_team.logo as home_team_logo',
                            'winner.school_name as winning_team',
                            'loser.school_name as losing_team',
                            'match_score',
                            'team_level'
                            )
                        ->where('year_id', '=', $selectedyearid)
                        ->where(function ($query) use ($selectedteamid) {
                            $query->where('away_team_id', '=' , $selectedteamid)
                                ->orWhere('home_team_id', '=', $selectedteamid);
                        })
                        ->where('team_level','=',$teamlevel)
                        ->orderBy('date', 'asc')
                        ->get();



        return $golf;

    }



    public function todaysevents($team)
    {

        $today = Carbon::today();

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $golf = Golfboys::leftjoin('teams as home_team', 'golf_boys.home_team_id', '=', 'home_team.id')
                        ->leftjoin('teams as away_team', 'golf_boys.away_team_id', '=', 'away_team.id')
                        ->join('years', 'golf_boys.year_id', 'years.id')
                        ->join('times', 'golf_boys.time_id', '=', 'times.id')
                        ->leftjoin('teams as winner', 'golf_boys.winner', '=', 'winner.id')
                        ->leftjoin('teams as loser', 'golf_boys.loser', '=', 'loser.id')
                        ->select(
                            'away_team_id',
                            'home_team_id',
                            'golf_boys.id',
                            'golf_boys.date',
                            'year',
                            'scrimmage',
                            'time',
                            'golf_boys.tournament_title',
                            'away_team.school_name as away_team',
                            'away_team.logo as away_team_logo',
                            'home_team.school_name as home_team',
                            'home_team.logo as home_team_logo',
                            'winner.school_name as winning_team',
                            'loser.school_name as losing_team',
                            'match_score',
                            'team_level'
                            )
                            ->where('team_level', '=', 1)
                            ->where(function ($query) use ($theteam) {
                                $query->where('away_team_id', '=' , $theteam)
                                    ->orWhere('home_team_id', '=', $theteam);
                            })
                            ->where('date', '=', $today)
                            ->orderBy('time')
                            ->get();

        return $golf;

    }

}
