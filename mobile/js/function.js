$(document).click(function(event) {
    if ( !$(event.target).hasClass('search-results')) {
        if($("#search-query"). length > 0) {
            var popover = $("#search-query").data('bs.popover');
            popover.hide();
        }
    }
});

$(document).ready(function() {
    var base_url = $('#base_url').val();

    notification();

    setInterval(function() { notification(); }, 20000);


var isVisible = false;
var clickedAway = false;

    $('.noti-icons').popover({
        html:true,
        trigger:'click',
        placement:'bottom',
        content:'<img src="'+base_url+'img/loader.gif" />'


    });

    $('html').click(function() 
    {
    $('.noti-icons').popover('hide');
        
        });
    

    	$('.noti-icons').click(function() {
        $('.noti-icons').not(this).each(function()
         {
            $(this).data('bs.popover').hide();
        });
        var popover = $(this).data('bs.popover');

        var element = $(this);
        if(!popover.tip().hasClass('complete')) {
            var target = $(this).attr('href');

            $.ajax({
                type: 'POST',
                url: target,
                data: '',
                success: function(data) {
                    popover.options.content = data;
                    popover.tip().addClass('complete');
                    popover.show();
                    

                    if(element.attr('id') != 'message-noti') {
                        $.ajax({
                            type: 'POST',
                            url: target+'?seen=true',
                            data: '',
                            success: function(response) {
                                element.find('.badge').html('');
                            }
                        });
                    }
                }
            });
        } else {
            popover.tip().removeClass('complete');
        }
        return false;
    });
    


    $('#search-query').popover({
        html:true,
        trigger:'manual',
        placement:'bottom',
        content:'<img src="'+base_url+'img/loader.gif" />'
    });
    
    $('#search-query').keyup(function() {
        var popover = $(this).data('bs.popover');
        var query = $(this).val();
        query = $.trim(query);
       
        if(query != '') {
            $.ajax({
                type: 'get',
                url: base_url+"members/search",
                data: 'query='+query,
                success: function(data) 
                {
                   
                    popover.options.content = data;
                    popover.show();
                }
            });
        }
    });
  $('#search-query1').popover({
        html:true,
        trigger:'manual',
        placement:'bottom',
        content:'<img src="'+base_url+'img/loader.gif" />'
    });
    
    $('#search-query1').keyup(function() 
    {
      
         var query = $(this).val();
        query = $.trim(query);
        if(query != '') {
            $.ajax({
                type: 'get',
                url: base_url+"pages/find_user",
                data: 'query='+query,
                success: function(data) 
                {
                    if(data != '') {
                        $('.registered_users').html(data);
                        $('.registered_users').show();
                    } else {
                        $('.registered_users').html('');
                        $('.registered_users').hide();
                    }
                }
            });
        }
    });



    $('.read-more').on('click',function() {
        var collapse_header = $(this).parents('.collapse-header');
        if(collapse_header.parent().hasClass('closed')) {
            collapse_header.parent().removeClass('closed').addClass('open');
        } else {
            collapse_header.parent().removeClass('open').addClass('closed');
        }
        collapse_header.siblings('.collapseable').collapse('toggle');
        collapse_header.find('.collapse-description').collapse('toggle');
    });

    //check email address
    $('.container').on('keyup', '.find_user', function() {
        var query = $(this).val();
        query = $.trim(query);
        if(query != '') {
            $.ajax({
                type: 'get',
                url: base_url+"members/find_user",
                data: 'query='+query,
                success: function(data) 
                {
                    if(data != '') {
                        $('.registered_users').html(data);
                        $('.registered_users').show();
                    } else {
                        
                        $('.registered_users').html('');
                        $('.registered_users').hide();
                        
                    }
                }
            });
        }
        if(query =='')
       {
           $('#message-suggestion').hide();
           $('#message-suggestion1').hide();

       }
    });
    
     
    
    $('#message-suggestion').on('click', '.result', function() {
        var email = $(this).find('.user_email').val();
        
        $('.find_user').val(email);
        $('.find_user').parents('form').validate().element( ".find_user" );
         $('.find_user').focus();
        $('#message-suggestion').hide();


       
    });

 $('.container').on('keyup', '.find_users', function() {
        var query = $(this).val();
        query = $.trim(query);

        if(query != '') {
            $.ajax({
                type: 'get',
                url: base_url+"members/invite_find_user",
                data: 'query='+query,
                
                success: function(data) 
                {
                    if(data != '') {
                        $('.registered_users1').html(data);
                        $('.registered_users1').show();
                    } else {
                        
                        $('.registered_users1').html('');
                        $('.registered_users1').hide();
                        
                    }
                }
            });
        }
        if(query =='')
       {
           $('#message-suggestion1').hide();
       }
    });

    
    $('#message-suggestion1').on('click', '.result', function() {
        var email = $(this).find('.user_email').val();
        
        $('.find_users').val(email);
        $('.find_users').parents('form').validate().element( ".find_users" );
         $('.find_users').focus();
        $('#message-suggestion1').hide();
    });
    $('.recommend-compose-main').on('click', '.result', function() {
        var email = $(this).find('.user_email').val();
        
        $.ajax({
            type: "POST",
            url: base_url+'recommend/compose',
            data: "email="+email,
            success: function(data) {
                $('.main-content').html(data);
            }
        });
    });
    
    $('.recommend-compose-main').on('blur', '#recommend-email', function() {
        var element = $(this);
        if(element.parents('form').validate().element( "#recommend-email" )) {

            if(element.parents('form').find('#edit_recommend').length > 0) {
                var href = base_url+'recommend/compose/'+element.parents('form').find('#edit_recommend').val();
            } else {
                var href = base_url+'recommend/compose';
            }
            
            $.ajax({
                type: "POST",
                url: href,
                data: "email="+element.val(),
                success: function(data) {
                    $('.main-content').html(data);
                }
            });

        }

    });
    
    $('.add-friend-form').submit(function() {
        var element = $(this);
        element.hide();
        $('.friend-loading').show();
        $(this).ajaxSubmit({
            success:function(data) {
                if(data == 'sent') {
                    element.children('button').removeClass('btn-primary add-friend-btn').addClass('btn-primary request-btn').children('.btn-text').text('Friend Request Sent');
                    element.children('button').children('i').removeClass('fa-user-plus').addClass('fa-paper-plane');
                    element.children('input').attr('name', 'del_request');
                } else if(data == 'removed') {
                    element.children('button').removeClass('btn-primary request-btn').addClass('btn-primary add-friend-btn').children('.btn-text').text('Add as a friend');
                    element.children('button').children('i').removeClass('fa-paper-plane').addClass('fa-user-plus');
                    element.children('input').attr('name', 'friend_id');
                }  else if(data == 'deleted') {
                    element.children('button').removeClass('btn-primary friend-btn').addClass('btn-primary add-friend-btn').children('.btn-text').text('Add as a friend');
                    element.children('button').children('i').removeClass('fa-check').addClass('fa-user-plus');
                }
                $('.friend-loading').hide();
                element.show();
            }
        }); 
        return false;
    });

    $('.respond-friend-form').submit(function() {
        var element = $(this);
        $('.friend-loading').show();
        $('.respond-friend-form').hide();
        $(this).ajaxSubmit({
            success:function(data) {
                if(data == 'accepted' || data == 'rejected') {
                    window.location.reload();
                }
            }
        }); 
        return false;
    });

    $('#reply-msg').submit(function() {
        $('.msg-loader').show();
        var element = $(this);
        $(this).ajaxSubmit({
            success:function(data) {

                   //$(".jspContainer").customScrollbar("resize", true);
                                                                                                                                                                                                                                                                                                              
                         $('#reply-msg').before(data);
                         $('.msg-loader').hide();
                         $('#chatContainer').scrollTop($('#chatContainer')[0].scrollHeight).jScrollPane();
                         element[0].reset();
                         $( "#target" ).focus();


            }
        }); 
        return false;
    });


    $('#nav-noti-icons').on('submit', '.respond-friend-popover', function() {
        var element = $(this);
        $(this).ajaxSubmit({
            success:function(data) {
                if(data == 'accepted' || data == 'rejected') {
                    element.parents('.friends_for_noti').html('<p class="text-success">Friend request '+data+'.</p>')
                }
            }
        }); 
        return false;
    });
    
    $('#nav-noti-icons').on('click', '.noti_pop', function(){
        var target = $(this).attr('href');
         $('.noti-icons').popover('hide');
        if(target == '#') {
            return false;
        }
        $.ajax({
            type: 'POST',
            url: target,
            data: '',
            success: function(data) 
            {
                $('#generalModal .modal-body').html(data);
                $('#generalModal').modal({
                    keyboard: false,
                });
                $('#generalModal').on('#generalModal', function () {
                    $('#generalModal .modal-body').stop().animate({ scrollTop: $(".modal-body")[0].scrollHeight }, 1800);
                });
                
            }
        });
        return false;
    });

	$('.activity').on('click', '.noti_pop', function(){
        var target = $(this).attr('href');
        if(target == '#') {
            return false;
        }
        $.ajax({
            type: 'POST',
            url: target,
            data: '',
            success: function(data) 
            {
                $('#generalModal .modal-body').html(data);
                $('#generalModal').modal({
                    keyboard: false,
                });
                $('#generalModal').on('#generalModal', function () {
                    $('#generalModal .modal-body').stop().animate({ scrollTop: $(".modal-body")[0].scrollHeight }, 1800);
                });
                
            }
        });
        return false;
    });
    
    $('.friend-actions').on('mouseover', '.friend-btn', function() {
        $(this).removeClass('btn-secondary').addClass('btn-primary').children('.btn-text').text('Remove Friend');
        $(this).children('.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
    });
    $('.friend-actions').on('mouseout', '.friend-btn', function() {
        $(this).removeClass('btn-primary').addClass('btn-secondary').children('.btn-text').text('Friend');
        $(this).children('.glyphicon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
    });

    $('.friend-actions').on('mouseover', '.request-btn', function() {
        $(this).removeClass('btn-primary').addClass('btn-primary').children('.btn-text').text('Revoke Friend Request');
        $(this).children('.glyphicon').removeClass('glyphicon-send').addClass('glyphicon-ban-circle');
    });
    $('.friend-actions').on('mouseout', '.request-btn', function() {
        $(this).removeClass('btn-primary').addClass('btn-primary').children('.btn-text').text('Friend Request Sent');
        $(this).children('.glyphicon').removeClass('glyphicon-ban-circle').addClass('glyphicon-send');
    });
    
    
    $('.accept-match').click(function() {
        var match_id = $(this).siblings('.match_id').val();
        var elem = $(this);
        $.ajax({
            type: "POST",
            url: base_url+'members/accept_match',
            data: "match="+match_id+"&status=accept",
            success: function(data) {
                if(data == 'accept') {
                    elem.parent('.alert').remove();
                }
            }
        });
    });
    $('.reject-match').click(function() {
        var match_id = $(this).siblings('.match_id').val();
        var elem = $(this);
        $.ajax({
            type: "POST",
            url: base_url+'members/accept_match',
            data: "match="+match_id+"&status=reject",
            success: function(data) {
                if(data == 'reject') {
                    elem.parent('.alert').remove();
                }
            }
        });
    });

    $('.mem_selected').click(function() {
        $(this).parent().submit();
        return false;
    });

    $('.uploadProPic').click(function(event){
        $(this).siblings('.input_pp').trigger('click');
    });
    
    $('.input_pp').change(function() {
        $(this).parent('form').submit();
    });
    
    $('.upload_pp').submit(function() {
        var element = $(this);
        $('.user-pro-pic').find('.user-pro-pic-img').addClass('loading');
        $('.user-pro-pic').children('.image-loader').show();
        $(this).ajaxSubmit({
            success:function(data) {
                data = $.parseJSON(data);
                /* $('.user-pro-pic').children('img').attr('src',base_url+'upload/'+data);
                $('.user-pro-pic').children('.image-loader').hide();
                $('.user-pro-pic').children('img').removeClass('loading'); */
                //window.location.reload();

                $('#editImageModal .div-to-edit').html('');
                
                $('#editImageModal .modal-dialog').css('width', data.width+'px');
                $('#editImageModal .modal-dialog').css('height', data.height+'px');
                $('#editImageModal .modal-header').hide();
                $('#editImageModal .div-to-edit').html($('<img />').attr({ id: 'selectArea', 'src': base_url+'upload/'+data.image }));
                $('input[name="imag_name"]').val(data.image);

                $('#editImageModal').modal({
                    show:true,
                    backdrop:"static",
                    keyboard: false,
                });
                
                $('#editImageModal').on('shown.bs.modal', function () {
                    $('#selectArea').imgAreaSelect({ 
                        aspectRatio: '9:8',
                        handles: true,
                        parent: '#editImageModal',
                        x1: 20,
                        y1: 20,
                        x2: 180,
                        y2: 160,
                        onSelectEnd: function (img, selection) {
                            $('input[name="x1"]').val(selection.x1);
                            $('input[name="y1"]').val(selection.y1);
                            $('input[name="x2"]').val(selection.x2);
                            $('input[name="y2"]').val(selection.y2);
                        }
                    });
                });
            }
        }); 
        return false;
    });

    $('#sidemenu-up-block').on('click', '.cron-selection-btn', function(){
        $('.cron-selection-btn').button('loading');
    });

    $('.state-change').click(function() {
        var elem = $(this);
        elem.parents('.state-actions').find('form').hide();
        elem.parents('.state-actions').find('img').show();
        elem.parent('form').ajaxSubmit({
            success:function(data) {
                if(data == 'pendingapprove' || data == 'declineapprove') {
                    elem.parent('form').siblings('form').remove();
                    elem.parent('form').find('input[name=state]').val('hide');
                    elem.parent('form').find('.glyphicon').removeClass('glyphicon-thumbs-up').addClass('glyphicon-eye-close');
                    elem.parent('form').find('.glyphicon').siblings('span').html('Hide');
                } else if(data == 'pendingdecline') {
                    elem.parent('form').siblings('form').remove();
                    elem.parent('form').find('input[name=state]').val('approve');
                    elem.parent('form').find('.glyphicon').removeClass('glyphicon-thumbs-down').addClass('glyphicon-thumbs-up');
                    elem.parent('form').find('.glyphicon').siblings('span').html('Approve');
                } else if(data == 'approvehide') {
                    elem.parent('form').find('input[name=state]').val('approve');
                    elem.parent('form').find('.glyphicon').removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
                    elem.parent('form').find('.glyphicon').siblings('span').html('Show');
                } else if(data == 'hideapprove') {
                    elem.parent('form').find('input[name=state]').val('hide');
                    elem.parent('form').find('.glyphicon').removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
                    elem.parent('form').find('.glyphicon').siblings('span').html('Hide');
                }
                elem.parents('.state-actions').find('form').show();
                elem.parents('.state-actions').find('img').hide();
            }
        });
        return false;
    });
    
    $('.delete-request').click(function() {
        var elem = $(this);
        elem.parents('.state-actions').find('form').hide();
        elem.parents('.state-actions').find('a').hide();
        elem.parents('.state-actions').find('span').hide();
        elem.parents('.state-actions').find('img').show();
        elem.parent('form').ajaxSubmit({
            success:function(data) {
                if(data == 'deleted') {
                    elem.parents('.post').remove();
                }
            }
        });
        return false;
    });
    
    $('.posts').on('click', '.toggle_comments', function() {
        $(this).parent().siblings('.comments').toggle();

        if($(this).hasClass('total_comments')) {

            if($(this).find('.glyphicon').hasClass('glyphicon-eye-open')) {
                $(this).find('.glyphicon').removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
            } else {
                $(this).find('.glyphicon').removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
            }

        } else {

            if($(this).siblings('.total_comments').find('.glyphicon').hasClass('glyphicon-eye-open')) {
                $(this).siblings('.total_comments').find('.glyphicon').removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
            } else {
                $(this).siblings('.total_comments').find('.glyphicon').removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
            }
            
        }
    });

    $('.main-content').on('click', '.img-pop', function() {
        var element = $(this);
        var target = element.attr('href');
        if(target == '#') {
            return false;
        }
        
        var img = $('<img />').attr({ 'src': target });

        $('#generalModal .modal-body').html('');
        img.css('display', 'none').appendTo('body');
        m_width = img.width() + 60;
        m_height = img.height() + 100;
        img.remove();
        
        $('#generalModal .modal-dialog').css('width', m_width+'px');
        $('#generalModal .modal-dialog').css('height', m_height+'px');
        $('#generalModal .modal-body').html($('<img />').attr({ 'src': target }));
        
        $('#generalModal .modal-header').children('.ribbion').hide();
        $('#generalModal .modal-header').children('.triangle-l').hide();
        $('#generalModal .modal-header').css('height', '20px');
        $('#generalModal .modal-footer').hide();
        $('#generalModal').modal();

        return false;
    });
    
    $('.main-content').on('submit', '.delete-post', function() {
        var element = $(this);
        getConfirm("Are you sure you want to delete this?", function(result) {
            if(result) {
                element.ajaxSubmit({
                    success:function(data) {
                        if(data == 'deleted') {
                            element.parents('.post').remove();
                        } else {
                            alert ("Something went wrong, please try again after some time");
                        }
                    }
                });
            }
        }); 
        
        return false;
    });
    $('.main-content').on('submit', '.delete_comment', function() {
        var element = $(this);
        getConfirm("Are you sure you want to delete this?", function(result) {
            if(result) {
                element.ajaxSubmit({
                    success:function(data) {
                        if(data == 'deleted') {
                            var comment_count = element.closest('.post').find('.comment-count').html();
                            comment_count = parseInt(comment_count);
                            element.closest('.post').find('.comment-count').html(comment_count-1);
                            
                            if(comment_count === 2) {
                                element.closest('.post').find('.comment-text').html('comment');
                            }
                        
                            element.parents('.comment').remove();
                        } else {
                            alert ("Something went wrong, please try again after some time");
                        }
                    }
                }); 
            }
        });
        return false;
    });

    $('#deactivate-btn').click( function() {
        var element = $(this);
        getConfirm("Are you sure, you want to 'Deactivate' your account?", function(result) {
            if(result) {
                $('#deactivate-form').submit();
            }
        });
        return false;
    });

    $('.contactimporter-form').submit(function() {
        if($(".contacts-chkbox").length > 0 && !$(".contacts-chkbox:checked").length > 0) {
           alert("Please select at least one contact before submit");
           
           return false;
        }
    });

    if($(".scroll-sec").length > 0) {
        $(".scroll-sec").customScrollbar({
            preventDefaultScroll: true,
            skin: "default-skin", 
            hScroll: false,
            updateOnWindowResize: true,
        });
    }

    $('.un-suggestion').change(function(){
        $('#selected-username').val($('.un-suggestion:checked').val());
        $('#selected-username').valid();
    });

    if($("#msg-scroll").length > 0) {
        $("#msg-scroll").customScrollbar("scrollTo", "#reply");
    }

    $('.main-content').on('keypress', '.input-comment', handleEnter);
    $('.main-content').on('keypress', '#reply', handleReplyEnter);

    if ($('#page_name').length > 0 && $('#page_name').val() == 'home') {
        var base_url = $('#base_url').val();
        var last_call = '';

       /* $(window).customScrollbar({
             skin: "Modern-skin", 
             vScroll: true,
             updateOnWindowResize: true,
             alert('aaaaaa');
            onCustomScroll: function(event, scrollData) {

            alert(scrollData.scrollPercent);
                if(scrollData.scrollPercent >70.0) {

                    if( !($('.posts_footer').children('h4').length > 0) &&  $('.post_time').last().length > 0) {
                        
                        var last_time = $('.post_time').last().val();
                        if (last_time != last_call) {
                            $('#loading').show();
                            last_call = last_time;
                            $.ajax({
                                type: "get",
                                url: base_url+"members/index",
                                data: "time="+last_time,
                                success: function (data) {
                                    if(data != '') {
                                        $('.posts').append(data);
                                    } else {
                                        $('.posts_footer').html('<h4>No More Posts</h4>');
                                    }

                                    $('#loading').hide();
                                    $(window).customScrollbar("resize", true);
                                }
                            });
                        }
                    }

                   
                }
            }
        });*/
        $(window).scroll(function()
            {
           if( !($('.posts_footer').children('h4').length > 0) &&  $('.post_time').last().length > 0) {
                        
                        var last_time = $('.post_time').last().val();
                        if (last_time != last_call) {
                            $('#loading').show();
                            last_call = last_time;
                            $.ajax({
                                type: "get",
                                url: base_url+"members/index",
                               data: "time="+last_time,
                                success: function (data) {
                                    if(data != '') {
                                        $('.posts').append(data);
                                    } else {
                                        $('.posts_footer').html('<h4>No More Posts</h4>');
                                    }
                                    
                                    $('#loading').hide();
                                    $(window).customScrollbar("resize", true);
                                }
                            });
                        }
                    }

          });

        if($('.post_time').first().length > 0) {
            setInterval(function(){
                var first_time = $('.post_time').first().val();
                
                $.ajax({
                    type: "get",
                    url: base_url+"members/recent_post",
                    data: "time="+first_time,
                    success: function (data) {
                        if(data != '') {
                            $('.posts').prepend(data);
                        }
                    }
                });
            }, 20000);
        }

    } else if ($('#page_name').length > 0 && $('#page_name').val() == 'view_message') {

        $("#msg-scroll").customScrollbar({
            skin: "default-skin", 
            hScroll: false,
            updateOnWindowResize: true,
            onCustomScroll: function(event, scrollData) {
            
                if(scrollData.scrollPercent == 100.0) {


                }
            }
        });

        $username = $('#username').val();
       /* if($('.message_time').last().length > 0) {
            setInterval(function()
            {

                var last_time = $('.message_time.other-user-time').last().val();
                if(last_time == undefined) {
                    last_time = $('.message_time').first().val();
                }

                $.ajax({
                    type: "get",
                    url: base_url+"messages/recent/"+$username,
                    data: "time="+last_time,
                    success: function (data)
                    {
                        if(data != '') {

                        }
                    }
                });
            }, 5000);
        }*/
    
    }
    
    
    $('.inspire-submit-button').click(function() {
        $(this).closest('form').trigger('submit');
    });

    $('.inspire-form').submit(function() {
        var element = $(this);
        element.find('.inspire-btn').attr('disabled', 'disabled');
        element.find('.inspire-loading').show();
        element.find('i.fa').hide();

        $(this).ajaxSubmit({
            success:function(data) {
                data = JSON.parse(data);
                if(data.status === 'error') {
                    window.location.reload();
                }

                if(data.count !== undefined) {
                    element.find('.inspire-count').html(data.count);
                }
                
                if(data.msg_code !== undefined && data.msg_code) {
                    //element.find('i.fa').removeClass('fa-thumbs-o-up').addClass('fa-thumbs-up text-success');
                    element.find('.inspire-button-wrapper').addClass('already-inspired');
                    element.find('.inspire-text').find('span').html('Inspired');
                    $('#inspire-status').val(1);
                } else {
                    // element.find('i.fa').removeClass('fa-thumbs-up text-success').addClass('fa-thumbs-o-up');
                    element.find('.inspire-button-wrapper').removeClass('already-inspired');
                    element.find('.inspire-text').find('span').html('Get Inspired');
                    $('#inspire-status').val(0);
                }
                
                element.find('.inspire-loading').hide();
                //element.find('i.fa').show();
                element.find('.inspire-btn').removeAttr('disabled');
            }
        }); 
        return false;
    });
    $('.inspire-list-popup').click(function() {
        var target = $(this).attr('href');
        var pop = $(this).attr('popup-modal');
        var title = $(this).attr('popup-title');
        if(target == '#') {
            return false;
        }
        $.ajax({
            type: 'POST',
            url: target,
            data: '',
            success: function(data) {
                $(pop+' .modal-body').html(data);
                $(pop+' .modal-title').html(title);
                $(pop).modal({
                    keyboard: false,
                });
            }
        });
        return false;
    });
});

function handleEnter(evt) {
    var code = (evt.which ? evt.which : evt.keyCode);
    if (code == 13 && !evt.shiftKey) {
        if( $.trim( $(this).val() ) != '' ) {
            var element = $(this);
            $(this).parent('form').ajaxSubmit({
                success:function(data) {
                    if(data != '') {
                        if(element.parent('form').siblings('.no_comment').length > 0) {
                            element.parent('form').siblings('.no_comment').remove();
                        }
                        var comment_count = element.closest('.post').find('.comment-count').html();
                        comment_count = parseInt(comment_count);
                        element.closest('.post').find('.comment-count').html(comment_count+1);
                        
                        if(comment_count === 1) {
                            element.closest('.post').find('.comment-text').html('comments');
                        }
                        
                        element.parent('form').before(data);
                        element.val('');
                        element.trigger('update');
                        element.css('height', '30px');
                    }
                }
            });
        } else {
            $(this).val('');
        }
        evt.preventDefault();
    } else if(code == 13) {
        $(this).expandable();
    }
}

function handleReplyEnter(evt) {
    var code = (evt.which ? evt.which : evt.keyCode);
    if (code == 13 && !evt.shiftKey) {

        if( $.trim( $(this).val() ) != '' ) {
            var element = $(this);
            $(this).closest('form').trigger('submit');
            $(this).val('');
        } else {
            $(this).val('');
        }

        evt.preventDefault();
    } else if(code == 13) {
    }
}

function notification() {
    var base_url = $('#base_url').val();
    $.ajax({
        type: "get",
        url: base_url+"members/check_notifications",
        data: "",
        dataType: "json",
        success: function (data) {
            if(data.friend > 0) {
                $('#friend-noti').children('.glyphicon').addClass('active');
                $('#friend-noti').find('.badge').html(data.friend);
            } else {
                $('#friend-noti').children('.glyphicon').removeClass('active');
                $('#friend-noti').find('.badge').html('');
            }
            
            if(data.message > 0) {
                $('#message-noti').children('.glyphicon').addClass('active');
                $('#message-noti').find('.badge').html(data.message);
            } else {
                $('#message-noti').children('.glyphicon').removeClass('active');
                $('#message-noti').find('.badge').html('');
            }
            
            if(data.activities > 0) {
                $('#activity-noti').children('.glyphicon').addClass('active');
                $('#activity-noti').find('.badge').html(data.activities);
            } else {
                $('#activity-noti').children('.glyphicon').removeClass('active');
                $('#activity-noti').find('.badge').html('');
            }
            
            /* if(data.rec > 0) {
                $('#rec-noti').find('.badge').html(data.rec);
                $('#rec-noti').show();
            } else {
                $('#rec-noti').hide();
            } */
        }
    });
}

function getConfirm(confirmMessage, callback) {
    var dialogcontent = '<div class="ribbion-modal modal fade" id="confirmbox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
        '<div class="modal-dialog" style="width:450px;">'+
        '<div class="modal-content">'+
            '<div class="modal-header">'+
                '<div class="ribbion"><h2>Confirm Box</h2></div>' +
                '<div class="triangle-l"></div>'+
                '<div class="clearfix"></div>'+
            '</div>'+
            '<div class="modal-body"><h4>'+confirmMessage+'</h4></div>'+
            '<div class="modal-footer">'+
                '<button type="button" id="confirmFalse" class="btn btn-transparent" data-dismiss="modal">Cancel</button>'+
                '<button type="button" id="confirmTrue" class="btn btn-secondary">OK</button>'+
            '</div>'+
        '</div>'+
        '</div>'+
        '</div>';

    if (!$('#confirmbox').length) {
        $('body').append(dialogcontent);
    }
    
    $('#confirmbox').modal({
        show:true,
        backdrop:"static",
        keyboard: false,
    });
    
    $('#confirmFalse').unbind('click');
    $('#confirmTrue').unbind('click');
    
    $('#confirmFalse').click(function(){
        $('#confirmbox').modal('hide');
        if (callback) callback(false);

    });
    $('#confirmTrue').click(function(){
        $('#confirmbox').modal('hide');
        if (callback) callback(true);
    });
}  

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    
    return pattern.test(emailAddress);
}