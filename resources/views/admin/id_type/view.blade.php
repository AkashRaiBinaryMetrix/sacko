@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.view_id_type')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.id_type.index') }}">@lang('message.id_type')</a></li>
            <li class="breadcrumb-item active">@lang('message.view_id_type')</li>
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
				<h6 class="card-header">@lang('message.id_type_details')</Details></h6>
			</div>
			<div class="col-sm-2 text-center">
				<a href="{{ url('admin/id_type/edit')}}/{{$id_type->id}}" data-size="xl" class="btn btn-primary btn-sm mb-3 btn-round">@lang('message.edit_id_type') </a>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered detail-view">
				<tbody>
					<tr>
						<th>@lang('message.id_type')</th>
						<td>{{ $id_type->name }}</td>
					</tr>
					
					<tr>
						<th>Status:</th>
						<td>@if($id_type->status=='1'){{'Active'}}@else{{'Inactive'}}@endif </td>
					</tr>
					<!-- <tr>
						<th>@lang('message.image')</th>
						<td>
						@if(!empty($id_type['image']))
							<img src="{!! asset($id_type['image'])!!}" width="120">
						@endif
						</td>
					</tr> -->
					<tr>
                        <th>@lang('message.created_at')</th>
                        <td>{{date("d M, y",strtotime($id_type->created_at))}}</td>
                    </tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- [ content ] End -->
@endsection