@extends('layouts.main')
@section('content')
	<div class="container" style="max-height: 670px">
		<h1>Scooters available </h1>
		<h2>From {{ date_format(date_create($pick_up_date),'l d F Y') }} 
		to {{ date_format(date_create($drop_off_date),'l d F Y') }} - ${{$price}}/day</h2>
		<div class="row">
		@if(count($available) >= 1)
			@foreach($available as $scooter)
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="{{ asset('images/'.$scooter->plate.'-'.str_replace(' ','',$scooter->model).'.jpg') }}" alt="{{ 'scooter '.$scooter->model.' of '.$scooter->year }}">
					<div class="caption">
						<h3 style="text-align: center">{{ ucfirst($scooter->model) }}</h3>
						<p style="text-align: center"><a href="{{ url('scooters/'.$scooter->id) }}" class="btn btn-info" role="button">More Information</a></p>

						<form action="{{url('bookings/confirmation')}}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="pick_up_date" value="{{ $pick_up_date }}">
							<input type="hidden" name="drop_off_date" value="{{ $drop_off_date }}">
							<input type="hidden" name="scooter_id" value="{{ $scooter->id }}">
							@if(null !== Auth::user())
							<button type="submit" class="btn btn-success" style="margin-left: 75px;">Rent now</button>
							@else
							<a href="{{ url('/login') }}" class="btn btn-warning" role="button" style="margin-left:65px">Login to rent</a>
							@endif
						</form>
					</div>
				</div>				
			</div>
			@endforeach
		@else
			<h3 style="text-align: center">There is no scooter available for the requested dates</h3>
			<h4 style="text-align: center; margin-top: 50px;margin-bottom: -25px;">Change the dates</h4>
			@include('home.date_picker')
		@endif
		</div>
	</div>
@stop