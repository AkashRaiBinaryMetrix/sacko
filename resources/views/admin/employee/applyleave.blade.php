@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">Manage Leave</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Module</a></li>
            <li class="breadcrumb-item active">Apply Leave / Leave</li>
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
                        	<h6 class="card-header" style="color:blue;">Apply Leave</Details></h6>
                       		<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Type</label>
										<select class="form-control mb-1" required name="project_type">
											<option value="">Select</option>
											<option value="Long-Haul Mining">Earned Leave</option>
											<option value="Long-Haul Mining">Sick Leave</option>
											<option value="Long-Haul Mining">Maternity Leave</option>
											<option value="Long-Haul Mining">Paternity Leave</option>
											<option value="Long-Haul Mining">Marriage Leave</option>
										</select>
										@if($errors->has('project_type'))
                                        <div class="text-danger">{{ $errors->first('project_type') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Start Date</label>
										<input type="date" class="form-control mb-1" required name="distance" value="{{old('distance')}}">
										@if($errors->has('distance'))
                                        <div class="text-danger">{{ $errors->first('distance') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">End Date</label>
										<input type="date" class="form-control mb-1" required name="project_owner" value="{{old('project_owner')}}">
										@if($errors->has('project_owner'))
                                        <div class="text-danger">{{ $errors->first('project_owner') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Leave Reason</label>
										<textarea class="form-control mb-1" required name="distance" value="{{old('distance')}}"></textarea>
										@if($errors->has('distance'))
                                        <div class="text-danger">{{ $errors->first('distance') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
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
<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;
		
    $("#addButton").click(function () {
				
	if(counter>$("#Number_of_Shifts").val()){
            //alert("");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
                
	newTextBoxDiv.after().html("<br/><div class='form-row'><div class='form-group col-md-4'><label class='form-label'>Shift Name</label><input type='text' class='form-control mb-1' required id='textbox1' name='shift_name[]' class='form-control shift_name'><div class='clearfix'></div></div><div class='form-group col-md-4'><label class='form-label'>Shift Start Date</label><input type='date' class='form-control mb-1 shift_start_date' required name='shift_start_date[]'><div class='clearfix'></div></div><div class='form-group col-md-4'><label class='form-label'>Shift End Date</label><input type='date' class='form-control mb-1 shift_end_date' required name='shift_end_date[]'><div class='clearfix'></div></div></div>");
            
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