basic.init();
$(document).ready(function() {

});

$(window).on('load', function() {

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
    $('.testimonials-slider-section').slick({
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: true,
        autoplaySpeed: 8000,
        dots: true,
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

    $('.team-members-slider').slick({
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

    $('.testimonials-slider-section').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        var height = 0;
        for (var i = 0, len = 4; i < len; i += 1) {
            if ($('.slick-slide').eq((nextSlide + 4) + i).height() > height) {
                height = $('.slick-slide').eq((nextSlide + 4) + i).height();
            }
        }
        $('.testimonials-slider-section .slick-list').animate({height: height}, 500);
    });

    if($('.schedule-a-meeting-section').length > 0) {
        $('.schedule-a-meeting-section .single').click(function() {
            var this_btn = $(this);
            $('.schedule-a-meeting-section .single').removeClass('active');
            this_btn.addClass('active');
            $('.schedule-a-meeting-section form input[name="date-slug"]').val(this_btn.attr('data-slug'));

            $.ajax({
                type: 'POST',
                url: '/get-meeting-day/' + this_btn.attr('data-slug'),
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
                    }
                }
            });
        });

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