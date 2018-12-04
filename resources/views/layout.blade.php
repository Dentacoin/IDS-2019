<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="shortcut icon" href="{{URL::asset('assets/images/favicon.png') }}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @if(!empty($meta_data))
        <title>{{$meta_data->title}}</title>
        <meta name="description" content="{{$meta_data->description}}" />
        <meta name="keywords" content="{{$meta_data->keywords}}" />
        <meta property="og:url" content="{{Request::url()}}"/>
        <meta property="og:title" content="{{$meta_data->social_title}}"/>
        <meta property="og:description" content="{{$meta_data->social_description}}"/>
        @if(!empty($meta_data->media))
            <meta property="og:image" content="{{URL::asset('assets/uploads/'.$meta_data->media->name)}}"/>
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
        @endif
    @endif
    @if(!empty(Route::current()) && Route::current()->getName() == 'home')
        <link rel="canonical" href="{{route('home')}}" />
    @endif
    <style>

    </style>
    <link rel="stylesheet" type="text/css" href="/dist/css/front-libs-style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <script>
        var HOME_URL = '{{ route("home") }}';
    </script>
</head>
<body class="@if(!empty(Route::current())) {{Route::current()->getName()}} @else class-404 @endif">
    <header>
        <div class="container">
            <div class="row fs-0">
                <nav class="col-xs-9 menu inline-block">
                    <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                        <li class="inline-block">
                            <figure itemscope="" itemtype="http://schema.org/Organization">
                                <a itemprop="url" href="{{ route('home') }}" @if(!empty(Route::current())) @if(Route::current()->getName() == "home") tabindex="=-1" @endif @endif>
                                    <img src="{{URL::asset('assets/images/logo.svg') }}" itemprop="logo" class="max-width-50 max-width-xs-40" alt="Dentacoin logo"/>
                                </a>
                            </figure>
                        </li>
                        @php($header_menu = \App\Http\Controllers\Controller::instance()->getMenu('header'))
                        @if(!empty($header_menu))
                            @foreach($header_menu as $menu_el)
                                @if(($mobile && $menu_el->mobile_visible) || (!$mobile && $menu_el->desktop_visible))
                                    <li class="inline-block"><a @if($menu_el->new_window) target="_blank" @endif itemprop="url" href="{{$menu_el->url}}" class="{{$menu_el->class_attribute}}" @if(!empty($menu_el->id_attribute)) id="{{$menu_el->id_attribute}}" @endif><span itemprop="name">{{$menu_el->name}}</span></a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </nav>
                <nav class="col-xs-3 socials inline-block">
                    <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                        @php($social_menu = \App\Http\Controllers\Controller::instance()->getMenu('socials'))
                        @if(!empty($social_menu))
                            @foreach($social_menu as $menu_el)
                                @if(($mobile && $menu_el->mobile_visible) || (!$mobile && $menu_el->desktop_visible))
                                    <li class="inline-block"><a @if($menu_el->new_window) target="_blank" @endif itemprop="url" href="{{$menu_el->url}}" class="{{$menu_el->class_attribute}}" @if(!empty($menu_el->id_attribute)) id="{{$menu_el->id_attribute}}" @endif>{!! $menu_el->name !!}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="main-container">@yield("content")</main>
    <footer>
        Footer
    </footer>
<script src="/assets/js/basic.js"></script>
<script src="/dist/js/front-libs-script.js?v=1.0.13"></script>
@yield("script_block")
{{--<script src="/dist/js/front-script.js?v=1.0.13"></script>--}}
<script src="/assets/js/index.js"></script>
</body>
</html>