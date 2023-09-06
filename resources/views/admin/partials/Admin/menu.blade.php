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
		@php
			if($val->name != "Attendance Management"){
		@endphp
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
        @php
         }
        @endphp
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
	                <div>Employee Management</div>
	            </a>
	            <ul class="sidenav-menu">
	            	<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.index') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Add Employee</div>
						</a>
					</li>
	               <li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.index') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>View/Edit Employees</div>
						</a>
					</li>
	            </ul>
	    	</li>
	    <!-- 	<li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Fleet Management</div>
	            </a>
	            <ul class="sidenav-menu">
	            	<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.index') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Add Vehicle</div>
						</a>
					</li>
	               <li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.index') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>View/Edit Vehicles</div>
						</a>
					</li>
	            </ul>
	    	</li> -->
	    	<li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Payment Management</div>
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
	                    <a href="{{ route('admin.manage.advancepayment') }}" class="sidenav-link">
	                        <div>Advance Payment</div>
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
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.managesalarylisting') }}" class="sidenav-link">
	                        <div>Generate Payslip</div>
	                    </a>
	                </li>
	            </ul>
	        </li>
		</ul>
		@php
		 }
		@endphp
		<!--Admin Menus-->
	</ul>
</div>
<!-- [ Layout sidenav ] End -->