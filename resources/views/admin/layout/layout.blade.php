@php
$logo = App\Models\Setting::where('key', 'logo')->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Video Portal | Dashboard </title>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="CodedThemes">
      <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="CodedThemes">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
      <!-- Favicon icon -->
      <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->
      <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/bootstrap.min.css') }}">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/icon/themify-icons/themify-icons.css') }}">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/icon/icofont/css/icofont.css') }}">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/jquery.mCustomScrollbar.css')}}">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  </head>

  <body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">

                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </a>
                        <a href="{{ url('/admin/dashboard') }}">
                            <img class="img-fluid" src="{{ asset(isset($logo) && isset($logo->value) ? ('storage/logo/' . $logo->value) : 'front_assets/logo.png') }}" alt="Gamebox Admin" style="height:75px;" />
                        </a>
                        <a class="mobile-options">
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <a href="{{ url('/admin/dashboard') }}">
                                    <img src="{{ asset('admin_assets/img/user.png') }}" class="img-radius" alt="Image">
                                    <span>Admin</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    {{-- <li>
                                        <a href="#">
                                            <i class="fa fa-user"></i> Profile
                                        </a>
                                    </li> --}}
                                    <li>
                                        <a href="{{ route('admin-logout') }}">
                                            <i class="fa fa-lock"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="{{ request()->is('*dashboard*') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/dashboard') }}">
                                        <span class="pcoded-micon"><i class="fa fa-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('*category*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.category.index') }}">
                                        <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Category</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="{{ request()->is('*video*') ? 'active' : '' }}">
                                    <a href="{{ route('video.index') }}">
                                        <span class="pcoded-micon"><i class="fa fa-video" aria-hidden="true"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Videos</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="{{ request()->is('*game*') ? 'active' : '' }}">
                                    <a href="{{ route('game.index') }}">
                                        <span class="pcoded-micon"><i class="fa fa-gamepad"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Games</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="{{ request()->is('*customize/home-page*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.customize.homepage') }}">
                                        <span class="pcoded-micon"><i class="fa fa-gamepad"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Customize Home Page</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="{{ request()->is('*settings*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.settings.index') }}">
                                        <span class="pcoded-micon"><i class="ti-settings"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Settings</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </nav>
                    @yield('container')
                </div>

            </div>
        </div>

        <!-- Warning Section Starts -->
        <!-- Older IE warning message -->
   
<!-- Required Jquery -->
<script type="text/javascript" src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_assets/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('admin_assets/js/jquery.slimscroll.js') }}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('admin_assets/js/modernizr.js') }}"></script>
<!-- am chart -->
<script src="{{ asset('admin_assets/js/amcharts.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/serial.min.js') }}"></script>
<!-- Todo js -->
<script type="text/javascript " src="{{ asset('admin_assets/js/todo.js') }} "></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('admin_assets/js/custom-dashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_assets/js/script.js') }}"></script>
<script type="text/javascript " src="{{ asset('admin_assets/js/SmoothScroll.js') }}"></script>
<script src="{{ asset('admin_assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/demo-12.js') }}"></script>
<script src="{{ asset('admin_assets/js/notification.js') }}"></script>
<script src="{{ asset('admin_assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
var $window = $(window);
var nav = $('.fixed-button');
    $window.scroll(function(){
        if ($window.scrollTop() >= 200) {
         nav.addClass('active');
     }
     else {
         nav.removeClass('active');
     }
 });
</script>
<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
        }
    @endif

    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");

        @php
            Session::forget('success')
        @endphp
    @endif
</script>
</body>

</html>
