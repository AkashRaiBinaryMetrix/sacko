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
                            <h2 class="m-b-0">FLEET<br> Managment</h2>
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
                            <h2 class="m-b-0">Admin &<br> Finance</h2>
                            <!--<h6 class="text-muted m-b-10">Dealer</h6>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('message.users')</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-primary users_date_range"><i class="fa fa-calendar fa-lg"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <br>
                                <div class="chart">
                                    <canvas id="usersChart" height="250" style="height: 250px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
   

    </div>
</div>
<!-- [ content ] End -->
@endsection