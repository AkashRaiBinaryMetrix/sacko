@extends('admin.layouts.app')
@section('content')


<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">Absent Employees</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">Attendance</a></li>
            <li class="breadcrumb-item active">Absent Employees</li>
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
                    	<form role="form" action="{{ url('admin/search/absentmployees') }}" method="POST" enctype="multipart/form-data" autocomplete="off"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<h6 class="card-header">Absent Employees</Details></h6>
                       		<div class="card-body">
									<div class="form-row">	

										<div class="form-group col-md-6">
											<label class="form-label">Select Date<span class="text-danger">*</span></label>
										    <input type="date" class="form-control" name="filter_date" id="datepicker">
											@if($errors->has('state_id'))
	                                        <div class="text-danger">{{ $errors->first('state_id') }}</div>
	                                        @endif
											<div class="clearfix"></div>
										</div> 
									
										<!-- <div class="form-group col-md-6">
											<label class="form-label">@lang('message.category_title')<span class="text-danger">*</span></label>
											<select id="category-dropdown" class="form-control select2 select2-accessible" name="category_id" >                       
											<option value='' selected >Select</option>
											@if ($category->count())
												@foreach($category as $val)
													<option value='{{$val->id}}' @if(old('category_id')==$val->id){{'selected="true"'}}@endif>{{$val->name}}</option>  
												@endforeach 
											@endif             
										</select>
											@if($errors->has('state_id'))
	                                        <div class="text-danger">{{ $errors->first('state_id') }}</div>
	                                        @endif
											<div class="clearfix"></div>
										</div> -->

										<!-- <div class="form-group col-md-6">
											<label class="form-label">@lang('message.subcategory_title')<span class="text-danger">*</span></label>
											<select id="sub-dropdown" class="form-control" name="sub_category_id">
										    </select>
											@if($errors->has('state_id'))
	                                        <div class="text-danger">{{ $errors->first('state_id') }}</div>
	                                        @endif
											<div class="clearfix"></div>
										</div> -->
										
										<!-- <div class="form-group col-md-6">
											<label class="form-label">@lang('message.select_group')<span class="text-danger">*</span></label>
											<select id="group-dropdown" class="form-control" name="group_category_id">
										    </select>
	                                        @if($errors->has('city_id'))
	                                        <div class="text-danger">{{ $errors->first('city_id') }}</div>
	                                        @endif
											<div class="clearfix"></div>
										</div> -->

										<!-- <div class="form-group col-md-6">
											<label class="form-label">@lang('message.project_shift')<span class="text-danger">*</span></label>
											<select id="shift-dropdown" class="form-control" name="shift_group_category_id">
										    </select>
	                                        @if($errors->has('city_id'))
	                                        <div class="text-danger">{{ $errors->first('city_id') }}</div>
	                                        @endif
											<div class="clearfix"></div>
										</div> -->
									
									</div>
								
									<div class="text-right mt-3">
									<button type="submit" class="btn btn-primary">Show Employees </button>&nbsp;
									<a href="{{route('admin.employee.index');}}"  class="btn btn-default">Cancel</a>
								</div>
								</div>
                        	</div>
                     	</form>

                     	<div class="col-sm-12 row">
        <div class="col-lg-12">
            <div class="table-responsive mb-4">
                <br/>
                <table class="table table-striped custom-table mb-0">
                    <thead>
                        <tr>
                            <!-- <th>#</th> -->
                            <th>Date </th>
                            <th>Employee Name </th>
                            <th>Employee ID </th>
                            <!-- <th>Punch In</th>
                            <th>Punch Out</th> -->
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
						
						@if(isset($employeesData))
							@foreach($employeesData as $value)
							@php

									$projectlist = DB::table('users')
											->where('id','=',$value->user_id)
											->get();

							@endphp
								<tr>
									<!-- <td>1</td> -->
									<td>{{ $value->punch_in}}</td>
									<td>{{$projectlist[0]->first_name}} {{$projectlist[0]->last_name}}</td>
									<td>{{$projectlist[0]->employee_id}}</td>
									<td>
										
									</td>
									<!-- @if($value->status == 0)
									<td>
										<a href="{{ url('admin/employees/present',[$value->id]) }}" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-bookmark"></span> MARK PRESENT</a>
										<a href="#" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-bookmark"></span> MARK ABSENT</a>
									</td>
									@elseif($value->status == 1)
									<td>
										<a href="" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-bookmark"></span> Time Out</a>
										<a href="#" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-bookmark"></span> MARK ABSENT</a>
									</td>
									@else
									
									@endif -->
								</tr>
								@php
								
								@endphp
							@endforeach
						@else
						<tr>
							
						</tr>
						@endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
			$('#sub-dropdown').on('change', function() {
				//alert('HIi');
				var idCategory = this.value;
				$("#group-dropdown").html('');
				$.ajax({
					url:"{{url('admin/group-by-category-subcat')}}",
					type: "POST",
					data: {
						category_id: $('#category-dropdown').val(),
						subcategory_id: idCategory,
						_token: '{{csrf_token()}}'
					},
					dataType : 'json',
					success: function(result){
						$('#group-dropdown').html('<option value="">Select Group</option>'); 
						$.each(result.subCategory, function(key, value){
							$("#group-dropdown").append('<option value="' + value
						.group_type + '">' + value.group_type + '</option>');
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