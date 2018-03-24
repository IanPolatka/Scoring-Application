<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Track;
use App\Year;
use App\CurrentYear;
use App\Team;
use App\Time;

use Session;

class TrackController extends Controller
{

    public function __construct() 
    {
      $this->middleware('auth', ['only' => [ 'create', 'edit', 'delete' ]]);
    }
    
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
        $track = Track::where('year_id', $currentyear)->orderBy('date')->select('track.*')->get();

        return view('sports.track.index', compact('track', 'showcurrentyear', 'teams', 'years'));

    }



    public function show(track $track)
    {

        return view('sports.track.show', compact('track'));
        
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

        return view('sports.track.create', compact('thecurrentyear', 'years', 'times', 'teams'));

    }



    public function store(Request $request)
    {

        Track::create([

            'team_id'                   =>  request('team_id'),
            'team_level'                =>  request('team_level'),
            'year_id'                   =>  request('year_id'),
            'date'                      =>  request('date'),
            'scrimmage'                 =>  request('scrimmage'),
            'tournament_title'          =>  request('tournament_title'),
            'time_id'                   =>  request('time_id'),
            'boys_result'               =>  request('boys_result'),
            'girls_result'              =>  request('girls_result'),
            'host_id'                   =>  request('host_id'),
            'meet_location'             =>  request('meet_location')

        ]);

        return redirect('/track');

    }



    public function edit($id)
    {

        $track = Track::find($id);

        //  Display the current year
        $thecurrentyear = Year::find(1);

        //  Display all the years
        $years = Year::all();

        //  Display all teams
        $teams = Team::all();

        //  Display the game times
        $times = Time::all();

        return view('sports.track.edit', compact('years', 'thecurrentyear', 'teams', 'times', 'track'));

    }



    public function update(Request $request, track $track)
    {

        $track->update($request->all());

        return redirect('/track');

    }



    public function delete($id)
    {
        $track = Track::find($id);
        $track->delete();
        return redirect('/track');
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
        $track = Track::join('years', 'track.year_id', 'years.id')
                            ->select('track.*')
                            ->where('year_id', '=', $selectedyearid)
                            ->where('team_id', '=', $selectedteamid)
                            ->orderBy('date')
                            ->get();



        return view('sports.track.teamschedule', compact('track', 'selectedteam', 'selectedteamid', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years' ));

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
        $track = Track::join('years', 'track.year_id', 'years.id')
                            ->select('track.*')
                            ->where('year', '=', $year)
                            ->orderBy('date')
                            ->get();

        return view('sports.track.yearschedule', compact('track', 'selectedyear', 'selectedyearid', 'teams', 'year', 'years'));

    }



    public function apiteamschedule($year, $team, $teamlevel)
    {

        $theteam = Team::where('school_name', '=', $team)->pluck('id');

        $track = Track::join('teams as host', 'track.host_id', '=', 'host.id')
                                    ->join('teams as schedule_for','track.team_id', '=', 'schedule_for.id')
                                    ->join('years', 'track.year_id', '=', 'years.id')
                                    ->join('times', 'track.time_id', '=', 'times.id')
                                    ->select(
                                        'track.id',
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
                                    ->orderBy('date')
                                    ->get();

        return $track;

    }

}
