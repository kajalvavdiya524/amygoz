var loadedobjects="";
var rootdomain="http://"+window.location.hostname;
var username = Cookies.get('username');
var fullname = Cookies.get('name');
var email = Cookies.get('email');
var token = Cookies.get('token');
var response = '';

function doSomething(parm) {
    response =  parm;
}

window.onload = function(e) {
    
    if(Cookies.get('username')){
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

function showProfile(parm){
    alart(parm);
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

function setCookieData(data){
    $.each(data, function(index, value){
        Cookies.set(index, value, { expires: 365, path: 'https://www.callitme.com/mobile-test/' });
    });
}

function deleteCookieData(){
    document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
}

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

function loadGoogleMapAPI() {
    var script = document.createElement("script");
    script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyB9DpaLPWFoL666n9-OKsFx8NgA0MW5kJQ&callback=initMap";
    script.type = "text/javascript";
    document.getElementsByTagName("body")[0].appendChild(script);
}

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
