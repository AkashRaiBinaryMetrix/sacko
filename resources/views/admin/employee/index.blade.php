@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
	<h4 class="font-weight-bold py-3 mb-0">@lang('message.employee_list') ({{ count($datacountlists)}})</h4>
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
				<form class="" id="sort_customers" action="" method="GET" autocomplete="off">
					<div class="row align-items-center m-l-0">
						<div class="col-sm-3 text-right mb-4">
						<input type="text"  class="form-control employee-input" placeholder="Employee ID/Name" name="txt_search" id="txt_search" @if(!empty( $_GET['txt_search']))value="{{$_GET['txt_search']}}" @endif >
						</div>
						<div class="col-sm-2 text-right ">
							<button type="submit" class="btn btn-primary btn-sm mb-3 btn-round">Search Now</button>
						</div>
						<div class="col-sm-1 text-right">
							<a href="{{ route('admin.employee.index') }}" class="btn btn-info btn-sm mb-3 btn-round"> {{__('Reset')}}</a>
						</div>
					    
						<div class="col-sm-1 text-center">
						  <a href="{{ url('admin/employee/export') }}" data-size="xl" class="btn btn-warning btn-sm mb-3 btn-round">Export</a>
						</div>
						
						<div class="col-sm-2 text-center">
						  <a style="width:78px" href="javascript:muldelete()" data-size="xl" class="btn btn-danger btn-sm mb-3 btn-round"> <i class="feather icon-trash-2"></i> Delete </a>
					    </div>
						<div class="col-sm-2 text-right">
						  <a href="{{ url('admin/employee/create') }}" data-size="xl" class="btn btn-success btn-sm mb-3 btn-round"><i class="feather icon-plus"></i> Add employee </a>
						</div>

					</div>
				</form>
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
						<input type="hidden" name="assign_tl" id="agencyIds">
						<div class="table-responsive">
							<table id="report-table" class="table table-bordered table-striped mb-0">
								<thead>
									<tr>
										<th>
											<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
											<input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)">  All
										</th>
										<th>@lang('message.employee_id')</th>
										<th>@lang('message.employee_type')</th>
										<th>@lang('message.employee_name')</th>
										<th>@lang('message.email')</th>
										<th>@lang('message.mobile')</th>
										<th>@lang('message.image')</th>
										<th>@lang('message.status')</th>
										<th>@lang('message.action')</th>
									</tr>
								</thead>
								<tbody>
									@if(count($employee)>0)
									@foreach($employee as $val)
									<tr>
										<th scope="col">
											<input type="checkbox" class="check_box" name="mul_del[]" id="mul_del[]" value="{{ $val->id }}" />
										</th>
										<td>{{ $val->employee_id }}</td>
										<td>@if($val->employee_type=='0'){{'TL'}}
											@elseif($val->employee_type=='1'){{'Manager'}}
											@endif
										</td>
										<td>{{ $val->first_name. ' '.$val->middle_name. ' '.$val->last_name }}</td>
										<td>{{ $val->email }}</td>
										<td>{{ $val->mobile }}</td>
										<td>
											<div class="col-md-auto col-sm-12">
												<img src="{!! asset($val->image)!!}" alt="" class="d-block ui-w-50 rounded-circle mb-3">
											</div>
										</td>
										<td>
											@if($val->status=='1')<span class="badge badge-success">Active</span>@else<span class="badge badge-danger">InActive</span>@endif
										</td>
										<td>
											<a data-size="lg"  class="btn btn-icon btn-outline-success" data-toggle="tooltip" title="Edit" href="{{ url('admin/employee/edit',$val->id) }}">
												<i class="feather icon-edit"></i>
											</a>
											<a data-size="lg"  class="btn btn-icon btn-outline-primary" data-toggle="tooltip" title="View" href="{{ url('admin/employee/view',$val->id) }}">
												<i class="feather icon-eye"></i>
											</a>
										</td>
									</tr>
									@endforeach
									@else
									<tr><td colspan="13" style="text-align:center"> No record founds</td></tr>
									@endif
								</tbody>
							</table>
						</div>
					</form>
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