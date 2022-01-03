var loadedobjects="";
var rootdomain="http://"+window.location.hostname;
var username = getCookie("username");
var fullname = getCookie("name");
var email = getCookie('email');
var userid = getCookie('userid');
var token = getCookie('token');
var response = '';

function doSomething(parm) {
    response =  parm;
}

window.onload = function(e) {
    
    if(getCookie('username')){
        var url = 'pages/memberhome.php'; 
    } else {
        var url = 'pages/register.php'; 
    }      
    var containerid = 'includePageContent';

    ajaxpage(url, containerid);

};

function ajaxpage(url, containerid){

    //$("#pageScript").remove();

    var fields = url.match(/[^/]+/g);
    var func = fields[1].match(/[^.]+/g);

    var page_request = false;

    if (window.XMLHttpRequest) // if Mozilla, Safari etc

        page_request = new XMLHttpRequest();
    
    else if (window.ActiveXObject){ // if IE

        try {
            page_request = new ActiveXObject("Msxml2.XMLHTTP");
        } 
        catch (e){
            try{
                page_request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){

            }
        }

    }
    else
        return false;

    page_request.onreadystatechange = function(){
    
        loadpage(page_request, containerid, func[0]);
    
    }

    page_request.open('GET', url, true);
    page_request.send(null);

    //friends_for_noti();

}

function loadpage(page_request, containerid, result){
    if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1)){

        document.getElementById(containerid).innerHTML=page_request.responseText;

        loadScript(result);

    }

}

function viewProfileDetail(parm){
    var friend_username = $(parm).data('username');
    doSomething(friend_username);

    var url = 'pages/myprofile.php'; 
    var containerid = 'includePageContent';

    ajaxpage(url, containerid);  
}

function swalWarning(message){
    swal({
        type: 'warning',
      title: 'Error!',
      text: message,
      //timer: 5000,
      //focusCancel: true
    })
}

function setCookieData(obj){
    Object.keys(obj).forEach(function(key) {
        setCookie(key,obj[key],10000)
    });
}

function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();

    console.log(expires);

    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=''";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function delete_cookie( name ) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

// function deleteCookieData(){
//     document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
// }

function loadScript(result){

    var script = document.getElementById("script");
    script.parentNode.removeChild(script);
    
    var newScript = document.createElement("script");
    newScript.type = "text/javascript";
    newScript.src = "m_assets/custom/script/page/"+result+".js";
    document.write.to = {filename: newScript.src};
    document.getElementsByTagName('head')[0].appendChild(newScript);
    newScript.setAttribute("id", "script");
    //console.log('script added');
}

// function loadGoogleMapAPI() {
//     var script = document.createElement("script");
//     script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyB9DpaLPWFoL666n9-OKsFx8NgA0MW5kJQ&callback=initMap";
//     script.type = "text/javascript";
//     document.getElementsByTagName("head")[0].appendChild(script);
// }

var fullHeight = function () {
    $('.js-fullheight').css('min-height', $(window).height());
    
    $(window).resize(function () {
        $('.js-fullheight').css('min-height', $(window).height());
    });
}

function progressInfo(){
    $(".progress-bar").loading();
}

/* Centering div position */
var centerPosition = function(){

    $('.centerAlign').each( function(index) {

        var container = this.closest('section').id;
        var content = $("#"+container+' .centerAlign');

        var containerHeight = $("#"+container).height();
        var contentHeight = content.height();

        var margin = (containerHeight - contentHeight) / 2;
        
        if(contentHeight <= containerHeight){

            content.css('margin-top', margin);
            
        }

    });

    $(window).resize(function() {
        $('.centerAlign').each( function(index) {

            var container = this.closest('section').id;
            var content = $("#"+container+' .centerAlign');

            var containerHeight = $("#"+container).height();
            var contentHeight = content.height();

            var margin = (containerHeight - contentHeight) / 2;

            if(contentHeight <= containerHeight){

                content.css('margin-top', margin);

            }                
            
        });
    });
}

// function loadScript(result){

//     var fileref="";

//     if (loadedobjects.indexOf(result)==-1){ //Check to see if this object has not already been added to page    before proceeding
        
//         fileref=document.createElement('script');
//         fileref.setAttribute("type","text/javascript");
//         fileref.setAttribute("src", 'm_assets/custom/script/page/'+result+'.js');
//         fileref.setAttribute("id", 'pageScript');

