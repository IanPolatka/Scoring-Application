@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Year</div>

                <div class="panel-body">

                    <form method="POST" action="/current-year/">

                      {{ method_field('PATCH') }}

                      {{ csrf_field() }}

                      <p>Select The Current Year</p>

                      <div class="form-group">

                        <select name="year_id" id="year_id" class="form-control">

                          @foreach($years as $year)

                            <option value="{{ $year->id }}" 
                              @if ($currentyear->year_id === $year->id) selected @endif>
                                {{ $year->year }}
                            </option>

                          @endforeach

                        </select>

                      </div><!--  Form  Group  -->   

                      <button type="submit" class="btn btn-primary pull-left">Update Year</button>
                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
