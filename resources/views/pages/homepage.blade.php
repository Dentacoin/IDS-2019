@extends("layout")
@section("content")
    <section class="top-homepage-slider-section">
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
        <div class="timer">
            <h2 class="lato-bold fs-32 fs-xs-20 text-center padding-bottom-15">{{ __('content.ids_starts_in') }}</h2>
            <div class="clock"></div>
        </div>
    </section>
    <section class="achievements-section text-center padding-top-100 padding-bottom-70 padding-top-xs-50 padding-bottom-xs-0">
        <div class="container">
            <div class="row fs-0">
                <div class="col-xs-12">
                    <h2 class="lato-bold fs-32 fs-xs-20 padding-bottom-50 color-black">{{ __('content.what_we_did_for_5_days') }}</h2>
                </div>
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 inline-block padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img src="/assets/uploads/visitors-to-dcn-stand.svg" alt=""/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold padding-top-10"><span class="lato-light fs-38">15K</span>{{ __('content.visitors') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img src="/assets/uploads/concluded-partnerships.svg" alt=""/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold"><span class="lato-light fs-38">26</span>{{ __('content.partnerships') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img src="/assets/uploads/prospective-partnerts.svg" alt=""/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold"><span class="lato-light fs-38">700</span>{{ __('content.prospective_partners') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img src="/assets/uploads/ongoing-negotiations.svg" alt=""/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold padding-top-5"><span class="lato-light fs-38">52</span>{{ __('content.negotiations') }}</figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="highlights-section padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30" data-scroll-here="highlights-section">
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
                                            <img src="/assets/uploads/{{$highlight->media->name}}" alt="{{$highlight->media->alt}}"/>
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
    <section class="gallery-section padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30" data-scroll-here="gallery-section">
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
                                        <img src="/assets/uploads/{{$photo->media->name}}" alt="{{$photo->media->alt}}"/>
                                    </figure>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
    <section class="ids-speakers-corner-section padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30" data-scroll-here="speakers-corner-section">
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
                    <iframe src="https://www.youtube.com/embed/AnCB5Edl_Ck"></iframe>
                </div>
            </div>
        </div>
    </section>
    <section class="color-beige-bg team-members-section padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30" data-scroll-here="our-team-at-ids-2019">
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
                                    <img src="{{URL::asset('assets/uploads/'.$team_member->media->name) }}" alt="@if(!empty($team_member->media->alt)){{$team_member->media->alt}}@endif" itemprop="contentUrl"/>
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
                    <a class="white-solid-blue-btn min-width-250 show-send-an-inquiry-button" href="javascript:void(0)" target="_blank">{{ __('content.send_an_inquiry') }}</a>
                </div>
            </div>
        </div>
    </section>
    <section class="what-is-dcn-section padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30 text-center" data-scroll-here="what-is-dentacoin-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3">
                    <h2 class="lato-bold fs-32 fs-xs-20 padding-bottom-30 color-black">{{ __('content.what_is_dcn') }}</h2>
                    <div class="padding-bottom-40 fs-18 fs-xs-14">{!! __('content.dcn_is_the_first') !!}</div>
                </div>
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
                    <div itemprop="video" itemscope="" itemtype="http://schema.org/VideoObject">
                        <video controls>
                            <source src="//dentacoin.com/assets/videos/dentacoin-explainer-video.mp4" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                        <meta itemprop="name" content="Dentacoin Introduction Video">
                        <meta itemprop="description" content="Explainer video: Dentacoin, the Blockchain Solution for the Global Dentistry">
                        <meta itemprop="uploadDate" content="2019-03-19T08:00:00+08:00">
                        <link itemprop="contentURL" href="//dentacoin.com/assets/videos/dentacoin-explainer-video.mp4">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="testimonials-slider-section">
                        @foreach($testimonials as $testimonial)
                            <div class="single-testimonial">
                                <div class="img-title-job fs-0">
                                    <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block-top">
                                        @if(empty($testimonial->media_name))
                                            <img src="/assets/images/avatar-icon.svg" alt="" itemprop="contentUrl"/>
                                        @else
                                            <img src="//dentacoin.com/assets/uploads/{{$testimonial->media_name}}" alt="{{$testimonial->media_alt}}" itemprop="contentUrl"/>
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
    <section class="statistics-section text-center padding-top-70 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-30  padding-top-sm-30 padding-bottom-sm-30">
        <div class="container">
            <div class="row fs-0">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 inline-block-bottom padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img src="/assets/uploads/locations-accepting-dcn.svg" alt="" class="max-width-40"/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold padding-top-10"><span class="lato-light fs-38">80+</span>{{ __('content.locations_accepting_dcn') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block-bottom padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img src="/assets/uploads/active-users.svg" alt="" class="max-width-80"/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold"><span class="lato-light fs-38">190K+</span>{{ __('content.active_users') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block-bottom padding-bottom-xs-40">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img src="/assets/uploads/transactions.svg" alt="" class="max-width-60"/>
                                <figcaption class="fs-18 fs-xs-16 lato-bold"><span class="lato-light fs-38">190K+</span>{{ __('content.dcn_transactions') }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-sm-3 col-xs-12 inline-block-bottom">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img src="/assets/uploads/token-holders.svg" alt="" class="max-width-60"/>
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
    <section class="applications-section padding-top-80 padding-top-xs-30 padding-bottom-80 padding-bottom-xs-30">
        <div class="container">
            <div class="row list">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="row fs-0">
                        @foreach($applications as $application)
                            @php($type = pathinfo($application->media_url, PATHINFO_EXTENSION))
                            @php($date = new DateTime($application->media_created_at))
                            <button class="col-md-3 col-xs-4 inline-block-top single-application">
                                <figure class="wrapper" @if($application->media_url) data-image="//dentacoin.com/assets/uploads/{{$application->media_url}}" data-image-alt="" data-image-type="{{$type}}" data-upload-date="{{$date->format('c')}}" @endif @if($application->popup_logo_url) data-popup-logo="//dentacoin.com/assets/uploads/{{$application->popup_logo_url}}" data-popup-logo-alt="" @endif data-description="@if($application->dentists_text){{ json_encode($application->dentists_text) }}@endif" @if($application->slug == 'blog-intro') data-articles="{{json_encode($latest_blog_articles)}}" @endif data-title="{{$application->title}}" itemscope="" data-slug="{{$application->slug}}" itemtype="http://schema.org/ImageObject">
                                    @if($application->logo_url)
                                        <img src="//dentacoin.com/assets/uploads/{{$application->logo_url}}" itemprop="contentUrl" alt=""/>
                                    @endif
                                    <figcaption>{{$application->title}}</figcaption>
                                </figure>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-top-70 padding-bottom-50 padding-top-xs-30 padding-bottom-xs-30 get-the-latest-event-updates-section" data-scroll-here="subscribe-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h2 class="lato-bold fs-32 fs-xs-20 margin-bottom-0 padding-bottom-15 color-black">{{ __('content.get_latest_updates') }}</h2>
                    <div class="fs-18 fs-xs-14">{{ __('content.subscribe') }}</div>
                </div>
                <div class="col-xs-12 text-center padding-top-50">
                    <div id="mc_embed_signup">
                        <form action="https://dentacoin.us16.list-manage.com/subscribe/post?u=61ace7d2b009198ca373cb213&amp;id=cd60f60a48" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                            <div id="mc_embed_signup_scroll">
                                <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                                <input type="hidden" name="b_61ace7d2b009198ca373cb213_cd60f60a48" tabindex="-1" value="">
                                <div class="clear btn-container"><input type="submit" value="Sign Up" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                            </div>
                            <div class="checkbox-row"><input type="checkbox" required id="newsletter-privacy-policy"/><label for="newsletter-privacy-policy">I agree with <a href="//dentacoin.com/privacy-policy" target="_blank">Privacy Policy</a></label></div>
                        </form>
                    </div>
                </div>
            </div>
                {{--<form action="https://emailoctopus.com/lists/6c1e17a2-f89a-11e8-a3c9-06b79b628af2/members/embedded/1.3s/add" class="email-octopus-form" data-sitekey="6LdYsmsUAAAAAPXVTt-ovRsPIJ_IVhvYBBhGvRV6" method="post">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h2 class="lato-bold fs-32 fs-xs-20 margin-bottom-0 padding-bottom-15 color-black">{{ __('content.get_latest_updates') }}</h2>
                            <div class="fs-18 fs-xs-14">{{ __('content.subscribe') }}</div>
                        </div>
                    </div>

                    <div class="row fs-0">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3 inline-block form fs-18">
                            <p class="email-octopus-success-message text-center">&nbsp;</p>

                            <p class="email-octopus-error-message text-center">&nbsp;</p>

                            <div class="email-octopus-form-row fs-0 padding-top-15">
                                <div class="inline-block title"><label class="fs-18" for="field_3">{{ __('content.title_field') }}:</label>
                                    <select id="field_3" name="field_3">
                                        <option value="{{ __('content.title_option_mr') }}">{{ __('content.title_option_mr') }}</option>
                                        <option value="{{ __('content.title_option_mrs') }}">{{ __('content.title_option_mrs') }}</option>
                                        <option value="{{ __('content.title_option_dr') }}">{{ __('content.title_option_dr') }}</option>
                                        <option value="{{ __('content.title_option_prof') }}">{{ __('content.title_option_prof') }}</option>
                                        <option value="{{ __('content.title_option_prof_dr') }}">{{ __('content.title_option_prof_dr') }}</option>
                                    </select></div>

                                <div class="inline-block name"><label class="fs-18" for="field_4">Name:</label> <input class="email-octopus-field" id="field_4" name="field_4" placeholder="" type="text" /></div>
                            </div>

                            <div class="email-octopus-form-row"><label class="fs-18" for="field_0">{{ __('content.newsletter_email') }}:</label> <input class="email-octopus-field" id="field_0" name="field_0" placeholder="" type="email" /></div>

                            <div class="email-octopus-form-row-consent privacy-policy-row fs-0"><input class="email-octopus-checkbox" id="consent" name="consent" type="checkbox" /> <label class="fs-14" for="consent">{!! __('content.privacy_policy_text') !!}</label></div>

                            <div aria-hidden="true" class="email-octopus-form-row-hp"><!-- Do not remove this field, otherwise you risk bot sign-ups --><input autocomplete="nope" name="hp6c1e17a2-f89a-11e8-a3c9-06b79b628af2" tabindex="-1" type="text" /></div>

                            <div class="email-octopus-form-row-subscribe text-center padding-top-15"><input name="successRedirectUrl" type="hidden" value="" /> <input class="white-solid-blue-btn min-width-250" type="submit" value="{{ __('content.sign_up') }}" /></div>
                        </div>
                    </div>
                </form>--}}
            {{--</div>--}}
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