@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
	<h4 class="font-weight-bold py-3 mb-0">Leave Types({{ count($datacountlists)}})</h4>
	<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">@lang('message.employee')</a></li>
		</ol>
	</div>
	<div class="row">
		<!-- customar project  start -->
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
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

					<h4 class="font-weight-bold py-3 mb-0">Total leave per year: 12</h4>

					<table class="table align-items-center">
                                    <thead>
										<tr>
											<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
											<th>Name</th>
<!-- 											<th>Total in Year</th>
 --><!-- 											<th>Total in Month</th>
 -->											<th>Status</th>
											<!--<th>Action</th>-->
										</tr>
                                    </thead>
                                    <tbody class="list">
										@if(is_object($lists))
										@foreach($lists as $val)
										<tr>
											<td>{{$val->name}}</td>
<!-- 											<td>{{$val->total_in_year}} Days</td>
 --><!-- 											<td>{{$val->total_in_month}} Days</td>
 -->											<td>
											  <a href="javascript:" onclick="update_status('{{ $val->id}}',{{abs($val->status-1)}})">
											  <span class="btn-status  @if($val->status!='0') {{'badge-success'}} @else {{'badge-warning'}} @endif">
												  @if($val->status=='1') {{'Active'}} @else {{'Inactive'}} @endif 
												</span>
											  </a>
											</td>
											<!--<td>{{date("d M, y",strtotime($val->created_at))}}</td>
											<td>
											  <a data-size="lg"  class="edit-icon" data-toggle="tooltip" title="Edit" href="{{ url('leavetype/edit',$val->id) }}">
											  <i class="fas fa-pencil-alt"></i>
											  </a>
											</td>--> 
										</tr>
										@endforeach
										@else
										<tr><td colspan="7" align="center">No Records Founds</td></tr>
										@endif
									</tbody>
								</table>
					<div class="row align-item-center justify-content-center">
						<div class="col-md-12">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- customar project  end -->
	</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
$('#report-table').DataTable();
</script>

<script type="text/javascript">
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
						$("#formid").attr("action", "{{url('admin/employee/delete')}}");
						this.formid.submit();
						break;
					}
				}	
			}
		}
	}

</script>

@endsection