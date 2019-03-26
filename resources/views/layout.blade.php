<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="shortcut icon" href="{{URL::asset('assets/images/favicon.png') }}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @if(config('app.locale') == 'en')
        <title>Meet Dentacoin at IDS 2019: Look into the future of dentistry</title>
        <meta name="description" content="Find us at Stand K060-L069, Hall 11.3 at the International Dental Show that will take place at Koelnmesse (Germany) on March 12-16, 2019" />
        <meta name="keywords" content="IDS, IDS 2019, international dental show, koelnmesse, dental fair, dental summit, dental business summit, dentacoin, dental industry" />
        <meta property="og:title" content="Meet Dentacoin at IDS 2019, Koelnmesse!"/>
        <meta property="og:description" content="Come visit us at Stand K060-L069, Hall 11.3 at the 38th International Dental Show that will take place at Koelnmesse (Germany) on March 12-16, 2019"/>
    @elseif(config('app.locale') == 'de')
        <title>Treffen Sie Dentacoin auf der IDS 2019: Blicken Sie in die Zukunft der Zahnmedizin</title>
        <meta name="description" content="Finden Sie uns am Stand K060-L069, Halle 11.3 auf der Internationalen Dental-Schau (IDS) organisiert von der Koelnmesse am 12-16.März 2019" />
        <meta name="keywords" content="IDS, IDS 2019, internationale dental schau, dentalmesse, koelnmesse, dentalmedizin messe, zahnmedizin messe, weltleitmesse des dental business, dentacoin, dentalindustrie" />
        <meta property="og:title" content="Treffen Sie Dentacoin auf der IDS 2019, Koelnmesse!"/>
        <meta property="og:description" content="Besuchen Sie uns am Stand K060-L069, Halle 11.3 auf der 38. Internationalen Dental-Schau (IDS) veranstaltet von der Koelnmesse am 12-16.März 2019"/>
    @endif
    @if(!empty($meta_data))
        <meta property="og:url" content="{{Request::url()}}"/>
        <meta property="og:type" content="website"/>
        @if(!empty($meta_data->media))
            <meta property="og:image" content="{{URL::asset('assets/uploads/'.$meta_data->media->name)}}"/>
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
        @endif
    @endif
    @if(!empty(Route::current()))
        <link rel="canonical" href="{{route('home', ['lang' => config('app.locale')])}}" />
        <link hreflang="en" href="{{route('home', ['lang' => 'en'])}}" rel="alternate" />
        <link hreflang="de" href="{{route('home', ['lang' => 'de'])}}" rel="alternate" />
        <link hreflang="x-default" href="{{route('home', ['lang' => 'en'])}}" rel="alternate"/>
    @endif
    <style>

    </style>
    <link rel="stylesheet" type="text/css" href="/dist/css/front-libs-style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
    <script>
        var HOME_URL = '{{ route("home", ['lang' => config('app.locale')]) }}';
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-97167262-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-97167262-4');
    </script>
