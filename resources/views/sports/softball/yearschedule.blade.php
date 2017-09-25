@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="row">

                <div class="col-lg-5">

                    <div class="form-group">

                        <select name="home_team_id" id="home_team_id" class="form-control" onChange="window.location.href=this.value">

                            <option value="null">See A Specific Team's Schedule</option>

                            @foreach($teams as $team)
                                
                                <option value="/softball/{{ $year }}/{{ $team->school_name }}" >
                                    {{ $team->school_name }}
                                </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  -->

                </div>

                <div class="col-lg-5">

                    <div class="form-group">

                        <select name="home_team_id"class="form-control" onChange="window.location.href=this.value">

                            <option value="null">See A Specific Year Schedule</option>

                            @foreach($years as $year)

                                <option value="/softball/{{ $year->year }}"  @if ($selectedyearid[0] === $year->id) selected @endif>
                                    {{ $year->year }}
                                </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  --> 

                </div><!--  Col  -->

                <div class="col-lg-2">

                    <p><a class="pull-right btn btn-success" href="/softball/create">Create Game</a></p>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading"><strong>{{  $selectedyear[0] }} Softball Schedule</strong></div>
                    <ul class="list-group">
                        @forelse ($softball as $item)

                            <li class="list-group-item">

                                    {{ $item->id }}

                                {{ Carbon\Carbon::parse($item->date)->format('l') }} {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}<br />
                                <a href="/softball/{{ $selectedyear[0] }}/{{ $item->away_team->school_name }}">
                                    {{ $item->away_team->school_name }}
                                </a>
                                vs 
                                <a href="/softball/{{ $selectedyear[0] }}/{{ $item->home_team->school_name }}">
                                    {{ $item->home_team->school_name }}
                                </a>
                                @if (Auth::user())
                                    <span class="pull-right"><a href="/softball/game/{{ $item->id }}/edit">Edit</a></span>&nbsp;&nbsp;&nbsp;
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
