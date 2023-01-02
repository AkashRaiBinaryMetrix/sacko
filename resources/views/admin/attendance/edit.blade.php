@extends('admin.layouts.app')
@section('content')
<!-- Stylesheet file -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<div class="page-content">
	<div class="page-title">
		<div class="row justify-content-between align-items-center">
			<div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
				<div class="d-inline-block">
					<h5 class="h4 d-inline-block font-weight-400 mb-0 "> Edit Attndance</h5>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
		<div class="col-lg-12 col-md-12">
			@if(Session::has('message'))  
			<div class="alert alert-success alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<span class="glyphicon glyphicon-ok "><strong>Success!</strong></span><em> {!! session('message') !!}</em>
			</div>
			@endif
			@foreach ($errors->all() as $error)
			<div class=" alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<span class="glyphicon glyphicon-remove"></span>{{ $error }}
			</div>
			@endforeach
		</div>
		<div class="col">
			<div class="card bg-none card-box">
				<div class="table-responsive">
					<table class="table align-items-center">
						<thead>
							<tr>
								<th>{{'Name'}}</th>
								<th>{{'Email'}}</th>
								<th>{{'Mobile'}}</th>
								<th>{{'Role'}}</th>
								<th>{{'Group'}}</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{$lists->name}}</td>
								<td>{{$lists->email}}</td>
								<td>{{$lists->mobile}}</td>
								<td>{{$lists->role_name}}</td>
								<td>{{$lists->group_name}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card bg-none card-box">
				<form role="form" action="{{ url('timesheet/update',$lists->id) }}" method="POST" enctype="multipart/form-data"> 
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					@php
						$first_day_this_month 	= date('m-d-Y',strtotime($date));
						$last_day_this_month    = date('t',strtotime($date));
						$currnent_date			= date('d');
						$url_month 				= date('Y-m',strtotime($date));
						$currnt_month 			= date('Y-m');
					@endphp
					<div class="row">
						<div class="col-md-6">
							<div class="card left-card-data bg-none min-height-470">
								<div class="table-responsive">
									<table class="table align-items-center">
										<thead>
											<tr>
												<th>{{'Day'}} </th>
												<th>{{'Date'}} </th>
												<th align="center">{{'Working Hours'}} </th>
												<th align="center">{{'Comment'}}</th>
												<th align="center">{{'Status'}}</th>
												<th>{{'Action'}}</th>
											</tr>
										</thead>
										<tbody class="list">
											@for($i=0; $i<count($month_array); $i++)
											<tr>
												@php
												$attndance_date 			= date('d-m-Y', strtotime($date.' +'.$i.' day'));
												$attndance_date_fomate		= date('Y-m-d',strtotime($date.' +'.$i.' day'));
												$timestamp 					= strtotime($attndance_date_fomate);
												$day 						= date('D',$timestamp);
												$timesheet  				= Timesheet($lists->id,$month_array[$i]['attndance_date']);
												if(is_object($timesheet))
												{
													$working_house  			= $timesheet->working_house;
													$attandance_status  		= $timesheet->status;
													$comment  					= $timesheet->comment;
												}
												else
												{
													$working_house  			= 0;
													$attandance_status  		= 0;
													$comment  					='';
												}
												@endphp
												<td>{{$day}}
													<input type="hidden" class="form-control"  name="attndance_day[]" placeholder="Day" readonly  value="{{old('attndance_day',$day)}}">
												</td>
												<td>
													{{$attndance_date}}
													<input type="hidden"   class="form-control"  name="attndance_date[]" placeholder="Date" readonly  value="{{$month_array[$i]['attndance_date']}}">
												</td>
												<td align="center">
													{{$working_house}} hr
												</td>
												<td align="center">
													@if(!empty($comment))
													<a data-size="xl"  data-toggle="modal" data-target="#exampleModalLong{{$i}}" data-title="{{__('View')}}" class="btn-create badge-blue" style="cursor: pointer;">
														{{__('View')}}
													</a>
													<div class="modal fade" id="exampleModalLong{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="card bg-none card-box pt-0">
																<div class="modal-content">
																	<div class="modal-header">
																		<h6 class="modal-title" id="exampleModalLongTitle">Comment</h6>
																		<button type="button" onClick="document.location.reload(true)" class="close" data-dismiss="modal" aria-label="Close">
																		  <span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<p>{{$comment}}</p>
																	</div>
																	<div class="modal-footer">
																	<div id="message"></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													@else
													{{'--'}}	
													@endif
												</td>
												<td>@if($month_array[$i]['status']=='0')<span class="btn-status {{'badge-danger'}}">{{'Not Submitted'}}</span>
													@elseif($month_array[$i]['status']=='1')<span class="btn-status {{'badge-success'}}">{{'Present'}}</span>
													@elseif($month_array[$i]['status']=='2')<span class="btn-status {{'badge-warning'}}">{{'Holiday'}}</span>
													@elseif($month_array[$i]['status']=='3')<span class="btn-status {{'badge-light'}}">{{'Off'}}</span>
													@elseif($month_array[$i]['status']=='4')<span class="btn-status {{'badge-warning'}}">{{'Optional Holiday'}}</span>
													@elseif($month_array[$i]['status']=='5')<spant class="btn-status {{'badge-light'}}">{{'Comp-Off'}}</span>
													@elseif($month_array[$i]['status']=='6')<span class="btn-status {{'badge-primary'}}">{{'Leave'}}</span>
													@elseif($month_array[$i]['status']=='7')<span class="btn-status {{'badge-warning'}}">{{'Week Off'}}</span>
													@endif
												</td>
												<td><a href="" class="edit-icon"  onclick="return modal_open('{{$lists->id}}','{{$month_array[$i]['attndance_date']}}','{{$comment}}','{{$day}}','{{$month_array[$i]['status']}}');"><i class="fas fa-pencil-alt"></i></a></td>
												<td style="display:none;">
													<input type="hidden" name="status[]" value="{{$month_array[$i]['status']}}"/>
												</td>
											</tr>
											@endfor
										</tbody>
									</table>
								</div>
							</div>
						</div>
						@php
						$time 		= strtotime($date);
						$pre_month 	= date('Y-m-d', strtotime('-1 month',$time));
						$next_month = date('Y-m-d', strtotime('+1 month',$time));
						$url = url('timesheet/edit',$lists->id);
						@endphp
						<div class="col-sm-6">
							<div class="card bg-none min-height-470">
								<div id="calendar_div">
									{{getAttndanceCalender('','',$date,$lists->id,$url,$lists->group_id)}}	
								</div>
							</div>
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModalAttndanceUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="card bg-none card-box">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title" id="exampleModalLongTitle">Attndance Details </h6>
					<button type="button" onClick="document.location.reload(true)" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form role="form" id="myForm" name="attandnce_update"  method="POST" enctype="multipart/form-data"> 
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<input type="hidden" class="form-control"  name="user_id" id="user_id" required >
							<div class="form-leavetype col-lg-6 col-md-6">
								<label for="exampleInputEmail1">{{'Day'}} <span class="myrequired">*</span> </label>
								<input type="text" class="form-control" readonly name="day" id="day"  >
							</div>
							<div class="form-leavetype col-lg-6 col-md-6">
								<label for="exampleInputEmail1">{{'Attandnce Date'}} <span class="myrequired">*</span> </label>
								<input type="text" class="form-control" readonly name="attndance_date" id="attndance_date"  >
							</div>
							<div class="form-leavetype col-lg-12">
								<label for="exampleInputEmail1">{{'Comment'}} <span class="myrequired">*</span> </label>
								<textarea class="form-control"  id="comment" name="comment" placeholder="Comment" ></textarea>
							</div>
							<div class="form-leavetype col-lg-6 col-md-6" style="display:none;">
								<label for="exampleInputEmail1">{{'Status'}} <span class="myrequired">*</span> </label>
								<input type="text" class="form-control" readonly name="status" id="status"  >
							</div>
							<div class="col-md-12" align="left">
								<button type="submit" class="btn-create badge-blue">Save</button>
								<button type="button" onClick="document.location.reload(true)" class="btn-create bg-gray" data-dismiss="modal">Close</button>
							</div>
						</div> 
					</form> 
				</div>
				<div class="modal-footer">
				<div id="Attandncemessage"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
<script src="{{ asset('assets/js/calendar/jquery.min.js') }}"></script>
@section('extra-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script type="text/javascript">
function modal_open(user_id,attndance_date,comment,day,status)
{	
	$('#exampleModalAttndanceUpdate').modal('toggle');
	$('#user_id').val(user_id);
	$('#attndance_date').val(attndance_date);
	$('#comment').val(comment);
	$('#day').val(day);
	$('#status').val(status);
	return false;
}
</script>
<script type="text/javascript">
$(function() 
{
	$("form[name='attandnce_update']").validate({
		// Specify validation rules
		rules: {
		  user_id: "required",
		  attndance_date: "required",
		  comment: "required",
		  day: "required",
		  status: "required",
		},
		// Specify validation error messages
		messages: {
		 user_id: "<span class='text-danger'>Please Enter User Id</span>",
		 attndance_date: "<span class='text-danger'>Please Enter Attndance Date</span>",
		 comment: "<span class='text-danger'>Please Enter Comment</span>",
		 day: "<span class='text-danger'>Please Enter Day</span>",
		 status: "<span class='text-danger'>Please Enter Status</span>",
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) 
		{	
			var user_id 			= $('#user_id').val();
			var attndance_date 		= $('#attndance_date').val();
			var comment 			= $('#comment').val();
			var day 				= $('#day').val();
			var status 				= $('#status').val();
			$.ajax({
				type: 'POST',
				data: {
						'user_id':user_id,
						'attndance_date':attndance_date,
						'comment':comment,
						'day':day,
						'status':status,
					  },
				url: "{{url('timesheet/comment-update')}}",
				success: function(result)
				{	
					if(result=='1')
					{
						$('#Attandncemessage').html('<div class="alert alert-success alert-dismissible" ><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="glyphicon glyphicon-ok "><strong>Success</strong></span><em> Attndance Updated Successfully!</em></div>');
						$('#comment').val('');
						setTimeout(function(){
						$('#exampleModalAttndanceUpdate').modal('hide'); 
						document.location.reload(true);
						}, 2000);
					}
					else
					{
						$('#Attandncemessage').html('<div class="alert alert-danger alert-dismissible" ><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="glyphicon glyphicon-ok "><strong>Alert</strong></span><em> Something Went Wrong!</em></div>');
						setTimeout(function(){
						$('#exampleModalAttndanceUpdate').modal('hide'); 
						document.location.reload(true);
						}, 2000);
					}
				}});
		  //form.submit();
		}
	});
});
</script>
@endsection
