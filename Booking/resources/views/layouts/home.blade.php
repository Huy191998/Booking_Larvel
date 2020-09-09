<!DOCTYPE html>
<html lang="en">
<head>
    <title>Travelix</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Travelix Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="{!! asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet') !!}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{!! asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('plugins/OwlCarousel2-2.2.1/animate.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('styles/main_styles.css')!!}">
    <link rel="stylesheet" type="text/css" href="{!!asset('styles/responsive.css')!!}">
    <script src="https://kit.fontawesome.com/83883d8e8f.js" crossorigin="anonymous"></script>


</head>

<body>

<div class="super_container">

    <!-- Header -->
@include('shared.header')

@yield('content')


<!-- Footer -->
@yield('footer')


<!-- Copyright -->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-lg-1 order-2  ">
                    <div class="copyright_content d-flex flex-row align-items-center">
                        <div><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                            booking hotel <i class="fa fa-heart-o"
                                             aria-hidden="true"></i> by <a
                                href="https://colorlib.com" target="_blank">lnq</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
                    </div>
                </div>
                <div class="col-lg-9 order-lg-2 order-1">
                    <div class="footer_nav_container d-flex flex-row align-items-center justify-content-lg-end">
                        <div class="footer_nav">
                            <ul class="footer_nav_list">
                                <li class="footer_nav_item"><a href="#">Trang chủ</a></li>
                                <li class="footer_nav_item"><a href="">Liên hệ</a></li>
                                <li class="footer_nav_item"><a href="">Bài viết</a></li>
                                <li class="footer_nav_item"><a href="">My hotel</a></li>
                                <li class="footer_nav_item"><a href="">khách sạn</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

<script src="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('plugins/easing/easing.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>

<script src="{{asset('plugins/Isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('plugins/easing/easing.js')}}"></script>
<script src="{{asset('plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('js/offers_custom.js')}}"></script>

</body>

</html>
