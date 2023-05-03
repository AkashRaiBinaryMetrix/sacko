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
            <li class="breadcrumb-item active">Payroll Management / Add Salary</li>
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
                    	<form role="form" action="{{ route('admin.manage.savesalary') }}" method="POST" enctype="multipart/form-data"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<h6 class="card-header" style="color:blue;">Add Salary</Details></h6>
                       		<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">Employee Name</label>
										<select class="form-control mb-1" required name="emp_name" id="datepicker">
											<option>Select</option>
											@foreach($employeeList as $result)
												<option value="{{$result->id}}">{{$result->first_name}}{{$result->last_name}}</option>
											@endforeach
										</select>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Employee ID</label>
										<input type="readonly" class="form-control mb-1" required name="emp_id" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Project Id</label>
										<select class="form-control mb-1" required name="project_id" id="datepicker">
											<option>Select</option>
											@foreach($projectList as $result)
												<option value="{{$result->id}}">{{$result->title}}</option>
											@endforeach
										</select>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6" style="display: none;">
										<label class="form-label">Proposed Salary($)</label>
										<input type="number" class="form-control mb-1" required name="proposed_salary" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Local Currency</label>
										<select class="form-control mb-1" required name="currency" id="datepicker">
											<option value="GNF">GNF</option>
										</select>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
								    </div>
								    <div class="form-group col-md-6" style="display:none;">
										<label class="form-label">Employee Rate</label>
										<input type="text" class="form-control mb-1" required name="employee_rate" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Monthly Hour</label>
										<input type="text" class="form-control mb-1" required name="monthly_hour" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Hourly rate (USD)</label>
										<input type="text" class="form-control mb-1" required name="hourly_hour" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Basic Salary (GNF)</label>
										<input type="text" class="form-control mb-1" required name="basic_salary" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Prime d'ancienneté</label>
										<input type="text" class="form-control mb-1" required name="prime_sal" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">Prime de rendement</label>
										<input type="text" class="form-control mb-1" required name="prime_rent" id="datepicker"/>
										@if($errors->has('date_select'))
                                        <div class="text-danger">{{ $errors->first('date_select') }}</div>
                                        @endif
                                        <div class="clearfix"></div>
									</div>
								</div>
							</div>
							<div class="text-right mt-3">
									<button type="submit" class="btn btn-primary">Save To Payroll</button>&nbsp;
									<a href="{{ route('admin.menu.index') }}" class="btn btn-default">Cancel</a>
							</div>
							<div class="clearfix"></div>
                        	</div>
                     	</form>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<!-- [ content ] End -->
@endsection