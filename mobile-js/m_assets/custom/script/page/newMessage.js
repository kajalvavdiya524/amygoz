$(document).on('keyup', '#message-email', function(){
    var content = '';
    var parm = $(this).val();
    $.ajax({
        url: 'https://www.callitme.com/desktop-test/accessapi/find_user',
        headers: {
            'Authorization':getCookie('token'),
            // 'X_CSRF_TOKEN':'xxxxxxxxxxxxxxxxxxxx',
            // 'Content-Type':'application/json'
        },
        method: 'GET',
        data: {'query': parm},
        success: function(result){           

            //console.log(result.Filter_Register_User_Email);
            $.each(result.Filter_Register_User_Email, function (index, value){
                content += '<li>'+
                    '<a href="javascript:void(0)" data-email="'+value.User_Email+'" class="navigationLink" onclick="getEmailForNewMesg(this);">'+
                        '<div class="pull-left">';                                       
                            if(value.Profile_pic.length == 2){
                                content += '<i class="img xs profpic" aria-label="Niloy Rahman" role="img" data-sigil="'+value.Name+'" title="JN">'+value.Profile_pic+'</i>';
                            } else {
                                content += '<i class="img xs profpic" aria-label="'+value.Name+'" role="img" style="background-image: url(&quot;'+value.Profile_pic+'&quot;);" data-sigil="'+value.Name+'" title="'+value.Name+'"></i>';
                            }
                        content += '</div>'+
                        '<div class="content">'+
                            '<strong>'+value.Name+'</strong><br>'+
                            '<small class="textResize">'+value.Location+', Social : '+value.Social_percent+'%</small>'+
                        '</div>'+
                    '</a>'+    
                    '<div class="clearfix"></div>'+  
                '</li>';
            });

            $('#userList').html('<ul>'+content+'</ul>');

        }
    });
})

function getEmailForNewMesg(parm){
    $('#message-email').val($(parm).attr('data-email'));
    $('#userList').empty();
}

$(document).on('click', '#sendMessage', function(e){
    e.preventDefault();
    
    var email = $('#message-email'),
        message = $('#message-user');

    if(email.val() != '' && message.val() != ''){
        $.ajax({
            url: 'https://www.callitme.com/desktop-test/messageapi/compose',
            type: "GET",
            data: $('#newmessage').serialize(),
            success: function (text)
            {
                if(text.status == 1){
                    $('.horizontal-padding-none').prepend('<div class="alert alert-success vertical-margin-none" role="alert">'+
                        text.message+
                    '</div>');
                    email.val('');
                    message.val('');
                } else {
                    $('.horizontal-padding-none').prepend('<div class="alert alert-warning vertical-margin-none" role="alert">'+
                        text.message+
                    '</div>');
                    email.val('');
                    message.val('');
                }
            }

        });
    }
})