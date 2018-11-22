@extends('layouts.app')
@extends('layouts.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.1/js/select2.full.min.js"></script>
	<meta charset="UTF-8">
	<title></title>
</head>
<body><br>

	<div class="container">
		<div class="col-md-12">
			<div class="panel-body">
				<form action="{{action('EventController@sendemail',$id)}}" method="POST">
					{{ csrf_field() }}
					<div>
						<h4>Send Event</h4>
						<hr>
						<input type="hidden" name="_method" value="UPDATE"/>
					</div>

					<div class="form-group">
						<label>Event Name:</label>&nbsp;&nbsp;&nbsp;&nbsp;<span>{{$events->title}}</span>
					</div>
					
					<div class="form-group">
						<label>Event Color:</label>&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding: 10px 20px 10px 20px; background-color:{{$events->color}}; border-radius: 9999px;"></span>
					</div>

					<div class="form-group">
						<label>Start Date:</label>&nbsp;&nbsp;&nbsp;&nbsp;<span>{{$events->start_date}}</span>
					</div>

					<div class="form-group">
						<label>End Date:</label>&nbsp;&nbsp;&nbsp;&nbsp;<span>{{$events->end_date}}</span>
					</div>

					<!-- <div class="form-group">
						<label>Send To: </label>&nbsp;&nbsp;&nbsp;&nbsp;<span><input type="email" placeholder="mail@domain.com" name="email" class="form-control"></input></span>
					</div> -->

					<div class="form-group">
						<label>Send To: </label>
						{!! Form::select('receiver_id[]', $items, null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Select email/s']) !!}
					</div>	

<!-- 					<div class="form-group">
						<label>Multiple</label>
						<select class="form-control select2" multiple="multiple" data-placeholder="Select a State"
						style="width: 100%; name="message-from-select[]"">
	
						<option>Alabama</option>
						<option>Alaska</option>
						<option>California</option>
						<option>Delaware</option>
						<option>Tennessee</option>
						<option>Texas</option>
						<option>Washington</option>
						</select>
					</div> -->

					{{ method_field('PUT') }}

					<button style="display:inline;float:right;" type="submit" class="btn btn-primary fa fa-envelope-o"><span style="font-family: 'Lato', sans-serif;"/>&nbsp;&nbsp;&nbsp;
						Send
					</a>
				</form>
				<button style="display:inline;float:left;" onclick="location.href='/events'" class="btn btn-primary fa fa-arrow-left" ><span style="font-family: 'Lato', sans-serif;"/>&nbsp;&nbsp;&nbsp;Back</button>
				<br><br>
			</div>
		</div>
	</div>

	<script>
	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2()
	})
	</script>

</body>
</html>
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection