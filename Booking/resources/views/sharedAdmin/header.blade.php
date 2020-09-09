<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="{{route('Admin.index')}}">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img style="width: 50px; height: 40px" src="{!! asset('images/logob.png') !!}" alt="homepage"
                         class="dark-logo"/>
                    <!-- Light Logo icon -->
                    <img style="width: 45px; height: 35px" src="{!! asset('images/logob.png') !!}" alt="homepage"
                         class="light-logo"/>
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                             <!-- dark Logo text -->
                             <img style="width: 200px; height: 64px" src="{!! asset('images/bookingg.png') !!}"
                                  alt="homepage" class="dark-logo"/>
                    <!-- Light Logo text -->
                             <img style="width: 180px; height: 30px" src="{!! asset('images/bookingg.png') !!}"
                                  class="light-logo" alt="homepage"/>
                        </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item search-box"><a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i
                            class="ti-search"></i></a>
                    <form class="app-search position-absolute">
                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i
                                class="ti-close"></i></a>
                    </form>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                            src="{!! asset('images/users/1.jpg') !!}" alt="user" class="rounded-circle" width="31"></a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng
                            Xuất</a>

                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
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
            <div style="text-align: center; margin-top: 28px">
                <strong>{{ Session::get('err') }}</strong>
            </div>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="top: 30px">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif
</header>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>
    $(document).ready(function () {
        $("#div-alert").delay(3000).slideUp();
    });

</script>
