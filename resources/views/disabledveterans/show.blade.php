@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">The Compiled List</div>
                    <ul class="list-group">
                        <li class="list-group-item" style="display:table;">
                            @if ($team->logo)
                            <img src="/images/team-logos/{{ $team->logo }}" 
                            style="height: 30px; width: 30px; border-radius: 3px; float: left; margin-right: 10px;">
                            @endif
                            <a href="/teams/{{ $team->id }}/edit">{{ $team->school_name }}</a>
                            <a href="/teams/{{ $team->id }}/edit" class="pull-right">{{ $team->mascot }}</a>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
</div>
@endsection
