@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">The Compiled List</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            {{ Carbon\Carbon::parse($crosscountry->date)->format('l') }} {{ Carbon\Carbon::parse($crosscountry->date)->format('M j, o') }}<br />
                            <a href="/cross-country/{{ $crosscountry->id }}">
                                @if ( $item->away_team->logo )
                                    <img style="height: 25px; width: auto; margin-right: 5px;" src="/images/team-logos/{{ $item->away_team->logo }}">
                                @endif
                                {{ $crosscountry->away_team->school_name }}
                            </a>
                            vs 
                            <a href="">
                                @if ( $item->home_team->logo )
                                    <img style="height: 25px; width: auto; margin-right: 5px;" src="/images/team-logos/{{ $item->home_team->logo }}">
                                @endif
                                {{ $crosscountry->home_team->school_name }}
                            </a>
                            <span class="pull-right"><a href="/cross-country/{{ $crosscountry->id }}/edit">Edit</a></span>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
</div>
@endsection
