basic.init();

//overwrite dynamic social menu from dentacoin.com
if($('a[href="mailto:admin@dentacoin.com"]').length) {
    $('a[href="mailto:admin@dentacoin.com"]').attr('href', 'mailto:business@dentacoin.com');
}

$(document).ready(function() {
    if($('.clock').length) {
        var clock;
        var time_left = 61695868;
        if(time_left > 0) {
            clock = $('.clock').FlipClock(time_left, {
                clockFace: 'DailyCounter',
                autoStart: false,
                showSeconds: false,
            });

            clock.setCountdown(true);
            clock.start();

            if($('body').hasClass('german')) {
                $('.flip-clock-divider.days .flip-clock-label').html('TAGEN');
                $('.flip-clock-divider.hours .flip-clock-label').html('STUNDEN');
                $('.flip-clock-divider.minutes .flip-clock-label').html('MINUTEN');
            }
        }else {
            $('.timer').hide();
        }
    }
});

$(window).on('load', function() {
    scrollToSection();
});

$(window).on('resize', function(){

});

$(window).on('scroll', function()  {

});

//on button click next time when you hover the button the color is bugged until you click some other element (until you move out the focus from this button)
function fixButtonsFocus() {
    if($('.white-solid-blue-btn').length > 0) {
        $('.white-solid-blue-btn').click(function() {
            $(this).blur();
        });
    }
    if($('.solid-blue-white-btn').length > 0) {
        $('.solid-blue-white-btn').click(function() {
            $(this).blur();
        });
    }
}
fixButtonsFocus();

function generateUrl(str)  {
    var str_arr = str.split("");
    var cyr = [
        'Ð°','Ð±','Ð²','Ð³','Ð´','Ðµ','Ñ‘','Ð¶','Ð·','Ð¸','Ð¹','Ðº','Ð»','Ð¼','Ð½','Ð¾','Ð¿',
        'Ñ€','Ñ','Ñ‚','Ñƒ','Ñ„','Ñ…','Ñ†','Ñ‡','Ñˆ','Ñ‰','ÑŠ','Ñ‹','ÑŒ','Ñ','ÑŽ','Ñ',
        'Ð','Ð‘','Ð’','Ð“','Ð”','Ð•','Ð','Ð–','Ð—','Ð˜','Ð™','Ðš','Ð›','Ðœ','Ð','Ðž','ÐŸ',
        'Ð ','Ð¡','Ð¢','Ð£','Ð¤','Ð¥','Ð¦','Ð§','Ð¨','Ð©','Ðª','Ð«','Ð¬','Ð­','Ð®','Ð¯',' '
    ];
    var lat = [
        'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
        'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
        'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
        'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya','-'
    ];
    for(var i = 0; i < str_arr.length; i+=1)  {
        for(var y = 0; y < cyr.length; y+=1)    {
            if(str_arr[i] == cyr[y])    {
                str_arr[i] = lat[y];
            }
        }
    }
    return str_arr.join("").toLowerCase();
}

function checkIfCookie()    {
    if($('.privacy-policy-cookie').length > 0)  {
        $('.privacy-policy-cookie .accept').click(function()    {
            basic.cookies.set('privacy_policy', 1);
            $('.privacy-policy-cookie').hide();
        });
    }
}

function bindCaptchaRefreshEvent()  {
//refreshing captcha on trying to log in admin
    if($('.refresh-captcha').length > 0)    {
        $('.refresh-captcha').click(function()  {
            $.ajax({
                type: 'GET',
                url: '/refresh-captcha',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('.captcha-container span').html(response.captcha);
                }
            });
        });
    }
} 
bindCaptchaRefreshEvent();

