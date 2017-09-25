@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="row">

                <div @if (Auth::user()) class="col-lg-5" @else class="col-lg-6" @endif>

                    <div class="form-group">

                        <select name="home_team_id" id="home_team_id" class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Team's Schedule</option>

                            @foreach($teams as $team)

                              <option value="/golf-girls/{{$showcurrentyear[0]}}/{{ $team->school_name }}">{{ $team->school_name }}</option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  -->

                </div>

                <div @if (Auth::user()) class="col-lg-5" @else class="col-lg-6" @endif>

                    <div class="form-group">

                        <select name="home_team_id"class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Year Schedule</option>

                            @foreach($years as $year)

                              <option value="/golf-girls/{{ $year->year }}" @if ($showcurrentyear[0] == $year->year) selected @endif>
                                {{ $year->year }}
                              </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  --> 

                </div><!--  Col  -->

                @if (Auth::user())

                    <div class="col-lg-2">

                        <p><a class="pull-right btn btn-success" href="/golf-girls/create">Create Match</a></p>

                        <div class="clearfix"></div>

                    </div>

                @endif

            </div>
    
            <div class="panel panel-default">
                <div class="panel-heading">golf Schedule</div>
                    <ul class="list-group">
                        @foreach($golf as $item)

                            <li class="list-group-item">
                                {{ $item->date }} |
                                <a href="/golf-girls/{{ $showcurrentyear[0] }}/{{ $item->away_team->school_name }}">
                                    
                                    {{ $item->away_team->school_name }}</a> 
                                    
                                <a href="/golf-girls/{{ $showcurrentyear[0] }}/{{ $item->home_team->school_name }}">{{ $item->home_team->school_name }}</a>
                                @if ($item->tournament_title)
                                    <small>({{ $item->tournament_title }})</small>
                                @endif
                                <span class="pull-right"><a href="/golf-girls/{{ $item->id }}/edit">Edit</a></span>&nbsp;&nbsp;&nbsp;
                            </li>

                        @endforeach
                    </ul>
            </div>

        </div>
    </div>
</div>
@endsection
