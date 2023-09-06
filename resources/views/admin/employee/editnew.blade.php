@extends('admin.layouts.app')
@section('content')
<style>
h2{
  color:#000;
  text-align:center;
  font-size:2em;
}
.warpper{
  display:flex;
  flex-direction: column;
  align-items: center;
}
.tab{
  cursor: pointer;
  padding:10px 20px;
  margin:0px 2px;
  background: #075a8e;
  display:inline-block;
  color:#fff;
  border-radius:3px 3px 0px 0px;
  box-shadow: 0 0.5rem 0.8rem #00000080;
}
.panels{
  background:#fffffff6;
  box-shadow: 0 2rem 2rem #00000080;
  min-height:200px;
  width:100%;
  max-width:500px;
  border-radius:3px;
  overflow:hidden;
  padding:20px;  
}
.panel{
  display:none;
  animation: fadein .8s;
}
@keyframes fadein {
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
.panel-title{
  font-size:1.5em;
  font-weight:bold
}
.radio{
  display:none;
}
#one:checked ~ .panels #one-panel,
#two:checked ~ .panels #two-panel,
#three:checked ~ .panels #three-panel, 
#four:checked ~ .panels #four-panel{
  display:block
}
#one:checked ~ .tabs #one-tab,
#two:checked ~ .tabs #two-tab,
#three:checked ~ .tabs #three-tab,
#four:checked ~ .tabs #four-tab{
  background:#fffffff6;
  color:#000;
  border-top: 3px solid #000;
}
</style>
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.edit_employee')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">@lang('message.employee')</a></li>
            <li class="breadcrumb-item active">@lang('message.edit_employee')</li>
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
                    	<form role="form" action="{{ url('admin/employee/updatenew',$employee->id) }}" method="POST" enctype="multipart/form-data">
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<h6 class="card-header">@lang('message.employee_details')
                        	<div class="warpper">
								  <input class="radio" id="one" name="group" type="radio" checked>
								  <input class="radio" id="two" name="group" type="radio">
								  <input class="radio" id="three" name="group" type="radio">
								  <input class="radio" id="four" name="group" type="radio">
								  <div class="tabs">
								  <label class="tab" id="one-tab" for="one">PERSONAL INFORMATIONS</label>
								  <label class="tab" id="two-tab" for="two">EDUCATION AND WORK</label>
								  <label class="tab" id="three-tab" for="three">ASSINGMENT</label>
								  <label class="tab" id="four-tab" for="four">ACTIVATION</label>
								  </div>
								  <div class="panels" style="max-width: 939px !important;box-shadow: none !important;">
								  <!--Personal-->
								  <div class="panel" id="one-panel">
								    <div class="panel-title">PERSONAL INFORMATION</div>
								    <div class="form-row">
									<div class="form-group col-md-4">
										@php
										 //echo "<pre>";
										 //print_r($employee);
										@endphp
										<label class="form-label">@lang('message.first_name')<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="first_name" placeholder="First Name" required value="{{$employee->first_name}}">
                                        @if($errors->has('first_name'))
                                        <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.middle_name') </label>
										<input type="text"  class="form-control" name="middle_name" placeholder="Middle Name" value="{{$employee->middle_name}}">
                                        @if($errors->has('middle_name'))
                                        <div class="text-danger">{{ $errors->first('middle_name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									 </div>
									 <div class="form-group col-md-4">
										<label class="form-label">@lang('message.last_name')<span class="text-danger">*</span> </label>
										<input type="text"  class="form-control" name="last_name" placeholder="Last Name" required value="{{$employee->last_name}}">
                                        @if($errors->has('last_name'))
                                        <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                        @endif
										<div class="clearfix"></div>
									 </div>
								 </div>
								 <div class="form-row">
								 	<div class="form-group col-md-6">
										<label class="form-label">DOB<span class="text-danger">*</span> </label>
										<input type="date"  class="form-control" name="date_of_birth" required value="{{$employee->date_of_birth}}">
                                        @if($errors->has('date_of_birth'))
                                        <div class="text-danger">{{ $errors->first('date_of_birth') }}</div>
                                        @endif
										<div class="clearfix"></div>
									 </div>
									 <div class="form-group col-md-6">
										<label class="form-label">Place of birth<span class="text-danger">*</span> </label>
										<input type="text"  class="form-control" name="place_of_birth" value="{{$employee->place_of_birth}}" required>
										<div class="clearfix"></div>
									 </div>
								  </div>
								  <div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.nationality')<span class="text-danger">*</span> </label>
										<input type="text"  class="form-control" name="nationality" placeholder="Enter Nationality" required value="{{$employee->nationality}}">
                                        @if($errors->has('nationality'))
                                        <div class="text-danger">{{ $errors->first('nationality') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Current Address<span class="text-danger">*</span></label>
										<textarea type="text"  class="form-control" name="current_address" placeholder="Enter Current Address" required>{{$employee->current_address}}</textarea>
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.country')<span class="text-danger">*</span></label>
										<select id="country-dropdown" name="country_id" class="form-control" required>
											<option value="">Select</option>
											@if ($countries->count())
												@foreach ($countries as $country)
													<option value="{{ $country->id }}" {{ $employee->country_id == $country->id ? 'selected' : ''}}>{{ $country->name }}</option>
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
										<select id="state-dropdown" name="state_id" class="form-control" required>
											<option value="">Select</option>
											@if ($state_name->count())
											@foreach ($state_name as $state)
												<option value="{{ $state->id }}" {{ ($employee->state_id==$state->id) ? 'selected' : ''}}>{{ $state->name }}</option>
											@endforeach
										@endif
										</select>
										@if($errors->has('state_id'))
                                        <div class="text-danger">{{ $errors->first('state_id') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.city')<span class="text-danger">*</span></label>
										<select id="city-dropdown" name="city_id" class="form-control" required>	
											<option value="">Select</option>
											@if ($city_name->count())
											@foreach ($city_name as $data)
											<option value="{{$data->id}}" {{ ($employee->city_id==$data->id) ? 'selected' : ''}}>{{$data->name}}</option>
											@endforeach
											@endif					 
									    </select>
                                        @if($errors->has('city_id'))
                                        <div class="text-danger">{{ $errors->first('city_id') }}</div>
                                        @endif
										<div class="clearfix"></div>
									 </div>
									 <div class="form-group col-md-6">
										<label class="form-label">@lang('message.id_type')<span class="text-danger"></span> </label>
										<select class="form-control" name="id_type_id"  value="{{old('id_type_id')}}">
											<option value="">Select</option>
											@if ($idType->count())
												@foreach ($idType as $val)
													<option value="{{ $val->id }}" {{ $employee->id_type_id == $val->id ? 'selected' : ''}}>{{ $val->name }}</option>
												@endforeach
											@endif
										</select>
										@if($errors->has('id_type_id'))
                                        <div class="text-danger">{{ $errors->first('id_type_id') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.id_reference')</label>
										<input type="text" class="form-control" name="id_reference"  value="{{$employee->id_reference}}">
                                        @if($errors->has('id_reference'))
                                        <div class="text-danger">{{ $errors->first('id_reference') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.id_upload')<span class="text-danger"></span> </label>
										<input type="file" name="id_upload" class="form-control" id="id_upload">
                                        @if($errors->has('id_upload'))
                                        <div class="text-danger">{{ $errors->first('id_upload') }}</div>
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
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.mobile')<span class="text-danger">*</span></label>
										<input type="number"  class="form-control" maxlength="10" name="mobile" placeholder="Employee Mobile" required value="{{$employee->mobile}}">
                                        @if($errors->has('mobile'))
                                        <div class="text-danger">{{ $errors->first('mobile') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								  </div>
								  <div class="form-group col-md-6">
										<label class="form-label">Email<span class="text-danger">*</span></label>
										<input type="email"  class="form-control" name="email" placeholder="Employee Email" value="{{$employee->email}}" required>
										<div class="clearfix"></div>
								  </div>
								   <div class="form-row">
								  	<label class="form-label">Next of King.<span class="text-danger">*</span></label>
								  	<div class="form-group col-md-6">
										<label class="form-label" style="margin-top: 22px;margin-left: -84px;">Name<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="king_name" placeholder="Name" required style="margin-left: -82px;" value="{{$employee->king_name}}">
										<div class="clearfix"></div>
								   </div>
								   <div class="form-group col-md-6">
										<label class="form-label">Address<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="king_address" placeholder="Address" value="{{$employee->king_address}}" required>
										<div class="clearfix"></div>
								   </div>
								   <div class="form-group col-md-6">
										<label class="form-label">Phone Number<span class="text-danger">*</span></label>
										<input maxlength="10" type="number"  class="form-control" name="king_number" placeholder="Phone Number" value="{{$employee->king_number}}" required>
										<div class="clearfix"></div>
								   </div>
								   <div class="form-group col-md-6">
										<label class="form-label">Marital Status</label>
										<select class="form-control" name="marital_status" >
											<option value="">Select</option>
											<option value="Single" {{ $employee->marital_status == 'Single' ? 'selected' : ''}}>Single</option>
											<option value="Married" {{ $employee->marital_status == 'Married' ? 'selected' : ''}}>Married</option>
										</select>
										<div class="clearfix"></div>
								  </div>
								  <div class="form-group col-md-6">
										<label class="form-label">Number of Dependent</label>
										<input type="number"  class="form-control" name="number_of_dependent" placeholder="Number of Dependent" value="{{$employee->number_of_dependent}}">
										<div class="clearfix"></div>
								  </div>
								  </div>
								  </div>
								  <!--Personal-->

								  <!--Education-->
								  <div class="panel" id="two-panel">
								    <div class="panel-title">EDUCATION AND WORK</div>
								   	 <div class="form-row">
								   	 	<div class="form-group col-md-6">
											<label class="form-label">PROFESSIONAL TYPE
												<span class="text-danger">*</span>
											</label>
											<select  class="form-control" name="professional_type" required>
												<option value="">Select</option>
												<option value="Post Graduate" {{ $employee->professional_type == 'Post Graduate' ? 'selected' : ''}}>Post Graduate</option>
												<option value="Graduate" {{ $employee->professional_type == 'Graduate' ? 'selected' : ''}}>Graduate</option>
												<option value="Higher Professional Studies" {{ $employee->professional_type == 'Higher Professional Studies' ? 'selected' : ''}}>Higher Professional Studies</option>
												<option value="Lower Professional studies" {{ $employee->professional_type == 'Lower Professional studies' ? 'selected' : ''}}>Lower Professional studies</option>
												<option value="Semi-skilled" {{ $employee->professional_type == 'Semi-skilled' ? 'selected' : ''}}>Semi-skilled</option>
												<option value="Other" {{ $employee->professional_type == 'Other' ? 'selected' : ''}}>Other</option>
											</select>
											<div class="clearfix"></div>
								  		</div>
								   	 </div>
								   	 <div class="form-row">
								   	 	<div class="form-group col-md-6">
											<label class="form-label">Upload Work CV</label>
											
											<input type="file" name="work_cv" class="form-control" id="work_cv">
											<div class="clearfix"></div>
								  		</div>
								   	 </div>

								   	 <div class="form-row">
								   	 	<div class="form-group col-md-12">
											<label class="form-label">Documents and Certificate</label>
											<button type="button" class="btn btn-success add-more">Add more record</button>
											<br/><br/>
											<div class="after-add-more">
											<table border="1" style="width:100%">
												<tr>
													<th>Certificate Name</th>
													<th>Oragnization Name</th>
													<th>Document Upload</th>
												</tr>
												<tr>
													<td>
													 <select  class="form-control" name="document_type[]">
														<option value="">Select</option>
														<option value="Work Certificate">Work Certificate</option>
														<option value="Educational certificate">Educational</option>
														<option value="Merits/Other">Merits/Other</option>
													</select>
													</td>
													<td><input type="text" name="atttain_from[]" class="form-control"/></td>
													<td><input type="file" name="atttain_from_file[]" class="form-control"/></td>
												</tr>
											</table>
										    </div>
											<div class="clearfix"></div>
								  		</div>
								   	 </div>
								   	 <div class="display">
								   	 	<label class="form-label">Documents and Certificate List</label>
								   	 	<table border="1" style="width:100%">
												<tr>
													<th>Certificate Name</th>
													<th>Oragnization Name</th>
													<th>Document Upload</th>
												</tr>
												@foreach($certifcatesData as $certifcatesDataResult)
												<tr>
													<td>{{$certifcatesDataResult->certi_name}}</td>
													<td>{{$certifcatesDataResult->org_name}}</td>
													<td>
														<a href="{{$certifcatesDataResult->docu_name}}">Click to Preview</a> | 
														<a href="{{$certifcatesDataResult->docu_name}}">Click to Download</a>
													</td>
													<td><a href="#" onclick="delete_cert({{$certifcatesDataResult->id}});">Delete Record</a></td>
												</tr>
												@endforeach
											</table>
								   	 </div>
								   	 <br/><br/>
								   	 <div class="form-row">
								   	 	<div class="form-group col-md-12">
											<label class="form-label">Last three Roles/Work Experience</label>
											<button type="button" class="btn btn-success add-more-two">Add more record</button>
											<br/><br/>
											<div class="after-add-more-two">
											<table border="1" style="width: 100%;">
												<tr>
													<th>Role Name</th>
													<th>Write Main Function</th>
													<th>Intuition/Company</th>
													<th>Start Date</th>
													<th>End Date</th>
												</tr>
												<tr>
													<td><input type="text" name="r_role_name[]" class="form-control"/></td>
													<td><input type="text" name="r_role_function[]" class="form-control"/></td>
													<td><input type="text" name="r_role_company[]" class="form-control"/></td>
													<td><input type="date" name="r_role_startdate[]" class="form-control"/></td>
													<td><input type="date" name="r_role_enddate[]" class="form-control"/></td>
												</tr>
											</table>
											</div>
											<div class="clearfix"></div>
								  		</div>
								   	 </div>
								   	 <div class="display">
								   	 	<label class="form-label">Last three Roles/Work Experience List</label>
								   	 	<table border="1" style="width:100%">
												<tr>
													<th>Role Name</th>
													<th>Write Main Function</th>
													<th>Intuition/Company</th>
													<th>Start Date</th>
													<th>End Date</th>
												</tr>
												@foreach($expData as $expDataResult)
												<tr>
													<td>{{$expDataResult->fr_role_name}}</td>
													<td>{{$expDataResult->fr_role_function}}</td>
													<td>{{$expDataResult->fr_role_company}}</td>
													<td>{{$expDataResult->fr_role_startdate}}</td>
													<td>{{$expDataResult->fr_role_enddate}}</td>
													<td><a href="#" onclick="delete_exp({{$expDataResult->id}});">Delete Record</a></td>
												</tr>
												@endforeach
											</table>
								   	 </div>
								   	 <br/><br/>
								  </div>
								  <!--Education-->

								   <div class="panel" id="three-panel">
								   	   <!--Assigmment-->
									   <div class="panel" id="three-panel">
									    <div class="panel-title">ASSINGMENT</div>
									    <h6>Assign Project</h6>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label class="form-label">@lang('message.project_title')<span class="text-danger"></span></label>
												<select id="project_id" name="project_id" class="form-control">	
												@foreach ($project_details as $project_detailsr)
													<option value="{{ $project_detailsr->id }}">#SACKO{{ $project_detailsr->id }}-{{ $project_detailsr->title }}</option>	
												@endforeach		 
											    </select>
		                                        @if($errors->has('city_id'))
		                                        <div class="text-danger">{{ $errors->first('city_id') }}</div>
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
										</div>
										<div class="form-row">
										<div class="form-group col-md-4">
											<label class="form-label">@lang('message.category') <span class="text-danger">*</span> </label>
											<select id="category-dropdown" class="form-control select2 select2-accessible" name="category_id" required>                       
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
										<div class="form-group col-md-4">
											<label class="form-label">@lang('message.sub_category') <span class="text-danger">*</span> </label>
											<select id="sub-dropdown" class="form-control" name="sub_category_id" required>               
											</select>
												@if($errors->has('sub_category_id'))
												<div class="text-danger">{{ $errors->first('sub_category_id') }}</div>
												@endif
											<div class="clearfix"></div>
										</div>
										<div class="form-group col-md-4">
											<label class="form-label">@lang('message.group_type') <span class="text-danger">*</span> </label>
											<select class="form-control select2 select2-hidden-accessible" name="group_type" required>
												<option value=''>Select</option>
												<option value='Group A'>Group A</option>
												<option value='Group B'>Group B</option>
												<option value='Group C'>Group C</option>
												<option value='Group D'>Group D</option>
												<option value='Group E'>Group E</option>
											</select>
											@if($errors->has('contract'))
	                                        <div class="text-danger">{{ $errors->first('contract') }}</div>
	                                        @endif
											<div class="clearfix"></div>
										</div>
										</div>
										<div class="form-row">
										  <div class="form-group col-md-4">
											<label class="form-label">@lang('message.work_schedule')<span class="text-danger">*</span></label>
											<select id="city-dropdown" name="work_schedule" class="form-control" required>
											 <option>Select</option>
											 <option value="Permanent">Permanent</option>
											 <option value="Rotational">Rotational</option>
										    </select>
	                                        @if($errors->has('city_id'))
	                                        <div class="text-danger">{{ $errors->first('city_id') }}</div>
	                                        @endif
											<div class="clearfix"></div>
										  </div>
										  <div class="form-group col-md-4">
											<label class="form-label">Employment Date<span class="text-danger">*</span></label>
											<input type="date"  class="form-control" name="employment_date" required value="{{old('doj')}}">
	                                        @if($errors->has('city_id'))
	                                        <div class="text-danger">{{ $errors->first('city_id') }}</div>
	                                        @endif
											<div class="clearfix"></div>
										  </div>
										  <div class="form-group col-md-4">
											<label class="form-label">@lang('message.date_of_hiring')<span class="text-danger">*</span> </label>
											<input type="date"  class="form-control" name="date_of_hiring" required value="{{old('doj')}}">
	                                        @if($errors->has('doj'))
	                                        <div class="text-danger">{{ $errors->first('doj') }}</div>
	                                        @endif
											<div class="clearfix"></div>
											</div>
										<div class="form-group col-md-4">
											<label class="form-label">@lang('message.contract') <span class="text-danger">*</span> </label>
											<select class="form-control select2 select2-hidden-accessible" name="contract" required>                       
												<option value=''>Select</option>	
												<option value='CDI'>CDI</option>
												<option value='CDD'>CDD</option> 
										<option value='Project base Contract'>Project base Contract</option>
												<option value='Contractual'>Contractual</option>
												<option value='Expert Service'>Expert Service</option>
											</select>
											@if($errors->has('contract'))
	                                        <div class="text-danger">{{ $errors->first('contract') }}</div>
	                                        @endif
											<div class="clearfix"></div>
										</div>
										<div class="form-group col-md-4">
											<label class="form-label">Contract Start Date </label>
											<input type="date"  class="form-control" name="contract_start_date">
											<div class="clearfix"></div>
										 </div>
										 <div class="form-group col-md-4">
											<label class="form-label">Contract End Date </label>
											<input type="date"  class="form-control" name="contract_end_date">
											<div class="clearfix"></div>
										 </div>
										  <div class="form-group col-md-4">
											<label class="form-label">Assigned Role<span class="text-danger">*</span> </label>
											<input type="text"  class="form-control" name="assigned_role" required>
											<div class="clearfix"></div>
										 </div>
										 <div class="form-group col-md-4">
											<label class="form-label">Hierarchy Name<span class="text-danger">*</span> </label>
											<input type="text"  class="form-control" name="hierarchy_name" required>
											<div class="clearfix"></div>
										 </div>
										 <div class="form-group col-md-4">
											<label class="form-label">ASSIGNED ENRROLMENT MARTICULE<span class="text-danger">*</span> </label>
											<input type="text"  class="form-control" name="ASSIGNED_ENRROLMENT_MARTICULE" required>
											<div class="clearfix"></div>
										 </div>
										</div>
									  </div>
									  <!--Assigmment-->
								   </div>
								   <div class="panel" id="four-panel">
								   	  <!--Activation-->
									  <div class="panel" id="four-panel">
									    <div class="panel-title">ACTIVATION</div>
									    <div class="form-row">
									   	 	<div class="form-group col-md-12">
												<label class="form-label">Login Required</label>
												<select  class="form-control" name="login_required">
															<option value="">Select</option>
															<option value="Yes" {{$employee->login_required == "Yes" ? 'selected' : '' }}>Yes</option>
															<option value="No" {{$employee->login_required == "No" ? 'selected' : '' }}>No</option>
												</select>
												<div class="clearfix"></div>
									  		</div>
									  		<div class="form-group col-md-12">
												<label class="form-label">Username</label>
												<input type="text" class="form-control" name="login_username" value="{{$employee->login_username}}">
												<div class="clearfix"></div>
									  		</div>
									  		<div class="form-group col-md-12">
												<label class="form-label">Password</label>
												<input type="password" class="form-control" name="login_password">
												<div class="clearfix"></div>
									  		</div>
											<div class="form-group col-md-12">
												<label class="form-label">Role <span class="text-danger">*</span></label>
												<select class="form-control" name="login_role" required>
													<option>Select</option>
													<option value="1" {{$employee->role_id == '1' ? 'selected' : '' }}>Super-Admin</option>
													<option value="2" {{$employee->role_id == '2' ? 'selected' : '' }}>User</option>
													<option value="3" {{$employee->role_id == '3' ? 'selected' : '' }}>Employee</option>
												</select>
												<div class="clearfix"></div>
									  		</div>		
									  		<div class="form-group col-md-12">
												<label class="form-label">User Type <span class="text-danger">*</span> </label>
												@php
												@endphp
												<select class="form-control" name="user_type" required>
													<option>Select</option>
													<option value="Project User" {{$employee->user_type == 'Project User' ? 'selected' : '' }}>Project User</option>
													<option value="System User" {{$employee->user_type == 'System User' ? 'selected' : '' }}>System User</option>
												</select>
												<div class="clearfix"></div>
									  		</div>								   	 
									  	</div>
									  </div>
									  <!--Activation-->
								   </div>

								  <button>Update</button>
								  </div>
							</div>


                        	</Details></h6>
                       		
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
 <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
  <script>
  	$(document).ready(function() {
    $("body").on("click",".add-more",function(){ 
        var html = $(".after-add-more").first().clone();
      
        //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
      
          $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
      
        $(".after-add-more").last().after(html);    
    });

    $("body").on("click",".remove",function(){ 
        $(this).parents(".after-add-more").remove();
    });
	});
   </script>
    <script>
  	$(document).ready(function() {
    $("body").on("click",".add-more-two",function(){ 
        var html = $(".after-add-more-two").first().clone();

        $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
      
        $(".after-add-more-two").last().after(html);   
    });

    $("body").on("click",".remove",function(){ 
        $(this).parents(".after-add-more-two").remove();
    });
	});
  </script>
  <script>
  	function delete_cert(id){
  		var result = confirm("Are you sure you want to delete?");
		if (result) {
		      $.ajax({
		        url:"{{ route('deleteCertificate') }}",
		        data: "id="+id,
		        success:function(data)
		        {
		          window.location.reload();
		        }
     		});
		}
  	}

  	function delete_exp(id){
  		var result = confirm("Are you sure you want to delete?");
		if (result) {
		      $.ajax({
		        url:"{{ route('deleteExperience') }}",
		        data: "id="+id,
		        success:function(data)
		        {
		          window.location.reload();
		        }
     		});
		}
  	}
  </script>
@endsection