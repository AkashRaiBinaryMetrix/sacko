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
            <li class="breadcrumb-item active">Payroll Management / Manage Advance Salary</li>
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
                    	<form role="form" action="{{ route('admin.manage.updateadvancepayment') }}" method="POST" enctype="multipart/form-data"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<input type="hidden" name="payment_id" value="{{$advance_payment_list[0]->id}}">
                        	<h6 class="card-header" style="color:blue;">Manage Advance Salary</Details></h6>
                       		<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Project Id</label>
										<select disabled class="form-control mb-1"  name="project_id" id="datepicker">
											<option>Select</option>
											@foreach($projectList as $result)
												<option value="{{$result->id}}" {{ $result->id == $advance_payment_list[0]->project_id ? 'selected' : '' }}>{{$result->title}}</option>
											@endforeach
										</select>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Category</label>
											<select disabled id="category-dropdown" class="form-control select2 select2-accessible" name="category_id" >                       
											<option value='' selected >Select</option>
											@if ($categories->count())
												@foreach($categories as $val)
	<option value='{{$val->id}}' {{ $val->id == $advance_payment_list[0]->category_id ? 'selected' : '' }}>{{$val->name}}</option>  
												@endforeach 
											@endif             
										</select>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>

									<div class="form-group col-md-6">
											<label class="form-label">@lang('message.subcategory_title')<span class="text-danger">*</span></label>
											<select disabled id="sub-dropdown" class="form-control" name="sub_category_id">
												<option value='' selected >Select</option>
												@foreach($sub_categories as $val)
	<option value='{{$val->id}}' {{ $val->id == $advance_payment_list[0]->sub_category_id ? 'selected' : '' }}>{{$val->name}}</option>  
												@endforeach 
										    </select>
											@if($errors->has('state_id'))
	                                        <div class="text-danger">{{ $errors->first('state_id') }}</div>
	                                        @endif
											<div class="clearfix"></div>
									</div>

									<div class="form-group col-md-6">
											<label class="form-label">Employee Name<span class="text-danger">*</span></label>
											<select disabled id="employee_name_fill" class="form-control" name="employee_name_fill">
												<option value='' selected >Select</option>
												@foreach($employeeList as $val)
	<option value='{{$val->id}}' {{ $val->id == $advance_payment_list[0]->emp_id ? 'selected' : '' }}>{{$val->first_name}} {{$val->last_name}}</option>  
												@endforeach 
										    </select>
											<div class="clearfix"></div>
									</div>
										
									<div class="form-group col-md-6" style="display: none;">
										<label class="form-label">Proposed Salary($)</label>
										<input type="number" class="form-control mb-1"  name="proposed_salary" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Local Currency</label>
										<select disabled class="form-control mb-1" name="currency" id="datepicker">
											<option value="GNF" selected>GNF</option>
										</select>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
								    </div>
								    <div class="form-group col-md-6" style="display:none;">
										<label class="form-label">Employee Rate</label>
										<input type="text" class="form-control mb-1"  name="employee_rate" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6" style="display:none;">
										<label class="form-label">Monthly Hour</label>
										<input type="text" class="form-control mb-1"  name="monthly_hour" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6" style="display:none;">
										<label class="form-label">Hourly rate (USD)</label>
										<input type="text" class="form-control mb-1"  name="hourly_hour" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Payment(GNF)</label>
										<input  type="text" class="form-control mb-1"  name="basic_salary" id="datepicker" value="{{$advance_payment_list[0]->basic_salary}}" />
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6" style="visibility:hidden;">
										<label class="form-label">Prime d'ancienneté</label>
										<input type="text" class="form-control mb-1"  name="prime_sal" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6" style="visibility:hidden;">
										<label class="form-label">Prime de rendement</label>
										<input type="text" class="form-control mb-1"  name="prime_rent" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
							</div>
							<div class="text-right mt-3">
									<button type="submit" name="btnSubmit" class="btn btn-primary">Update</button>
									&nbsp;
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
<!-- [ content ] End -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
			$('#category-dropdown').on('change', function() {
				//alert('HIi');
				var idCategory = this.value;
				$("#sub-dropdown").html('');
				$.ajax({
					url:"{{url('admin/subcategory-by-category')}}",
					type: "POST",
					data: {
						category_id: idCategory,
						_token: '{{csrf_token()}}'
					},
					dataType : 'json',
					success: function(result){
						$('#sub-dropdown').html('<option value="">Select Sub Category</option>'); 
						$.each(result.subCategory, function(key, value){
							$("#sub-dropdown").append('<option value="' + value
						.id + '">' + value.name + '</option>');
					});
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
			$('#sub-dropdown').on('change', function() {
				//alert('HIi');
				var idCategory = this.value;
				$("#employee_name_fill").html('');
				$.ajax({
					url:"{{url('admin/group-by-category-subcat')}}",
					type: "POST",
					data: {
						category_id: $('#category-dropdown').val(),
						subcategory_id: idCategory,
						project_id:$("#datepicker").val(),
						_token: '{{csrf_token()}}'
					},
					dataType : 'json',
					success: function(result){
						$('#employee_name_fill').html('<option value="">Select Employee</option>'); 
						$.each(result.subCategory, function(key, value){
							$("#employee_name_fill").append('<option value="' + value
						.id + '">' + value.first_name + '</option>');
					});
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
			$('#group-dropdown').on('change', function() {
				var idCategory = this.value;
				$("#shift-dropdown").html('');
				$.ajax({
					url:"{{url('admin/shift-group-by-category-subcat')}}",
					type: "POST",
					data: {
						category_id: $('#category-dropdown').val(),
						sub_category_id: $('#sub-dropdown').val(),
						group_id: idCategory,
						_token: '{{csrf_token()}}'
					},
					dataType : 'json',
					success: function(result){
						$('#shift-dropdown').html('<option value="">Select Shift</option>'); 
						$.each(result.subCategory, function(key, value){
							$("#shift-dropdown").append('<option value="' + value
						.id + '">' + value.shift_title + '</option>');
					});
				}
			});
		});
	});
</script>
@endsection