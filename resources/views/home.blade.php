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

<example></example>

<div class="container">
    <div class="row">

        <div class="col-lg-12">

            <h3><strong>Here are today's events</strong></h3>

            @if (count($football))

                <h5>Football</h5>

                <div class="home-sports-list">

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

                        <a href="/football/game/{{ $item->id }}"><div class="item">

                            @if (($item->game_status > 0) && ($item->game_status < 7))

                                <div class="game-status">

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

                                </div><!--  Game Status  -->

                            @endif

                            <div class="element">

                                <div class="logo">

                                    @if ($item->away_team_logo)
                                        <img src="/images/team-logos/{{ $item->away_team_logo }}">
                                    @endif

                                </div><!--  Logo  -->

                                @if ($item->game_status == 7)

                                    @if (($awayTeamScore > $homeTeamScore) || ($item->away_team_final_score > $item->home_team_final_score))

                                        <strong>

                                    @endif

                                @endif

                                {{$item->away_team}}

                                @if ($item->game_status == 7)

                                    @if (($awayTeamScore > $homeTeamScore) || ($item->away_team_final_score > $item->home_team_final_score))

                                        </strong>

                                    @endif

                                @endif

                                <div class="status">

                                    @if ($item->game_status == NULL || $item->game_status < 1)
                                        {{$item->time}}
                                    @elseif (empty($item->away_team_final_score))
                                        @if ($item->game_status == 7)
                                            @if ($awayTeamScore > $homeTeamScore)
                                            <strong>
                                            @endif
                                        @endif
                                            <?php echo $awayTeamScore; ?>
                                        @if ($item->game_status == 7)
                                            @if ($awayTeamScore > $homeTeamScore)
                                            </strong>
                                            @endif
                                        @endif
                                    @else
                                        @if ($item->away_team_final_score > $item->home_team_final_score)
                                        <strong>
                                        @endif
                                            {{ $item->away_team_final_score }}
                                        @if ($item->away_team_final_score > $item->home_team_final_score)
                                        </strong>
                                        @endif
                                    @endif

                                </div>

                            </div><!--  Element  -->

                            <div class="element">

                                <div class="logo">

                                    @if ($item->home_team_logo)
                                        <img src="/images/team-logos/{{ $item->home_team_logo }}">
                                    @endif

                                </div><!--  Logo  -->

                                @if ($item->game_status == 7)
                                    
                                    @if (($homeTeamScore > $awayTeamScore) || ($item->home_team_final_score > $item->away_team_final_score))

                                        <strong>

                                    @endif

                                @endif

                                {{$item->home_team}}

                                @if ($item->game_status == 7)

                                   @if (($homeTeamScore > $awayTeamScore) || ($item->home_team_final_score > $item->away_team_final_score))

                                        </strong>

                                    @endif

                                @endif

                                <div class="status">

                                    @if ($item->game_status == NULL || $item->game_status < 1)
                                        
                                    @elseif (empty($item->home_team_final_score))
                                        @if ($item->game_status == 7)
                                            @if ($homeTeamScore > $awayTeamScore)
                                            <strong>
                                            @endif
                                        @endif
                                            <?php echo $homeTeamScore; ?>
                                        @if ($item->game_status == 7)
                                            @if ($homeTeamScore > $awayTeamScore)
                                            </strong>
                                            @endif
                                        @endif
                                    @else 
                                        @if ($item->home_team_final_score > $item->away_team_final_score)
                                        <strong>
                                        @endif
                                            {{ $item->home_team_final_score }}
                                        @if ($item->home_team_final_score > $item->away_team_final_score)
                                        </strong>
                                        @endif
                                    @endif

                                </div><!--  Status  -->

                            </div><!--  Element  -->

                        </div><!--  Item  --></a>

                    @endforeach

                </div>

            @endif

        </div>

    </div><!--  Row  -->

</div><!--  Container  -->

@endsection
