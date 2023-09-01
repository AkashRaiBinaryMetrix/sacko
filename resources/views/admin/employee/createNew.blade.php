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
								  <div class="panel" id="one-panel">
								    <div class="panel-title">PERSONAL INFORMATION</div>
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
										<label class="form-label">DOB<span class="text-danger">*</span> </label>
										<input type="date"  class="form-control" name="date_of_birth" required value="{{old('date_of_birth')}}">
                                        @if($errors->has('date_of_birth'))
                                        <div class="text-danger">{{ $errors->first('date_of_birth') }}</div>
                                        @endif
										<div class="clearfix"></div>
									 </div>
									 <div class="form-group col-md-6">
										<label class="form-label">Place of birth<span class="text-danger">*</span> </label>
										<input type="text"  class="form-control" name="place_of_birth" required>
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
										<label class="form-label">Current Address<span class="text-danger">*</span></label>
										<textarea type="text"  class="form-control" name="current_address" placeholder="Enter Current Address" required></textarea>
										<div class="clearfix"></div>
									</div>
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
										<label class="form-label">@lang('message.id_reference')</label>
										<input type="text" class="form-control" name="id_reference" required value="{{old('id_reference')}}">
                                        @if($errors->has('id_reference'))
                                        <div class="text-danger">{{ $errors->first('id_reference') }}</div>
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
										<input type="text"  class="form-control" name="mobile" placeholder="Employee Mobile" required value="{{old('mobile')}}">
                                        @if($errors->has('mobile'))
                                        <div class="text-danger">{{ $errors->first('mobile') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								  </div>
								  <div class="form-group col-md-6">
										<label class="form-label">Email<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="email" placeholder="Employee Email" required>
										<div class="clearfix"></div>
								  </div>
								   <div class="form-row">
								  	<label class="form-label">Next of King.<span class="text-danger">*</span></label>
								  	<div class="form-group col-md-6">
										<label class="form-label" style="margin-top: 22px;margin-left: -84px;">Name<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="king_name" placeholder="Name" required style="margin-left: -82px;">
										<div class="clearfix"></div>
								   </div>
								   <div class="form-group col-md-6">
										<label class="form-label">Address<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="king_address" placeholder="Address" required>
										<div class="clearfix"></div>
								   </div>
								   <div class="form-group col-md-6">
										<label class="form-label">Phone Number<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="king_number" placeholder="Phone Number" required>
										<div class="clearfix"></div>
								   </div>
								   <div class="form-group col-md-6">
										<label class="form-label"><span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="king_number" placeholder="Phone Number" required>
										<div class="clearfix"></div>
								   </div>
								   <div class="form-group col-md-6">
										<label class="form-label">Marital Status</label>
										<select  class="form-control" name="marital_status" >
											<option value="">Select</option>
											<option value="Single">Single</option>
											<option value="Married">Married</option>
										</select>
										<div class="clearfix"></div>
								  </div>
								  <div class="form-group col-md-6">
										<label class="form-label">Number of Dependent</label>
										<input type="number"  class="form-control" name="number_of_dependent" placeholder="Number of Dependent" required>
										<div class="clearfix"></div>
								  </div>
								  </div>
								  </div>
								 
								  <!--Education-->
								  <div class="panel" id="two-panel">
								    <div class="panel-title">EDUCATION AND WORK</div>
								   	 <div class="form-row">
								   	 	<div class="form-group col-md-6">
											<label class="form-label">PROFESSIONAL TYPE</label>
											<select  class="form-control" name="professional_type">
												<option value="">Select</option>
												<option value="Post Graduate">Post Graduate</option>
												<option value="Graduate">Graduate</option>
												<option value="Higher Professional Studies">Higher Professional Studies</option>
												<option value="Lower Professional studies">Lower Professional studies</option>
												<option value="Semi-skilled">Semi-skilled</option>
												<option value="Other">Other</option>
											</select>
											<div class="clearfix"></div>
								  		</div>
								   	 </div>
								   	 <div class="form-row">
								   	 	<div class="form-group col-md-6">
											<label class="form-label">Upload Work CV</label>
											<input type="file"  class="form-control" name="work_cv" placeholder="Number of Dependent" required>
											<div class="clearfix"></div>
								  		</div>
								   	 </div>
								   	 <div class="form-row">
								   	 	<div class="form-group col-md-12">
											<label class="form-label">Documents and Certificate</label>
											<button>Add record</button>
											<table>
												<tr>
													<th>Certificate Name</th>
													<th>Oragnization Name</th>
													<th>Document Upload</th>
												</tr>
												<tr>
													<td>
													 <select  class="form-control" name="document_type">
														<option value="">Select</option>
														<option value="Work Certificate">Work Certificate</option>
														<option value="Educational certificate">Educational</option>
														<option value="Merits/Other">Merits/Other</option>
													</select>
													</td>
													<td><input type="text" name="atttain_from" class="form-control"/></td>
													<td><input type="file" name="atttain_from_file" class="form-control"/></td>
												</tr>
											</table>
											<div class="clearfix"></div>
								  		</div>
								   	 </div>
								   	 <div class="form-row">
								   	 	<div class="form-group col-md-12">
											<label class="form-label">Last three Roles/Work Experience</label>
											<button>Add record</button>
											<table>
												<tr>
													<th>Role Name</th>
													<th>Write Main Function</th>
													<th>Intuition/Company</th>
													<th>Start Date</th>
													<th>End Date</th>
												</tr>
												<tr>
													<td><input type="text" name="r_role_name" class="form-control"/></td>
													<td><input type="text" name="r_role_function" class="form-control"/></td>
													<td><input type="text" name="r_role_company" class="form-control"/></td>
													<td><input type="date" name="r_role_startdate" class="form-control"/></td>
													<td><input type="date" name="r_role_enddate" class="form-control"/></td>
												</tr>
											</table>
											<div class="clearfix"></div>
								  		</div>
								   	 </div>
								  </div>
								  <!--Education-->

								  <!--Assigmment-->
								  <div class="panel" id="three-panel">
								    <div class="panel-title">ASSINGMENT</div>
								    <h6>Assign Project and Shift</h6>
									<div class="form-row">
										<div class="form-group col-md-4">
											<label class="form-label">@lang('message.project_title')<span class="text-danger">*</span></label>
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
									  <div class="form-group col-md-4">
											<label class="form-label">@lang('message.project_shift')<span class="text-danger">*</span></label>
											<select id="shift_id" name="shift_id" class="form-control" style="width: 400px;">	
												@foreach ($usershifts as $usershiftsr)
												<option value="{{ $usershiftsr->id }}">{{ $usershiftsr->shift_title }}({{ $usershiftsr->shift_start_time }} to {{ $usershiftsr->shift_end_time }})</option>	
											@endforeach		 
										    </select>
	                                        @if($errors->has('city_id'))
	                                        <div class="text-danger">{{ $errors->first('city_id') }}</div>
	                                        @endif
											<div class="clearfix"></div>
									  </div>
									</div>

								<div class="form-row">
									
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
									<div class="form-group col-md-4">
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
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.sub_category')</label>
										<select id="sub-dropdown" class="form-control" name="sub_category_id">               
										</select>
											@if($errors->has('sub_category_id'))
											<div class="text-danger">{{ $errors->first('sub_category_id') }}</div>
											@endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label">@lang('message.group_type')</label>
										<select class="form-control select2 select2-hidden-accessible" name="group_type">                       
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
										<select id="city-dropdown" name="work_schedule" class="form-control">
										 <option>Select</option>
										 <option value="Permanent">Permanent</option>
										 <option value="Rotational">Rotational</option>
									    </select>
                                        @if($errors->has('city_id'))
                                        <div class="text-danger">{{ $errors->first('city_id') }}</div>
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
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.contract')</label>
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
									<div class="form-group col-md-6">
										<label class="form-label">Contract Start Date<span class="text-danger">*</span> </label>
										<input type="date"  class="form-control" name="contract_start_date">
										<div class="clearfix"></div>
									 </div>
									 <div class="form-group col-md-6">
										<label class="form-label">Contract End Date<span class="text-danger">*</span> </label>
										<input type="date"  class="form-control" name="contract_end_date">
										<div class="clearfix"></div>
									 </div>
									 <div class="form-group col-md-6">
										<label class="form-label">Hierarchy Name<span class="text-danger">*</span> </label>
										<input type="text"  class="form-control" name="hierarchy_name">
										<div class="clearfix"></div>
									 </div>
									 <div class="form-group col-md-6">
										<label class="form-label">ASSIGNED ENRROLMENT MARTICULE<span class="text-danger">*</span> </label>
										<input type="text"  class="form-control" name="ASSIGNED_ENRROLMENT_MARTICULE">
										<div class="clearfix"></div>
									 </div>
									</div>

								  </div>
								  <!--Assigmment-->

								  <!--Activation-->
								  <div class="panel" id="four-panel">
								    <div class="panel-title">ACTIVATION</div>
								    <div class="form-row">
								   	 	<div class="form-group col-md-12">
											<label class="form-label">Login Required</label>
											<select  class="form-control" name="login_required">
														<option value="">Select</option>
														<option value="Yes">Yes</option>
														<option value="No">No</option>
											</select>
											<div class="clearfix"></div>
								  		</div>
								  		<div class="form-group col-md-12">
											<label class="form-label">Username</label>
											<input type="text" class="form-control" name="login_username">
											<div class="clearfix"></div>
								  		</div>
								  		<div class="form-group col-md-12">
											<label class="form-label">Password</label>
											<input type="password" class="form-control" name="login_password">
											<div class="clearfix"></div>
								  		</div>
										<div class="form-group col-md-12">
											<label class="form-label">Role</label>
											<select class="form-control" name="login_role">
												<option>Select</option>
												<option value="Super-Admin">Super-Admin</option>
												<option value="User">User</option>
												<option value="Employee">Employee</option>
											</select>
											<div class="clearfix"></div>
								  		</div>								   	 
								  	</div>
								  </div>
								  <!--Activation-->

								  <button>Save</button>
								  <button>Enrolled</button>
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
@endsection