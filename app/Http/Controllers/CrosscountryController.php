<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Crosscountry;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

class CrosscountryController extends Controller
{
    
	public function index()
    {

        //  Query All Years
        $years = Year::all();

        //  Query All Teams
        $teams = Team::all()->sortBy('school_name');

        //  Query The Current Year
        $currentyear = CurrentYear::find(1)->pluck('year_id');
        $showcurrentyear = Year::where('id', $currentyear)->pluck('year');

        //  Query All Games By The Current Year
        $crosscountry = Crosscountry::where('year_id', $currentyear)->orderBy('date')->select('cross_country.*')->get();

        return view('sports.cross_country.index', compact('crosscountry', 'showcurrentyear', 'teams', 'years'));

    }



    public function show(crosscountry $crosscountry)
    {

        return view('sports.cross_country.show', compact('crosscountry'));
        
    }



    public function create()
    {

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all the teams
        $teams = Team::all()->sortBy('school_name');

        //  Display the game times
        $times = Time::all();

        return view('sports.cross_country.create', compact('thecurrentyear', 'years', 'times', 'teams'));

    }



    public function store(Request $request)
    {

        Crosscountry::create([

            'team_id'                   =>  request('team_id'),
            'team_level'                =>  request('team_level'),
            'year_id'                   =>  request('year_id'),
            'date'                      =>  request('date'),
            'scrimmage'                 =>  request('scrimmage'),
            'tournament_title'          =>  request('tournament_title'),
            'host_id'                   =>  request('host_id'),
            'meet_location'             =>  request('meet_location'),
            'time_id'                   =>  request('time_id'),
            'boys_result'               =>  request('boys_result'),
            'girls_result'				=>	request('girls_result')

        ]);

        return redirect('/cross-country');

    }



    public function edit($id)
    {

        $crosscountry = Crosscountry::find($id);

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all()->sortBy('school_name');

        //  Display the game times
        $times = Time::all();

        return view('sports.cross_country.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'crosscountry'));

    }



    public function update(Request $request, crosscountry $crosscountry)
    {

        $crosscountry->update($request->all());

        return redirect('/cross-country');

    }



    public function delete($id)
    {
        $crosscountry = Crosscountry::find($id);
        $crosscountry->delete();
        return redirect('/cross-country');
    }



    public function teamschedule($year, $team)
    {

        $selectedyear = Year::where('year', $year)->pluck('year');
        $selectedyearid = Year::where('year', $year)->pluck('id');

        $selectedteam = Team::where('school_name', $team)->get();
        $selectedteamid =   Team::where('school_name', $team)->pluck('id');


        // Select All Teams
        $teams = Team::all()->sortBy('school_name');

        // return $host_team;



        //  Select All Years
        $years = Year::all();



        //  Display schedule for team based on selected year
        $crosscountry = Crosscountry::join('years', 'cross_country.year_id', 'years.id')
                            ->select('cross_country.*')
                            ->where('year_id', '=', $selectedyearid)
                            ->where('team_id', '=', $selectedteamid)
                            ->orderBy('date')
                            ->get();

        return view('sports.cross_country.teamschedule', compact('crosscountry', 'selectedteam', 'selectedteamid', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years' ));

    }



    public function yearschedule($year)
    {

        //  Get id of the selected year
        $selectedyear = Year::where('year', $year)->pluck('year');
        $selectedyearid = Year::where('year', $year)->pluck('id');



        //  Select All Teams
        $teams = Team::all()->sortBy('school_name');



        //  Select All Years
        $years = Year::all();

        //  Display schedule for team based on selected year
        $crosscountry = Crosscountry::join('years', 'cross_country.year_id', 'years.id')
                            ->select('cross_country.*')
                            ->where('year', '=', '2017-2018')
                            ->orderBy('date')
                            ->get();

        return view('sports.cross_country.yearschedule', compact('crosscountry', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

    }



    public function apiteamschedule($year, $team, $teamlevel)
    {

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $crosscountry = Crosscountry::join('teams as host', 'cross_country.host_id', '=', 'host.id')
                                    ->join('teams as schedule_for','cross_country.team_id', '=', 'schedule_for.id')
                                    ->join('years', 'cross_country.year_id', '=', 'years.id')
                                    ->join('times', 'cross_country.time_id', '=', 'times.id')
                                    ->select(
                                        'cross_country.id',
                                        'schedule_for.school_name as schedule_for',
                                        'years.year',
                                        'date',
                                        'scrimmage',
                                        'host.school_name as host_school',
                                        'tournament_title',
                                        'meet_location',
                                        'host.logo as host_school_logo',
                                        'times.time',
                                        'boys_result',
                                        'girls_result'
                                    )
                                    ->where('year', '=', $year)
                                    ->where('team_id', '=', $theteam)
                                    ->where('team_level', '=', $teamlevel)
                                    ->get();

        return $crosscountry;

    }



    public function apiteamschedulesummary($year, $team)
    {

        $date = Carbon::today('America/New_York')->toDateTimeString();

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $crosscountry = Crosscountry::join('teams as host', 'cross_country.host_id', '=', 'host.id')
                                    ->join('teams as schedule_for','cross_country.team_id', '=', 'schedule_for.id')
                                    ->join('years', 'cross_country.year_id', '=', 'years.id')
                                    ->join('times', 'cross_country.time_id', '=', 'times.id')
                                    ->select(
                                        'cross_country.id',
                                        'schedule_for.school_name as schedule_for',
                                        'years.year',
                                        'date',
                                        'scrimmage',
                                        'host.school_name as host_school',
                                        'tournament_title',
                                        'meet_location',
                                        'host.logo as host_school_logo',
                                        'times.time',
                                        'boys_result',
                                        'girls_result'
                                    )
                                    ->where('year', '=', $year)
                                    ->where('team_id', '=', $theteam)
                                    ->where('cross_country.team_level', '=', 1)
                                    ->where('date', '>=', $date)
                                    ->orderBy('date')
                                    ->limit(4)
                                    ->get();

        return $crosscountry;

    }



    public function todaysevents($team)
    {

        $today = Carbon::today();

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $crosscountry = Crosscountry::join('teams as team', 'cross_country.team_id', '=', 'team.id')
                                ->join('years', 'cross_country.year_id', '=', 'years.id')
                                ->join('times', 'cross_country.time_id', '=', 'times.id')
                                ->select(
                                    'cross_country.id',
                                    'cross_country.team_level',
                                    'cross_country.date',
                                    'year',
                                    'time',
                                    'cross_country.tournament_title',
                                    'team.school_name as team_name',
                                    'team.logo as as team_logo',
                                    'cross_country.boys_result',
                                    'cross_country.girls_result'
                                )
                            ->where('team_id', '=', $theteam)
                            ->where('date', '=', $today)
                            ->orderBy('time')
                            ->get();

        return $crosscountry;

    }



}
