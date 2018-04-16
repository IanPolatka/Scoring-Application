<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Golfgirls;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

class GolfgirlsController extends Controller
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
        $golf = Golfgirls::where('year_id', $currentyear)->orderBy('date')->select('golf_girls.*')->get();

        return view('sports.golf_girls.index', compact('golf', 'showcurrentyear', 'teams', 'years'));

    }



    public function show(golfgirls $golfgirls)
    {

        return view('sports.golf_girls.show', compact('golfgirls'));
        
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

        return view('sports.golf_girls.create', compact('thecurrentyear', 'years', 'teams', 'times'));

    }



    public function store(Request $request)
    {

        Golfgirls::create([

            'year_id'                   =>  request('year_id'),
            'team_level'                =>  request('team_level'),
            'date'                      =>  request('date'),
            'scrimmage'                 =>  request('scrimmage'),
            'tournament_title'          =>  request('tournament_title'),
            'away_team_id'              =>  request('away_team_id'),
            'home_team_id'              =>  request('home_team_id'),
            'time_id'                   =>  request('time_id')

        ]);

        return redirect('/golf-girls');

    }



    public function edit($id)
    {

        $golf = Golfgirls::find($id);

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all();

        //  Display the game times
        $times = Time::all();

        return view('sports.golf_girls.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'golf', 'away_team'));

    }



    public function update(Request $request, golfgirls $golfgirls)
    {

        $golfgirls->update($request->all());

        return redirect('/golf-girls');

    }



    public function delete($id)
    {
        $golf = Golfgirls::find($id);
        $golf->delete();
        return redirect('/golf-girls');
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
        $golf = Golfgirls::join('years', 'golf_girls.year_id', 'years.id')
                            ->select('golf_girls.*')
                            ->where('year_id', '=', $selectedyearid)
                            ->where(function ($query) use ($selectedteamid) {
                                $query->where('away_team_id', '=' , $selectedteamid)
                                    ->orWhere('home_team_id', '=', $selectedteamid);
                            })
                            ->orderBy('date')
                            ->get();



        return view('sports.golf_girls.teamschedule', compact('golf', 'selectedteam', 'selectedteamid', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years' ));

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
        $golf = Golfgirls::join('years', 'golf_girls.year_id', 'years.id')
                            ->select('golf_girls.*')
                            ->where('year', '=', $year)
                            ->orderBy('date')
                            ->get();

        return view('sports.golf_girls.yearschedule', compact('golf', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

    }



    public function apiteamschedulesummary($year, $team)
    {

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        // return $theteam;

        $golf = Golfgirls::leftjoin('teams as home_team', 'golf_girls.home_team_id', '=', 'home_team.id')
                        ->leftjoin('teams as away_team', 'golf_girls.away_team_id', '=', 'away_team.id')
                        ->join('years', 'golf_girls.year_id', 'years.id')
                        ->join('times', 'golf_girls.time_id', '=', 'times.id')
                        ->leftjoin('teams as winner', 'golf_girls.winner', '=', 'winner.id')
                        ->leftjoin('teams as loser', 'golf_girls.loser', '=', 'loser.id')
                        ->select(
                            'away_team_id',
                            'home_team_id',
                            'golf_girls.id',
                            'golf_girls.date',
                            'year',
                            'scrimmage',
                            'time',
                            'golf_girls.tournament_title',
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
        $golf = Golfgirls::leftjoin('teams as home_team', 'golf_girls.home_team_id', '=', 'home_team.id')
                        ->leftjoin('teams as away_team', 'golf_girls.away_team_id', '=', 'away_team.id')
                        ->join('years', 'golf_girls.year_id', 'years.id')
                        ->join('times', 'golf_girls.time_id', '=', 'times.id')
                        ->leftjoin('teams as winner', 'golf_girls.winner', '=', 'winner.id')
                        ->leftjoin('teams as loser', 'golf_girls.loser', '=', 'loser.id')
                        ->select(
                            'away_team_id',
                            'home_team_id',
                            'golf_girls.id',
                            'golf_girls.date',
                            'year',
                            'scrimmage',
                            'time',
                            'golf_girls.tournament_title',
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

        $golf = Golfgirls::leftjoin('teams as home_team', 'golf_girls.home_team_id', '=', 'home_team.id')
                        ->leftjoin('teams as away_team', 'golf_girls.away_team_id', '=', 'away_team.id')
                        ->join('years', 'golf_girls.year_id', 'years.id')
                        ->join('times', 'golf_girls.time_id', '=', 'times.id')
                        ->leftjoin('teams as winner', 'golf_girls.winner', '=', 'winner.id')
                        ->leftjoin('teams as loser', 'golf_girls.loser', '=', 'loser.id')
                        ->select(
                            'away_team_id',
                            'home_team_id',
                            'golf_girls.id',
                            'golf_girls.date',
                            'year',
                            'scrimmage',
                            'time',
                            'golf_girls.tournament_title',
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
