@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
	<!-- [ content ] Start -->
	<div class="container-fluid flex-grow-1 container-p-y">
		<h4 class="font-weight-bold py-3 mb-0">@lang('message.role_list')</h4>
		<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
			<ol class="breadcrumb">				
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
				<li class="breadcrumb-item" >@lang('message.role')</li>
				<li class="breadcrumb-item active" >@lang('message.role_list')</li>
			</ol>
		</div>
		<!-- DataTable within card -->
		<div class="card">
			<div class="card-body">
				<div class="row align-items-center m-l-0">
					<div class="col-sm-6"> </div>
					<div class="col-sm-6 text-right">
						<a href="{{ route('admin.role.create') }}" data-title="{{__('Add New')}}" class="btn btn-success btn-sm mb-3 btn-round">
							<i class="feather icon-plus"></i>  {{__('Add New')}}
						</a>
						<a href="javascript:muldelete()" data-title="{{__('Add New')}}" class="btn btn-danger btn-sm mb-3 btn-round">
							<i class="feather icon-trash-2"></i>&nbsp; {{__('Delete')}}
						</a>
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
					</div>
				</div>
				<form id="formid" name="formid" action="" method="post" >
					<div class="card-datatable table-responsive">
						<table id="report-table" class="table table-bordered table-striped mb-0">
							<thead>
								<tr>
									<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
									<th>
										<input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)">  All
									</th>
									<th>@lang('message.name')</th>
									<th>@lang('message.slug')</th>	
									<th>@lang('message.created')</th>
									<th>@lang('message.status')</th>		
									<th>@lang('message.action')</th>
								</tr>
							</thead>
							<tbody>
								@if(count($roles)>0)
								@foreach($roles as $role)
								<tr>
									<td>
										<input type="checkbox" name="mul_del[]" id="mul_del[]" value="{{$role->id}}" />
									</td>
									<td>{{$role->name}}</td>	
									<td>{{$role->role_text}}</td>		
									<td>{{date("d M, y",strtotime($role->created_at))}}</td>
									<td>
										<a class="" href="javascript:" onclick="update_status('{{ $role->id}}',{{abs($role->status-1)}})">
											<span class="btn-status  @if($role->status=='1') {{'badge-success'}} @else {{'badge-warning'}} @endif">
												@if($role->status=='1') {{'Active'}} @else {{'In-Active'}} @endif 
											</span>
										</a>
									</td>
									<td>
										<a data-size="lg" class="btn btn-icon btn-outline-success" data-toggle="tooltip" title="Edit" href="{!! route('admin.role.edit',[$role->id]) !!}">
										<i class="feather icon-edit"></i>
										</a> 
									</td> 
								</tr>
								@endforeach
								@else
								<tr><td colspan="5" style="text-align:center"> No record founds</td></tr>
								@endif
							</tbody>
						</table>
					</div>
				</form>
				<div class="row align-item-center justify-content-center">
					<div class="col-md-12">
						{{$roles->links()}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
$('#report-table').DataTable();
</script>
<script type="text/javascript">
function isValid(formRef)
{
    for(var i=0;i<formRef.elements.length;i++)
    {
		if(formRef.elements[i].type == "checkbox")
		{
			formRef.elements[i].checked = formRef.cb1.checked
		}
    }//end of loop
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
					
					$("#formid").attr("action", "{{url('admin/role/delete')}}");
						this.formid.submit();
						break;
				}
			}	
		}
	}
}
</script>
@endsection