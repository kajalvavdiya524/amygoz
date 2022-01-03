/* Load navigation page */
setTimeout(function(){ 
    
    notification();    
    
}, 100);

/* Load notification page */
function notification(){

    var content = '';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://www.callitme.com/desktop-test/accessapi/activity_notification');
    xhr.setRequestHeader('Authorization', getCookie('token'));
    xhr.onload = function() {
        var data = jQuery.parseJSON(xhr.responseText);
        console.log(data)
        $.each(data.noti, function (index, obj){
            console.log(obj);  
            content += '<li class="list-group-item item navigationLink">'+
                '<div class="pull-left">'+
                    '<a href="#" data-link="singleProfile" class="navigationLink">'+
                        '<i class="img xs profpic" aria-label="Niloy Rahman" role="img" style="background-image: url(&quot;'+obj.profile_pic+'&quot;);"></i>'+
                    '</a>'+
                '</div>'+
                '<div class="content">'+
                    '<a href="#" data-link="singleProfile" class="navigationLink">'+
                        '<small class="black-text">'+obj.activity1+'</small><br>'+
                        '<small><i class="ion-ios-clock-outline"></i> '+obj.time+'</small>'+
                    '</a>'+
                '</div>'+
                '<div class="clearfix"></div>'+
            '</li>';            
        });        

        content += '<li class="list-group-item item navigationLink">'+
            '<a href="#" class="">'+
                '<i class="ion-ios-refresh-empty"></i> Load more'+
            '</a>'+
        '</li>';

        $('#msgList').html(content);
    };
    xhr.send();
    textResize();   

}