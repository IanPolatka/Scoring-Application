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

                              <option value="/wrestling/{{ $selectedyear[0] }}/{{ $team->school_name }}" 
                                @if ($selectedteam[0]['school_name'] === $team->school_name) selected @endif>
                                {{ $team->school_name }}
                              </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  -->

                </div>

                <div @if (Auth::user()) class="col-lg-5" @else class="col-lg-6" @endif>

                    <div class="form-group">

                        <select name="home_team_id"class="form-control" onChange="window.location.href=this.value">

                            <option value="">See A Specific Year Schedule</option>

                            @foreach($years as $year)

                              <option value="/wrestling/{{ $year->year }}" @if ($selectedyear[0] === $year->year) selected @endif>
                                {{ $year->year }}
                              </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  --> 

                </div><!--  Col  -->

                @if (Auth::user())

                    <div class="col-lg-2">

                        <p><a class="pull-right btn btn-success" href="/wrestling/create">Create Match</a></p>

                        <div class="clearfix"></div>

                    </div>

                @endif

            </div>

            <div class="panel panel-default">
                <div class="panel-heading">{{ $selectedyear[0] }} {{ $selectedteam[0]['school_name'] }} Schedule</div>
                    <ul class="list-group">
                        @forelse($wrestling as $item)

                            <li class="list-group-item">
                                {{ Carbon\Carbon::parse($item->date)->format('l') }} {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}<br />
                                {{ $item->team->school_name }}
                                @if ($item->tournament_title)
                                    - {{ $item->tournament_title }}
                                @endif
                                @if ($item->result)
                                    | {{ $item->result }}
                                @endif
                                <span class="pull-right"><a href="/wrestling/{{ $item->id }}/edit">Edit</a></span>&nbsp;&nbsp;&nbsp;
                            </li>

                        @empty

                            <li class="list-group-item">No Matches Posted</li>

                        @endforelse
                    </ul>
            </div>

        </div>
    </div>
</div>
@endsection
