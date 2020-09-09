@extends('layouts.home')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{asset('styles/offers_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/offers_responsive.css')}}">
    <!-- Home -->

    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll"
             data-image-src="{{asset('images/about_background.jpg')}}"></div>
        <div class="home_content">
            <div class="home_title">Phòng Tốt Cho Bạn</div>
        </div>
    </div>

    <div class="search">
        <!-- Search Contents -->
        <div class="container fill_height">
            <div class="row fill_height">
                <div class="col fill_height">
                    <!-- Search Tabs -->
                    <div class="search_tabs_container"
                         style="width: calc(100% - 70%); position: absolute;bottom: 100%;left: 400px; margin-top: 34px">
                        <div
                            class="search_tabs d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start" style="height: 60px">
                            <div
                                class="search_tab d-flex flex-row align-items-center justify-content-lg-center justify-content-start">
                                <img src="{{asset('images/suitcase.png')}}" alt=""><span><a style="color: black;"
                                                                                            href="">Khách sạn</a></span>
                            </div>
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


                            <button class="button search_button" style="margin-top: -2px">Tìm
                                Kiếm<span></span><span></span><span></span></button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <!-- Offers -->

    <div class="container">
        <div class="row">
            <div class="col-lg-1 temp_col"></div>
            <div class="col-lg-12">
                <!-- Offers Grid -->
                <div class="offers_grid">
                    <!-- Offers Item -->
                    @foreach( $rooms as $key => $room )
                        <div class="offers_item rating_4">
                            <div class="row">
                                <div class="col-lg-1 temp_col"></div>
                                <div class="col-lg-3 col-1680-4">
                                    <div class="offers_image_container">
                                        <!-- Image by https://unsplash.com/@kensuarez -->
                                        <div class="offers_image_background"
                                             style="background-image:url({{asset('img')}}/{{$room->image}})"></div>
                                        <div class="offer_name"><a
                                                href="{{route('showrooms',$room->id)}}">{{$room->Kindrooms->Name}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="offers_content">
                                        <div class="offers_price">{{$room->hotels->Name}}</div>
                                        <div class="offers_icons"><b>Giá phòng: {{number_format($room->rates)}}đ</b>
                                        </div>
                                        <div class="offers_icons"><b>{{$room->roomcategory->AmountPeople}} khách</b>
                                        </div>

                                        <div class="rating_r rating_r_4 offers_rating" data-rating="4">
                                            @for ($i = 0; $i < $room->hotels->Count_star; $i++)
                                                <i></i>
                                            @endfor
                                        </div>

                                        <div class="offers_icons"> {{$room->hotels->cities->Name}}
                                            .{{$room->hotels->Address}}</div>
                                        <p class="offers_text">    {!! Str::limit($room->description,20,'...')!!}</p>
                                        <div class="offers_icons">

                                        </div>


                                        <form action="{{route('showrooms',$room->id)}}">
                                            <input type="hidden" name="in_at" value="{{$in_at}}">
                                            <input type="hidden" name="out_at" value="{{$out_at}}">
                                            @if($children)
                                                <input type="hidden" name="children" value="{{$children}}">
                                            @endif

                                            <button class="btn button book_button font-weight-bold"
                                                    style="width: 200px; color: white">Xem chi
                                                tiết<span></span><span></span><span></span></button>

                                        </form>


                                        <div class="offer_reviews">
                                            <div class="offer_reviews_content">
                                                <div class="offer_reviews_title">{{$room->hotels->Name}}</div>
                                                <div
                                                    class="offer_reviews_subtitle">{{$room->roomcategory->AmountPeople}}
                                                    khách
                                                </div>
                                            </div>
                                            <div
                                                class="offer_reviews_rating text-center">{{$room->hotels->Count_star}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
                <!-- Offers Item -->


                </div>
            </div>
            <div class="container "
                 style="display: flex;justify-content: center; margin-top: 20px">{{ $rooms->links() }}</div>
        </div>
    </div>





    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <script>
        $('#daterange').daterangepicker();

    </script>
    <br>
@endsection
@section('footer')
    @include('shared.footer')
@endsection
