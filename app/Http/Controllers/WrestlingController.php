<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Wrestling;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

class WrestlingController extends Controller
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
        $wrestling = Wrestling::where('year_id', $currentyear)->orderBy('date')->select('wrestling.*')->get();

        return view('sports.wrestling.index', compact('wrestling', 'showcurrentyear', 'teams', 'years'));

    }



    public function show(wrestling $wrestling)
    {

        return view('sports.wrestling.show', compact('wrestling'));
        
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

        return view('sports.wrestling.create', compact('thecurrentyear', 'years', 'times', 'teams'));

    }



    public function store(Request $request)
    {

        Wrestling::create([

            'team_id'                   =>  request('team_id'),
            'team_level'                =>  request('team_level'),
            'year_id'                   =>  request('year_id'),
            'date'                      =>  request('date'),
            'scrimmage'                 =>  request('scrimmage'),
            'tournament_title'          =>  request('tournament_title'),
            'time_id'                   =>  request('time_id'),
            'result'                    =>  request('result')

        ]);

        return redirect('/wrestling');

    }



    public function edit($id)
    {

        $wrestling = Wrestling::find($id);

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all();

        //  Display the game times
        $times = Time::all();

        return view('sports.wrestling.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'wrestling'));

    }



    public function update(Request $request, wrestling $wrestling)
    {

        $wrestling->update($request->all());

        return redirect('/wrestling');

    }



    public function delete($id)
    {
        $wrestling = Wrestling::find($id);
        $wrestling->delete();
        return redirect('/wrestling');
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
        $wrestling = Wrestling::join('years', 'wrestling.year_id', 'years.id')
                            ->select('wrestling.*')
                            ->where('year_id', '=', $selectedyearid)
                            ->where('team_id', '=', $selectedteamid)
                            ->orderBy('date')
                            ->get();



        return view('sports.wrestling.teamschedule', compact('wrestling', 'selectedteam', 'selectedteamid', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years' ));

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
        $wrestling = Wrestling::join('years', 'wrestling.year_id', 'years.id')
                            ->select('wrestling.*')
                            ->where('year', '=', $year)
                            ->orderBy('date')
                            ->get();

        return view('sports.wrestling.yearschedule', compact('wrestling', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

    }



    public function apiteamschedule($year, $team, $teamlevel)
    {

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $wrestling = Wrestling::join('years', 'wrestling.year_id', '=', 'years.id')
                                 ->join('times', 'wrestling.time_id', '=', 'times.id')
                                 ->select(
                                    'wrestling.id',
                                    'years.year',
                                    'date',
                                    'tournament_title',
                                    'meet_location',
                                    'times.time',
                                    'result',
                                )
                                ->where('year', '=', $year)
                                ->where('team_id', '=', $theteam)
                                ->where('team_level', '=', $teamlevel)
                                ->get();

        return $wrestling;

    }

}
