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
                                                    href="{{route('showrooms',$room->id)}}">{{$room->hotels->Name}}</a></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="offers_content">
                                            <div class="offers_price">{{$room->hotels->Name}}</div>
                                            <hr>
                                            <div class="rating_r rating_r_4 offers_rating" data-rating="4">
                                                <h4>Hạng phòng: {{$room->kindrooms->Name}} | Loại phòng: {{$room->roomcategory->RoomCategory}}</h4>

                                            </div>
                                            <p class="offers_text">Diện tích: {{$room->acreage}} m²</p>
                                            <p class="offers_text">Giá phòng: {{number_format($room->rates)}} đ</p>
                                            <p class="offers_text">Mô tả: {!! Str::limit($room->description,20,'...')!!}</p>
                                            <div class="offers_icons">

                                            </div>
                                            <div class="button book_button"><a href="{{route('showrooms',$room->id)}}">Xem
                                                    Chi tiết<span></span><span></span><span></span></a></div>

                                            <div class="offer_reviews">
                                                <div class="offer_reviews_content">
                                                    <div class="offer_reviews_title">{{$room->kindrooms->Name}}</div>
                                                    <div class="offer_reviews_subtitle">{{$room->roomcategory->RoomCategory}}</div>
                                                </div>
                                                <div class="offer_reviews_rating text-center">{{$room->acreage}}</div>
                                            </div>
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
        <div class="container " style="display: flex;justify-content: center; margin-top: 20px">{{ $rooms->links() }}</div>
    </div>

@endsection
@section('footer')
    @include('shared.footer')
@endsection
