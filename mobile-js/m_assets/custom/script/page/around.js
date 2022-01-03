/* Load member home page */
setTimeout(function(){ 
    
    getAroundFriend();     

}, 100);

$(document).on('click', '#getPeopleAround', function(){

    var radius = document.getElementById("input_id").value;

    if(radius == ''){
        radius = 50;
    }
    getAroundFriend(radius);        
});