@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
	<h4 class="font-weight-bold py-3 mb-0">Menu List ({{ count($datacountlists)}})</h4>
	<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
			<li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Menu</a></li>
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
						  <a href="javascript:muldelete()" data-size="xl" class="btn btn-danger btn-sm mb-3 btn-round"><i class="feather icon-trash-2"></i> Delete </a>
					    </div>
						<div class="col-sm-2 text-right">
						  <a href="{{ url('admin/admin-menu/create') }}" data-size="xl" class="btn btn-success btn-sm mb-3 btn-round"><i class="feather icon-plus"></i> Add Menu </a>
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
										<th>Menu Name</th>
										<th>Parent</th>
										<th>Created At</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@if(count($menus)>0)
									@foreach($menus as $menu)
									<tr>
										<th scope="col">
											<input type="checkbox" class="check_box" name="mul_del[]" id="mul_del[]" value="{{ $menu->id }}" />
										</th>
										<td>{{ $menu->name }}</td>
										<td>@if(is_object($parent_menus) && !empty($parent_menus))
											@foreach($parent_menus as $parent)
											@if($parent->id==$menu->parent_menu_id)
											{{ $parent->name }}
											@endif
											@endforeach
										    @endif
										</td>
										<td>{{date("d M, y",strtotime($menu->created_at))}}</td>
										<td>
										@if($menu->status=='1')<span class="badge badge-success">Active</span>@else<span class="badge badge-danger">Deactive</span>@endif
										</td>
										<td>
											<a data-size="lg"  class="btn btn-icon btn-outline-success" data-toggle="tooltip" title="Edit" href="{{ url('admin/admin-menu/edit',$menu->id) }}">
											<i class="feather icon-edit"></i>
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
							{{$menus->links()}}
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
						$("#formid").attr("action", "{{url('admin/admin-menu/delete')}}");
						this.formid.submit();
						break;
					}
				}	
			}
		}
	}
</script>
@endsection