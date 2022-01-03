/* Load member home page */
setTimeout(function(){

	includePublicHeader();
	fullHeight();
	centerPosition();
}, 100);

$(document).on('click', '#loginBtn', function(e){

	e.preventDefault();
	var email = $('#email').val(),
		password = $('#password').val();

	$.getJSON( "https://www.callitme.com/desktop-test/accessapi/login?email="+email+"&password="+password, function( data ) {
		if(data.status == 1){

			//Cookies.set('name', data.name);
			setCookieData(data);

			var url = 'pages/memberhome.php', 
		        containerid = 'includePageContent';

		    ajaxpage(url, containerid);
		} else {

			swalWarning(data.message);
			
		}
	});

	// $.getJSON( "https://www.maangu.com/mobile-test/maanguapi/loginapi?email=refat_rar@yahoo.com&password=mypass1@3", function( data ) {
	// 	// var items = [];
	// 	// $.each( data, function( key, val ) {
	// 	//   items.push( "<li id='" + key + "'>" + val + "</li>" );
	// 	// });

	// 	// $( "<ul/>", {
	// 	//   "class": "my-new-list",
	// 	//   html: items.join( "" )
	// 	// }).appendTo( "body" );
	// 	// console.log(data);
	// 	sessionStorage['myvariable'] = JSON.stringify(data);
	// 	myVariable = JSON.parse(sessionStorage['myvariable']);
	// });	

	// console.log(email+' '+password);
});