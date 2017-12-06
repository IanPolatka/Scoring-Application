@extends('layouts.app')



<?php

  if (isset($basketball->away_team_first_qrt_score)) :
    $awayFirst = $basketball->away_team_first_qrt_score;
  else:
    $awayFirst = 0;
  endif;
  if (isset($basketball->away_team_second_qrt_score)) :
    $awaySecond = $basketball->away_team_second_qrt_score;
  else:
    $awaySecond = 0;
  endif;
  if (isset($basketball->away_team_third_qrt_score)) :
    $awayThird = $basketball->away_team_third_qrt_score;
  else:
    $awayThird = 0;
  endif;
  if (isset($basketball->away_team_fourth_qrt_score)) :
    $awayFourth = $basketball->away_team_fourth_qrt_score;
  else:
    $awayFourth = 0;
  endif;
  if (isset($basketball->away_team_overtime_score)) :
    $awayOver = $basketball->away_team_overtime_score;
  else:
    $awayOver = 0;
  endif;

  if (isset($basketball->home_team_first_qrt_score)) :
    $homeFirst = $basketball->home_team_first_qrt_score;
  else:
    $homeFirst = 0;
  endif;
  if (isset($basketball->home_team_second_qrt_score)) :
    $homeSecond = $basketball->home_team_second_qrt_score;
  else:
    $homeSecond = 0;
  endif;
  if (isset($basketball->home_team_third_qrt_score)) :
    $homeThird = $basketball->home_team_third_qrt_score;
  else:
    $homeThird = 0;
  endif;
  if (isset($basketball->home_team_fourth_qrt_score)) :
    $homeFourth = $basketball->home_team_fourth_qrt_score;
  else:
    $homeFourth = 0;
  endif;
  if (isset($basketball->home_team_overtime_score)) :
    $homeOver = $basketball->home_team_overtime_score;
  else:
    $homeOver = 0;
  endif;

  $awayActiveScore = $awayFirst + $awaySecond + $awayThird + $awayFourth + $awayOver;
  $homeActiveScore = $homeFirst + $homeSecond + $homeThird + $homeFourth + $homeOver;