// ================== PAGES ==================
if($('body').hasClass('home')) {
    if($('.top-homepage-slider-section .slider').length) {
        $('.top-homepage-slider-section .slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            arrows: false,
            autoplaySpeed: 10000,
            dots: true,
            adaptiveHeight: true
        });
    }

    if($('.highlights-section .slider').length) {
        $('.highlights-section .slider').slick({
            slidesToShow: 2,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 10000,
            dots: false,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }

    if($('.gallery-section .slider').length) {
        $('.gallery-section .slider').slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 10000,
            arrows: false,
            dots: true,
            infinite: false,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }

    if($('.team-members-section .slider').length) {
        $('.team-members-section .slider').slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 8000,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: false
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false
                    }
                }
            ]
        });
    }

    if($('.testimonials-slider-section').length) {
        $('.testimonials-slider-section').slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 10000,
            dots: true,
            infinite: false,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: false
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false
                    }
                }
            ]
        });
    }

    if(!basic.isMobile()) {
        $('.testimonials-slider-section').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var height = 0;
            for (var i = 0, len = 4; i < len; i+=1) {
                if($('.testimonials-slider-section .slick-slide').eq(nextSlide + i).height() > height) {
                    height = $('.testimonials-slider-section .slick-slide').eq(nextSlide + i).height();
                }
            }
            $('.testimonials-slider-section .slick-list').animate({height: height + 30}, 500);
        });
    }

    //logic for open application popup
    $('.single-application').click(function()   {
        var this_btn = $(this).find('.wrapper');
        var extra_html = '';
        var media_html = '';
        if(this_btn.attr('data-articles') != undefined)    {
            extra_html+='<div class="extra-html"><div class="extra-title">Latest Blog articles:</div><ul>';
            var articles_arr = $.parseJSON(this_btn.attr('data-articles'));
            for(var i = 0, len = articles_arr.length; i < len; i+=1)    {
                extra_html+='<li class="link"><a href="https://blog.dentacoin.com/'+articles_arr[i]['post_name']+'" target="_blank">'+articles_arr[i]['post_title']+'</a></li>';
            }
            extra_html+='</ul><div class="see-all"><a href="https://blog.dentacoin.com/" class="white-dark-blue-btn" target="_blank">GO TO ALL</a></div></div>';
        }
        var description = this_btn.attr('data-description');
        if(description != '') {
            description = $.parseJSON(description);
        }

        if(['mp4', 'avi'].indexOf(this_btn.attr('data-image-type')) > -1) {
            media_html+='<div itemprop="video" itemscope="" itemtype="http://schema.org/VideoObject" class="col-sm-6 video"><video autoplay loop muted controls="false"><source src="'+this_btn.attr('data-image')+'" type="video/'+this_btn.attr('data-image-type')+'"></video><meta itemprop="name" content="'+this_btn.attr('data-title')+'"><meta itemprop="uploadDate" content="'+this_btn.attr('data-upload-date')+'"></div>';
        }else {
            media_html+='<figure class="col-sm-6 gif"><img src="'+this_btn.attr('data-image')+'?'+new Date().getTime()+'" alt="'+this_btn.attr('data-image-alt')+'"/></figure>';
        }

        var html = '<div class="container-fluid"><div class="row">'+media_html+'<div class="col-sm-6 col-xs-12 content"><figure class="logo"><img src="'+this_btn.attr('data-popup-logo')+'" alt="'+this_btn.attr('data-popup-logo-alt')+'"/></figure><div class="title">'+this_btn.find('figcaption').html()+'</div><div class="description">'+description+'</div>'+extra_html+'</div></div></div>';
        basic.showDialog(html, 'application-popup', this_btn.attr('data-slug'));
        $('.application-popup video').removeAttr('controls');
    });

    /*if($('.schedule-a-meeting-section').length > 0) {
        $('.schedule-a-meeting-section .single').click(function() {
            var this_btn = $(this);
            $('.schedule-a-meeting-section .single').removeClass('active');
            this_btn.addClass('active');
            $('.schedule-a-meeting-section form input[name="date-slug"]').val(this_btn.attr('data-slug'));

            $.ajax({
                type: 'POST',
                url: '/'+$('html').attr('lang')+'/get-meeting-day/' + this_btn.attr('data-slug'),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.success) {
                        $('.schedule-a-meeting-section .form').html(response.success);
                        $('.selectpicker').selectpicker('refresh');
                        bindHourButtonsEvents();
                        bindCaptchaRefreshEvent();
                        bindFormSubmission();
                    }
                }
            });
        });

        function bindFormSubmission() {
            $('form#submit-schedule-a-meeting').on('submit', function(event) {
                var this_form = $(this);
                if(this_form.find('input#website').val().trim() == '' || !basic.validateUrl(this_form.find('input#website').val().trim())) {
                    event.preventDefault();
                    basic.showAlert('Please enter your website URL starting with http:// or https://.', '', true);
                }else if(!$('input#privacy-policy').is(':checked')) {
                    event.preventDefault();
                    basic.showAlert('Please agree with our Privacy policy.', '', true);
                }
            });
        }
        bindFormSubmission();

        function bindHourButtonsEvents() {
            $('.schedule-a-meeting-section .form .hours .solid-blue-white-btn').click(function() {
                if(!$(this).hasClass('disabled')) {
                    $('.schedule-a-meeting-section .form .hours .solid-blue-white-btn').removeClass('active');
                    $(this).addClass('active');
                    $('.schedule-a-meeting-section form input[name="hour"]').val($(this).attr('data-hour'));
                }
            });
        }
        bindHourButtonsEvents();
    }*/
}

