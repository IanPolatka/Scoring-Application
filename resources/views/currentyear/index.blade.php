@extends('layouts.app')

@section('content')

@if (Session::has('success'))

    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-lg-offset-2">

                <div class="alert alert-success" role="alert">

                    <strong>Success:</strong> {{ Session::get('success') }}

                </div><!--  end alert -->

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  container  -->

@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Current School Year</div>
                <ul class="list-group">
               	    <li class="list-group-item">{{ $showyear->year }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
