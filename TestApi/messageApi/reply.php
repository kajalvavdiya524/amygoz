<html>
<head>
	<title>Reply Message Api</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<script src="https://www.callitme.com/js/jquery-1.10.2.min.js?v=1.1" type="text/javascript"></script>
</head>
<body>
<form id="reply-msg" action="https://www.callitme.com/desktop-test/messages/reply/" method="post" role="form" class="marTop20 validate-form" novalidate="novalidate">

            <div class="msg-loader marBottom10 textCenter" style="display:none;">
                <img src="https://www.callitme.com/desktop-test/img/load_er.gif">
            </div>

            <div class="form-group">
                <input type="hidden" id="to" name="to" value="20">
                <input type = "hidden" id="from" name="username" value="pranay">

                <textarea class="required form-control" id="reply" name="reply" placeholder="Type your message here and press enter" required=""></textarea>
            </div>

            <button type="submit" class="btn btn-secondary" id="target">Reply</button>

        </form>
</body>
<script type="text/javascript">
	
	$('document').ready(function(){
        $('#submit').click(function(){
            var to = $('#to').val();
            var username = $('#from').val();
            var reply = $('#reply').val();

                        $.ajax({
                method : 'POST',
                type : 'JSON',
                url : 'https://www.callitme.com/desktop-test/messageapi/reply',
                data : {to:to,username:username,reply:reply},
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
</html>
