@extends('layouts.app2')
@extends('layouts.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CSD Event Calendar</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<br>
	<div class="container">
		<div class="col-md-12">
			<div class="panel-body">
				<h4>Add Event</h4>
				<form method="POST" action="{{action('EventController@store')}}">
					{{ csrf_field() }}

					<label for="">Enter Name of Event</label>
					<input type="text" class="form-control" name="title" placeholder="Enter the Name"/><br/>

					<label for="">Enter Color</label>
					<input type="color" class="form-control" name="color" placeholder="Enter the color"/><br/>

					<label for="">Enter Start Date of Event</label>
					<input type="datetime-local" class="form-control" name="start_date" class="date" placeholder="Enter Start Date"/><br>
		
					<label for="">Enter End Date of Event</label>
					<input type="datetime-local" class="form-control" name="end_date" class="date" placeholder="Enter End Date"/><br/>

					<label for="">Enter Event Description</label>
					<input type="text" class="form-control" name="description" class="date" placeholder="Enter Event Description"/><br/>
					
					<label for="">Enter Additional Information</label>
					<input type="text" class="form-control" name="comment" class="date" placeholder="Enter Additional Information"/><br/>
	
					<!-- can select user in dropdown with add button next to it -->
					<label for="">Enter Number of Participants</label>
					<input type="number" class="form-control" name="participants" class="date" placeholder="Enter Number of Participants"/><br/>
				
					<button style="display:inline;float:right;" class="btn btn-success fa fa-check" type="submit" name="submit"><span style="font-family: 'Lato', sans-serif;"/>&nbsp;&nbsp;&nbsp;
					Add Event
				</form>
				<button style="display:inline;float:left;" onclick="location.href='/events'" class="btn btn-primary fa fa-arrow-left" ><span style="font-family: 'Lato', sans-serif;"/>&nbsp;&nbsp;&nbsp;Back</button>
				<br><br>
			</div>
		</div>
	</div>
</body>

<footer style="padding-top:24px; font-family: 'Lato', sans-serif;">
    @include('layouts.footer')
</footer>

</html>
@endsection