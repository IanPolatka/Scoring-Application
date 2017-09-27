<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Football;
use App\Team;
use App\Time;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $football = Football::join('teams as home_team', 'football.home_team_id', '=', 'home_team.id')
                            ->join('teams as away_team', 'football.away_team_id', '=', 'away_team.id')
                            ->join('times', 'football.time_id', '=', 'times.id')
                            ->select(
                                'football.id',
                                'away_team.school_name as away_team',
                                'away_team.abbreviated_name as away_team_abbreviated_name',
                                'away_team.mascot as away_team_mascot',
                                'away_team.logo as away_team_logo',
                                'away_team.city as away_team_city',
                                'away_team.state as away_team_state',
                                'home_team.school_name as home_team',
                                'home_team.abbreviated_name as home_team_abbreviated_name',
                                'home_team.mascot as home_team_mascot',
                                'home_team.logo as home_team_logo',
                                'home_team.city as home_team_city',
                                'home_team.state as home_team_state',
                                'football.game_status',
                                'time',
                                'away_team_first_qrt_score',
                                'away_team_second_qrt_score',
                                'away_team_third_qrt_score',
                                'away_team_fourth_qrt_score',
                                'away_team_overtime_score',
                                'away_team_final_score',
                                'home_team_first_qrt_score',
                                'home_team_second_qrt_score',
                                'home_team_third_qrt_score',
                                'home_team_fourth_qrt_score',
                                'home_team_overtime_score',
                                'home_team_final_score',
                                'football.winning_team',
                                'football.losing_team'
                            )
                            ->whereDate('date', Carbon::today())
                            ->where('team_level', 1)
                            ->get();

        // return $football;

        return view('home', compact('football'));
    }
}
