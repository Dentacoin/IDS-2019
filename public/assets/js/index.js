basic.init();

//overwrite dynamic social menu from dentacoin.com
if($('a[href="mailto:admin@dentacoin.com"]').length) {
    $('a[href="mailto:admin@dentacoin.com"]').attr('href', 'mailto:business@dentacoin.com');
}

$(document).ready(function() {
    /*if($('.clock').length) {
        var clock;
        var endDate = new Date('2021-04-01').getTime();
        var now_timestamp = new Date().getTime();
        var time_left = Math.round((endDate - now_timestamp) / 1000);
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
    }*/
});

$(window).on('load', function() {
    scrollToSection();
});

$(window).on('resize', function(){

});

$(window).on('scroll', function()  {
    loadDeferImages();
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

    if ($('#append-big-hub-ids').length) {
        var bigHubParams = {
            'element_id_to_append' : 'append-big-hub-ids',
            'type_hub' : 'ids'
        };

        dcnHub.initBigHub(bigHubParams);
    }
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
            $("html, body").animate({scrollTop: $(this).offset().top - $('header').outerHeight()}, 300);
            return false;
        }
    })
}

$('body').on('hsvalidatedsubmit', '.hs-form', function (e) {
    ga('send', {
        hitType: 'event',
        eventCategory: 'Form',
        eventAction: 'Submit',
        eventAction: 'Inquiry',
    });
});

function loadDeferImages() {
    for(var i = 0, len = jQuery('[data-defer-src]').length; i < len; i+=1) {
        if(basic.isInViewport(jQuery('[data-defer-src]').eq(i)) && jQuery('[data-defer-src]').eq(i).attr('src') == undefined) {
            jQuery('[data-defer-src]').eq(i).attr('src', jQuery('[data-defer-src]').eq(i).attr('data-defer-src'));
        }
    }
}
loadDeferImages();

if (typeof(dcnCookie) != undefined) {
    dcnCookie.init({
        'google_app_id' : 'UA-97167262-4'
    });
}

if ($('.newsletter-register').length) {
    // remove this function, because its already part of basic.js
    function initCustomCheckboxes(parent, type) {
        if (typeof(parent) == undefined) {
            parent = '';
        } else {
            parent = parent + ' ';
        }

        if (type == undefined) {
            type = 'prepend';
        }

        for (var i = 0, len = jQuery(parent + '.custom-checkbox-style').length; i < len; i+=1) {
            if (!jQuery(parent + '.custom-checkbox-style').eq(i).hasClass('already-custom-style')) {
                if (jQuery(parent + '.custom-checkbox-style').eq(i).find('input[type="checkbox"]').is(':checked')) {
                    if (type == 'prepend') {
                        jQuery(parent + '.custom-checkbox-style').eq(i).prepend('<label for="'+jQuery(parent + '.custom-checkbox-style').eq(i).find('input[type="checkbox"]').attr('id')+'" class="custom-checkbox">✓</label>');
                    } else if (type == 'append') {
                        jQuery(parent + '.custom-checkbox-style').eq(i).append('<label for="'+jQuery(parent + '.custom-checkbox-style').eq(i).find('input[type="checkbox"]').attr('id')+'" class="custom-checkbox">✓</label>');
                    }
                } else {
                    jQuery(parent + '.custom-checkbox-style').eq(i).prepend('<label for="'+jQuery(parent + '.custom-checkbox-style').eq(i).find('input[type="checkbox"]').attr('id')+'" class="custom-checkbox"></label>');
                }
                jQuery(parent + '.custom-checkbox-style').eq(i).addClass('already-custom-style');
            }
        }

        jQuery(parent + '.custom-checkbox-style .custom-checkbox-input').unbind('change').on('change', function() {
            if (!jQuery(this).closest('.custom-checkbox-style').hasClass('predefined')) {
                if (jQuery(this).is(':checked')) {
                    jQuery(this).closest(parent + '.custom-checkbox-style').find('.custom-checkbox').html('✓');
                } else {
                    jQuery(this).closest(parent + '.custom-checkbox-style').find('.custom-checkbox').html('');
                }

                if (jQuery(this).attr('data-radio-group') != undefined) {
                    for (var i = 0, len = jQuery('[data-radio-group="'+jQuery(this).attr('data-radio-group')+'"]').length; i < len; i+=1) {
                        if (!jQuery(this).is(jQuery('[data-radio-group="'+jQuery(this).attr('data-radio-group')+'"]').eq(i))) {
                            jQuery('[data-radio-group="'+jQuery(this).attr('data-radio-group')+'"]').eq(i).prop('checked', false);
                            jQuery('[data-radio-group="'+jQuery(this).attr('data-radio-group')+'"]').eq(i).closest(parent + '.custom-checkbox-style').find('.custom-checkbox').html('');
                        }
                    }
                }
            }
        });
    }

    initCustomCheckboxes('.newsletter-register');
    //basic.initCustomCheckboxes('.newsletter-register');

    $('.newsletter-register form').on('submit', function (event) {
        event.preventDefault();
        var this_form_native = this;
        var this_form = $(this_form_native);

        var error = false;
        this_form.find('.error-handle').remove();

        if (!basic.validateEmail(this_form.find('input[type="email"]').val().trim())) {
            error = true;
            customErrorHandle(this_form.find('input[type="email"]').closest('.newsletter-field'), this_form.find('input[type="email"]').closest('.newsletter-field').attr('data-valid-message'));
        }

        if (!this_form.find('#newsletter-privacy-policy').is(':checked')) {
            error = true;
            customErrorHandle(this_form.find('#newsletter-privacy-policy').closest('.newsletter-field'), this_form.find('#newsletter-privacy-policy').closest('.newsletter-field').attr('data-valid-message'));
        }

        if (!error) {
            this_form_native.submit();

            $('.newsletter-register form .custom-checkbox').html('');
            $('.newsletter-register form #newsletter-privacy-policy').prop('checked', false);
            this_form.find('input[type="email"]').val('');
            $('.newsletter-register .form-container').append('<div class="alert alert-success fs-16 margin-top-10">Thank you for signing up.</div>');
        }
    });
}

function customErrorHandle(el, string) {
    el.append('<div class="error-handle">'+string+'</div>');
}