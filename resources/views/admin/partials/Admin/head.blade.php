<!-- General CSS Files -->
@php
    $logo=asset(Storage::url('uploads/logo/'));
@endphp
<head>
   <title>{{!empty($title) ? $title :'Sacko'}}@yield('page-title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Sacko" />
    <meta name="keywords" content="Sacko">
    <meta name="author" content="Codedthemes" />
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
	<link rel="stylesheet" href="{{ asset('assets/libs/datatables/datatables.css') }}">
    <!-- Libs -->
    <link rel="stylesheet" href="{{ asset('assets/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/flot/flot.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	@stack('stylesheets')
</head>