@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                  Game Summary
                    <div class="pull-right" style="margin-left: 10px">
                      <small><strong>
                      {{ $soccer->minutes_remaining }}:{{ $soccer->seconds_remaining }}
                      </strong></small>
                    </div>
                    <div class="pull-right"><small><strong>
                      @if ($soccer->game_status == "0") {{ $soccer->game_time }} @endif
                      @if ($soccer->game_status == "1") <span style="color: red">1st Half</span> @endif
                      @if ($soccer->game_status == "2") <span style="color: red">Halftime</span> @endif
                      @if ($soccer->game_status == "3") <span style="color: red">2nd Half</span> @endif
                      @if ($soccer->game_status == "4") <span style="color: red">Overtime</span> @endif
                      @if ($soccer->game_status == "5") Final @endif
                    </strong></small></div>
                </div>

                    <ul class="list-group">

                      <li class="list-group-item">

                        @if ($soccer->tournament_title)
                          <small><strong>{{ $soccer->tournament_title }}</strong></small>
                        @endif

                        <span class="pull-right" style="width: 25px; padding-left: 10px;">
                          <strong><small>
                          @if ($soccer->gamestatus != 5)
                            T
                          @else
                            F
                          @endif
                          </small></strong>
                        </span>
                        <span class="pull-right" style="width: 25px"><strong><small>O</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>2</small></strong></span>
                        <span class="pull-right" style="width: 25px"><strong><small>1</small></strong></span>

                        <div class="clearfix"></div>

                      </li>

                      <li class="list-group-item">
                        @if ($soccer->away_team->logo)
                          <img src="/images/team-logos/{{ $soccer->away_team->logo }}" 
                            style="height: 20px; width: 20px; float: left; margin-right: 10px;">
                        @endif
                        {{ $soccer->away_team->school_name }}
                        @if ($soccer->possession === $soccer->away_team_id)
                          <span class="glyphicon glyphicon-bell" aria-hidden="true" style="margin-right: 10px"></span>
                        @endif
                        @if ($soccer->game_status < 1 && $soccer->game_status > 4)
                          <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;">
                            <?php echo $away_team_score_computed; ?>&nbsp;
                          </span>
                        @else
                          @if ($soccer->away_team_final_score)
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;">
                              {{$soccer->away_team_final_score}}&nbsp;
                            </span>
                          @else
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;">
                              <?php echo $away_team_score_computed; ?>&nbsp;
                            </span>
                          @endif
                        @endif
                        <span class="pull-right" style="width: 25px">{{ $soccer->away_team_overtime_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $soccer->away_team_second_half_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $soccer->away_team_first_half_score }}</span>
                      </li>
                      <li class="list-group-item">
                        @if ($soccer->home_team->logo)
                          <img src="/images/team-logos/{{ $soccer->home_team->logo }}" 
                            style="height: 20px; width: 20px; float: left; margin-right: 10px;">
                        @endif
                        {{ $soccer->home_team->school_name }}
                        @if ($soccer->possession === $soccer->home_team_id)
                          <small><span class="glyphicon glyphicon-bell" aria-hidden="true" style="margin-left: 10px"></span></small>
                        @endif
                        @if ($soccer->game_status < 1 && $soccer->game_status > 4)
                          <?php echo $home_team_score_computed; ?></span>
                        @else
                         @if ($soccer->home_team_final_score)
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;">{{$soccer->home_team_final_score}}</span>
                          @else
                            <span class="pull-right" style="width: 25px; border-left: 1px solid #999; padding-left: 10px;"><?php echo $home_team_score_computed; ?></span>
                          @endif
                        @endif
                        <span class="pull-right" style="width: 25px">{{ $soccer->home_team_overtime_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $soccer->home_team_second_half_score }}</span>
                        <span class="pull-right" style="width: 25px">{{ $soccer->home_team_first_half_score }}</span>
                      </li>

                    </ul>

            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Update Game</div>

                <div class="panel-body">
                    <form method="POST" action="/soccer-girls/match/{{ $soccer->id }}">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}

                        <div class="form-group">

                          <label for="year_id">What Year Is This Match For?</label>

                          <select name="year_id" id="year_id" class="form-control">

                            <option value="">Select A School Year</option>

                            <option value="{{ $thecurrentyear['id'] }}">{{ $thecurrentyear['year'] }}</option>

                            <option value="">---------------------</option>

                            @foreach($years as $year)

                              <option value="{{ $year->id }}" @if ($soccer->year_id === $year->id) selected @endif >
                                  {{ $year->year }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="team_level">What Team Level Is This For?</label>
                          <select name="team_level" id="team_level" class="form-control">
                              <option value="1" @if ($soccer->team_level == "1") selected @endif>Varsity</option>
                              <option value="2" @if ($soccer->team_level == "2") selected @endif>Junior Varsity</option>
                              <option value="3" @if ($soccer->team_level == "3") selected @endif>Freshman</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="date">Date</label>
                          <input type="text" class="form-control" id="datepicker" name="date" value="{{ $soccer->date }}" required>
                        </div>

                        <div class="form-group">

                          <label for="scrimmage">Is This A Scrimmage?</label>

                          <select name="scrimmage" id="scrimmage" class="form-control">
                              <option value="0" @if ($soccer->scrimmage == "0") selected @endif>No</option>
                              <option value="1" @if ($soccer->scrimmage == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="tournament_title">Tournament Title</label>
                          <input type="text" class="form-control" id="tournament_title" name="tournament_title" value="{{ $soccer->tournament_title }}">
                        </div>

                        <div class="form-group">

                          <label for="away_team_id">Away Team</label>

                          <select name="away_team_id" id="away_team_id" class="form-control">

                            <option value="null">Please Select An Away School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" @if ($soccer->away_team_id == $team['id']) selected @endif>
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

                              <option value="{{ $team['id'] }}" @if ($soccer->home_team_id === $team['id']) selected @endif>{{ $team->school_name }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  --> 
                     
                        <div class="form-group">

                          <label for="time_id">What Time Is The Match?</label>

                          <select name="time_id" id="time_id" class="form-control">

                            @foreach($times as $time)

                              <option value="{{ $time->id }}" @if ($soccer->time_id === $time->id) selected @endif>{{ $time->time }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="district_game">Is This A District Game?</label>

                          <select name="district_game" id="district_game" class="form-control">
                              <option value="0" @if ($soccer->district_game == "0") selected @endif>No</option>
                              <option value="1" @if ($soccer->district_game == "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->



                        <h4><strong>Game Score</strong></h4>

                        <div class="form-group">

                          <label for="away_team_first_half_score">{{ $soccer->away_team->school_name }} {{ $soccer->away_team->mascot }} First Half Score</label>

                          <select name="away_team_first_half_score" id="away_team_first_half_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($soccer->away_team_first_half_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_second_half_score">{{ $soccer->away_team->school_name }} {{ $soccer->away_team->mascot }} Second Half Score</label>

                          <select name="away_team_second_half_score" id="away_team_second_half_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($soccer->away_team_second_half_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_overtime_score">{{ $soccer->away_team->school_name }} {{ $soccer->away_team->mascot }} Overtime Score</label>

                          <select name="away_team_overtime_score" id="away_team_overtime_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($soccer->away_team_overtime_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="away_team_final_score">{{ $soccer->away_team->school_name }} {{ $soccer->away_team->mascot }} Final Score</label>

                          <select name="away_team_final_score" id="away_team_final_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 199; $i++) 
                                <option value="{{ $i }}" @if ($soccer->away_team_final_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <hr>

                        <div class="form-group">

                          <label for="away_team_first_half_score">{{ $soccer->home_team->school_name }} {{ $soccer->home_team->mascot }} First Quarter Score</label>

                          <select name="home_team_first_half_score" id="home_team_first_half_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($soccer->home_team_first_half_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_second_half_score">{{ $soccer->home_team->school_name }} {{ $soccer->home_team->mascot }} Second Quarter Score</label>

                          <select name="home_team_second_half_score" id="home_team_second_half_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($soccer->home_team_second_half_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="home_team_overtime_score">{{ $soccer->home_team->school_name }} {{ $soccer->home_team->mascot }} Overtime Score</label>

                          <select name="home_team_overtime_score" id="home_team_overtime_score" class="form-control">
                              <option value="">Enter Score</option>
                              @for ($i = 0; $i < 99; $i++) 
                                <option value="{{ $i }}" @if ($soccer->home_team_overtime_score == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->

                       

                        

                        <div class="form-group">
                          <label for="home_team_final_score">
                              {{ $soccer->home_team->school_name }} {{ $soccer->home_team->mascot }} Final Score
                            </label>
                          <div class="input-group">
                            <div class="input-group-btn">
                              <button type="button" id="SubtractButton" class="btn btn-danger">-</button>
                            </div>
                            <input type="text" class="form-control" 
                                   id="home_team_final_score" 
                                   name="home_team_final_score" 
                                   value="{{ $soccer->home_team_final_score }}" min="0">
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

                            <option value="" @if ($soccer->game_status == "") selected @endif>Select A Status</option>
                            <option value="0" @if ($soccer->game_status == "0") selected @endif>Game Has Not Started Yet</option>
                            <option value="1" @if ($soccer->game_status == "1") selected @endif>1st Half</option>
                            <option value="2" @if ($soccer->game_status == "2") selected @endif>Halftime</option>
                            <option value="3" @if ($soccer->game_status == "3") selected @endif>2nd Half</option>
                            <option value="4" @if ($soccer->game_status == "4") selected @endif>Overtime</option>
                            <option value="5" @if ($soccer->game_status == "5") selected @endif>Final</option>

                          </select>

                        </div><!--  Form  Group  -->





                        <div class="form-group">

                          <label for="minutes_remaining">What Minute Is The Game In?</label>

                          <select name="minutes_remaining" id="minutes_remaining" class="form-control">
                              <option value="">Enter A Minute</option>
                              @for ($i = 0; $i < 150; $i++) 
                                <option value="{{ $i }}" @if ($soccer->minutes_remaining == "$i") selected @endif>{{ $i }}</option>
                              @endfor
                          </select>

                        </div><!--  Form  Group  -->





                        <hr>





                        <div class="form-group">

                          <label for="winning_team">Winning Team</label>

                          <select name="winning_team" id="winning_team" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $soccer->away_team->id }}" @if ($soccer->winning_team === $soccer->away_team_id) selected @endif>
                              {{ $soccer->away_team->school_name }}
                            </option>
                            <option value="{{ $soccer->home_team->id }}" @if ($soccer->winning_team === $soccer->home_team_id) selected @endif>
                              {{ $soccer->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="losing_team">Losing Team</label>

                          <select name="losing_team" id="losing_team" class="form-control">

                            <option value="">Select A Team</option>

                            <option value="{{ $soccer->away_team->id }}" @if ($soccer->losing_team === $soccer->away_team_id) selected @endif>
                              {{ $soccer->away_team->school_name }}
                            </option>
                            <option value="{{ $soccer->home_team->id }}" @if ($soccer->losing_team === $soccer->home_team_id) selected @endif>
                              {{ $soccer->home_team->school_name }}
                            </option>

                          </select>

                        </div><!--  Form  Group  -->



                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Update Match</button>
                        </div>
                    
                    </form>

                    <form method="POST" action="/soccer-boys/{{ $soccer->id }}">

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
