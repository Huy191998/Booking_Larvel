<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Travelix Project">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/bootstrap4/bootstrap.min.css')}}">
    <link href="{{asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/colorbox/colorbox.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/blog_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/blog_responsive.css')}}">
</head>

<body>

<div class="super_container">

    <!-- Header -->
@include('shared.header')

<!-- Home -->

    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="">
            <img src="{{asset('images/blog_background.jpg')}}">
        </div>
        <div class="home_content">
            <div class="home_title" style="text-align: center">Bài viết</div>
        </div>
    </div>

    <!-- Blog -->

    <div class="blog">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12" style="float: left">

                        <div class="blog_post_container">
                            <!-- Blog Post -->
                            @foreach($blog as $key => $blogs)
                                <div class="blog_post">
                                    <div class="blog_post_image" style="text-align: center">
                                        <img style="width: 853px; height: 488px"
                                             src="{{asset('images/')}}/{{$blogs->images}}">
                                        <div
                                            class="blog_post_date d-flex flex-column align-items-center justify-content-center"
                                            style="margin-left: 120px; height: 60px; width: 150px;">
                                            <div class="blog_post_day" style="font-size: 15px">{!! Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blogs->day)->format('d.m.Y ') !!}</div>

                                        </div>
                                    </div>


                                    <div class="blog_post_meta">

                                        <div class="footer_content footer_tags ">
                                            <p style="margin-bottom: -30px">Tag: </p>
                                            <ul class="tags_list clearfix" style="margin-left: 40px">

                                                @foreach($blogs->tag as $key => $tag)
                                                    <li class="tag_item">
                                                        <a style="color: #0b0b0b" href="{{route('TagBog',$tag->id)}}">
                                                            {{$tag->tag_name}}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="blog_post_title"><a
                                            href="{{route('showBlog',$blogs->id)}}">{{ $blogs->title }}</a></div>
                                    <div class="blog_post_text">
                                        <p>{!! Str::limit($blogs->ct,100,'...')!!}</p>
                                    </div>
                                    <div class="blog_post_link"><a href="{{route('showBlog',$blogs->id)}}">Đọc Tiếp...</a>
                                    </div>
                                    <br>
                                    <div class="test_border"
                                         style="position: absolute;left: 0;bottom: 0;width: 100%;height: 2px;background: linear-gradient(to right, #fa9e1b, #8d4fff);"></div>
                                </div>
                            @endforeach()

                        </div>
                        <div class="container "
                             style="display: flex;justify-content: center; margin-top: 20px">{{ $blog->links() }}</div>

                    </div>

                    <!-- Blog Sidebar -->


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
                            <p class="footer_about_text">Booking Hotel hiện là nền tảng đặt phòng trực tuyến #1 Việt
                                Nam. Đồng
                                hành cùng chúng tôi, bạn có những chuyến đi mang đầy trải nghiệm. Với Booking Hotel,
                                việc đặt chỗ
                                ở, biệt thự nghỉ dưỡng, khách sạn, nhà riêng, chung cư... trở nên nhanh chóng, thuận
                                tiện và
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
                                    <div class="footer_blog_title"><a href="blog.html">Du lịch với chúng tôi trong năm
                                            nay</a>
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
                                        <div class="contact_info_icon"><img src="{{asset('images/phone-call.svg')}}"
                                                                            alt="">
                                        </div>
                                    </div>
                                    <div class="contact_info_text">0335820697</div>
                                </li>
                                <li class="contact_info_item d-flex flex-row">
                                    <div>
                                        <div class="contact_info_icon"><img src="{{asset('images/message.svg')}}"
                                                                            alt="">
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
                                    <div class="contact_info_text"><a
                                            href="https://colorlib.com">www.bookinghotelqh.com</a></div>
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
<script src="{{asset('plugins/colorbox/jquery.colorbox-min.js')}}"></script>
<script src="{{asset('plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('js/blog_custom.js')}}"></script>

</body>

</html>
