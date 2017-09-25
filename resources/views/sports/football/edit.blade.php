@extends('layouts.app')


@section('content')

<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <a href="/football">Football</a> &#187; Game &#187; {{ $football->id }} &#187; Edit

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
                              <small class="text-muted">{{ $away_team_wins }}-{{ $away_team_losses }}</small>
                            </td>
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

          </div>

          </div>


          <div class="row">

            <div class="col-lg-12">

            <form method="POST" action="/football/game/{{ $football->id }}">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}

              <ul class="nav nav-tabs nav-justified edit-game-tabs">
                    <li role="presentation" class="active"><a href="#1" data-toggle="tab">Edit Game Play</a>
                    </li>
                    <li role="presentation"><a href="#2" data-toggle="tab">Edit Game Settings</a></li>
                  </ul>

                  <div class="team-profile no-top-border-radius">

                  <div class="tab-content ">
                    <div class="tab-pane active" id="1">

                      <div class="section-title">
                        Game Details
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="game_status">Game Status</label>

                          <select name="game_status" id="game_status" class="form-control">

                            <option value="" @if ($football->game_status == "") selected @endif>Select A Status</option>
                            <option value="0" @if ($football->game_status == "0") selected @endif>Game Has Not Started Yet</option>
                            <option value="1" @if ($football->game_status == "1") selected @endif>1st Quarter</option>
                            <option value="2" @if ($football->game_status == "2") selected @endif>2nd Quarter</option>
                            <option value="3" @if ($football->game_status == "3") selected @endif>Halftime</option>
                            <option value="4" @if ($football->game_status == "4") selected @endif>3rd Quarter</option>
                            <option value="5" @if ($football->game_status == "5") selected @endif>4th Quarter</option>
                            <option value="6" @if ($football->game_status == "6") selected @endif>Overtime</option>
                            <option value="7" @if ($football->game_status == "7") selected @endif>Final</option>

                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="possession">Who Has Possession?</label>

                          <select name="possession" id="possession" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $football->away_team->id }}" @if ($football->possession === $football->away_team_id) selected @endif>
                              {{ $football->away_team->school_name }}
                            </option>
                            <option value="{{ $football->home_team->id }}" @if ($football->possession === $football->home_team_id) selected @endif>
                              {{ $football->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->



                      <div class="section-title">
                        Game Time
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="minutes_remaining">Minutes Remaining?</label>

                          <select name="minutes_remaining" id="minutes_remaining" class="form-control">
                              <option value="">Enter A Minute</option>
                              @for ($i = 0; $i < 15; $i++) 
                                <option value="{{ $i }}" @if ($football->minutes_remaining == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="seconds_remaining">Seconds Remaining?</label>

                          <select name="seconds_remaining" id="seconds_remaining" class="form-control">
                              <option value="">Enter A Second</option>
                              <option value="00" @if ($football->seconds_remaining == "00") selected @endif>
                                00
                              </option>
                              <option value="01" @if ($football->seconds_remaining == "01") selected @endif>
                                01
                              </option>
                              <option value="02" @if ($football->seconds_remaining == "02") selected @endif>02</option>
                              <option value="03" @if ($football->seconds_remaining == "03") selected @endif>03</option>
                              <option value="04" @if ($football->seconds_remaining == "04") selected @endif>04</option>
                              <option value="05" @if ($football->seconds_remaining == "05") selected @endif>05</option>
                              <option value="06" @if ($football->seconds_remaining == "06") selected @endif>06</option>
                              <option value="07" @if ($football->seconds_remaining == "07") selected @endif>07</option>
                              <option value="08" @if ($football->seconds_remaining == "08") selected @endif>08</option>
                              <option value="09" @if ($football->seconds_remaining == "09") selected @endif>09</option>
                              @for ($i = 10; $i < 60; $i++)
                                <option value="{{ $i }}" @if ($football->seconds_remaining == $i) selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->



                      <div class="section-title">
                        First Quarter Score
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_first_qrt_score">{{ $football->away_team->school_name }} </label>

                          <select name="away_team_first_qrt_score" id="away_team_first_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->away_team_first_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_first_qrt_score">{{ $football->home_team->school_name }}</label>

                          <select name="home_team_first_qrt_score" id="home_team_first_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->home_team_first_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Second Quarter Score
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_second_qrt_score">{{ $football->away_team->school_name }}</label>

                          <select name="away_team_second_qrt_score" id="away_team_second_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->away_team_second_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="home_team_second_qrt_score">{{ $football->home_team->school_name }}</label>

                          <select name="home_team_second_qrt_score" id="home_team_second_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->home_team_second_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Third Quarter Score
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_third_qrt_score">{{ $football->away_team->school_name }}</label>

                          <select name="away_team_third_qrt_score" id="away_team_third_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->away_team_third_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="home_team_third_qrt_score">{{ $football->home_team->school_name }}</label>

                          <select name="home_team_third_qrt_score" id="home_team_third_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->home_team_third_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        4th Quarter Score
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_fourth_qrt_score">{{ $football->away_team->school_name }}</label>

                          <select name="away_team_fourth_qrt_score" id="away_team_fourth_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->away_team_fourth_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="home_team_fourth_qrt_score">{{ $football->home_team->school_name }}</label>

                          <select name="home_team_fourth_qrt_score" id="home_team_fourth_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->home_team_fourth_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Overtime Score
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_overtime_score">{{ $football->away_team->school_name }}</label>

                          <select name="away_team_overtime_score" id="away_team_overtime_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->away_team_overtime_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                           <div class="form-group">

                          <label for="home_team_overtime_score">{{ $football->home_team->school_name }}</label>

                          <select name="home_team_overtime_score" id="home_team_overtime_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($football->home_team_overtime_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Final Score
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_final_score">{{ $football->away_team->school_name }}</label>

                          <div class="input-group">
                              <div class="input-group-btn">
                                <button type="button" id="SubtractButtonAway" class="btn button-danger">-</button>
                              </div><!--  Input Group Button  -->
                              <input type="number" class="form-control text-center" 
                                     id="away_team_final_score" 
                                     name="away_team_final_score" 
                                     value="{{ $football->away_team_final_score }}" min="0">
                              <div class="input-group-btn">
                                <button type="button" id="AddButtonAway" class="btn button-default">+</button>
                              </div><!--  Input Group Button  -->
                            </div><!--  Input Group  -->

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">
                            <label for="home_team_final_score">
                                {{ $football->home_team->school_name }}
                              </label>
                            <div class="input-group">
                              <div class="input-group-btn">
                                <button type="button" id="SubtractButtonHome" class="btn button-danger">-</button>
                              </div><!--  Input Group Button  -->
                              <input type="number" class="form-control text-center" 
                                     id="home_team_final_score" 
                                     name="home_team_final_score" 
                                     value="{{ $football->home_team_final_score }}" min="0">
                              <div class="input-group-btn">
                                <button type="button" id="AddButtonHome" class="btn button-default">+</button>
                              </div><!--  Input Group Button  -->
                            </div><!--  Input Group  -->
                          </div><!--  Form Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Winner & Loser
                      </div><!--  Section Title  -->

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="winning_team">Winning Team</label>

                          <select name="winning_team" id="winning_team" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $football->away_team->id }}" @if ($football->winning_team === $football->away_team_id) selected @endif>
                              {{ $football->away_team->school_name }}
                            </option>
                            <option value="{{ $football->home_team->id }}" @if ($football->winning_team === $football->home_team_id) selected @endif>
                              {{ $football->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                            <label for="losing_team">Losing Team</label>

                            <select name="losing_team" id="losing_team" class="form-control">

                              <option value="">Select A Team</option>

                              <option value="{{ $football->away_team->id }}" @if ($football->losing_team === $football->away_team_id) selected @endif>
                                {{ $football->away_team->school_name }}
                              </option>
                              <option value="{{ $football->home_team->id }}" @if ($football->losing_team === $football->home_team_id) selected @endif>
                                {{ $football->home_team->school_name }}
                              </option>

                            </select>

                          </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->
                       
                    </div><!--  tab pane  -->

                    <div class="tab-pane" id="2">

                      <div class="section-title">
                          School Year & Team Level
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                            <label for="year_id">What Year Is This Game For?</label>

                            <select name="year_id" id="year_id" class="form-control">

                              <option value="">Select A School Year</option>

                              <option value="{{ $thecurrentyear['id'] }}">{{ $thecurrentyear['year'] }}</option>

                              <option value="">---------------------</option>

                              @foreach($years as $year)

                                <option value="{{ $year->id }}" @if ($football->year_id === $year->id) selected @endif >
                                    {{ $year->year }}
                                </option>

                              @endforeach

                            </select>

                          </div><!--  Form  Group  -->

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">
                          <label for="team_level">What Team Level?</label>
                          <select name="team_level" id="team_level" class="form-control">
                              <option value="1" @if ($football->team_level == "1") selected @endif>Varsity</option>
                              <option value="2" @if ($football->team_level == "2") selected @endif>Junior Varsity</option>
                              <option value="3" @if ($football->team_level == "3") selected @endif>Freshman</option>
                          </select>
                        </div><!--  Form Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Date & Time
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" class="form-control" id="datepicker" name="date" value="{{ $football->date }}" required>
                          </div>

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="time_id">What Time Is The Match?</label>

                          <select name="time_id" id="time_id" class="form-control">

                            @foreach($times as $time)

                              <option value="{{ $time->id }}" @if ($football->time_id === $time->id) selected @endif>{{ $time->time }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Tournament Title
                      </div>

                      <div class="form-group">
                          <label for="tournament_title">Title</label>
                          <input type="text" class="form-control" id="tournament_title" name="tournament_title" value="{{ $football->tournament_title }}">
                      </div>

                      <div class="section-title">
                        Teams
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_id">Away Team</label>

                          <select name="away_team_id" id="away_team_id" class="form-control">

                            <option value="null">Please Select An Away School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" @if ($football->away_team_id == $team['id']) selected @endif>
                                {{ $team['school_name'] }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="home_team_id">Home Team</label>

                          <select name="home_team_id" id="home_team_id" class="form-control">

                            <option value="null">Please Select An Home School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" @if ($football->home_team_id === $team['id']) selected @endif>{{ $team->school_name }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        District Game & Scrimmage
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                        <div class="form-group">

                          <label for="district_game">Is This A District Game?</label>

                          <select name="district_game" id="district_game" class="form-control">
                              <option value="0" @if ($football->district_game == "0") selected @endif>No</option>
                              <option value="1" @if ($football->district_game == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="scrimmage">Is This A Scrimmage?</label>

                          <select name="scrimmage" id="scrimmage" class="form-control">
                              <option value="0" @if ($football->scrimmage == "0") selected @endif>No</option>
                              <option value="1" @if ($football->scrimmage == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      </div><!--  Col  -->
                  </div><!--  Row  -->

                        
                  <hr>


                  <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                      <div class="form-group">
                       <button type="submit" class="button button-default">Update Game</button>
                      </div>
                    
                      </form>

                    </div><!--  Col  -->

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                    <form method="POST" action="/football/{{ $football->id }}">

                      {{ method_field('DELETE') }}

                      {{ csrf_field() }}    

                        <button type="submit" onclick="return confirm('Are you sure?')" class="button button-danger pull-left">Delete Match</button>
                    
                    </form>

                    <script>
                      $(".delete").on("submit", function(){
                          return confirm("Do you want to delete this item?");
                      });
                    </script>

                    </div><!--  Col  -->

                  </div><!--  Row  -->

                  <div class="clearfix"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
