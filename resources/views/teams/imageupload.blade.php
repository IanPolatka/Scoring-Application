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

			<form action="/teams/{{ $team->id }}/image-upload" enctype="multipart/form-data" method="POST">

				<div class="team-profile">

                 <h4>{{ $team->school_name }} {{  $team->mascot}} Logo<small><a href="/teams/create">{{ $team->school_logo }}</a></small></h4>

                <div class="section-title">
                      Logo Upload
                </div>
			
				{{ csrf_field() }}


                    			@if ($team->logo)
                    				<img src="/images/team-logos/{{ $team->logo }}" style="max-width: 100px; margin-bottom: 20px;">
                    			@endif

								<input type="file" name="image" />

				</div><!--  Team Profile  -->

				<button type="submit" class="button button-default">Upload</button>

			</form>

    	</div>
   	</div>
</div>

@endsection