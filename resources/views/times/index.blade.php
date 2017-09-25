@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Game Times</div>
                <ul class="list-group">
	                @foreach($times as $time)

	                	 <li class="list-group-item"><a href="/times/{{ $time->id }}">{{ $time->time }}</a></li>

	                @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
