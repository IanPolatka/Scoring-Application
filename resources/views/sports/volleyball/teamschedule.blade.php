@extends('layouts.app')

@section('content')


<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <a href="/volleyball">Volleyball</a> &#187; 
                <a href="/volleyball/{{ $selectedyear[0] }}">{{ $selectedyear[0] }}</a> &#187; 
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
                                        
                                <option value="/volleyball/{{ $year }}/{{ $team->school_name }}" @if ($selectedteamid[0] === $team->id) selected @endif>
                                    {{ $team->school_name }} ({{ $team->city }}, {{ $team->state }})
                                </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  -->

                </div><!--  Col  -->

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                    <div class="form-group">

                        <select name="home_team_id" class="form-control" onChange="window.location.href=this.value">

                            <option value="null">See A Specific Year Schedule</option>

                            @foreach($years as $year)

                                <option value="/volleyball/{{ $year->year }}/{{ $selectedteam[0]['school_name'] }}" @if ($selectedyearid[0] === $year->id) selected @endif>
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
                    <h4>{{  $selectedteam[0]['school_name'] }} Varsity Volleyball Schedule</h4>

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

                        @forelse ($volleyball as $item)

                            <li><a href="/volleyball/match/{{ $item->id }}">

                                <div class="team">

                                    <span class="date">
                                        {{ Carbon\Carbon::parse($item->date)->format('l') }} 
                                        {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}
                                    </span>
                                    @if ($selectedteamid[0] == $item['away_team_id'])
                                         @
                                         @if ($item->home_team_logo)
                                            &nbsp;&nbsp;
                                            <img src="/images/team-logos/{{ $item['home_team_logo'] }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item['home_team'] }} 
                                        <small class="text-muted">({{ $item['home_team_city'] }}, {{ $item['home_team_state'] }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item['time'] }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 5))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 6))

                                            <strong class="pull-right game-list-status">
                                                @if (strtolower($item['winning_team']) == strtolower($item['home_team']))
                                                    <span style="color: red">L</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) :
                                                        $a_four = 1;
                                                    else :
                                                        $a_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
                                                @else
                                                    <span style="color: green">W</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) {
                                                        $a_four = 1;
                                                    } else {
                                                        $a_four = 0;
                                                    }
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
                                                @endif
                                            </strong>

                                        @endif
                                   
                                    @else

                                        vs
                                         @if ($item->home_team_logo)
                                            &nbsp;&nbsp;
                                            <img src="/images/team-logos/{{ $item['away_team_logo'] }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item['away_team'] }} 
                                        <small class="text-muted">({{ $item['away_team_city'] }}, {{ $item['away_team_state'] }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item['time'] }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 5))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 6))

                                            <strong class="pull-right game-list-status">
                                                @if (strtolower($item['winning_team']) == strtolower($item['away_team']))
                                                    <span style="color: red">L</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) :
                                                        $a_four = 1;
                                                    else :
                                                        $a_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
                                                @else
                                                    <span style="color: green">W</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) {
                                                        $a_four = 1;
                                                    } else {
                                                        $a_four = 0;
                                                    }
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
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





                <div class="content-box">

                    @if ($selectedteam[0]['logo'])
                        <img src="/images/team-logos/{{  $selectedteam[0]['logo'] }}" class="medium-team-logo pull-left">
                    @endif
                    <p class="title-year">{{  $selectedyear[0]  }}</p>
                    <h4>{{  $selectedteam[0]['school_name'] }} Junior Varsity Volleyball Schedule</h4>

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

                        @forelse ($jv_volleyball as $item)

                            <li><a href="/volleyball/match/{{ $item->id }}">

                                <div class="team">

                                    <span class="date">
                                        {{ Carbon\Carbon::parse($item->date)->format('l') }} 
                                        {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}
                                    </span>
                                    @if ($selectedteamid[0] == $item['away_team_id'])
                                         @
                                         @if ($item->home_team_logo)
                                            &nbsp;&nbsp;
                                            <img src="/images/team-logos/{{ $item['home_team_logo'] }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item['home_team'] }} 
                                        <small class="text-muted">({{ $item['home_team_city'] }}, {{ $item['home_team_state'] }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item['time'] }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 5))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 6))

                                            <strong class="pull-right game-list-status">
                                                @if (strtolower($item['winning_team']) == strtolower($item['home_team']))
                                                    <span style="color: red">L</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) :
                                                        $a_four = 1;
                                                    else :
                                                        $a_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
                                                @else
                                                    <span style="color: green">W</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) {
                                                        $a_four = 1;
                                                    } else {
                                                        $a_four = 0;
                                                    }
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
                                                @endif
                                            </strong>

                                        @endif
                                   
                                    @else

                                        vs
                                         @if ($item->home_team_logo)
                                            &nbsp;&nbsp;
                                            <img src="/images/team-logos/{{ $item['away_team_logo'] }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item['away_team'] }} 
                                        <small class="text-muted">({{ $item['away_team_city'] }}, {{ $item['away_team_state'] }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item['time'] }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 5))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 6))

                                            <strong class="pull-right game-list-status">
                                                @if (strtolower($item['winning_team']) == strtolower($item['away_team']))
                                                    <span style="color: red">L</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) :
                                                        $a_four = 1;
                                                    else :
                                                        $a_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
                                                @else
                                                    <span style="color: green">W</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) {
                                                        $a_four = 1;
                                                    } else {
                                                        $a_four = 0;
                                                    }
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
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




                <div class="content-box">

                    @if ($selectedteam[0]['logo'])
                        <img src="/images/team-logos/{{  $selectedteam[0]['logo'] }}" class="medium-team-logo pull-left">
                    @endif
                    <p class="title-year">{{  $selectedyear[0]  }}</p>
                    <h4>{{  $selectedteam[0]['school_name'] }} Freshman Volleyball Schedule</h4>

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

                        @forelse ($fresh_volleyball as $item)

                            <li><a href="/volleyball/match/{{ $item->id }}">

                                <div class="team">

                                    <span class="date">
                                        {{ Carbon\Carbon::parse($item->date)->format('l') }} 
                                        {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}
                                    </span>
                                    @if ($selectedteamid[0] == $item['away_team_id'])
                                         @
                                         @if ($item->home_team_logo)
                                            &nbsp;&nbsp;
                                            <img src="/images/team-logos/{{ $item['home_team_logo'] }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item['home_team'] }} 
                                        <small class="text-muted">({{ $item['home_team_city'] }}, {{ $item['home_team_state'] }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item['time'] }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 5))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 6))

                                            <strong class="pull-right game-list-status">
                                                @if (strtolower($item['winning_team']) == strtolower($item['home_team']))
                                                    <span style="color: red">L</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) :
                                                        $a_four = 1;
                                                    else :
                                                        $a_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
                                                @else
                                                    <span style="color: green">W</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) {
                                                        $a_four = 1;
                                                    } else {
                                                        $a_four = 0;
                                                    }
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
                                                @endif
                                            </strong>

                                        @endif
                                   
                                    @else

                                        vs
                                         @if ($item->home_team_logo)
                                            &nbsp;&nbsp;
                                            <img src="/images/team-logos/{{ $item['away_team_logo'] }}" class="team-schedule-logo">
                                        @endif
                                        {{ $item['away_team'] }} 
                                        <small class="text-muted">({{ $item['away_team_city'] }}, {{ $item['away_team_state'] }})</small>

                                        @if ($item->game_status < 1)

                                            <strong class="pull-right game-list-status">{{ $item['time'] }}</strong>

                                        @elseif (($item->game_status > 0) && ($item->game_status < 5))

                                            <strong class="pull-right game-list-status"><span style="color: red;">LIVE</span></strong>

                                        @elseif (($item->game_status == 6))

                                            <strong class="pull-right game-list-status">
                                                @if (strtolower($item['winning_team']) == strtolower($item['away_team']))
                                                    <span style="color: red">L</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) :
                                                        $a_four = 1;
                                                    else :
                                                        $a_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
                                                @else
                                                    <span style="color: green">W</span>
                                                    <?php
                                                    if (strtolower($item->g_one_w) == strtolower($item['home_team'])) :
                                                        $h_one = 1;
                                                    else :
                                                        $h_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['home_team'])) :
                                                        $h_two = 1;
                                                    else:
                                                        $h_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['home_team'])) :
                                                        $h_three = 1;
                                                    else :
                                                        $h_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['home_team'])) :
                                                        $h_four = 1;
                                                    else :
                                                        $h_four = 0;
                                                    endif;
                                                    if (strtolower($item->g_five_w) == strtolower($item['home_team'])) :
                                                        $h_five = 1;
                                                    else :
                                                        $h_five = 0;
                                                    endif;


                                                    if (strtolower($item->g_one_w) == strtolower($item['away_team'])) :
                                                        $a_one = 1;
                                                    else :
                                                        $a_one = 0;
                                                    endif;
                                                    if (strtolower($item->g_two_w) == strtolower($item['away_team'])) :
                                                        $a_two = 1;
                                                    else:
                                                        $a_two = 0;
                                                    endif;
                                                    if (strtolower($item->g_three_w) == strtolower($item['away_team'])) :
                                                        $a_three = 1;
                                                    else :
                                                        $a_three = 0;
                                                    endif;
                                                    if (strtolower($item->g_four_w) == strtolower($item['away_team'])) {
                                                        $a_four = 1;
                                                    } else {
                                                        $a_four = 0;
                                                    }
                                                    if (strtolower($item->g_five_w) == strtolower($item['away_team'])) :
                                                        $a_five = 1;
                                                    else :
                                                        $a_five = 0;
                                                    endif;

                                                    $home_score = array($h_one, $h_two, $h_three, $h_four, $h_five);
                                                    $away_score = array($a_one, $a_two, $a_three, $a_four, $a_five);

                                                    if (array_sum($away_score) >= array_sum($home_score)) {
                                                        echo array_sum($away_score); 
                                                        echo '-';
                                                        echo array_sum($home_score);
                                                    } else {
                                                        echo array_sum($home_score); 
                                                        echo '-';
                                                        echo array_sum($away_score);
                                                    }
                                                    ?>
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
                
                <h5 class="small-heading">District</h5>

                <ul class="standings-list">

                    @forelse ($standings as $item)

                        <li>
                            @if ($item->logo)
                                <img src="/images/team-logos/{{ $item->logo }}" class="standings-logo">
                            @endif  
                            <a href="/football/{{ $selectedyear[0] }}/{{ $item->school_name }}">
                                {{ $item->school_name }}
                            </a>
                        </li> 

                    @empty

                        <li>No Districts Opponents Listed</li>

                    @endforelse

                </ul>

            </div>

        </div>

    </div>
</div>
@endsection
