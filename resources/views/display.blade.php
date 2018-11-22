@extends('layouts.app')
@extends('layouts.layout')
@section('content')
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title></title>
</head>
<body>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4>Events Data</h4>
				<div class="table-responsive">
					<table class="table table-bordred table-striped">
						<thead class="thead">
							<tr class="warning">
								<th>ID</th>
								<th>Title</th>
								<th>Color</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Update</th>
								<th>Delete</th>
								<th>Send Event</th>
							</tr>
						</thead>
						@foreach($events as $event)
							<tbody>
								<tr>
									<td>{{ $event->id }}</td>
									<td>{{ $event->title }}</td>
									<td style="vertical-align: middle;margin-left: auto; margin-right: auto; align: center;"><span style="padding:10px 20px 10px 20px; background-color:{{ $event->color }}; border-radius:99999px;"></span></td>
									<td>{{ $event->start_date }}</td>
									<td>{{ $event->end_date }}</td>

									<th>
										<a href="{{action('EventController@edit',$event['id'])}}" class="btn btn-info fa fa-pencil-square-o" style="color:white;"><span style="font-family: 'Lato', sans-serif;color:white;"/>&nbsp;&nbsp;&nbsp;
											Edit
										</a>
									</th>
									<th>
										<form action="{{action('EventController@destroy', $event['id'])}}" method="POST">
											{{ csrf_field() }}
											<input type="hidden" name="_method" value="DELETE"/>
											<button class="btn btn-danger fa fa-trash-o"><span style="font-family: 'Lato', sans-serif;"/>&nbsp;&nbsp;&nbsp;
												Delete
										</form>
									</th>
									<th>
										<a href="{{action('EventController@senddata',$event['id'])}}" class="btn btn-primary fa fa-envelope-o"><span style="font-family: 'Lato', sans-serif;"/>&nbsp;&nbsp;&nbsp;
											Send
										</a>
									</th>
								</tr>
							</tbody>
						@endforeach
					</table>
				</div>
				<button onclick="location.href='/events'" class="btn btn-primary fa fa-arrow-left" ><span style="font-family: 'Lato', sans-serif;"/>&nbsp;&nbsp;&nbsp;Back</button>
			</div>
		</div>
	</div>
</body>
</html>
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection