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
	<br/><br/>

	

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
				@php
 							if($sub->name == "Manage Employee"){

 							}else{
                        @endphp
                <li class="sidenav-item">
                    <a href="{{route($sub->url)}}" class="sidenav-link">
                        
                        	<div>
                        		{{$sub->name}}
                        	</div>
                       
                    </a>
                </li>
                 @php
                         }
                        @endphp
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
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Leaves Management</div>
	            </a>
	            <ul class="sidenav-menu">
	                <li class="sidenav-item">
	                    <a href="{{route($sub->url)}}" class="sidenav-link">
	                        <div>Leave List</div>
	                    </a>
	                </li>
	            </ul>
	        </li>
	        <!-- <li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="{{$val->icon}}"></i>
	                <div>Manage Shift</div>
	            </a>
	            <ul class="sidenav-menu">
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.managecreateshift') }}" class="sidenav-link">
	                        <div>Create Shift</div>
	                    </a>
	                </li>
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.manageshiftlist') }}" class="sidenav-link">
	                        <div>View Shifts</div>
	                    </a>
	                </li>
	            </ul>
	        </li> -->
	        <li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Projects Management</div>
	            </a>
	            <ul class="sidenav-menu">
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.managecreateproject') }}" class="sidenav-link">
	                        <div>Create Project</div>
	                    </a>
	                </li>
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.manageprojectlist') }}" class="sidenav-link">
	                        <div>View/Edit Projects</div>
	                    </a>
	                </li>
	            </ul>
	        </li>
	        <li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Payroll Management</div>
	            </a>
	            <ul class="sidenav-menu">
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.managecalendarconfiguration') }}" class="sidenav-link">
	                        <div>Add New Holiday</div>
	                    </a>
	                </li>
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.manageholidaylisting') }}" class="sidenav-link">
	                        <div>Holiday Listing</div>
	                    </a>
	                </li>
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.managetaxconfiguration') }}" class="sidenav-link">
	                        <div>Tax Configuration</div>
	                    </a>
	                </li>
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.manageprimarybonus') }}" class="sidenav-link">
	                        <div>Manage Primary Bonus</div>
	                    </a>
	                </li>
	                 <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.managesecondrybonus') }}" class="sidenav-link">
	                        <div>Manage Secondry Bonus</div>
	                    </a>
	                </li>
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.managesalaryadmin') }}" class="sidenav-link">
	                        <div>Add Payroll</div>
	                    </a>
	                </li>
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.managesalarylisting') }}" class="sidenav-link">
	                        <div>Payroll Listing</div>
	                    </a>
	                </li>
	            </ul>
	        </li>
		</ul>
		@php
		 }
		@endphp
		<!--Admin Menus-->

		<!--Manager Menus-->
		@php
			if(Auth::user()->role_id == 2){
		@endphp
		<li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Attendance Management</div>
	            </a>
	            <ul class="sidenav-menu">
	               <li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.managerbulkpunchin') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Bulk Punch-In</div>
						</a>
					</li>
					 <!-- <li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.managerattendancelist') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Attendance List</div>
						</a>
					</li> -->
	            </ul>
	    </li>
		@php
		 }
		@endphp
		<!--Manager Menus-->

        <!--Employee Menus-->
		@php
			if(Auth::user()->role_id == 3){
		@endphp
		<li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Leaves Management</div>
	            </a>
	            <ul class="sidenav-menu">
	               <li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.applyleave') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Apply Leave</div>
						</a>
					</li>
					<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.leavelist') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>View Leave List</div>
						</a>
					</li>
	            </ul>
	    </li>
	    <li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Projects Management</div>
	            </a>
	            <ul class="sidenav-menu">
	               	<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.projectlist') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>View Projects</div>
						</a>
					</li>
	            </ul>
	    </li>
	    <li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Projects Management</div>
	            </a>
	            <ul class="sidenav-menu">
	               	<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.projectlist') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>View Projects</div>
						</a>
					</li>
	            </ul>
	    </li>
		@php
		 }
		@endphp
		<!--Employee Menus-->

	</ul>
</div>
<!-- [ Layout sidenav ] End -->