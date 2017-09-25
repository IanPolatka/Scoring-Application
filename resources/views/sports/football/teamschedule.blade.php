@extends('layouts.app')

@section('content')

<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <a href="/football">Football</a> &#187; 
                <a href="/football/{{ $selectedyear[0] }}">{{ $selectedyear[0] }}</a> &#187; 
                {{ $selectedteam[0]['school_name'] }}

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  Container  -->

</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                    <div class="form-group">

                        <select name="home_team_id" id="home_team_id" class="form-control" onChange="window.location.href=this.value">

                           <option value="null">See A Specific Team's Schedule</option>

                            @foreach($teams as $team)
                                        
                                <option value="/football/{{ $year }}/{{ $team->school_name }}" @if ($selectedteamid[0] === $team->id) selected @endif>
                                    {{ $team->school_name }} ({{ $team->city }}, {{ $team->state }})
                                </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  -->

                </div><!--  Col  -->

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                    <div class="form-group">

                        <select name="home_team_id"class="form-control" onChange="window.location.href=this.value">

                            <option value="null">See A Specific Year Schedule</option>

                            @foreach($years as $year)

                                <option value="/football/{{ $year->year }}/{{ $selectedteam[0]['school_name'] }}" @if ($selectedyearid[0] === $year->id) selected @endif>
                                    {{ $year->year }}
                                </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  --> 

                </div><!--  Col  -->

            </div><!--  Row  -->

            <div class="content-box">

                    @if ($selectedteam[0]['logo'])
                        <img src="/images/team-logos/{{  $selectedteam[0]['logo'] }}" class="medium-team-logo pull-left">
                    @endif
                    <p class="title-year">{{  $selectedyear[0]  }}</p>
                    <h4>{{  $selectedteam[0]['school_name'] }} Varsity Football Schedule</h4>

                    <div class="section-title">

                        <h6>Record</h6>

                    </div><!--  Section Title  -->

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                            <h5 class="section-name">Overall</h5>

                            <h4>{{ $wins }}-{{ $losses }}</h4>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                            <h5 class="section-name">District</h5>

                            <h4>{{ $district_wins }}-{{ $district_losses }}</h4>

                        </div>

                    </div><!--  Row  -->

                    <div class="section-title">

                        <h6>Team Schedule</h6>

                    </div><!--  Section Title  -->

                        <ul class="schedule-list">

                        @forelse ($football as $item)

                            <li><a href="/football/game/{{ $item->id }}">

                                <div class="team">

                                    <span class="date">
                                        {{ Carbon\Carbon::parse($item->date)->format('l') }} 
                                        {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}
                                    </span>

                                    @if ($selectedteam[0]['id'] == $item['away_team_id'])
                                         @&nbsp;&nbsp;
                                         @if ($item->home_team->logo)
                                            <img src="/images/team-logos/{{ $item->home_team->logo }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item->home_team->school_name }} 
                                        <small class="text-muted">({{ $item->home_team->city }}, {{ $item->home_team->state }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item->time->time }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 7))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 7))

                                            <strong class="pull-right game-list-status">
                                                @if ($item->winning_team == $item->home_team_id)
                                                    <span style="color: red">L</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif
                                                @else
                                                    <span style="color: green">W</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif

                                                @endif
                                            </strong>

                                        @endif
                                    @else
                                        vs&nbsp;&nbsp;
                                        @if ($item->away_team->logo)
                                            <img src="/images/team-logos/{{ $item->away_team->logo }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item->away_team->school_name }} 
                                        <small class="text-muted">({{ $item->away_team->city }}, {{ $item->away_team->state }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item->time->time }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 7))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 7))

                                            <strong class="pull-right game-list-status">
                                                @if ($item->winning_team == $item->home_team_id)
                                                    <span style="color: green">W</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif
                                                @else
                                                    <span style="color: red">L</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif
                                                @endif
                                            </strong>

                                        @endif
                                    @endif

                                </div><!--  Team  -->                

                            </a></li>

                        @empty

                            No Games Posted

                        @endforelse

                        </ul>

                </div><!--  Content Box  -->

        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

            <div class="content-box">
                
                <h5 class="small-heading">Standings</h5>

                <table class="table">

                    <thead>
                        <th>Team</th>
                        <th>District</th>
                        <th>Overall</th>
                    </thead>
                    <tbody>
                        @foreach($the_standings as $item)
                        <tr>
                            <td>
                                <img src="/images/team-logos/{{$item->logo}}" style="height:20px;width:20px;margin-right:5px;">
                                <a href="/football/{{ $selectedyear[0] }}/{{$item->Team}}">{{$item->Team}}</a>
                            </td>
                            <td>
                                {{$item->DistrictWins}} - {{$item->DistrictLoses}}
                            </td>
                            <td>
                                {{$item->Wins}} - {{$item->Losses}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>




<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

            <div class="content-box">

                    @if ($selectedteam[0]['logo'])
                        <img src="/images/team-logos/{{  $selectedteam[0]['logo'] }}" class="medium-team-logo pull-left">
                    @endif
                    <p class="title-year">{{  $selectedyear[0]  }}</p>
                    <h4>{{  $selectedteam[0]['school_name'] }} Junior Varsity Football Schedule</h4>

                    <div class="section-title">

                        <h6>Record</h6>

                    </div><!--  Section Title  -->

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                            <h5 class="section-name">Overall</h5>

                            <h4>{{ $jv_wins }}-{{ $jv_losses }}</h4>

                        </div>

                    </div><!--  Row  -->

                    <div class="section-title">

                        <h6>Team Schedule</h6>

                    </div><!--  Section Title  -->

                        <ul class="schedule-list">

                        @forelse ($jvfootball as $item)

                            <li><a href="/football/game/{{ $item->id }}">

                                <div class="team">

                                    <span class="date">
                                        {{ Carbon\Carbon::parse($item->date)->format('l') }} 
                                        {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}
                                    </span>

                                    @if ($selectedteam[0]['id'] == $item['away_team_id'])
                                         @&nbsp;&nbsp;
                                         @if ($item->home_team->logo)
                                            <img src="/images/team-logos/{{ $item->home_team->logo }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item->home_team->school_name }} 
                                        <small class="text-muted">({{ $item->home_team->city }}, {{ $item->home_team->state }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item->time->time }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 7))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 7))

                                            <strong class="pull-right game-list-status">
                                                @if ($item->winning_team == $item->home_team_id)
                                                    <span style="color: red">L</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif
                                                @else
                                                    <span style="color: green">W</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif

                                                @endif
                                            </strong>

                                        @endif
                                    @else
                                        vs&nbsp;&nbsp;
                                        @if ($item->away_team->logo)
                                            <img src="/images/team-logos/{{ $item->away_team->logo }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item->away_team->school_name }} 
                                        <small class="text-muted">({{ $item->away_team->city }}, {{ $item->away_team->state }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item->time->time }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 7))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 7))

                                            <strong class="pull-right game-list-status">
                                                @if ($item->winning_team == $item->home_team_id)
                                                    <span style="color: green">W</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif
                                                @else
                                                    <span style="color: red">L</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif
                                                @endif
                                            </strong>

                                        @endif
                                    @endif

                                </div><!--  Team  -->                

                            </a></li>

                        @empty

                            No Games Posted

                        @endforelse

                        </ul>

                </div><!--  Content Box  -->

        </div>

    </div>
