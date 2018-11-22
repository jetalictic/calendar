@extends('layouts.app')
@extends('layouts.layout')
@section('content')
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title></title>
</head>
<body><br>
	<div class="container">
		<div class="container">
		<form action="{{action('EventController@update',$id)}}" method="POST">
			{{ csrf_field() }}

			
				<div>
					<h4>Update Data</h4>
					<hr>
					<input type="hidden" name="_method" value="UPDATE"/>
				</div>

				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="title" placeholder="Enter Name" value="{{$events->title}}">
				</div>
				
				<div class="form-group">
					<label>Event Color</label>
					<input type="color" class="form-control" name="color" placeholder="Enter Color" value="{{$events->color}}">
				</div>

				<div class="form-group">
					<label>Start Date</label>
					<input type="datetime-local" class="form-control" name="start_date" placeholder="Enter Start Date" value="{{$events->start_date}}">
				</div>

				<div class="form-group">
					<label>End Date</label>
					<input type="datetime-local" class="form-control" name="end_date" placeholder="Enter End Date" value="{{$events->end_date}}">
				</div>

				<div class="form-group">
					<label>Event Description</label>
					<input type="text" class="form-control" name="description" class="date" placeholder="Enter Event Description" value="{{$events->description}}"/>
				</div>
				
				<div class="form-group">
					<label>Additional Information</label>
					<input type="text" class="form-control" name="comment" class="date" placeholder="Enter Additional Information" value="{{$events->comment}}"/>
				</div>
				
				<div class="form-group">
					<label>Number of Participants</label>
					<input type="number" class="form-control" name="participants" class="date" placeholder="Enter Number of Participants" value="{{$events->participants}}"/>
				</div>

				{{ method_field('PUT') }}

				<button style="display:inline;float:right;" class="btn btn-success fa fa-check" type="submit" name="submit"><span style="font-family: 'Lato', sans-serif;"/>&nbsp;&nbsp;&nbsp;
				Update Data	
		</form>
		<button style="display:inline;float:left;" onclick="location.href='/events'" class="btn btn-primary fa fa-arrow-left" ><span style="font-family: 'Lato', sans-serif;"/>&nbsp;&nbsp;&nbsp;Back</button>
				<br><br>
		</div>	

	</div>
</body>
</html>
@endsection