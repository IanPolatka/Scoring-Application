@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Game ID: {{ $soccer['id'] }}</div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            @if ($soccer->away_team->logo)
                                <img src="/images/team-logos/{{ $soccer->away_team->logo }}" style="height: 20px; width: 20px; border-radius: 3px;margin-right: 5px;">
                            @endif
                            {{ $soccer->away_team->school_name }}
                            <span class="pull-right">
                                @if ($soccer->game_status > 0)
                                  @if (isset($soccer->away_team_final_score))
                                    {{ $soccer->away_team_final_score }}
                                  @else
                                    {{ $away_team_score_computed }}
                                  @endif
                                @else
                                  -
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item">
                            @if ($soccer->home_team->logo)
                                <img src="/images/team-logos/{{ $soccer->home_team->logo }}" style="height: 20px; width: 20px; border-radius: 3px;margin-right: 5px;">
                            @endif
                            {{ $soccer->home_team->school_name }}
                            <span class="pull-right">
                                @if ($soccer->game_status > 0)
                                  @if (isset($soccer->home_team_final_score))
                                    {{ $soccer->home_team_final_score }}
                                  @else
                                    {{ $home_team_score_computed }}
                                  @endif
                                @else
                                  -
                                @endif
                            </span>
                        </li>
                    </ul>
            </div>

            @if (Auth::user())

                <div class="row">

                    <div class="col-lg-12">

                        <a class="button button-default" href="/soccer-boys/match/{{ $soccer->id }}/edit">Edit</a>

                    </div><!--  Col  -->

                </div><!--  Row  -->

            @endif

        </div>
    </div>
</div>
@endsection
