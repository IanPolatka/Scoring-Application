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
                                
                                <option value="/baseball/{{ $year }}/{{ $team->school_name }}" @if ($selectedteamid[0] === $team->id) selected @endif>
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

                                <option value="/baseball/{{ $year->year }}" @if ($selectedyearid[0] === $year->id) selected @endif>
                                    {{ $year->year }}
                                </option>

                            @endforeach

                        </select>

                    </div><!--  Form  Group  --> 

                </div><!--  Col  -->

                <div class="col-lg-2">

                    <p><a class="pull-right btn btn-success" href="/baseball/create">Create Game</a></p>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

        <div class="col-md-5 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading"><strong>baseball Schedule</strong></div>
                    <ul class="list-group">
                        @forelse ($baseball as $item)

                            <li class="list-group-item">
                                {{ Carbon\Carbon::parse($item->date)->format('l') }} {{ Carbon\Carbon::parse($item->date)->format('M j, o') }}<br />
                                @if ($selectedteam[0]['id'] == $item['away_team_id'])
                                    @if ($item->home_team->logo)
                                        <img src="/images/team-logos/{{ $item->home_team->logo }}" style="height: 20px; width: 20px; border-radius: 3px;margin-right: 5px;">
                                    @endif
                                    @ <a href="/baseball/{{ $selectedyear[0] }}/{{ $item->home_team->school_name }}">
                                        {{ $item->home_team->school_name }}
                                    </a>
                                @else
                                    @if ($item->away_team->logo)
                                        <img src="/images/team-logos/{{ $item->away_team->logo }}" style="height: 20px; width: 20px; border-radius: 3px;margin-right: 5px;">
                                    @endif
                                    vs <a href="/baseball/{{ $selectedyear[0] }}/{{ $item->away_team->school_name }}">
                                        {{ $item->away_team->school_name }}
                                    </a>
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

        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><strong>Standings</strong></div>
                    <ul class="list-group">
                        @forelse ($standings as $item)

                            <li class="list-group-item">{{ $item->school_name }}</li> 

                        @empty

                            <li class="list-group-item">No Districts Opponents Listed</li>

                        @endforelse
                    </ul>
            </div>

        </div>

    </div>
</div>
@endsection
