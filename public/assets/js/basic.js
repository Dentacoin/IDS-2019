var basic = {
    options: {
        alert: null
    },
    init: function(opt) {
        //basic.addCsrfTokenToAllAjax();
        //basic.stopMaliciousInspect();
    },
    cookies: {
        set: function(name, value) {
            if(name == undefined){
                name = "cookieLaw";
            }
            if(value == undefined){
                value = 1;
            }
            var d = new Date();
            d.setTime(d.getTime() + (10*24*60*60*1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = name + "=" + value + "; " + expires + ";path=/";
            if(name == "cookieLaw"){
                $(".cookies_popup").slideUp();
            }
        },
        erase: function(name) {
            document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        },
        get: function(name) {
            if(name == undefined){
                var name = "cookieLaw";
            }
            name = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0; i<ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1);
                if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
            }
            return "";
        }
    },
    fixPlaceholders: function() {
        $("input[data-placeholder]").each(function(){
            if($(this).data("placeholders-fixed") == undefined){
                $(this).data("placeholders-fixed", true);

                basic.setInputsPlaceholder($(this));

                $focus_function = "if($(this).val()=='" + $(this).data("placeholder") + "'){ $(this).val(''); }";
                if ($(this).attr("onkeydown") != undefined) {
                    $focus_function = $(this).attr("onkeydown") + "; " + $focus_function;
                }
                $(this).attr("onkeydown", $focus_function);

                $blur_function = "if($(this).val()==''){ $(this).val('" + $(this).data("placeholder") + "'); }";
                if ($(this).attr("onblur") != undefined) {
                    $blur_function = $(this).attr("onblur") + "; " + $blur_function;
                }
                $(this).attr("onblur", $blur_function);
            }
        });
    },
    clearPlaceholders: function(extra_filter) {
        if(extra_filter == undefined){
            extra_filter = "";
        }
        $("input[data-placeholder]" + extra_filter).each(function(){
            if($(this).val() == $(this).data("placeholder")){
                $(this).val('');
            }
        })
    },
    setPlaceholders: function(){
        $("input[data-placeholder]").each(function(){
            basic.setInputsPlaceholder($(this));
        });
    },
    setInputsPlaceholder: function(input){
        if($(input).val()==""){
            $(input).val($(input).data("placeholder"));
        }
    },
    fixBodyModal: function() {
        if($(".modal-dialog").length>0 && !$("body").hasClass('modal-open')){
            $("body").addClass('modal-open');
        }
    },
    fixZIndexBackdrop: function() {
        if(jQuery('.bootbox').length > 1) {
            var last_z = jQuery('.bootbox').eq(jQuery('.bootbox').length - 2).css("z-index");
            jQuery('.bootbox').last().css({'z-index': last_z+2}).next('.modal-backdrop').css({'z-index': last_z+1});
        }
    },
    showAlert: function(message, class_name, vertical_center) {
        basic.realShowDialog(message, "alert", class_name, null, null, vertical_center);
    },
    showConfirm: function(message, class_name, params, vertical_center) {
        basic.realShowDialog(message, "confirm", class_name, params, null, vertical_center);
    },
    showDialog: function(message, class_name, type, vertical_center) {
        if(type === undefined){
            type = null;
        }
        basic.realShowDialog(message, "dialog", class_name, null, type, vertical_center);
    },
    realShowDialog: function(message, dialog_type, class_name, params, type, vertical_center) {
        if(class_name === undefined){
            class_name = "";
        }
        if(type === undefined){
            type = null;
        }
        if(vertical_center === undefined){
            vertical_center = null;
        }

        var atrs = {
            "message": message,
            "animate": false,
            "show": false,
            "className": class_name
        };

        if(dialog_type == "confirm" && params!=undefined && params.buttons == undefined){
            atrs.buttons = {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            }
        }
        if(params != undefined){
            for (var key in params) {
                atrs[key] = params[key];
            }
        }

        var dialog = eval("bootbox." + dialog_type)(atrs);
        dialog.on('hidden.bs.modal', function(){
            basic.fixBodyModal();
            if(type != null)    {
                $('.single-application figure[data-slug="'+type+'"]').parent().focus();
            }
        });
        dialog.on('shown.bs.modal', function(){
            if(vertical_center != null) {
                basic.verticalAlignModal();
            }
            basic.fixZIndexBackdrop();
        });
        dialog.modal('show');
    },
    verticalAlignModal: function(message) {
        $("body .modal-dialog").each(function(){
            $(this).css("margin-top", Math.max(20, ($(window).height() - $(this).height()) / 2));
        })
    },
    closeDialog: function (){
        bootbox.hideAll();
    },
    request: {
        initialize: false,
        result: null,
        submit: function (url, data, options, callback, curtain) {
            options = $.extend({
                type: 'POST',
                dataType: 'json',
                async: true
            }, options);
            if (basic.request.initialize && options.async == false) {
                console.log(['Please wait for parent request']);
            }
            else {
                basic.request.initialize = true;
                return $.ajax({
                    url: url,
                    data: data,
                    type: options.type,
                    dataType: options.dataType,
                    async: options.async,
                    beforeSend: function() {
                        if (curtain !== null) {
                            basic.addCurtain();
                        }
                    },
                    success: function (response) {
                        basic.request.result = response;
                        if (curtain !== null) {
                            basic.removeCurtain();
                        }
                        basic.request.initialize = false;
                        if (typeof callback === 'function') {
                            callback(response);
                        }
                    },
                    error: function(){
                        basic.request.initialize = false;
                    }
                });
            }
        },
        validate: function(form, callback, data){
            //if data is passed skip clearing all placeholders and removing messages. it's done inside the calling function
            if(data == undefined) {
                basic.clearPlaceholders();
                $(".input-error-message").remove();
                data = form.serialize();
            }
            return basic.request.submit(SITE_URL+"validate/", data, {async: false}, function(res){
                if (typeof callback === 'function') {
                    callback();
                }
            },  null);
        },
        markValidationErrors: function(validation_result, form){
            basic.setPlaceholders();
            if (typeof validation_result.all_errors == "undefined") {
                if (typeof validation_result.message != "undefined") {
                    basic.showAlert(validation_result.message);
                    return true;
                }
            } else {
                var all_errors = JSON.parse(validation_result.all_errors);
                for (var param_name in all_errors) {
                    //if there is error, but no name for it, pop it in alert
                    if(Object.keys(all_errors).length == 1 && $('[name="'+param_name+'"]').length == 0) {
                        basic.showAlert(all_errors[param_name]);
                        return false;
                    }

                    if(form == undefined){
                        var input = $('[name="'+param_name+'"]');
                    }else{
                        var input = form.find('[name="'+param_name+'"]');
                    }
                    basic.request.removeValidationErrors(input);
                    if (input.closest('.input-error-message-holder')) {
                        input.closest('.input-error-message-holder').append('<div class="input-error-message">'+all_errors[param_name]+'</div>');
                    } else {
                        input.after('<div class="input-error-message">'+all_errors[param_name]+'</div>');
                    }
                    //basic.setInputsPlaceholder(input);
                }
            }
        },
        removeValidationErrors: function(input){
            input.closest('.input-error-message-holder').find(".input-error-message").remove();
            input.parent().remove(".input-error-message");
        }
    },
    alert: function(message) {
        basic.options.alert(message);
    },
    addCurtain: function(){
        $("body").prepend('<div class="curtain"></div>');
    },
    removeCurtain: function(){
        $("body .curtain").remove();
    },
    validateEmail: function(email)   {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    },
    validateUrl: function(url)   {
        return /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.test(url);
    },
    isInViewport: function(el) {
        var elementTop = $(el).offset().top;
        var elementBottom = elementTop + $(el).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
    },
    isMobile: function() {
        var isMobile = false; //initiate as false
// device detection
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
            || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4)))  {
            isMobile = true;
        }
        return isMobile;
    },
    addCsrfTokenToAllAjax: function ()    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    },
    stopMaliciousInspect: function()  {
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        document.onkeydown = function(e) {
            if(event.keyCode == 123) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
        }
    }
};