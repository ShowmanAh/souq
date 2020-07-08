
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
          content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>  @yield('title') </title>

    @include('layouts.dashboard.includes.csslinks')
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>
<body class="vertical-layout vertical-menu 2-columns  @if(Request::is('admin/users/tickets/reply*')) chat-application @endif menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu" data-col="2-columns">
<!-- fixed-top-->

<!-- Begin Header -->
@include('layouts.dashboard.includes.header')
<!--End  Header -->

<!-- Begin SideBar-->
@include('layouts.dashboard.includes.sidebar')

<!--End Sidebare-->


@yield('content')

<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('layouts.dashboard.includes.footer')


<!-- BEGIN VENDOR JS-->
@include('layouts.dashboard.includes.vendor')

</body>
</html>

