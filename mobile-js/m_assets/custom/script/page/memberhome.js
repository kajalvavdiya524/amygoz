/* Load member home page */
setTimeout(function(){ 
    
    memberhome (); 
    includeMemberHeader(); 

    var x = document.createElement("STYLE");
    var t = document.createTextNode(".panel {margin-bottom: 2px;}");
    x.appendChild(t);
    document.head.appendChild(x);

}, 100);

function memberhome (value) {
    var content = '';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://www.callitme.com/desktop-test/accessapi/show_posts');
    xhr.setRequestHeader('Authorization', getCookie('token'));
    xhr.onload = function() {
        var data = jQuery.parseJSON(xhr.responseText);
        if(data.posts.length == 0){
            var url = 'pages/newuser_profile.php'; 
            var containerid = 'includePageContent';
            ajaxpage(url, containerid);
        } else {
            $.each(data.posts, function(index, value){
                content += '<div class="panel panel-default">'+
                    '<div class="panel-heading">'+                         
                        '<div class="row">'+
                            '<div class="col-xs-10">'+
                                '<div class="image">'+
                                    '<a href="javascript:void(0)" class="showProfile" data-username="'+value.friend_username+'">'+
                                        '<i class="img xs profpic no-border-radius" aria-label="'+value.name+'" role="img" style="background-image: url(&quot;'+value.profile_pic+'&quot;);" data-sigil="profile_image"></i>'+
                                    '</a>'+
                                '</div>'+
                                '<div class="content">'+
                                    '<div class="name">'+
                                        '<a href="javascript:ajaxpage(\'pages/myprofile.php\', \'includePageContent\');">'+
                                            '<strong>'+value.name+'</strong>'+
                                        '</a>'+
                                        '<div class="clearfix"></div>'+
                                        '<small class="default-text"><i class="ion-ios-clock-outline"></i> '+value.post_time+'</small>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-xs-2">';
                                if(value.show_post_delete_button == true){
                                    content += '<div class="postBtnWrap">'+
                                        '<a href="" class=""><i class="ion-trash-b"></i></a>'+
                                    '</div>'
                                }
                            content += '</div>'+
                        '</div>'+
                        '<div class="cleaaaafix"></div>'+
                    '</div>'+
                    '<div class="panel-body">'+
                        '<img src="" alt="" class="img-responsive" />'+
                        
                        '<div class="clearfix"></div>'+

                        value.post+
                    '</div>'+
                    '<div class="panel-footer text-center">'+
                        '<div class="row">'+
                            '<div class="col-xs-6">'+
                                '<i class="ion-chatbubble-working"></i> '+value.number_of_comments+' Comment'+
                            '</div>'+
                            '<div class="col-xs-6 last">'+
                                '<i class="ion-ios-compose-outline"></i> Add Comment'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';            
            });
        }
        

        $('#content').append(content);

    };
    xhr.send();

}