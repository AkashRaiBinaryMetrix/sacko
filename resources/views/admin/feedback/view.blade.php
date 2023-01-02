@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang(' View Feedback')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.feedback.index') }}">@lang('Feedback')</a></li>
            <li class="breadcrumb-item active">@lang('Feedback Details')</li>
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
				<h6 class="card-header">@lang('View Feedback Report')</Details></h6>
			</div>
			
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered detail-view">
				<tbody>
					<tr>
						<th>@lang('Employee Name')</th>
						<td>{{ $feedbacks->username }}</td>
					</tr>

					<tr>
						<th>@lang('Feedback Type')</th>
						<td>{{ $feedbacks->feedback_type }}</td>
					</tr>

					<tr>
						<th>@lang('Description')</th>
						<td>{{ $feedbacks->description }}</td>
					</tr>

					<tr>
						<th>@lang('Document')</th>
						<td>
						@if(!empty($feedbacks['document']))
							<a href="{!! asset($feedbacks['document'])!!}" target="_blank">Click here to View Pdf</a>
						@endif
						</td>
					</tr>
					
					<tr>
						<th>@lang('Date')</th>
                        <td>{{date("d M, y",strtotime($feedbacks->created_at))}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- [ content ] End -->
@endsection