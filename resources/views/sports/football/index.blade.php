@extends('layouts.app')

@section('content')

<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                Football

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  Container  -->

</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

            <div class="row">

                <div @if (Auth::user()) class="col-lg-5" @else class="col-lg-6" @endif>

                    <div class="form-group">

                        <select name="home_team_id" id="home_team_id" class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Team's Schedule</option>

                            @foreach($teams as $team)

                                <option value="/football/{{$showcurrentyear[0]}}/{{ $team->school_name }}">
                                    {{ $team->school_name }} ({{ $team->city }}, {{ $team->state }})
                                </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  -->

                </div>

                <div @if (Auth::user()) class="col-lg-5" @else class="col-lg-6" @endif>

                    <div class="form-group">

                        <select name="home_team_id"class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Year Schedule</option>

                            @foreach($years as $year)

                              <option value="/football/{{ $year->year }}" @if ($showcurrentyear[0] == $year->year) selected @endif>
                                {{ $year->year }}
                              </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  --> 

                </div><!--  Col  -->

                

            </div>
    

           <div class="content-box">

                    <h4>Today's Games <small>({{ Carbon\Carbon::parse($date[0])->format('l M j, o') }})</small></h4>

                    <ul class="schedule-list">

                        @if (Auth::user())

                            <a href="/football/create" class="create-game">
                                <li>
                                    <img src="/images/team-logos/create-game.png">Create Game
                                </li>
                                <div class="clearfix"></div>
                            </a>

                        @endif

                        @forelse ($football as $item)

                            <li><a href="football/game/{{ $item->id }}">

                                <div class="team">
                                
                                    @if ( $item->away_team->logo )
                                        <img src="/images/team-logos/{{ $item->away_team->logo }}">
                                    @endif

                                    @if ($item->winning_team == $item->away_team_id)@endif

                                    {{ $item->away_team->school_name }}

                                    @if ($item->game_status < 1)

                                        <strong class="pull-right game-list-status">{{ $item->time->time }}</strong>

                                    @elseif (($item->game_status > 0) && ($item->game_status < 7))

                                        <strong class="pull-right game-list-status">
                                            <span style="color: red;">LIVE</span>
                                        </strong>

                                    @endif

                                    <span class="pull-right">{{ $item->away_team_final_score }}</span>

                                    @if ($item->winning_team == $item->away_team_id)</strong>@endif

                                </div><!--  Team  -->

                                <div class="team">

                                    @if ( $item->home_team->logo )
                                        <img src="/images/team-logos/{{ $item->home_team->logo }}"> 
                                    @endif

                                    @if ($item->winning_team == $item->home_team_id)<strong>@endif

                                    {{ $item->home_team->school_name }}

                                    <span class="pull-right">{{ $item->home_team_final_score }}</span>

                                    @if ($item->winning_team == $item->home_team_id)</strong>@endif

                                </div><!--  Team  -->

                            </a></li>

                        @empty

                            <li>No Games Posted</li>

                        @endforelse

                    </ul>

            </div>

            <div class="content-box">

                    <h4>Yesterday's Games <small>({{ Carbon\Carbon::parse($yesterday)->format('l M j, o') }})</small></h4>

                    <ul class="schedule-list">

                        @forelse ($countYesterday as $item)

                            <li><a href="football/game/{{ $item->id }}">

                                <div class="team">
                                
                                    @if ( $item->away_team->logo )
                                        <img src="/images/team-logos/{{ $item->away_team->logo }}">
                                    @endif

                                    @if ($item->winning_team == $item->away_team_id)@endif

                                    {{ $item->away_team->school_name }}

                                    @if ($item->game_status < 1)

                                        <strong class="pull-right game-list-status">{{ $item->time->time }}</strong>

                                    @elseif (($item->game_status > 0) && ($item->game_status < 7))

                                        <strong class="pull-right game-list-status">
                                            <span style="color: red;">LIVE</span>
                                        </strong>

                                    @endif

                                    <span class="pull-right">{{ $item->away_team_final_score }}</span>

                                    @if ($item->winning_team == $item->away_team_id)</strong>@endif

                                </div><!--  Team  -->

                                <div class="team">

                                    @if ( $item->home_team->logo )
                                        <img src="/images/team-logos/{{ $item->home_team->logo }}"> 
                                    @endif

                                    @if ($item->winning_team == $item->home_team_id)<strong>@endif

                                    {{ $item->home_team->school_name }}

                                    <span class="pull-right">{{ $item->home_team_final_score }}</span>

                                    @if ($item->winning_team == $item->home_team_id)</strong>@endif

                                </div><!--  Team  -->

                            </a></li>

                        @empty

                            <li>No Games Posted</li>

                        @endforelse

                    </ul>


            </div>



            <div class="content-box">

                    <h4>Tomorrows's Games <small>({{ Carbon\Carbon::parse($tomorrow)->format('l M j, o') }})</small></h4>

                    <ul class="schedule-list">

                        @forelse ($countTomorrow as $item)

                            <li><a href="football/game/{{ $item->id }}">

                                <div class="team">
                                
                                    @if ( $item->away_team->logo )
                                        <img src="/images/team-logos/{{ $item->away_team->logo }}">
                                    @endif

                                    @if ($item->winning_team == $item->away_team_id)@endif

                                    {{ $item->away_team->school_name }}

                                    @if ($item->game_status < 1)

                                        <strong class="pull-right game-list-status">{{ $item->time->time }}</strong>

                                    @elseif (($item->game_status > 0) && ($item->game_status < 7))

                                        <strong class="pull-right game-list-status">
                                            <span style="color: red;">LIVE</span>
                                        </strong>

                                    @endif

                                    <span class="pull-right">{{ $item->away_team_final_score }}</span>

                                    @if ($item->winning_team == $item->away_team_id)</strong>@endif

                                </div><!--  Team  -->

                                <div class="team">

                                    @if ( $item->home_team->logo )
                                        <img src="/images/team-logos/{{ $item->home_team->logo }}"> 
                                    @endif

                                    @if ($item->winning_team == $item->home_team_id)<strong>@endif

                                    {{ $item->home_team->school_name }}

                                    <span class="pull-right">{{ $item->home_team_final_score }}</span>

                                    @if ($item->winning_team == $item->home_team_id)</strong>@endif

                                </div><!--  Team  -->

                            </a></li>

                        @empty

                            <li>No Games Posted</li>

                        @endforelse

                    </ul>


            </div>

        </div>

    </div>
</div>
@endsection
