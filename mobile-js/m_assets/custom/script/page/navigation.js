/* Load navigation page */
setTimeout(function(){ 

	var menuHead = '<a href="javascript:void(0)" data-username="'+getCookie('username')+'" onclick="viewProfileDetail(this)">'+
		'<div class="image pull-left">'+
	    	'<i class="img xxs profpic" aria-label="'+getCookie('name')+'" role="img" style="background-image: url(&quot;'+getCookie('profile_pic')+'&quot;);" data-sigil="profile_image"></i>'+
		'</div>'+
	    '<div class="name pull-left horizontal-padding-sm vertical-padding-sm">'+
	        getCookie('name')+
	    '</div>'+
		'<div class="clearfix"></div>'+
	'</a>';

	$('.navigationMenu').find('.head').append(menuHead);

}, 100);

$(document).on('click', '.logout', function(){

	alert('afsdfa');

    var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        	var da = c.split('=');
        	delete_cookie(da[0]);
        }
    }
    window.location.reload(true);
});