@extends('layouts.app')
@section('content')
<div class="page-content">
	<div class="page-title">
		<div class="row justify-content-between align-items-center">
			<div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
				<div class="d-inline-block">
					<h5 class="h4 d-inline-block font-weight-400 mb-0 "> Apply Leave
					</h5>
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
			@if(Session::has('message'))  
			<div class="alert alert-success alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<span class="glyphicon glyphicon-ok "><strong>Success!</strong></span><em> {!! session('message') !!}</em>
			</div>
			@endif
		</div>
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<div class="card bg-none card-box">
				<form role="form" action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off"> 
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<div class="form-group col-lg-12 col-md-12">
							<label for="contact" class="form-control-label">{{'Leave Type'}}<span class="myrequired">*</span></label>
							<select class="form-control select2 select2-hidden-accessible"  id="leave_type_id" name="leave_type_id" required>
								<option value="">Select</option>
								@if($leaveType->count())
								@foreach($leaveType as $leave)
								<option value="{{$leave->id}}" @if(old('leave_type_id')==$leave->id){{'selected="true"'}}@endif>{{$leave['name']}}</option>
								@endforeach
								@endif
							</select>
						</div>
						<!--<div class="form-leavetype col-lg-12 col-md-12">
							<label for="exampleInputEmail1">{{'Leave Title'}} <span class="myrequired">*</span> </label>
							<input type="text"  class="form-control" id="leave_title" name="leave_title" placeholder="Name" required value="{{old('leave_title')}}">
						</div>-->
						<div class="form-leavetype col-lg-6 col-md-6">
							<label for="exampleInputEmail1">{{'Date From'}} <span class="myrequired">*</span> </label>
							<input type="text"  class="form-control date-picker" id="date_from" name="date_from" placeholder="Date From" required value="{{old('date_from')}}">
						</div>
						<div class="form-leavetype col-lg-6 col-md-6">
							<label for="exampleInputEmail1">{{'Date To'}} <span class="myrequired">*</span> </label>
							<input type="text"  class="form-control date-picker" id="date_to" name="date_to" placeholder="Date To" required value="{{old('date_to')}}">
						</div>
						<div class="form-leavetype col-lg-12">
							<label for="exampleInputEmail1">{{'Comment'}} <span class="myrequired">*</span> </label>
							<textarea class="form-control" id="description" name="description" placeholder="Comment" required value="{{old('description')}}"></textarea>
						</div>
						<div class="col-md-12">
							<button type="submit" class="btn-create badge-blue">Submit</button>
							<a href="{{ route('leave.my_leave') }}" class="btn-create bg-gray"> {{__('Cancel')}}</a>
						</div>
					</div> 
				</form> 
			</div> 
		</div>
		<div class="col-sm-3"></div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">
    $('.date-picker').datepicker({  
       format: 'yyyy-mm-dd'
     });  
</script> 
@stop
