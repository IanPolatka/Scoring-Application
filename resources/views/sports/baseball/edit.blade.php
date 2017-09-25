@extends('layouts.app')



<?php

  if (isset($baseball->away_team_first_inning_score)) :
    $awayFirst = $baseball->away_team_first_inning_score;
  else:
    $awayFirst = 0;
  endif;
  if (isset($baseball->away_team_second_inning_score)) :
    $awaySecond = $baseball->away_team_second_inning_score;
  else:
    $awaySecond = 0;
  endif;
  if (isset($baseball->away_team_third_inning_score)) :
    $awayThird = $baseball->away_team_third_inning_score;
  else:
    $awayThird = 0;
  endif;
  if (isset($baseball->away_team_fourth_inning_score)) :
    $awayFourth = $baseball->away_team_fourth_inning_score;
  else:
    $awayFourth = 0;
  endif;
  if (isset($baseball->away_team_fifth_inning_score)) :
    $awayFourth = $baseball->away_team_fifth_inning_score;
  else:
    $awayFifth = 0;
  endif;
  if (isset($baseball->away_team_sixth_inning_score)) :
    $awayFourth = $baseball->away_team_sixth_inning_score;
  else:
    $awaySixth = 0;
  endif;
  if (isset($baseball->away_team_seventh_inning_score)) :
    $awayFourth = $baseball->away_team_seventh_inning_score;
  else:
    $awaySeventh = 0;
  endif;
  if (isset($baseball->away_team_extra_inning_score)) :
    $awayExtra = $baseball->away_team_extra_inning_score;
  else:
    $awayExtra = 0;
  endif;

  if (isset($baseball->home_team_first_inning_score)) :
    $homeFirst = $baseball->home_team_first_inning_score;
  else:
    $homeFirst = 0;
  endif;
  if (isset($baseball->home_team_second_inning_score)) :
    $homeSecond = $baseball->home_team_second_inning_score;
  else:
    $homeSecond = 0;
  endif;
  if (isset($baseball->home_team_third_inning_score)) :
    $homeThird = $baseball->home_team_third_inning_score;
  else:
    $homeThird = 0;
  endif;
  if (isset($baseball->home_team_fourth_inning_score)) :
    $homeFourth = $baseball->home_team_fourth_inning_score;
  else:
    $homeFourth = 0;
  endif;
  if (isset($baseball->home_team_fifth_inning_score)) :
    $homeFifth = $baseball->home_team_fifth_inning_score;
  else:
    $homeFifth = 0;
  endif;
  if (isset($baseball->home_team_sixth_inning_score)) :
    $homeSixth = $baseball->home_team_sixth_inning_score;
  else:
    $homeSixth = 0;
  endif;
  if (isset($baseball->home_team_seventh_inning_score)) :
    $homeSeventh = $baseball->home_team_seventh_inning_score;
  else:
    $homeSeventh = 0;
  endif;
  if (isset($baseball->home_team_extra_inning_score)) :
    $homeExtra = $baseball->home_team_extra_inning_score;
  else:
    $homeExtra = 0;
  endif;

  $awayActiveScore = $awayFirst + $awaySecond + $awayThird + $awayFourth + $awayFifth + $awaySixth + $awaySeventh + $awayExtra;
  $homeActiveScore = $homeFirst + $homeSecond + $homeThird + $homeFourth + $homeFifth + $homeSixth + $homeSeventh + $homeExtra;

