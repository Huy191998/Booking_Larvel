<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->

    <title>@yield('title')</title>
    <!-- Custom CSS -->

    <!-- Custom CSS -->
    @include('links.bootstrap')
    <link rel="stylesheet" type="text/css" href="{!! asset('css/style.min.css') !!}">

</head>

<body>
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
     data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    @include('sharedAdmin.header')
    @include('sharedAdmin.left-sidebar')
    <div class="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>


</body>
<footer class="footer text-center container">
    Tất cả các quyền của Quản trị viên Booking. Được thiết kế và phát triển bởi <a href="https://wrappixel.com">bookingHotelQH</a>.
</footer>
@include('links.scriptdelete')

</html>
