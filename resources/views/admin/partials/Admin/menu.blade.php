<!-- [ Layout sidenav ] Start -->
<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">
	<!-- Brand demo (see assets/css/demo/demo.css) -->
	<div class="app-brand demo">
		<span class="app-brand-logo demo">
			<img src="{{ asset('assets/img/logo.jpeg') }}" alt="Brand Logo" class="img-fluid">
		</span>
		<a href="{{ route('admin.dashboard') }}" class="app-brand-text demo sidenav-text font-weight-normal ml-2"></a>
		<a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
			<i class="ion ion-md-menu align-middle"></i>
		</a>
	</div>
	<div class="sidenav-divider mt-0"></div>
	<!-- Links -->
	<ul class="sidenav-inner py-1">
		<!-- Dashboards -->
		<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
			<a href="{{ route('admin.dashboard') }}" class="sidenav-link">
				<i class="sidenav-icon feather icon-home"></i>
				<div>Dashboards</div>
			</a>
		</li>
		@if(is_object(getMenu(Auth::user()->role_id)))
		@foreach(getMenu(Auth::user()->role_id) as $val)
		<li class="sidenav-item">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
            <i class="{{$val->icon}}"></i>
                <div>{{$val->name}}</div>
            </a>
            <ul class="sidenav-menu">
				@foreach(getSubMenu(Auth::user()->role_id,$val->module_id) as $sub)
                <li class="sidenav-item">
                    <a href="{{route($sub->url)}}" class="sidenav-link">
                        <div>{{$sub->name}}</div>
                    </a>
                </li>
				@endforeach
            </ul>
        </li>
		@endforeach
		@endif

		<!--Admin Menus-->
		@php
			if(Auth::user()->role_id == 1){
		@endphp
		<ul class="sidenav-inner py-1">
			<!-- Dashboards -->
			<li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="{{$val->icon}}"></i>
	                <div>Manage Leave</div>
	            </a>
	            <ul class="sidenav-menu">
	                <li class="sidenav-item">
	                    <a href="{{route($sub->url)}}" class="sidenav-link">
	                        <div>Leave List</div>
	                    </a>
	                </li>
	            </ul>
	        </li>
	        <li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="{{$val->icon}}"></i>
	                <div>Manage Shift</div>
	            </a>
	            <ul class="sidenav-menu">
	                <li class="sidenav-item">
	                    <a href="{{route($sub->url)}}" class="sidenav-link">
	                        <div>Create Shift</div>
	                    </a>
	                </li>
	                <li class="sidenav-item">
	                    <a href="{{route($sub->url)}}" class="sidenav-link">
	                        <div>View Shifts</div>
	                    </a>
	                </li>
	            </ul>
	        </li>
	        <li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="{{$val->icon}}"></i>
	                <div>Manage Projects</div>
	            </a>
	            <ul class="sidenav-menu">
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.managecreateproject') }}" class="sidenav-link">
	                        <div>Create Project</div>
	                    </a>
	                </li>
	                <li class="sidenav-item">
	                    <a href="{{route($sub->url)}}" class="sidenav-link">
	                        <div>View Projects</div>
	                    </a>
	                </li>
	            </ul>
	        </li>
		</ul>
		@php
		 }
		@endphp
		<!--Admin Menus-->

        <!--Employee Menus-->
		@php
			if(Auth::user()->role_id == 3){
		@endphp
		<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
			<a href="{{ route('admin.dashboard') }}" class="sidenav-link">
				<i class="sidenav-icon feather icon-home"></i>
				<div>Apply Leave</div>
			</a>
		</li>
		<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
			<a href="{{ route('admin.dashboard') }}" class="sidenav-link">
				<i class="sidenav-icon feather icon-home"></i>
				<div>Leave List</div>
			</a>
		</li>
		<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
			<a href="{{ route('admin.dashboard') }}" class="sidenav-link">
				<i class="sidenav-icon feather icon-home"></i>
				<div>View Shift</div>
			</a>
		</li>
		<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
			<a href="{{ route('admin.dashboard') }}" class="sidenav-link">
				<i class="sidenav-icon feather icon-home"></i>
				<div>Projects List</div>
			</a>
		</li>
		@php
		 }
		@endphp
		<!--Employee Menus-->

	</ul>
</div>
<!-- [ Layout sidenav ] End -->