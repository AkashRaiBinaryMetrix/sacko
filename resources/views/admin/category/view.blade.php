@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.view_category')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">@lang('message.category')</a></li>
            <li class="breadcrumb-item active">@lang('message.view_category')</li>
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
    <div class="card mb-4">
		<div class="row align-items-center m-l-0">
			<div class="col-sm-10 text-left">
				<h6 class="card-header">@lang('message.category_details')</Details></h6>
			</div>
			<div class="col-sm-2 text-center">
				<a href="{{ url('admin/category/edit')}}/{{$category->id}}" data-size="xl" class="btn btn-primary btn-sm mb-3 btn-round">@lang('message.edit_category') </a>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered detail-view">
				<tbody>
					<tr>
						<th>@lang('message.category_name')</th>
						<td>{{ $category->name }}</td>
					</tr>
					
					<tr>
						<th>Status:</th>
						<td>@if($category->status=='1'){{'Active'}}@else{{'Inactive'}}@endif </td>
					</tr>
					<tr>
                        <th>@lang('message.created_at')</th>
                        <td>{{date("d M, y",strtotime($category->created_at))}}</td>
                    </tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- [ content ] End -->
@endsection