@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Years</div>
                <ul class="list-group">
	                @foreach($years as $year)

	                	 <li class="list-group-item"><a href="/years/{{ $year->id }}">{{ $year->year }}</a></li>

	                @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
