@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.view_incentive')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.incentive.index') }}">@lang('message.incentive')</a></li>
            <li class="breadcrumb-item active">@lang('message.view_incentive')</li>
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
				<h6 class="card-header">@lang('message.incentive_details')</Details></h6>
			</div>
			
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered detail-view">
				<tbody>
					<tr>
						<th>@lang('message.employee_id')</th>
						<td>{{ $incentive->employee_id }}</td>
					</tr>
					
					<tr>
						<th>@lang('message.team_leader')</th>
						<td>{{ $incentive->tl_name }}</td>
					</tr>

					<tr>
						<th>@lang('message.contact_no')</th>
						<td>{{ $incentive->mobile }}</td>
					</tr>

					<tr>
						<th>@lang('message.designation')</th>
						<td>{{ $incentive->designation }}</td>
					</tr>

					<tr>
						<th>@lang('message.trade')</th>
						<td>{{ $incentive->trade }}</td>
					</tr>

					<tr>
						<th>@lang('message.doj')</th>
						<td>{{ $incentive->doj }}</td>
					</tr>

					<tr>
						<th>@lang('message.lwd')</th>
						<td>{{ $incentive->lwd }}</td>
					</tr>

					<tr>
						<th>@lang('message.state')</th>
						<td>{{ $incentive->state_name }}</td>
					</tr>

					<tr>
						<th>@lang('message.city')</th>
						<td>{{ $incentive->city_name }}</td>
					</tr>

					<tr>
						<th>@lang('message.address')</th>
						<td>{{ $incentive->address }}</td>
					</tr>

					<tr>
						<th>@lang('message.product_id')</th>
						<td>{{ $incentive->product_id }}</td>
					</tr>

					<tr>
						<th>@lang('message.product_name')</th>
						<td>{{ $incentive->product_name }}</td>
					</tr>
					
					<tr>
						<th>@lang('message.quantity')</th>
						<td>{{ $incentive->quantity }}</td>
					</tr>

					<tr>
						<th>@lang('message.final_approved')</th>
						<td>{{ $incentive->gift }}</td>
					</tr>
					
					<tr>
						<th>@lang('message.gift')</th>
                        <td>{{date("d M, y",strtotime($incentive->created_at))}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- [ content ] End -->
@endsection