//     }

//     if (fileref!=""){
//         $("#pageScript").remove();
//         document.getElementsByTagName("head").item(0).appendChild(fileref)
//         loadedobjects+=result+" " //Remember this object as being already added to page
    
//     }

// }

function loader(){
    var loader = $('#loader');

    loader.empty();

    loader.show();

    var circle = new Sonic({

        width: 50,
        height: 50,
        padding: 50,
     
        strokeColor: '#000',
     
        pointDistance: .01,
        stepsPerFrame: 3,
        trailLength: .7,
     
        step: 'fader',
     
        setup: function() {
            this._.lineWidth = 5;
        },
     
        path: [
            ['arc', 25, 25, 25, 0, 360]
        ]
     
    });
     
    circle.play();
     
    loader.append(circle.canvas);

    setTimeout(function(){ 
        loader.hide();
    }, 1000);

}

function textResize (){

    $(".textResize").each(function(){
        $(this).data({originalTxt: $(this).text()});
    });   

    checkWidth();

}

function checkWidth() {
    $(".textResize").each(function(i){
        var len=$(this).text().length;
        if(len>30)
        {
            $(this).text($(this).text().substr(0,30)+'...');
        }
    });
}

function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}

$('.panel-group').on('click','hidden.bs.collapse', function(){
    toggleIcon();
});
$('.panel-group').on('click','shown.bs.collapse',  function(){
    toggleIcon();
});

var includeMemberHeader = function () {

    $("#includedHeader").load("templates/memberHeader.html");

}

var includedFooter = function () {

    $("#includedFooter").load("templates/includedFooter.html");

}

var includePublicHeader = function(){
    $("#includedHeader").load("templates/publicHeader.html");
}

;
(function () {

    'use strict';

    

    // Document on load.
    $(function () {
        textResize();
    });


}());

function allDown(id){
    $(id).animate({
        scrollTop: $('body')[0].scrollHeight}, 2000);
}

window.onbeforeunload = function () {
    window.location.href = window.location.href.replace(/#.*$/, '');
};

function getAroundFriend(radius) {
    $.ajax({
        url: 'https://www.callitme.com/desktop-test/roundapi/',
        headers: {
            'Authorization':getCookie('token'),
            // 'X_CSRF_TOKEN':'xxxxxxxxxxxxxxxxxxxx',
            // 'Content-Type':'application/json'
        },
        method: 'GET',
        //dataType: 'json',
        data: {'radius': radius},
        success: function(data){
            var locations = [];
            var info = '';
            Object.keys(data.Show_round_member.users).forEach(function(key) {
              // info = '<img src="'+data.users[key].image+'" width="100%"><strong>'+data.users[key].name+'</strong><br>\r\
              // Age: '+data.users[key].age+'<br>\
              // <a href="https://goo.gl/maps/QGUrqZPsYp92">Get Directions</a>';;

              info = '<div id="content">'+
                '<div id="bodyContent">'+
                  '<img src="'+data.Show_round_member.users[key].image+'"><div class="clearfix"></div>'+
                  '<p><b>'+data.Show_round_member.users[key].name+'</b><br>' +
                  data.Show_round_member.users[key].age+' '+data.Show_round_member.users[key].gender+
                  '</p>'+
                  // '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
                  // 'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
                  // '(last visited June 22, 2009).</p>'+
                '</div>'+
              '</div>';

              locations[key] = [
                info,
                data.Show_round_member.users[key].lat,
                data.Show_round_member.users[key].long,
                key
              ]

            });

            var mapWrap = document.getElementById('map');
              mapWrap.style.backgroundColor = "red";
              mapWrap.style.width = screen.width+"px";
              mapWrap.style.height = screen.height+"px";

              //alert(document.getElementById('includedHeader').clientHeight);

              //alert();

            var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: new google.maps.LatLng(23.7104, 90.4074),
            mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow({});

            var marker, i;

            for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
              position: new google.maps.LatLng(locations[i][1], locations[i][2]),
              map: map
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
              return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                  }
                })(marker, i));
            }
        }
    });  
}

if(username){
   window.addEventListener("orientationchange", function() {
        // Announce the new orientation number
        agetAroundFriend();
    }, false); 
}