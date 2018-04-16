<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Bowlinggirls;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

class BowlinggirlsController extends Controller
{

    public function __construct() 
    {
      $this->middleware('auth', ['only' => [ 'create', 'edit', 'delete' ]]);
    }

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
        $bowling = Bowlinggirls::where('year_id', $currentyear)->orderBy('date')->select('bowling_girls.*')->get();

        return view('sports.bowling_girls.index', compact('bowling', 'showcurrentyear', 'teams', 'years'));

    }



    public function show(bowlinggirls $bowlinggirls)
    {

        return view('sports.bowling_girls.show', compact('bowlinggirls'));
        
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

        return view('sports.bowling_girls.create', compact('thecurrentyear', 'years', 'teams', 'times'));

    }



    public function store(Request $request)
    {

        Bowlinggirls::create([

            'year_id'                   =>  request('year_id'),
            'team_level'                =>  request('team_level'),
            'date'                      =>  request('date'),
            'scrimmage'                 =>  request('scrimmage'),
            'tournament_title'          =>  request('tournament_title'),
            'away_team_id'              =>  request('away_team_id'),
            'home_team_id'              =>  request('home_team_id'),
            'time_id'                   =>  request('time_id')

        ]);

        return redirect('/bowling-girls');

    }



    public function edit($id)
    {

        $bowling = Bowlinggirls::find($id);

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all();

        //  Display the game times
        $times = Time::all();

        return view('sports.bowling_girls.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'bowling', 'away_team'));

    }



    public function update(Request $request, bowlinggirls $bowlinggirls)
    {

        $bowlinggirls->update($request->all());

        return redirect('/bowling-girls');

    }



    public function delete($id)
    {
        $bowling = Bowlinggirls::find($id);
        $bowling->delete();
        return redirect('/bowling-girls');
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
        $bowling = Bowlinggirls::join('years', 'bowling_girls.year_id', 'years.id')
                            ->select('bowling_girls.*')
                            ->where('year_id', '=', $selectedyearid)
                            ->where(function ($query) use ($selectedteamid) {
                                $query->where('away_team_id', '=' , $selectedteamid)
                                    ->orWhere('home_team_id', '=', $selectedteamid);
                            })
                            ->orderBy('date')
                            ->get();



        return view('sports.bowling_girls.teamschedule', compact('bowling', 'selectedteam', 'selectedteamid', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years' ));

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
        $bowling = Bowlinggirls::join('years', 'bowling_girls.year_id', 'years.id')
                            ->select('bowling_girls.*')
                            ->where('year', '=', $year)
                            ->orderBy('date')
                            ->get();

        return view('sports.bowling_girls.yearschedule', compact('bowling', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

    }



    public function apiteamschedule($year, $team, $teamlevel)
    {

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $bowling = Bowlinggirls::join('teams as home_team', 'bowling_girls.home_team_id', '=', 'home_team.id')
                            ->join('teams as away_team', 'bowling_girls.away_team_id', '=', 'away_team.id')
                            ->join('years', 'bowling_girls.year_id', '=', 'years.id')
                            ->join('times', 'bowling_girls.time_id', '=', 'times.id')
                            ->leftjoin('teams as winning', 'bowling_girls.winner', '=', 'winning.id')
                            ->leftjoin('teams as losing', 'bowling_girls.loser', '=', 'losing.id')
                            ->select(
                                    'bowling_girls.id',
                                    'bowling_girls.date',
                                    'year',
                                    'scrimmage',
                                    'time',
                                    'bowling_girls.tournament_title',
                                    'away_team.school_name as away_team',
                                    'away_team.logo as away_team_logo',
                                    'home_team.school_name as home_team',
                                    'home_team.logo as home_team_logo',
                                    'winning.school_name as winner_team',
                                    'losing.school_name as losing_team',
                                    'bowling_girls.match_score'
                                )
                            ->where('year', '=', $year)
                            ->where(function ($query) use ($theteam) {
                                $query->where('away_team_id', '=' , $theteam)
                                    ->orWhere('home_team_id', '=', $theteam);
                            })
                            ->where('team_level', '=', $teamlevel)
                            ->orderBy('date')
                            ->get();

        return $bowling;

    }



    public function todaysevents($team)
    {

        $today = Carbon::today();

        // return $today;

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $bowling = Bowlinggirls::join('teams as home_team', 'bowling_girls.home_team_id', '=', 'home_team.id')
                            ->join('teams as away_team', 'bowling_girls.away_team_id', '=', 'away_team.id')
                            ->join('years', 'bowling_girls.year_id', '=', 'years.id')
                            ->join('times', 'bowling_girls.time_id', '=', 'times.id')
                            ->select(
                                    'bowling_girls.id',
                                    'bowling_girls.date',
                                    'year',
                                    'scrimmage',
                                    'time',
                                    'away_team.school_name as away_team',
                                    'away_team.logo as away_team_logo',
                                    'home_team.school_name as home_team',
                                    'home_team.logo as home_team_logo',
                                    'bowling_girls.team_level'
                                )
                            ->where('bowling_girls.team_level', '=', 1)
                            ->where(function ($query) use ($theteam) {
                                $query->where('away_team_id', '=' , $theteam)
                                    ->orWhere('home_team_id', '=', $theteam);
                            })
                            ->where('date', '=', $today)
                            ->orderBy('time')
                            ->get();

        return $bowling;

    }

}
