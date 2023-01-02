@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
<style>
.fc-toolbar.fc-header-toolbar {
    display: block;
}
.fc-day-header{
	font-size: 20px!important;
    background: #011c4b;
    color: #ffffff!important;
}
.fc-ltr .fc-basic-view .fc-day-top .fc-day-number {
    padding-right:10px!important;
	font-size:20px!important;
}
.fc-event .fc-title {
    padding: 0.4rem 0.5rem;
    display: block;
    color: #FFF;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-weight: 600;
    font-size: 15px;
}
.fc-event .fc-content {
    position: relative;
    z-index: 2;
    background: #0ca7e4;
	border: 1px solid #fff;
}
.fc .fc-toolbar > * > :first-child {
    margin-left: 0;
    color: #f00;
    background: #fff;
    padding: 2px 10px 2px 10px;
    border-radius: 10px;
}
.fc .fc-button-group > :first-child {
    margin-left: 0;
    background: #0137ff;
    color: #fff;
    padding-bottom: 3px;
}
.fc .fc-button-group > * {
    float: left;
	background: #0137ff;
    color: #fff;
    padding-bottom: 3px;
    margin: 0 0 0 -1px;
}
.fc td, .fc th {
    border-width: 5px;
    border: 1px solid #e8e1e1!important;
}
.fc-unthemed td.fc-today span {
	color: #fff;
    background: #011c4b;
    padding-left: 10px;
}
.fc-day-top .fc-wed .fc-today {
    background:red!important;
}
</style>
<div class="page-content">
	<div class="page-title">
		<div class="row justify-content-between align-items-center">
			<div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
				<div class="d-inline-block">
					<h5 class="h4 d-inline-block font-weight-400 mb-0 ">My Holiday Calendar</h5>
				</div>
			</div>
			<div class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
				<div class="all-button-box row d-flex justify-content-end">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
						<h5 class="h4 d-inline-block font-weight-400 mb-0 ">Group : {{$group->name}} </h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			@foreach ($errors->all() as $error)
			<div class=" alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<span class="glyphicon glyphicon-remove"></span>{{ $error }}
			</div>
			@endforeach
		</div>
		<div class="col">
			<div class="card bg-none card-box">
				<div id='calendar'></div>
			</div>
		</div>
	</div>
</div>
   
<script>
$(document).ready(function () 
{
	var SITEURL = "{{URL::to('/')}}";
  
	$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	var calendar = $('#calendar').fullCalendar({
		editable: false,
		events: SITEURL + "/holiday-session/mycalendar",
		displayEventTime: false,
		editable: true,
		eventRender: function (event, element, view) 
		{
			if (event.allDay === 'true') 
			{
					event.allDay = true;

			} 
			else 
			{
					event.allDay = false;
			}
		},
		/*eventRender: function (event, element, view) {
		  var dataHoje = moment();
		  if (event.start.isSameOrBefore(dataHoje) && event.end.isSameOrAfter(dataHoje)) 
		  {
			//event.color = "Pastel orange"; //In progress
			element.css("background-color", "#FFB347");
		  } 
		  else if (event.end.isBefore(dataHoje)) 
		  {
			//event.color = "Pastel green"; //Done OK
			element.css("background-color", "#77DD77");
		  } 
		  else if (event.start.isAfter(dataHoje)) 
		  {
			//event.color = "Pastel blue"; //Not started
			element.css("background-color", "#AEC6CF");
		  }
		},*/
		selectable: true,
		selectHelper: true,
		/*select: function (start, end, allDay) {
			var title = prompt('Event Title:');
			if(title) {
				var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
				var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
				$.ajax({
					url: SITEURL + "/fullcalenderAjax",
					data: {
						title: title,
						start: start,
						end: end,
						type: 'add'
					},
					type: "POST",
					success: function (data) {
						displayMessage("Event Created Successfully");

						calendar.fullCalendar('renderEvent',
							{
								id: data.id,
								title: title,
								start: start,
								end: end,
								allDay: allDay
							},true);

						calendar.fullCalendar('unselect');
					}
				});
			}
		},
		eventDrop: function (event, delta) {
			var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
			var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

			$.ajax({
				url: SITEURL + '/fullcalenderAjax',
				data: {
					title: event.title,
					start: start,
					end: end,
					id: event.id,
					type: 'update'
				},
				type: "POST",
				success: function (response) {
					displayMessage("Event Updated Successfully");
				}
			});
		},
		eventClick: function (event) {
			var deleteMsg = confirm("Do you really want to delete?");
			if (deleteMsg) {
				$.ajax({
					type: "POST",
					url: SITEURL + '/fullcalenderAjax',
					data: {
							id: event.id,
							type: 'delete'
					},
					success: function (response) {
						calendar.fullCalendar('removeEvents', event.id);
						displayMessage("Event Deleted Successfully");
					}
				});
			}
		}*/
	});
});
 
function displayMessage(message) {
    toastr.success(message, 'Event');
} 
  
</script>
  
@stop