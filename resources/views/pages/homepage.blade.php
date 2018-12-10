@extends("layout")
@section("content")
    {{--<section class="intro-section">
        <div class="intro-image padding-top-170 padding-top-xs-30 padding-bottom-220 padding-bottom-xs-50">
            <div class="centered">
                <h1 class="color-white fs-65 fs-xs-35 color-white lato-black">Meet DENTACOIN at IDS 2019</h1>
                <div class="fs-32 fs-xs-20 padding-top-30 lato-bold color-white">The “Bitcoin of Dentistry” is making its first appearance at the World’s Leading Dental Summit!</div>
            </div>
        </div>
    </section>
    <section class="address-section padding-top-20 padding-bottom-20 padding-top-xs-10 padding-bottom-xs-10 color-white-bg fs-0">
        <div class="inline-block fs-18 fs-xs-16 color-black address">
            March 12-16 | Koelnmesse, Cologne, Germany<br>Hall 11.3, Stand K060-L069
        </div>
        <figure itemscope="Ids logo 2019" itemtype="http://schema.org/ImageObject" class="inline-block">
            <img alt="" itemprop="contentUrl" src="/assets/uploads/ids-logo-2019.jpg" class="max-width-140 max-width-xs-120"/>
        </figure>
    </section>
    <section class="look-into-future-section padding-top-70 padding-top-xs-50">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 text-center">
                    <h2 class="lato-bold fs-35 fs-xs-26 color-black">LOOK INTO THE FUTURE OF DENTISTRY</h2>
                    <div class="fs-18 fs-xs-16 padding-top-20 padding-bottom-20 line-height-24">Get to know Dentacoin currency and software tools in a gamified environment. Learn how to create a crypto wallet. Win rewards while exploring!</div>
                    <div class="fs-18 fs-xs-16 calibri-bold">Every visitor will receive Dentacoin tokens for free!</div>
                    <div class="padding-top-30 padding-bottom-100 padding-bottom-xs-30">
                        <a href="https://calendar.google.com/calendar/selfsched?sstoken=UUNZRFNEMGVQUlM0fGRlZmF1bHR8MTQyNjZjYWRmNzM3ZmI2ZDEzMzZhNmRlM2U2MTA0NGM" target="_blank" class="white-solid-blue-btn min-width-250">SCHEDULE A MEETING</a>
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
    <section class="padding-top-80 padding-bottom-50 padding-top-xs-30 padding-bottom-xs-20">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
                    <h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-20 text-center color-black">WHAT IS DENTACOIN?</h2>
                    <div class="fs-18 fs-xs-16">Dentacoin is the first Blockchain solution for the global dental industry. It stands for a cryptocurrency and an integrated platform of software tools created to favor all - dentists, patients, and dental manufacturers.
                        <br><br>Dentacoin helps dental professionals develop successful, prevention-focused practices and mutually beneficial, future-proof relations with their patients. <a href="//dentacoin.com/" target="_blank" class="calibri-bold color-dark-blue">Learn more...</a>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    {!! $sections[0]->html !!}
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
    {!! $sections[1]->html !!}
    {{--<section class="below-testimonials-section padding-top-50 padding-bottom-50 padding-bottom-xs-30 color-dark-blue-bg">
        <div class="container">
            <div class="row fs-0 text-center color-white">
                <div class="col-xs-12">
                    <div class="single inline-block-top">
                        <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="" class="max-width-60 margin-bottom-5" itemprop="contentUrl" src="/assets/uploads/statistic1.svg" /></figure>
                        <div class="fs-40 fs-xs-35 lato-light padding-top-10 lato-light">1.8K</div>
                        <div class="fs-18 lato-bold padding-bottom-xs-25">Dentacoin Dentists</div>
                    </div>
                    <div class="single inline-block-top">
                        <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="" class="max-width-50" itemprop="contentUrl" src="/assets/uploads/statistic4.svg" /></figure>
                        <div class="fs-40 fs-xs-35 lato-light padding-top-10 lato-light">70+</div>
                        <div class="fs-18 lato-bold padding-bottom-xs-25">Locations Accepting DCN</div>
                    </div>
                    <div class="single inline-block-top">
                        <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="" class="max-width-80 margin-bottom-20" itemprop="contentUrl" src="/assets/uploads/statistic2.svg" /></figure>
                        <div class="fs-40 fs-xs-35 lato-light padding-top-10 lato-light">190K+</div>
                        <div class="fs-18 lato-bold padding-bottom-xs-25">Active Users & Subscribers</div>
                    </div>
                    <div class="single inline-block-top">
                        <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="" class="max-width-60 margin-bottom-10" itemprop="contentUrl" src="/assets/uploads/statistic5.svg" /></figure>
                        <div class="fs-40 fs-xs-35 lato-light padding-top-10 lato-light">190K+</div>
                        <div class="fs-18 lato-bold padding-bottom-xs-25">Token Holders</div>
                    </div>
                    <div class="single inline-block-top">
                        <figure itemscope="" itemtype="http://schema.org/ImageObject"><img alt="" class="max-width-60 margin-bottom-10" itemprop="contentUrl" src="/assets/uploads/statistic3.svg" /></figure>
                        <div class="fs-40 fs-xs-35 lato-light padding-top-10 lato-light">175K+</div>
                        <div class="fs-18 lato-bold padding-bottom-xs-25">Dentacoin Transactions</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-to-find-us-section padding-top-70 padding-bottom-50 padding-top-xs-30 padding-bottom-xs-30" data-scroll-here="how-to-find-us">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-50 text-center color-black">HOW TO FIND US</h2>
                </div>
            </div>
        </div>
        <div class="custom-container fs-0 padding-bottom-30">
            <a href="/assets/uploads/dentacoin-ids-2019-location-map.pdf" target="_blank" class="image inline-block">
                <picture>
                    <source media="(max-width: 992px)" srcset="/assets/uploads/map-hovered-mobile.jpg" />
                    <img alt="Two dentists" itemprop="contentUrl" src="/assets/uploads/map.png"/>
                </picture>
            </a>
            <div class="fs-18 fs-xs-16 lato-semibold padding-bottom-30 padding-left-15 padding-right-15 color-black mobile-address">Hall 11, Floor 3<br>Stand K060-L069</div>
            <div class="shadow-box padding-top-30 padding-bottom-30 inline-block">
                <div class="lato-bold fs-20 fs-xs-18 padding-bottom-10 color-black">VISITING HOURS:</div>
                <div class="lato-semibold fs-18 fs-xs-16">March 13 (Wed) to March 16 (Sat), 2019</div>
                <div class="lato-semibold fs-18 fs-xs-16">Daily from 09:00 am to 06:00 pm</div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <a href="/assets/uploads/dentacoin-ids-2019-location-map.pdf" target="_blank" class="white-solid-blue-btn min-width-250">DOWNLOAD PLAN</a>
                </div>
            </div>
        </div>
    </section>
    <section class="above-team-slider-section padding-top-70 padding-bottom-50 padding-top-xs-30 color-beige-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center">
                    <h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-20 color-black">NICE TO MEET YOU!</h2>
                    <div class="fs-18 fs-xs-16 padding-top-15">Our friendly and hospitable team will be happy to guide you through Dentacoin’s Reality and answer all your questions.<br> This is only a smart part of our IDS delegates:</div>
                </div>
            </div>
        </div>
    </section>--}}
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
                                @if(!empty($team_member->position))
                                    <div class="position">{{$team_member->position}}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    {!! $sections[2]->html !!}
    {{--<section class="below-team-slider-section padding-top-50 padding-bottom-70 padding-top-xs-30 padding-bottom-xs-50 color-beige-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <a href="https://calendar.google.com/calendar/selfsched?sstoken=UUNZRFNEMGVQUlM0fGRlZmF1bHR8MTQyNjZjYWRmNzM3ZmI2ZDEzMzZhNmRlM2U2MTA0NGM" class="white-solid-blue-btn min-width-250" target="_blank">SCHEDULE A MEETING</a>
                </div>
            </div>
        </div>
    </section>
    <section class="ids-speakers-corner-section padding-top-50 padding-top-xs-30 padding-bottom-70 padding-bottom-xs-40">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-20 color-black">IDS SPEAKERS CORNER</h2>
                    <div class="lato-bold fs-22 fs-xs-20 padding-bottom-50 padding-bottom-xs-25 main-color">Transforming the Future of Dentistry through Blockchain Technology</div>
                </div>
            </div>
        </div>
        <div class="custom-container fs-0">
            <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block">
                <img alt="Jeremias Grenzebach talking" itemprop="contentUrl" src="/assets/uploads/jeremias-talking.png"/>
            </figure>
            <div class="content inline-block text-center-xs">
                <div class="lato-bold fs-20 color-black padding-top-xs-25">Jeremias Grenzebach</div>
                <div class="fs-18 padding-top-5 padding-bottom-20">Co-Founder & Core Developer</div>
                <div class="fs-18 padding-bottom-5">March 13 (Wednesday)</div>
                <div class="fs-18 padding-bottom-20">March 15 (Friday)</div>
                <div><a href="javascript:void(0)" class="white-solid-blue-btn disabled"><i class="fa fa-calendar" aria-hidden="true"></i> SAVE THE DATE</a></div>
                <div class="fs-16 padding-top-10">*More info coming soon!</div>
            </div>
        </div>
    </section>
    <section class="dentacoin-products-section padding-top-50 padding-bottom-50 padding-top-xs-30 padding-bottom-xs-0 color-beige-bg">
        <div class="container">
            <div class="row text-center">
                <div class="col-xs-12"><h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-20 color-black">DENTACOIN PRODUCTS</h2></div>
                <div class="fs-18 fs-xs-16 padding-bottom-60 col-xs-12">Find out more about Dentacoin Ecosystem and see all our Blockchain-based applications at a glance!</div>
            </div>
            <div class="row text-center fs-0">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <a href="//coinmarketcap.com/currencies/dentacoin/" target="_blank">
                                    <img alt="Tools link icon" itemprop="contentUrl" class="max-width-110" src="/assets/uploads/tools-link-icon.svg"/>
                                </a>
                            </figure>
                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">DCN Cryptocurrency</div>
                            <div class="fs-18 fs-xs-16 max-width-300 margin-0-auto">Dentacoin is the first cryptocurrency created for the dental industry. It can be used as a means of payment or exchanged to other currencies.</div>
                        </div>
                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <a href="//wallet.dentacoin.com/" target="_blank">
                                    <img alt="Tools link icon" itemprop="contentUrl" class="max-width-110" src="/assets/uploads/dentacoin-wallet.svg"/>
                                </a>
                            </figure>
                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">Dentacoin Wallet</div>
                            <div class="fs-18 fs-xs-16 max-width-300 margin-0-auto">With our decentralized Wallet, you can buy, store and manage DCN safely and easily. Just create a secret key file and upload it to get started!</div>
                        </div>
                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <a href="//reviews.dentacoin.com/" target="_blank">
                                    <img alt="Tools link icon" itemprop="contentUrl" class="max-width-110" src="/assets/uploads/trusted-reviews.svg"/>
                                </a>
                            </figure>
                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">Trusted Reviews</div>
                            <div class="fs-18 fs-xs-16 max-width-300 margin-0-auto">The first platform for verified and incentivized dental treatment reviews to which patients are invited personally by their dentists.</div>
                        </div>
                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <a href="//dentavox.dentacoin.com/" target="_blank">
                                    <img alt="Tools link icon" itemprop="contentUrl" class="max-width-110" src="/assets/uploads/dentavox.svg"/>
                                </a>
                            </figure>
                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">DentaVox</div>
                            <div class="fs-18 fs-xs-16 max-width-300 margin-0-auto">A peerless market research website surveying users on various dental topics and rewarding them with Dentacoin (DCN).</div>
                        </div>
                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <a href="//dentavox.dentacoin.com/" target="_blank">
                                    <img alt="Tools link icon" itemprop="contentUrl" class="max-width-110" src="/assets/uploads/dentacare.svg"/>
                                </a>
                            </figure>
                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">Dentacare</div>
                            <div class="fs-18 fs-xs-16 max-width-300 margin-0-auto">A gamified mobile app teaching kids and adults to maintain good oral hygiene through a three-month, incentivized challenge.</div>
                        </div>
                        <div class="col-xs-12 col-sm-4 single padding-bottom-50 inline-block-top">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                <img alt="Tools link icon" itemprop="contentUrl" class="max-width-110" src="/assets/uploads/dentacoin-assurance.svg"/>
                            </figure>
                            <div class="lato-bold fs-20 padding-top-15 padding-bottom-10 color-black">Dentacoin Assurance</div>
                            <div class="fs-18 fs-xs-16 max-width-300 margin-0-auto"> A revolutionary, insurance-like dental program stimulating both dentists and patients to focus on sustainable prevention.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-top-70 padding-bottom-80 padding-top-xs-30 padding-bottom-xs-30 get-the-latest-event-updates-section">
        <div class="container">
            <div class="email-octopus-form-wrapper">
                <form method="post" action="https://emailoctopus.com/lists/6c1e17a2-f89a-11e8-a3c9-06b79b628af2/members/embedded/1.3s/add" class="email-octopus-form" data-sitekey="6LdYsmsUAAAAAPXVTt-ovRsPIJ_IVhvYBBhGvRV6">
                    <div class="row">
                        <div class="col-xs-12"><h2 class="lato-bold fs-35 fs-xs-26 padding-bottom-35 color-black text-center">GET THE LATEST EVENT UPDATES</h2></div>
                    </div>
                    <div class="row fs-0">
                        <div class="col-xs-12 col-sm-6 col-md-4 text-right inline-block iframe-wrapper">
                            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdentacoin%2F&tabs=events&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 inline-block form fs-18">
                            <h2 class="email-octopus-heading text-center"></h2>
                            <p class="email-octopus-success-message text-center"></p>
                            <p class="email-octopus-error-message text-center"></p>
                            <div class="email-octopus-form-row fs-0 padding-top-15">
                                <div class="inline-block title">
                                    <label for="field_3" class="fs-18">Title:</label>
                                    <select name="field_3" id="field_3">
                                        <option value="Dr.">Mr.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Dr.">Dr.</option>
                                        <option value="Prof.">Prof.</option>
                                        <option value="Prof. Dr.">Prof. Dr.</option>
                                    </select>
                                </div>
                                <div class="inline-block name">
                                    <label for="field_4" class="fs-18">Name:</label>
                                    <input id="field_4" name="field_4" type="text" class="email-octopus-field" placeholder="">
                                </div>
                            </div>
                            <div class="email-octopus-form-row">
                                <label for="field_0" class="fs-18">Email:</label>
                                <input id="field_0" name="field_0" type="email" class="email-octopus-field" placeholder="">
                            </div>
                            <div class="email-octopus-form-row-consent privacy-policy-row fs-0">
                                <input type="checkbox" id="consent" class="email-octopus-checkbox" name="consent">
                                <label for="consent" class="fs-14">By submitting the form, you agree to our <a href="//dentacoin.com/privacy-policy" rel="noopener noreferrer" target="_blank">Privacy Policy</a>.</label>
                            </div>
                            <div class="email-octopus-form-row-hp" aria-hidden="true">
                                <!-- Do not remove this field, otherwise you risk bot sign-ups -->
                                <input type="text" name="hp6c1e17a2-f89a-11e8-a3c9-06b79b628af2" tabindex="-1" autocomplete="nope">
                            </div>
                            <div class="email-octopus-form-row-subscribe">
                                <input type="hidden" name="successRedirectUrl" value="">
                                <input type="submit" class="white-solid-blue-btn min-width-250" value="SIGN UP">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>--}}
@endsection
