<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown m-t-20">
                        <div class="user-pic"><img src="{!! asset('images/users/1.jpg') !!}" alt="users"
                                                   class="rounded-circle" width="40"/></div>
                        <div class="user-content hide-menu m-l-10">
                            <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <h5 class="m-b-0 user-name font-medium">Booking Hotel <i class="fa fa-angle-down"></i>
                                </h5>
                                <span class="op-5 user-email">bookinghotel@gmail.com</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="{{route('logout')}}"><i
                                        class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>

                <!-- User Profile-->

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('regions.index')}}"
                       aria-expanded="false">
                        <i class="fas fa-globe-americas"></i> &nbsp;
                        <span class="hide-menu font-medium">Vùng miền</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('cities.index')}}"
                       aria-expanded="false">
                        <i class="fas fa-city"></i>&nbsp;
                        <span class="hide-menu font-medium">Thành Phố</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('kindrooms.index')}}"
                       aria-expanded="false">
                        <i class="fas fa-person-booth"></i>&nbsp;
                        <span class="hide-menu font-medium">Hạng Phòng</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('roomcategorys.index')}}"
                       aria-expanded="false">
                        <i class="fas fa-house-damage"></i>&nbsp;
                        <span class="hide-menu font-medium">Loại Phòng</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('sevices.index')}}"
                       aria-expanded="false">
                        <i class="fas fa-robot"></i>&nbsp;
                        <span class="hide-menu font-medium">Tiện Ích</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('tags.index')}}"
                       aria-expanded="false">
                        <i class="fas fa-tags"></i>&nbsp;
                        <span class="hide-menu font-medium">Tag</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('blog.index')}}"
                       aria-expanded="false">
                        <i class="fas fa-umbrella-beach"></i>&nbsp;
                        <span class="hide-menu font-medium">Blog</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('slide.index')}}"
                       aria-expanded="false">
                        <i class="fa fa-picture-o"></i>
                        <span class="hide-menu font-medium">Slider</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('users')}}"
                       aria-expanded="false">
                        <i class="fas fa-users"></i>&nbsp;
                        <span class="hide-menu font-medium">Người dùng</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('hotels')}}"
                       aria-expanded="false">
                        <i class="fas fa-hotel"></i>&nbsp;
                        <span class="hide-menu font-medium">Khách sạn</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('bookings')}}"
                       aria-expanded="false">
                        <i class="fab fa-cc-amazon-pay"></i>&nbsp;
                        <span class="hide-menu font-medium">Thông Tin Đặt Phòng</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('icons.index')}}"
                       aria-expanded="false">
                        <i class="fas fa-icons"></i>
                        <span class="hide-menu font-medium">Icons</span>
                    </a>
                </li>

            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
