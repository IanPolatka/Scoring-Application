@extends('layouts.app')

@section('content')

<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <a href="/football">Football</a> &#187; Game &#187; {{ $football->id }} 

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  Container  -->

</div>

<div class="game-summary">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <table class="the-summary">
                    <tbody>
                        <tr>
                            <td width="17%">
                                <div class="team-logo">
                                    <a href="/football/{{ $football->year->year }}/{{ $football->away_team->school_name }}">
                                    @if ($football->home_team->logo)
                                      <img src="/images/team-logos/{{ $football->away_team->logo }}" alt="{{ $football->away_team->school_name }}">
                                    @else
                                      <div class="blank-image"></div>
                                    @endif
                                    </a>
                                </div>
                            <h4><a href="/football/{{ $football->year->year }}/{{ $football->away_team->school_name }}">{{ $football->away_team->abbreviated_name }}</a></h4>
                            <small class="text-muted">{{ $away_team_wins }}-{{ $away_team_losses }}</small></td>
                            <td width="17%">
                              <div class="score">
                                @if ($football->game_status > 0)
                                  @if (isset($football->away_team_final_score))
                                    {{ $football->away_team_final_score }}
                                  @else
                                    {{ $away_team_score_computed }}
                                  @endif
                                @else
                                  -
                                @endif

                                @if ($football->possession === $football->away_team_id)
                                  <div class="has-possession"></div>
                                @else
                                  <div class="no-possession"></div>
                                @endif
                              </div>
                            </td>
                            <td width="32%">
                                <div class="game-status">
                                  
                                  @if ($football->game_status < 1)
                                    {{ $football->time->time }}
                                  @elseif (($football->game_status > 0) && ($football->game_status < 7))
                                      @if ($football->game_status == 1) 
                                          <span class="red-text">1st Quarter</span> 
                                      @endif
                                      @if ($football->game_status == 2) 
                                          <span class="red-text">2nd Quarter</span> 
                                      @endif
                                      @if ($football->game_status == 3) 
                                          <span class="red-text">Halftime</span> 
                                      @endif
                                      @if ($football->game_status == 4) 
                                          <span class="red-text">3rd Quarter</span>
                                      @endif
                                      @if ($football->game_status == 5) 
                                          <span class="red-text">4th Quarter</span> 
                                      @endif
                                      @if ($football->game_status == 6) 
                                          <span class="red-text">vertime</span>
                                      @endif
                                  @else
                                      Final
                                  @endif

                                </div>

                               @if ($football->seconds_remaining)
                                  <div class="game-time">
                                    {{ $football->minutes_remaining }}:{{ $football->seconds_remaining }}
                                  </div>
                                @endif
                            </td>
                            <td width="17%">
                              <div class="score">
                                @if ($football->game_status > 0)
                                  @if (isset($football->home_team_final_score))
                                    {{ $football->home_team_final_score }}
                                  @else
                                    {{ $home_team_score_computed }}
                                  @endif
                                @else
                                  -
                                @endif

                                @if ($football->possession === $football->home_team_id)
                                  <div class="has-possession"></div>
                                @else
                                  <div class="no-possession"></div>
                                @endif
                              </div><!--  Score  -->
                            </td>
                            <td width="17%">
                                <div class="team-logo">
                                    <a href="/football/{{ $football->year->year }}/{{ $football->home_team->school_name }}">
                                    @if ($football->home_team->logo)
                                      <img src="/images/team-logos/{{ $football->home_team->logo }}" alt="{{ $football->home_team->school_name }}">
                                    @else
                                      <div class="blank-image"></div>
                                    @endif
                                    </a>
                                </div>
                            <h4><a href="/football/{{ $football->year->year }}/{{ $football->home_team->school_name }}">{{ $football->home_team->abbreviated_name }}</a></h4>
                            <small class="text-muted">{{ $home_team_wins }}-{{ $home_team_losses }}</small></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Game ID: {{ $football['id'] }}
                             
                {{ $football->away_team->school_name }} vs {{ $football->home_team->school_name }}  -->

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  Container  -->

