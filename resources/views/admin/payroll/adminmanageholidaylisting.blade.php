@extends('admin.layouts.app')
@section('content')

<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">Payroll Management</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Module</a></li>
            <li class="breadcrumb-item active">Payroll Management / Holiday Listing</li>
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
                        	<h6 class="card-header" style="color:blue;">Holiday Listing</Details></h6>
                       		<div class="card-body">
                       			<style>
	#table_wrapper {
        margin: 4px, 4px;
        padding: 4px;
        overflow-x: auto;
        overflow-y: hidden;
        white-space: nowrap;
    }
</style>
								<div class="form-row" id="table_wrapper">
								<table id="report-table" class="table table-bordered table-striped mb-0">
								<thead>
									<tr>
										<th>@lang('message.date_select')</th>
										<th>@lang('message.holiday_name')</th>
										<th>@lang('message.status')</th>
										<th>@lang('message.applicable_for')</th>
										<th>@lang('message.applicable_employees_categories')</th>
										<th>@lang('message.action')</th>
									</tr>
								</thead>
								<tbody>
									@foreach($holiday_list as $hresult)
									<tr>
										<td>{{$hresult->date_selection}}</td>
										<td>{{$hresult->holiday_name}}</td>
										<td>{{$hresult->holiday_status}}</td>
										<td>{{$hresult->applicable_for}}</td>
										<td>
											@php
											    $idsArr = explode(',',$hresult->employee_category);  
												$holiday_list_emp = DB::table('categories')->whereIn('id',$idsArr)->get();

												foreach($holiday_list_emp as $res){
													echo $res->name.",";
												}
											@endphp
										</td>
 									 	<td>
 									 		<a href="{{ url('admin/editholidaylist/'.$hresult->id) }}"><i class="feather icon-edit" title="Edit"></i></a>
 									 		
 									 		@php
 									 		  if($hresult->status == 0){
 									 		@endphp
 									 		 	<buton type="button" onclick="change_status({{$hresult->id}},1);">Active</buton>
 									 		@php
 									 		 }else{
 									 		@endphp 	
 									 			<buton type="button" onclick="change_status({{$hresult->id}},0);">De-Active</buton>
 									 	    @php
 									 	     }
 									 	    @endphp

 									 	</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							
							</div>	
							</div>
							<div class="clearfix"></div>
                        	</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function change_status(id,status){
		$.ajax({
						url:"{{route('admin.employee.updateholidaystatus')}}",
						type: "POST",
						data: {
							 id: id,
							 status: status,
							_token: '{{csrf_token()}}' 
						},
						dataType : 'json',
						success: function(result){
								window.location.reaload();
						}
		});
	}
</script>
<!-- [ content ] End -->
@endsection