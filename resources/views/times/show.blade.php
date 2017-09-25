@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">See Game Time</div>
                <ul class="list-group">
	      	    	<li class="list-group-item">

	      	    		  {{ $time->time }} <span class="pull-right"><a href="/times/{{ $time->id }}/edit">edit</a></span>

	      	    	</li>
	      	    </ul>
            </div>
        </div>
    </div>
</div>
@endsection
