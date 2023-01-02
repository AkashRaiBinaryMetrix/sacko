@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
	<h4 class="font-weight-bold py-3 mb-0">@lang('message.employee_leave')</h4>
	<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.leave.index') }}">@lang('message.leave')</a></li>
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
						  <a href="{{ url('admin/leave/export') }}" data-size="xl" class="btn btn-warning btn-sm mb-3 btn-round"><i class="feather"></i> Export</a>
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
						<div class="card bg-none min-height-443">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead>
										<tr>
											<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
											<th>
												<input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)">  All
											</th>
											<th>@lang('message.employee_id')</th>
											<th>@lang('message.employee_name')</th>
											<th>@lang('message.leave_type')</th>
											<th>@lang('message.from_date')</th>
											<th>@lang('message.to_date')</th>
											<th>@lang('message.approved_by')</th>
											<th>@lang('message.rejected_by')</th>
											<th>@lang('message.status')</th>
											<th>@lang('message.action')</th>
										</tr>
                                    </thead>
                                    <tbody class="list">
										@if(is_object($lists))
										@foreach($lists as $val)
										<tr>
											<th scope="col">
											<input type="checkbox" class="check_box" name="mul_del[]" id="mul_del[]" value="{{ $val->id }}" /></th>
											<td>{{ $val->employee_id }}</td>
											<td>{{ $val->name }}</td>
											<td>@foreach($leaveType as $leave)
												@if($leave['id']==$val->leave_type_id)
												{{ $leave['name']}}
												@endif
												@endforeach</td>
											<td>{{ date("d M, y",strtotime($val->from_date)) }}</td>
											<td>{{ date("d M, y",strtotime($val->to_date)) }}</td>
											<td>@if($val->status=='2')
												{{ $val->tl_name }}
												@else
												{{ $val->test }}
												@endif
											</td>
											<td>
												@if($val->status=='3')
												{{ $val->tl_name }}
												@else
												{{ $val->test }}
												@endif
											</td>
											<td>
												@if($val->status=='1')<span class="badge badge-warning">{{'Pending'}}</span>
												@elseif($val->status=='2')<span class="badge badge-success">{{'Approved'}}</span>
												@elseif($val->status=='3')<span class="badge badge-danger">{{'Rejected'}}</span>
												@endif 
											</td>
											<td>
											<a data-size="lg"  class="btn btn-icon btn-outline-success" data-toggle="tooltip" title="Edit" href="{{ url('admin/leave/edit',$val->id) }}">
												<i class="feather icon-edit"></i>
											</a>
											<a data-size="lg"  class="btn btn-icon btn-outline-primary" data-toggle="tooltip" title="View" href="{{ url('admin/leave/view',$val->id) }}">
												<i class="feather icon-eye"></i>
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

 <script type="text/javascript">
 
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
		url: "{{url('leave/status')}}",
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
					$("#formid").attr("action", "{{url('admin/leave/delete')}}");
					this.formid.submit();
					break;
				}
			}	
		}
	}
}
 </script>
@endsection
