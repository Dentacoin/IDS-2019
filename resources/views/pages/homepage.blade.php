@extends("layout")
@section("content")
    <section class="top-homepage-slider-section hide-on-hub-open">
        @if(!empty($slider))
            <div class="slider">
                @foreach($slider as $slide)
                    <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="{{$slide->media->alt}}" itemprop="contentUrl" src="/assets/uploads/{{$slide->media->name}}" /></figure>
                @endforeach
            </div>
        @endif
        <div class="ids-square">
            <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="IDS logo" itemprop="contentUrl" src="/assets/uploads/ids-logo-2019.jpg" />
                <figcaption class="text-center lato-bold fs-20 line-height-14">12.-16.3.2019</figcaption>
            </figure>
        </div>
        {{--<div class="timer">
            <h2 class="lato-bold fs-32 fs-xs-20 text-center padding-bottom-15">{{ __('content.ids_starts_in') }}</h2>
            <div class="clock"></div>
        </div>--}}
    </section>
    <section class="achievements-section text-center padding-top-100 padding-bottom-70 padding-top-xs-50 padding-bottom-xs-0 hide-on-hub-open">
        <div class="container">
            <div class="row fs-0">
                <div class="col-xs-12">
                    <h2 class="lato-bold fs-32 fs-xs-20 padding-bottom-50 color-black">{{ __('content.what_we_did_for_5_days') }}</h2>
                </div>
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 inline-block padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img data-defer-src="/assets/uploads/visitors-to-dcn-stand.svg" alt=""/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold padding-top-10"><span class="lato-light fs-38">15K</span>{{ __('content.visitors') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img data-defer-src="/assets/uploads/concluded-partnerships.svg" alt=""/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold"><span class="lato-light fs-38">26</span>{{ __('content.partnerships') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img data-defer-src="/assets/uploads/prospective-partnerts.svg" alt=""/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold"><span class="lato-light fs-38">700</span>{{ __('content.prospective_partners') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img data-defer-src="/assets/uploads/ongoing-negotiations.svg" alt=""/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold padding-top-5"><span class="lato-light fs-38">52</span>{{ __('content.negotiations') }}</figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="highlights-section padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30 hide-on-hub-open" data-scroll-here="highlights-section">
        <div class="container">
            @if(!empty($highlights))
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="lato-bold fs-32 fs-xs-20 padding-bottom-50 padding-bottom-xs-20 color-black text-center">{{ __('content.highlights') }}</h2>
                    </div>
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                        <div class="slider">
                            @foreach($highlights as $highlight)
                                <div class="single-highlight fs-0">
                                    <a href="{{$highlight->url}}" target="_blank">
                                        <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block">
                                            <img data-defer-src="/assets/uploads/{{$highlight->media->name}}" alt="{{$highlight->media->alt}}"/>
                                        </figure>
                                        <div class="inline-block content">
                                            @if(config('app.locale') == 'en')
                                                <time class="lato-bold">{{date('M d, Y', strtotime($highlight->date))}}</time>
                                            @elseif(config('app.locale') == 'de')
                                                <time class="lato-bold">{{strftime ("%B %d, %Y", strtotime($highlight->date))}}</time>
                                            @endif
                                            <div class="text lato-light color-black fs-14">{!! mb_substr($highlight['text_'.config('app.locale')], 0, 250) !!}...</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <section class="gallery-section padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30 hide-on-hub-open" data-scroll-here="gallery-section">
        <div class="container">
            @if(!empty($gallery))
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="lato-bold fs-32 fs-xs-20 padding-bottom-50 padding-bottom-xs-20 color-black text-center">{{ __('content.gallery') }}</h2>
                    </div>
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1 slider">
                        @foreach($gallery as $photo)
                            <div class="single-photo fs-0">
                                <a href="/assets/uploads/{{$photo->media->name}}" data-lightbox="homepage-gallery">
                                    <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                        <img data-defer-src="/assets/uploads/{{$photo->media->name}}" alt="{{$photo->media->alt}}"/>
                                    </figure>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
    <section class="ids-speakers-corner-section padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30 hide-on-hub-open" data-scroll-here="speakers-corner-section">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="lato-bold fs-32 fs-xs-20 padding-bottom-20 color-black">IDS SPEAKERS CORNER</h2>
                </div>
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
                    <div class="lato-bold fs-22 fs-xs-16 padding-bottom-10">Transforming the Future of Dentistry through Blockchain Technology</div>
                    <div class="fs-18 fs-xs-14 color-black padding-bottom-40">{{ __('content.have_you_missed') }}</div>
                </div>
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
                    <iframe data-defer-src="https://www.youtube.com/embed/AnCB5Edl_Ck"></iframe>
                </div>
            </div>
        </div>
    </section>
    <section class="color-beige-bg team-members-section padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30 hide-on-hub-open" data-scroll-here="our-team-at-ids-2019">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="lato-bold fs-32 fs-xs-20 padding-bottom-30 color-black">{{ __('content.corner_team') }}</h2>
                    <div class="fs-18 fs-xs-14 padding-bottom-40">{{ __('content.if_you_have_visited') }}</div>
                </div>
                <div class="col-xs-12">
                    <div class="slider">
                        @foreach($team_members as $team_member)
                            <div class="single-team-member">
                                <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block-top">
                                    <img data-defer-src="{{URL::asset('assets/uploads/'.$team_member->media->name) }}" alt="@if(!empty($team_member->media->alt)){{$team_member->media->alt}}@endif" itemprop="contentUrl"/>
                                </figure>
                                <div class="name color-black">{{$team_member->name}}</div>
                                @if(config('app.locale') == 'en')
                                    @if(!empty($team_member->position))
                                        <div class="position">{{$team_member->position}}</div>
                                    @endif
                                @elseif(config('app.locale') == 'de')
                                    @if(!empty($team_member->position_de))
                                        <div class="position">{{$team_member->position_de}}</div>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 text-center padding-top-30">
                    <a class="white-solid-blue-btn min-width-250 show-send-an-inquiry-button" href="javascript:void(0)">{{ __('content.send_an_inquiry') }}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="what-is-dcn-section padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30 text-center hide-on-hub-open" data-scroll-here="what-is-dentacoin-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
                    <h2 class="lato-bold fs-32 fs-xs-20 padding-bottom-30 color-black">{{ __('content.what_is_dcn') }}</h2>
                    <div class="padding-bottom-40 fs-18 fs-xs-14">{!! __('content.dcn_is_the_first') !!}</div>
                </div>
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
                    <iframe data-defer-src="https://www.youtube.com/embed/-zKLaRhVn3c"></iframe>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30 padding-top-sm-30 padding-bottom-sm-30 hide-on-hub-open">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="testimonials-slider-section">
                        @foreach($testimonials as $testimonial)
                            <div class="single-testimonial">
                                <div class="img-title-job fs-0">
                                    <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block-top">
                                        @if(empty($testimonial->media_name))
                                            <img data-defer-src="/assets/images/avatar-icon.svg" alt="" itemprop="contentUrl"/>
                                        @else
                                            <img data-defer-src="//dentacoin.com/assets/uploads/{{$testimonial->media_name}}" alt="{{$testimonial->media_alt}}" itemprop="contentUrl"/>
                                        @endif
                                    </figure>
                                    <div class="title-job inline-block-top">
                                        <div class="title color-black">{{explode(',', $testimonial->name_job)[0]}}</div>
                                        @if(!empty(explode(',', $testimonial->name_job)[1]))
                                            <div class="job">{{explode(',', $testimonial->name_job)[1]}}</div>
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
    <section class="statistics-section text-center padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30 padding-top-sm-30 padding-bottom-sm-30 hide-on-hub-open">
        <div class="container">
            <div class="row fs-0">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 inline-block-bottom padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img data-defer-src="/assets/uploads/locations-accepting-dcn.svg" alt="" class="max-width-40"/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold padding-top-10"><span class="lato-light fs-38">80+</span>{{ __('content.locations_accepting_dcn') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block-bottom padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img data-defer-src="/assets/uploads/active-users.svg" alt="" class="max-width-80"/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold"><span class="lato-light fs-38">190K+</span>{{ __('content.active_users') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block-bottom padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img data-defer-src="/assets/uploads/transactions.svg" alt="" class="max-width-60"/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold"><span class="lato-light fs-38">190K+</span>{{ __('content.dcn_transactions') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block-bottom">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img data-defer-src="/assets/uploads/token-holders.svg" alt="" class="max-width-60"/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold padding-top-5"><span class="lato-light fs-38">42K+</span>{{ __('content.token_holders') }}</figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="applications-titles-section padding-top-70 padding-top-xs-30 padding-bottom-30 text-center" data-scroll-here="tools-of-change-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="lato-bold fs-32 fs-xs-20 padding-bottom-20 color-black">DENTACOIN TOOLS OF CHANGE</h2>
                    <div class="fs-18 fs-xs-14">{{ __('content.free_and_simple') }}</div>
                </div>
            </div>
        </div>
    </section>
    <section class="applications-section">
        <div id="append-big-hub-ids"></div>
    </section>
    <section class="padding-top-70 padding-bottom-50 padding-top-xs-30 padding-bottom-xs-30 get-the-latest-event-updates-section hide-on-hub-open" data-scroll-here="subscribe-section">
        <div class="container">
            <div class="row newsletter-register">
                <div class="col-xs-12 text-center padding-bottom-30">
                    <h2 class="lato-bold fs-32 fs-xs-20 margin-bottom-0 padding-bottom-15 color-black">{{ __('content.get_latest_updates') }}</h2>
                    <div class="fs-18 fs-xs-14">{{ __('content.subscribe') }}</div>
                </div>
                <div class="col-xs-12 text-center">
                    <div id="mc_embed_signup" class="form-container">
                        <form action="https://dentacoin.us16.list-manage.com/subscribe/post?u=61ace7d2b009198ca373cb213&amp;id=993df5967d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                            <div class="newsletter-field email-field" data-valid-message="Please enter valid email address.">
                                <div id="mc_embed_signup_scroll">
                                    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address">
                                    <input type="hidden" name="b_61ace7d2b009198ca373cb213_993df5967d" tabindex="-1" value="">
                                    <div class="clear btn-container"><input type="submit" value="Sign Up" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                                </div>
                            </div>
                            <div class="newsletter-field checkbox-field" data-valid-message="Please agree with our Privacy Policy.">
                                <div class="custom-checkbox-style module">
                                    <input type="checkbox" class="custom-checkbox-input" id="newsletter-privacy-policy"/>
                                    <label class="custom-checkbox-label" for="newsletter-privacy-policy">I agree with <a href="//dentacoin.com/privacy-policy" target="_blank">Privacy Policy</a></label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section("script_block")
    @if(count($errors) > 0)
        <script>
            var errors = '';
            @foreach($errors->all() as $error)
                errors+="{{ $error }}" + '<br>';
            @endforeach
            basic.showAlert(errors, '', true);
        </script>
    @endif
    @if (session('error'))
        <script>
            basic.showAlert("{{ session('error') }}", '', true);
        </script>
    @endif

    @if (session('success'))
        <script>
            basic.showAlert("{{ session('success') }}", '', true);
        </script>
    @endif
@endsection