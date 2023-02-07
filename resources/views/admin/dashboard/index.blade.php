@extends('admin.layouts.app')
@section('content')
<style>
    .col-12.text-center img {
    background: #F5F5F5;
    box-shadow: 0px 0px 4px rgb(0 0 0 / 35%);
    border-radius: 10px;
    padding: 12px;
    margin-bottom: 17px;
}
</style>
<link rel="stylesheet" href="{{ asset('assets/css/attendance.css') }}">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">Dashboard</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        </ol>
    </div>
    <div class="row">
        <!-- customar project  start -->
    	@php $role_name = explode(",",Auth::user()->role_name);
        @endphp
        @if($user->role_id=='1')
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-12 text-center">
                            <img src="{{asset('assets/img/hrm.svg') }}">
                        </div>
                        <div class="col-12 text-center">
                            <h2 class="m-b-0">HRM <br>Managment</h2>
                            <!--<h6 class="text-muted m-b-10">Dealer</h6>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-12 text-center">
                            <img src="{{asset('assets/img/hrm.svg') }}">
                        </div>
                        <div class="col-12 text-center">
                            <h2 class="m-b-0">HAULAGE <br>Managment</h2>
                            <!--<h6 class="text-muted m-b-10">Dealer</h6>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-12 text-center">
                            <img src="{{asset('assets/img/hrm.svg') }}">
                        </div>
                        <div class="col-12 text-center">
                            <h2 class="m-b-0">Purchase &<br>Logistics</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-12 text-center">
                            <img src="{{asset('assets/img/hrm.svg') }}">
                        </div>
                        <div class="col-12 text-center">
                            <h2 class="m-b-0">FLEET<br> Managment</h2>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-12 text-center">
                            <img src="{{asset('assets/img/hrm.svg') }}">
                        </div>
                        <div class="col-12 text-center">
                            <h2 class="m-b-0">Admin &<br> Finance</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($user->role_id=='3')
        <div class="col-md-4">
            <div class="card punch-status">
                <div class="card-body">
                    <h5 class="card-title">Timesheet 
                        <small class="text-muted">31 January 2023</small>
                    </h5>
                    <div class="punch-det">
                        <h6>Punch In at</h6>
                        <p>Tuesday, 31st Jan 2023 
                           <input type="hidden" name="display_time" id="display_time"/>     
                        </p>
                    </div>
                    <div class="punch-info">
                        <div class="punch-hours">
                            <span>0 hrs</span>
                        </div>
                    </div>
                    <div class="punch-btn-section">
                        
                        <form action="{{ route('attendance.process') }}" method="post">
                            @csrf
                            <input type="hidden" name="mark_state" id="mark_state"/>
                            <input type="hidden" name="current_date" id="current_date"/>
                            <input type="hidden" name="current_time" id="current_time"/>
                            <input type="hidden" name="ampm" id="ampm"/>
                            <button type="submit" class="btn btn-primary punch-btn" id="punchin" style="display:none;">Punch In</button>

                            <button type="submit" class="btn btn-primary punch-btn" id="punchout" style="display:none;">Punch Out</button>
                        </form>

                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        </div>
                        <div class="statistics">
                            <div class="row">
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box">
                                        <p>Break</p>
                                        <h6>0 hrs</h6>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box">
                                        <p>Overtime</p>
                                        <h6>0 hrs</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card att-statistics">
                    <div class="card-body">
                        <h5 class="card-title">Statistics</h5>
                        <div class="stats-list">
                            <div class="stats-info">
                                <p>Today <strong>0 <small>/ 8 hrs</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100" style="width: 31%;"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>This Week <strong>0 <small>/ 40 hrs</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100" style="width: 31%;"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>This Month <strong>0 <small>/ 160 hrs</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%;"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Remaining <strong>0 <small>/ 160 hrs</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%;"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Overtime <strong>0</strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" style="width: 22%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card recent-activity">
                    <div class="card-body">
                        <h5 class="card-title">Today Activity</h5>
                        <ul class="res-activity-list">
                            <li>
                                <p class="mb-0">No Activity</p>
                            </li>
                            <!-- <li>
                                <p class="mb-0">Punch In at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>10.00 AM.
                                </p>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row filter-row">
        <div class="col-sm-3">
            <div class="form-group form-focus select-focus">
                <div>
                    <input type="date" class="form-control floating datetimepicker">
                </div>
                <label class="focus-label">Date</label>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group form-focus select-focus">
                <select class="form-control select2 select2-hidden-accessible" name="status" required="">                       
					<option data-select2-id="38">-</option>
                    <option>Jan</option>
                    <option>Feb</option>
                    <option>Mar</option>
                    <option>Apr</option>
                    <option>May</option>
                    <option>Jun</option>
                    <option>Jul</option>
                    <option>Aug</option>
                    <option>Sep</option>
                    <option>Oct</option>
                    <option>Nov</option>
                    <option>Dec</option>
				</select>
                <label class="focus-label">Select Month</label>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group form-focus select-focus">
                <select class="form-control select2 select2-hidden-accessible" name="status" required="">
                    <option data-select2-id="41">-</option>                      
					<option>2019</option>
                    <option>2018</option>
                    <option>2017</option>
                    <option>2016</option>
                    <option>2015</option>
				</select>
                <label class="focus-label">Select Year</label>
            </div>
        </div>
        <div class="col-sm-3">
            <a href="#" class="btn btn-success btn-block w-100"> Search </a>
        </div>
        
        <div class="col-sm-3">
            <a href="#" class="btn btn-success btn-block w-100"> Export to excel </a>
        </div>

        <br/><br/>

        <div class="col-sm-12 row">
        <div class="col-lg-12">
            <div class="table-responsive mb-4">
                <table class="table table-striped custom-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date </th>
                            <th>Punch In</th>
                            <th>Punch Out</th>
                            <th>Production</th>
                            <th>Break</th>
                            <th>Overtime</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendances_result)
                        <tr>
                            <td>1</td>
                            <td>31 Jan 2023</td>
                            <td>{{$attendances_result->punchin_time}} {{$attendances_result->punchin_time_ampm}}</td>
                            <td>{{$attendances_result->punchout_time}} {{$attendances_result->punchout_time_ampm}}</td>
                            <td>9 hrs</td>
                            <td>0 hrs</td>
                            <td>0</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
   

    </div>
</div>
<!-- [ content ] End -->

@endsection