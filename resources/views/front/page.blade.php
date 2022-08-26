@extends('front.layout.layout')

@section('content')
    <div class="container-fluid">
            @php
                $lang = session()->get('lang') ?? 'en';
                $theme_key = App\Models\Setting::where('key', 'theme')->first();
                $theme = session()->get('theme') ?? ($theme_key ? $theme_key->value : '');
            @endphp
        <!--page title -->
        <h2 class="item-title mt-3">{{ $page->title }}</h2>  <!-- Update 18 Jul --> 

        <div class="container">
            <p>
                {!! $page->content !!}
            </p>
        </div>

    </div>

@endsection