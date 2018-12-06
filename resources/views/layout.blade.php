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
    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
    <script>
        var HOME_URL = '{{ route("home") }}';
    </script>
</head>
<body class="@if(!empty(Route::current())) {{Route::current()->getName()}} @else class-404 @endif">
    @php($header_menu = \App\Http\Controllers\Controller::instance()->getMenu('header'))
    @if(isset($mobile) && $mobile && !empty($header_menu))
        <div class="mobile-nav">
            <div class="close-btn">
                <a href="javascript:void(0)">
                    <img src="{{URL::asset('assets/images/close-mobile-nav.svg') }}" alt=""/>
                </a>
            </div>
            <nav>
                <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                    @foreach(\App\Http\Controllers\Controller::instance()->getMenu('header') as $menu_el)
                        @if((isset($mobile) && $mobile && $menu_el->mobile_visible))
                            <li><a itemprop="url" class="{{$menu_el->class_attribute}}" @if(!empty($menu_el->id_attribute)) id="{{$menu_el->id_attribute}}" @endif @if(!empty(Route::current()) && Route::current()->getName() != 'home' && strpos($menu_el->class_attribute, 'scrolling-to-section') !== false) href="{{route('home')}}#{{$menu_el->id_attribute}}" @else @if($menu_el->new_window) target="_blank" @endif href="{{$menu_el->url}}" @endif><span itemprop="name">{{$menu_el->name}}</span></a></li>
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>
    @endif
    <header>
        <div class="container">
            <div class="row fs-0">
                <nav class="col-xs-3 @if(isset($mobile) && $mobile) col-md-8 @else col-md-9 @endif menu inline-block">
                    <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                        <li class="inline-block logo">
                            <figure itemscope="" itemtype="http://schema.org/Organization">
                                <a itemprop="url" href="{{ route('home') }}" @if(!empty(Route::current())) @if(Route::current()->getName() == "home") tabindex="=-1" @endif @endif>
                                    <img src="{{URL::asset('assets/images/logo.svg') }}" itemprop="logo" class="max-width-50 max-width-xs-30" alt="Dentacoin logo"/>
                                </a>
                            </figure>
                        </li>
                        @if(sizeof($header_menu) > 0)
                            @foreach($header_menu as $menu_el)
                                @if(!$mobile && $menu_el->desktop_visible)
                                    <li class="inline-block"><a @if($menu_el->new_window) target="_blank" @endif itemprop="url" href="{{$menu_el->url}}" class="{{$menu_el->class_attribute}} color-black" @if(!empty($menu_el->id_attribute)) id="{{$menu_el->id_attribute}}" @endif><span itemprop="name">{{$menu_el->name}}</span></a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </nav>
                <nav class="col-md-3 col-xs-6 socials inline-block">
                    @php($social_menu = \App\Http\Controllers\Controller::instance()->getMenu('socials'))
                    @if(sizeof($social_menu) > 0)
                        <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                            @foreach($social_menu as $menu_el)
                                @if((isset($mobile) && $mobile && $menu_el->mobile_visible) || (isset($mobile) && !$mobile && $menu_el->desktop_visible))
                                    <li class="inline-block"><a @if($menu_el->new_window) target="_blank" @endif itemprop="url" href="{{$menu_el->url}}" class="{{$menu_el->class_attribute}}" @if(!empty($menu_el->id_attribute)) id="{{$menu_el->id_attribute}}" @endif>{!! $menu_el->name !!}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </nav>
                <div class="mobile-ham col-xs-3 col-md-1 text-right inline-block @if(isset($mobile) && $mobile) show-important @endif">
                    <a href="javascript:void(0)"><i class="fa fa-bars" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </header>
    <main class="main-container">@yield("content")</main>
    <footer>
        <div class="container padding-top-30">
            @if(!empty($socials))
                <div class="row">
                    <div class="col-xs-12 text-center fs-18 lato-semibold">We are social. Follow us:</div>
                </div>
                <div class="row socials">
                    <div class="col-xs-12" itemscope="" itemtype="http://schema.org/Organization">
                        <link itemprop="url" href="{{ route('home') }}">
                        <ul>
                            @foreach($socials as $social)
                                <li class="inline-block">
                                    <a itemprop="sameAs" target="_blank" href="{{$social->link}}">
                                        <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                            <img src="//dentacoin.com/assets/uploads/{{$social->media_name}}" alt="{{$social->media_alt}}" itemprop="contentUrl"/>
                                        </figure>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @if(!empty(Route::current()))
                @php($footer_menu = \App\Http\Controllers\Controller::instance()->getMenu('footer'))
            @endif
            @if(!empty($footer_menu) && sizeof($footer_menu) > 0)
                <div class="row menu">
                    <nav class="col-xs-12">
                        <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                            @php($first_el = false)
                            @foreach($footer_menu as $el)
                                @if((isset($mobile) && $mobile && $menu_el->mobile_visible) || (isset($mobile) && !$mobile && $menu_el->desktop_visible))
                                    @if($first_el)
                                        <li class="inline-block separator">|</li>
                                    @endif
                                    <li class="inline-block"><a @if($el->new_window) target="_blank" @endif itemprop="url" href="{{$el->url}}"><span itemprop="name">{{$el->name}}</span></a></li>
                                    @if(!$first_el)
                                        @php($first_el = true)
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            @endif
            <div class="row padding-bottom-50 text-center fs-13 bottom-text">
                <div class="col-xs-12">© 2018 Dentacoin Foundation. All rights reserved.</div>
                <div class="col-xs-12">
                    <a href="//dentacoin.com/privacy-policy" target="_blank">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>
    <div class="custom-popup send-an-inquiry">
        <div class="popup-body">
            <button type="button" class="close-btn" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="wrapper">
                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
                <script>
                    hbspt.forms.create({
                        portalId: "4097841",
                        formId: "5bed7fbd-f7cc-4cb2-9fcd-e81820afe323"
                    });
                </script>
            </div>
        </div>
    </div>
<script src="/assets/js/basic.js"></script>
<script src="/dist/js/front-libs-script.js?v=1.0.13"></script>
@yield("script_block")
{{--<script src="/dist/js/front-script.js?v=1.0.13"></script>--}}
<script src="/assets/js/index.js"></script>
</body>
</html>