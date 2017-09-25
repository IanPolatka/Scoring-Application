@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">See Year</div>
                <ul class="list-group">
	      	    	<li class="list-group-item">

	      	    		  {{ $year->year }} <span class="pull-right"><a href="/years/{{ $year->id }}/edit">edit</a></span>

                        </form>
	      	    	</li>
	      	    </ul>
            </div>
        </div>
    </div>
</div>
@endsection
