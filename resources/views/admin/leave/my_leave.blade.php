@extends('layouts.app')
@section('content')
<div class="page-content">
    <div class="page-title">
		<div class="row justify-content-between align-items-center">
			<div class="col-xl-5 col-lg-5 col-md-5 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
				<div class="d-inline-block">
					<h5 class="h4 d-inline-block font-weight-400 mb-0 ">Please Choose Leave Type &  Apply</h5>
				</div>
			</div>         
			<div class="col-xl-7 col-lg-7 col-md-7 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
				<div class="d-inline-block">
					<h5 class="h4 d-inline-block font-weight-400 mb-0 "> My Applied Leave ({{ count($datacountlists)}})</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		@foreach ($errors->all() as $error)
		<div class=" alert alert-danger alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<span class="glyphicon glyphicon-remove"></span>{{ $error }}
		</div>
		@endforeach
		@if(Session::has('message'))  
		<div class="alert alert-success alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<span class="glyphicon glyphicon-ok "><strong>Success!</strong></span><em> {!! session('message') !!}</em>
		</div>
		@endif
		<div class="col-sm-5">
			<div class="card bg-none min-height-443">
				<div class="table-responsive">
					<table class="table align-items-center">
						<thead>
							<tr>
								<th>Leave Type</th>
								<th>Closing Balance 2021</th>
								<th>Carry Forward</th>
								<th>Opening Balance 2022</th>
								<th>Availed Leaves</th>
								<th>Remaining Balance</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody class="list">
							@foreach($leaveType as $type)
							@if($type->slug=='long_term_medical_leave')
							@if($user_array['year_complete']>=1)
							<tr>
								<td><a href="" onclick="return modal_open('{{$type->id}}','{{$type->name}}');">{{$type->name}}</a></td>
								<td>{{leave_details(Auth::user()->id,$type->id,'closing')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'carry-forward')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'opening-balance')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'availed')}}</td>
								<td>{{availble_leave(Auth::user()->id,$type->slug)}}</td>
								<td><a href="" class="btn-create badge-blue" onclick="return modal_open('{{$type->id}}','{{$type->name}}');">Apply</a></td>
							</tr>
							@endif
							@elseif($type->slug=='marriage_leave')
							@if($user_array['marital_status']=='Single'||$user_array['marital_status']=='Widowed'||$user_array['marital_status']=='Divorced')
							<tr>
								<td><a href="" onclick="return modal_open('{{$type->id}}','{{$type->name}}');">{{$type->name}}</a></td>
								<td>{{leave_details(Auth::user()->id,$type->id,'closing')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'carry-forward')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'opening-balance')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'availed')}}</td>
								<td>{{availble_leave(Auth::user()->id,$type->slug)}}</td>
								<td><a href="" class="btn-create badge-blue" onclick="return modal_open('{{$type->id}}','{{$type->name}}');">Apply</a></td>
							</tr>
							@endif
							@elseif($type->slug=='maternity_leave')
							@if($user_array['marital_status']=='Married' && $user_array['gender']=='Female' && $user_array['kids_details']<'2')
							<tr>
								<td><a href="" onclick="return modal_open('{{$type->id}}','{{$type->name}}');">{{$type->name}}</a></td>
								<td>{{leave_details(Auth::user()->id,$type->id,'closing')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'carry-forward')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'opening-balance')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'availed')}}</td>
								<td>{{availble_leave(Auth::user()->id,$type->slug)}}</td>
								<td><a href="" class="btn-create badge-blue" onclick="return modal_open('{{$type->id}}','{{$type->name}}');">Apply</a></td>
							</tr>
							@endif
							@elseif($type->slug=='paternity_leave')
							@if($user_array['marital_status']=='Married' && $user_array['gender']=='Male' && $user_array['kids_details']<'2')
							<tr>
								<td><a href="" onclick="return modal_open('{{$type->id}}','{{$type->name}}');">{{$type->name}}</a></td>
								<td>{{leave_details(Auth::user()->id,$type->id,'closing')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'carry-forward')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'opening-balance')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'availed')}}</td>
								<td>{{availble_leave(Auth::user()->id,$type->slug)}}</td>
								<td><a href="" class="btn-create badge-blue" onclick="return modal_open('{{$type->id}}','{{$type->name}}');">Apply</a></td>
							</tr>
							@endif
							@else
							<tr>
								<td><a href="" onclick="return modal_open('{{$type->id}}','{{$type->name}}');">{{$type->name}}</a></td>
								<td>{{leave_details(Auth::user()->id,$type->id,'closing')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'carry-forward')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'opening-balance')}}</td>
								<td>{{leave_details(Auth::user()->id,$type->id,'availed')}}</td>
								<td>{{availble_leave(Auth::user()->id,$type->slug)}}</td>
								<td><a href="" class="btn-create badge-blue" onclick="return modal_open('{{$type->id}}','{{$type->name}}');">Apply</a></td>
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-sm-7">
			<form id="formid" name="formid" action="" method="post" >
				<div class="card bg-none min-height-443">
					<div class="table-responsive">
						<table class="table align-items-center">
							<thead>
								<tr >
									<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
									<!--<th>
										<input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)">  All
									</th>-->
									<th>Leave Type</th>
									<th>From Date</th>
									<th>To Date</th>
									<th>Comment</th>
									<th>Apply Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="list">
								@if(count($lists)>0)
								@foreach($lists as $val)
								<tr>
									<!--<th scope="col">
									<input type="checkbox" class="check_box" name="mul_del[]" id="mul_del[]" value="{{ $val->id }}" /></th>-->
									<td>@foreach($leaveType as $leave)
										@if($leave['id']==$val->leave_type_id)
										{{ $leave['name']}}
										@endif
										@endforeach</td>
									<td>{{ $val->date_from }}</td>
									<td>{{ $val->date_to }}</td>
									<td>{{ $val->description }}</td>
									<td>{{date("d M, y",strtotime($val->created_at))}}</td>
									<td>
										<a href="javascript:" >
											<span class="btn-status  @if($val->status!='0') {{'badge-success'}} @else {{'badge-warning'}} @endif">
											@if($val->status=='1') {{'Approved'}} @else {{'Pending'}} @endif 
											</span>
										</a>
									</td>
									<td>
									  <!--<a data-size="lg"  class="edit-icon" data-toggle="tooltip" title="Edit" href="{{ url('leave/edit',$val->id) }}">
									  <i class="fas fa-pencil-alt"></i>
									  </a>-->
									  <a data-size="lg"   class="edit-icon bg-warning" data-toggle="tooltip" title="View" href="{{ url('leave/show',$val->id) }}"> 
										<i class="fa fa-eye fa-fw"></i>
									</a>
									</td> 
								</tr>
								@endforeach
								@else
								<tr><td colspan="7" align="center">No Records Founds</td></tr>
								@endif
							</tbody>
						</table>
					</div>
					{{ $lists->links()}}    
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModalApplyLeave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="card bg-none card-box">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title" id="exampleModalLongTitle">Apply Leave </h6>
					<button type="button" onClick="document.location.reload(true)" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form role="form" id="myForm" name="leave_add"  method="POST" enctype="multipart/form-data"> 
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<input type="hidden" class="form-control"  name="leave_type_id" id="leave_type_id" required >
							<div class="form-leavetype col-lg-12 col-md-12">
								<label for="exampleInputEmail1">{{'Leave Name'}} <span class="myrequired">*</span> </label>
								<input type="text"  class="form-control date-picker" readonly id="leave_name" name="leave_name" placeholder="Leave Name" required value="{{old('leave_name')}}">
							</div>
							<div class="form-leavetype col-lg-6 col-md-6">
								<label for="exampleInputEmail1">{{'Date From'}} <span class="myrequired">*</span> </label>
								<input type="date"  class="form-control date-picker" id="date_from" name="date_from" placeholder="Date From" required value="{{old('date_from')}}">
							</div>
							<div class="form-leavetype col-lg-6 col-md-6">
								<label for="exampleInputEmail1">{{'Date To'}} <span class="myrequired">*</span> </label>
								<input type="date"  class="form-control date-picker" id="date_to" name="date_to" placeholder="Date To" required value="{{old('date_to')}}">
							</div>
							<div class="form-leavetype col-lg-12">
								<label for="exampleInputEmail1">{{'Comment'}} <span class="myrequired">*</span> </label>
								<textarea class="form-control" id="description" name="description" placeholder="Comment" required value="{{old('description')}}"></textarea>
							</div>
							<div class="form-leavetype col-lg-12" style="display:none;">
								<label for="exampleInputEmail1">{{'Medical Certificate'}} <span class="myrequired">*</span> </label>
								<input type="file" class="form-control" style="line-height: 16px;" id="medical_certificate" name="medical_certificate" />
							</div>
							<div class="col-md-12" align="left">
								<button type="submit" class="btn-create badge-blue">Save</button>
								<button type="button" onClick="document.location.reload(true)" class="btn-create bg-gray" data-dismiss="modal">Close</button>
							</div>
						</div> 
					</form> 
				</div>
				<div class="modal-footer">
				<div id="Leavemessage"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('extra-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script type="text/javascript">
function modal_open(leave_type_id,leave_name)
{	
	$('#exampleModalApplyLeave').modal('toggle');
	$('#leave_type_id').val(leave_type_id);
	$('#leave_name').val(leave_name);
	return false;
}
</script>
<script type="text/javascript">
$(function() 
{
	$("form[name='leave_add']").validate({
		// Specify validation rules
		rules: {
		  leave_type_id: "required",
		  date_from: "required",
		  date_to: "required",
		  description: "required",
		},
		// Specify validation error messages
		messages: {
		  leave_type_id: "<span class='text-danger'>Please Enter Your Account Name</span>",
		  date_from: "<span class='text-danger'>Please Enter From Date</span>",
		  date_to: "<span class='text-danger'>Please Enter To Date</span>",
		  description: "<span class='text-danger'>Please Enter Comment</span>",
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) 
		{	
			var leave_type_id 			= $('#leave_type_id').val();
			var date_from 				= $('#date_from').val();
			var date_to 				= $('#date_to').val();
			var description 			= $('#description').val();
		
			$.ajax({
				type: 'POST',
				data: {'leave_type_id':leave_type_id,
						'date_from':date_from,
						'date_to':date_to,
						'description':description,
					  },
				url: "{{url('leave/store')}}",
				success: function(result)
				{	
					if(result=='1')
					{
						$('#Leavemessage').html('<div class="alert alert-success alert-dismissible" ><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="glyphicon glyphicon-ok "><strong>Success</strong></span><em> Leave Apply Successfully!</em></div>');
						$('#date_from').val('');
						$('#date_to').val('');
						$('#description').val('');
						setTimeout(function(){
						$('#exampleModalApplyLeave').modal('hide'); 
						document.location.reload(true);
						}, 2000);
					}
				}});
		  //form.submit();
		}
	});
});
</script>
@endsection
