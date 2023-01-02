@extends('layouts.app')
@section('content')
<div class="page-content">
	<div class="page-title">
		<div class="row justify-content-between align-items-center">
			<div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
				<div class="d-inline-block">
					<h5 class="h4 d-inline-block font-weight-400 mb-0 "> Add Leave Type
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
		</div>
		<div class="col">
			<div class="card bg-none card-box">
				<form role="form" action="{{ route('leavetype.store') }}" method="POST" enctype="multipart/form-data"> 
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<div class="form-leavetype col-lg-6 col-md-6">
							<label for="exampleInputEmail1">{{'Name'}} <span class="myrequired">*</span> </label>
							<input type="text"  class="form-control" id="name" name="name" placeholder="Name" required value="{{old('name')}}">
						</div>
						<div class="form-leavetype col-lg-6 col-md-6">
							<label for="contact" class="form-control-label">{{'Status'}} <span class="myrequired">*</span></label>
							<select class="form-control select2 select2-hidden-accessible" name="status" required>                       
									<option value='1' selected >Active</option>
									<option value='0'>Inactive</option>                       
							</select> 
						</div>
						<div class="col-md-12">
							<button type="submit" class="btn-create badge-blue">Save</button>
							<a href="{{ route('leavetype.index') }}" class="btn-create bg-gray"> {{__('Cancel')}}</a>
						</div>
					</div> 
				</form> 
			</div> 
		</div>
    </div>
</div>
@stop
