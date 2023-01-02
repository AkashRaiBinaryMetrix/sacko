@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.view_employee')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">@lang('message.employee')</a></li>
            <li class="breadcrumb-item active">@lang('message.view_employee')</li>
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
				<h6 class="card-header">@lang('message.employee_details')</Details></h6>
			</div>
			<div class="col-sm-2 text-center">
				<a href="{{ url('admin/employee/edit')}}/{{$employee->id}}" data-size="xl" class="btn btn-primary btn-sm mb-3 btn-round">@lang('message.edit_employee') </a>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered detail-view">
				<tbody>
					<tr>
						<th>@lang('message.employee_id')</th>
						<td>{{ $employee->employee_id }}</td>
					</tr>
					<tr>
						<th>@lang('message.employee_name')</th>
						<td>{{ $employee->full_name }}</td>
					</tr>
					<tr>
						<th>@lang('message.email')</th>
						<td>{{ $employee->email }}</td>
					</tr>
					<tr>
						<th>@lang('message.mobile')</th>
						<td>{{ $employee->mobile }}</td>
					</tr>
					
					<tr>
						<th>@lang('message.employee_type')</th>
						<td>@if($employee->employee_type=='0'){{'TL'}}
							@elseif($employee->employee_type=='1'){{'Manager'}}
							@endif
						</td>
					</tr>
					<!-- <tr>
						<th>@lang('message.assigned_tl_name')</th>
						<td>{{ $employee->teamLead }}</td>
					</tr> -->
					<tr>
						<th>@lang('message.hierarchy_id')</th>
						<td>{{ $employee->hierarchy_id }}</td>
					</tr>
					<tr>
						<th>@lang('message.hierarchy_name')</th>
						<td>{{ $employee->hierarchy_name }}</td>
					</tr>
					<tr>
						<th>@lang('message.contract')</th>
						<td>
							@if($employee->contract=='0'){{ 'High' }}
							@elseif($employee->contract=='1'){{ 'Low' }}
							@endif
						</td>
					</tr>
					<tr>
						<th>@lang('message.gender')</th>
						<td>@if($employee->gender=='1'){{'Male'}}@else{{'Female'}}@endif </td>
					</tr>
					<tr>
						<th>@lang('message.date_of_hiring')</th>
						<td>{{ $employee->date_of_hiring }}</td>
					</tr>
					<tr>
						<th>@lang('message.nationality')</th>
						<td>{{ $employee->nationality }}</td>
					</tr>
					<tr>
						<th>@lang('message.resident')</th>
						<td>{{ $employee->resident }}</td>
					</tr>
					<tr>
						<th>@lang('message.professional_type')</th>
						<td>{{ $employee->professional_type }}</td>
					</tr>
					
					<tr>
						<th>@lang('message.id_reference')</th>
						<td>{{ $employee->id_reference }}</td>
					</tr>
					<tr>
						<th>@lang('message.id_type')</th>
						<td>{{ $employee->id_type->name }}</td>
					</tr>
					<tr>
						<th>@lang('message.id_upload')</th>
						<td>
						@if(!empty($employee['id_upload']))
							<a href="{!! asset($employee['id_upload'])!!}" target="_blank">Click here to View Pdf</a>
						@endif
						</td>
					</tr>
					
					<tr>
						<th>@lang('message.home_address')</th>
						<td>{{ $employee->home_address }}</td>
					</tr>
					<tr>
						<th>@lang('message.country')</th>
						<td>{{ $employee->country->name }}</td>
					</tr>
					<tr>
						<th>@lang('message.state')</th>
						<td>{{ $employee->state->name }}</td>
					</tr>
					<tr>
						<th>@lang('message.city')</th>
						<td>{{ $employee->city->name }}</td>
					</tr>
					<tr>
						<th>@lang('message.status')</th>
						<td>@if($employee->status=='1'){{'Active'}}@else{{'Inactive'}}@endif </td>
					</tr>
					<tr>
						<th>@lang('message.image')</th>
						<td>
						@if(!empty($employee['image']))
							<img src="{!! asset($employee['image'])!!}" width="120">
						@endif
						</td>
					</tr>
					<tr>
						<th>@lang('message.certificate')</th>
						<td>
						@if(!empty($employee['certificate']))
							<a href="{!! asset($employee['certificate'])!!}" target="_blank">Click here to View Pdf</a>
						@endif
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- [ content ] End -->
@endsection