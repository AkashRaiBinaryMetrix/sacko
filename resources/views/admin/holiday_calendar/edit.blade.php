@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.edit_holiday_calendar')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.holiday_calendar.index') }}">@lang('message.holiday_calendar')</a></li>
            <li class="breadcrumb-item active">@lang('message.edit_holiday_calendar')</li>
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
				<form role="form" action="{{ url('admin/holiday_calendar/update',$lists->id) }}" method="POST" enctype="multipart/form-data"> 
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row align-items-center m-l-0">
						<div class="col-sm-10 text-left">
							<h6 class="card-header">@lang('message.holiday_details')</Details></h6>
						</div>
					</div>
					<div class="card-body">
						<div class="form-row">
						<div class="form-group col-lg-6 col-md-6">
							<label for="exampleInputEmail1">Holiday Name <span class="myrequired">*</span> </label>
							<input type="text"  class="form-control" id="holiday_name" name="holiday_name" placeholder="Holiday Name" required value="{{ old('holiday_name',$lists->holiday_name)}}">
							@if($errors->has('holiday_name'))
							<div class="text-danger">{{ $errors->first('holiday_name') }}</div>
							@endif
						</div>
						<div class="form-group col-lg-6 col-md-6">
							<label for="exampleInputEmail1">{{'Holiday Start'}} <span class="myrequired">*</span> </label>
							<input type="date"  class="form-control" id="holiday_start" maxlength="100" name="holiday_start" placeholder="Holiday Start" required value="{{old('holiday_start',$lists->holiday_start)}}">
							@if($errors->has('holiday_start'))
							<div class="text-danger">{{ $errors->first('holiday_start') }}</div>
							@endif
						</div>
						<div class="form-group col-lg-6 col-md-6">
							<label for="contact" class="form-control-label">{{'Status'}} <span class="myrequired">*</span></label>
							<select class="form-control select2 select2-hidden-accessible" name="status" required>                       
							 	<option value='1' @if(old('status',$lists->status)=='1') {{ 'selected="true"'}} @endif>Active</option>
							 	<option value='0' @if(old('status',$lists->status)=='0') {{ 'selected="true"'}} @endif>Inactive</option>                     
							</select> 
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
	</div>
</div>
@endsection