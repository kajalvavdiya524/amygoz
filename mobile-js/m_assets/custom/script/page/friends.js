/* Load member home page */
setTimeout(function(){ 
    
    friends();     

}, 100);

function friends() {
    var content = '';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://www.callitme.com/desktop-test/friendsapi/friends_for_noti');
    xhr.setRequestHeader('Authorization', getCookie('token'));
    xhr.onload = function() {
    	var data = jQuery.parseJSON(xhr.response);
    	if(data.status == 1){
    		$.each(data.friends_request, function(index, value){
	         	content += '<li class="list-group-item item navigationLink">'+
					
					'<div class="pull-left">'+
						'<a href="javascript:void(0)" data-username="'+value.username+'" onclick="viewProfileDetail(this)">';					
						if(value.request_proile_pic.length == 2){
                            content += '<i class="img xs profpic" aria-label="'+value.name+'" role="img" data-sigil="'+value.name+'" title="JN">'+value.request_proile_pic+'</i>';
                        } else {
                            content += '<i class="img xs profpic" aria-label="'+value.name+'" role="img" style="background-image: url(&quot;'+value.request_proile_pic+'&quot;);" data-sigil="'+value.name+'"></i>';
                        }
						content += '</a>'+
					'</div>'+
					'<div class="content">'+
						'<a href="javascript:void(0)" data-username="'+value.username+'" onclick="viewProfileDetail(this)">'+
							'<strong>'+value.name+'</strong><br>'+
							'<small class="textResize">'+value.location+'</small><br>'+
							'<small class="textResize">'+value.sex+'  '+value.phase_of_life+'  '+value.location+'</small>'+
						'</a>'+	
					'</div>'+
					'<div class="clearfix"></div>'+
					'<div class="row vertical-margin-sm">'+
						'<div class="col-xs-6">'+
							'<button class="btn btn-sm secondary-border secondary-text white-bg btn-block acceptRequest" data-id="'+value.user_id+'">'+
								'<i class="ion-ios-checkmark-outline"></i> Confirm'+
							'</button>'+
						'</div>'+
						'<div class="col-xs-6">'+
							'<button class="btn default-bg btn-sm btn-block rejectRequest" data-id="'+value.user_id+'">'+
								'<i class="ion-ios-close-outline"></i> Delete'+
							'</button>'+
						'</div>'+
					'</div>'+
				'</li>';                      
	        });

	        $('#userListResult').append(content);
    	} else {
    		$('#userListResult').append('<li>'+data.message+'</li>');
    	}
         

    };
    xhr.send();
    	}

}

$(document).on('click', '.acceptRequest', function(){
	var friend_id = $(this).attr('data-id');
	alert(friend_id);
	$.ajax({
        url: 'https://www.callitme.com/desktop-test/friendsapi/accept_friend',
        headers: {
            'Authorization':getCookie('token'),
            // 'X_CSRF_TOKEN':'xxxxxxxxxxxxxxxxxxxx',
            // 'Content-Type':'application/json'
        },
        method: 'GET',
        //data: {'query': 'ash'},
        data: {'friend_id': friend_id},
        success: function(result){   
        	
    		includeMemberHeader();       


           	$('#userListResult').append(content);

        }
    });
});