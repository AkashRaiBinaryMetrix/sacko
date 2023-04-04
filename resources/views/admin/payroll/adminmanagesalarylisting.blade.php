@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">Payroll Management</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Module</a></li>
            <li class="breadcrumb-item active">Payroll Management / Holiday Listing</li>
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
                        	<h6 class="card-header" style="color:blue;">Holiday Listing</Details></h6>
                       		<div class="card-body" style="position: relative; overflow: auto">
								<div class="form-row">
								<table id="report-table" class="table table-bordered table-striped mb-0">
								<thead>
									<tr>
										<th>@lang('message.employee_name')</th>
										<th>@lang('message.employee_id')</th>
										<th>@lang('message.Project_Id')</th>
										<th>@lang('message.Proposed_Salary')</th>
										<th>@lang('message.Local_Currency')</th>
										<th>@lang('message.Employee_Rate')</th>
										<th>@lang('message.Monthly_Hour')</th>
										<th>@lang('message.Hourly_Rate')</th>
										<th>@lang('message.Basic_Salary')</th>
										<th>@lang('message.Primary_Bonus')</th>
										<th>@lang('message.Prime_de')</th>
										<th>@lang('message.action')</th>
									</tr>
								</thead>
								<tbody>
									@foreach($salaryList as $result)
									<tr>
										<td>
											@php
												$empName = DB::table('users')->where('id','=',$result->emp_name)->get();
											@endphp
											{{$empName[0]->first_name}} {{$empName[0]->last_name}}
										</td>
										<td>{{$result->emp_id}}</td>
										<td>
											@php
												$projectName = DB::table('projects')->where('id','=',$result->project_id)->get();
											@endphp
											{{$projectName[0]->title}}
										</td>
										<td>{{$result->proposed_salary}}</td>
										<td>{{$result->currency}}</td>
										<td>{{$result->employee_rate}}</td>
										<td>{{$result->monthly_hour}}</td>
										<td>{{$result->hourly_hour}}</td>
										<td>{{$result->basic_salary}}</td>
										<td>{{$result->prime_sal}}</td>
										<td>{{$result->prime_rent}}</td>
 									 	<td>
 									 		<i class="feather icon-edit" title="Edit"></i>
 									 		<i class="feather icon-delete" title="Active/In-Active"></i>
 									 		<img title="Generate Payroll" src="https://cdn-icons-png.flaticon.com/512/337/337946.png" style="width:24px;height: 23px;">
 									 	</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							
							</div>	
							</div>
							<div class="clearfix"></div>
                        	</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
			$(document).ready(function() {
				$('#country-dropdown').on('change', function() {
					var country_id = this.value;
					$("#state-dropdown").html('');
					$.ajax({
						url:"{{route('admin.employee.fetchState')}}",
						type: "POST",
						data: {
							country_id: country_id,
							_token: '{{csrf_token()}}' 
						},
						dataType : 'json',
						success: function(result){
							$('#state-dropdown').html('<option value="">Select State</option>'); 
							$.each(result.states,function(key,value){

								$("#state-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
							});
							$('#city-dropdown').html('<option value="">Select State First</option>'); 
							}
						});
					});    
					$('#state-dropdown').on('change', function() {
						var state_id = this.value;
						$("#city-dropdown").html('');
						$.ajax({
							url:"{{route('admin.employee.fetchCity')}}",
							type: "POST",
							data: {
								state_id: state_id,
								_token: '{{csrf_token()}}' 
							},
							dataType : 'json',
							success: function(result){
								$('#city-dropdown').html('<option value="">Select City</option>'); 
								$.each(result.cities,function(key,value){
									$("#city-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
							});
						}
					});
				});
			});
</script>
<!-- [ content ] End -->
@endsection