@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0">Account settings</h4>
        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Users</a></li>
                <li class="breadcrumb-item active">Account settings</li>
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
        <!-- Header -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-auto col-sm-12">
                        <img src="{!! asset(Auth::user()->image)!!}" alt="" class="d-block ui-w-100 rounded-circle mb-3">
                    </div>
                    <div class="col">
                        <h4 class="font-weight-bold mb-4">{{Auth::user()->name}}</h4>
                        <div class="text-muted mb-4">
                        {{Auth::user()->email}}</br>
                        {{Auth::user()->mobile}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header -->           
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change Password</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="account-general">
                        <form role="form" action="{{ url('admin/user/updateprofile')}}" method="POST" enctype="multipart/form-data"> 
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h6 class="card-header">User Profile Details</h6>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control mb-1" name="first_name" required value="{{Auth::user()->first_name}}">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" class="form-control mb-1" name="middle_name" value="{{Auth::user()->middle_name}}">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control mb-1" name="last_name" required value="{{Auth::user()->last_name}}">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control mb-1" name="email" required value="{{Auth::user()->email}}" >
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mobile</label>
                                    <input type="text" class="form-control" name="mobile" value="{{Auth::user()->mobile}}" required>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <div class="media-body">
                                        <label class="btn btn-outline-primary">
                                            Upload new photo
                                            <input type="file" name="image" accept="image/*" class="account-settings-fileinput" data-filename="profiles">
                                        </label> &nbsp;
                                        <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Save </button>&nbsp;
                                    <a href="{{route('admin.dashboard');}}"  class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                        <form role="form" action="{{ url('admin/user/change-password') }}" method="POST" enctype="multipart/form-data" autocomplete="off"> 
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h6 class="card-header">User Password Details</h6>
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">New password</label>
                                    <input type="password" name="password" class="form-control" required>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Save </button>&nbsp;
                                    <a href="{{route('admin.dashboard');}}"  class="btn btn-default">Cancel</a>
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
</div>
@endsection