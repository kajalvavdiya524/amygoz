<html>
<head>
	<title>API Test </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<?php

			//header('Content-Type: application/json');
   //        header('Access-Control-Allow-Origin: *');
			// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
			// header('Access-Control-Allow-Methods: GET, POST, PUT');
?>
<div id="res"></div>



<script>
	
    /*alert('ye h ghanta');
    $.post("https://www.nepalivivah.com/API/index.php/accessapi/forgot_password",
    {
        email:'munmun@chunmun.com'
    },
    function(data, status){
        alert('done done done');
    });*/


$.ajax({
            url: 'https://www.nepalivivah.com/API/index.php/accessapi/forgot_password',
            type: 'POST',
            dataType: 'json',
            data:{email:'pchuahan@maangu.com'},
            success: function (data) {
                alert(data['email']);//$('#target').html(data.msg);
            }
            
        });
</script>
</body>
</html>