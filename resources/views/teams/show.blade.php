@extends('layouts.app')

@section('content')

<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <a href="/teams">Teams</a> &#187; {{ $team->school_name }}

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  Container  -->

</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <h4>{{ $team->school_name }}</h4>

            <div class="team-profile">


                 <strong><h4>School Information</h4></strong>

                 <hr>

                <a href="/teams/{{$team->id}}/image-upload">
                    <div class="image-box">
                        @if ($team->logo)
                            <img src="/images/team-logos/{{ $team->logo }}">
                        @endif
                        <div class="team-logo-upload"></div>
                    </div><!--  Image Box  -->
                </a>
                <h6>Team Name</h6>
                <p>{{ $team->school_name }} 
                @if ($team->abbreviated_name)
                    <small class="text-muted">({{ $team->abbreviated_name }})</small>
                @endif
                </p>
                
                <h6>School Location</h6>
                <p>{{ $team->city }}, {{ $team->state }}</p>

                <h6>Mascot</h6>
                <p>{{ $team->mascot }}</p>

                <div class="section-title">
                    Baseball Information
                </div>

                <div class="row">

                    <div class="col-xs-6">

                        <h6>Region</h6>
                        <p>
                            @if ($team->region_baseball)
                                {{ $team->region_baseball }}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                    <div class="col-xs-6">

                        <h6>District</h6>
                        <p>
                            @if ($team->district_baseball)
                                {{ $team->district_baseball }}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                </div><!--  Row  -->

                <div class="section-title">
                    Basketball Information
                </div>

                <div class="row">

                    <div class="col-xs-6">

                        <h6>Region</h6>
                        <p>
                            @if ($team->region_basketball)
                                {{ $team->region_basketball }}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                    <div class="col-xs-6">

                        <h6>District</h6>
                        <p>
                            @if ($team->district_basketball)
                                {{ $team->district_basketball }}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                </div><!--  Row  -->

                <div class="section-title">
                    Football Information
                </div>

                <div class="row">

                    <div class="col-xs-6">

                        <h6>KHSAA Class</h6>
                        <p>
                            @if ($team->class_football)
                                {{ $team->class_football }}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                    <div class="col-xs-6">

                        <h6>District</h6>
                        <p>
                            @if ($team->district_football)
                                {{ $team->district_football}}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                </div><!--  Row  -->

                <div class="section-title">
                    Soccer Information
                </div>

                <div class="row">

                    <div class="col-xs-6">

                        <h6>Region</h6>
                        <p>
                            @if ($team->region_soccer)
                                {{ $team->region_soccer }}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                    <div class="col-xs-6">

                        <h6>District</h6>
                        <p>
                            @if ($team->district_soccer)
                                {{ $team->district_soccer }}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                </div><!--  Row  -->

                <div class="section-title">
                    Softball Information
                </div>

                <div class="row">

                    <div class="col-xs-6">

                        <h6>Region</h6>
                        <p>
                            @if ($team->region_softball)
                                {{ $team->region_softball }}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                    <div class="col-xs-6">

                        <h6>District</h6>
                        <p>
                            @if ($team->district_softball)
                                {{ $team->district_softball }}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                </div><!--  Row  -->

                <div class="section-title">
                    Volleyball Information
                </div>

                <div class="row">

                    <div class="col-xs-6">

                        <h6>Region</h6>
                        <p>
                            @if ($team->region_volleyball)
                                {{ $team->region_volleyball }}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                    <div class="col-xs-6">

                        <h6>District</h6>
                        <p>
                            @if ($team->district_volleyball)
                                {{ $team->district_volleyball }}
                            @else
                                -
                            @endif
                        </p>

                    </div><!--  Col  -->

                </div><!--  Row  -->

            </div>

            <div class="row">

                <div class="col-xs-6">

                    <a class="button button-default" href="/teams/{{ $team->id }}/edit">Edit</a>

                </div>

                <div class="col-xs-6">

                    <form method="POST" action="/teams/{{ $team->id }}">

                          {{ method_field('DELETE') }}

                          {{ csrf_field() }}    

                          <div class="form-group">
                            <button type="submit" class="button button-danger" onclick="return confirm('Are you sure you want to delete {{ $team->school_name }}')">Delete</button>
                          </div>
                    
                        </form>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