?>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                  Game Summary
                    <div class="pull-right"><small><strong>
                      @if ($baseball->game_status == "0") {{ $baseball->game_time }} @endif
                      @if ($baseball->game_status == "1") <span style="color: red">1st Inning</span> @endif
                      @if ($baseball->game_status == "2") <span style="color: red">2nd Inning</span> @endif
                      @if ($baseball->game_status == "3") <span style="color: red">3rd Inning</span> @endif
                      @if ($baseball->game_status == "4") <span style="color: red">4th Inning</span> @endif
                      @if ($baseball->game_status == "5") <span style="color: red">5th Inning</span> @endif
                      @if ($baseball->game_status == "6") <span style="color: red">6th Inning</span> @endif
                      @if ($baseball->game_status == "7") <span style="color: red">7th Inning</span> @endif
                      @if ($baseball->game_status == "8") <span style="color: red">Extra Innings</span> @endif
                      @if ($baseball->game_status == "9") Final @endif
                    </strong></small></div>
                </div>

                    <ul class="list-group">

                      <li class="list-group-item">

                        @if ($baseball->tournament_title)
                          <small><strong>{{ $baseball->tournament_title }}</strong></small>
                        @endif

                        <span class="pull-right" style="width: 25px; padding-left: 10px;">
                          <strong><small>
                          @if ($baseball->gamestatus != 9)
                            T
                          @else
                            F
                          @endif
                          </small></strong>
                        </span>
                        @if ($baseball->away_team_extra_inning_score || $baseball->home_team_extra_inning_score)
                          <span class="pull-right" style="width: 25px"><strong><small>E</small></strong></span>
                        @endif
                        <span class="pull-right" style="width: 25px"><strong><small>7</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>6</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>5</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>4</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>3</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>2</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>1</small></strong></span>

                        <div class="clearfix"></div>

                      </li>

                      <li class="list-group-item">
                        @if ($baseball->away_team->logo)
                          <img src="/images/team-logos/{{ $baseball->away_team->logo }}" 
                            style="height: 20px; width: 20px; float: left; margin-right: 10px;">
                        @endif
                        {{ $baseball->away_team->school_name }}
                        @if ($baseball->at_bat === $baseball->away_team_id)
                          <small><span class="glyphicon glyphicon-bell" aria-hidden="true" style="margin-left: 10px"></span></small>
                        @endif
                        @if ($baseball->game_status < 1 && $baseball->game_status > 9)
                          <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;"><?php echo $awayActiveScore; ?>&nbsp;</span>
                        @else
                          @if ($baseball->away_team_final_score)
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;">{{$baseball->away_team_final_score}}&nbsp;</span>
                          @else
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;"><?php echo $awayActiveScore; ?>&nbsp;</span>
                          @endif
                        @endif
                        <span class="pull-right" style="width: 25px">{{ $baseball->away_team_extra_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->away_team_seventh_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->away_team_sixth_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->away_team_fifth_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->away_team_fourth_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->away_team_third_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->away_team_second_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->away_team_first_inning_score }}</span>
                      </li>
                      <li class="list-group-item">
                        @if ($baseball->home_team->logo)
                          <img src="/images/team-logos/{{ $baseball->home_team->logo }}" 
                            style="height: 20px; width: 20px; float: left; margin-right: 10px;">
                        @endif
                        {{ $baseball->home_team->school_name }}
                        @if ($baseball->at_bat === $baseball->home_team_id)
                          <small><span class="glyphicon glyphicon-bell" aria-hidden="true" style="margin-left: 10px"></span></small>
                        @endif
                        @if ($baseball->game_status < 1 && $baseball->game_status > 6)
                          <?php echo $homeActiveScore; ?></span>
                        @else
                         @if ($baseball->home_team_final_score)
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;">{{$baseball->home_team_final_score}}</span>
                          @else
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;"><?php echo $homeActiveScore; ?></span>
                          @endif
                        @endif
                        <span class="pull-right" style="width: 25px">{{ $baseball->home_team_extra_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->home_team_seventh_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->home_team_sixth_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->home_team_fifth_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->home_team_fourth_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->home_team_third_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->home_team_second_inning_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $baseball->home_team_first_inning_score }}</span>
                      </li>

                    </ul>

            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Update Game</div>

                <div class="panel-body">
                    <form method="POST" action="/baseball/game/{{ $baseball->id }}">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}

                        <div class="form-group">

                          <label for="year_id">What Year Is This Match For?</label>

                          <select name="year_id" id="year_id" class="form-control">

                            <option value="">Select A School Year</option>

                            <option value="{{ $thecurrentyear['id'] }}">{{ $thecurrentyear['year'] }}</option>

                            <option value="">---------------------</option>

                            @foreach($years as $year)

                              <option value="{{ $year->id }}" @if ($baseball->year_id === $year->id) selected @endif >
                                  {{ $year->year }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="team_level">What Team Level Is This For?</label>
                          <select name="team_level" id="team_level" class="form-control">
                              <option value="1" @if ($baseball->team_level == "1") selected @endif>Varsity</option>
                              <option value="2" @if ($baseball->team_level == "2") selected @endif>Junior Varsity</option>
                              <option value="3" @if ($baseball->team_level == "3") selected @endif>Freshman</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="date">Date</label>
                          <input type="text" class="form-control" id="datepicker" name="date" value="{{ $baseball->date }}" required>
                        </div>

                        <div class="form-group">

                          <label for="scrimmage">Is This A Scrimmage?</label>

                          <select name="scrimmage" id="scrimmage" class="form-control">
                              <option value="0" @if ($baseball->scrimmage == "0") selected @endif>No</option>
                              <option value="1" @if ($baseball->scrimmage == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="tournament_title">Tournament Title</label>
                          <input type="text" class="form-control" id="tournament_title" name="tournament_title" value="{{ $baseball->tournament_title }}">
                        </div>

                        <div class="form-group">

                          <label for="away_team_id">Away Team</label>

                          <select name="away_team_id" id="away_team_id" class="form-control">

                            <option value="null">Please Select An Away School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" @if ($baseball->away_team_id == $team['id']) selected @endif>
                                {{ $team['school_name'] }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_id">Home Team</label>

                          <select name="home_team_id" id="home_team_id" class="form-control">

                            <option value="null">Please Select An Home School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" @if ($baseball->home_team_id === $team['id']) selected @endif>{{ $team->school_name }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  --> 
                     
                        <div class="form-group">

                          <label for="time_id">What Time Is The Match?</label>

                          <select name="time_id" id="time_id" class="form-control">

                            @foreach($times as $time)

                              <option value="{{ $time->id }}" @if ($baseball->time_id === $time->id) selected @endif>{{ $time->time }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="district_game">Is This A District Game?</label>

                          <select name="district_game" id="district_game" class="form-control">
                              <option value="0" @if ($baseball->district_game == "0") selected @endif>No</option>
                              <option value="1" @if ($baseball->district_game == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->



                        <h4><strong>Game Score</strong></h4>

                        <div class="form-group">

                          <label for="away_team_first_inning_score">{{ $baseball->away_team->school_name }} {{ $baseball->away_team->mascot }} First Quarter Score</label>

                          <select name="away_team_first_inning_score" id="away_team_first_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->away_team_first_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_second_inning_score">{{ $baseball->away_team->school_name }} {{ $baseball->away_team->mascot }} Second Inning Score</label>

                          <select name="away_team_second_inning_score" id="away_team_second_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->away_team_second_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_third_inning_score">{{ $baseball->away_team->school_name }} {{ $baseball->away_team->mascot }} Third Inning Score</label>

                          <select name="away_team_third_inning_score" id="away_team_third_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->away_team_third_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_fourth_inning_score">{{ $baseball->away_team->school_name }} {{ $baseball->away_team->mascot }} Fourth Inning Score</label>

                          <select name="away_team_fourth_inning_score" id="away_team_fourth_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->away_team_fourth_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_fifth_inning_score">{{ $baseball->away_team->school_name }} {{ $baseball->away_team->mascot }} Fifth Inning Score</label>

                          <select name="away_team_fifth_inning_score" id="away_team_fifth_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->away_team_fifth_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_sixth_inning_score">{{ $baseball->away_team->school_name }} {{ $baseball->away_team->mascot }} Sixth Inning Score</label>

                          <select name="away_team_sixth_inning_score" id="away_team_sixth_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->away_team_sixth_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_seventh_inning_score">{{ $baseball->away_team->school_name }} {{ $baseball->away_team->mascot }} Seventh Inning Score</label>

                          <select name="away_team_seventh_inning_score" id="away_team_seventh_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->away_team_seventh_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_extra_inning_score">{{ $baseball->away_team->school_name }} {{ $baseball->away_team->mascot }} Extra Innings Score</label>

                          <select name="away_team_extra_inning_score" id="away_team_extra_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->away_team_extra_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_final_score">{{ $baseball->away_team->school_name }} {{ $baseball->away_team->mascot }} Final Score</label>

                          <select name="away_team_final_score" id="away_team_final_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 199; $i++) 
                                <option value="{{ $i }}" @if ($baseball->away_team_final_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->



                        <hr>



                        <div class="form-group">

                          <label for="home_team_first_inning_score">{{ $baseball->home_team->school_name }} {{ $baseball->home_team->mascot }} First Inning Score</label>

                          <select name="home_team_first_qrt_score" id="home_team_first_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->home_team_first_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_second_inning_score">{{ $baseball->home_team->school_name }} {{ $baseball->home_team->mascot }} Second Inning Score</label>

                          <select name="home_team_second_qrt_score" id="home_team_second_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->home_team_second_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_third_qrt_score">{{ $baseball->home_team->school_name }} {{ $baseball->home_team->mascot }} Third Inning Score</label>

                          <select name="home_team_third_inning_score" id="home_team_third_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->home_team_third_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_fourth_inning_score">{{ $baseball->home_team->school_name }} {{ $baseball->home_team->mascot }} Fourth Inning Score</label>

                          <select name="home_team_fourth_inning_score" id="home_team_fourth_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->home_team_fourth_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                         <div class="form-group">

                          <label for="home_team_fifth_inning_score">{{ $baseball->home_team->school_name }} {{ $baseball->home_team->mascot }} Fifth Inning Score</label>

                          <select name="home_team_fifth_inning_score" id="home_team_fifth_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->home_team_fifth_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                         <div class="form-group">

                          <label for="home_team_sixth_inning_score">{{ $baseball->home_team->school_name }} {{ $baseball->home_team->mascot }} 6th Inning Score</label>

                          <select name="home_team_sixth_inning_score" id="home_team_sixth_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->home_team_sixth_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                         <div class="form-group">

                          <label for="home_team_seventh_inning_score">{{ $baseball->home_team->school_name }} {{ $baseball->home_team->mascot }} Seventh Inning Score</label>

                          <select name="home_team_seventh_inning_score" id="home_team_seventh_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->home_team_seventh_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                         <div class="form-group">

                          <label for="home_team_extra_inning_score">{{ $baseball->home_team->school_name }} {{ $baseball->home_team->mascot }} Extra Innings Score</label>

                          <select name="home_team_extra_inning_score" id="home_team_extra_inning_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($baseball->home_team_extra_inning_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->                

                        <div class="form-group">
                          <label for="home_team_final_score">
                              {{ $baseball->home_team->school_name }} {{ $baseball->home_team->mascot }} Final Score
                            </label>
                          <div class="input-group">
                            <div class="input-group-btn">
                              <button type="button" id="SubtractButton" class="btn btn-danger">-</button>
                            </div>
                            <input type="text" class="form-control" 
                                   id="home_team_final_score" 
                                   name="home_team_final_score" 
                                   value="{{ $baseball->home_team_final_score }}" min="0">
                            <div class="input-group-btn">
                              <button type="button" id="AddButton" class="btn btn-success">+</button>
                            </div>
                          </div>
                        </div>


                        <div class="clearfix"></div>



                        <hr>



                        <div class="form-group">

                          <label for="game_status">Game Status</label>

                          <select name="game_status" id="game_status" class="form-control">

                            <option value="" @if ($baseball->game_status == "") selected @endif>Select A Status</option>
                            <option value="0" @if ($baseball->game_status == "0") selected @endif>Game Has Not Started Yet</option>
                            <option value="1" @if ($baseball->game_status == "1") selected @endif>1st Inning</option>
                            <option value="2" @if ($baseball->game_status == "2") selected @endif>2nd Inning</option>
                            <option value="3" @if ($baseball->game_status == "3") selected @endif>3rd Inning</option>
                            <option value="4" @if ($baseball->game_status == "4") selected @endif>4th Inning</option>
                            <option value="5" @if ($baseball->game_status == "5") selected @endif>5th Inning</option>
                            <option value="6" @if ($baseball->game_status == "6") selected @endif>6th Inning</option>
                            <option value="7" @if ($baseball->game_status == "7") selected @endif>7th Inning</option>
                            <option value="7" @if ($baseball->game_status == "8") selected @endif>Extra Innings</option>
                            <option value="7" @if ($baseball->game_status == "9") selected @endif>Final</option>

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="at_bat">Who Has Possession</label>

                          <select name="at_bat" id="at_bat" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $baseball->away_team->id }}" @if ($baseball->at_bat === $baseball->away_team_id) selected @endif>
                              {{ $baseball->away_team->school_name }}
                            </option>
                            <option value="{{ $baseball->home_team->id }}" @if ($baseball->at_bat === $baseball->home_team_id) selected @endif>
                              {{ $baseball->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->



                        <hr>



                        <div class="form-group">

                          <label for="winning_team">Winning Team</label>

                          <select name="winning_team" id="winning_team" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $baseball->away_team->id }}" @if ($baseball->winning_team === $baseball->away_team_id) selected @endif>
                              {{ $baseball->away_team->school_name }}
                            </option>
                            <option value="{{ $baseball->home_team->id }}" @if ($baseball->winning_team === $baseball->home_team_id) selected @endif>
                              {{ $baseball->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="losing_team">Losing Team</label>

                          <select name="losing_team" id="losing_team" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $baseball->away_team->id }}" @if ($baseball->losing_team === $baseball->away_team_id) selected @endif>
                              {{ $baseball->away_team->school_name }}
                            </option>
                            <option value="{{ $baseball->home_team->id }}" @if ($baseball->losing_team === $baseball->home_team_id) selected @endif>
                              {{ $baseball->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->



                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Update Game</button>
                        </div>
                    
                    </form>

                    <form method="POST" action="/baseball/game/{{ $baseball->id }}">

                      {{ method_field('DELETE') }}

                      {{ csrf_field() }}    

                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-left">Delete Match</button>
                    
                    </form>

                    <script>
                      $(".delete").on("submit", function(){
                          return confirm("Do you want to delete this item?");
                      });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