</div><!--  Game Summary  -->


<div class="container">

        <div class="row">

          <div class="col-lg-12">

            <table class="table box-score">
                <thead>
                    <tr>
                      <th>@if ($football->tournament_title ) {{ $football->tournament_title }} @endif</th>
                      <th>1</th>
                      <th>2</th>
                      <th>3</th>
                      <th>4</th>
                      @if (isset($football->away_team_overtime_score) && isset($football->home_team_overtime_score))
                      <th>O</th>
                      @endif
                      <th>
                        @if ($football->game_status < 7)
                          T
                        @else
                          F
                        @endif
                      </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @if ($football->away_team->logo)
                                <img src="/images/team-logos/{{ $football->away_team->logo }}">
                            @endif
                            {{ $football->away_team->school_name }}
                        </td>
                        <td>
                            @if ($football->game_status > 0)
                                @if (isset($football->away_team_first_qrt_score))
                                    {{ $football->away_team_first_qrt_score }}
                                @else
                                    -
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($football->game_status > 0)
                              @if (isset($football->away_team_second_qrt_score))
                                {{ $football->away_team_second_qrt_score }}
                              @else
                                -
                              @endif
                            @endif
                        </td>
                      <td>
                        @if ($football->game_status > 0)
                          @if (isset($football->away_team_third_qrt_score))
                            {{ $football->away_team_third_qrt_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      <td>
                        @if ($football->game_status > 0)
                          @if (isset($football->away_team_fourth_qrt_score))
                            {{ $football->away_team_fourth_qrt_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      @if (isset($football->away_team_overtime_score) && isset($football->home_team_overtime_score))
                        <td>@if ($football->game_status > 0)
                            @if (isset($football->away_team_overtime_score))
                              {{ $football->away_team_overtime_score }}
                            @else
                              -
                            @endif
                          @endif
                        </td>
                      @endif
                      <td>
                        @if ($football->game_status > 0)
                          @if (isset($football->away_team_final_score))
                            {{ $football->away_team_final_score }}
                          @else
                            {{ $away_team_score_computed }}
                          @endif
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td>
                        @if ($football->home_team->logo)
                          <img src="/images/team-logos/{{ $football->home_team->logo }}">
                        @endif
                        {{ $football->home_team->school_name }}
                      </td>
                      <td>
                        @if ($football->game_status > 0)
                          @if (isset($football->home_team_first_qrt_score))
                            {{ $football->home_team_first_qrt_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      <td>
                        @if ($football->game_status > 0)
                          @if (isset($football->home_team_second_qrt_score))
                            {{ $football->home_team_second_qrt_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      <td>
                        @if ($football->game_status > 0)
                          @if (isset($football->home_team_third_qrt_score))
                            {{ $football->home_team_third_qrt_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      <td>
                        @if ($football->game_status > 0)
                          @if (isset($football->home_team_fourth_qrt_score))
                            {{ $football->home_team_fourth_qrt_score }}
                          @else
                            -
                          @endif
                        @endif
                      </td>
                      @if (isset($football->away_team_overtime_score) && isset($football->home_team_overtime_score))
                        <td>
                          @if ($football->game_status > 0)
                            @if (isset($football->home_team_overtime_score))
                              {{ $football->home_team_overtime_score }}
                            @else
                              -
                            @endif
                          @endif
                        </td>
                      @endif
                      <td>
                        @if ($football->game_status > 0)
                          @if (isset($football->home_team_final_score))
                            {{ $football->home_team_final_score }}
                          @else
                            {{ $home_team_score_computed }}
                          @endif
                        @endif
                      </td>
                    </tr>
                </tbody>
            </table>

        </div><!--  Col  -->

    </div><!--  Row  -->

     @if (Auth::user())

    <div class="row">

        <div class="col-lg-12">

            <a class="button button-default" href="/football/game/{{ $football->id }}/edit">Edit</a>

        </div><!--  Col  -->

    </div><!--  Row  -->

    @endif

</div><!--  Container  -->

@endsection
