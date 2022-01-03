/* Load navigation page */
setTimeout(function(){ 
    
    message();    
    
}, 100);

/* Load message page */
function message() {

    var content = '';
    $.ajax({
        url: 'https://www.callitme.com/desktop-test/messageapi/show_conversation_user_list',
        headers: {
            'Authorization':getCookie('token'),
            // 'X_CSRF_TOKEN':'xxxxxxxxxxxxxxxxxxxx',
            // 'Content-Type':'application/json'
        },
        method: 'POST',
        //dataType: 'json',
        data: {'username': getCookie('username')},
        success: function(data){
            $.each(data.conversation_list, function (index, obj){
                content += '<li class="list-group-item item navigationLink">'+
                    '<a href="#" class="viewMessage" onclick="loadFull(this)" data-username="'+obj.username+'" data-userid="'+obj.user_id+'" data-fullname="'+obj.Name+'"> '+   
                        '<div class="image">'+
                            '<i class="img xs profpic" aria-label="Niloy Rahman" role="img" style="background-image: url(&quot;'+obj.profile_pic+'&quot;);" data-sigil="profile_image"></i>'+
                        '</div>'+
                        '<div class="content">'+
                            '<div class="pull-right">'+
                                '<small>'+obj.time+'</small>'+                                            
                            '</div>'+
                            '<div class="name">'+
                                '<strong>'+obj.Name+'</strong>'+
                                '<div class="clearfix"></div>'+
                            '</div>'+
                            '<div class="">'+
                                '<small>'+obj.message+'</small>'+
                            '</div>'+
                        '</div>'+
                    '</a>'+
                '</li>';
            });   

            $("#msgList").html(content);
        }
    });

	// var content = '';

 //    var msglist = [{"id":1,"user_img":"http:\/\/placehold.it\/43x43","name":"Hasib Bin Siddique","time":"4:30 PM","msg":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum"},{"id":2,"user_img":"http:\/\/placehold.it\/43x43","name":"Niloy Rahman","time":"1 HR","msg":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum"},{"id":4,"user_img":"http:\/\/placehold.it\/43x43","name":"Siddique Jubayer","time":"4 HR","msg":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum"}];

    

}