</head>
<body class="@if(!empty(Route::current())) {{Route::current()->getName()}} @else class-404 @endif @if(config('app.locale') == 'de') german @endif">
    @php($header_menu = \App\Http\Controllers\Controller::instance()->getMenu('header'))
    <nav class="sidenav">
        <div class="wrapper">
            <a href="javascript:void(0)" class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></a>
            <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                @foreach($header_menu as $menu_el)
                    <li><a itemprop="url" class="{{$menu_el->class_attribute}}" @if(!empty($menu_el->id_attribute)) id="{{$menu_el->id_attribute}}" @endif @if(!empty(Route::current()) && Route::current()->getName() != 'home' && strpos($menu_el->class_attribute, 'scrolling-to-section') !== false) href="{{route('home')}}#{{$menu_el->id_attribute}}" @else @if($menu_el->new_window) target="_blank" @endif href="{{$menu_el->url}}" @endif><span itemprop="name">{{$menu_el->name}}</span></a></li>
                @endforeach
            </ul>
        </div>
    </nav>
    <header>
        <div class="container">
            <div class="row fs-0">
                <figure itemscope="" itemtype="http://schema.org/Organization" class="col-xs-7 col-md-8 logo padding-left-xs-10 padding-right-xs-10 inline-block">
                    <a itemprop="url" href="{{ route('home', ['lang' => config('app.locale')]) }}" @if(!empty(Route::current())) @if(Route::current()->getName() == "home") tabindex="=-1" @endif @endif>
                        <img src="{{URL::asset('assets/images/logo.svg') }}" itemprop="logo" class="max-width-40 max-width-xs-30" alt="Dentacoin logo"/>
                        <h1 class="inline-block fs-18 fs-xs-10 lato-bold">{{ __('content.dcn_at_ids') }}</h1>
                    </a>
                </figure>
                <nav class="col-md-4 col-xs-5 socials inline-block padding-left-xs-10 padding-right-xs-10">
                    @php($social_menu = \App\Http\Controllers\Controller::instance()->getMenu('socials'))
                    @if(sizeof($social_menu) > 0)
                        <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                            @foreach($social_menu as $menu_el)
                                @if((isset($mobile) && $mobile && $menu_el->mobile_visible) || (isset($mobile) && !$mobile && $menu_el->desktop_visible))
                                    <li class="inline-block"><a @if($menu_el->new_window) target="_blank" @endif itemprop="url" href="{{$menu_el->url}}" class="{{$menu_el->class_attribute}}" @if(!empty($menu_el->id_attribute)) id="{{$menu_el->id_attribute}}" @endif>{!! $menu_el->name !!}</a></li>
                                @endif
                            @endforeach
                            <li class="lang-switcher en inline-block @if(config('app.locale') == 'en') active @endif">
                                <a href="{{ route('home', ['lang' => 'en']) }}" itemprop="url">
                                    <span itemprop="name">EN</span>
                                </a>
                            </li>
                            <li class="separator fs-14 inline-block">|</li>
                            <li class="lang-switcher de inline-block @if(config('app.locale') == 'de') active @endif">
                                <a href="{{ route('home', ['lang' => 'de']) }}" itemprop="url">
                                    <span itemprop="name">DE</span>
                                </a>
                            </li>
                            <li class="mobile-ham inline-block padding-left-15 fs-xs-24 padding-left-xs-10">
                                <a href="javascript:void(0)"><i class="fa fa-bars" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    @endif
                </nav>
            </div>
        </div>
    </header>
    <main class="main-container">@yield("content")</main>
    <footer>
        <div class="container padding-top-30">
            @if(!empty($socials))
                <div class="row">
                    <div class="col-xs-12 text-center fs-18 lato-semibold padding-bottom-15">{{ __('content.we_are_social') }}</div>
                </div>
                <div class="row socials">
                    <div class="col-xs-12" itemscope="" itemtype="http://schema.org/Organization">
                        <link itemprop="url" href="{{ route('home', ['lang' => config('app.locale')]) }}">
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
                                @if((isset($mobile) && $mobile && $el->mobile_visible) || (isset($mobile) && !$mobile && $el->desktop_visible))
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
                <div class="col-xs-12">© 2019 Dentacoin Foundation. All rights reserved. <a href="//dentacoin.com/privacy-policy" target="_blank">Privacy Policy</a></div>
            </div>
        </div>
    </footer>
    <div class="custom-popup send-an-inquiry">
        <div class="popup-body">
            <button type="button" class="close-btn" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="wrapper">
                <div class="text-center fs-26 padding-bottom-30 lato-black">Send Your Inquiry</div>
                <script>
                    @if(config('app.locale') == 'en')
                        hbspt.forms.create({
                            portalId: "4097841",
                            formId: "5bed7fbd-f7cc-4cb2-9fcd-e81820afe323"
                        });
                    @elseif(config('app.locale') == 'de')
                        hbspt.forms.create({
                            portalId: "4097841",
                            formId: "c42037dc-5d80-476d-a40d-34a1ea8b3d50"
                        });
                    @endif
                </script>
            </div>
        </div>
    </div>
    <script type='application/ld+json'>
{
  "@context": "http://www.schema.org",
  "@type": "Event",
  "name": "DENTACOIN at IDS 2019",
  "url": "https://ids.dentacoin.com",
  "description": "The \"Bitcoin of Dentistry\" is making its first appearance at the World's Leading Dental Summit!",
  "startDate": "03/13/2019 09:00AM",
  "endDate": "03/06/2019 06:00PM",
  "image": "https://scontent-sof1-1.xx.fbcdn.net/v/t1.0-0/s350x350/46501377_625462404523493_7091251383793352704_n.jpg?_nc_cat=111&_nc_ht=scontent-sof1-1.xx&oh=aacb52b7a4ffe2cf7937d6b60d913cb8&oe=5CB4B772",
  "location": {
    "@type": "Place",
    "name": "IDS 2019",
    "sameAs": "http://english.ids-cologne.de",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Koelnmesse, Messepl. 1",
      "addressLocality": "Cologne",
      "postalCode": "50679",
      "addressCountry": "Germany"
    }
  }
 }
 </script>
<script src="/assets/js/basic.js"></script>
<script src="/dist/js/front-libs-script.js?v=1.0.18"></script>
{{--<script src="/dist/js/front-script.js?v=1.0.18"></script>--}}
@yield("script_block")
<script src="/assets/js/index.js"></script>
</body>
</html>