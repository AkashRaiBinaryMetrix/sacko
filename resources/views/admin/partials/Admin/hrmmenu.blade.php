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
		<li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Employee Management</div>
	            </a>
	            <ul class="sidenav-menu">
	               <li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.index') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Employee dashboard</div>
						</a>
					</li>
					<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.index') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Add Employee</div>
						</a>
					</li>
					<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.dashboard') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Attendance Management</div>
						</a>
					</li>
					<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.dashboard') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Payroll</div>
						</a>
					</li>
	            </ul>
	    </li>
	    <li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Career Management</div>
	            </a>
	            <ul class="sidenav-menu">
	               	<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.category.index') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Employment category</div>
						</a>
					</li>
					<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.department.index') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Department</div>
						</a>
					</li>
					<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.sub_category.index') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Subcategory</div>
						</a>
					</li>
					<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.dashboard') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>ID Type</div>
						</a>
					</li>
					<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.dashboard') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Leave Type</div>
						</a>
					</li>
	            </ul>
	    </li>
	    <li class="sidenav-item">
	            <a href="javascript:" class="sidenav-link sidenav-toggle">
	            <i class="sidenav-icon feather icon-home"></i>
	                <div>Payment Admin</div>
	            </a>
	            <ul class="sidenav-menu">
	               	<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="#" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>Configuration of Payment</div>
						</a>
					</li>
	            </ul>
	    </li>
		

	</ul>
</div>
<!-- [ Layout sidenav ] End -->