$(document).on('click', '#loadAllMsg', function(){

	$('#msgSearchBox').show();

    var content = '';

    var msglist = [{"id":1,"user_img":"http:\/\/placehold.it\/43x43","name":"Hasib Bin Siddique","time":"4:30 PM","msg":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum"},{"id":2,"user_img":"http:\/\/placehold.it\/43x43","name":"Niloy Rahman","time":"1 HR","msg":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum"},{"id":4,"user_img":"http:\/\/placehold.it\/43x43","name":"Siddique Jubayer","time":"4 HR","msg":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum"}];

    $.each(msglist, function (index, obj){

        content += '<li class="list-group-item item">'+
            '<a href="#" class="viewMessage" onclick="" data-username="'+obj.username+'" data-username="'+obj.Name+'">'+   
                '<div class="image">'+
                    '<i class="img xs profpic" aria-label="Niloy Rahman" role="img" style="background-image: url(&quot;'+obj.user_img+'&quot;);" data-sigil="profile_image"></i>'+
                '</div>'+
                '<div class="content">'+
                    '<div class="pull-right">'+
                        '<small>'+obj.time+'</small>'+                                            
                    '</div>'+
                    '<div class="name">'+
                        '<strong>'+obj.Name+'</strong>'+
                        '<div class="clearfix"></div>'+
                    '</div>'+
                    '<div class="">'+
                        '<small>'+obj.msg+'</small>'+
                    '</div>'+
                '</div>'+
            '</a>'+
        '</li>';

    });

    $('#msgList').append(content);

    $(this).closest('.row').hide();

    
});

function filterList(value) {

    var list = $("#msgList li");
    $(list).hide();
    if (value) {
    
        $("#msgList").find("li[data-name*=" + value + "]").each(function (i) {
            $(this).delay(200).slideDown('400','easeInQuad');
        });

    } else {
        $(list).slideDown('400','easeInQuad');
    }
    
    

}

$(document).on('click', '.viewMessage', function(){

    var username = $(this).data('username');
    var fullname = $(this).data('fullname');
    viewMessage(username, fullname);

});


$(document).unbind('click').on('click', '#msgSubmit', function(event){

    var toUsername = $('#toUsername').val();
    var reply = $('#reply').val();

    if(reply != ''){
        $.ajax({
            url: 'https://www.callitme.com/desktop-test/messageapi/reply',
            headers: {
                'Authorization':getCookie('token'),
                // 'X_CSRF_TOKEN':'xxxxxxxxxxxxxxxxxxxx',
                // 'Content-Type':'application/json'
            },
            type: "GET",
            data: $('#msgReply').serialize(),
            success: function (text)
            {
                if(text.status == 1){
                    msgCcntent(toUsername);
                }
            }

        });
    }
    
    event.preventDefault();
});

/* Load new message page */
$(document).on('click', '.newmessage', function(){

    var url = 'pages/newMessage.php'; 
    var containerid = 'includePageContent';

    ajaxpage(url, containerid);

});

function loadFull(parm){
    var username = $(parm).data('username');
    var fullname = $(parm).data('fullname');
    var userid = $(parm).data('userid');

    $("#includePageContent").empty();

    var content = '';

    content += '<section id="msgHeader">'+
        '<div class="container-fluid">'+
            '<div class="row">'+
                '<div class="col-xs-10">'+
                    '<h3 class="section-title">'+
                        fullname+
                        '<i class="ion-record chatStatus online"></i>'+
                    '</h3>'+
                '</div>'+
                '<div class="col-xs-2 text-right">'+
                    '<a href="#" class="reloadMsg" data-other_username="'+fullname+'">'+
                        '<h3>'+
                            '<i class="ion-ios-loop-strong"></i>'+
                        '</h3>'+
                    '</a>'+
                '</div>'+
            '</div>'+
        '</div>'+
    '</section>'+
    '<section id="msgContainer">'+
        '<div class="container-fluid">'+
            '<div class="row">'+
                '<ul class="list-group vertical-margin-none" id="fullMsgList">'+

                '</ul>'+
            '</div>'+                      
        '</div>'+
    '</section>'+

    '<section id="msgfooter" class="default-bg fixed bottom fullWidth vertical-padding-sm">'+
        '<div class="container-fluid">'+
            '<div class="row">'+                
                '<form id="msgReply">'+
                    '<div class="col-xs-9" style="padding-right: 0">'+
                        '<div class="form-group">'+
                            '<input type="hidden" name="to" id="toUsername" value="'+userid+'"/>'+
                            '<textarea name="reply" id="reply" class="form-control" placeholder="Write a message"></textarea>'+                                
                        '</div>'+
                    '</div>'+
                    '<div class="col-xs-3 text-center">'+
                        '<input type="button" name="Send" value="Send" class="btn btn-sm white-text secondary-bg" id="msgSubmit"/>'+
                    '</div>'+
                '</form>'+
            '</div>'+
        '</div>'+
    '</section>';

    $("#includePageContent").html(content);
    
    msgCcntent(username);
}

function msgCcntent(username){
    var content = '';
    $.ajax({
        url: 'https://www.callitme.com/desktop-test/messageapi/view_message',
        headers: {
            'Authorization':getCookie('token'),
            // 'X_CSRF_TOKEN':'xxxxxxxxxxxxxxxxxxxx',
            // 'Content-Type':'application/json'
        },
        method: 'GET',
        //dataType: 'json',
        data: {'username': getCookie('username'), 'other_username': username},
        success: function(data){
            $.each(data.conversation_list, function (i, msg){                
                content += '<li class="list-group-item item">'+
                    '<a href="#">'+
                        '<div class="image">'+
                            '<i class="img xs profpic" aria-label="'+msg.Name+'" role="img" style="background-image: url(&quot;'+msg.profile_pic+'&quot;);" data-sigil="profile_image"></i>'+
                        '</div>'+
                        '<div class="content">'+
                            '<div class="name">'+
                                '<strong>'+msg.Name+'</strong>'+
                                '<div class="clearfix"></div>'+
                            '</div>'+
                            '<div class="">'+
                                '<small>'+msg.message+'</small>'+
                                '<div class="clearfix"></div>'+
                            '</div>'+
                            '<div class="">'+
                                '<small>'+msg.time+'</small>'+
                            '</div>'+
                        '</div>'+
                    '</a>'+
                '</li>';
            });

            $('#fullMsgList').html(content);
        }
    });

    /* Load message content setting */
    msgContainer();
}

function msgContainer(){

    var msgContainerDiv = $('#msgContainer'),
        header = $('#header').innerHeight(),
        msgHeader = $('#msgHeader').innerHeight(),
        msgfooter = $('#msgfooter').innerHeight(),
        totalHeight = $(window).height() - (msgHeader+msgfooter+header);

    $('#msgContainer').height(totalHeight); 

    allDown(msgContainerDiv);

    // var wtf    = $('#msgContainer');
    // var height = wtf[0].scrollHeight;
    // wtf.scrollTop(height);

    // $('#msgContainer').scrollTop($('#msgContainer')[0].scrollHeight - $('#msgContainer')[0].clientHeight);
    // console.log(header+' '+msgHeader+' '+msgfooter+' '+totalHeight);
}