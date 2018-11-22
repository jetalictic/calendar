<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CSD Calendar</title>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	
	<style>
		body{
			background:#F5F5F5;
		}
		.lato{
			font-family: 'Lato', sans-serif;
		}
		#email-container{
			background-color:white;
			border-style:solid;
			border-radius:5px;
			border-width:1px;
			border-color:#EBEBED;
			width:60%;
			margin: 20px auto 0px auto;
		}
		.font-color{
			color:#4C4F54;
		}
		#text{
			padding-left:20px;
		}
		#heading{
			margin:0px 0px 0px 0px;
			padding:10px 10px 10px 10px;
			text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
		}
		#heading-container{
			border-bottom-style: solid;
			border-color:#EBEBED;
			margin-bottom:5px;
			background:url(https://i.rackaid.com/wp-content/uploads/2015/09/email-delivery.jpg);
			background-size: auto;
		}
	</style>
	
</head>

<body>
	<div id="email-container">
		<div id="heading-container">
			<h2 align="center" id="heading" class="lato font-color">CSD Calendar Event Invitation</h2>
		</div>

		<p class="lato font-color" id="text">{{ Auth::user()->name }} has added you to the following event. </p>
		<p class="lato font-color" id="text"><b>Name of Event: </b><span style="color:{{ $event->color }};">{{ $event->title }}</span></p>
		<p class="lato font-color" id="text"><b>Start: </b><span style="color:#2ECC40;">{{ $event->start_date }}</span></p>
		<p class="lato font-color" id="text"><b>End: </b><span style="color:#FF4136;">{{ $event->end_date }}</span></p>
		<p class="lato font-color" id="text"><b>Description: </b>{{ $event->description }}</p>
		<p class="lato font-color" id="text"><b>Additional Information: </b>{{ $event->comment }}</p>
		<br>
		<center><a href="http://localhost:8000/"><button style="border-width:0px; background-color:#3590DA; color:white; padding:10px 20px 10px 20px; border-radius: 2px; font-size:15px;" class="lato">View Event on Calendar</button></a>
		<br><br>
	</div>
</body>
</html>