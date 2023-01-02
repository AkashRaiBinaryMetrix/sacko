@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
	<h4 class="font-weight-bold py-3 mb-0">@lang('message.user_list') ({{ count($users)}})</h4>
	<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">@lang('message.users')</a></li>
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
							<a href="javascript:muldelete()" data-size="xl" class="btn btn-sm mb-3 btn-danger btn-round"><i class="feather icon-trash-2"></i> Delete </a>
					    </div>
						<div class="col-sm-2 text-right">
							<a href="{{ url('admin/user/create') }}" data-size="xl" class="btn btn-success btn-sm mb-3 btn-round"><i class="feather icon-plus"></i> Add User </a>
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
										<th>@lang('message.name')</th>
										<th>@lang('message.email')</th>
										<th>@lang('message.mobile')</th>
										<th>@lang('message.role')</th>
										<th>@lang('message.image')</th>
										<th>@lang('message.status')</th>
										<th>@lang('message.action')</th>
									</tr>
								</thead>
								<tbody>
								@if(count($users)>0)
								@foreach($users as $user)
									<tr>
										<th scope="col">
											<input type="checkbox" class="check_box" name="mul_del[]" id="mul_del[]" value="{{ $user->id }}" />
										</th>
										<td>{{ $user->first_name. ' '.$user->middle_name. ' '.$user->last_name }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->mobile }}</td>
										<td>@foreach($roles as $role)
											@if($role['id']==$user['role_id'])
											{{ $role->name }}
											@endif
											@endforeach
										</td>
										<td>
											<div class="col-md-auto col-sm-12">
												<img src="{!! asset($user->image)!!}" alt="" class="d-block ui-w-50 rounded-circle mb-3">
											</div>
										</td>
										<td>
											@if($user->status=='1')<span class="badge badge-success">Active</span>@else<span class="badge badge-danger">Deactive</span>@endif
										</td>
										<td>
											<a data-size="lg"  class="btn btn-icon btn-outline-success" data-toggle="tooltip" title="Edit" href="{{ url('admin/user/edit',$user->id) }}">
												<i class="feather icon-edit"></i>
											</a>
											<a data-size="lg"  class="btn btn-icon btn-outline-primary" data-toggle="tooltip" title="View" href="{{ url('admin/user/view',$user->id) }}">
												<i class="feather icon-eye"></i>
											</a>
										</td>
									</tr>
									@endforeach
									@else
									<tr><td colspan="7" style="text-align:center"> No record founds</td></tr>
									@endif
								</tbody>
							</table>
						</div>
					</form>
					<div class="row align-item-center justify-content-center">
						<div class="col-md-12">
							{{$users->links()}}
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
						$("#formid").attr("action", "{{url('admin/user/delete')}}");
						this.formid.submit();
						break;
					}
				}	
			}
		}
	}
</script>
@endsection