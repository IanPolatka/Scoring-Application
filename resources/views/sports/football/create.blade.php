@extends('layouts.app')

@section('content')

<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <a href="/football">Football</a> &#187; Create Game

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  Container  -->

</div>


<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

              <div class="content-box">

                    <h4>Create Football Game</h4>

                    <form method="POST" action="/football">

                      {{ csrf_field() }}

                      <div class="section-title">
                          School Year & Team Level
                      </div><!--  Section Title  -->

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                            <label for="year_id">School Year</label>

                            <select name="year_id" id="year_id" class="form-control">

                              <option value="">Select A School Year</option>

                              <option value="{{ $thecurrentyear[0] }}">{{ $displayyear->year }} (the current school year)</option>

                              <option value="">---------------------</option>

                              @foreach($years as $year)

                                <option value="{{ $year->id }}" >
                                    {{ $year->year }}
                                </option>

                              @endforeach

                            </select>

                          </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">
                            <label for="team_level">Team Level</label>
                            <select name="team_level" id="team_level" class="form-control">
                                <option value="1">Varsity</option>
                                <option value="2">Junior Varsity</option>
                                <option value="3">Freshman</option>
                            </select>
                          </div>

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Date & Time
                      </div><!--  Section Title  -->

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" class="form-control" id="datepicker" name="date">
                          </div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                            <label for="time_id">What Time Is The Match?</label>

                            <select name="time_id" id="time_id" class="form-control">

                              @foreach($times as $time)

                                <option value="{{ $time->id }}" > {{ $time->time }}</option>

                              @endforeach

                            </select>

                          </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Tournament Title
                      </div><!--  Section Title  -->

                      <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                          <div class="form-group">
                            <label for="tournament_title">Tournament Title</label>
                            <input type="text" class="form-control" id="tournament_title" name="tournament_title">
                          </div>

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        Teams
                      </div><!--  Section Title  -->

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                            <label for="away_team_id">Away Team</label>

                            <select name="away_team_id" id="away_team_id" class="form-control">

                              <option value="null">Please Select An Away School</option>

                              @foreach($teams as $team)

                                <option value="{{ $team['id'] }}" > {{ $team['school_name'] }}</option>

                              @endforeach

                            </select>

                          </div><!--  Form  Group  -->

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                            <label for="home_team_id">Home Team</label>

                            <select name="home_team_id" id="home_team_id" class="form-control">

                              <option value="null">Please Select An Home School</option>

                              @foreach($teams as $team)

                                <option value="{{ $team['id'] }}" > {{ $team['school_name'] }}</option>

                              @endforeach

                            </select>

                          </div><!--  Form  Group  --> 

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <div class="section-title">
                        District Game & Scrimmage
                      </div><!--  Section Title  --> 
                     
                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                            <label for="scrimmage">Is This A Scrimmage?</label>

                            <select name="scrimmage" id="scrimmage" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>

                          </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                          <div class="form-group">

                            <label for="district_game">Is This A District Game?</label>

                            <select name="district_game" id="district_game" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>

                          </div><!--  Form  Group  -->

                        </div><!--  Col  -->

                      </div><!--  Row  -->

                      <hr>

                      <div class="row">

                        <div class="col-lg-12">

                          <div class="form-group">
                            <button type="submit" class="button button-default btn-block">Create Football Game</button>
                          </div>

                        </div><!--  Col  -->

                      </div><!--  Row  -->
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
