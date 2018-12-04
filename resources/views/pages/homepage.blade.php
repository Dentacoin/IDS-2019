@extends("layout")
@section("content")
    <section class="intro-section">
        <div class="intro-image">
            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                <img alt="Ids hero image" itemprop="contentUrl" src="/assets/uploads/ids-hero-image.jpg"/>
            </figure>
            <div class="centered-content container">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                        <h1 class="color-white fs-65 color-white lato-black">Meet DENTACOIN at IDS 2019</h1>
                        <div class="fs-32 padding-top-20 lato-bold color-white">The “Bitcoin of Dentistry” is making its first appearance at the World’s Leading Dental Summit!</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="address-section padding-top-20 padding-bottom-20 color-white-bg">
        <div class="inline-block fs-18">
            March 12-16 | Koelnmesse, Cologne, Germany<br>Hall 11.3, Stand K060-L069
        </div>
        <figure itemscope="Ids logo 2019" itemtype="http://schema.org/ImageObject" class="inline-block">
            <img alt="" itemprop="contentUrl" src="/assets/uploads/ids-logo-2019.jpg" class="max-width-140"/>
        </figure>
    </section>
    <section class="look-into-future-section padding-top-70">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 text-center">
                    <h2 class="lato-bold fs-35">Look Into The Future Of Dentistry</h2>
                    <div class="fs-18 padding-top-20 padding-bottom-20 line-height-24">Get to know Dentacoin currency and software tools in a gamified environment. Learn how to create a crypto wallet. Win rewards while exploring!</div>
                    <div class="fs-18 calibri-bold">Every visitor will receive Dentacoin tokens for free!</div>
                    <div class="padding-top-30 padding-bottom-50">
                        <a href="" class="white-solid-blue-btn">SCHEDULE A MEETING</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center">
                    <div itemprop="video" itemscope="" itemtype="http://schema.org/VideoObject">
                        <video controls>
                            <source src="/assets/videos/dentacoin-introduction.mp4" type="video/mp4">
                            <track src="/assets/videos/dentacoin-introduction.vtt" kind="captions" srclang="en" label="English" default="">
                            Your browser does not support HTML5 video.
                        </video>
                        <meta itemprop="name" content="Dentacoin Introduction Video">
                        <meta itemprop="description" content="Explainer video: Dentacoin, the Blockchain Solution for the Global Dentistry">
                        <meta itemprop="uploadDate" content="2017-03-20T08:00:00+08:00">
                        <link itemprop="thumbnailUrl" href="/assets/videos/dentacoin-video-thumb.jpg">
                        <link itemprop="contentURL" href="/assets/videos/dentacoin-introduction.mp4">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-top-50 padding-bottom-50">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
                    <h2 class="lato-bold fs-35 padding-bottom-20 text-center">WHAT IS DENTACOIN?</h2>
                    <div class="fs-18">Dentacoin is the first Blockchain solution for the global dental industry. It stands for a cryptocurrency and an integrated platform of software tools created to favor all - dentists, patients, and dental manufacturers.
                        <br><br>Dentacoin helps dental professionals develop successful, prevention-focused practices and mutually beneficial, future-proof relations with their patients. <a href="">Learn more...</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-top-50 padding-bottom-50">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="testimonials-slider-section">
                        @foreach($testimonials as $testimonial)
                            <div class="single-testimonial">
                                <div class="img-title-job fs-0">
                                    <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block-top">
                                        @if(empty($testimonial->media))
                                            <img src="/assets/images/avatar-icon.svg" alt="" itemprop="contentUrl"/>
                                        @else
                                            <img src="{{URL::asset('assets/uploads/'.$testimonial->media->name) }}" alt="@if(!empty($testimonial->media->alt)){{$testimonial->media->alt}}@endif" itemprop="contentUrl"/>
                                        @endif
                                    </figure>
                                    <div class="title-job inline-block-top">
                                        @if(!empty($testimonial->name))
                                            <div class="title color-black">{{$testimonial->name}}</div>
                                        @endif
                                        @if(!empty($testimonial->job))
                                            <div class="job">{{$testimonial->job}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="description">{!! $testimonial->text !!}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
