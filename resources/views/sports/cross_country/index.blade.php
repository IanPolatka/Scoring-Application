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

                              <option value="/cross-country/{{$showcurrentyear[0]}}/{{ $team->school_name }}">{{ $team->school_name }}</option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  -->

                </div>

                <div @if (Auth::user()) class="col-lg-5" @else class="col-lg-6" @endif>

                    <div class="form-group">

                        <select name="home_team_id"class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Year Schedule</option>

                            @foreach($years as $year)

                              <option value="/cross-country/{{ $year->year }}" @if ($showcurrentyear[0] == $year->year) selected @endif>
                                {{ $year->year }}
                              </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  --> 

                </div><!--  Col  -->

                @if (Auth::user())

                    <div class="col-lg-2">

                        <p><a class="pull-right btn btn-success" href="/cross-country/create">Create Event</a></p>

                        <div class="clearfix"></div>

                    </div>

                @endif

            </div>
    
            <div class="panel panel-default">
                <div class="panel-heading">{{ $showcurrentyear[0] }} Cross Country Schedule</div>
                    <ul class="list-group">
                        @foreach($crosscountry as $item)

                            <li class="list-group-item">
                                {{ Carbon\Carbon::parse($item->date)->format('l') }} {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}<br />
                                @if ( $item->team->logo )
                                    <img style="height: 25px; width: auto; margin-right: 5px;" src="/images/team-logos/{{ $item->team->logo }}">
                                @endif
                                {{ $item->team->school_name }}
                                @if ( $item->host->logo )
                                    <img style="height: 25px; width: auto; margin-right: 5px;" src="/images/team-logos/{{ $item->host->logo }}">
                                @endif
                                @if ($item->host->school_name)
                                    - {{ $item->host->school_name }}
                                @endif
                                @if ($item->tournament_title)
                                    - {{ $item->tournament_title }}
                                @endif
                                @if ($item->result)
                                    | {{ $item->result }}
                                @endif
                                <span class="pull-right"><a href="/cross-country/{{ $item->id }}/edit">Edit</a></span>&nbsp;&nbsp;&nbsp;
                            </li>

                        @endforeach
                    </ul>
            </div>

        </div>
    </div>
</div>
@endsection
