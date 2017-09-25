@extends('layouts.app')

@section('content')

@if (Session::has('success'))

    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-lg-offset-2">

                <div class="alert alert-success" role="alert">

                    <strong>Success:</strong> {{ Session::get('success') }}

                </div><!--  end alert -->

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  container  -->

@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="row">

                <div @if (Auth::user()) class="col-lg-5" @else class="col-lg-6" @endif>

                    <div class="form-group">

                        <select name="home_team_id" id="home_team_id" class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Team's Schedule</option>

                            @foreach($teams as $team)

                              <option value="/baseball/{{$showcurrentyear[0]}}/{{ $team->school_name }}">{{ $team->school_name }}</option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  -->

                </div>

                <div @if (Auth::user()) class="col-lg-5" @else class="col-lg-6" @endif>

                    <div class="form-group">

                        <select name="home_team_id"class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Year Schedule</option>

                            @foreach($years as $year)

                              <option value="/baseball/{{ $year->year }}" @if ($showcurrentyear[0] == $year->year) selected @endif>
                                {{ $year->year }}
                              </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  --> 

                </div><!--  Col  -->

                @if (Auth::user())

                    <div class="col-lg-2">

                        <p><a class="pull-right btn btn-success" href="/baseball/create">Create Game</a></p>

                        <div class="clearfix"></div>

                    </div>

                @endif

            </div>
    
            <div class="panel panel-default">
                <div class="panel-heading">baseball Schedule</div>
                    <ul class="list-group">
                        @forelse ($baseball as $item)

                            <li class="list-group-item">
                                {{ Carbon\Carbon::parse($item->date)->format('l') }} {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}<br />
                                @if ( $item->away_team->logo )
                                    <img src="/images/team-logos/{{ $item->away_team->logo }}" style="height: 20px; width: 20px; border-radius: 3px;margin-right: 5px;">
                                @endif
                                <a href="/baseball/{{ $showcurrentyear[0] }}/{{ $item->away_team->school_name }}">{{ $item->away_team->school_name }}</a> vs
                                @if ( $item->home_team->logo )
                                    <img src="/images/team-logos/{{ $item->home_team->logo }}" style="height: 20px; width: 20px; border-radius: 3px;margin: 0px 5px;"> 
                                @endif
                                <a href="/baseball/{{ $showcurrentyear[0] }}/{{ $item->home_team->school_name }}">{{ $item->home_team->school_name }}</a>
                                @if ($item->tournament_title)
                                    <small>({{ $item->tournament_title }})</small>
                                @endif
                                @if ($item->district_game)
                                    <small>**</small>
                                @endif
                                @if (Auth::user())
                                    <span class="pull-right"><a href="/baseball/game/{{ $item->id }}/edit">Edit</a></span>&nbsp;&nbsp;&nbsp;
                                @endif
                            </li>

                        @empty

                            <li class="list-group-item">No Games Posted</li>

                        @endforelse

                    </ul>
            </div>

        </div>

    </div>
</div>
@endsection
