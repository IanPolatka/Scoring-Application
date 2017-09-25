@extends('layouts.app')

@section('content')



<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                Volleyball

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  Container  -->

</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

            <div class="row">

                <div class="col-lg-6 col-md-6 col-md-6 col-xs-6">

                    <div class="form-group">

                        <select name="home_team_id" id="home_team_id" class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Team's Schedule</option>

                            @foreach($teams as $team)

                                <option value="/volleyball/{{$showcurrentyear[0]}}/{{ $team->school_name }}">
                                    {{ $team->school_name }} ({{ $team->city }}, {{ $team->state }})
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-md-6 col-xs-6">

                    <div class="form-group">

                        <select name="home_team_id"class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Year Schedule</option>

                            @foreach($years as $year)

                              <option value="/volleyball/{{ $year->year }}" @if ($showcurrentyear[0] == $year->year) selected @endif>
                                {{ $year->year }}
                              </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                

            </div>
    

           <div class="content-box">

                    <h4>Today's Games <small>({{ Carbon\Carbon::parse($date[0])->format('l M j, o') }})</small></h4>

                    <ul class="schedule-list">

                        @if (Auth::user())

                            <a href="/volleyball/create" class="create-game">
                                <li>
                                    <img src="/images/team-logos/create-game.png">Create Match
                                </li>
                                <div class="clearfix"></div>
                            </a>

                        @endif

                        @forelse ($volleyball as $item)

                            <li><a href="volleyball/match/{{ $item->id }}">

                                <div class="team">
                                
                                    @if ( $item['away_team']['logo'] )
                                        <img src="/images/team-logos/{{ $item['away_team']['logo'] }}">
                                    @endif

                                    {{ $item['away_team']['school_name'] }}

                                    @if (($item->game_status > 0) && ($item->game_status < 6))

                                        <strong class="pull-right game-list-status">
                                            <span style="color: red;">LIVE</span>
                                        </strong>

                                    @endif

                                </div>

                                <div class="team">

                                    @if ( $item['home_team']['logo'] )
                                        <img src="/images/team-logos/{{ $item->home_team->logo }}"> 
                                    @endif

                                    {{ $item['home_team']['school_name'] }}

                                </div>

                            </a></li>

                        @empty

                            <li>No Matches Posted</li>

                        @endforelse

                    </ul>

            </div>

            <div class="content-box">

                    <h4>Yesterday's Matches <small>({{ Carbon\Carbon::parse($yesterday)->format('l M j, o') }})</small></h4>

                    <ul class="schedule-list">

                        @forelse ($countYesterday as $item)

                            <li><a href="volleyball/match/{{ $item->id }}">

                                <div class="team">
                                
                                    @if ( $item['away_team']['logo'] )
                                        <img src="/images/team-logos/{{ $item['away_team']['logo'] }}">
                                    @endif

                                    {{ $item['away_team']['school_name'] }}

                                    @if (($item->game_status > 0) && ($item->game_status < 6))

                                        <strong class="pull-right game-list-status">
                                            <span style="color: red;">LIVE</span>
                                        </strong>

                                    @endif

                                </div>

                                <div class="team">

                                    @if ( $item['home_team']['logo'] )
                                        <img src="/images/team-logos/{{ $item->home_team->logo }}"> 
                                    @endif

                                    {{ $item['home_team']['school_name'] }}

                                </div>

                            </a></li>

                        @empty

                            <li>No Matches Posted</li>

                        @endforelse

                    </ul>


            </div>



            <div class="content-box">

                    <h4>Tomorrow's Matches <small>({{ Carbon\Carbon::parse($tomorrow)->format('l M j, o') }})</small></h4>

                    <ul class="schedule-list">

                        @forelse ($countTomorrow as $item)

                            <li><a href="volleyball/match/{{ $item->id }}">

                                <div class="team">
                                
                                    @if ( $item['away_team']['logo'] )
                                        <img src="/images/team-logos/{{ $item['away_team']['logo'] }}">
                                    @endif

                                    {{ $item['away_team']['school_name'] }}

                                    @if (($item->game_status > 0) && ($item->game_status < 6))

                                        <strong class="pull-right game-list-status">
                                            <span style="color: red;">LIVE</span>
                                        </strong>

                                    @endif

                                </div>

                                <div class="team">

                                    @if ( $item['home_team']['logo'] )
                                        <img src="/images/team-logos/{{ $item->home_team->logo }}"> 
                                    @endif

                                    {{ $item['home_team']['school_name'] }}

                                </div>

                            </a></li>

                        @empty

                            <li>No Matches Posted</li>

                        @endforelse

                    </ul>


            </div>

        </div>

    </div>
</div>


@endsection
