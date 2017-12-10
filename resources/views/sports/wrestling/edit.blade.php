@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Match</div>

                <div class="panel-body">
                    <form method="POST" action="/wrestling/{{ $wrestling->id }}">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}


                        <div class="form-group">

                          <label for="team_id">Team This Event Is For</label>

                          <select name="team_id" id="team_id" class="form-control">

                            <option value="null">Please Select An Away School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" @if ($wrestling->team_id === $team->id) selected @endif > {{ $team['school_name'] }}</option>

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

                              <option value="{{ $year->id }}" @if ($wrestling->year_id === $year->id) selected @endif >
                                  {{ $year->year }}
                              </option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="team_level">What Team Level Is This For?</label>
                          <select name="team_level" id="team_level" class="form-control">
                              <option value="1" @if ($wrestling->team_level == "1") selected @endif>Varsity</option>
                              <option value="2" @if ($wrestling->team_level == "2") selected @endif>Junior Varsity</option>
                              <option value="3" @if ($wrestling->team_level == "3") selected @endif>Freshman</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="date">Date</label>
                          <input type="text" class="form-control" id="datepicker" name="date" value="{{ $wrestling->date }}">
                        </div>

                        <div class="form-group">

                          <label for="scrimmage">Is This A Scrimmage?</label>

                          <select name="scrimmage" id="scrimmage" class="form-control">
                              <option value="0" @if ($wrestling->scrimmage === "0") selected @endif>No</option>
                              <option value="1" @if ($wrestling->scrimmage === "1") selected @endif>Yes</option>
                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="tournament_title">Tournament Title</label>
                          <input type="text" class="form-control" id="tournament_title" name="tournament_title" value="{{ $wrestling->tournament_title }}">
                        </div> 

                        <div class="form-group">

                          <label for="host_id">Host School</label>

                          <select name="host_id" id="host_id" class="form-control">

                            <option value="null">Select A School</option>

                            @foreach($teams as $team)

                              <option value="{{ $team['id'] }}" @if ($wrestling->host_id === $team->id) selected @endif > {{ $team['school_name'] }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group -->
                     
                        <div class="form-group">

                          <label for="time_id">What Time Is The Match?</label>

                          <select name="time_id" id="time_id" class="form-control">

                            @foreach($times as $time)

                              <option value="{{ $time->id }}" @if ($wrestling->time_id === $time->id) selected @endif>{{ $time->time }}</option>

                            @endforeach

                          </select>

                        </div><!--  Form  Group  -->

                        <div class="form-group">
                          <label for="result">Result</label>
                          <input type="text" class="form-control" id="result" name="result" value="{{ $wrestling->result }}">
                        </div>

                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Update Wrestling Match</button>
                        </div>
                    
                    </form>

                    <form method="POST" action="/wrestling/{{ $wrestling->id }}">

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