//scroll to sections events
function initScrollingToEvents() {
    if($('.scrolling-to-section').length > 0 && $('body').hasClass('home')) {
        $('.scrolling-to-section').click(function() {
            $(this).blur();
            window.history.pushState($(this).find('span').html(), '', '/#'+$(this).attr('id'));
            $("html, body").animate({scrollTop: $('[data-scroll-here="'+$(this).attr('id')+'"]').offset().top - $('header').outerHeight()}, 300);
            return false;
        });
    }
}
initScrollingToEvents();

//on page load if we have #parameter in the URL scroll down to section
function scrollToSection(){
    $('[data-scroll-here]').each(function(){
        if(window.location.href.indexOf('/#' + $(this).attr('data-scroll-here')) != -1){
            $("html, body").animate({scrollTop: $(this).offset().top - $('header').outerHeight()}, 300);
            return false;
        }
    })
}

function initMobileMenuActions()    {
    if(basic.isMobile)    {
        $('header .mobile-ham a').click(function()   {
            $('.mobile-nav').addClass('active');
        });

        $('.mobile-nav .close-btn, .mobile-nav nav ul li a').click(function()   {
            $('.mobile-nav').removeClass('active');
        });
    }
}
initMobileMenuActions();

//external generated form
if($('.show-send-an-inquiry-button').length > 0) {
    $('.show-send-an-inquiry-button').click(function() {
        $('.custom-popup.send-an-inquiry').addClass('visible');
        $('body').addClass('overflow-hidden');
    });

    $('.custom-popup.send-an-inquiry .close-btn').unbind().click(function()    {
        $('.custom-popup.send-an-inquiry').removeClass('visible');
        $('body').removeClass('overflow-hidden');
    });
}

//temporally button ends
if($('.coming-soon').length > 0) {
    $('.coming-soon').click(function(event) {
        event.preventDefault();
        alert('Coming soon!');
    });
}

//bind hide custom popup event on black shadow click
$('body').click(function(event) {
    if($(event.target).is('.custom-popup')) {  
        $('.custom-popup').removeClass('visible');
        $('body').removeClass('overflow-hidden');
    }
});

//header menu events
$('header .mobile-ham').click(function()    {
    $('nav.sidenav').addClass('active');

    setTimeout(function() {
        $('nav.sidenav').removeClass('active');
    }, 5000);
});

$('nav.sidenav .close-btn, nav.sidenav ul li a').click(function()    {
    $('nav.sidenav').removeClass('active');
});

//scroll to sections events
function initScrollingToEvents() {
    if($('.scrolling-to-section').length > 0 && $('body').hasClass('home')) {
        $('.scrolling-to-section').click(function() {
            $(this).blur();
            window.history.pushState($(this).find('span').html(), '', '/#'+$(this).attr('id'));
            $("html, body").animate({scrollTop: $('[data-scroll-here="'+$(this).attr('id')+'"]').offset().top - $('header').outerHeight()}, 300);
            return false;
        });
    }
}
initScrollingToEvents();

//on page load if we have #parameter in the URL scroll down to section
function scrollToSection(){
    $('[data-scroll-here]').each(function(){
        if(window.location.href.includes('#' + $(this).attr('data-scroll-here'))){
            console.log($(this).attr('data-scroll-here'));
            $("html, body").animate({scrollTop: $(this).offset().top - $('header').outerHeight()}, 300);
            return false;
        }
    })
}