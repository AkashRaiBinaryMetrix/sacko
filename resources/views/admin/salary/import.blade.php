@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.import_salary')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.salary.index') }}">@lang('message.import_salary')</a></li>
            <li class="breadcrumb-item active">@lang('message.import_salary')</li>
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
                    	<form role="form" action="{{ url('admin/salary/import_store') }}" method="POST" enctype="multipart/form-data" autocomplete="off"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<h6 class="card-header">@lang('message.salary_details')</Details></h6>
                       		<div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
										<label class="form-label">@lang('message.excel') <span class="text-danger">*</span></label>
										<input type="file" name="file" class="form-control" id="file">
                                        @if($errors->has('document'))
                                        <div class="text-danger">{{ $errors->first('document') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
                                    <div class="raj">
                                        <p>Download for Sample <br>
                                        <a href="{{ asset('assets/import/salary.xlsx') }}" download="salary"c lass="btn btn-info">Download</a>
                                        </p>
                                    </div>
                                </div>
								<div class="text-right mt-3">
									<button type="submit" class="btn btn-primary">@lang('message.import') </button>&nbsp;
									<a href="{{route('admin.salary.index');}}"  class="btn btn-default">Cancel</a>
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