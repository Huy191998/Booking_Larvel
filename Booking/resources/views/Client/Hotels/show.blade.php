@extends('layouts.home')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{asset('styles/offers_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/offers_responsive.css')}}">
    <!-- Home -->

    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll"
             data-image-src="{{asset('images/about_background.jpg')}}"></div>
        <div class="home_content">
            <div class="home_title">NƠI HẠNH PHÚC DÙNG CHÂN</div>
        </div>
    </div>

    <!-- Offers -->

    <div class="offers">
        <!-- Search -->
        <div class="search" style="margin-top: 0px">
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
                                    class="search_tab active d-flex flex-row align-items-center justify-content-lg-center justify-content-start">
                                    <img src="{{asset('images/suitcase.png')}}" alt=""><span><a style="color: white"
                                                                                                href="{{route('listhotels')}}">Khách sạn</a></span>
                                </div>
                            </div>
                        </div>

                        <!-- Search Panel -->

                        <div class="search_panel active">
                            <form action="{{route('listhotels')}}" id="search_form_1" method="get"
                                  class="search_panel_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-between justify-content-start">

                                <div class="search_item">
                                    <div>Tên khách sạn</div>
                                    <input type="seachname" class="destination search_input" required="required">
                                </div>
                                <div class="search_item">
                                    <div>Hạn khách sạn</div>
                                    <input type="number" name="seachCount_star" class="destination search_input"
                                           required="required" max="5">
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
                                <button class="button search_button" style="margin-top: -2px">
                                    Tìm kiếm<span></span><span></span><span></span>
                                </button>
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
                        @foreach( $hotel as $key => $hotels )
                            <div class="offers_item rating_4">
                                <div class="row">
                                    <div class="col-lg-1 temp_col"></div>
                                    <div class="col-lg-3 col-1680-4">
                                        <div class="offers_image_container">
                                            <!-- Image by https://unsplash.com/@kensuarez -->
                                            <div class="offers_image_background"
                                                 style="background-image:url({{asset('img')}}/{{$hotels->image}})"></div>
                                            <div class="offer_name"><a
                                                    href="{{route('listrooms',$hotels->id)}}">{{$hotels->cities->Name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="offers_content">
                                            <div class="offers_price">{{$hotels->Name}}</div>
                                            <div class="rating_r rating_r_4 offers_rating" data-rating="4">
                                                @for ($i = 0; $i < $hotels->Count_star; $i++)
                                                    <i></i>
                                                @endfor

                                            </div>
                                            <p class="offers_text">{!! Str::limit($hotels->description,20,'...')!!}</p>
                                            <div class="offers_icons">

                                            </div>
                                            <div class="button book_button"><a href="{{route('listrooms',$hotels->id)}}">Xem
                                                    Chi tiết<span></span><span></span><span></span></a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    <!-- Offers Item -->


                    </div>
                </div>

            </div>
        </div>
        <div class="container " style="display: flex;justify-content: center; margin-top: 20px">{{ $hotel->links() }}</div>
    </div>

@endsection
@section('footer')
    @include('shared.footer')
@endsection
