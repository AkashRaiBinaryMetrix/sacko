<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed">
	@include('admin.partials.Admin.head')
	<body>
		<!-- [ Preloader ] Start -->
		<div class="page-loader">
			<div class="bg-primary"></div>
		</div>
		<!-- [ Preloader ] End -->
		<!-- [ Layout wrapper ] Start -->
		<div class="layout-wrapper layout-2">
			<div class="layout-inner">
			@include('admin.partials.Admin.menu')
			
			<!-- [ Layout container ] Start -->
			<div class="layout-container">
			@include('admin.partials.Admin.header')

				<!-- [ Layout content ] Start -->
				<div class="layout-content">
				<!-- [ content ] Start -->
					@yield('content')
				</div>
				@include('admin.partials.Admin.footer')
				<!-- [ Layout content ] Start -->
			</div>
			<!-- [ Layout container ] End -->
			</div>
			<!-- Overlay -->
			<div class="layout-overlay layout-sidenav-toggle"></div>
		</div>
		@include('admin.partials.Admin.script')
		@yield('extra-js')
		@stack('scripts')
	</body>
</html>
