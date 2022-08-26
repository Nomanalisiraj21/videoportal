@extends('front.layout.layout')

@section('content')

@php
$lang = session()->get('lang') ?? 'en';

$theme_key = App\Models\Setting::where('key', 'theme')->first();
$theme = session()->get('theme') ?? ($theme_key ? $theme_key->value : '');
@endphp

    <style>
        #carouselExampleControls {
            height: 504px;
        }

        #carouselExampleControls img {
            height: 100%;
            border-radius: 1.5rem;
        }
    </style>

    <div class="game-container">

        <!--New Games -->
        <div class="row mb-3 {{ $theme && $theme == 'light' ? 'text-dark' : 'text-white' }}">
            <div class="col-11">
                <h3 class="h4 d-flex"><i class="fa fa-plus mx-2" aria-hidden="true"></i>{{ $lang && $lang == 'ar' ? 'ألعاب جديدة' : 'NEW GAMES' }}</h3>
            </div>
            {{-- <div class="col-2">
                <h3 class="h4 text-right"><i class="fa fa-arrow-right" aria-hidden="true"></i></h3>
            </div> --}}
            <div class="col-1">
                <a href="{{ route('home.latest') }}" class="{{ $theme && $theme == 'light' ? 'text-dark' : 'text-white' }}"><h3 class="h4 text-right"><i class="fa fa-arrow-right {{ $lang && $lang == 'ar' ? 'fa-flip-horizontal' : '' }}" aria-hidden="true"></i></h3></a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="owl-carousel owl-theme">
                    @foreach($new_games as $key => $new_game)
                        <div class="grid-item item-grid item shadow mb-2">
                            @auth
                                <a href="{{ route('home.play', $new_game->id) }}" target="_blank">
                            @else
                               <a href="#" onclick="openLoginModal();"> 
                            @endauth
                                <div class="list-game">
                                    <div class="list-thumbnail mb-1"><img src="{{ '/storage/game/' . ($new_game->thumbnail ?? '') }}" class="small-thumb" alt="{{ $new_game->title }}"></div>
                                    {{-- <div class="list-title"><span class="btn btn-sm btn-outline-success">Play Now</span></div> --}}
                                    <div class="font-weight-light text-center {{ $theme && $theme == 'light' ? 'text-dark' : 'text-white' }}">{{ $new_game->title }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <br>
        <!-- Popular games -->
        <div class="row mb-3 {{ $theme && $theme == 'light' ? 'text-dark' : 'text-white' }}">
            <div class="col-11">
                <h3 class="h4 d-flex"><i class="fa fa-certificate mx-2" aria-hidden="true"></i>{{ $lang && $lang == 'ar' ? 'الأكثر شعبية' : 'POPULAR GAMES' }}</h3>
            </div>
            {{-- <div class="col-2">
                <h3 class="h4 text-right"><i class="fa fa-arrow-right" aria-hidden="true"></i></h3>
            </div> --}}
            <div class="col-1">
                <a href="{{ route('home.popular') }}" class="{{ $theme && $theme == 'light' ? 'text-dark' : 'text-white' }}"><h3 class="h4 text-right"><i class="fa fa-arrow-right {{ $lang && $lang == 'ar' ? 'fa-flip-horizontal' : '' }}" aria-hidden="true"></i></h3></a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="owl-carousel owl-theme">
                    @foreach($papular_games as $key => $papular_game)
                        <div class="grid-item item-grid item shadow mb-2">
                            @auth
                                <a href="{{ route('home.play', $papular_game->id) }}">
                            @else
                               <a href="#" onclick="openLoginModal();"> 
                            @endauth
                                <div class="list-game">
                                    <div class="list-thumbnail mb-1"><img src="{{ '/storage/game/' . ($papular_game->thumbnail ?? '') }}" class="small-thumb" alt="{{ $papular_game->title ?? '' }}"></div>
                                    {{-- <div class="list-title"><span class="btn btn-sm btn-outline-success">Play Now</span></div> --}}
                                    <div class="font-weight-light text-center {{ $theme && $theme == 'light' ? 'text-dark' : 'text-white' }}">{{ $papular_game->title }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <br>

        <!-- Category games -->
        {{-- for each category games --}}
        @foreach($cat_games as $category)
            <div class="row mb-3 {{ $theme && $theme == 'light' ? 'text-dark' : 'text-white' }}">
                <div class="col-11">
                    <h3 class="h4 d-flex"><i class="fa fa-gamepad mx-2" aria-hidden="true"></i>{{ $category->title ?? '' }}</h3>
                </div>
                <div class="col-1">
                    <a href="{{ route('home.category', ($category->id ?? 0)) }}" class="{{ $theme && $theme == 'light' ? 'text-dark' : 'text-white' }}"><h3 class="h4 text-right"><i class="fa fa-arrow-right {{ $lang && $lang == 'ar' ? 'fa-flip-horizontal' : '' }}" aria-hidden="true"></i></h3></a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="owl-carousel owl-theme">
                        @foreach($category->games as $key => $game)
                            <div class="grid-item item-grid item shadow mb-2">
                            @auth
                                <a href="{{ route('home.play', $game->id) }}">
                            @else
                                <a href="#" onclick="openLoginModal();"> 
                            @endauth
                                    <div class="list-game">
                                        <div class="list-thumbnail mb-1"><img src="{{ '/storage/game/' . ($game->thumbnail ?? '') }}" class="small-thumb" alt="{{ $game->title ?? '' }}"></div>
                                        {{-- <div class="list-title"><span class="btn btn-sm btn-outline-success">Play Now</span></div> --}}
                                        <div class="font-weight-light text-center {{ $theme && $theme == 'light' ? 'text-dark' : 'text-white' }}">{{ $game->title }}</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
        @endforeach
        {{-- // For each category games --}}

    </div> <!-- //Game Content -->

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                margin: 10,
                nav: false,
                loop: false,
               {{ $lang && $lang == 'ar' ? 'rtl:true,' : '' }}
                responsive: {
                    0: {items: 2},
                    200: {items: 3},
                    320: {items: 4},
                    768: {items: 7},
                    1024: {items: 10}
                }
            })
        })
    </script>

@endsection