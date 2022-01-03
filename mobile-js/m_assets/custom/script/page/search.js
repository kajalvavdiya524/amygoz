// $(document).on('click', '.searchMember', function(){

//     searchUser();

// });

$(document).on('keyup', '.searchMember', function(){

    var search = $(this).val();
    searchUser(search);

});

function searchUser(parm){

    loader();

    $.ajax({
        url: 'https://www.callitme.com/desktop-test/accessapi/search',
        headers: {
            'Authorization':getCookie('token'),
            // 'X_CSRF_TOKEN':'xxxxxxxxxxxxxxxxxxxx',
            // 'Content-Type':'application/json'
        },
        method: 'GET',
        //data: {'query': 'ash'},
        data: {'query': parm},
        success: function(result){           

            var content = '';
            $('#userListResult').empty();
            var data = jQuery.parseJSON(result);

            $.each(data.search_user_name, function (index, obj){
                content += '<li class="list-group-item item navigationLink">'+
                    '<a href="javascript:void(0)" data-username="'+obj.username+'" onclick="viewProfileDetail(this)">'+
                        '<div class="pull-left">';
                            if(obj.profile_pic.length == 2){
                                content += '<i class="img xs profpic" aria-label="'+obj.name+'" role="img" data-sigil="'+obj.name+'" title="JN">'+obj.profile_pic+'</i>';
                            } else {
                                content += '<i class="img xs profpic" aria-label="'+obj.name+'" role="img" style="background-image: url(&quot;'+obj.profile_pic+'&quot;);" data-sigil="'+obj.name+'" title="JN"></i>';
                            }
                            
                        content += '</div>'+
                        '<div class="content">'+
                            '<strong>'+obj.name+'</strong><br>'+
                            '<small class="textResize">'+obj.location+'</small>'+
                        '</div>'+
                    '</a>'+
                    '<div class="clearfix"></div>'+
                '</li>';
                
            });

            $('#userListResult').html(content);

        }
    });
    textResize();

}