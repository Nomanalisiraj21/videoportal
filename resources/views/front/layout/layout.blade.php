@php
$lang = session()->get('lang') ?? 'en';
$logo = App\Models\Setting::where('key', 'logo')->first();
$theme_key = App\Models\Setting::where('key', 'theme')->first();
$theme = session()->get('theme') ?? ($theme_key ? $theme_key->value : '');
$backgroundImage = App\Models\Setting::where('key', 'background_image')->first();
if ($backgroundImage !== null) {
    $backgroundImage = asset('storage/background/'.$backgroundImage->value);
} else {
    $backgroundImage = '/front_assets/background/bg.png';
}
@endphp

<html lang="{{ $lang ?? 'en' }}" dir="{{ $lang && $lang == 'ar' ? 'rtl' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gamebox | Play Games Online</title>
    <meta name="description" content="Play Games Online">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="/front_assets/dark-grid/style/bootstrap.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="/front_assets/dark-grid/style/jquery-comments.css"> --}}
    <link rel="stylesheet" type="text/css" href="/front_assets/dark-grid/style/user.css">

    @if($theme && $theme == 'light')
        <!-- light theme -->
        <link rel="stylesheet" type="text/css" href="/front_assets/dark-grid/style/style.css"> 

    @else
        <!-- dark theme -->
        <link rel="stylesheet" type="text/css" href="/front_assets/dark-grid/style/dark-style.css">

    @endif
    {{-- <link rel="stylesheet" type="text/css" href="/front_assets/dark-grid/style/custom.css"> --}}
    <link rel="stylesheet" type="text/css" href="/front_assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="/front_assets/css/owl.theme.default.min.css">
    <!-- Font Awesome icons (free version)-->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="/front_assets/css/custom.css">
    <style>
        html[dir="rtl"], body[dir="rtl"] {
            font-family: calibri !important;
        }
        body {
            background-image: url('{{ $backgroundImage }}');
            background-repeat: no-repeat;
            background-size: cover;
            top: 0 !important;
        }

        .skiptranslate {
            display: none !important;
        }

        .home-page-slider {
            height: 35vw !important;
        }

        @media (min-width: 1000px) {
            .home-page-slider {
                height: 30vw !important;
            }
        }

        @media (min-width: 1500px) {
            .home-page-slider {
                height: 504px !important;
            }
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
</head>

<body id="page-top" dir="{{ $lang && $lang == 'ar' ? 'rtl' : '' }}">
    <div id="google_translate_element" class="d-none"></div>
    <!-- Navigation-->
    <div class="container site-container">
        <div class="site-content">
            <nav class="navbar navbar-expand-lg navbar-dark top-nav" id="mainNav">
                <div class="container">
                    <button class="navbar-toggler navbar-toggler-left collapsed" type="button" data-toggle="collapse"
                        data-target="#navb" aria-expanded="false"> <span class="navbar-toggler-icon"></span> </button>
                    <a class="navbar-brand js-scroll-trigger" href="/"><img
                            src="{{ isset($logo) ? asset('storage/logo/' . $logo->value) : '/front_assets/logo.png' }}"
                            class="site-logo" alt="Gamebox" style="height: 100px !important;"></a>
                    <div class="navbar-collapse collapse justify-content-end" id="navb">
                        <ul class="navbar-nav ml-auto text-uppercase">

                            {{-- <li class="nav-item"> <a class="nav-link" href="void:javascript(0)" id="changeLanguageBtn"
                                    data-current-language="en" translate="no">العربية</a> </li> --}}
                            @if ($lang && $lang == 'ar')
                                <li class="nav-item"> <a class="nav-link" href="{{ route('home.language', 'en') }}"
                                        id="changeLanguageBtn">English</a> </li>
                            @else
                                <li class="nav-item"> <a class="nav-link" href="{{ route('home.language', 'ar') }}"
                                        id="changeLanguageBtn">العربية</a> </li>
                            @endif

                            @auth
                                <li class="nav-item"> <a class="nav-link" href="{{ route('user-logout') }}"
                                        class="nav-link">{{ $lang && $lang == 'ar' ? 'تسجيل الخروج' : 'Logout' }}</a> </li>
                            @else
                                <li class="nav-item"> <a class="nav-link" data-toggle="modal" href="javascript:void(0)"
                                        onclick="openLoginModal();">{{ $lang && $lang == 'ar' ? 'تسجيل الدخول' : 'Login \ Register' }}</a> </li>
                            @endauth

                            <!-- Theme Change Button -->
                            @if ($theme && $theme == 'light')
                                <li class="nav-item"> <a class="nav-link" href="{{ route('home.theme', 'dark') }}"
                                        id="changeThemeBtn">{{ $lang && $lang == 'ar' ? 'الوضع المظلم' : 'Dark' }}</a> </li>
                            @else
                                <li class="nav-item"> <a class="nav-link" href="{{ route('home.theme', 'light') }}"
                                        id="changeThemeBtn">{{ $lang && $lang == 'ar' ? 'الوضع المضئ' : 'Light' }}</a> </li>
                            @endif

                                <li class="nav-item">
                                    <a class="mx-1 text-success" href="whatsapp://send?text=Gamebox Play Gmaes Online {{ url()->current() }}" id="whatsapp"><i class="fa fa-2x fa-whatsapp"></i></a>
                                    <a class="mx-1 {{ $theme && $theme == 'light' ? 'text-dark' : 'text-white' }}" href="{{ url()->current() }}" id="share"><i class="fa fa-2x fa-share-alt"></i></a>
                                </li>
                        </ul>

                        {{-- Search Form  =========== --}}

                        {{-- <form class="form-inline my-2 my-lg-0 search-bar" action="/">
							<div class="input-group">
								<input type="hidden" name="viewpage" value="search">
								<input type="text" class="form-control rounded-left search" placeholder="Search game" name="slug" minlength="2" required="">
								<div class="input-group-append">
									<button type="submit" class="btn btn-search"> <i class="fa fa-search"></i> </button>
								</div>
							</div>
						</form> --}}
                    </div>
                </div>
            </nav>
            @if (isset($sliders))

                <div id="carouselExampleControls" class="home-page-slider carousel slide m-4" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($sliders as $slider)
                            <div class="carousel-item @if ($loop->first) active @endif">
                            @auth
                                <a href="{{ $slider->link }}">
                                    <img class="d-block w-100"
                                        src="{{ '/storage/sliders/' . ($slider->banner ?? '') }}" alt="">
                                </a>
                            @else
                               <a href="#" onclick="openLoginModal();">
                                    <img class="d-block w-100"
                                        src="{{ '/storage/sliders/' . ($slider->banner ?? '') }}" alt="">
                                </a>
                            @endauth
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            @endif

            @php
                $nav_categories =
                    \App\Models\Admin\Category::active()
                        ->orderBy('index', 'asc')
                        ->orderBy('title', 'asc')
                        ->whereHas('games')
                        ->get() ?? [];
            @endphp

            <div class="nav-categories">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <nav class="">
                                <ul class="nav">
                                    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a href="/"
                                            class="nav-link {{ request()->is('/') ? 'active' : '' }}"> {{ $lang && $lang == 'ar' ? 'كل الألعاب' : 'All Games' }}</a>

                                    </li>

                                    @foreach ($nav_categories as $category)
                                        <li class="nav-item {{ request()->is('*/' . $category->id) ? 'active' : '' }}">
                                            <a class="nav-link {{ request()->is('*/' . $category->id) ? 'active' : '' }}"
                                                href="{{ route('home.category', ($category->id ?? 0)) }}">{{ $category->title }}</a>

                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                {{-- Games Content ========================================= --}}

                @yield('content')

                {{-- // Games Content ========================================= --}}

            </div>

            <!-- footer -->
            @php
                $pages = \App\Models\Page::active()->orderBy('pos')->get();
            @endphp
            <footer>
                <div class="copyright py-4">
                    <div class="container">
                        <ul class="list-inline">
                            <li class="list-inline-item">Gamebox © 2022. All rights reserved.</li>
                            <li class="list-inline-item">
                            <ul>
                            @foreach ($pages as $page)
                                <li class="list-inline-item"><a href="{{ route('home.page', $page->id) }}">{{ $page->title }}</a></li>
                            @endforeach
                            </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>

            
        </div>
    </div>
    <div class="modal fade login" id="loginModal">
        <div class="modal-dialog login animated">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $lang && $lang == 'ar' ? 'تسجيل الدخول' : 'Login' }}</h4>
                    <button type="button" class="close mx-1" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div class="error"></div>
                            <div class="form loginBox">
                                <form id="user_login" action="" accept-charset="UTF-8">
                                    <input id="u_number" class="form-control" type="number" placeholder="Phone"
                                        name="phone">
                                    <input id="u_pin" class="form-control" type="password"
                                        placeholder="Pin" name="pin">
                                    <input class="btn btn-default btn-login" type="submit" value="{{ $lang && $lang == 'ar' ? 'تسجيل الدخول' : 'Login' }}">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="content registerBox" style="display:none;">
                            <div class="form">
                                <form id="user_register" method="" html="{:multipart=>true}" data-remote="true"
                                    action="" accept-charset="UTF-8">
                                    <input id="usernumber" class="form-control" type="number" placeholder="Phone"
                                        name="phone">
                                    <input id="userpin" class="form-control" type="password"
                                        placeholder="Pin" name="pin">
                                    <input id="userpin_confirmation" class="form-control" type="password"
                                        placeholder="Confirm Pin" name="pin_confirmation">
                                    <input class="btn btn-default btn-register" type="submit" value="Create account"
                                        name="commit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="forgot login-footer">
                        <span>Looking to
                            <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                    </div>
                    <div class="forgot register-footer" style="display:none">
                        <span>Already have an account?</span>
                        <a href="javascript: showLoginForm();">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- share Modal -->
    <div class="modal fade share" id="shareModal">
        <div class="modal-dialog share animated">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Share</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div class="input-group mb-4">
                                <label class="input-label mr-1">Copy Link: </label>
                                <input id="shareLink" class="custom-control" type="text" onclick="this.select();" value="{{ url()->current() }}" readonly>
                            </div>
                            <div class="mb-3 ml-2">
                                <a href="whatsapp://send?text=Gamebox Play Gmaes Online {{ url()->current() }}" class="btn btn-success"><span class="fa fa-whatsapp mr-2"></span>Whatsapp</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End share modal -->

    <script type="text/javascript" src="/front_assets/dark-grid/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="/front_assets/dark-grid/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/front_assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="/front_assets/dark-grid/js/script.js"></script>
    @if($theme && $theme == 'light')
        <script type="text/javascript" src="/front_assets/js/greedy-menu.js"></script>
    @else
        <script type="text/javascript" src="/front_assets/js/dark-greedy-menu.js"></script>
    @endif
    <script type="text/javascript" src="/front_assets/js/custom.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- <script type="text/javascript" src="/front_assets/dark-grid/js/custom.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#user_register').submit(function(e) {
                e.preventDefault();
                var phone = $('#usernumber').val();
                var pin = $('#userpin').val();
                var pin_confirmation = $('#userpin_confirmation').val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: "post",
                    url: "{{ route('user-register') }}",
                    data: {
                        'phone': phone,
                        'pin': pin,
                        'pin_confirmation': pin_confirmation
                    },
                    success: function(response) {
                        $('#loginModal').closest('.modal').modal('toggle');
                        toastr.success(response);
                        console.log(response);
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 2000);
                    },
                    error:function(response){
                        var error=response.responseJSON;
                        $.each(error.errors,(x,y) => toastr.error(y,{timeOut: 5000}));
                    }

                });
            });
            $('#user_login').submit(function(e) {
                e.preventDefault();
                var phone = $('#u_number').val();
                var pin = $('#u_pin').val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type: "post",
                    url: "{{ route('user-login') }}",
                    data: {
                        'phone': phone,
                        'pin': pin,
                    },
                    success: function(response) {

                        toastr.success(response);
                        $('#loginModal').closest('.modal').modal('toggle');

                        setTimeout(function() {
                            window.location.reload(true);
                        }, 2000);
                        console.log(response);
                        if (response.errors) {
                            console.log("Error");

                        }
                    },
                    error:function(response){
                        var error=response.responseJSON;
                        console.log(error);
                        $.each(error.errors,(x,y) => toastr.error(y,{timeOut: 5000}));
                    }
                });
            });
        });
    </script>

    @yield('scripts')

    {{-- google_language --}}
    @if (isset($google_lang))
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    includedLanguages: "ar,en"
                }, 'google_translate_element');
            }
        </script>

        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
        </script>

        <script>
            let changeLanguageBtn = document.querySelector('#changeLanguageBtn');
            let languageSelect;

            setTimeout(function() {
                languageSelect = document.querySelector('#google_translate_element .goog-te-combo');
                if (languageSelect.value === 'en') {
                    changeLanguageBtn.dataset.currentLanguage = 'en';
                    changeLanguageBtn.textContent = 'العربية';
                    document.querySelector('html').dir = 'ltr';
                    document.querySelector('body').dir = 'ltr';
                    let arrowIcons = document.querySelectorAll('.fa-arrow-right');
                    arrowIcons.forEach((el) => {
                        el.classList.remove('fa-flip-horizontal');
                    })
                } else if (languageSelect.value === 'ar') {
                    changeLanguageBtn.dataset.currentLanguage = 'ar';
                    changeLanguageBtn.textContent = 'English';
                    document.querySelector('html').dir = 'rtl';
                    document.querySelector('body').dir = 'rtl';
                    let arrowIcons = document.querySelectorAll('.fa-arrow-right');
                    arrowIcons.forEach((el) => {
                        el.classList.add('fa-flip-horizontal');
                    })
                }
            }, 2000);


            changeLanguageBtn.addEventListener('click', (e) => {
                const self = e.target;

                if (!languageSelect) return;

                if (self.dataset.currentLanguage === 'en') {
                    // Change language to arabic
                    self.dataset.currentLanguage = 'ar';
                    self.textContent = 'English';
                    languageSelect.querySelector('[value="ar"]').selected = true;

                    // Fire onchange event
                    if ("createEvent" in document) {
                        var evt = document.createEvent("HTMLEvents");
                        evt.initEvent("change", false, true);
                        languageSelect.dispatchEvent(evt);
                    } else {
                        languageSelect.fireEvent("onchange");
                    }

                    document.querySelector('html').dir = 'rtl';
                    document.querySelector('body').dir = 'rtl';
                    let arrowIcons = document.querySelectorAll('.fa-arrow-right');
                    arrowIcons.forEach((el) => {
                        el.classList.add('fa-flip-horizontal');
                    })

                } else {
                    // Change language to english
                    self.dataset.currentLanguage = 'en';
                    self.textContent = 'العربية';
                    languageSelect.querySelector('[value="en"]').selected = true;

                    // Fire onchange event
                    if ("createEvent" in document) {
                        var evt = document.createEvent("HTMLEvents");
                        evt.initEvent("change", false, true);
                        languageSelect.dispatchEvent(evt);
                    } else {
                        languageSelect.fireEvent("onchange");
                    }

                    document.querySelector('html').dir = 'ltr';
                    document.querySelector('body').dir = 'ltr';

                    let arrowIcons = document.querySelectorAll('.fa-arrow-right');
                    arrowIcons.forEach((el) => {
                        el.classList.remove('fa-flip-horizontal');
                    })
                }
            }, false);
        </script>
    @endif

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'success':
                    toastr.success("{{ Session::get('message') }}");

                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
    @yield('scripts')

</body>

</html>
