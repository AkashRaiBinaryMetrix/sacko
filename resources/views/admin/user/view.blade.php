@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.view_user')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">@lang('message.user')</a></li>
            <li class="breadcrumb-item active">@lang('message.view_user')</li>
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
				<h6 class="card-header">@lang('message.user_details')</Details></h6>
			</div>
			<div class="col-sm-2 text-center">
				<a href="{{ url('admin/user/edit')}}/{{$user->id}}" data-size="xl" class="btn btn-primary btn-sm mb-3 btn-round">@lang('message.edit_user') </a>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered detail-view">
				<tbody>
					<tr>
						<th>@lang('message.employee_id')</th>
						<td>{{ $user->employee_id }}</td>
					</tr>
					<tr>
						<th>@lang('message.user_name')</th>
						<td>{{ $user->name }}</td>
					</tr>
					<tr>
						<th>@lang('message.official_email')</th>
						<td>{{ $user->email }}</td>
					</tr>
					<tr>
						<th>@lang('message.mobile')</th>
						<td>{{ $user->mobile }}</td>
					</tr>
					<tr>
						<th>@lang('message.personal_email')</th>
						<td>{{ $user->personal_email }}</td>
					</tr>
					<tr>
						<th>@lang('message.employee_type')</th>
						<td>@if($user->employee_type=='0'){{'ISD'}}
							@elseif($user->employee_type=='1'){{'RSO'}}
							@elseif($user->employee_type=='2'){{'TL'}}
							@elseif($user->employee_type=='3'){{'RPT/BPT'}}
							@elseif($user->employee_type=='4'){{'BSSO'}}
							@elseif($user->employee_type=='5'){{'BM'}}
							@elseif($user->employee_type=='6'){{'Employee'}}
							@endif
						</td>
					</tr>
					
					<tr>
						<th>@lang('message.region')</th>
						<td>{{ $user->region }}</td>
					</tr>
					<tr>
						<th>@lang('message.branch')</th>
						<td>{{ $user->branch }}</td>
					</tr>
					<tr>
						<th>@lang('message.trade')</th>
						<td>{{ $user->trade }}</td>
					</tr>
					<tr>
						<th>@lang('message.doj')</th>
						<td>{{ $user->doj }}</td>
					</tr>
					<tr>
						<th>@lang('message.dob')</th>
						<td>{{ $user->dob }}</td>
					</tr>
					<tr>
						<th>@lang('message.gender')</th>
						<td>@if($user->gender=='1'){{'Male'}}@else{{'Female'}}@endif </td>
					</tr>
					<tr>
						<th>@lang('message.blood_group')</th>
						<td>{{ $user->blood_group }}</td>
					</tr>
					<tr>
						<th>@lang('message.qualification')</th>
						<td>{{ $user->qualification }}</td>
					</tr>
					<tr>
						<th>@lang('message.experience')</th>
						<td>{{ $user->experience }}</td>
					</tr>
					<tr>
						<th>@lang('message.lwd')</th>
						<td>{{ $user->lwd }}</td>
					</tr>
					<tr>
						<th>@lang('message.uan_no')</th>
						<td>{{ $user->uan_no }}</td>
					</tr>
					<tr>
						<th>@lang('message.pf_no')</th>
						<td>{{ $user->pf_no }}</td>
					</tr>
					<tr>
						<th>@lang('message.esic_no')</th>
						<td>{{ $user->esic_no }}</td>
					</tr>
					<tr>
						<th>@lang('message.aadhar_no')</th>
						<td>{{ $user->aadhar_no }}</td>
					</tr>
					<tr>
						<th>@lang('message.account_no')</th>
						<td>{{ $user->account_no }}</td>
					</tr>
					<tr>
						<th>@lang('message.bank_name')</th>
						<td>{{ $user->bank_name }}</td>
					</tr>
					<tr>
						<th>@lang('message.ifsc_code')</th>
						<td>{{ $user->ifsc_code }}</td>
					</tr>
					<tr>
						<th>@lang('message.pan_no')</th>
						<td>{{ $user->pan_no }}</td>
					</tr>
					<tr>
						<th>@lang('message.father_name')</th>
						<td>{{ $user->father_name }}</td>
					</tr>
					<tr>
						<th>@lang('message.marrital_status')</th>
						<td>@if($user->marrital_status=='0'){{'No'}}@else{{'Yes'}}@endif</td>
					</tr>
					<tr>
						<th>@lang('message.permanent_address')</th>
						<td>{{ $user->permanent_address }}</td>
					</tr>
					<tr>
						<th>@lang('message.correspondance_address')</th>
						<td>{{ $user->correspondance_address }}</td>
					</tr>
					<tr>
						<th>@lang('message.emergency')</th>
						<td>{{ $user->emergency }}</td>
					</tr>
					<tr>
						<th>@lang('message.country')</th>
						<td>{{ $user->country->name }}</td>
					</tr>
					<tr>
						<th>@lang('message.state')</th>
						<td>{{ $user->state->name }}</td>
					</tr>
					<tr>
						<th>@lang('message.city')</th>
						<td>{{ $user->city->name }}</td>
					</tr>
					<tr>
						<th>Status:</th>
						<td>@if($user->status=='1'){{'Active'}}@else{{'Inactive'}}@endif </td>
					</tr>
					<tr>
						<th>@lang('message.image')</th>
						<td>
						@if(!empty($user['image']))
							<img src="{!! asset($user['image'])!!}" width="120">
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