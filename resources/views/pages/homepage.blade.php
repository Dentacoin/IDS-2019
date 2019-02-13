@extends("layout")
@section("content")
    <section class="intro-section">
        <div class="intro-image padding-top-170 padding-top-xs-30 padding-bottom-220 padding-bottom-xs-50">
            <div class="centered">
                <h1 class="color-white fs-65 fs-xs-35 color-white lato-black">{{ __('content.page_heading') }}</h1>

                <div class="fs-32 fs-xs-20 padding-top-30 lato-bold color-white">{!! __('content.below_heading') !!}</div>
            </div>
        </div>
    </section>

    <section class="address-section padding-top-20 padding-bottom-20 padding-top-xs-10 padding-bottom-xs-10 color-white-bg fs-0">
        <div class="inline-block fs-18 fs-xs-16 color-black address">{!! __('content.address') !!}</div>
        <figure class="inline-block" itemscope="Ids logo 2019" itemtype="http://schema.org/ImageObject"><img alt="" class="max-width-140 max-width-xs-120" itemprop="contentUrl" src="/assets/uploads/ids-logo-2019.jpg" /></figure>
    </section>

    <section class="look-into-future-section padding-top-70 padding-top-xs-50">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 text-center">
                    <h2 class="lato-bold fs-35 fs-xs-26 color-black padding-bottom-20 padding-bottom-xs-0 ">{{ __('content.look_into_future') }}</h2>

                    <div class="fs-20 fs-xs-16 padding-top-20 padding-bottom-20 line-height-24">{{ __('content.get_to_know') }}</div>

                    <div class="fs-20 fs-xs-16 calibri-regular padding-bottom-sm-20"><strong>{{ __('content.every_advisor') }}</strong></div>

                    <div class="padding-top-30 padding-bottom-100 padding-bottom-xs-30"><a class="white-solid-blue-btn min-width-250 scrolling-to-section" href="javascript:void(0);" id="schedule-a-meeting" target="_blank">{{ __('content.schedule_a_meeting') }}</a></div>
                </div>

                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center">
                    <div itemprop="video" itemscope="" itemtype="http://schema.org/VideoObject">
                        <video controls="" poster="/assets/images/video-thumb.png"><source src="/assets/videos/dentacoin-introduction.mp4" type="video/mp4" /> <track default="" kind="captions" label="English" src="/assets/videos/dentacoin-introduction.vtt" srclang="en" /> Your browser does not support HTML5 video.</video>

                        <link href="/assets/videos/dentacoin-video-thumb.jpg" itemprop="thumbnailUrl" />
                        <link href="/assets/videos/dentacoin-introduction.mp4" itemprop="contentURL" />
                        <meta itemprop="name" content="Dentacoin Introduction Video">
                        <meta itemprop="description" content="Explainer video: Dentacoin, the Blockchain Solution for the Global Dentistry">
                        <meta itemprop="uploadDate" content="2017-03-20T08:00:00+08:00"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-top-80 padding-bottom-50 padding-top-xs-30 padding-bottom-xs-20">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
                    <h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-20 text-center color-black">{{ __('content.what_is_dcn') }}</h2>
                    <div class="fs-20 fs-xs-16">{!! __('content.dcn_is_the_first') !!}</div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-top-50 padding-bottom-50 padding-top-xs-30">
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
                                            <img src="http://dentacoin.com/assets/uploads/{{$testimonial->media_name}}" alt="{{$testimonial->media_alt}}" itemprop="contentUrl"/>
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
    <section class="below-testimonials-section padding-top-50 padding-bottom-50 padding-bottom-xs-30 color-dark-blue-bg">
        <div class="container">
            <div class="row fs-0 text-center color-white">
                <div class="col-xs-12">
                    <div class="single inline-block-top">
                        <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="" class="max-width-60 margin-bottom-5" itemprop="contentUrl" src="/assets/uploads/statistic1.svg" /></figure>

                        <div class="fs-40 fs-xs-35 lato-light padding-top-10 lato-light">1.8K</div>

                        <div class="fs-18 lato-bold padding-bottom-xs-25">{{ __('content.dcn_dentists') }}</div>
                    </div>

                    <div class="single inline-block-top">
                        <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="" class="max-width-50" itemprop="contentUrl" src="/assets/uploads/statistic4.svg" /></figure>

                        <div class="fs-40 fs-xs-35 lato-light padding-top-10 lato-light">80+</div>

                        <div class="fs-18 lato-bold padding-bottom-xs-25">{{ __('content.locations_accepting_dcn') }}</div>
                    </div>

                    <div class="single inline-block-top">
                        <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="" class="max-width-80 margin-bottom-20" itemprop="contentUrl" src="/assets/uploads/statistic2.svg" /></figure>

                        <div class="fs-40 fs-xs-35 lato-light padding-top-10 lato-light">190K+</div>

                        <div class="fs-18 lato-bold padding-bottom-xs-25">{{ __('content.active_users') }}</div>
                    </div>

                    <div class="single inline-block-top">
                        <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="" class="max-width-60 margin-bottom-10" itemprop="contentUrl" src="/assets/uploads/statistic5.svg" /></figure>

                        <div class="fs-40 fs-xs-35 lato-light padding-top-10 lato-light">42K+</div>

                        <div class="fs-18 lato-bold padding-bottom-xs-25">{{ __('content.token_holders') }}</div>
                    </div>

                    <div class="single inline-block-top">
                        <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="" class="max-width-60 margin-bottom-10" itemprop="contentUrl" src="/assets/uploads/statistic3.svg" /></figure>

                        <div class="fs-40 fs-xs-35 lato-light padding-top-10 lato-light">190K+</div>

                        <div class="fs-18 lato-bold padding-bottom-xs-25">{{ __('content.dcn_transactions') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-to-find-us-section padding-top-70 padding-bottom-50 padding-top-xs-30 padding-bottom-xs-30" data-scroll-here="how-to-find-us">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-50 text-center color-black">{{ __('content.how_to_find_us') }}</h2>
                </div>
            </div>
        </div>

        <div class="custom-container fs-0 padding-bottom-30"><a class="image inline-block" href="/assets/uploads/dentacoin-ids-2019-location-map.pdf" target="_blank"><picture> <source media="(max-width: 992px)" srcset="/assets/uploads/map-hovered-mobile.jpg" /> <img alt="Two dentists" itemprop="contentUrl" src="/assets/uploads/map.png" /> </picture> </a>

            <div class="fs-18 fs-xs-16 lato-semibold padding-bottom-30 padding-left-15 padding-right-15 color-black mobile-address">{!! __('content.mobile_address') !!}</div>

            <div class="shadow-box padding-top-30 padding-bottom-30 inline-block">
                <div class="lato-bold fs-20 fs-xs-18 padding-bottom-10 color-black">{{ __('content.visiting_hours') }}</div>

                <div class="lato-semibold fs-18 fs-xs-16">{{ __('content.march-13-16') }}</div>

                <div class="lato-semibold fs-18 fs-xs-16">{{ __('content.daily-9-6') }}</div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center"><a class="white-solid-blue-btn min-width-250" href="/assets/uploads/dentacoin-ids-2019-location-map.pdf" target="_blank">{{ __('content.dl_plan') }}</a></div>
            </div>
        </div>
    </section>

    <section class="above-team-slider-section padding-top-70 padding-bottom-50 padding-top-xs-30 color-beige-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center">
                    <h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-20 color-black">{{ __('content.nice_to_meet_you') }}</h2>

                    <div class="fs-20 fs-xs-16 padding-top-15">{!! __('content.our_friendly') !!}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="color-beige-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="team-members-slider">
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
            </div>
        </div>
    </section>
    <section class="below-team-slider-section padding-top-50 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-50 color-beige-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center"><a class="white-solid-blue-btn min-width-250 scrolling-to-section" href="javascript:void(0);" id="schedule-a-meeting" target="_blank">{{ __('content.schedule_a_meeting') }}</a></div>
            </div>
        </div>
    </section>

    <section class="ids-speakers-corner-section padding-top-50 padding-top-xs-30 padding-bottom-70 padding-bottom-xs-40">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-20 color-black">{{ __('content.ids_speakers_corner') }}</h2>

                    <div class="lato-bold fs-22 fs-xs-20 padding-bottom-50 padding-bottom-xs-25 main-color">{{ __('content.transforming_the_future') }}</div>
                </div>
            </div>
        </div>

        <div class="custom-container fs-0">
            <figure class="inline-block" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Jeremias Grenzebach talking" itemprop="contentUrl" src="/assets/uploads/jeremias-talking.png" /></figure>

            <div class="content inline-block text-center-xs">
                <div class="lato-bold fs-20 color-black padding-top-xs-25">Jeremias Grenzebach</div>

                <div class="fs-20 fs-xs-18 padding-top-5 padding-bottom-20">{{ __('content.core_founder') }}</div>

                <div class="padding-bottom-10">
                    <div class="addeventatc" title="Add to Calendar">March 13, 4 pm<span class="start">03/13/2019 16:00</span> <span class="end">03/13/2019 16:30</span> <span class="timezone">GMT+1</span> <span class="title">Transforming the Future of Dentistry through Blockchain Technology</span> <span class="description">Keynote presentation of Dentacoin, the first blockchain solution for the global dental industry. Speaker: Jeremias Grenzebach, Co-Founder and Core Developer of Dentacoin</span> <span class="location">IDS, Koelnmesse, Passage 4/4</span></div>
                </div>

                <div>
                    <div class="addeventatc" title="Add to Calendar">March 15, 4 pm<span class="start">03/15/2019 16:00</span> <span class="end">03/15/2019 16:30</span> <span class="timezone">GMT+1</span> <span class="title">Transforming the Future of Dentistry through Blockchain Technology</span> <span class="description">Keynote presentation of Dentacoin, the first blockchain solution for the global dental industry. Speaker: Jeremias Grenzebach, Co-Founder and Core Developer of Dentacoin</span> <span class="location">IDS, Koelnmesse, Passage 4/4</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="schedule-a-meeting-section" data-scroll-here="schedule-a-meeting">
        <h2 class="lato-bold fs-35 fs-xs-26 padding-top-15 padding-bottom-40 padding-left-15 padding-right-15 color-black text-center">{{ __('content.schedule_a_meeting') }}</h2>
        <div class="days fs-0">
            @php($active_day = false)
            @foreach($meeting_days as $day)
                <a href="javascript:void(0)" class="single inline-block-top text-center @if(!$active_day) active
                @php($active_day = true) @endif" data-slug="{{$day->id}}">
                    <div class="month">
                        @if(config('app.locale') == 'en')
                            {{$day->month}}
                        @elseif(config('app.locale') == 'de')
                            @php($hour = str_replace('march', 'märz', $day->month))
                            {{$hour}}
                        @endif
                    </div>
                    <div class="day lato-black">{{$day->day}}</div>
                    <div class="triangle-active"></div>
                </a>
            @endforeach
        </div>
        <div class="form padding-top-40 padding-bottom-80 padding-bottom-xs-40">
            @include('partials.schedule-a-meeting')
        </div>
    </section>

    {{--{!! $sections[3]->html !!}--}}
    <section class="dentacoin-products-section padding-top-50 padding-bottom-50 padding-top-xs-30 padding-bottom-xs-0 color-beige-bg">
        <div class="container">
            <div class="row text-center">
                <div class="col-xs-12">
                    <h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-20 color-black">{{ __('content.dcn_products') }}</h2>
                </div>
                <div class="fs-20 fs-xs-16 padding-bottom-60 col-xs-12">{{ __('content.find_out') }}</div>
            </div>
            <div class="row text-center fs-0">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject"><a href="//coinmarketcap.com/currencies/dentacoin/" target="_blank"><img alt="Tools link icon" class="max-width-110" itemprop="contentUrl" src="/assets/uploads/dcn-crypto-icon.svg" /> <img alt="" class="hidden-image max-width-110" itemprop="contentUrl" src="/assets/uploads/tools-link-icon.svg" /></a></figure>

                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">{{ __('content.dcn_crypto') }}</div>

                            <div class="fs-18 fs-xs-16 max-width-300 margin-0-auto">{{ __('content.first_crypto') }}</div>
                        </div>

                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject"><a href="//wallet.dentacoin.com/" target="_blank"><img alt="Tools link icon" class="max-width-110" itemprop="contentUrl" src="/assets/uploads/dentacoin-wallet.svg" /> <img alt="" class="hidden-image max-width-110" itemprop="contentUrl" src="/assets/uploads/tools-link-icon.svg" /></a></figure>

                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">{{ __('content.dcn_wallet') }}</div>

                            <div class="fs-18 fs-xs-16 max-width-300 margin-0-auto">{{ __('content.decentralized_wallet') }}</div>
                        </div>

                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject"><a href="//reviews.dentacoin.com/" target="_blank"><img alt="Tools link icon" class="max-width-110" itemprop="contentUrl" src="/assets/uploads/trusted-reviews.svg" /> <img alt="" class="hidden-image max-width-110" itemprop="contentUrl" src="/assets/uploads/tools-link-icon.svg" /></a></figure>

                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">{{ __('content.trp') }}</div>

                            <div class="fs-20 fs-xs-16 max-width-300 margin-0-auto">{{ __('content.first_platform') }}</div>
                        </div>

                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject"><a href="//dentavox.dentacoin.com/" target="_blank"><img alt="Tools link icon" class="max-width-110" itemprop="contentUrl" src="/assets/uploads/dentavox.svg" /> <img alt="" class="hidden-image max-width-110" itemprop="contentUrl" src="/assets/uploads/tools-link-icon.svg" /></a></figure>

                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">DentaVox</div>

                            <div class="fs-20 fs-xs-16 max-width-300 margin-0-auto">{{ __('content.peerless_market') }}</div>
                        </div>

                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject"><a href="//dentacare.dentacoin.com/" target="_blank"><img alt="Tools link icon" class="max-width-110" itemprop="contentUrl" src="/assets/uploads/dentacare.svg" /> <img alt="" class="hidden-image max-width-110" itemprop="contentUrl" src="/assets/uploads/tools-link-icon.svg" /></a></figure>

                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">Dentacare</div>

                            <div class="fs-20 fs-xs-16 max-width-300 margin-0-auto">{{ __('content.gamified_mobile') }}</div>
                        </div>

                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Tools link icon" class="max-width-110" itemprop="contentUrl" src="/assets/uploads/dentacoin-assurance.svg" /><img alt="" class="hidden-image max-width-110" itemprop="contentUrl" src="/assets/uploads/coming-soon-tools.svg" /></figure>

                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">Dentacoin Assurance</div>

                            <div class="fs-20 fs-xs-16 max-width-300 margin-0-auto">{{ __('content.revolutionary') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="padding-top-70 padding-bottom-80 padding-top-xs-30 padding-bottom-xs-30 get-the-latest-event-updates-section">
        <div class="container">
            <div class="email-octopus-form-wrapper">
                <form action="https://emailoctopus.com/lists/6c1e17a2-f89a-11e8-a3c9-06b79b628af2/members/embedded/1.3s/add" class="email-octopus-form" data-sitekey="6LdYsmsUAAAAAPXVTt-ovRsPIJ_IVhvYBBhGvRV6" method="post">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-35 color-black text-center">{{ __('content.get_latest_updates') }}</h2>
                        </div>
                    </div>

                    <div class="row fs-0">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2 text-right inline-block iframe-wrapper"><iframe allow="encrypted-media" allowtransparency="true" frameborder="0" height="500" scrolling="no" src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdentacoin%2F&amp;tabs=events&amp;width=340&amp;height=500&amp;small_header=true&amp;adapt_container_width=true&amp;hide_cover=true&amp;show_facepile=true&amp;appId" style="border:none;overflow:hidden" width="340"></iframe></div>

                        <div class="col-xs-12 col-sm-6 col-md-4 inline-block form fs-18">
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

                            <div class="email-octopus-form-row-subscribe text-left"><input name="successRedirectUrl" type="hidden" value="" /> <input class="white-solid-blue-btn min-width-250" type="submit" value="{{ __('content.sign_up') }}" /></div>
                        </div>
                    </div>
                </form>
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
