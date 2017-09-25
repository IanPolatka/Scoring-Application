@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                
         	@if ($message = Session::get('success'))

				<div class="alert alert-success alert-block">
	
					<button type="button" class="close" data-dismiss="alert">×</button>
				        <strong>{{ $message }}</strong>
				</div>
				
			@endif

			<form action="/teams/{{ $team->id }}/image-upload" enctype="multipart/form-data" method="POST">
			
				{{ csrf_field() }}

				<div class="panel panel-default">

					<div class="panel-heading">Create</div>

						<ul class="list-group">

                    		<li class="list-group-item">

                    			@if ($team->logo)
                    				<img src="/images/team-logos/{{ $team->logo }}" style="max-width: 100px; margin-bottom: 20px;">
                    			@endif

								<input type="file" name="image" />

							</li>

							<li class="list-group-item">

								<button type="submit" class="btn btn-success">Upload</button>

							</li>

						</ul>

					</div>

				</div>

			</form>

    	</div>
   	</div>
</div>

@endsection