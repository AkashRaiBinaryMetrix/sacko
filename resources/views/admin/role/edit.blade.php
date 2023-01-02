@extends('admin.layouts.app')
@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
	<h4 class="font-weight-bold py-3 mb-0">@lang('message.edit_role')</h4>
	<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">@lang('message.role')</a></li>
			<li class="breadcrumb-item active">@lang('message.edit_role')</li>
		</ol>
	</div>
	<div class="col-lg-12 col-md-12">
		@foreach ($errors->all() as $error)
		<div class=" alert alert-danger alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<span class="glyphicon glyphicon-remove"></span>{{ $error }}
		</div>
		@endforeach
		@if(Session::has('success_message'))  
		<div class="alert alert-success alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<span class="glyphicon glyphicon-ok "><strong>Success!</strong></span><em> {!! session('success_message') !!}</em>
		</div>
		@endif
		@if(Session::has('error_message'))  
		<div class="alert alert-warning alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<span class="glyphicon glyphicon-ok "><strong>Error!</strong></span><em> {!! session('error_message') !!}</em>
		</div>
		@endif
	</div>
	<div class="card mb-4">
		<h6 class="card-header">Role Details</h6>
		<div class="card-body">
			<form role="form" action="{{ route('admin.role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="form-label">{{'Role Name'}}</label>
						<input type="text" class="form-control"  name="name" required value="{{ old('name',$role->name) }}">
						<div class="clearfix"></div>
					</div>
					<div class="form-group col-md-6">
						<label class="form-label">{{'Status'}}</label>
						<select class="form-control select2 select2-hidden-accessible" name="status" required>                       
							<option value='1' @if($role->status=='1') {{ 'selected="true"'}} @endif>Active</option>
							<option value='0' @if($role->status=='0') {{ 'selected="true"'}} @endif>Inactive</option>
						</select> 
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="form-label">Permissions</label>
				</div>
				<div class="form-group">
					<table class="table table-striped mb-0" id="dataTable-1">
						<thead>
							<tr>
								<th>Module </th>
								<th>Permissions </th>
								
							</tr>
						</thead>
						<tbody>
							@php 
							$permissions = [];
							@endphp
							@foreach($admin_module as $parent_module)
							@if($parent_module->parent_menu_id==0) 
							@php
							$permissions 	= permissions($role->id,$parent_module->id,'');
							@endphp
							<tr>
								<td><span style="font-weight:600; color:#0F59EE">{{$parent_module->name}}</span></td>
								<td>
									<input  type="hidden" name="module_id[]" value="{{$parent_module->id}}">
									<div class="row">
										<div class="col-md-3 custom-control custom-checkbox">
											<input  class="custom-control-input" id="parent_permissions{{$parent_module->id}}" name="parent_permissions[]" type="checkbox" value="{{$parent_module->id}}" {{isset($permissions['can_manage']) && $permissions['can_manage'] == 1 ? 'checked': ''}}>
											<label for="parent_permissions{{$parent_module->id}}" class="custom-control-label font-weight-500"></label><br>
										</div>
									</div> 
								</td>
							</tr>
							@php 
							$guard1=1;
							$guard2=1;
							$guard3=1;
							$guard4=1; 
							@endphp
							@foreach($admin_module as $sub_module)
							@if($sub_module->parent_menu_id==$parent_module->id)
							@php
							$permissions 	= permissions($role->id,$parent_module->id,$sub_module->id);
							@endphp
							<tr>
								<td><span style="padding-left: 50px;font-weight:300;">{{$sub_module->name}}</span></td>
								<td>
									<input  type="hidden" name="sub_module_id[{{$parent_module->id}}][]" value="{{$sub_module->id}}">
									<div class="row">
										<div class="col-md-3 custom-control custom-checkbox" >
											<input class="custom-control-input" id="child_privilege{{$sub_module->id}}" name="can_manage[{{$parent_module->id}}][{{$sub_module->id}}]" type="checkbox" value="1"{{isset($permissions['can_manage']) && $permissions['can_manage'] == 1 ? 'checked':''}}>
											<label for="child_privilege{{$sub_module->id}}" class="custom-control-label font-weight-500">Manage</label><br>
										</div>
										<div class="col-md-2 custom-control custom-checkbox">
											<input class="custom-control-input" id="guard_permission1{{$guard1}}" name="can_create[{{$parent_module->id}}][{{$sub_module->id}}]" type="checkbox" value="1" {{isset($permissions['can_create']) && $permissions['can_create'] == 1 ? 'checked':''}}>
											<label for="guard_permission1{{$guard1}}" class="custom-control-label font-weight-500">Create</label><br>
										</div>
										<div class="col-md-2 custom-control custom-checkbox">
											<input class="custom-control-input" id="guard_permission2{{$guard2}}" name="can_edit[{{$parent_module->id}}][{{$sub_module->id}}]" type="checkbox" value="1" {{isset($permissions['can_edit']) && $permissions['can_edit'] == 1 ? 'checked':''}}>
											<label for="guard_permission2{{$guard2}}" class="custom-control-label font-weight-500">Edit</label><br>
										</div>
										<div class="col-md-2 custom-control custom-checkbox">
											<input class="custom-control-input" id="guard_permission3{{$guard3}}" name="can_view[{{$parent_module->id}}][{{$sub_module->id}}]" type="checkbox" value="1" {{isset($permissions['can_view']) && $permissions['can_view'] == 1 ? 'checked':''}}>
											<label for="guard_permission3{{$guard3}}" class="custom-control-label font-weight-500">View</label><br>
										</div>            
										<div class="col-md-2 custom-control custom-checkbox">
											<input class="custom-control-input" id="guard_permission4{{$guard4}}" name="can_delete[{{$parent_module->id}}][{{$sub_module->id}}]" type="checkbox" value="1" {{isset($permissions['can_delete']) && $permissions['can_delete'] == 1 ? 'checked':''}}>
											<label for="guard_permission4{{$guard4}}" class="custom-control-label font-weight-500">Delete</label><br>
										</div>
									</div>
								</td>
							</tr>
							@endif 
							@php $guard1++;$guard2++;$guard3++;$guard4++; @endphp        
							@endforeach
							@endif  
							@endforeach
						</tbody>
					</table>
				</div>
				<button type="submit" class="btn btn-primary">Save</button>
				<a href="{{ route('admin.role.index') }}" class="btn btn-success"> {{__('Cancel')}}</a>
			</form>
		</div>
	</div>
</div>
<!-- [ content ] End -->
@stop
