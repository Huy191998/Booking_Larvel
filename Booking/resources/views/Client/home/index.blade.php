@extends('layouts.home')
@section('content')




    <div class="home">

        <div class="home_slider_container">

            <div class="owl-carousel owl-theme home_slider">
                @foreach( $slide as $key => $slides)
                    <div class="owl-item home_slider_item">
                        <div class="home_slider_background"
                             style="">
                            <img src="{{asset('images/'.$slides->image)}}">
                        </div>
                        <div class="home_slider_content text-center">
                            <div class="home_slider_content_inner" data-animation-in="flipInX"
                                 data-animation-out="animate-out fadeOut">
                                <h1 style="font-size: 72px">{!! Str::limit($slides->ct,25,'...')!!}</h1> &nbsp;
                                <h1 style="font-size: 60px">{!! Str::limit($slides->description ,35,'...')!!}</h1>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="search">
        <!-- Search Contents -->
        <div class="container fill_height">
            <div class="row fill_height">
                <div class="col fill_height">

                    <!-- Search Tabs -->

                    <div class="search_tabs_container">
                        <div
                            class="search_tabs d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">
                            <div
                                class="search_tab  d-flex flex-row align-items-center justify-content-lg-center justify-content-start">
                                <img src="images/suitcase.png" alt=""><span>Khách sạn</span></div>

                        </div>
                    </div>

                    <!-- Search Panel -->

                    <div class="search_panel active">
                        <form action="{{route('searchrooms')}}" id="search_form_1"
                              class="search_panel_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">
                            <div class="search_item">
                                <div>Ngày</div>
                                <input type="text" name="daterange" class="destination search_input" required="required"
                                       id="daterange" placeholder="YYYY-MM-DD">
                            </div>
                            <div class="search_item">
                                <div>Thành phố</div>
                                <select name="city_id" class="dropdown_item_select search_input">
                                    <option value="null">Chọn thành phố</option>
                                    @foreach ($cities as $key => $city)
                                        <option value="{{$city->id}}">
                                            {{ $city->Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="search_item">
                                <div>Người lớn</div>
                                <input type="number" name="People" class="check_in search_input" placeholder="">
                            </div>
                            <div class="search_item">
                                <div>Trẻ em</div>
                                <input type="number" name="childrenPeople" class="check_out search_input"
                                       placeholder="">
                            </div>


                            <button class="button search_button">Tìm kiếm<span></span><span></span><span></span>
                            </button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->

    <div class="testimonials">
        <div class="test_border"></div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="intro_title text-center">Địa điểm nổi bật</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="intro_text text-center">
                        <p>Cùng Booking Hotel QH bắt đầu chuyến hành trình chinh phục thế giới của bạn </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">

                    <div class="test_slider_container">
                        <div class="owl-carousel owl-theme test_slider">
                            <!-- Testimonial Item -->
                            @foreach( $cities as $key => $cities )
                                <a href="{{route('showhotels',$cities->id)}}">
                                    <div class="owl-item">
                                        <div class="test_item">
                                            <div class="test_image">
                                                <img style="width: 350px; height: 484px"
                                                     src="{{asset('img')}}/{{$cities->image}}"
                                                     alt="https://unsplash.com/@anniegray"></div>


                                            <div class="test_content_container">
                                                <div class="test_content">
                                                    <div class="test_item_info">
                                                        <div
                                                            class="test_name">{!! Str::limit($cities->Name ,25,'...')!!}</div>
                                                    </div>
                                                    <div
                                                        class="test_quote_title">{!! Str::limit($cities->Status,25,'...')!!}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            @endforeach
                        </div>

                        <!-- Testimonials Slider Nav - Prev -->
                        <div class="test_slider_nav test_slider_prev">
                            <svg version="1.1" id="Layer_6" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="28px" height="33px" viewBox="0 0 28 33" enable-background="new 0 0 28 33"
                                 xml:space="preserve">
            								<defs>
                                                <linearGradient id='test_grad_prev'>
                                                    <stop offset='0%' stop-color='#fa9e1b'/>
                                                    <stop offset='100%' stop-color='#8d4fff'/>
                                                </linearGradient>
                                            </defs>
                                <path class="nav_path" fill="#F3F6F9" d="M19,0H9C4.029,0,0,4.029,0,9v15c0,4.971,4.029,9,9,9h10c4.97,0,9-4.029,9-9V9C28,4.029,23.97,0,19,0z
            								M26,23.091C26,27.459,22.545,31,18.285,31H9.714C5.454,31,2,27.459,2,23.091V9.909C2,5.541,5.454,2,9.714,2h8.571
            								C22.545,2,26,5.541,26,9.909V23.091z"/>
                                <polygon class="nav_arrow" fill="#F3F6F9" points="15.044,22.222 16.377,20.888 12.374,16.885 16.377,12.882 15.044,11.55 9.708,16.885 11.04,18.219
            								11.042,18.219 "/>
            							</svg>
                        </div>

                        <!-- Testimonials Slider Nav - Next -->
                        <div class="test_slider_nav test_slider_next">
                            <svg version="1.1" id="Layer_7" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="28px" height="33px" viewBox="0 0 28 33" enable-background="new 0 0 28 33"
                                 xml:space="preserve">
            								<defs>
                                                <linearGradient id='test_grad_next'>
                                                    <stop offset='0%' stop-color='#fa9e1b'/>
                                                    <stop offset='100%' stop-color='#8d4fff'/>
                                                </linearGradient>
                                            </defs>
                                <path class="nav_path" fill="#F3F6F9" d="M19,0H9C4.029,0,0,4.029,0,9v15c0,4.971,4.029,9,9,9h10c4.97,0,9-4.029,9-9V9C28,4.029,23.97,0,19,0z
            							M26,23.091C26,27.459,22.545,31,18.285,31H9.714C5.454,31,2,27.459,2,23.091V9.909C2,5.541,5.454,2,9.714,2h8.571
            							C22.545,2,26,5.541,26,9.909V23.091z"/>
                                <polygon class="nav_arrow" fill="#F3F6F9" points="13.044,11.551 11.71,12.885 15.714,16.888 11.71,20.891 13.044,22.224 18.379,16.888 17.048,15.554
            							17.046,15.554 "/>
            							</svg>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>



    <!-- rooms -->

    <div class="offers">
        <div class="test_border"></div>
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="section_title">Các phòng nỗi bật</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="intro_text text-center">
                        <p> Để mỗi chuyến đi là một hành trình truyền cảm hứng, mỗi căn phòng là một khoảng trời an
                            yên</p>
                    </div>
                </div>
            </div>

            <div class="row offers_items">
                <!-- Offers Item -->
                @foreach( $rooms as $key => $room )
                    <div class="col-lg-6 offers_col">
                        <div class="offers_item">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="offers_image_container">
                                        <!-- Image by https://unsplash.com/@kensuarez -->
                                        <div class="offers_image_background"
                                             style="background-image:url({{asset('img')}}/{{$room->image}}); width: 255px; height: 302px"></div>
                                        <div class="offer_name" style="bottom: -10px"><a
                                                href="{{route('showrooms',$room->id)}}">{!! Str::limit($room->Kindrooms->Name,12,'...')!!}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="offers_content">
                                        <div class="offers_price"
                                             style="font-size: 25px">{!! Str::limit($room->hotels->Name,15,'...')!!}</div>
                                        <div class="rating_r rating_r_4 offers_rating">
                                            <p><b>Giá phòng: {{number_format($room->rates)}} đ</b></p>
                                            <p class="offers_text">{!! Str::limit($room->hotels->Address,15,'...')!!}
                                                , {{$room->hotels->cities->Name}}</p>
                                        </div>


                                        <div class="offers_icons">

                                            <p class="offers_text">{!! Str::limit($room->description,20,'...')!!} </p>
                                        </div>
                                        <div class="rating_r rating_r_4 offers_rating" data-rating="4">
                                            @for ($i = 0; $i < $room->hotels->Count_star; $i++)
                                                <i></i>
                                            @endfor

                                        </div>
                                        <div class="offers_link" style="bottom: -10px"><a
                                                href="{{route('showrooms',$room->id)}}">Xem
                                                Thêm</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="container "
                     style="display: flex;justify-content: center; margin-top: 10px">{{ $rooms->links() }}</div>
            </div>

        </div>


    </div>


    <!-- Intro -->

    <div class="intro">
        <div class="test_border"></div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="intro_title text-center">BLOG DU LỊCH</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="intro_text text-center">
                        <p>Trải nghiệm những chuyến đi và nghĩ dưỡng đẳng cấp cùng booking hotel </p>
                    </div>
                </div>
            </div>
            <div class="row intro_items">

                <!-- Intro Item -->
                @foreach($blog as $key => $blogs)
                    <div class="col-lg-4 intro_col">

                        <div class="intro_item">

                            <div class="intro_item_overlay"></div>
                            <!-- Image by https://unsplash.com/@dnevozhai -->
                            <div class="intro_item_background"
                                 style="background-image:url({{asset('images/')}}/{{$blogs->images}})"></div>
                            <div
                                class="intro_item_content d-flex flex-column align-items-center justify-content-center">
                                <div
                                    class="intro_date">{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blogs->day)->format('d.m.Y ') !!}</div>
                                <div class="button intro_button">
                                    <div class="button_bcg"></div>
                                    <a href="{{route('showBlog',$blogs->id)}}">Xem
                                        thêm<span></span><span></span><span></span></a></div>
                                <div class="intro_center text-center">

                                    <div class="intro_price " style="font-size: 25px"><h1
                                            style="font-size: 20px">{!! Str::limit($blogs->title,50,'...')!!}</h1></div>

                                    <div class="intro_price"></div>

                                </div>
                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>






    <div class="trending">

        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="section_title">Khách sạn tốt nhất cho bạn</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="intro_text text-center">
                        <p>Top chỗ ở sạch đep, giá tốt tại TP.Hồ Chí Minh, Hà Nội,... cho chuyến du lịch và công tác của
                            bạn. </p>
                    </div>
                </div>
            </div>

            <div class="row trending_container">
                @foreach( $hotel as $key => $hotels )
                    <div class="col-lg-3 col-sm-6">
                        <div class="trending_item clearfix">
                            <div class="trending_image"><img style="width: 82px; height: 76px"
                                                             src="{{asset('img')}}/{{$hotels->image}}" alt=""></div>
                            <div class="trending_content">
                                <div class="trending_title"><a
                                        href="{{route('listrooms',$hotels->id)}}">{!! Str::limit($hotels->Name,15,'...')!!}</a>
                                </div>
                                <div class="trending_price"> {{$hotels->cities->Name}}
                                    , {!! Str::limit($hotels->Address,10,'...')!!} </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <!-- {locale: {
              format: 'DD/MM/YYYY'
            },} -->
    <script>
        $('#daterange').daterangepicker();

    </script>


@endsection
@section('footer')
    @include('shared.footer')

@endsection




