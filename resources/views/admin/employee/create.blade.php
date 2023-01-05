@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.create_employee')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">@lang('message.employee')</a></li>
            <li class="breadcrumb-item active">@lang('message.create_employee')</li>
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
                    	<form role="form" action="{{ url('admin/employee/store') }}" method="POST" enctype="multipart/form-data" autocomplete="off"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<h6 class="card-header">@lang('message.employee_details')</Details></h6>
                       		<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.first_name')<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="first_name" placeholder="First Name" required value="{{old('first_name')}}">
                                        @if($errors->has('first_name'))
                                        <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.middle_name') </label>
										<input type="text"  class="form-control" name="middle_name" placeholder="Middle Name" value="{{old('middle_name')}}">
                                        @if($errors->has('middle_name'))
                                        <div class="text-danger">{{ $errors->first('middle_name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									 </div>
									 <div class="form-group col-md-4">
										<label class="form-label">@lang('message.last_name')<span class="text-danger">*</span> </label>
										<input type="text"  class="form-control" name="last_name" placeholder="Last Name" required value="{{old('last_name')}}">
                                        @if($errors->has('last_name'))
                                        <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									 </div>
								 </div>
								 <div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.email')<span class="text-danger">*</span></label>	
										<input type="email" class="form-control" name="email" placeholder="Enter Mail ID" value="{{old('email')}}" >
										@if($errors->has('email'))
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.password')<span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="password" placeholder="Enter Password" required value="{{old('password')}}">
                                        @if($errors->has('password'))
                                        <div class="text-danger">{{ $errors->first('password') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.mobile')<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="mobile" placeholder="Employee Mobile" required value="{{old('mobile')}}">
                                        @if($errors->has('mobile'))
                                        <div class="text-danger">{{ $errors->first('mobile') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.department')<span class="text-danger">*</span> </label>
										<select id="department-dropdown" class="form-control" name="department_id" required value="{{old('department_id')}}">
											<option value="">Select</option>
											@if ($department->count())
												@foreach ($department as $val)
													<option value="{{ $val->id }}">{{ $val->name }}</option>
												@endforeach
											@endif
										</select>
                                        @if($errors->has('department_id'))
                                        <div class="text-danger">{{ $errors->first('department_id') }}</div>
                                        @endif
										<div class="clearfix"></div>
									 </div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.hierarchy_name') </label>
										<select id="hierarchy-dropdown" class="form-control" name="hierarchy_name" >
											<option value="">Select</option>
										</select>
										@if($errors->has('hierarchy_name'))
                                        <div class="text-danger">{{ $errors->first('hierarchy_name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.hierarchy_id') </label>
										<select class="form-control select2 select2-hidden-accessible" name="hierarchy_id">                       
										</select>
										@if($errors->has('hierarchy_id'))
                                        	<div class="text-danger">{{ $errors->first('hierarchy_id') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.employee_type')<span class="text-danger">*</span></label>
										<select class="form-control select2 select2-hidden-accessible" name="employee_type" required>                       
											<option value=''>Select</option>	
											<option value='0'>@lang('message.tl')</option>
											<option value='1'>@lang('message.manager')</option>
										</select>
										@if($errors->has('employee_type'))
                                        <div class="text-danger">{{ $errors->first('employee_type') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.contract')</label>
										<select class="form-control select2 select2-hidden-accessible" name="gender" required>                       
											<option value=''>Select</option>	
											<option value='1'>Month</option>
											<option value='0'>Year</option>                       
										</select>
										@if($errors->has('contract'))
                                        <div class="text-danger">{{ $errors->first('contract') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								 </div>
								
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.category') <span class="text-danger">*</span> </label>
										<select id="category-dropdown" class="form-control select2 select2-accessible" name="category_id" >                       
											<option value='' selected >Select</option>
											@if ($category->count())
												@foreach($category as $val)
													<option value='{{$val->id}}' @if(old('category_id')==$val->id){{'selected="true"'}}@endif>{{$val->name}}</option>  
												@endforeach 
											@endif             
										</select>
											@if($errors->has('category_id'))
											<div class="text-danger">{{ $errors->first('category_id') }}</div>
											@endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.sub_category')</label>
										<select id="sub-dropdown" class="form-control" name="sub_category_id">               
										</select>
											@if($errors->has('sub_category_id'))
											<div class="text-danger">{{ $errors->first('sub_category_id') }}</div>
											@endif
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.gender')<span class="text-danger">*</span> </label>
										<select class="form-control select2 select2-hidden-accessible" name="gender" required>                       
											<option value=''>Select</option>	
											<option value='1'>Male</option>
											<option value='0'>Female</option>                       
										</select>
										@if($errors->has('gender'))
                                        <div class="text-danger">{{ $errors->first('gender') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.date_of_hiring')<span class="text-danger">*</span> </label>
										<input type="date"  class="form-control" name="date_of_hiring" required value="{{old('doj')}}">
                                        @if($errors->has('doj'))
                                        <div class="text-danger">{{ $errors->first('doj') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.id_type')<span class="text-danger">*</span> </label>
										<select class="form-control" name="id_type_id" required value="{{old('id_type_id')}}">
											<option value="">Select</option>
											@if ($idType->count())
												@foreach ($idType as $val)
													<option value="{{ $val->id }}">{{ $val->name }}</option>
												@endforeach
											@endif
										</select>
										@if($errors->has('id_type_id'))
                                        <div class="text-danger">{{ $errors->first('id_type_id') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.id_upload')<span class="text-danger">*</span> </label>
										<input type="file" name="id_upload" class="form-control" id="id_upload">
                                        @if($errors->has('id_upload'))
                                        <div class="text-danger">{{ $errors->first('id_upload') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.id_reference')</label>
										<input type="text" class="form-control" name="id_reference" required value="{{old('id_reference')}}">
                                        @if($errors->has('id_reference'))
                                        <div class="text-danger">{{ $errors->first('id_reference') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.professional_type') </label>
										<select class="form-control select2 select2-hidden-accessible" name="professional_type">                       
											<option value=''>Select</option>	
											<option value='High'>High</option>
											<option value='Low'>Low</option>
											<option value='Average'>Average</option>                                              
										</select>
										@if($errors->has('professional_type'))
                                        <div class="text-danger">{{ $errors->first('professional_type') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
								 <div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.nationality')<span class="text-danger">*</span> </label>
										<input type="text"  class="form-control" name="nationality" placeholder="Enter Nationality" required value="{{old('nationality')}}">
                                        @if($errors->has('nationality'))
                                        <div class="text-danger">{{ $errors->first('nationality') }}</div>
                                        @endif
										<div class="clearfix"></div>
									 </div>
									 <div class="form-group col-md-6">
										<label class="form-label">@lang('message.resident')<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="resident" placeholder="Enter Resident" required value="{{old('resident')}}">
                                        @if($errors->has('resident'))
                                        <div class="text-danger">{{ $errors->first('resident') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								 </div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.status')<span class="text-danger">*</span></label>
										<select class="form-control select2 select2-hidden-accessible" name="status" required>                       
											<option value='1' @if(old('status')=='1'){{'selected="true"'}}@endif >Active</option>
											<option value='0' @if(old('status')=='0'){{'selected="true"'}}@endif>Inactive</option>                       
										</select> 
                                        @if($errors->has('status'))
                                        <div class="text-danger">{{ $errors->first('status') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.profile_picture') </label>
										<input type="file" name="image" class="form-control" id="image">
                                        @if($errors->has('image'))
                                        <div class="text-danger">{{ $errors->first('image') }}</div>
                                        @endif
										<div class="clearfix"></div>
									   </div>
									</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.home_address')<span class="text-danger">*</span></label>
										<textarea type="text"  class="form-control" name="home_address" placeholder="Enter Home Address" required value="{{old('home_address')}}"></textarea>
                                        @if($errors->has('home_address'))
                                        <div class="text-danger">{{ $errors->first('home_address') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.certificate')<span class="text-danger">*</span> </label>
										<input type="file" name="certificate" class="form-control" id="certificate">
										@if($errors->has('certificate'))
                                        <div class="text-danger">{{ $errors->first('certificate') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
									<div class="form-row">
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.country')<span class="text-danger">*</span></label>
										<select id="country-dropdown" name="country_id" class="form-control">
											<option value="">Select</option>
											@if ($countries->count())
												@foreach ($countries as $country)
													<option value="{{ $country->id }}">{{ $country->name }}</option>
												@endforeach
											@endif
										</select>
										@if($errors->has('country_id'))
                                        <div class="text-danger">{{ $errors->first('country_id') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.state')<span class="text-danger">*</span></label>
										<select id="state-dropdown" name="state_id" class="form-control">
										</select>
										@if($errors->has('state_id'))
                                        <div class="text-danger">{{ $errors->first('state_id') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.city')<span class="text-danger">*</span></label>
										<select id="city-dropdown" name="city_id" class="form-control">				 
									  </select>
                                        @if($errors->has('city_id'))
                                        <div class="text-danger">{{ $errors->first('city_id') }}</div>
                                        @endif
										<div class="clearfix"></div>
									  </div>
									</div>
									<!-- <div class="form-row">
									   <div class="form-group col-md-12">
										<label class="form-label">@lang('message.permanent_address') <span class="text-danger">*</span></label>
										<textarea type="text" name="permanent_address" class="form-control" id="permanent_address" placeholder="Enter permanent_address"></textarea>
                                        @if($errors->has('permanent_address'))
                                        <div class="text-danger">{{ $errors->first('permanent_address') }}</div>
                                        @endif
										<div class="clearfix"></div>
									   </div>
                                	</div> -->
									<div class="text-right mt-3">
									<button type="submit" class="btn btn-primary">Save </button>&nbsp;
									<a href="{{route('admin.employee.index');}}"  class="btn btn-default">Cancel</a>
								</div>
								</div>
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
			$('#department-dropdown').on('change', function() {
				//alert('HIi');
				var idDepartment = this.value;
				$("#hierarchy-dropdown").html('');
				$.ajax({
					url:"{{url('admin/employee-by-hierarchy')}}",
					type: "POST",
					data: {
						department_id: idDepartment,
						_token: '{{csrf_token()}}'
					},
					dataType : 'json',
					success: function(result){
						$('#hierarchy-dropdown').html('<option value="">Select Hierarchy</option>'); 
						$.each(result.hierarchy, function(key, value){
							$("#hierarchy-dropdown").append('<option value="' + value
						.id + '">' + value.first_name + '</option>');
					});
				}
			});
		});
	});
</script>
@endsection