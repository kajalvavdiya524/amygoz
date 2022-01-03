<html>
<head>
    <title>Compose Message Api</title>
</head>
<body>
<!-- All the files that are required -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<script src="https://www.callitme.com/js/jquery-1.10.2.min.js?v=1.1" type="text/javascript"></script>

<!-- Where all the magic happens -->
<!-- LOGIN FORM -->


    

    <input type="hidden" id="username" value="pranay">
    
    <div class="form-group" style="position:relative;">
        <label class="control-label" for="email">Who do you want to message?</label>
        <input class="form-control" id="email" type="text" name="email" placeholder="Type full email address here" value="">
    </div>

    <div class="form-group">
        <label class="control-label" for="message">And, what do you want to say?</label>
        <textarea class="required form-control" id="message" name="message" rows="10" placeholder="Type your message here and click on the send button below"></textarea>
    </div>

    <button id="submit" class="btn btn-secondary">Send</button>


</body>
</html>

<script>
    $('document').ready(function(){
        $('#submit').click(function(){
            var email = $('#email').val();
            var message = $('#message').val();
            var username = $('#username').val();

                        $.ajax({
                method : 'POST',
                type : 'JSON',
                url : 'https://www.callitme.com/desktop-test/messageapi/compose',
                data : {email:email,message:message,username:username},
                success: function(data){
                    
                    if(data.status == '1')
                    {
                        //$("p").html
                        alert(data.message);
                    }
                    else
                    {
                        alert(data.message);
                    }
                    
                }
            })
        })
    });
</script>