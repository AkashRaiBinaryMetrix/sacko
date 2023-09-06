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


---------------------------

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
					<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.presentemployee') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>View Present Employees</div>
						</a>
					</li>
					<li class="sidenav-item {{ Request::is('dashboard') ? 'active' : '' }}">
						<a href="{{ route('admin.employee.absentemployee') }}" class="sidenav-link">
							<i class="sidenav-icon feather icon-home"></i>
							<div>View Absent Employees</div>
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

---------------------------

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
	                    <a href="{{ route('admin.manage.advancepayment') }}" class="sidenav-link">
	                        <div>Advance Payment</div>
	                    </a>
	                </li>
	                <li class="sidenav-item">
	                    <a href="{{ route('admin.manage.managesalarylisting') }}" class="sidenav-link">
	                        <div>Payroll Listing</div>
	                    </a>
	                </li>
	            </ul>
	        </li>

---------------------------

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

---------------------------

$target            		= 'storage/uploads/employee/';
				$employeeId     		= $request->file('certificate');                
				if(!empty($employeeId))
				{
					$headerImageName	= $employeeId->getClientOriginalName();
					$ext1				= $employeeId->getClientOriginalExtension();
					$temp1				= explode(".",$headerImageName);					
					$newHeaderLogo		= 'employee'.round(microtime(true)).".".end($temp1);				
					$headerTarget		= 'storage/uploads/employee/'.$newHeaderLogo;
					$employeeId->move($target,$newHeaderLogo);	
				} 
				else
				{
					$headerTarget				  = '';
				}

---------------------------

$employee->employee_id    	  	  = generateEmployeeId();
               
				$employee->hierarchy_id    	  	  = $request['hierarchy_id'];
				$employee->employee_type 		  = $request['employee_type']; 
				
				$employee->resident 		  	  = $request['resident'];
                $employee->professional_type      = $request['professional_type'];
                $employee->gender     	  		  = $request['gender'];
				$employee->home_address 		  = $request['home_address'];
               
				$employee->status 	      		  = $request['status'];		
				$employee->certificate	      	  = $headerTarget;
				$employee->created_by   		  = Auth::user()->id;	
			    $employee->shift_id               = $request["shift_id"];

---------------------------