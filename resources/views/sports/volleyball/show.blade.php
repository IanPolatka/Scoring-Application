@extends('layouts.app')

@section('content')

<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <a href="/volleyball">Volleyball</a> &#187; Match &#187; {{ $volleyball->id }} 

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  Container  -->

</div>

<div class="container">

        <div class="row">

          <div class="col-lg-12">

            <table class="table box-score">
                <thead>
                    <tr>
                      <th>
                        @if ($volleyball->game_status == 6 )
                            <strong>Final</strong>
                        @endif
                        @if ($volleyball->tournament_title ) 
                            {{ $volleyball->tournament_title }} 
                        @endif
                      </th>
                      <th>1</th>
                      <th>2</th>
                      <th>3</th>
                      @if (isset($volleyball->away_team_fourth_game_score) || isset($volleyball->home_team_fourth_game_score))
                      <th>4</th>
                      @endif
                      @if (isset($volleyball->away_team_fifth_game_score) || isset($volleyball->home_team_fifth_game_score))
                      <th>5</th>
                      @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @if ($volleyball->away_team->logo)
                                <img src="/images/team-logos/{{ $volleyball->away_team->logo }}">
                            @endif
                            {{ $volleyball->away_team->school_name }}
                        </td>
                        <td>
                            @if ($volleyball->game_status > 0)
                                @if (isset($volleyball->away_team_first_game_score))
                                    {{ $volleyball->away_team_first_game_score }}
                                @else
                                    -
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($volleyball->game_status > 0)
                              @if (isset($volleyball->away_team_second_game_score))
                                {{ $volleyball->away_team_second_game_score }}
                              @else
                                -
                              @endif
                            @endif
                        </td>
                      <td>
                        @if ($volleyball->game_status > 0)
                          @if (isset($volleyball->away_team_third_game_score))
                            {{ $volleyball->away_team_third_game_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      @if (isset($volleyball->away_team_fourth_game_score) || isset($volleyball->home_team_fourth_game_score))
                      <td>
                        @if ($volleyball->game_status > 0)
                          @if (isset($volleyball->away_team_fourth_game_score))
                            {{ $volleyball->away_team_fourth_game_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      @endif
                      @if (isset($volleyball->away_team_fifth_game_score) || isset($volleyball->home_team_fifth_game_score))
                      <td>
                        @if ($volleyball->game_status > 0)
                          @if (isset($volleyball->away_team_fifth_game_score))
                            {{ $volleyball->away_team_fifth_game_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      @endif
                    </tr>
                    <tr>
                      <td>
                            @if ($volleyball->home_team->logo)
                                <img src="/images/team-logos/{{ $volleyball->home_team->logo }}">
                            @endif
                            {{ $volleyball->home_team->school_name }}
                        </td>
                        <td>
                            @if ($volleyball->game_status > 0)
                                @if (isset($volleyball->home_team_first_game_score))
                                    {{ $volleyball->home_team_first_game_score }}
                                @else
                                    -
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($volleyball->game_status > 0)
                              @if (isset($volleyball->home_team_second_game_score))
                                {{ $volleyball->home_team_second_game_score }}
                              @else
                                -
                              @endif
                            @endif
                        </td>
                      <td>
                        @if ($volleyball->game_status > 0)
                          @if (isset($volleyball->home_team_third_game_score))
                            {{ $volleyball->home_team_third_game_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      @if (isset($volleyball->away_team_fourth_game_score) || isset($volleyball->home_team_fourth_game_score))
                      <td>
                        @if ($volleyball->game_status > 0)
                          @if (isset($volleyball->home_team_fourth_game_score))
                            {{ $volleyball->home_team_fourth_game_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      @endif
                      @if (isset($volleyball->away_team_fifth_game_score) || isset($volleyball->home_team_fifth_game_score))
                      <td>
                        @if ($volleyball->game_status > 0)
                          @if (isset($volleyball->home_team_fifth_game_score))
                            {{ $volleyball->home_team_fifth_game_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      @endif
                    </tr>
                </tbody>
            </table>

        </div><!--  Col  -->

    </div><!--  Row  -->

     @if (Auth::user())

    <div class="row">

        <div class="col-lg-12">

            <a class="button button-default" href="/volleyball/match/{{ $volleyball->id }}/edit">Edit</a>

        </div><!--  Col  -->

    </div><!--  Row  -->

    @endif

</div><!--  Container  -->

@endsection
