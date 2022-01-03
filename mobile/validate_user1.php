<html>
<head>
	<title>Test Api</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript">
	$('document').ready(function(){
		$('#button').click( function(){

			var email=$('#email').val();
			var password = $('#password').val();
			//alert(password);
			$.ajax({

				method: 'POST',
				url:'https://www.maangu.com/api/maanguapi/test',
				data:{email:email},
				dataType:'text',

				success: function(data){
					alert(data);
				}

			});
		});
	});
	</script>
</head>
<body>
	<input type="email" id='email' name="email" placeholder="Email">
 
	<input type="button" id="button" value="login with maangu">
</body>
</html>