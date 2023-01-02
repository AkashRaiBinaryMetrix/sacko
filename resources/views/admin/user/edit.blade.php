@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">User Update</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Users</a></li>
            <li class="breadcrumb-item active">User Update</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6">
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
                    <form role="form" action="{{ url('admin/user/update',$user->id) }}" method="POST" enctype="multipart/form-data"> 
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h6 class="card-header">User Details</h6>
                        	<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.first_name')<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="first_name" placeholder="First Name" required value="{{old('first_name',$user->first_name)}}">
                                        @if($errors->has('first_name'))
                                        <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.middle_name') </label>
										<input type="text"  class="form-control" name="middle_name" placeholder="Middle Name"  value="{{old('middle_name',$user->middle_name)}}">
                                        @if($errors->has('middle_name'))
                                        <div class="text-danger">{{ $errors->first('middle_name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									 </div>
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.last_name')<span class="text-danger">*</span> </label>
										<input type="text"  class="form-control" name="last_name" placeholder="Middle Name" required value="{{old('last_name',$user->last_name)}}">
                                        @if($errors->has('last_name'))
                                        <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>									
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.email')</label>	
										<input type="email" class="form-control" name="email" placeholder="Enter Official Mail ID" value="{{old('email',$user->email)}}" >
										@if($errors->has('email'))
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.password')  (Keep blank for no change password)</label>
										<input type="password" class="form-control" name="password" value="{{old('password')}}" >
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.mobile')<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="mobile" placeholder="Employee Mobile" required value="{{old('mobile',$user->mobile)}}">
                                        @if($errors->has('mobile'))
                                        <div class="text-danger">{{ $errors->first('mobile') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Role</label>
										<select class="form-control select2 select2-hidden-accessible" name="role" required>                       
											<option value='' selected >Select</option>
											@foreach($role as $val)
											<option value='{{$val->id}}' @if(old('role',$user->role_id)==$val->id){{'selected="true"'}}@endif>{{$val->name}}</option>         
											@endforeach              
										</select> 
										<div class="clearfix"></div>
                                	</div>
								</div>
								
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.status') <span class="text-danger">*</span></label>
										<select class="form-control select2 select2-hidden-accessible" name="status" required>                       
											<option value='1' @if(old('status',$user->status)=='1'){{'selected="true"'}}@endif>Active</option>
											<option value='0' @if(old('status',$user->status)=='0'){{'selected="true"'}}@endif>Inactive</option>                       
										</select> 
                                        @if($errors->has('status'))
										<label class="form-label">Status <span class="text-danger">*</span></label>
                                        <div class="text-danger">{{ $errors->first('status') }}</div>
                                        @endif
									 	<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.gender')<span class="text-danger">*</span> </label>
										<select class="form-control select2 select2-hidden-accessible" name="gender" required>                       
											<option value=''>Select</option>	
											<option value='1' @if(old('gender',$user->gender)=='1'){{'selected="true"'}}@endif>Male</option>
											<option value='0' @if(old('gender',$user->gender)=='0'){{'selected="true"'}}@endif>Female</option>
										</select>
										@if($errors->has('gender'))
                                        <div class="text-danger">{{ $errors->first('gender') }}</div>
                                        @endif
										<div class="clearfix"></div>
									 </div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.image') <span class="text-danger">*</span></label>
										<input type="file" name="image"  class="form-control" id="image">
                                        @if($errors->has('image'))
                                        <div class="text-danger">{{ $errors->first('image') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
								
                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary">Save</button>&nbsp;
                                <a href="{{route('admin.user.index');}}"  class="btn btn-default">Cancel</a>
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