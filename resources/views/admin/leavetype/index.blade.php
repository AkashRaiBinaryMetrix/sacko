@extends('layouts.app')
@section('content')
<div class="page-content">
    <div class="page-title">
		<div class="row justify-content-between align-items-center">
			<div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
				<div class="d-inline-block">
					<h5 class="h4 d-inline-block font-weight-400 mb-0 "> Leave Type ({{ count($datacountlists)}})
					  
					</h5>
				</div>
			</div>         
			<div class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
				<div class="all-button-box row d-flex justify-content-end">
					<!--<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
						<a href="{{ route('leavetype.create') }}" data-size="xl"  data-title="{{__('Add New')}}" class="btn btn-xs btn-white btn-icon-only width-auto">
							<i class="fa fa-plus"></i> {{__('Add New')}}
						</a>
					</div>
					<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
						<a href="javascript:muldelete()" data-size="xl" class="btn btn-xs btn-white btn-icon-only width-auto"> Delete </a>
					</div>-->
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
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
                <div class="col">
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
											<th>Name</th>
											<th>Total in Year</th>
											<th>Total in Month</th>
											<th>Status</th>
											<!--<th>Action</th>-->
										</tr>
                                    </thead>
                                    <tbody class="list">
										@if(is_object($lists))
										@foreach($lists as $val)
										<tr>
											<th scope="col">
											<input type="checkbox" class="check_box" name="mul_del[]" id="mul_del[]" value="{{ $val->id }}" /></th>
											<td>{{$val->name}}</td>
											<td>{{$val->total_in_year}} Days</td>
											<td>{{$val->total_in_month}} Days</td>
											<td>
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
					$("#formid").attr("action", "{{url('leavetype/delete')}}");
					this.formid.submit();
					break;
				}
			}	
		}
	}
}
 </script>
@endsection
