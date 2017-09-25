@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Game Times</div>

                <div class="panel-body">

                    <form method="POST" action="/times">

                      {{ csrf_field() }}    
                     
                      <div class="form-group">
                        <label for="time">Time</label>
                        <input type="text" class="form-control" id="time" name="time">
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create Game Time</button>
                      </div>


                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
