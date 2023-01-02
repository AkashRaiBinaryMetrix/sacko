@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
	<h4 class="font-weight-bold py-3 mb-0">@lang('message.holidays')</h4>
	<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.holiday_calendar.index') }}">@lang('message.holiday_calendar')</a></li>
		</ol>
	</div>
	<div class="row">
		<!-- customar project  start -->
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center m-l-0">
						<div class="col-sm-8 text-right"></div>
					    <div class="col-sm-2 text-right">
						  <a href="javascript:muldelete()" data-size="xl" class="btn btn-danger btn-sm mb-3 btn-round"> <i class="feather icon-trash-2"></i> Delete </a>
					    </div>
						<div class="col-sm-2 text-right">
						  <a href="{{ url('admin/holiday_calendar/create') }}" data-size="xl" class="btn btn-success btn-sm mb-3 btn-round"><i class="feather icon-plus"></i> {{__('Add Holiday')}} </a>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							@if(Session::has('message'))  
							<div class="alert alert-success alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<span class="glyphicon glyphicon-ok "><strong>Success!</strong></span><em> {!! session('message') !!}</em>
							</div>
							@endif
						</div>
					</div>
                    <form id="formid" name="formid" action="" method="post" >
						<div class="table-responsive">
							<table id="report-table" class="table table-bordered table-striped mb-0">
								<thead>
									<tr>
										<th>
											<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
											<input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)">  All
										</th>
											<th>Holiday Name</th>
											<th>Holiday Date</th>
											<th>Status</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
                                    </thead>
                                    <tbody class="list">
										@if(is_object($lists))
										@foreach($lists as $val)
										<tr>
											<th scope="col">
											<input type="checkbox" class="check_box" name="mul_del[]" id="mul_del[]" value="{{ $val->id }}" />
											<td>{{$val->holiday_name}}</td>
											<td>{{date("d M, y",strtotime($val->holiday_start))}}</td>
											<td>
											  <a href="javascript:" onclick="update_status('{{ $val->id}}',{{abs($val->status-1)}})">
											  <span class="btn-status  @if($val->status!='0') {{'badge-success'}} @else {{'badge-warning'}} @endif">
												  @if($val->status=='1') {{'Active'}} @else {{'Inactive'}} @endif 
												</span>
											  </a>
											</td>
											<td>{{date("d M, y",strtotime($val->created_at))}}</td>
											<td>
											  <a data-size="lg"  class="edit-icon" data-toggle="tooltip" title="Edit" href="{{ url('admin/holiday_calendar/edit',$val->id) }}">
											  <i class="fas fa-pencil-alt"></i>
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
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop
@section('extra-js')
 <script type="text/javascript">
 /*******Search *********/
$(document).ready(function()
{
   //alert('dddd');
});
  /*******Search *********/



function isValid(formRef)
{
	for(var i=0;i<formRef.elements.length;i++)
	{
		if(formRef.elements[i].type == "checkbox")
		{
			formRef.elements[i].checked = formRef.cb1.checked
		}
	}
}


function update_status(id,value)
{   
	$.ajax({
		type: 'GET',
		data: {'id':id,'value':value},
		url: "{{url('admin/holiday_calendar/status')}}",
		success: function(result)
		{
			alert( 'Status Updated!!');
			location.reload();
		}});
}
function muldelete()
{
	element_lenght= formid.elements.length;
	for(i=0;i<element_lenght;i++)
	{
		if(formid.elements[i].name=="mul_del[]")
		{
			if(formid.elements[i].checked==true)
			{
				if(confirm("Are you sure delete record(s)?"))
				{
					$("#formid").attr("action", "{{url('admin/holiday_calendar/delete')}}");
					this.formid.submit();
					break;
				}
			}	
		}
	}
}
 </script>
@endsection
