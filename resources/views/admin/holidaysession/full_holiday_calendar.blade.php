@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<div class="page-content">
	<div class="page-title">
		<div class="row justify-content-between align-items-center">
			<div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
				<div class="d-inline-block">
					<h5 class="h4 d-inline-block font-weight-400 mb-0 ">Holiday Calendar</h5>
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
				<div class="col-sm-12">
					<div class="card bg-none min-height-420">
						<div id="calendar_div">
							<?php
							$date = date('Y-m-d');
							echo getGroupCalender('','',$date,$group->id); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('assets/js/calendar/jquery.min.js') }}"></script>  
<script> 
var base_url = '{{URL::to('/')}}';
function getCalendar(target_div, year, month)
{ 	
	var group_id = {{$group->id}};
	$.ajax({ 
		type:'GET', 
		url: base_url+'/holiday-session/getCalender',
		data:'year='+year+'&month='+month+'&group_id='+group_id, 
		success:function(html)
		{ 	
			$('#'+target_div).html(html); 
		} 
	}); 
} 
 
function getEvents(date)
{ 	
	var group_id = {{$group->id}};
	$.ajax({ 
		type:'GET', 
		url: base_url+'/holiday-session/getEvents',
		data:'date='+date+'&group_id='+group_id, 
		success:function(html)
		{ 
			$('#event_list').html(html); 
		} 
	}); 
} 
 
$(document).ready(function()
{ 
	$('.month-dropdown').on('change',function()
	{ 
		getCalendar('calendar_div', $('.year-dropdown').val(), $('.month-dropdown').val()); 
	}); 
	$('.year-dropdown').on('change',function()
	{ 
		getCalendar('calendar_div', $('.year-dropdown').val(), $('.month-dropdown').val()); 
	}); 
}); 
</script> 
@stop