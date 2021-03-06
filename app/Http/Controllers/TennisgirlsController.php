<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Tennisgirls;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

class TennisgirlsController extends Controller
{

    public function __construct() 
    {
      $this->middleware('auth', ['only' => [ 'create', 'edit', 'delete' ]]);
    }
    
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
        $tennis = Tennisgirls::where('year_id', $currentyear)->orderBy('date')->select('tennis_girls.*')->get();

        return view('sports.tennis_girls.index', compact('tennis', 'showcurrentyear', 'teams', 'years'));

    }



    public function show(tennisgirls $tennisgirls)
    {

        return view('sports.tennis_girls.show', compact('tennisgirls'));
        
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

        return view('sports.tennis_girls.create', compact('thecurrentyear', 'years', 'teams', 'times'));

    }



    public function store(Request $request)
    {

        Tennisgirls::create([

            'year_id'                   =>  request('year_id'),
            'team_level'                =>  request('team_level'),
            'date'                      =>  request('date'),
            'scrimmage'                 =>  request('scrimmage'),
            'tournament_title'          =>  request('tournament_title'),
            'away_team_id'              =>  request('away_team_id'),
            'home_team_id'              =>  request('home_team_id'),
            'time_id'                   =>  request('time_id')

        ]);

        return redirect('/tennis-girls');

    }



    public function edit($id)
    {

        $tennis = Tennisgirls::find($id);

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all();

        //  Display the game times
        $times = Time::all();

        return view('sports.tennis_girls.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'tennis', 'away_team'));

    }



    public function update(Request $request, tennisgirls $tennisgirls)
    {

        $tennisgirls->update($request->all());

        return redirect('/tennis-girls');

    }



    public function delete($id)
    {
        $tennis = Tennisgirls::find($id);
        $tennis->delete();
        return redirect('/tennis-girls');
    }



    public function teamschedule($year, $team)
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
        $tennis = Tennisgirls::join('years', 'tennis_girls.year_id', 'years.id')
                            ->select('tennis_girls.*')
                            ->where('year_id', '=', $selectedyearid)
                            ->where(function ($query) use ($selectedteamid) {
                                $query->where('away_team_id', '=' , $selectedteamid)
                                    ->orWhere('home_team_id', '=', $selectedteamid);
                            })
                            ->orderBy('date')
                            ->get();



        return view('sports.tennis_girls.teamschedule', compact('tennis', 'selectedteam', 'selectedteamid', 'selectedyear', 
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
        $tennis = Tennisgirls::join('years', 'tennis_girls.year_id', 'years.id')
                            ->select('tennis_girls.*')
                            ->where('year', '=', $year)
                            ->orderBy('date')
                            ->get();

        return view('sports.tennis_girls.yearschedule', compact('tennis', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

    }



    public function apiteamschedule($year, $team, $teamlevel)
    {

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $tennis = Tennisgirls::join('teams as home_team', 'tennis_girls.home_team_id', '=', 'home_team.id')
                            ->join('teams as away_team', 'tennis_girls.away_team_id', '=', 'away_team.id')
                            ->join('years', 'tennis_girls.year_id', '=', 'years.id')
                            ->join('times', 'tennis_girls.time_id', '=', 'times.id')
                            ->leftjoin('teams as winning', 'tennis_girls.winner', '=', 'winning.id')
                            ->leftjoin('teams as losing', 'tennis_girls.loser', '=', 'losing.id')
                            ->select(
                                    'tennis_girls.id',
                                    'tennis_girls.date',
                                    'year',
                                    'scrimmage',
                                    'time',
                                    'tennis_girls.tournament_title',
                                    'away_team.school_name as away_team',
                                    'away_team.logo as away_team_logo',
                                    'away_team.mascot as away_team_mascot',
                                    'home_team.school_name as home_team',
                                    'home_team.logo as home_team_logo',
                                    'home_team.mascot as home_team_mascot',
                                    'winning.school_name as winner_team',
                                    'losing.school_name as losing_team',
                                    'tennis_girls.match_score'
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

        $tennis = Tennisgirls::join('teams as home_team', 'tennis_girls.home_team_id', '=', 'home_team.id')
                            ->join('teams as away_team', 'tennis_girls.away_team_id', '=', 'away_team.id')
                            ->join('years', 'tennis_girls.year_id', '=', 'years.id')
                            ->join('times', 'tennis_girls.time_id', '=', 'times.id')
                            ->select(
                                    'tennis_girls.id',
                                    'tennis_girls.date',
                                    'year',
                                    'scrimmage',
                                    'time',
                                    'away_team.school_name as away_team',
                                    'away_team.logo as away_team_logo',
                                    'home_team.school_name as home_team',
                                    'home_team.logo as home_team_logo',
                                    'tennis_girls.team_level'
                                )
                            ->where('tennis_girls.team_level', '=', 1)
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
