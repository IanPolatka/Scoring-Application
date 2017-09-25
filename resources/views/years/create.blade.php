@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Years</div>

                <div class="panel-body">

                    <form method="POST" action="/years">

                      {{ csrf_field() }}    
                     
                      <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" id="year" name="year">
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create Years</button>
                      </div>


                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
