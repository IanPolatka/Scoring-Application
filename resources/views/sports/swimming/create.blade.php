@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create</div>

                <div class="panel-body">
                    <form method="POST" action="/swimming">

                      {{ csrf_field() }}

                        <div class="form-group">

                          <label for="team_id">Team This Event Is For</label>

                          <select name="team_id" id="team_id" class="form-control">

                            <option value="null">Please Select An Away School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" > {{ $team['school_name'] }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group -->

                        <div class="form-group">

                          <label for="year_id">What Year Is This Match For?</label>

                          <select name="year_id" id="year_id" class="form-control">

                            <option value="">Select A School Year</option>

                            <option value="{{ $thecurrentyear['id'] }}">{{ $thecurrentyear['year'] }}</option>

                            <option value="">---------------------</option>

                            @foreach($years as $year)

                              <option value="{{ $year->id }}" >
                                  {{ $year->year }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="team_level">What Team Level Is This For?</label>
                          <select name="team_level" id="team_level" class="form-control">
                              <option value="1">Varsity</option>
                              <option value="2">Junior Varsity</option>
                              <option value="3">Freshman</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="date">Date</label>
                          <input type="text" class="form-control" id="datepicker" name="date">
                        </div>

                        <div class="form-group">

                          <label for="scrimmage">Is This A Scrimmage?</label>

                          <select name="scrimmage" id="scrimmage" class="form-control">
                              <option value="0">No</option>
                              <option value="1">Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="tournament_title">Tournament Title</label>
                          <input type="text" class="form-control" id="tournament_title" name="tournament_title">
                        </div>

                        <div class="form-group">

                          <label for="host_id">Who Is Hosting This Event?</label>

                          <select name="host_id" id="host_id" class="form-control">

                            <option value="null">Please Select A School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" > {{ $team['school_name'] }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group -->
                     
                        <div class="form-group">

                          <label for="time_id">What Time Is The Match?</label>

                          <select name="time_id" id="time_id" class="form-control">

                            @foreach($times as $time)

                              <option value="{{ $time->id }}" > {{ $time->time }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="boys_result">Boys Result</label>

                          <input type="text" class="form-control" id="boys_result" name="boys_result">

                        </div><!--  Form  Group  -->

                        <div class="form-group">

                          <label for="girls_result">Girls Result</label>

                          <input type="text" class="form-control" id="girls_result" name="girls_result">

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Create Swimming Event</button>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
