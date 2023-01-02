@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.edit_leave')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.leave.index') }}">@lang('message.leave')</a></li>
            <li class="breadcrumb-item active">@lang('message.edit_leave')</li>
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
                    	<form role="form" action="{{ url('admin/leave/update',$leave->id) }}" method="POST" enctype="multipart/form-data"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="row align-items-center m-l-0">
								<div class="col-sm-10 text-left">
									<h6 class="card-header">@lang('message.leave_details')</Details></h6>
								</div>
								<div class="col-sm-2 text-center">
									<a href="{{ url('admin/leave/view')}}/{{$leave->id}}" data-size="xl" class="btn btn-primary btn-sm mb-3 btn-round">View leave </a>
								</div>
							</div>
							<div class="card-body">
								<div class="form-row">
									<div class="form-leave col-lg-6 col-md-6">
										<label for="exampleInputEmail1">Employee_name <span class="myrequired">*</span> </label>
										<select class="form-control select2 select2-hidden-accessible" name="user_id" disable >                       
											<option value="">Select</option>
											@if($employees->count())
												@foreach($employees as $employee)
													<option value="{{ $employee->id }}" {{ ($leave->user_id==$employee->id) ? 'selected' : ''}}>{{ $employee->name }}</option>
												@endforeach
											@endif
										</select>
									</div>
									<div class="form-leave col-lg-6 col-md-6">
										<label for="contact" class="form-control-label">{{'Status'}} <span class="myrequired">*</span></label>
										<select class="form-control select2 select2-hidden-accessible" name="status" required>                       
											<option value='1' @if($leave->status=='1') {{ 'selected="true"'}} @endif>Pending</option>
											<option value='2' @if($leave->status=='2') {{ 'selected="true"'}} @endif>Accepted</option> 
											<option value='3' @if($leave->status=='3') {{ 'selected="true"'}} @endif>Rejected</option>                                         
										</select> 
									</div>
								</div>
								<div class="text-right mt-3">
									<button type="submit" class="btn btn-primary">Save </button>&nbsp;
									<a href="{{route('admin.leave.index');}}"  class="btn btn-default">Cancel</a>
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