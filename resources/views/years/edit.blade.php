@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Year</div>

                <div class="panel-body">

                    <form method="POST" action="/years/{{ $year->id }}">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}    
                     
                      <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" id="year" name="year" value="{{ $year->year }}">
                      </div>

                        <button type="submit" class="btn btn-primary pull-left">Update Year</button>


                    
                    </form>


                    <form method="POST" action="/years/{{ $year->id }}">

                      {{ method_field('DELETE') }}

                      {{ csrf_field() }}    

                        <button type="submit" class="btn btn-danger pull-left">Delete Year</button>
                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
