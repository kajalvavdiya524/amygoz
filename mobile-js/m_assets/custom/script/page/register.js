/* Load member home page */
setTimeout(function(){ 	

	includePublicHeader();
	includedFooter();
    fullHeight();

    var fname = document.getElementById('fname');
	var lname = document.getElementById('lname');
	var sex = document.getElementById('sex');
	var phase_of_life = document.getElementById('phase_of_life');

	var month = document.getElementById('month');
	var day = document.getElementById('day');
	var year = document.getElementById('year');
	var pacInput = document.getElementById('pacInput');

	var emailAddress = document.getElementById('emailAddress');
	var password = document.getElementById('password');

	$.getScript( "https://maps.googleapis.com/maps/api/js?key=AIzaSyB9DpaLPWFoL666n9-OKsFx8NgA0MW5kJQ&libraries=places&callback=initAutocomplete", function( data, textStatus, jqxhr ) {
	
	});

	$( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '1945:'+(new Date).getFullYear()
    });

	// $("#owl-demo").owlCarousel({
	// 	autoPlay: 3000, //Set AutoPlay to 3 seconds
	// 	items : 4,
	// 	itemsDesktop : [1199,3],
	// 	itemsDesktopSmall : [979,3]
	// });

	var owl = $("#owl-demo");
 
  	owl.owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		items : 4,
		pagination: false,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [979,3]
	});

	// Custom Navigation Events
  	$(".next").click(function(){
    	owl.trigger('owl.next');
  	})
  	$(".prev").click(function(){
    	owl.trigger('owl.prev');
  	})

    progressInfo();

}, 100);

function initAutocomplete() {
    // Create the search box and link it to the UI element.
    var input = document.getElementById('pacInput');
    var searchBox = new google.maps.places.SearchBox(input);
}

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(document).unbind('click').on('click', '.next', function(){
	var type = $(this).data('type');
	if(type === 'first'){
		if (fname.value == "" && allLetter(fname.value) == false) {
			addInputClass('', fname);
		}
		else if(lname.value == "" && allLetter(lname.value) == false){
			addInputClass(fname, lname);
		}
		else if(sex.value == ""){
			addInputClass(lname, sex);
		}
		else if(phase_of_life.value == ""){
			addInputClass(sex, phase_of_life);
		} 
		else {
			addInputClass(fname, '');
			addInputClass(lname, '');
			addInputClass(sex, '');
			addInputClass(phase_of_life, '');
		 	goNext($(this));			
		}
	} else if(type === 'second'){
		if(month.value == ""){
			addInputClass('', month);
		}
		else if(day.value == ""){
			addInputClass(month, day);
		} 
		else if(year.value == ""){
			addInputClass(day, year);
		} 
		else if(pacInput.value == ""){
			addInputClass(year, pacInput);
		} 		
		else {
			addInputClass(pacInput, '');
			addInputClass(month, '');
			addInputClass(day, '');
			addInputClass(year, '');
		 	goNext($(this));			
		}
	} else if(type === 'third'){
		if(emailAddress.value == "" && validateEmail(emailAddress.value) == false){
			addInputClass('', emailAddress);
		} 
		else if(password.value == ""){
			addInputClass(emailAddress, password);
		}
		else {
			addInputClass(emailAddress, '');
			addInputClass(password, '');
		 	
		 	if(emailAddress.value != '' && password != ''){
		 		console.log('aaa');
		 	}
			

		 	$.getJSON( "https://www.callitme.com/desktop-test/accessapi/signup?first_name="+fname.value+"&last_name="+lname.value+"&sex="+sex.value+"&phase_of_life="+phase_of_life.value+"&day="+day.value+"&month="+month.value+"&year="+year.value+"&email="+emailAddress.value+"&password="+password.value
		 		, function( data ) {
				if(data){
					if(data.message === 'Successfully registered')
					{
						var url = 'pages/login.php', 
					    containerid = 'includePageContent';
					    ajaxpage(url, containerid);
					} else {
						swalWarning(data.message);
					}
				}
			});	

		}
	}
	
});

function goNext(data){
	if(animating) { return false; }
		animating = true;
		
		current_fs = data.parent();
		next_fs = data.parent().next();
		
		console.log(current_fs);
		//show the next fieldset
		next_fs.show(); 
		
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({
	        'transform': 'scale('+scale+')',
	        'position': 'absolute'
	      });
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			},
		});
}

function addInputClass(parm1, parm2){
	if(parm1 != ''){
		parm1.parentElement.classList.remove("has-error");
		parm1.parentElement.classList.add("has-success");
	}
	if(parm2 != ''){
		parm2.parentElement.classList.add('has-error');
	}
}

function allLetter(parm)
{ 
	if(parm){
		var letters = /^[A-Za-z]+$/;
		if(fname.value.match(letters))
		{
			return true;
		}
		else
		{
			alert('Username must have alphabet characters only');
			return false;
		}
	} else {
		return false;
	}
}

function validateEmail(parm)
{
	var re = /\S+@\S+\.\S+/;
	alert(re.test(parm));
    return re.test(parm);
	// var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	// if(parm.match(mailformat))
	// {
	// 	return true;
	// }
	// else
	// {
	// 	return false;
	// }
}

function passid_validation(passid,mx,my)
{
	var passid_len = passid.value.length;
	if (passid_len == 0 ||passid_len >= my || passid_len < mx)
	{
		alert("Password should not be empty / length be between "+mx+" to "+my);
		passid.focus();
		return false;
	}
	return true;
}

$(document).on('click', '.previous', function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		},
	});
});

$(document).on('click', '.submit', function(){
	return false;
})