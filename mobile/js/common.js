$(document).ready(function() {

    $(".dis-block").width($(".about-user").innerWidth());
    $("#inset").width($(".user-pro-pic").innerWidth());
    $("body").css('padding-top',$("header").innerHeight());
    
    // for unique email validation in add user part
    var base_url = $('#base_url').val();

    var timer;
    var timeout = 500;

    $('.check_un_avail').keyup(function(){
        var elem = $(this);
        clearTimeout(timer);
        timer = setTimeout(function(){
            elem.valid();
        }, timeout);
    });

    if($('.alert-danger').length > 0 && $('.alert-danger').children('strong').length > 0) {
        $('.alert-danger').children('strong').remove();
        $('.alert-danger').prepend('<span class="glyphicon glyphicon-remove"></span>');
    }
    
    if($('.alert-success').length > 0 && $('.alert-success').children('strong').length > 0) {
        $('.alert-success').children('strong').remove();
        $('.alert-success').prepend('<span class="glyphicon glyphicon-ok"></span>');
    }

    $("#selectall").click(function(){
        $('.contacts-chkbox:checkbox').prop('checked', this.checked);
    });

    $.validator.addMethod("uniqueEmail", function(value, element) {
        var base_url = $('#base_url').val();
        var response;
        $.ajax({
            type: "POST",
            url: base_url+'pages/unique_email',
            async: false,
            data: "email="+value,
            success: function(msg) {
              //If email exists, set response to true
              response = ( msg == '0' ) ? true : false;
            }
        });
        return response;
    }, "Email Id already exists");
    
    // for unique email validation in add user part
    $.validator.addMethod("uniqueUsername", function(value, element) {
        var base_url = $('#base_url').val();
        var response;
        
        ajaxcall = $.ajax({
            type: "POST",
            url: base_url+'profile/unique_username',
            async: false,
            data: "username="+value,
            success: function(msg) {
              //If email exists, set response to true
              response = ( msg == '0' ) ? true : false;
            }
        });
        return response;
   
    }, "Username already taken");
    
    $.validator.addMethod("usernameRegex", function(value, element) {
        return this.optional(element) || /^[a-z0-9\-\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or dashes.");
    
    $(".validate-form").validate({
        rules: {
            field: {
                required: true,
                email: true
            },
            field: {
                required:true,
                digits:true
            },
            field: {
                required: true,
                number: true
            },
            password_confirm: {
                equalTo: "#password"
            },
            answer: {
                equalTo: "#total"
            },
            field: {
                required: true,
                email: true,
                uniqueEmail: true,
            },
            field: {
                required: true,
                uniqueUsername: true,
                usernameRegex: true,
            },
            first_name: {
                maxlength: 20
            },
            month: { required: true },
            day: { required: true },
            year: { required: true },
        },
        messages: {
            answer: {
                equalTo: "Entered value is not correct as per the equation."
            }
        },
        groups: {
            dateofbirth: "month day year"
        },
        onkeyup:false,
        errorClass:'has-error',
        validClass:'has-success',
        errorElement:'span',
        highlight: function (element, errorClass, validClass) { 
            $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function (element, errorClass, validClass) { 
            $(element).parents(".has-error").removeClass(errorClass).addClass(validClass);
            $(element).tooltip('destroy');
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "month" || element.attr("name") == "day" || element.attr("name") == "year") {
                var error_msg = error.text();
                $(element).tooltip('destroy');
                $('#yearOfBirth').tooltip({
                    title: error_msg,
                    placement:'right',
                    trigger: 'manual',
                });
                $('#yearOfBirth').tooltip('show');
            } else {
                var error_msg = error.text();
                $(element).tooltip('destroy');
                element.tooltip({
                    title: error_msg,
                    placement:'right',
                    trigger: 'manual',
                });
                element.tooltip('show');
            }
        }
    });
    
    $(".validate-form2").validate({
        rules: {
            field: {
                required: true,
                email: true
            },
        },
        onkeyup:false,
        errorClass:'has-error',
        validClass:'has-success',
        errorElement:'span',
        highlight: function (element, errorClass, validClass) { 
            $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function (element, errorClass, validClass) { 
            $(element).parents(".has-error").removeClass(errorClass).addClass(validClass);
            $(element).tooltip('destroy');
        },
        errorPlacement: function(error, element) {
            var error_msg = error.text();
            $(element).tooltip('destroy');
            element.tooltip({
                title: error_msg,
                placement:'right',
                trigger: 'manual',
            });
            element.tooltip('show');
        }
    });
    
    $(".validate-form3").validate({
        rules: {
            field: {
                required: true,
                email: true
            },
        },
        onkeyup:false,
        errorClass:'has-error',
        validClass:'has-success',
        errorElement:'span',
        highlight: function (element, errorClass, validClass) { 
            $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function (element, errorClass, validClass) { 
            $(element).parents(".has-error").removeClass(errorClass).addClass(validClass);
            $(element).tooltip('destroy');
        },
        errorPlacement: function(error, element) {
            var error_msg = error.text();
            $(element).tooltip('destroy');
            element.tooltip({
                title: error_msg,
                placement:'right',
                trigger: 'manual',
            });
            element.tooltip('show');
        }
    });
    
    $(".validate-form4").validate({
        rules: {
            field: {
                required: true,
                email: true
            },
        },
        onkeyup:false,
        errorClass:'has-error',
        validClass:'has-success',
        errorElement:'span',
        highlight: function (element, errorClass, validClass) { 
            $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function (element, errorClass, validClass) { 
            $(element).parents(".has-error").removeClass(errorClass).addClass(validClass);
            $(element).tooltip('destroy');
        },
        errorPlacement: function(error, element) {
            var error_msg = error.text();
            $(element).tooltip('destroy');
            element.tooltip({
                title: error_msg,
                placement:'right',
                trigger: 'manual',
            });
            element.tooltip('show');
        }
    });
    
    $(".validate-form5").validate({
        rules: {
            field: {
                required: true,
                email: true
            },
        },
        onkeyup:false,
        errorClass:'has-error',
        validClass:'has-success',
        errorElement:'span',
        highlight: function (element, errorClass, validClass) { 
            $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function (element, errorClass, validClass) { 
            $(element).parents(".has-error").removeClass(errorClass).addClass(validClass);
            $(element).tooltip('destroy');
        },
        errorPlacement: function(error, element) {
            var error_msg = error.text();
            $(element).tooltip('destroy');
            element.tooltip({
                title: error_msg,
                placement:'right',
                trigger: 'manual',
            });
            element.tooltip('show');
        }
    });
    
    $(".navbar-form").validate({
        rules: {
            field: {
                required: true,
                email: true
            }
        },
        onkeyup:false,
        errorClass:'has-error',
        validClass:'has-success',
        errorElement:'span',
        highlight: function (element, errorClass, validClass) { 
            $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function (element, errorClass, validClass) { 
            $(element).parents(".has-error").removeClass(errorClass).addClass(validClass); 
            $(element).tooltip('destroy');
        },
        errorPlacement: function(error, element) {
            var error_msg = error.text();
            $(element).tooltip('destroy');
            element.tooltip({
                title: error_msg,
                placement:'bottom',
                trigger: 'manual',
            });
            element.tooltip('show');
        }
    });
    
    $(".upgrade-block").on('click', '.upgrade_pop', function(){
        var target = $(this).attr('href');
        $.ajax({
            type: 'POST',
            url: target,
            data: '',
            success: function(data) 
            {
                $('#upgrade-modal').find('.modal-body').html(data);

                $('#upgrade-modal').modal({
                    keyboard: false,
                });

                $('#upgrade-modal').on('shown', function () {
                });
                
            }
        });
        return false;
    });
    
    $('#first_name').blur(function() {
        var first_name = $(this).val();
        first_name = first_name.charAt(0).toUpperCase() + first_name.slice(1);
        $(this).val(first_name);
    });

    $('#last_name').blur(function() {
        var last_name = $(this).val();
        last_name = last_name.charAt(0).toUpperCase() + last_name.slice(1);
        $(this).val(last_name);
    });
    
    $('.contact-form').submit(function() {
        if($(this).valid()) {
            $(this).find('button[type=submit]').attr('disabled', 'disabled');
            var elem = $(this);
            $(this).ajaxSubmit({
                success:function(data){
                    if(data == 'done') {
                        elem.find('.alert-success').show();
                        elem.find('.alert-danger').hide();
                    } else {
                        elem.find('.alert-success').hide();
                        elem.find('.alert-danger').show();
                    }
                    elem.find('button[type=submit]').removeAttr('disabled');
                }
            }); 
        }
        return false;
    });

    if($('.style-chkbox').length > 0) {
        $('.style-chkbox').checkbox({
            buttonStyle: 'btn btn-transparent',
            buttonStyleChecked: 'btn btn-secondary',
            checkedClass: 'glyphicon glyphicon-check',
            uncheckedClass: 'glyphicon glyphicon-unchecked'
        });
    }

    $('#searchKeywords').keypress(function(evt) {
        var code = (evt.which ? evt.which : evt.keyCode);
        if (code == 13) {
            $('#searchJob').trigger('click');
        }

    });

    $('#searchJob').click(function() {
        var keywords = $('#searchKeywords').val();

        //keywords to guide where to go.. always in lower case
        var keywordJson = '{\
        "college":"jobThreeBox",\
        "representative":"jobThreeBox",\
        "php":"jobTwoBox",\
        "kohana":"jobTwoBox",\
        "android":"jobOneBox",\
        "ios":"jobOneBox",\
        "developer":"jobOneBox"\
        }';

        keywordJson = $.parseJSON(keywordJson);

        if(keywords != '') {
            var locatn = '';
            var keyword = '';

            keywords = keywords.split(' ');
            for(var i=0; i<keywords.length;i++) {
                keyword = keywords[i].toLowerCase();
                if(keywordJson.hasOwnProperty(keyword)) {
                    locatn = '#'+keywordJson[keyword];

                    break;
                }
            }

            if(locatn != '') {
                var pathname = window.location.pathname;
                if(pathname.indexOf('careers/apply') > 0) {
                    window.location.href = base_url+'careers/index'+locatn;
                } else {
                    $("body, html").animate({ 
                        scrollTop: $(locatn).offset().top 
                    }, 600);
                }
            } else {
                alert('Sorry, No matching job found.');
            }
        }
    });
});

$('.card').hover(function(){
    $(this).closest('.card').toggleClass('flipped');

});
