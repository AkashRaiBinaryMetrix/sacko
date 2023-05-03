@extends('admin.layouts.app')
@section('content')


<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">Manage Project</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Module</a></li>
            <li class="breadcrumb-item active">Create Project / Project Scope</li>
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
                    	<form role="form" action="{{ route('admin.manage.saveproject') }}" method="POST" enctype="multipart/form-data"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<h6 class="card-header" style="color:blue;">Create Project</Details></h6>
                       		<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Project Title</label>
										<input type="text" class="form-control mb-1" required name="project_title" value="{{old('project_title')}}">
										@if($errors->has('project_title'))
                                        <div class="text-danger">{{ $errors->first('project_title') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Type</label>
										<select class="form-control mb-1" required name="project_type">
											<option value="">Select</option>
											<option value="Long-Haul Mining">Long-Haul Mining</option>
											<option value="Long-Highway haul">Long-Highway haul</option>
											<option value="Short-Haul-Mining">Short-Haul-Mining</option>
											<option value="Short-Haul-Highways">Short-Haul-Highways</option>
											<option value="Rehandle">Rehandle</option>
										</select>
										@if($errors->has('project_type'))
                                        <div class="text-danger">{{ $errors->first('project_type') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Distance</label>
										<input type="text" class="form-control mb-1" required name="distance" value="{{old('distance')}}">
										@if($errors->has('distance'))
                                        <div class="text-danger">{{ $errors->first('distance') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Material/Product</label>
										<select class="form-control mb-1" required name="material">
											<option value="">Select</option>
											<option value="Gold">Gold</option>
											<option value="Iron Ore">Iron Ore</option>
											<option value="Bauxite">Bauxite</option>
											<option value="Zinc">Zinc</option>
											<option value="Laterite">Laterite</option>
											<option value="Cosmetic">Cosmetic</option>
										</select>
										@if($errors->has('material'))
                                        <div class="text-danger">{{ $errors->first('material') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Project Owner</label>
										<input type="text" class="form-control mb-1" required name="project_owner" value="{{old('project_owner')}}">
										@if($errors->has('project_owner'))
                                        <div class="text-danger">{{ $errors->first('project_owner') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Project Description</label>
										<input type="text" class="form-control mb-1" required name="project_description" value="{{old('project_owner')}}">
										@if($errors->has('project_description'))
                                        <div class="text-danger">{{ $errors->first('project_description') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Point A</label>
										<input type="text" class="form-control mb-1" required name="pointA" value="{{old('pointA')}}">
										@if($errors->has('pointA'))
                                        <div class="text-danger">{{ $errors->first('pointA') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Point B</label>
										<input type="text" class="form-control mb-1" required name="pointB" value="{{old('pointB')}}">
										@if($errors->has('pointB'))
                                        <div class="text-danger">{{ $errors->first('pointB') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Loading Point</label>
										<input type="text" class="form-control mb-1" required name="loading_point" value="{{old('loading_point')}}">
										@if($errors->has('loading_point'))
                                        <div class="text-danger">{{ $errors->first('loading_point') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Dumping Point</label>
										<input type="text" class="form-control mb-1" required name="dumping_point" value="{{old('dumping_point')}}">
										@if($errors->has('dumping_point'))
                                        <div class="text-danger">{{ $errors->first('dumping_point') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Project Duration</label>
										<input type="text" class="form-control mb-1" required name="project_duration" value="{{old('project_duration')}}">
										@if($errors->has('project_duration'))
                                        <div class="text-danger">{{ $errors->first('project_duration') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								</div>
								<h6 class="card-header" style="color:blue;">Project Material Details</h6>
								<div class="card-body">
									<div class="form-row">
										<div class="form-group col-md-4">
											<label class="form-label">Material</label>
											<select class="form-control mb-1" required name="material2">
												<option value="">Select</option>
												<option value="Gold">Gold</option>
												<option value="Iron Ore">Iron Ore</option>
												<option value="Bauxite">Bauxite</option>
												<option value="Zinc">Zinc</option>
												<option value="Laterite">Laterite</option>
												<option value="Cosmetic">Cosmetic</option>
											</select>
											@if($errors->has('material2'))
	                                        <div class="text-danger">{{ $errors->first('material2') }}</div>
	                                        @endif
	                                        <div class="clearfix"></div>
										</div>
										<div class="form-group col-md-4">
											<label class="form-label">Emperical density</label>
											<input type="text" class="form-control mb-1" name="emperical_density" value="{{old('emperical_density')}}">
											@if($errors->has('emperical_density'))
	                                        <div class="text-danger">{{ $errors->first('emperical_density') }}</div>
	                                        @endif
	                                        <div class="clearfix"></div>
										</div>
										<div class="form-group col-md-4">
											<label class="form-label">Lab density</label>
											<input type="text" class="form-control mb-1" name="lab_density" value="{{old('lab_density')}}">
											@if($errors->has('lab_density'))
	                                        <div class="text-danger">{{ $errors->first('lab_density') }}</div>
	                                        @endif
	                                        <div class="clearfix"></div>
										</div>
									</div>
								</div>
								<h6 class="card-header" style="color:blue;">Project Location</h6>
								<div class="card-body">
									<div class="form-row">
										<div class="form-group col-md-4">
												<label class="form-label">Country</label>
												<!-- <input type="text" class="form-control mb-1" required name="Country" value="{{old('Country')}}"> -->
												<select id="country-dropdown" name="Country" class="form-control">
											<option value="">Select</option>
											@if ($countries->count())
												@foreach ($countries as $country)
													<option value="{{ $country->id }}">{{ $country->name }}</option>
												@endforeach
											@endif
										</select>
												@if($errors->has('Country'))
		                                        <div class="text-danger">{{ $errors->first('Country') }}</div>
		                                        @endif
		                                        <div class="clearfix"></div>
										</div>
										<div class="form-group col-md-4">
												<label class="form-label">State</label>
												<!-- <input type="text" class="form-control mb-1" required name="City" value="{{old('City')}}"> -->
												<select id="state-dropdown" name="State" class="form-control">
										</select>
										@if($errors->has('state_id'))
                                        <div class="text-danger">{{ $errors->first('state_id') }}</div>
                                        @endif
		                                        <div class="clearfix"></div>
										</div>
										<div class="form-group col-md-4">
												<label class="form-label">City</label>
												<!-- <input type="text" class="form-control mb-1" required name="City" value="{{old('City')}}"> -->
												<select id="city-dropdown" name="City" class="form-control">				 
									  </select>
												@if($errors->has('City'))
		                                        <div class="text-danger">{{ $errors->first('City') }}</div>
		                                        @endif
		                                        <div class="clearfix"></div>
										</div>
										<div class="form-group col-md-6">
												<label class="form-label">Site Name</label>
												<input type="text" class="form-control mb-1" required name="site_name" value="{{old('site_name')}}">
												@if($errors->has('site_name'))
		                                        <div class="text-danger">{{ $errors->first('site_name') }}</div>
		                                        @endif
		                                        <div class="clearfix"></div>
										</div>
										<div class="form-group col-md-6">
												<label class="form-label">Site Manager</label>
												<input type="text" class="form-control mb-1" required name="site_manager" value="{{old('site_manager')}}">
												@if($errors->has('site_manager'))
		                                        <div class="text-danger">{{ $errors->first('site_manager') }}</div>
		                                        @endif
		                                        <div class="clearfix"></div>
										</div>
										<div class="form-group col-md-6">
												<label class="form-label">Project Manager</label>
												<input type="text" class="form-control mb-1" required name="Project_Manager" value="{{old('Project_Manager')}}">
												@if($errors->has('Project_Manager'))
		                                        <div class="text-danger">{{ $errors->first('Project_Manager') }}</div>
		                                        @endif
		                                        <div class="clearfix"></div>
										</div>
									</div>
								</div>
								<h6 class="card-header" style="color:blue;">Project Schedule Work</h6>
								<div class="card-body">
									<div class="form-row">
										<div class="form-group col-md-6">
												<label class="form-label">Day Work Hours</label>
												<input type="text" class="form-control mb-1" required name="day_work_hours" value="{{old('day_work_hours')}}">
												@if($errors->has('day_work_hours'))
		                                        <div class="text-danger">{{ $errors->first('day_work_hours') }}</div>
		                                        @endif
		                                        <div class="clearfix"></div>
										</div>
										<div class="form-group col-md-6">
												<label class="form-label">Number of Shifts</label>
												<input type="text" class="form-control mb-1" required name="Number_of_Shifts" id="Number_of_Shifts" value="{{old('Number_of_Shifts')}}">
												@if($errors->has('Number_of_Shifts'))
		                                        <div class="text-danger">{{ $errors->first('Number_of_Shifts') }}</div>
		                                        @endif
		                                        <div class="clearfix"></div>
										</div>
									</div>
								</div>
								<h6 class="card-header" style="color:blue;">Add Shifts</h6>
								<div class="card-body">
									<!-- <button type="button" name="add" id="add" class="btn btn-primary">Add More</button> -->
									<input type='button' value='Add Button' id='addButton'>
<input type='button' value='Remove Button' id='removeButton'>
<div id="TextBoxesGroup">
						            <div class="form-row">  
						                    		<div class="form-group col-md-4">
															<label class="form-label">Shift Name</label>
															<input type="text" class="form-control mb-1" required id='textbox1' name="shift_name[]" class="form-control shift_name">
					                                        <div class="clearfix"></div>
													</div>
													<div class="form-group col-md-4">
															<label class="form-label">Shift Start Time</label>
															<input type="time" class="shift_start_date form-control mb-1" required name="shift_start_date[]">
					                                        <div class="clearfix"></div>
													</div>
													<div class="form-group col-md-4">
															<label class="form-label">Shift End Time</label>
															<input type="time" class="form-control mb-1 shift_end_date" required name="shift_end_date[]">
					                                        <div class="clearfix"></div>
													</div>
						            </div>
						        </div>
								</div>
								<div class="text-right mt-3">
									<button type="submit" class="btn btn-primary">Save</button>&nbsp;
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.shift_start_date').timepicker({});
});
$(document).ready(function(){

    var counter = 2;
		
    $("#addButton").click(function () {
				
	if(counter>$("#Number_of_Shifts").val()){
            //alert("");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
                
	newTextBoxDiv.after().html("<br/><div class='form-row'><div class='form-group col-md-4'><label class='form-label'>Shift Name</label><input type='text' class='form-control mb-1' required id='textbox1' name='shift_name[]' class='form-control shift_name'><div class='clearfix'></div></div><div class='form-group col-md-4'><label class='form-label'>Shift Start Time</label><input type='time' class='form-control mb-1 shift_start_date' required name='shift_start_date[]'><div class='clearfix'></div></div><div class='form-group col-md-4'><label class='form-label'>Shift End Time</label><input type='time' class='form-control mb-1 shift_end_date' required name='shift_end_date[]'><div class='clearfix'></div></div></div>");
            
	newTextBoxDiv.appendTo("#TextBoxesGroup");

				
	counter++;
     });

     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
	counter--;
			
        $("#TextBoxDiv" + counter).remove();
			
     });
		
     $("#getButtonValue").click(function () {
		
	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
</script>
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