</div>







<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

            <div class="content-box">

                    @if ($selectedteam[0]['logo'])
                        <img src="/images/team-logos/{{  $selectedteam[0]['logo'] }}" class="medium-team-logo pull-left">
                    @endif
                    <p class="title-year">{{  $selectedyear[0]  }}</p>
                    <h4>{{  $selectedteam[0]['school_name'] }} Freshman Football Schedule</h4>

                    <div class="section-title">

                        <h6>Record</h6>

                    </div><!--  Section Title  -->

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                            <h5 class="section-name">Overall</h5>

                            <h4>{{ $fresh_wins }}-{{ $fresh_losses }}</h4>

                        </div>

                    </div><!--  Row  -->

                    <div class="section-title">

                        <h6>Team Schedule</h6>

                    </div><!--  Section Title  -->

                        <ul class="schedule-list">

                        @forelse ($freshfootball as $item)

                            <li><a href="/football/game/{{ $item->id }}">

                                <div class="team">

                                    <span class="date">
                                        {{ Carbon\Carbon::parse($item->date)->format('l') }} 
                                        {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}
                                    </span>

                                    @if ($selectedteam[0]['id'] == $item['away_team_id'])
                                         @&nbsp;&nbsp;
                                         @if ($item->home_team->logo)
                                            <img src="/images/team-logos/{{ $item->home_team->logo }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item->home_team->school_name }} 
                                        <small class="text-muted">({{ $item->home_team->city }}, {{ $item->home_team->state }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item->time->time }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 7))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 7))

                                            <strong class="pull-right game-list-status">
                                                @if ($item->winning_team == $item->home_team_id)
                                                    <span style="color: red">L</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif
                                                @else
                                                    <span style="color: green">W</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif

                                                @endif
                                            </strong>

                                        @endif
                                    @else
                                        vs&nbsp;&nbsp;
                                        @if ($item->away_team->logo)
                                            <img src="/images/team-logos/{{ $item->away_team->logo }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item->away_team->school_name }} 
                                        <small class="text-muted">({{ $item->away_team->city }}, {{ $item->away_team->state }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item->time->time }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 7))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 7))

                                            <strong class="pull-right game-list-status">
                                                @if ($item->winning_team == $item->home_team_id)
                                                    <span style="color: green">W</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif
                                                @else
                                                    <span style="color: red">L</span>
                                                    @if (isset($item->home_team_final_score))
                                                        {{ $item->home_team_final_score }}
                                                    @else
                                                        {{ $item_team_score_computed }}
                                                    @endif
                                                    -
                                                    @if (isset($item->away_team_final_score))
                                                        {{ $item->away_team_final_score }}
                                                    @else
                                                        {{ $item_away_score_computed }}
                                                    @endif
                                                @endif
                                            </strong>

                                        @endif
                                    @endif

                                </div><!--  Team  -->                

                            </a></li>

                        @empty

                            No Games Posted

                        @endforelse

                        </ul>

                </div><!--  Content Box  -->

        </div>

    </div>
</div>

@endsection
