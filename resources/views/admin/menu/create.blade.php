@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">Menu Create</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Module</a></li>
            <li class="breadcrumb-item active">Menu Create</li>
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
                    	<form role="form" action="{{ url('admin/admin-menu/store') }}" method="POST" enctype="multipart/form-data"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<h6 class="card-header">Menu Details</Details></h6>
                       		<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Module Name</label>
										<input type="text" class="form-control mb-1" required name="name" value="{{old('name')}}">
										@if($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Url</label>
										<input type="text" class="form-control mb-1" required name="url"  value="{{old('url')}}">
										@if($errors->has('url'))
                                        <div class="text-danger">{{ $errors->first('url') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Icon Class</label>
										<input type="text" class="form-control" name="icon"  value="{{old('icon')}}" >
										@if($errors->has('icon'))
                                        <div class="text-danger">{{ $errors->first('icon') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Parent Menu </label>
										<select class="form-control select2 select2-hidden-accessible" required name="parent_menu_id">                       
                                            <option value='0' selected >Select</option>
                                            @if(is_object($parent_menus) && !empty($parent_menus))
                                            @foreach($parent_menus as $parent)
                                            <option value="{{$parent->id}}" @if(old('parent_menu_id')==$parent->id){{'selected="true"'}}@endif>{{$parent->name}}</option> 
                                            @endforeach
                                            @endif                      
										</select> 
                                        @if($errors->has('parent_menu_id'))
                                        <div class="text-danger">{{ $errors->first('parent_menu_id') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
                                    <div class="form-group col-md-6">
										<label class="form-label">Priority </label>
										<input type="text" class="form-control" name="priority" required value="{{old('priority')}}" required>
										@if($errors->has('priority'))
                                        <div class="text-danger">{{ $errors->first('priority') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Status</label>
										<select class="form-control select2 select2-hidden-accessible" name="status" required>                       
                                            <option value='1' selected >Active</option>
                                            <option value='0'>Inactive</option>                       
										</select> 
										@if($errors->has('status'))
                                        <div class="text-danger">{{ $errors->first('status') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								<div class="text-right mt-3">
									<button type="submit" class="btn btn-primary">Save</button>&nbsp;
									<a href="{{ route('admin.menu.index') }}" class="btn btn-default">Cancel</a>
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