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
            <li class="breadcrumb-item active">Payroll Management / Edit Holidays</li>
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
                  <form role="form" action="{{ route('admin.manage.updateholiday') }}" method="POST"> 
                        	
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							<input type="hidden" name="record_id" value="{{$holiday_list[0]->id}}">
	                        	
                        	<h6 class="card-header" style="color:blue;">Configure Holidays</Details></h6>
                       		<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Select Date</label>
										<input value="{{$holiday_list[0]->date_selection}}" type="date" class="form-control mb-1"  name="date_selection" id="datepicker" value="{{old('date_select')}}">
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Holiday Name/Purpose</label>
										<input value="{{$holiday_list[0]->holiday_name}}" type="text" class="form-control mb-1"  name="holiday_name" id="holiday_name" value="{{old('holiday_name')}}">
										@if($errors->has('holiday_name'))
                                        <div class="text-danger">{{ $errors->first('holiday_name') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Status</label>
										<select class="form-control mb-1"  name="holiday_status" id="holiday_status" >
											<option value="Active" {{($holiday_list[0]->holiday_status == 'Active') ? 'selected':''}}>Active</option>
											<option value="In-Active" {{($holiday_list[0]->holiday_status == 'In-Active') ? 'selected':''}}>In-Active</option>
										</select>
										@if($errors->has('holiday_status'))
                                        <div class="text-danger">{{ $errors->first('holiday_status') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6" style="visibility: hidden;">
										<label class="form-label">Applicable For</label>
										<input type="text" class="form-control mb-1"  name="applicable_for" id="applicable_for" value="{{old('applicable_for')}}">
										@if($errors->has('holiday_name'))
                                        <div class="text-danger">{{ $errors->first('holiday_name') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Applicable employees categories</label>
										<br/><br/>
										@foreach($categories as $result)
											@php
												$employee_category = $holiday_list[0]->employee_category;
											@endphp
										<input type='checkbox' name='employee_category[]' id='employee_category' value='{{$result->id}}' {{(strpos($holiday_list[0]->employee_category,$result->id) !== false) ? 'checked':''}}/>
										<label for='sales'>{{$result->name}}</label>
										<br/>
										@endforeach

										@if($errors->has('holiday_name'))
                                        <div class="text-danger">{{ $errors->first('holiday_name') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
							</div>
								
							<div class="text-right mt-3">
									<button name="btnsubmit" type="submit" class="btn btn-primary">Update</button>&nbsp;
									<a href="{{ route('admin.menu.index') }}" class="btn btn-default">Cancel</a>
							</div>
							<div class="clearfix"></div>
                        	</div>
                     	</form>
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