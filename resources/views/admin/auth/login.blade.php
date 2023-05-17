<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed">
<head>
    <title>Sacko</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Sacko" />
    <meta name="keywords" content="Sacko">
    <meta name="author" content="Sacko" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/open-iconic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/pe-icon-7-stroke.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shreerang-material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/uikit.css') }}">
    <!-- Libs -->
    <link rel="stylesheet" href="{{ asset('assets/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/css/pages/authentication.css') }}">
</head>
<body>

    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>

    <!-- [ Preloader ] End -->
    <!-- [ Content ] Start -->
    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('assets/img/bg/21.jpg');">


        <div class="ui-bg-overlay bg-dark opacity-25"></div>
        <div class="authentication-inner py-5">
            <style>
   .goog-logo-link {
   display:none !important;
}

.goog-te-gadget {
   color: transparent !important;
}

.goog-te-gadget .goog-te-combo {
   color: blue !important;
}

.VIpgJd-ZVi9od-l4eHX-hSRGPd{
   display: none !important;
}

iframe#\:1\.container{
display:none !important;
}
div#goog-gt-{
display:none !important;
}

#goog-gt-tt{
    display: none !important;
}
</style>

<div id="google_translate_element" style="margin-left: 33%;margin-top: 12px;margin-bottom: -9px;"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en',
                includedLanguages: 'en,fr',}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <div class="card">
                <div class="p-4 p-sm-5">
                    <!-- [ Logo ] Start -->
                    <div class="d-flex align-items-center pb-2 mb-4">
                        <div class="ui-w-60">
                            <div class="w-100 position-relative">
                                <img src="{{ asset('assets/img/login-logo.jpeg') }}" alt="Brand Logo" class="sizes img-fluid">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
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
                    <!-- [ Logo ] End -->
                    <h5 class="text-center text-muted font-weight-normal mb-4">Login to Your Account</h5>
                    <!-- Form -->
                    <form action="{{ route('login.post') }}" method="POST" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="text" id="login_email" name="email" required value="{{old('email')}}" class="form-control">
                            @if($errors->has('email'))
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                            <span id="login_email_error" ></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" id="login_password" name="password" required value="{{old('password')}}" class="form-control">
                            @if($errors->has('password'))
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                            @endif
                            <span id="login_password_error"></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center m-0">
                            <label class="custom-control custom-checkbox m-0">
                                <input type="checkbox" name="remember" class="custom-control-input">
                                <span class="custom-control-label">Remember me</span>
                            </label>
                            <button type="submit" class="btn btn-primary" onclick="Login11()" id="login-submit">Sign In</button>
                        </div>
                    </form>
                    <!-- [ Form ] End -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <!-- Core scripts -->
    <script src="{{ asset('assets/js/pace.js') }}"></script>
    <script src="{{ asset('assets/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/sidenav.js') }}"></script>
    <script src="{{ asset('assets/js/layout-helpers.js') }}"></script>
    <script src="{{ asset('assets/js/material-ripple.js') }}"></script>

    <!-- Libs -->
    <script src="{{ asset('assets/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <!-- Demo -->
    <script src="{{ asset('assets/js/demo.js') }}"></script>     
    <script src="{{ asset('assets/js/analytics.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</body>
</html>

<script type="text/javascript">
function Login()
{	
	document.getElementById("login_email_error").innerHTML = '';
	document.getElementById("login_password_error").innerHTML = '';
	var email = $('#login_email').val();
	var password = $('#login_password').val();
	if(email=='')
	{
		//alert('Please Enter email');
		document.getElementById("login_email_error").innerHTML = 'Please Enter Email Address';
		document.getElementById("login_email_error").style.color="red";
	}
	else if(password=='')
	{
		//alert('Please Enter Password');
		document.getElementById("login_password_error").innerHTML = 'Please Enter Password';
		document.getElementById("login_password_error").style.color="red";
	}
	else
	{   
        $.ajax({ 
			type: "GET",
			url:  "admin/login",
			data: {email:email,password:password},
			dataType: 'json',
			success: function(result)
			{	
				if(result=='1')
				{
					document.getElementById("login_success_message").innerHTML = '<div class="alert alert-success" role="alert">Login Successfully!</div>';
					document.getElementById('email').value = '';
					document.getElementById('password').value = '';
					window.location.href = "dashboard";
				}
				else if(result=='2')
				{
					document.getElementById("login_error_message").innerHTML = '<div class="alert alert-danger" role="alert">Username & Password combination does not exists!</div>';
				}
				else if(result=='3')
				{
					//alert('Account Inactive');
					document.getElementById("login_error_message").innerHTML = '<div class="alert alert-danger" role="alert">Account Inactive!</div>';
				}
				
				else
				{
					document.getElementById("login_error_message").innerHTML = '<div class="alert alert-danger" role="alert">Something Went Wrong!</div>';
				}
			}
		});
	}
}
</script>





    