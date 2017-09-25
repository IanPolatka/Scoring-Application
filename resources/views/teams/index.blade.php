@extends('layouts.app')

@section('content')

<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                Teams

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  Container  -->

</div><!--  secondary menu -->


<div class="container">
    <div class="row">
        <div class="col-lg-12">

                <div class="team-profile">

                <h4>All Teams <small><a href="/teams/create">create team</a></small></h4>

                <div class="row">

                    <ul class="list-teams">
                        @foreach ($teams as $team)

                            <div class="col-lg-3 col-md-4">
                                <a href="/teams/{{ $team->id }}">
                                    <li>
                                        <div class="img-box">
                                        @if ( $team->logo )
                                            <img src="/images/team-logos/{{ $team->logo }}">
                                        @endif
                                        </div><!--  Image Box  -->
                                        <h4><strong>{{ $team->school_name }}</strong></h4>
                                        <p>{{ $team->mascot }}</p>
                                    </li>
                                </a>
                            </div>

                        @endforeach
                    </ul>

                </div>

                </div>

            {{ $teams->links() }}

        </div>

    </div>
</div>
@endsection
