@extends('admin.layouts.app')
@section('content')
<div class="layout-content">
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.edit_category')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">@lang('message.category')</a></li>
            <li class="breadcrumb-item active">@lang('message.edit_category')</li>
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
                    	<form role="form" action="{{ url('admin/category/update',$category->id) }}" method="POST" enctype="multipart/form-data"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="row align-items-center m-l-0">
								<div class="col-sm-10 text-left">
									<h6 class="card-header">@lang('message.category_details')</Details></h6>
								</div>
								<div class="col-sm-2 text-center">
									<a href="{{ url('admin/category/view')}}/{{$category->id}}" data-size="xl" class="btn btn-primary btn-sm mb-3 btn-round">View category </a>
								</div>
							</div>
							<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.name')<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="name" placeholder="Name" required value="{{old('name',$category->name)}}"">
                                        @if($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Status <span class="text-danger">*</span></label>
										<select class="form-control select2 select2-hidden-accessible" name="status" required>                       
											<option value='1' @if(old('status',$category->status)=='1'){{'selected="true"'}}@endif>Active</option>
											<option value='0' @if(old('status',$category->status)=='0'){{'selected="true"'}}@endif>Inactive</option>                       
										</select> 
                                        @if($errors->has('status'))
										<label class="form-label">Status <span class="text-danger">*</span></label>
                                        <div class="text-danger">{{ $errors->first('status') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
								
								<div class="text-right mt-3">
									<button type="submit" class="btn btn-primary">Save </button>&nbsp;
									<a href="{{route('admin.category.index');}}"  class="btn btn-default">Cancel</a>
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