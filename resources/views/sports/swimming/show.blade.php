@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">The Compiled List</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            {{ Carbon\Carbon::parse($swimming->date)->format('l') }} {{ Carbon\Carbon::parse($swimming->date)->format('M j, o') }}<br />
                            <a href="/swimming/{{ $swimming->id }}">
                                {{ $swimming->away_team->school_name }}
                            </a>
                            vs 
                            <a href="">
                                {{ $swimming->home_team->school_name }}
                            </a>
                            <span class="pull-right"><a href="/swimming/{{ $swimming->id }}/edit">Edit</a></span>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
</div>
@endsection
