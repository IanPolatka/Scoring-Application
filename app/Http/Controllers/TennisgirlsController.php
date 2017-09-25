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

}
