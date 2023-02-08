@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">Manage Shift</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Module</a></li>
            <li class="breadcrumb-item active">Create Shift</li>
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
                    	<form role="form" action="{{ route('admin.manage.saveproject') }}" method="POST" enctype="multipart/form-data"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<h6 class="card-header">Create Shift</Details></h6>
                       		<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Shift Title</label>
										<input type="text" class="form-control mb-1" required name="shift_title" value="{{old('shift_title')}}">
										@if($errors->has('shift_title'))
                                        <div class="text-danger">{{ $errors->first('shift_title') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Shift Start Date</label>
										<input type="date" class="form-control mb-1" required name="shift_start_date" value="{{old('shift_start_date')}}">
										@if($errors->has('shift_start_date'))
                                        <div class="text-danger">{{ $errors->first('shift_start_date') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Shift End Date</label>
										<input type="date" class="form-control mb-1" required name="shift_end_date" value="{{old('shift_end_date')}}">
										@if($errors->has('shift_end_date'))
                                        <div class="text-danger">{{ $errors->first('shift_end_date') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Shift Start Time</label>
										<input type="time" class="form-control mb-1" required name="shift_start_time" value="{{old('shift_start_time')}}">
										@if($errors->has('shift_start_time'))
                                        <div class="text-danger">{{ $errors->first('shift_start_time') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Shift End Time</label>
										<input type="time" class="form-control mb-1" required name="shift_end_time" value="{{old('shift_end_time')}}">
										@if($errors->has('shift_end_time'))
                                        <div class="text-danger">{{ $errors->first('shift_end_time') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								</div>
								<div class="text-right mt-3">
									<button type="submit" class="btn btn-primary">Save</button>&nbsp;
									<a href="{{ route('admin.menu.index') }}" class="btn btn-default">Cancel</a>
								</div>
								<div class="clearfix"></div>
                        	</div>
                     	</form>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<!-- [ content ] End -->
@endsection