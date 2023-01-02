@extends('layouts.app')
@section('content')
<div class="page-content">
	<div class="page-title">
		<div class="row justify-content-between align-items-center">
			<div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
				<div class="d-inline-block">
					<h5 class="h4 d-inline-block font-weight-400 mb-0 "> Edit Holiday Session
					</h5>
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
		</div>
		<div class="col">
			<div class="card bg-none card-box">
				<form class="p-4" action="{{ url('holiday-session/update',$lists->id) }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<div class="form-group col-lg-6 col-md-6">
							<label for="name" class="form-control-label">{{'Group'}}</label>
							<select class="form-control select2 select2-hidden-accessible" name="group_id" >                       
								<option value=''>Select</option>
								@foreach($group as $val)
								<option value='{{$val->id}}' @if(old('group_id',$lists->group_id)==$val->id){{'selected="true"'}}@endif >{{$val->name}}</option>
								@endforeach
							</select> 
							@if($errors->has('group_id'))
							<div class="text-danger">{{ $errors->first('group_id') }}</div>
							@endif
						</div>
						<div class="form-group col-lg-6 col-md-6">
							<label for="contact" class="form-control-label">{{'Session'}}</label>
							@php $current_session = date('Y');@endphp
							<select class="form-control select2 select2-hidden-accessible" name="session" onchange="gotopage(this)" >     
								@for($i=$current_session; $i<=$current_session+5; $i++)
								<option value='{{$i}}' @if($session==$i){{'selected="true"'}}@endif>{{$i}}</option>     
								@endfor
							</select>
							@if($errors->has('session'))
							<div class="text-danger">{{ $errors->first('session') }}</div>
							@endif
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<table class="table table-striped mb-0" id="dataTable-1">
									<thead>
										<tr>
											<th>Holiday Name </th>
											<th>Holiday Date </th>
											<!--<th>Holiday End </th>-->
											<th>Permissions </th>
										</tr>
									</thead>
									<tbody>
									@foreach($holiday_calendar as $key => $dash)
									@php  $permission = HolidayPermission($dash->id,$lists->id); @endphp
									<tr>
										<td>
											<input  type="hidden" name="holiday_id[]" value="{{$dash->id}}">
											{{$dash->holiday_name}}	
										</td>
										<td>{{date("d M, y",strtotime($dash->holiday_start))}}</td>
										<!--<td>{{date("d M, y",strtotime($dash->holiday_end))}}</td>-->
										<td>
											<div class="row">
												<div class="col-md-12 custom-control custom-checkbox">
													<input class="custom-control-input" id="can_manage{{$key}}" name="can_manage[{{$dash->id}}]" type="checkbox" value="1" @if(is_object($permission) && !empty($permission))  @if($permission['can_manage']=='1'){{'checked'}} @endif @endif>
													<label for="can_manage{{$key}}" class="custom-control-label font-weight-500"></label>
													<br>
												</div>
											</div>
										</td>
									</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<button type="submit" class="btn-create badge-blue">Save</button>
						<a href="{{ route('holiday-session.index') }}" class="btn-create bg-gray"> {{__('Cancel')}}</a>
					</div>
				</div> 
			</form> 
		</div>
	</div>
</div>
@stop
<script type="text/javascript">
function gotopage(selval)
{	
	var value = '?session='+selval.options[selval.selectedIndex].value;
	window.location.href=value;
}
</script>