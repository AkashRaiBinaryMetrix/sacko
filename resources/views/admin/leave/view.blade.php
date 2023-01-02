@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.view_leave')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.leave.index') }}">@lang('message.leave')</a></li>
            <li class="breadcrumb-item active">@lang('message.view_leave')</li>
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
				<h6 class="card-header">@lang('message.leave_details')</Details></h6>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered detail-view">
				<tbody>
                    <tr>
                        <th width="20%">@lang('message.employee_id')</th>
                        <td>{{ $leave->employee_id }}</td>
                    </tr>
                    
                    <tr>
                        <th>@lang('message.employee_name')</th>
                        <td>{{ $leave->user_name }}</td>
                    </tr>
                    
                    <tr>
                        <th>@lang('message.leave_type')</th>
                        <td>{{ @$leave->leave_type->name }}</td>
                    </tr>
                    <tr>
                        <th>@lang('message.from_date')</th>
                        <td>{{date("d M, y",strtotime($leave->from_date))}}</td>
                    </tr>
                    <tr>
                        <th>@lang('message.to_date')</th>
                        <td>{{date("d M, y",strtotime($leave->to_date))}}</td>
                    </tr>
                    <tr>
                        <th>@lang('message.approved_by')</th>
                        <td>
                            @if($leave->status=='2')
                            {{ $leave->tl_name }}
                            @else
                            {{ $leave->test }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('message.rejected_by')</th>
                        <td>
                            @if($leave->status=='3')
                            {{ $leave->tl_name }}
                            @else
                            {{ $leave->test }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('message.reason')</th>
                        <td>{{ $leave->description }}</td>
                    </tr>
                    <tr>
                        <th>@lang('message.status')</th>
                        <td>
                            @if($leave->status=='1')<span class="badge badge-warning">{{'Pending'}}</span>
                            @elseif($leave->status=='2')<span class="badge badge-success">{{'Approved'}}</span>
                            @elseif($leave->status=='3')<span class="badge badge-danger">{{'Rejected'}}</span>
                            @endif 
                        </td>
                    </tr>
                    
                    <tr>
                        <th>@lang('message.applied_date')</th>
                        <td>{{date("d M, y",strtotime($leave->created_at))}}</td>
                    </tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection