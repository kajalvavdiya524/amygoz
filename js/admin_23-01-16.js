$(document).ready(function(){

    $('.admin-container').on('submit', '.block-form', function() {
        var element = $(this);
        element.children('button').addClass('disabled');
        $(this).ajaxSubmit({
            success:function(data) {
                if(data == 'blocked') {
                    element.children('button').removeClass('disabled').text('Unblock');
                    element.children('input').attr('name', 'unblock');
                    element.siblings('.label-success').show().delay(1500).hide(0);

                } else if (data == 'unblocked') {
                    element.children('button').removeClass('disabled').text('Block');
                    element.children('input').attr('name', 'block');
                    element.siblings('.label-success').show().delay(1500).hide(0);
                }
            }
        }); 
        return false;
    });
    
    $('.edit-form-btn').colorbox({
        onComplete:function() {
            setup_validation();
        }
    });
    
    $('.admin-container').on('submit', '.privilege-form', function() {
        alert(1);
        var element = $(this);
        element.children('button').addClass('disabled');
        $(this).ajaxSubmit({
            success:function(data) {
                if(data == 'added') {
                    element.children('button').removeClass('disabled').text('Remove Admin');
                    element.children('input').attr('name', 'remove');
                    element.siblings('.label-success').show().delay(1500).hide(0);

                } else if (data == 'removed') {
                    element.children('button').removeClass('disabled').text('Make Admin');
                    element.children('input').attr('name', 'add');
                    element.siblings('.label-success').show().delay(1500).hide(0);
                }
            }
        }); 
        return false;
    });
    
    $('.admin-container').on('submit', '.reminder-form', function() {
        var element = $(this);
        element.children('button').addClass('disabled');
        $(this).ajaxSubmit({
            success:function(data) {
                element.children('button').removeClass('disabled');
                element.siblings('strong').text(data);
                element.parent().siblings('.label-success').show().delay(1500).hide(0);
            }
        }); 
        return false;
    });

    $('.admin-container').on('submit', '.approve-form', function() {
        var element = $(this);
        element.children('button').addClass('disabled');
        $(this).ajaxSubmit({
            success:function(data) {
                if(data == 'approved') {
                    element.parents('tr').prev('.content').children('.is_active').text('True');
                    element.parent().siblings('.label-success').show().delay(1500).hide(0);
                }
                element.parents('span').remove();
            }
        }); 
        return false;
    });
    

    $('.admin-container').on('submit', '.feature_date_form', function() {
        var element = $(this);
        element.children('button').addClass('disabled');
        $(this).ajaxSubmit({
            success:function(data) {
                var pop_id = element.attr('id');
                var original_button = $('tr.operation #'+pop_id).parent().siblings('button.admin-feature-id');

                if(data != 'error') {
                   
                    element.children('button').removeClass('disabled');
                    original_button.popover('hide');
                    
                    original_button.siblings('.label-success').show().delay(1500).hide(0);
                } else {
                    original_button.siblings('.label-important').show().delay(1500).hide(0);
                }
                window.location.reload();
            }
        }); 
        return false;
    });
    
    $('body').on('submit', '.edit-form', function() {
        var element = $(this);
        element.find('button').addClass('disabled');
        $(this).ajaxSubmit({
            success:function(data) {
                var original_button = $.colorbox.element();

                if(data != 'error') {
                   
                    element.find('button').removeClass('disabled');
                    original_button.siblings('.label-success').show().delay(10000).hide(0);
                    $.colorbox.close()
                } else {
                    original_button.siblings('.label-important').show().delay(10000).hide(0);
                }
            }
        }); 
        return false;
    });
    
    if(($('#page_name').length > 0) && $('#page_name').val() == 'members') {
        DoubleScroll(document.getElementById('scroll'));
        var last_call = '';
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() == $(document).height()) {
                var url = window.location;
                
                if( !($('.page_footer').children('h4').length > 0) &&  $('.user_id').last().length > 0) {

                    var last_id = $('.user_id').last().val();
                    var post_data = "id="+last_id;
                    if (last_id != last_call) {

                        $('#loading').show();
                        last_call = last_id;
                        $.ajax({
                            type: "post",
                            url: url,
                            data: post_data,
                            success: function (data) {
                                if($.trim(data) != '') {
                                    $('tbody').append(data);
                                    $('.edit-form-btn').colorbox();
                                } else {
                                    $('.page_footer').html('<h4>No More Members</h4>');
                                }
                                
                                $('#loading').hide();
                            }
                        });
                    }
                }
            }
        });
    } else if(($('#page_name').length > 0) && $('#page_name').val() == 'current_users') {
        var url = window.location;
        setInterval(function(){
            $.ajax({
                type: "post",
                url: url,
                data: "",
                success: function (data) {
                    if(data != '') {
                        $('tbody').html(data);
                    }
                }
            });
        }, 10000);
    }

});
function DoubleScroll(element) {
    var scrollbar= document.createElement('div');
    scrollbar.appendChild(document.createElement('div'));
    scrollbar.style.overflow= 'auto';
    scrollbar.style.overflowY= 'hidden';
    scrollbar.style.height= '20px';
    scrollbar.style.position= 'fixed';
    scrollbar.style.top= '70px';
    scrollbar.style.width = element.offsetWidth+'px';
    scrollbar.firstChild.style.width= element.scrollWidth+'px';
    scrollbar.firstChild.appendChild(document.createTextNode('\xA0'));
    scrollbar.onscroll= function() {
        element.scrollLeft= scrollbar.scrollLeft;
    };
    element.onscroll= function() {
        scrollbar.scrollLeft= element.scrollLeft;
    };
    element.parentNode.insertBefore(scrollbar, element);
}

function popover_content(elem) {
    return elem.siblings('div').html();
}

function setup_validation() {
    // for unique email validation in add user part
    
    $.validator.addMethod("uniqueEmail", function(value, element) {
        var base_url = $('#base_url').val();
        var user_id = $.colorbox.element().attr('id');
        var response;
        $.ajax({
            type: "POST",
            url: base_url+'admin/unique_email',
            async: false,
            data: "email="+value+"&user_id="+user_id,
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
        var user_id = $.colorbox.element().attr('id');
        var response;
        
        ajaxcall = $.ajax({
            type: "POST",
            url: base_url+'admin/unique_username',
            async: false,
            data: "username="+value+"&user_id="+user_id,
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
        errorClass:'error',
        validClass:'success',
        errorElement:'span',
        highlight: function (element, errorClass, validClass) { 
            $(element).parents("div.control-group").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function (element, errorClass, validClass) { 
            $(element).parents(".error").removeClass(errorClass).addClass(validClass); 
        },
        errorPlacement: function(error, element) {
            error.addClass('help-inline');
            if (element.attr("name") == "month" || element.attr("name") == "day" || element.attr("name") == "year") 
                error.insertAfter("#yearOfBirth");
            else 
                error.insertAfter(element);
        }
    });
}