<!DOCTYPE html>
<html lang="en">
<head>
    <title>phòng khách sạn</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Travelix Project">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/bootstrap4/bootstrap.min.css')}}">
    <link href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/colorbox/colorbox.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/single_listing_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/single_listing_responsive.css')}}">
    <script src="https://kit.fontawesome.com/83883d8e8f.js" crossorigin="anonymous"></script>
</head>

<body>

<div class="super_container">

@include('shared.header')

<!-- Home -->
    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll">
            <img src="{{asset('images/single_background.jpg')}}">
        </div>
        <div class="home_content">
            <div class="home_title">Phòng của bạn</div>
        </div>
    </div>

    <!-- Offers -->

    <div class="listing" style="margin-top: -70px" >
        <div class="container">
            <div class="row">

                <div class="col-lg-12">


                    <div class="single_listing" style="padding-bottom: 10px;">
                        @if(Session::has('thongdao'))
                            <div id="div-alert" class="alert alert-success alert-dismissible show" role="alert">
                                <strong>{{ Session::get('thongdao') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(Session::has('book'))
                            <div id="div-alert"class="alert alert-danger alert-dismissible show" role="alert" >
                                <strong>{{ Session::get('book') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <!-- Hotel Info -->
                        <div class="hotel_info">


                            <!-- Listing Image -->

                            <div class="hotel_image">
                                <img src="{{asset('img/')}}/{{$rooms->image}}" style="width: 1110px; height: 723px"
                                     alt="">
                                <div
                                    class="hotel_review_container d-flex flex-column align-items-center justify-content-center">
                                    <div class="hotel_review">
                                        <div class="hotel_review_content">
                                            <div class="hotel_review_title">{!! Str::limit($rooms->hotels->Name,10,'...')!!}</div>
                                            <div
                                                class="hotel_review_subtitle">{!! Str::limit($rooms->hotels->Address,15,'...')!!}</div>
                                        </div>
                                        <div
                                            class="hotel_review_rating text-center">{{$rooms->hotels->Count_star}}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hotel Gallery -->
                            <div class="hotel_gallery">
                                <div class="hotel_slider_container">

                                    <div class="owl-carousel owl-theme hotel_slider">
                                        <!-- Hotel Gallery Slider Item -->
                                        @foreach( $img as $key => $img )
                                            <div class="owl-item">
                                                <a class="colorbox cboxElement" href="{{asset('img')}}/{{$img->image}}">
                                                    <img style="width: 102px; height: 101px"
                                                         src="{{asset('img')}}/{{$img->image}}">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Hotel Slider Nav - Prev -->
                                <div class="hotel_slider_nav hotel_slider_prev">
                                    <svg version="1.1" id="Layer_6" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         width="28px" height="33px" viewBox="0 0 28 33"
                                         enable-background="new 0 0 28 33" xml:space="preserve">
											<defs>
                                                <linearGradient id='hotel_grad_prev'>
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
                                <!-- Hotel Slider Nav - Next -->
                                <div class="hotel_slider_nav hotel_slider_next">
                                    <svg version="1.1" id="Layer_7" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         width="28px" height="33px" viewBox="0 0 28 33"
                                         enable-background="new 0 0 28 33" xml:space="preserve">
											<defs>
                                                <linearGradient id='hotel_grad_next'>
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
                        <!-- Title -->
                        <hr>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="hotel_title_button ml-lg-auto">
                                            <div class="hotel_map_link_container">
                                                <div class="hotel_map_link"
                                                     style="margin-top: 3%; font-size: 30px">{{$rooms->hotels->Name}}</div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="rating_r rating_r_4 hotel_rating font-weight-bold"> Đánh giá: &nbsp;
                                            @for ($i = 0; $i < $rooms->hotels->Count_star; $i++)
                                                <i></i>
                                            @endfor
                                        </div>
                                        <p class="font-weight-bold"><i class="fa fa-map-marker"
                                                                       aria-hidden="true"></i> {{$rooms->hotels->cities->Name}}
                                            , {{$rooms->hotels->Address}}</p>
                                        <p class="font-weight-bold">Hạng Phòng: {{$rooms->kindrooms->Name}} | Loại
                                            Phòng: {{$rooms->roomcategory->RoomCategory}}</p>
                                        <p class="font-weight-bold">Diện tích: {{$rooms->acreage}} m²</p>
                                        <p class="font-weight-bold">Giá phòng: {{number_format($rooms->rates)}} đ</p>
                                        <p class="font-weight-bold">Trẻ nhỏ kê thêm: {{$rooms->AmountPeople}} Người</p>
                                        <p class="font-weight-bold">Giá kê thêm: {{number_format($rooms->surcharge)}}
                                            đ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Hotel Info Tags -->
                                        <div class=" footer_column">
                                            <div class="footer_col">
                                                <div class="hotel_title_button ml-lg-auto">
                                                    <div class="hotel_map_link_container">
                                                        <div class="hotel_map_link"
                                                             style="margin-top: 3%; font-size: 25px">Tiện Nghi Chổ Ở
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <a>Giới thiệu về các tiện nghi và dịch vụ tại nơi lưu trú</a>
                                                </div>
                                                <div class="footer_content footer_tags ">
                                                    <ul class="tags_list clearfix">
                                                        @foreach( $sevice as $key => $sevice )
                                                            <li class="tag_item">
                                                                <a style="color: #0b0b0b">
                                                                    <i class="{{$sevice->sevices->Name_icon}}"
                                                                       aria-hidden="true"></i>
                                                                    {{$sevice->sevices->Name}}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Hotel Info Tags -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(Auth::user())
                            @if(Auth::user()->id != $rooms->hotels->users_id)
                                <div class="">
                                    <button class="button search_button" id="ck">Đặt Phòng</button>
                                </div>
                        @endif
                    @endif

                    <!-- bookrooms -->
                        <div class="card border-warning mb-3 ABC" style="display:none; margin-top: 3%">
                            <div class="card-header font-weight-bold text-warning" style="font-size: 25px">
                                PHÒNG TRỐNG
                            </div>
                            <div class="card-body text-warning  ">
                                @if($in_at != null)
                                    @if($users != null)
                                        {!! Form::open(['route'=>'booking','method'=>'post']) !!}
                                        <div class="col-6" style="float: left;">
                                            <div class="form-group {{ $errors->has('in_at') ?'has-error':'' }}">
                                                {{ Form::label('Ngày Đặt Phòng:','',['class' => 'font-weight-bold']) }}
                                                <input type="text" name="in_at" class="form-control" id="from"
                                                       placeholder="tháng/ngày/năm"
                                                       value="{{\Carbon\Carbon::parse($in_at)->format('m/d/Y')}}">


                                                <span class="text-danger">{{$errors->first('in_at')}}</span>
                                            </div>

                                            <div
                                                class="form-group {{ $errors->has('Deposit') ?'has-error':'' }}">@if($rooms->AmountPeople == 0)
                                                    <input type="hidden" name="AmountPeople" class="form-control"
                                                           value="{{$rooms->AmountPeople}}">
                                                @else
                                                    {{ Form::label('Số người kê thêm:','',['class' => 'font-weight-bold']) }}
                                                    @if($children)
                                                        <input type="number" name="AmountPeople" class="form-control"
                                                               max="{{$rooms->AmountPeople}}" value="{{$children}}">
                                                    @else
                                                        <input type="number" name="AmountPeople" class="form-control"
                                                               max="{{$rooms->AmountPeople}}" value="0">
                                                        <span class="text-danger">{{$errors->first('AmountPeople')}}</span>
                                                    @endif


                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-6" style="float: left;">
                                            <div class="form-group {{ $errors->has('out_at') ?'has-error':'' }}">
                                                {{ Form::label('Ngày Trả Phòng:','',['class' => 'font-weight-bold']) }}
                                                <input type="text" name="out_at" class="form-control" id="to"
                                                       placeholder="tháng/ngày/năm"
                                                       value="{{\Carbon\Carbon::parse($out_at)->format('m/d/Y')}}">

                                                <span class="text-danger">{{$errors->first('out_at')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('total') ?'has-error':'' }}">
                                                <input type="hidden" name="total" value="{{$rooms->rates}}">
                                                <span class="text-danger">{{$errors->first('total')}}</span>
                                            </div>
                                            <input type="hidden" name="id" id="id" value="{{$rooms->id}}">
                                            <input type="hidden" name="hotel" id="id" value="{{$rooms->hotels_id}}">
                                        </div>

                                        <div class="modal-footer" style="margin-top: 10px">
                                            {{form::submit('Gửi',['class'=>'btn btn-outline-warning']) }}
                                        </div>

                                        {!! Form::close() !!}
                                    <!-- facebook -->
                                    @else
                                        {!! Form::open(['route'=>'createbooking','method'=>'post']) !!}
                                        <div class="col-6" style="float: left;">
                                            <div class="form-group {{ $errors->has('in_at') ?'has-error':'' }}">
                                                {{ Form::label('Ngày Đặt Phòng:','',['class' => 'font-weight-bold']) }}
                                                <input type="text" name="in_at" class="form-control" id="from"
                                                       placeholder="tháng/ngày/năm"
                                                       value="{{\Carbon\Carbon::parse($in_at)->format('m/d/Y')}}">


                                                <span class="text-danger">{{$errors->first('in_at')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('first_name') ?'has-error':'' }}">
                                                {{ Form::label('Họ:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::text('first_name','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('first_name')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('lats_name') ?'has-error':'' }}">
                                                {{ Form::label('Tên:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::text('lats_name','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('lats_name')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('Birthday') ?'has-error':'' }}">
                                                {{ Form::label('Ngày sinh:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::date('Birthday','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('Birthday')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('Idcard') ?'has-error':'' }}">
                                                {{ Form::label('CMDN:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::number('Idcard','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('Idcard')}}</span>
                                            </div>


                                            <div
                                                class="form-group {{ $errors->has('Deposit') ?'has-error':'' }}">@if($rooms->AmountPeople == 0)
                                                    <input type="hidden" name="AmountPeople" class="form-control"
                                                           value="{{$rooms->AmountPeople}}">
                                                @else
                                                    {{ Form::label('Số người kê thêm:','',['class' => 'font-weight-bold']) }}
                                                    <input type="number" name="AmountPeople" class="form-control"
                                                           max="{{$rooms->AmountPeople}}" value="{{$children}}">

                                                    <span class="text-danger">{{$errors->first('AmountPeople')}}</span>
                                                @endif

                                            </div>

                                        </div>
                                        <div class="col-6" style="float: left;">
                                            <div class="form-group {{ $errors->has('out_at') ?'has-error':'' }}">
                                                {{ Form::label('Ngày Trả Phòng:','',['class' => 'font-weight-bold']) }}
                                                <input type="text" name="out_at" class="form-control" id="to"
                                                       placeholder="tháng/ngày/năm"
                                                       value="{{\Carbon\Carbon::parse($out_at)->format('m/d/Y')}}">

                                                <span class="text-danger">{{$errors->first('out_at')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('phone') ?'has-error':'' }}">
                                                {{ Form::label('Số điện thoại:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::number('phone','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('phone')}}</span>
                                            </div>
                                            <div class="form-group  {{ $errors->has('cyti_id') ?'has-error':'' }}">

                                                {{Form::label('Thành phố:','',['class' => 'font-weight-bold'])}}
                                                {{Form::select('cyti_id',$city,'',['class' => " form-control",])}}

                                                <span class="text-danger">{{$errors->first('cyti_id')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('Address') ?'has-error':'' }}">
                                                {{ Form::label('Tên đường:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::text('Address','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('Address')}}</span>
                                            </div>
                                            <div class="form-group ">
                                                {{ Form::label('Giới tính:','',['class' => 'font-weight-bold']) }}
                                                <div class=" " style="margin-top: 10px">

                                                    {{ Form::label('Nam:','',['class' => 'font-weight-bold']) }}
                                                    {{ Form::radio('sex', '0' , true) }}
                                                    {{ Form::label('Nữ:','',['class' => 'font-weight-bold']) }}
                                                    {{ Form::radio('sex', '1' , false) }}

                                                </div>

                                            </div>
                                            <div class="form-group {{ $errors->has('total') ?'has-error':'' }}">
                                                <input type="hidden" name="total" value="{{$rooms->rates}}">
                                                <span class="text-danger">{{$errors->first('total')}}</span>
                                            </div>
                                            <input type="hidden" name="id" id="id" value="{{$rooms->id}}">
                                            <input type="hidden" name="hotel" id="id" value="{{$rooms->hotels_id}}">
                                        </div>

                                        <div class="modal-footer" style="margin-top: 10px">
                                            {{form::submit('Gửi',['class'=>'btn btn-outline-warning']) }}
                                        </div>

                                        {!! Form::close() !!}
                                    @endif

                                @else
                                    @if($users != null)
                                        {!! Form::open(['route'=>'booking','method'=>'post']) !!}
                                        <div class="col-6" style="float: left;">
                                            <div class="form-group {{ $errors->has('in_at') ?'has-error':'' }}">
                                                {{ Form::label('Ngày Đặt Phòng:','',['class' => 'font-weight-bold']) }}
                                                <input type="text" name="in_at" class="form-control" id="from"
                                                       placeholder="tháng/ngày/năm" value="">


                                                <span class="text-danger">{{$errors->first('in_at')}}</span>
                                            </div>

                                            <div
                                                class="form-group {{ $errors->has('Deposit') ?'has-error':'' }}">
                                                @if($rooms->AmountPeople == 0)
                                                    <input type="hidden" name="AmountPeople" class="form-control"
                                                           value="{{$rooms->AmountPeople}}">
                                                @else
                                                {{ Form::label('Số người kê thêm:','',['class' => 'font-weight-bold']) }}
                                                <input type="number" name="AmountPeople" class="form-control"
                                                       max="{{$rooms->AmountPeople}}" value="0">
                                                       <span class="text-danger">{{$errors->first('AmountPeople')}}</span>
                                                @endif



                                            </div>
                                        </div>
                                        <div class="col-6" style="float: left;">
                                            <div class="form-group {{ $errors->has('out_at') ?'has-error':'' }}">
                                                {{ Form::label('Ngày Trả Phòng:','',['class' => 'font-weight-bold']) }}
                                                <input type="text" name="out_at" class="form-control" id="to"
                                                       placeholder="tháng/ngày/năm" value="">

                                                <span class="text-danger">{{$errors->first('out_at')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('total') ?'has-error':'' }}">
                                                <input type="hidden" name="total" value="{{$rooms->rates}}">
                                                <span class="text-danger">{{$errors->first('total')}}</span>
                                            </div>
                                            <input type="hidden" name="id" id="id" value="{{$rooms->id}}">
                                            <input type="hidden" name="hotel" id="id" value="{{$rooms->hotels_id}}">
                                        </div>

                                        <div class="modal-footer" style="margin-top: 10px">
                                            {{form::submit('Gửi',['class'=>'btn btn-outline-warning']) }}
                                        </div>

                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open(['route'=>'createbooking','method'=>'post']) !!}
                                        <div class="col-6" style="float: left;">
                                            <div class="form-group {{ $errors->has('in_at') ?'has-error':'' }}">
                                                {{ Form::label('Ngày Đặt Phòng:','',['class' => 'font-weight-bold']) }}
                                                <input type="text" name="in_at" class="form-control" id="from"
                                                       placeholder="tháng/ngày/năm" value="">


                                                <span class="text-danger">{{$errors->first('in_at')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('first_name') ?'has-error':'' }}">
                                                {{ Form::label('Họ:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::text('first_name','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('first_name')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('lats_name') ?'has-error':'' }}">
                                                {{ Form::label('Tên:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::text('lats_name','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('lats_name')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('Birthday') ?'has-error':'' }}">
                                                {{ Form::label('Ngày sinh:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::date('Birthday','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('Birthday')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('Idcard') ?'has-error':'' }}">
                                                {{ Form::label('CMDN:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::number('Idcard','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('Idcard')}}</span>
                                            </div>


                                            <div
                                                class="form-group {{ $errors->has('Deposit') ?'has-error':'' }}">@if($rooms->AmountPeople == 0)
                                                    <input type="hidden" name="AmountPeople" class="form-control"
                                                           value="{{$rooms->AmountPeople}}">
                                                @else
                                                    {{ Form::label('Số người kê thêm:','',['class' => 'font-weight-bold']) }}
                                                    <input type="number" name="AmountPeople" class="form-control"
                                                           max="{{$rooms->AmountPeople}}" value="0">

                                                    <span class="text-danger">{{$errors->first('AmountPeople')}}</span>
                                                @endif

                                            </div>

                                        </div>
                                        <div class="col-6" style="float: left;">
                                            <div class="form-group {{ $errors->has('out_at') ?'has-error':'' }}">
                                                {{ Form::label('Ngày Trả Phòng:','',['class' => 'font-weight-bold']) }}
                                                <input type="text" name="out_at" class="form-control" id="to"
                                                       placeholder="tháng/ngày/năm" value="">

                                                <span class="text-danger">{{$errors->first('out_at')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('phone') ?'has-error':'' }}">
                                                {{ Form::label('Số điện thoại:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::number('phone','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('phone')}}</span>
                                            </div>
                                            <div class="form-group  {{ $errors->has('cyti_id') ?'has-error':'' }}">

                                                {{Form::label('Thành phố:','',['class' => 'font-weight-bold'])}}
                                                {{Form::select('cyti_id',$city,'',['class' => " form-control",])}}

                                                <span class="text-danger">{{$errors->first('cyti_id')}}</span>
                                            </div>
                                            <div class="form-group {{ $errors->has('Address') ?'has-error':'' }}">
                                                {{ Form::label('Tên đường:','',['class' => 'font-weight-bold']) }}
                                                {{ Form::text('Address','',['class'=>'form-control']) }}
                                                <span class="text-danger">{{$errors->first('Address')}}</span>
                                            </div>
                                            <div class="form-group ">
                                                {{ Form::label('Giới tính:','',['class' => 'font-weight-bold']) }}
                                                <div class=" " style="margin-top: 10px">

                                                    {{ Form::label('Nam:','',['class' => 'font-weight-bold']) }}
                                                    {{ Form::radio('sex', '0' , true) }}
                                                    {{ Form::label('Nữ:','',['class' => 'font-weight-bold']) }}
                                                    {{ Form::radio('sex', '1' , false) }}

                                                </div>

                                            </div>
                                            <div class="form-group {{ $errors->has('total') ?'has-error':'' }}">
                                                <input type="hidden" name="total" value="{{$rooms->rates}}">
                                                <span class="text-danger">{{$errors->first('total')}}</span>
                                            </div>
                                            <input type="hidden" name="id" id="id" value="{{$rooms->id}}">
                                            <input type="hidden" name="hotel" id="id" value="{{$rooms->hotels_id}}">
                                        </div>

                                        <div class="modal-footer" style="margin-top: 10px">
                                            {{form::submit('Gửi',['class'=>'btn btn-outline-warning']) }}
                                        </div>

                                        {!! Form::close() !!}
                                    @endif

                                @endif

                            </div>
                        </div>
                        <!-- bookrooms -->
                        <!-- Reviews -->
                        <div class="reviews">
                            <div class="reviews_title">
                                @if(Auth::user())
                                    @if(Auth::user()->id != $rooms->hotels->users_id)
                                        {{ Form::open(['route' => 'comments.store', 'method' => 'post','enctype '=>'multipart/form-data']) }}

                                        <div class="form-group {{ $errors->has('comments') ?'has-error':'' }}">
                                            {{ Form::label('Bình Luận:','',['class' => 'font-weight-bold']) }}
                                            {{ Form::text('comments','',['class'=>'form-control']) }}
                                            <input type="hidden" name="room" value="{{$rooms->id}}">

                                            <span class="text-danger">{{$errors->first('comments')}}</span>
                                        </div>
                                        @if(Session::has('thongbao'))
                                            <div id="div-alert"  class="alert alert-success alert-dismissible show" role="alert">
                                                <strong>{{ Session::get('thongbao') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @elseif(Session::has('loi'))
                                            <div id="div-alert" class="alert alert-success alert-dismissible show" role="alert" >
                                                <strong>{{ Session::get('loi') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        <div class="modal-footer">
                                            {{form::submit('Gửi',['class'=>'btn btn-outline-danger']) }}
                                        </div>
                                        {{ Form::close() }}
                                    @endif
                                @endif
                            </div>
                            @foreach( $comments as $key => $comments )
                                <div class="reviews_container">
                                    <!-- Review -->
                                    <div class="review">
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <div class="review_image">
                                                    <img src="{{asset('images/icon_tien.jpg')}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-11">
                                                <div class="review_content">
                                                    <div class="alert alert-success" role="alert">
                                                        <div class="review_title_container">
                                                            <div class="review_title">{{$comments->users->name}}</div>
                                                        </div>
                                                        <div class="review_text">
                                                            <p>{{$comments->comments}}</p>
                                                        </div>
                                                        <div class="review_date">{{$comments->created_at}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Rooms -->

                        <div class="rooms col-12">

                            <!-- Room -->
                            @foreach( $view as $key => $views )
                                <a href="{{route('showrooms',$views->id)}}">
                                    <div class="row col-12" style="margin-top: 10px;margin-bottom: 30px">
                                        <div class="col-lg-2">
                                            <div class="room_image"><img style="width: 130px; height: 111.15px"
                                                                         src="{{asset('img')}}/{{$views->image}}"></div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="room_content">
                                                <div class="room_price">Giá
                                                    Phòng: {{number_format($views->rates)}} đồng
                                                </div>
                                                <div class="room_text">Địa Chỉ: {{$views->hotels->cities->Name}}
                                                    ,{{$views->hotels->Address}} </div>
                                                <div class="room_extra">Diện tích phòng: {{$views->acreage}} m²</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            <div class="container "
                                 style="display: flex;justify-content: center; margin-top: 10px">{{ $view->links() }}</div>
                        </div>


                    </div>

                    <!-- Location on Map -->

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->

<footer class="footer">
    <div class="container">
        <div class="row">

            <!-- Footer Column -->
            <div class="col-lg-3 footer_column">
                <div class="footer_col">
                    <div class="footer_content footer_about">
                        <div class="logo_container footer_logo">
                            <div class="logo"><a style="font-size: 25px" href="#"><img
                                        src="{{asset('images/logo.png')}}" alt="">Booking hotel</a></div>
                        </div>
                        <p class="footer_about_text">Booking Hotel hiện là nền tảng đặt phòng trực tuyến #1 Việt Nam. Đồng
                            hành cùng chúng tôi, bạn có những chuyến đi mang đầy trải nghiệm. Với Booking Hotel, việc đặt chỗ
                            ở, biệt thự nghỉ dưỡng, khách sạn, nhà riêng, chung cư... trở nên nhanh chóng, thuận tiện và
                            dễ dàng.</p>
                        <ul class="footer_social_list">
                            <li class="footer_social_item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li class="footer_social_item"><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                            <li class="footer_social_item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="footer_social_item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li class="footer_social_item"><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Footer Column -->
            <div class="col-lg-3 footer_column">
                <div class="footer_col">
                    <div class="footer_title">Bài viết</div>
                    <div class="footer_content footer_blog">

                        <!-- Footer blog item -->
                        <div class="footer_blog_item clearfix">
                            <div class="footer_blog_image"><img src="{{asset('images/footer_blog_1.jpg')}}"
                                                                alt="https://unsplash.com/@avidenov"></div>
                            <div class="footer_blog_content">
                                <div class="footer_blog_title"><a href="blog.html">Du lịch với chúng tôi trong năm nay</a>
                                </div>
                                <div class="footer_blog_date">26, 09, 2020</div>
                            </div>
                        </div>

                        <!-- Footer blog item -->
                        <div class="footer_blog_item clearfix">
                            <div class="footer_blog_image"><img src="{{asset('images/footer_blog_2.jpg')}}"
                                                                alt="https://unsplash.com/@deannaritchie"></div>
                            <div class="footer_blog_content">
                                <div class="footer_blog_title"><a href="blog.html">Điểm đến mới cho bạn</a>
                                </div>
                                <div class="footer_blog_date">26, 09, 2020</div>
                            </div>
                        </div>

                        <!-- Footer blog item -->
                        <div class="footer_blog_item clearfix">
                            <div class="footer_blog_image"><img src="{{asset('images/footer_blog_3.jpg')}}"
                                                                alt="https://unsplash.com/@bergeryap87"></div>
                            <div class="footer_blog_content">
                                <div class="footer_blog_title"><a href="blog.html">
                                        Du lịch với chúng tôi trong năm nay</a>
                                </div>
                                <div class="footer_blog_date">26, 09, 2020</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Footer Column -->
            <div class="col-lg-3 footer_column">
                <div class="footer_col">
                    <div class="footer_title">tags</div>
                    <div class="footer_content footer_tags">
                        <ul class="tags_list clearfix">
                            <li class="tag_item"><a href="#">thiết kế</a></li>
                            <li class="tag_item"><a href="#">mua sắm</a></li>
                            <li class="tag_item"><a href="#">nghe nhạc</a></li>
                            <li class="tag_item"><a href="#">video</a></li>
                            <li class="tag_item"><a href="#">tiêc tùng</a></li>
                            <li class="tag_item"><a href="#">chủng ảnh</a></li>
                            <li class="tag_item"><a href="#">địa điểm</a></li>
                            <li class="tag_item"><a href="#">du lịch</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Footer Column -->
            <div class="col-lg-3 footer_column">
                <div class="footer_col">
                    <div class="footer_title">Liên hệ với chúng tôi</div>
                    <div class="footer_content footer_contact">
                        <ul class="contact_info_list">
                            <li class="contact_info_item d-flex flex-row">
                                <div>
                                    <div class="contact_info_icon"><img src="{{asset('images/placeholder.svg')}}"
                                                                        alt=""></div>
                                </div>
                                <div class="contact_info_text">33 xô viết nghệ tĩnh, Hải châu, Đà Nãng</div>
                            </li>
                            <li class="contact_info_item d-flex flex-row">
                                <div>
                                    <div class="contact_info_icon"><img src="{{asset('images/phone-call.svg')}}" alt="">
                                    </div>
                                </div>
                                <div class="contact_info_text">0335820697</div>
                            </li>
                            <li class="contact_info_item d-flex flex-row">
                                <div>
                                    <div class="contact_info_icon"><img src="{{asset('images/message.svg')}}" alt="">
                                    </div>
                                </div>
                                <div class="contact_info_text"><a href="mailto:contactme@gmail.com?Subject=Hello"
                                                                  target="_top">bookinghotel@gmail.com</a></div>
                            </li>
                            <li class="contact_info_item d-flex flex-row">
                                <div>
                                    <div class="contact_info_icon"><img src="{{asset('images/planet-earth.svg')}}"
                                                                        alt=""></div>
                                </div>
                                <div class="contact_info_text"><a href="https://colorlib.com">www.bookinghotelqh.com</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>

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
<script src="{{asset('styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/easing/easing.js')}}"></script>
<script src="{{asset('plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('plugins/colorbox/jquery.colorbox-min.js')}}"></script>
<script src="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('js/single_listing_custom.js')}}"></script>


<!-- datapicker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<!--   <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>


    $(function () {

        var dateFormat = "mm/dd/yy",

            from = $("#from")
                .datepicker({
                    defaultDate: "+w",
                    changeMonth: true,
                    minDate: 0,
                    numberOfMonths: 2,
                    
                })
                .on("change", function () {

                    to.datepicker("option", "minDate", getDate(this));

                }),

            to = $("#to").datepicker({
                defaultDate: "+w",
                changeMonth: true,
                minDate: 0,
                numberOfMonths: 2,
               
               
            })
                .on("change", function () {
                    from.datepicker("option", "maxDate", getDate(this));
                });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    });
</script>

<script>
    $(function () {
        $("#ck").click(function () {
            $(".ABC").toggle(1000);
        });
    });
</script>
</body>

</html>
