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
            <li class="breadcrumb-item active">Payroll Management / Configure Tax</li>
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
                        	<h6 class="card-header" style="color:blue;">Configure Tax</Details></h6>
                       		<div class="card-body">
                       			<p>NOTE: CNNS is based interval of gross salary</p>
								<div class="form-row">
							    <h5 style="color:blue;">Interval of brut Salary</h5>
								<table id="report-table" class="table table-bordered table-striped mb-0">
								<thead>
									<tr>
										<th>@lang('message.tax_name')</th>
										<th>@lang('message.tax_from')</th>
										<th>@lang('message.tax_to')</th>
										<th>@lang('message.value_calculation')</th>
										<th>@lang('message.action')</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>CNSS OUVRIERE - 0 Value</td>
										<td>-</td>
										<td>440000</td>
										<td>0% Of Salaire brut</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
									<tr>
										<td>CNSS OUVRIERE 0-5%</td>
										<td>441000</td>
										<td>2500000</td>
										<td>5% Of Salaire brut</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
									<tr>
										<td>CNSS OUVRIERE -Fixe</td>
										<td>2501000</td>
										<td>Infinity</td>
										<td>125000</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
								</tbody>
							</table>
							<br/><br/>
							<h5 style="color:blue;margin-top: 10px;">Interval of taxable Salary</h5>
							<table id="report-table" class="table table-bordered table-striped mb-0">
								<thead>
									<tr>
										<th>@lang('message.tax_name')</th>
										<th>@lang('message.tax_from')</th>
										<th>@lang('message.tax_to')</th>
										<th>@lang('message.value_calculation')</th>
										<th>@lang('message.action')</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>RTS1 5%</td>
										<td>-</td>
										<td>999999</td>
										<td>0</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
									<tr>
										<td>RTS1 5%</td>
										<td>1000000</td>
										<td>3000000</td>
										<td>(Salary taxble - 1000000)*5%</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
									<tr>
										<td>RTS1 5%</td>
										<td>3000001</td>
										<td>and above</td>
										<td>2000000 *5%</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
								</tbody>
							</table>


								<table style="margin-top: 25px;" id="report-table" class="table table-bordered table-striped mb-0">
								<thead>
									<tr>
										<th>@lang('message.tax_name')</th>
										<th>@lang('message.tax_from')</th>
										<th>@lang('message.tax_to')</th>
										<th>@lang('message.value_calculation')</th>
										<th>@lang('message.action')</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>RTS2 8%</td>
										<td>-</td>
										<td>2999999</td>
										<td>0</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
									<tr>
										<td>RTS2 8%</td>
										<td>3000000</td>
										<td>5000000</td>
										<td>(Salary taxble - 3000000)*8%</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
									<tr>
										<td>RTS2 8%</td>
										<td>10000001</td>
										<td>and above</td>
										<td>5000000 *10%</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
								</tbody>
							</table><br/>


							<table style="margin-top: 25px;" id="report-table" class="table table-bordered table-striped mb-0">
								<thead>
									<tr>
										<th>@lang('message.tax_name')</th>
										<th>@lang('message.tax_from')</th>
										<th>@lang('message.tax_to')</th>
										<th>@lang('message.value_calculation')</th>
										<th>@lang('message.action')</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>RTS3 10%</td>
										<td>-</td>
										<td>4999999</td>
										<td>0</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
									<tr>
										<td>RTS3 10%</td>
										<td>5000000</td>
										<td>10000000</td>
										<td>(Salary taxble - 5000000)*10%</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
									<tr>
										<td>RTS3 10%</td>
										<td>10000001</td>
										<td>and above</td>
										<td>5000000 *10%</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
								</tbody>
							</table><br/>

								<table style="margin-top: 25px;" id="report-table" class="table table-bordered table-striped mb-0">
								<thead>
									<tr>
										<th>@lang('message.tax_name')</th>
										<th>@lang('message.tax_from')</th>
										<th>@lang('message.tax_to')</th>
										<th>@lang('message.value_calculation')</th>
										<th>@lang('message.action')</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>RTS4 15%</td>
										<td>-</td>
										<td>9999999</td>
										<td>0</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
									<tr>
										<td>RTS4 15%</td>
										<td>10000000</td>
										<td>20000000</td>
										<td>(Salary taxble - 10000000)*15%</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
									<tr>
										<td>RTS4 15%</td>
										<td>20000001</td>
										<td>and above</td>
										<td>10000000 *15%</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
								</tbody>
							</table><br/>

								<table style="margin-top: 25px;" id="report-table" class="table table-bordered table-striped mb-0">
								<thead>
									<tr>
										<th>@lang('message.tax_name')</th>
										<th>@lang('message.tax_from')</th>
										<th>@lang('message.tax_to')</th>
										<th>@lang('message.value_calculation')</th>
										<th>@lang('message.action')</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>RTS5 20%</td>
										<td>-</td>
										<td>20000000</td>
										<td>(Salary taxble - 10000000)*15%</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
									<tr>
										<td>RTS5 20%</td>
										<td>20000001</td>
										<td>and above</td>
										<td>(Salary taxble - 200000000)*20%</td>
 									 	<td><i class="feather icon-edit" title="Edit"></i></td>
									</tr>
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