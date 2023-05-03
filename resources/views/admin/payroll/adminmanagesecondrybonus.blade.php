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
            <li class="breadcrumb-item active">Payroll Management / Secondry Bonus</li>
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
                        	<h6 class="card-header" style="color:blue;">Secondry Bonus</Details></h6>
 	<div class="card-body">
								<div class="form-row">
								<table id="report-table" class="table table-bordered table-striped mb-0">
								<thead>
									<tr>
										<th>@lang('message.bonus_name')</th>
										<th>@lang('message.percentage_of_basic_salary')</th>
										<th>Employee Categories</th>
										<th>@lang('message.action')</th>
									</tr>
								</thead>
								<tbody>
									@php
									    $list = DB::table('secondry_bonus')->get();
										foreach($list as $hresult){
									@endphp
									<tr>
										<td>{{$hresult->bonus_name}}</td>
										<td>{{$hresult->percentage_of_basic_salary}}</td>
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
 									 		<a href="{{ url('admin/editsecondrybonus/'.$hresult->id) }}"><i class="feather icon-edit" title="Edit"></i></a>

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
									@php
									 }
									@endphp
								</tbody>
							</table>
							
							</div>	
							</div>
							<form role="form" action="{{ route('admin.manage.savesecondrybonus') }}" method="POST"> 
								                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">

                        	<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Bonus Name</label>
										<input type="text" class="form-control mb-1" required name="bonus_name" id="holiday_name" value="{{old('holiday_name')}}">
										@if($errors->has('holiday_name'))
                                        <div class="text-danger">{{ $errors->first('holiday_name') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Percentage of Basic Salary</label>
										<input type="text" class="form-control mb-1" required name="percentage_of_basic_salary" id="holiday_name" value="{{old('holiday_name')}}">
										@if($errors->has('holiday_name'))
                                        <div class="text-danger">{{ $errors->first('holiday_name') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Applicable employees categories</label>
										<br/><br/>
										@foreach($categories as $result)
										<input type='checkbox' name='employee_category[]' id='employee_category' value='{{$result->id}}' />
										<label for='sales'>{{$result->name}}</label>
										<br/>
										@endforeach
										<input type='checkbox' name='employee_category[]' id='employee_category' value='All Employees' />
										<label for='sales'>All Employees</label>

										@if($errors->has('holiday_name'))
                                        <div class="text-danger">{{ $errors->first('holiday_name') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
                                        <div class="text-right mt-3">
									<button type="submit" name="btnsubmit" class="btn btn-primary">Save</button>&nbsp;
									<a href="{{ route('admin.menu.index') }}" class="btn btn-default">Cancel</a>
							</div>
									</div>
								</div>
							</div>
						</form>
                       
                        	
                       		
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
						url:"{{route('admin.employee.updatesecondstatus')}}",
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