?>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                  Game Summary
                    <div class="pull-right" style="margin-left: 10px">
                      <small><strong>
                      {{ $basketball->minutes_remaining }}:{{ $basketball->seconds_remaining }}
                      </strong></small>
                    </div>
                    <div class="pull-right"><small><strong>
                      @if ($basketball->game_status == "0") {{ $basketball->game_time }} @endif
                      @if ($basketball->game_status == "1") <span style="color: red">1st Quarter</span> @endif
                      @if ($basketball->game_status == "2") <span style="color: red">2nd Quarter</span> @endif
                      @if ($basketball->game_status == "3") <span style="color: red">Halftime</span> @endif
                      @if ($basketball->game_status == "4") <span style="color: red">3rd Quarter</span> @endif
                      @if ($basketball->game_status == "5") <span style="color: red">4th Quarter</span> @endif
                      @if ($basketball->game_status == "6") <span style="color: red">Overtime</span> @endif
                      @if ($basketball->game_status == "7") Final @endif
                    </strong></small></div>
                </div>

                    <ul class="list-group">

                      <li class="list-group-item">

                        @if ($basketball->tournament_title)
                          <small><strong>{{ $basketball->tournament_title }}</strong></small>
                        @endif

                        <span class="pull-right" style="width: 25px; padding-left: 10px;">
                          <strong><small>
                          @if ($basketball->gamestatus != 7)
                            T
                          @else
                            F
                          @endif
                          </small></strong>
                        </span>
                        <span class="pull-right" style="width: 25px"><strong><small>O</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>4</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>3</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>2</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>1</small></strong></span>

                        <div class="clearfix"></div>

                      </li>

                      <li class="list-group-item">
                        @if ($basketball->away_team->logo)
                          <img src="/images/team-logos/{{ $basketball->away_team->logo }}" 
                            style="height: 20px; width: 20px; float: left; margin-right: 10px;">
                        @endif
                        {{ $basketball->away_team->school_name }}
                        @if ($basketball->possession === $basketball->away_team_id)
                          <span class="glyphicon glyphicon-bell" aria-hidden="true" style="margin-right: 10px"></span>
                        @endif
                        @if ($basketball->game_status < 1 && $basketball->game_status > 6)
                          <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;"><?php echo $awayActiveScore; ?>&nbsp;</span>
                        @else
                          @if ($basketball->away_team_final_score)
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;">{{$basketball->away_team_final_score}}&nbsp;</span>
                          @else
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;"><?php echo $awayActiveScore; ?>&nbsp;</span>
                          @endif
                        @endif
                        <span class="pull-right" style="width: 25px">{{ $basketball->away_team_overtime_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $basketball->away_team_fourth_qrt_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $basketball->away_team_third_qrt_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $basketball->away_team_second_qrt_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $basketball->away_team_first_qrt_score }}</span>
                      </li>
                      <li class="list-group-item">
                        @if ($basketball->home_team['logo'])
                          <img src="/images/team-logos/{{ $basketball->home_team['logo'] }}" 
                            style="height: 20px; width: 20px; float: left; margin-right: 10px;">
                        @endif
                        {{ $basketball->home_team['school_name'] }}
                        @if ($basketball->possession === $basketball->home_team_id)
                          <small><span class="glyphicon glyphicon-bell" aria-hidden="true" style="margin-left: 10px"></span></small>
                        @endif
                        @if ($basketball->game_status < 1 && $basketball->game_status > 6)
                          <?php echo $homeActiveScore; ?></span>
                        @else
                         @if ($basketball->home_team_final_score)
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;">{{$basketball->home_team_final_score}}</span>
                          @else
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;"><?php echo $homeActiveScore; ?></span>
                          @endif
                        @endif
                        <span class="pull-right" style="width: 25px">{{ $basketball->home_team_overtime_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $basketball->home_team_fourth_qrt_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $basketball->home_team_third_qrt_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $basketball->home_team_second_qrt_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $basketball->home_team_first_qrt_score }}</span>
                      </li>

                    </ul>

            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Update Game</div>

                <div class="panel-body">
                    <form method="POST" action="/basketball-boys/game/{{ $basketball->id }}">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}

                        <div class="form-group">

                          <label for="year_id">What Year Is This Match For?</label>

                          <select name="year_id" id="year_id" class="form-control">

                            <option value="">Select A School Year</option>

                            <option value="{{ $thecurrentyear['id'] }}">{{ $thecurrentyear['year'] }}</option>

                            <option value="">---------------------</option>

                            @foreach($years as $year)

                              <option value="{{ $year->id }}" @if ($basketball->year_id === $year->id) selected @endif >
                                  {{ $year->year }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="team_level">What Team Level Is This For?</label>
                          <select name="team_level" id="team_level" class="form-control">
                              <option value="1" @if ($basketball->team_level == "1") selected @endif>Varsity</option>
                              <option value="2" @if ($basketball->team_level == "2") selected @endif>Junior Varsity</option>
                              <option value="3" @if ($basketball->team_level == "3") selected @endif>Freshman</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="date">Date</label>
                          <input type="text" class="form-control" id="datepicker" name="date" value="{{ $basketball->date }}" required>
                        </div>

                        <div class="form-group">

                          <label for="scrimmage">Is This A Scrimmage?</label>

                          <select name="scrimmage" id="scrimmage" class="form-control">
                              <option value="0" @if ($basketball->scrimmage == "0") selected @endif>No</option>
                              <option value="1" @if ($basketball->scrimmage == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="tournament_title">Tournament Title</label>
                          <input type="text" class="form-control" id="tournament_title" name="tournament_title" value="{{ $basketball->tournament_title }}">
                        </div>

                        <div class="form-group">

                          <label for="away_team_id">Away Team</label>

                          <select name="away_team_id" id="away_team_id" class="form-control">

                            <option value="null">Please Select An Away School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" @if ($basketball->away_team_id == $team['id']) selected @endif>
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

                              <option value="{{ $team['id'] }}" @if ($basketball->home_team_id === $team['id']) selected @endif>{{ $team->school_name }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  --> 
                     
                        <div class="form-group">

                          <label for="time_id">What Time Is The Match?</label>

                          <select name="time_id" id="time_id" class="form-control">

                            @foreach($times as $time)

                              <option value="{{ $time->id }}" @if ($basketball->time_id === $time->id) selected @endif>{{ $time->time }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="district_game">Is This A District Game?</label>

                          <select name="district_game" id="district_game" class="form-control">
                              <option value="0" @if ($basketball->district_game == "0") selected @endif>No</option>
                              <option value="1" @if ($basketball->district_game == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->



                        <h4><strong>Game Score</strong></h4>

                        <div class="form-group">

                          <label for="away_team_first_qrt_score">{{ $basketball->away_team->school_name }} {{ $basketball->away_team->mascot }} First Quarter Score</label>

                          <select name="away_team_first_qrt_score" id="away_team_first_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($basketball->away_team_first_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_second_qrt_score">{{ $basketball->away_team->school_name }} {{ $basketball->away_team->mascot }} Second Quarter Score</label>

                          <select name="away_team_second_qrt_score" id="away_team_second_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($basketball->away_team_second_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_third_qrt_score">{{ $basketball->away_team->school_name }} {{ $basketball->away_team->mascot }} Third Quarter Score</label>

                          <select name="away_team_third_qrt_score" id="away_team_third_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($basketball->away_team_third_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_fourth_qrt_score">{{ $basketball->away_team->school_name }} {{ $basketball->away_team->mascot }} Fourth Quarter Score</label>

                          <select name="away_team_fourth_qrt_score" id="away_team_fourth_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($basketball->away_team_fourth_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_overtime_score">{{ $basketball->away_team->school_name }} {{ $basketball->away_team->mascot }} Overtime Score</label>

                          <select name="away_team_overtime_score" id="away_team_overtime_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($basketball->away_team_overtime_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_final_score">{{ $basketball->away_team->school_name }} {{ $basketball->away_team->mascot }} Final Score</label>

                          <select name="away_team_final_score" id="away_team_final_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 199; $i++) 
                                <option value="{{ $i }}" @if ($basketball->away_team_final_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <hr>

                        <div class="form-group">

                          <label for="away_team_first_qrt_score">{{ $basketball->home_team['school_name'] }} {{ $basketball->home_team['mascot'] }} First Quarter Score</label>

                          <select name="home_team_first_qrt_score" id="home_team_first_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($basketball->home_team_first_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_second_qrt_score">{{ $basketball->home_team['school_name'] }} {{ $basketball->home_team['mascot'] }} Second Quarter Score</label>

                          <select name="home_team_second_qrt_score" id="home_team_second_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($basketball->home_team_second_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_third_qrt_score">{{ $basketball->home_team['school_name'] }} {{ $basketball->home_team['mascot'] }} Third Quarter Score</label>

                          <select name="home_team_third_qrt_score" id="home_team_third_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($basketball->home_team_third_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_fourth_qrt_score">{{ $basketball->home_team['school_name'] }} {{ $basketball->home_team['mascot'] }} Fourth Quarter Score</label>

                          <select name="home_team_fourth_qrt_score" id="home_team_fourth_qrt_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($basketball->home_team_fourth_qrt_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_overtime_score">{{ $basketball->home_team['school_name'] }} {{ $basketball->home_team['mascot'] }} Overtime Score</label>

                          <select name="home_team_overtime_score" id="home_team_overtime_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($basketball->home_team_overtime_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                       

                        

                        <div class="form-group">
                          <label for="home_team_final_score">
                              {{ $basketball->home_team['school_name'] }} {{ $basketball->home_team['mascot'] }} Final Score
                            </label>
                          <div class="input-group">
                            <div class="input-group-btn">
                              <button type="button" id="SubtractButton" class="btn btn-danger">-</button>
                            </div>
                            <input type="text" class="form-control" 
                                   id="home_team_final_score" 
                                   name="home_team_final_score" 
                                   value="{{ $basketball->home_team_final_score }}" min="0">
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

                            <option value="" @if ($basketball->game_status == "") selected @endif>Select A Status</option>
                            <option value="0" @if ($basketball->game_status == "0") selected @endif>Game Has Not Started Yet</option>
                            <option value="1" @if ($basketball->game_status == "1") selected @endif>1st Quarter</option>
                            <option value="2" @if ($basketball->game_status == "2") selected @endif>2nd Quarter</option>
                            <option value="3" @if ($basketball->game_status == "3") selected @endif>Halftime</option>
                            <option value="4" @if ($basketball->game_status == "4") selected @endif>3rd Quarter</option>
                            <option value="5" @if ($basketball->game_status == "5") selected @endif>4th Quarter</option>
                            <option value="6" @if ($basketball->game_status == "6") selected @endif>Overtime</option>
                            <option value="7" @if ($basketball->game_status == "7") selected @endif>Final</option>

                          </select>

                        </div><!--  Form  Group  -->




                        <div class="form-group">

                          <label for="minutes_remaining">How Many Minutes Are Remaining?</label>

                          <select name="minutes_remaining" id="minutes_remaining" class="form-control">
                              <option value="">Enter A Minute</option>
                              @for ($i = 0; $i < 15; $i++) 
                                <option value="{{ $i }}" @if ($basketball->minutes_remaining == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->



                        <div class="form-group">

                          <label for="seconds_remaining">How Many Seconds Are Remaining?</label>

                          <select name="seconds_remaining" id="seconds_remaining" class="form-control">
                              <option value="">Enter A Second</option>
                              <option value="00" @if ($basketball->seconds_remaining == "00") selected @endif>
                                00
                              </option>
                              <option value="01" @if ($basketball->seconds_remaining == "01") selected @endif>
                                01
                              </option>
                              <option value="02" @if ($basketball->seconds_remaining == "02") selected @endif>02</option>
                              <option value="03" @if ($basketball->seconds_remaining == "03") selected @endif>03</option>
                              <option value="04" @if ($basketball->seconds_remaining == "04") selected @endif>04</option>
                              <option value="05" @if ($basketball->seconds_remaining == "05") selected @endif>05</option>
                              <option value="06" @if ($basketball->seconds_remaining == "06") selected @endif>06</option>
                              <option value="07" @if ($basketball->seconds_remaining == "07") selected @endif>07</option>
                              <option value="08" @if ($basketball->seconds_remaining == "08") selected @endif>08</option>
                              <option value="09" @if ($basketball->seconds_remaining == "09") selected @endif>09</option>
                              @for ($i = 10; $i < 60; $i++)
                                <option value='{{ $i }} @if ($basketball->seconds_remaining == $i) selected @endif'>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->





                        <hr>





                        <div class="form-group">

                          <label for="winning_team">Winning Team</label>

                          <select name="winning_team" id="winning_team" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $basketball->away_team->id }}" @if ($basketball->winning_team === $basketball->away_team_id) selected @endif>
                              {{ $basketball->away_team->school_name }}
                            </option>
                            <option value="{{ $basketball->home_team['id'] }}" @if ($basketball->winning_team === $basketball->home_team_id) selected @endif>
                              {{ $basketball->home_team['school_name'] }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="losing_team">Losing Team</label>

                          <select name="losing_team" id="losing_team" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $basketball->away_team->id }}" @if ($basketball->losing_team === $basketball->away_team_id) selected @endif>
                              {{ $basketball->away_team['school_name'] }}
                            </option>
                            <option value="{{ $basketball->home_team['id'] }}" @if ($basketball->losing_team === $basketball->home_team_id) selected @endif>
                              {{ $basketball->home_team['school_name'] }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->



                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Update Game</button>
                        </div>
                    
                    </form>

                    <form method="POST" action="/basketball-boys/{{ $basketball->id }}">

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
