@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.add_holiday')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.holiday_calendar.index') }}">@lang('message.holiday_calendar')</a></li>
            <li class="breadcrumb-item active">@lang('message.add_holiday')</li>
        </ol>
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
    </div>
	<div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account-general">	
						<form role="form" action="{{ url('admin/holiday_calendar/store') }}" method="POST" enctype="multipart/form-data"> 
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<h6 class="card-header">@lang('message.holiday_details')</Details></h6>
                       		<div class="card-body">
								<div class="form-row">
									<div class="form-group col-lg-6 col-md-6">
										<label for="exampleInputEmail1">{{'Holiday Name'}} <span class="myrequired">*</span> </label>
										<input type="text"  class="form-control" id="holiday_name" name="holiday_name" maxlength="100" placeholder="Holiday Name" required	 value="{{old('holiday_name')}}">
										@if($errors->has('holiday_name'))
										<div class="text-danger">{{ $errors->first('holiday_name') }}</div>
										@endif
										<div class="clearfix">
									</div>
								</div>
								<div class="form-group col-lg-6 col-md-6">
									<label for="exampleInputEmail1">{{'Holiday Date'}} <span class="myrequired">*</span> </label>
									<input type="date"  class="form-control" id="holiday_start" maxlength="100" name="holiday_start" placeholder="Holiday Start" required value="{{old('holiday_start')}}">
									@if($errors->has('holiday_start'))
									<div class="text-danger">{{ $errors->first('holiday_start') }}</div>
									@endif
									<div class="clearfix">
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">	
								<label for="contact" class="form-control-label">{{'Status'}} <span class="myrequired">*</span></label>
								<select class="form-control select2 select2-hidden-accessible" name="status" required>                       
									<option value='1' @if(old('status')=='1'){{'selected="true"'}}@endif selected >Active</option>
									<option value='0' @if(old('status')=='0'){{'selected="true"'}}@endif>Inactive</option>                       
								</select> 
								@if($errors->has('status'))
								<div class="text-danger">{{ $errors->first('status') }}</div>
								@endif
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="text-right mt-3">
							<button type="submit" class="btn btn-primary">Save </button>&nbsp;
							<a href="{{route('admin.holiday_calendar.index');}}"  class="btn btn-default">Cancel</a>
						  </div>
					  </div>
				    </div> 
				</form> 
			</div> 
		</div>
    </div>
</div>
@stop
