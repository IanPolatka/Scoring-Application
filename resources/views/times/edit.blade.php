@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Game Time</div>

                <div class="panel-body">

                    <form method="POST" action="/times/{{ $time->id }}">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}    
                     
                      <div class="form-group">
                        <label for="time">Year</label>
                        <input type="text" class="form-control" id="time" name="time" value="{{ $time->time }}">
                      </div>

                        <button type="submit" class="btn btn-primary pull-left">Update Game Time</button>


                    
                    </form>


                    <form method="POST" action="/times/{{ $time->id }}">

                      {{ method_field('DELETE') }}

                      {{ csrf_field() }}    

                        <button type="submit" class="btn btn-danger pull-left">Delete Game Time</button>
                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
