@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create</div>

                <div class="panel-body">
                    <form method="POST" action="/disabled-veterans">

                      {{ csrf_field() }}
                     
                      <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                      </div>
                     
                      <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name">
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create Veteran</button>
                      </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
