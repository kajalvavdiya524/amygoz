/* Load member review page */
setTimeout(function(){
    
    erTabs();
    renderSelect2();
    
}, 100);

function erTabs(){
    //Vertical Tab
    $('#parentVerticalTab').easyResponsiveTabs({
        type: 'vertical', //Types: default, vertical, accordion
        width: 'auto', //auto or any width like 600px
        fit: true, // 100% fit in a container
        closed: false, // Start closed if in accordion view
        tabidentify: 'hor_1', // The tab groups identifier
    });
}

function renderSelect2(){
    
    $('.select2').select2({
        placeholder: "Enter option separated by comma. Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.",
    });

    $('#describe_person_tag').select2({
        placeholder: "Enter option separated by comma. Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.",
        allowClear: true
    });

}

$(document).on('keyup', '#recommend-email', function(){
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
    $('#recommend-email').val($(parm).attr('data-email'));
    $('#userList').empty();
}

$(document).on('click', '.reviewPublicly', function(e){



    e.preventDefault();
    var username = getCookie('username'),
        email = $('recommend-email').val(),
        words = $('describe_person_tag').val(),
        relation = $('recommend-relation').val(),
        message = $('#recommend-message').val();

    console.log(words);    

    $.ajax({
        url: 'https://www.callitme.com/desktop-test/peoplereviewapi/send',
        headers: {
            'Authorization':getCookie('token'),
            // 'X_CSRF_TOKEN':'xxxxxxxxxxxxxxxxxxxx',
            // 'Content-Type':'application/json'
        },
        method: 'GET',
        //data: {'email': email, 'words': words, 'relation': relation, 'message':message},
        data : $('#writeReview').serialize(),
        success: function(result){   
            
            //console.log();

        }    
    });
})