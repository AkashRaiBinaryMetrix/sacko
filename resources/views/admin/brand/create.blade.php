@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.create_brand')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">@lang('message.brand')</a></li>
            <li class="breadcrumb-item active">@lang('message.create_brand')</li>
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
                    	<form role="form" action="{{ url('admin/brand/store') }}" method="POST" enctype="multipart/form-data" autocomplete="off"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<h6 class="card-header">@lang('message.brand_details')</Details></h6>
                       		<div class="card-body">
								
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.brand_name')<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="name" placeholder="Enter Brand Name" required value="{{old('name')}}">
                                        @if($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.status')<span class="text-danger">*</span></label>
										<select class="form-control select2 select2-hidden-accessible" name="status" required>                       
											<option value='1' @if(old('status')=='1'){{'selected="true"'}}@endif >Active</option>
											<option value='0' @if(old('status')=='0'){{'selected="true"'}}@endif>Inactive</option>                       
										</select> 
                                        @if($errors->has('status'))
                                        <div class="text-danger">{{ $errors->first('status') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.logo') <span class="text-danger">*</span></label>
										<input type="file" name="logo"  class="form-control" id="logo">
										@if($errors->has('logo'))
										<div class="text-danger">{{ $errors->first('logo') }}</div>
										@endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.banner') </span></label>
										<input type="file" name="banner"  class="form-control" id="banner">
										@if($errors->has('banner'))
										<div class="text-danger">{{ $errors->first('banner') }}</div>
										@endif
										<div class="clearfix"></div>
									</div>
								</div>
									 <div class="form-row">
									  <div class="form-group col-md-12">
										<label class="form-label">@lang('message.meta_title')</span></label>
										<input type="text"  class="form-control" name="meta_title" placeholder="Enter Meta Title" required value="{{old('meta_title')}}">
                                        @if($errors->has('meta_title'))
                                        <div class="text-danger">{{ $errors->first('meta_title') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								  </div>
									<div class="form-row">
									<div class="form-group col-md-12">
										<label class="form-label">@lang('message.meta_description')</span></label>
										<textarea  class="form-control" name="meta_description" rows="4" placeholder="Enter Meta Description"></textarea>
                                        @if($errors->has('meta_description'))
                                        <div class="text-danger">{{ $errors->first('meta_description') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
									<div class="text-right mt-3">
										<button type="submit" class="btn btn-primary">Save </button>&nbsp;
										<a href="{{route('admin.brand.index');}}"  class="btn btn-default">Cancel</a>
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
<!-- [ content ] End -->
@endsection