<!DOCTYPE html>
<html lang="en">
<head>
    <title>Single Listing</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Travelix Project">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Ensures optimal rendering on mobile devices. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/> <!-- Optimal Internet Explorer compatibility -->

    <link rel="stylesheet" type="text/css" href="{{asset('styles/bootstrap4/bootstrap.min.css')}}">
    <link href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('')}}plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/single_listing_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/single_listing_responsive.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


</head>

<body>

<div class="super_container">
    <!-- Header -->

    @include('shared.header')
    <div class="listing" style="margin-top: 13%">

        <div class="card container">
            <div class="card-header" style="text-align: center">

                <h3 class="font-weight-bold ">Thanh Toán Đặt Phòng</h3>
            </div>
            <div class="card-body">
                <form class="row my-5 wuc-ph" action="{{url('Hotels/payment')}}" method="get">
                    <div class="col-6">

                        <table class="table table-bordered">
                            <thead>
                            <tr class="table table-bordered table-danger">
                                <th>Thông tin đơn đặt phòng</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="font-weight-bold">Tên khách sạn</td>
                                <td>{{ Form::text('kindrooms',$rooms->hotels->Name,['class'=>'form-control','readonly']) }} </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Ngày đặt phòng</td>
                                <td>{{ Form::text('in_at',$requests->in_at,['class'=>'form-control','id'=>'from','readonly']) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Ngày trả phòng</td>
                                <td> {{ Form::text('out_at',$requests->out_at,['class'=>'form-control','id'=>'to','readonly']) }}</td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Loại phòng</td>
                                <td>{{ Form::text('roomcategory',$rooms->roomcategory->RoomCategory,['class'=>'form-control','readonly']) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Hạng phòng</td>
                                <td>{{ Form::text('kindrooms',$rooms->kindrooms->Name,['class'=>'form-control','readonly']) }} </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Giá phòng</td>
                                <td>{{ Form::text('kindrooms',$rooms->rates,['class'=>'form-control','readonly']) }} </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">số người kê thêm</td>
                                <td>{{ Form::text('Deposit',$requests->AmountPeople,['class'=>'form-control','readonly']) }} </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Giá kê thêm</td>
                                <td>{{ Form::text('kindrooms',($rooms->surcharge*$requests->AmountPeople),['class'=>'form-control','readonly']) }} </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tổng tiền</td>
                                <td>{{ Form::text('total',($requests->total*$days)+(($rooms->surcharge*$rooms->AmountPeople)*$days),['class'=>'form-control','readonly']) }}
                                    @foreach( $peoples as $key => $peoples )
                                    {{ Form::hidden('peoples_id',$peoples->id,['class'=>'form-control']) }}</td>
                                     @endforeach
                            </tr>
                            <tr>
                                {{ Form::hidden('hotels_id',$rooms->hotels_id,['class'=>'form-control']) }}
                            </tr>
                            <tr>
                                {{ Form::hidden('rooms_id',$rooms->id,['class'=>'form-control']) }}

                            </tr>


                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <div class="alert alert-warning" role="alert" style="margin-top: 1px" >
                            <div class="update-box" style="margin-top: 10px">
                                <h3 class="wuc-Customers font-weight-bold text-center text-info">PAYMENT METHOD</h3>
                                <div style="margin-top: 30px">
                                    <input type="radio" name="payment_method" id="cod" value="1" checked/>
                                    <label for="cod">Thanh toán tại khách sạn</label> <br>
                                    @if(($requests->total*$days)+(($rooms->surcharge*$rooms->AmountPeople)*$days)<=  20000000)
                                    <input type="radio" name="payment_method" id="momo" value="2"/>
                                    <label for="momo">Momo Internet Banking</label><br>
                                    @endif

                                    <input type="radio" name="payment_method" id="vnpay" value="3"/>
                                    <label for="momo">VnPay Internet Banking </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success" style="float: right;">Thanh toán đặt phòng</button>
                                <a href="{{url('client/rooms/showrooms/'.$requests->id)}}"  class="btn btn-outline-primary">Trở về</a>
                            </div>
                        </div>
                    </div>



                </form>
            </div>
        </div>

    </div>


    <br>
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
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
{{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#to").datepicker({dateFormat: 'yy-mm-dd'});
        $("#from").datepicker({dateFormat: 'yy-mm-dd'}).bind("change", function () {
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate() + 1);
            $("#to").datepicker("option", "minDate", minValue);
        })
    });
</script>


</body>

</html>
