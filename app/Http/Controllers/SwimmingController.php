<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Swimming;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

class SwimmingController extends Controller
{
    
	public function index()
    {

        //  Query All Years
        $years = Year::all();

        //  Query All Teams
        $teams = Team::all();

        //  Query The Current Year
        $currentyear = CurrentYear::find(1)->pluck('year_id');
        $showcurrentyear = Year::where('id', $currentyear)->pluck('year');

        //  Query All Games By The Current Year
        $swimming = Swimming::where('year_id', $currentyear)->orderBy('date')->select('swimming.*')->get();

        return view('sports.swimming.index', compact('swimming', 'showcurrentyear', 'teams', 'years'));

    }



    public function show(swimming $swimming)
    {

        return view('sports.swimming.show', compact('swimming'));
        
    }



    public function create()
    {

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all the teams
        $teams = Team::all();

        //  Display the game times
        $times = Time::all();

        return view('sports.swimming.create', compact('thecurrentyear', 'years', 'times', 'teams'));

    }



    public function store(Request $request)
    {

        Swimming::create([

            'team_id'                   =>  request('team_id'),
            'team_level'                =>  request('team_level'),
            'year_id'                   =>  request('year_id'),
            'date'                      =>  request('date'),
            'scrimmage'                 =>  request('scrimmage'),
            'tournament_title'          =>  request('tournament_title'),
            'time_id'                   =>  request('time_id'),
            'boys_result'               =>  request('boys_result'),
            'girls_result'              =>  request('girls_result')

        ]);

        return redirect('/swimming');

    }



    public function edit($id)
    {

        $swimming = Swimming::find($id);

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all();

        //  Display the game times
        $times = Time::all();

        return view('sports.swimming.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'swimming'));

    }



    public function update(Request $request, swimming $swimming)
    {

        $swimming->update($request->all());

        return redirect('/swimming');

    }



    public function delete($id)
    {
        $swimming = Swimming::find($id);
        $swimming->delete();
        return redirect('/swimming');
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
        $swimming = Swimming::join('years', 'swimming.year_id', 'years.id')
                            ->select('swimming.*')
                            ->where('year_id', '=', $selectedyearid)
                            ->where('team_id', '=', $selectedteamid)
                            ->orderBy('date')
                            ->get();



        return view('sports.swimming.teamschedule', compact('swimming', 'selectedteam', 'selectedteamid', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years' ));

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
        $swimming = Swimming::join('years', 'swimming.year_id', 'years.id')
                            ->select('swimming.*')
                            ->where('year', '=', $year)
                            ->orderBy('date')
                            ->get();

        return view('sports.swimming.yearschedule', compact('swimming', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

    }



    public function apiteamschedule($year, $team, $teamlevel)
    {

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $swimming = Swimming::join('teams as schedule_for','swimming.team_id', '=', 'schedule_for.id')
                                    ->join('years', 'swimming.year_id', '=', 'years.id')
                                    ->join('times', 'swimming.time_id', '=', 'times.id')
                                    ->select(
                                        'swimming.id',
                                        'schedule_for.school_name as schedule_for',
                                        'years.year',
                                        'date',
                                        'tournament_title',
                                        'times.time',
                                        'boys_result',
                                        'girls_result'
                                    )
                                    ->where('year', '=', $year)
                                    ->where('team_id', '=', $theteam)
                                    ->where('team_level', '=', $teamlevel)
                                    ->get();

        return $swimming;

    }

}
