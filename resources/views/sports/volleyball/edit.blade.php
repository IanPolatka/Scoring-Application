@extends('layouts.app')

@section('content')

<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <a href="/volleyball">Volleyball</a> &#187; Match &#187; {{ $volleyball->id }} &#187; Edit

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
                  <th>@if ($volleyball->tournament_title ) {{ $volleyball->tournament_title }} @endif</th>
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

          </div>

          </div>


          <div class="row">

            <div class="col-lg-12">

            <form method="POST" action="/volleyball/match/{{ $volleyball->id }}">

              {{ method_field('PATCH') }}

              {{ csrf_field() }}

              <ul class="nav nav-tabs nav-justified edit-game-tabs">
                    <li role="presentation" class="active"><a href="#1" data-toggle="tab">Edit Match Play</a>
                    </li>
                    <li role="presentation"><a href="#2" data-toggle="tab">Edit Match Settings</a></li>
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

                            <option value="" @if ($volleyball->game_status == "") selected @endif>Select A Status</option>
                            <option value="0" @if ($volleyball->game_status == "0") selected @endif>Game Has Not Started Yet</option>
                            <option value="1" @if ($volleyball->game_status == "1") selected @endif>1st Game</option>
                            <option value="2" @if ($volleyball->game_status == "2") selected @endif>2nd Game</option>
                            <option value="3" @if ($volleyball->game_status == "3") selected @endif>3rd Game</option>
                            <option value="4" @if ($volleyball->game_status == "4") selected @endif>4th Game</option>
                            <option value="5" @if ($volleyball->game_status == "5") selected @endif>5th Game</option>
                            <option value="6" @if ($volleyball->game_status == "6") selected @endif>Final</option>

                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->



                      <div class="section-title">
                        First Game Score
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_first_game_score">{{ $volleyball->away_team->school_name }}</label>

                          <select name="away_team_first_game_score" id="away_team_first_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->away_team_first_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" 
                                     name="game_one_winner" 
                                     id="game_one_winner" 
                                     value="{{ $volleyball->away_team->id }}" 
                                     @if ($volleyball->game_one_winner == $volleyball->away_team->id)
                                      checked="checked"
                                     @endif
                                     >
                                     Check If {{ $volleyball->away_team->school_name }} Won Game 1
                            </label>
                          </div>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_first_game_score">{{ $volleyball->home_team->school_name }}</label>

                          <select name="home_team_first_game_score" id="home_team_first_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->home_team_first_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" 
                                     name="game_one_winner" 
                                     id="game_one_winner" 
                                     value="{{ $volleyball->home_team->id }}" 
                                     @if ($volleyball->game_one_winner == $volleyball->home_team->id)
                                      checked="checked"
                                     @endif
                                     >
                                     Check If {{ $volleyball->home_team->school_name }} Won Game 1
                            </label>
                          </div>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Second Game Score
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_second_game_score">{{ $volleyball->away_team->school_name }}</label>

                          <select name="away_team_second_game_score" id="away_team_second_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->away_team_second_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" 
                                     name="game_two_winner" 
                                     id="game_two_winner" 
                                     value="{{ $volleyball->away_team->id }}" 
                                     @if ($volleyball->game_two_winner == $volleyball->away_team->id)
                                      checked="checked"
                                     @endif
                                     >
                                     Check If {{ $volleyball->away_team->school_name }} Won Game 2
                            </label>
                          </div>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="home_team_second_game_score">{{ $volleyball->home_team->school_name }}</label>

                          <select name="home_team_second_game_score" id="home_team_second_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->home_team_second_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" 
                                     name="game_two_winner" 
                                     id="game_two_winner" 
                                     value="{{ $volleyball->home_team->id }}" 
                                     @if ($volleyball->game_two_winner == $volleyball->home_team->id)
                                      checked="checked"
                                     @endif
                                     >
                                     Check If {{ $volleyball->home_team->school_name }} Won Game 2
                            </label>
                          </div>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Third Game Score
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_third_game_score">{{ $volleyball->away_team->school_name }}</label>

                          <select name="away_team_third_game_score" id="away_team_third_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->away_team_third_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" 
                                     name="game_three_winner" 
                                     id="game_three_winner" 
                                     value="{{ $volleyball->away_team->id }}" 
                                     @if ($volleyball->game_three_winner == $volleyball->away_team->id)
                                      checked="checked"
                                     @endif
                                     >
                                     Check If {{ $volleyball->away_team->school_name }} Won Game 3
                            </label>
                          </div>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="home_team_third_game_score">{{ $volleyball->home_team->school_name }}</label>

                          <select name="home_team_third_game_score" id="home_team_third_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->home_team_third_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" 
                                     name="game_three_winner" 
                                     id="game_three_winner" 
                                     value="{{ $volleyball->home_team->id }}" 
                                     @if ($volleyball->game_three_winner == $volleyball->home_team->id)
                                      checked="checked"
                                     @endif
                                     >
                                     Check If {{ $volleyball->home_team->school_name }} Won Game 3
                            </label>
                          </div>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        4th Game Score
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_fourth_game_score">{{ $volleyball->away_team->school_name }}</label>

                          <select name="away_team_fourth_game_score" id="away_team_fourth_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->away_team_fourth_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" 
                                     name="game_four_winner" 
                                     id="game_four_winner" 
                                     value="{{ $volleyball->away_team->id }}" 
                                     @if ($volleyball->game_four_winner == $volleyball->away_team->id)
                                      checked="checked"
                                     @endif
                                     >
                                     Check If {{ $volleyball->away_team->school_name }} Won Game 4
                            </label>
                          </div>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="home_team_fourth_game_score">{{ $volleyball->home_team->school_name }}</label>

                          <select name="home_team_fourth_game_score" id="home_team_fourth_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->home_team_fourth_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" 
                                     name="game_four_winner" 
                                     id="game_four_winner" 
                                     value="{{ $volleyball->home_team->id }}" 
                                     @if ($volleyball->game_four_winner == $volleyball->home_team->id)
                                      checked="checked"
                                     @endif
                                     >
                                     Check If {{ $volleyball->home_team->school_name }} Won Game 4
                            </label>
                          </div>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        5th Game Score
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="away_team_fifth_game_score">{{ $volleyball->away_team->school_name }}</label>

                          <select name="away_team_fifth_game_score" id="away_team_fifth_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->away_team_fifth_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" 
                                     name="game_five_winner" 
                                     id="game_five_winner" 
                                     value="{{ $volleyball->away_team->id }}" 
                                     @if ($volleyball->game_five_winner == $volleyball->away_team->id)
                                      checked="checked"
                                     @endif
                                     >
                                     Check If {{ $volleyball->away_team->school_name }} Won Game 5
                            </label>
                          </div>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                           <div class="form-group">

                          <label for="home_team_fifth_game_score">{{ $volleyball->home_team->school_name }}</label>

                          <select name="home_team_fifth_game_score" id="home_team_fifth_game_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($volleyball->home_team_fifth_game_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" 
                                     name="game_five_winner" 
                                     id="game_five_winner" 
                                     value="{{ $volleyball->home_team->id }}" 
                                     @if ($volleyball->game_five_winner == $volleyball->home_team->id)
                                      checked="checked"
                                     @endif
                                     >
                                     Check If {{ $volleyball->home_team->school_name }} Won Game 5
                            </label>
                          </div>

                        </div><!--  Form  Group  -->

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

                            <option value="{{ $volleyball->away_team->id }}" @if ($volleyball->winning_team === $volleyball->away_team_id) selected @endif>
                              {{ $volleyball->away_team->school_name }}
                            </option>
                            <option value="{{ $volleyball->home_team->id }}" @if ($volleyball->winning_team === $volleyball->home_team_id) selected @endif>
                              {{ $volleyball->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                            <label for="losing_team">Losing Team</label>

                            <select name="losing_team" id="losing_team" class="form-control">

                              <option value="">Select A Team</option>

                              <option value="{{ $volleyball->away_team->id }}" @if ($volleyball->losing_team === $volleyball->away_team_id) selected @endif>
                                {{ $volleyball->away_team->school_name }}
                              </option>
                              <option value="{{ $volleyball->home_team->id }}" @if ($volleyball->losing_team === $volleyball->home_team_id) selected @endif>
                                {{ $volleyball->home_team->school_name }}
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

                                <option value="{{ $year->id }}" @if ($volleyball->year_id === $year->id) selected @endif >
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
                              <option value="1" @if ($volleyball->team_level == "1") selected @endif>Varsity</option>
                              <option value="2" @if ($volleyball->team_level == "2") selected @endif>Junior Varsity</option>
                              <option value="3" @if ($volleyball->team_level == "3") selected @endif>Freshman</option>
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
                            <input type="text" class="form-control" id="datepicker" name="date" value="{{ $volleyball->date }}" required>
                          </div>

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="time_id">What Time Is The Match?</label>

                          <select name="time_id" id="time_id" class="form-control">

                            @foreach($times as $time)

                              <option value="{{ $time->id }}" @if ($volleyball->time_id === $time->id) selected @endif>{{ $time->time }}</option>

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
                          <input type="text" class="form-control" id="tournament_title" name="tournament_title" value="{{ $volleyball->tournament_title }}">
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

                              <option value="{{ $team['id'] }}" @if ($volleyball->away_team_id == $team['id']) selected @endif>
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

                              <option value="{{ $team['id'] }}" @if ($volleyball->home_team_id === $team['id']) selected @endif>{{ $team->school_name }}</option>

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
                              <option value="0" @if ($volleyball->district_game == "0") selected @endif>No</option>
                              <option value="1" @if ($volleyball->district_game == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                          <label for="scrimmage">Is This A Scrimmage?</label>

                          <select name="scrimmage" id="scrimmage" class="form-control">
                              <option value="0" @if ($volleyball->scrimmage == "0") selected @endif>No</option>
                              <option value="1" @if ($volleyball->scrimmage == "1") selected @endif>Yes</option>
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

                    <form method="POST" action="/volleyball/{{ $volleyball->id }}">

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
