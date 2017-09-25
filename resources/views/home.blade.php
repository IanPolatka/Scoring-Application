@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="container">
    <div class="row">

        <div class="col-lg-12">

        @if (Auth::user())

            <h3><strong>Welcome {{ Auth::user()->name }},</strong></h3>

            <p>Here are today's football events</p>

        @endif

        <ul class="home-events">

            @foreach($football as $item)

            <?php 

            $awayTeamScore = $item->away_team_first_qrt_score + 
                                   $item->away_team_second_qrt_score + 
                                   $item->away_team_third_qrt_score +
                                   $item->away_team_fourth_qrt_score +
                                   $item->away_team_overtime_score;

            $homeTeamScore = $item->home_team_first_qrt_score + 
                                   $item->home_team_second_qrt_score + 
                                   $item->home_team_third_qrt_score +
                                   $item->home_team_fourth_qrt_score +
                                   $item->home_team_overtime_score;

            ?>

            @if (($item->game_status > 1) && ($item->game_status < 7)) 
                <li class="red-pulse-border">
            @else
                <li>
            @endif
            <a href="/football/game/{{ $item->id }}">
                <div class="team">
                    @if ($item->away_team_logo)
                        <img src="/images/team-logos/{{ $item->away_team_logo }}">
                    @endif
                    {{$item->away_team}}
                    <span class="score">
                        @if ($item->game_status == NULL || $item->game_status < 1)
                            -
                        @elseif (empty($item->away_team_final_score))
                            <?php echo $awayTeamScore; ?>
                        @else 
                            {{ $item->away_team_final_score }}
                        @endif
                    </span>
                </div>
                <div class="team">
                    @if ($item->home_team_logo)
                        <img src="/images/team-logos/{{ $item->home_team_logo }}">
                    @endif
                    {{$item->home_team}}
                    <span class="score">
                        @if ($item->game_status == NULL || $item->game_status < 1)
                            -
                        @elseif (empty($item->home_team_final_score))
                            <?php echo $homeTeamScore; ?>
                        @else 
                            {{ $item->home_team_final_score }}
                        @endif
                    </span>
                </div>

                @if (($item->game_status > 1) && ($item->game_status < 7))
                    <div class="red-pulse-background status">
                @else
                    <div class="status">
                @endif
                    @if($item->game_status > 1 )
                        @if ($item->game_status == 1) 
                            1st Quarter
                        @endif
                        @if ($item->game_status == 2) 
                            2nd Quarter 
                        @endif
                        @if ($item->game_status == 3) 
                            Halftime
                        @endif
                        @if ($item->game_status == 4) 
                            3rd Quarter
                        @endif
                        @if ($item->game_status == 5) 
                            4th Quarter
                        @endif
                        @if ($item->game_status == 6) 
                            Overtime
                        @endif
                        @if ($item->game_status == 7) 
                            Final
                        @endif
                    @else
                        {{$item->time}}
                    @endif
                </div><!--  Status  -->
            </a></li>

            @endforeach

        </ul>

    </div>

    </div><!--  Row  -->

</div><!--  Container  -->

@endsection
