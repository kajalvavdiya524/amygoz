setTimeout(function(){
    var Accordion = function(el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;

        // Variables privadas
        var links = this.el.find('.link');
        // Evento
        links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
    }

    Accordion.prototype.dropdown = function(e) {
        var $el = e.data.el;
            $this = $(this),
            $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('open');

        if (!e.data.multiple) {
            $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
        };
    }   

    var accordion = new Accordion($('#accordion'), false); 

    //progressBar();
    getProfileDetail();

}, 500);    

function getProfileDetail(){
    $.ajax({
        url: 'https://www.callitme.com/desktop-test/accessapi/view_profile',
        headers: {
            'Authorization':getCookie('token'),
            // 'X_CSRF_TOKEN':'xxxxxxxxxxxxxxxxxxxx',
            // 'Content-Type':'application/json'
        },
        method: 'GET',
        //dataType: 'json',
        data: {'username': response},
        success: function(data){
            $('.username').find('h2').html(data.Name+'<br><small>'+data.lives_in+'</small>');
            $('.iamgurdeep-pic').append('<img class="img-responsive iamgurdeeposahan" alt="'+data.Name+'" src="'+data.Profile_pic+'" width="100%">');
            //$('.jumbotron').find('.progress-bar').attr('aria-valuenow', data.Social %);
            var tagData = '';
            $.each(data.tags, function(index, value){
                $('#profileHeader').append('<span data-weight="'+(value*4)+'">'+index+'</span>');
                tagData += '<span class="tags">'+value+' '+index+'</span>';
            });            
            $('#accordion').find('#peopleSay').html('<a href="javascript:void(0)">'+tagData+'</a>');

            var aboutInfo = '<li><a href="#"><i class="fa fa-intersex"></i> Gender: '+data.gender+'</a></li>'+
                '<li><a href="#"><i class="fa fa-venus-mars"></i> Phase of life: '+data.phase_of_life+'</a></li>'+
                '<li><a href="#"><i class="ion-university"></i> Education: '+data.education+'</a></li>'+
                '<li><a href="#"><i class="ion-briefcase"></i> Work at: '+data.profession+'</a></li>'+
                '<li><a href=""><i class="ion-ios-home"></i> From: '+data.from+'</a></li>'+
                '<li><a href=""><i class="ion-location"></i> Live: '+data.lives_in+'</a></li>';

            $('#accordion').find('#aboutInfo').html(aboutInfo); 
            $('#accordion').find('#numOfFriends').html(data.no_of_friends); 
            $("#profile").find('.progress.skill-bar').html('<div class="progress-bar primary-bg progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="'+data.Social_percent+'" aria-valuemin="0" aria-valuemax="100" ><span class="skill">Social percentile<i class="val"></i></span></div>')
            progressBar();

            var friendList = '';
            $.each(data.friends, function(index, value){
                friendList += '<a href="javascript:void(0)" class="showProfile" data-username="'+value.friend_username+'">';
                    if(value.friend_profile_pic.length == 2){
                        friendList += '<div class="img sm profpic pull-right" aria-label="'+value.friend_name+'" role="img" style="background-image: url(&quot;'+value.friend_profile_pic+'&quot;);" data-sigil="'+value.friend_name+'" title="JN">'+value.friend_profile_pic+'</div>';
                    } else {
                        friendList += '<div class="img sm profpic pull-right" aria-label="'+value.friend_name+'" role="img" style="background-image: url(&quot;'+value.friend_profile_pic+'&quot;);" data-sigil="'+value.friend_name+'"></div>';
                    }
                friendList += '</a>';
            }); 
            $('#accordion').find('#friendsInfo').html('<li class="photosgurdeep">'+friendList+'</li>'); 
            profileHeader();

        }
    });
}

var profileHeader = function(){

    var pWidth = $(window).width();
    var pHeight = $(window).height();

    $("#profileHeader").width(pWidth);
    $("#profileHeader").height(pHeight/3);

    jQuery(document).on('ready resize orientationchange', function(){
        jQuery('#profileHeader').css('margin','0 auto');
    });

    $("#profileHeader").awesomeCloud({
        "size" : {
            "grid" : 1,
            "factor" : 3
        },
        "color" : {
            "background" : "#036"
        },
        "options" : {
            "color" : "random-light",
            "rotationRatio" : 0.5,
            "printMultiplier" : 3
        },
        "font" : "'Times New Roman', Times, serif",
        "shape" : "star"
    });

}
function progressBar(){
    $('.progress .progress-bar').css("width",
        function() {
            return $(this).attr("aria-valuenow") + "%";
        }
    )
}