<header class="header">

    <!-- Top Bar -->

    <div class="top_bar">
        <div class="container">
            <div class="row">
                <div class="col d-flex flex-row">
                    <div class="phone">+84 335 820 697</div>
                    <div class="social">
                        <ul class="social_list">
                            <li class="social_list_item"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            </li>
                            <li class="social_list_item"><a href="#"><i class="fa fa-facebook"
                                                                        aria-hidden="true"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa fa-twitter"
                                                                        aria-hidden="true"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa fa-dribbble"
                                                                        aria-hidden="true"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa fa-behance"
                                                                        aria-hidden="true"></i></a></li>
                            <li class="social_list_item"><a href="#"><i class="fa fa-linkedin"
                                                                        aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="user_box ml-auto">
                        @if(Auth::check())

                            <div class=" user_box_link"><a href="{{route('logout')}}">{{ Auth::user()->name }}</a></div>

                        @else
                            <div class="user_box_login user_box_link"><a href="{{route('login')}}">Đăng Nhập</a></div>
                            <div class="user_box_register user_box_link"><a href="{{route('peoples.create')}}">Đăng
                                    ký</a></div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div>
        @if(Session::has('message'))
            <div id="div-alert" style="position:absolute; right: 10px;width:320px; height: 100px"
                 class="float-right  alert alert-success alert-dismissible show" role="alert">
                <div style="text-align: center; margin-top: 28px;">
                    <strong>{{ Session::get('message') }}</strong>
                </div>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="top: 30px">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
        @elseif(Session::has('err'))
            <div id="div-alert" style="position:absolute; right: 10px;width:320px; height: 100px"
                 class="float-right  alert alert-success alert-dismissible show" role="alert">
                <div style="text-align: center; margin-top: 30px">
                    <strong>{{ Session::get('err') }}</strong>
                </div>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="top: 30px">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        @endif
    </div>
    <!-- Main Navigation -->

    <nav class="main_nav">
        <div class="container">
            <div class="row">
                <div class="col main_nav_col d-flex flex-row align-items-center justify-content-start">
                    <div class="logo_container">
                        <div class="logo"><a href="{{url('client/')}}"><img src="{{asset('images/logo.png')}}" alt="">booking
                                hotel</a></div>
                    </div>
                    <div class="main_nav_container ml-auto">
                        <ul class="main_nav_list">
                            <li class="main_nav_item"><a href="{{url('client/')}}">Trang chủ</a></li>
                            <li class="main_nav_item"><a href="{{route('blog')}}">Bài Viết</a></li>
                            <li class="main_nav_item"><a href="{{route('listhotels')}}"> Khách sạn</a></li>
                            @if(Auth::user())
                                <li class="main_nav_item"><a href="{{url('Hotels/hotel')}}">My Hotel</a></li>
                                <li class="main_nav_item"><a href="{{route('user')}}">Thông tin</a></li>
                            @endif
                        </ul>
                    </div>


                    <form id="search_form" class="search_form bez_1">
                        <input type="search" class="search_content_input bez_1">
                    </form>

                    <div class="hamburger">
                        <i class="fa fa-bars trans_200"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>


</header>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>
    $(document).ready(function() {
        $("#div-alert").delay(3000).slideUp();
    });

</script>
