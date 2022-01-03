<html>
<head>
  <title>Check Register Api</title>
</head>
<body>
<!-- All the files that are required -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<script src="https://www.callitme.com/js/jquery-1.10.2.min.js?v=1.1" type="text/javascript"></script>
<div class="info" style="min-height:450px;">
                
    <div class="step2-img">
        <img src="https://www.callitme.com/desktop-test/img/no_image.jpg">
        <form class="upload_pp" enctype="multipart/form-data" action="https://www.callitme.com/accessapi/save_photo" method="POST">
                        <input class="input_pp" name="picture" type="file">
                        <input type="hidden" name="name" value="1">
                        <input type="hidden" name="username" value="">
                        <button type="submit" class="btn btn-secondary btn-lg btn-block marTop20 uploadProPic">Upload Picture</button>
                    </form>
    </div>  
    
    <div class="clearfix"></div>
</div>
 <h2>Message :</h2><h3></h3>
</body>
</html>

<!--<script>
  $('document').ready(function(){
    $('#submit').click(function() {
      var fdata = $('#email_form').serialize();
        
      /*var picture = $('#picture').val();
      var user_id = $('#user_id').val();*/

      /*var fname = $('#first_name').val();
      var sex = $('#sex').val();
      var lname = $('#last_name').val();
      var phone_number = $('#phone_number').val();
      var month = $('#month').val();
      var day = $('#day').val();
      var year = $('#year').val();
      var phase_of_life = $('#phase_of_life').val();*/
      //alert(fdata);

     $.ajax({
        //alert('asds');
        method : 'POST',
        type: 'json',
        data: fdata, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false, 
        url : 'https://www.callitme.com/desktop-test/accessapi/save_photo',
        //data : fdata,
        //async: false,
        success: function(data)
        {
          
          if(data.status == '1')
          {
            //$("p").html
            //$('h3').html("<h4 style='color:green'>"+data.message+' and user Api key is'+data.user_id+"</h4>"); //= ;
            alert('data.message');
            //window.location.href = "https://www.callitme.com/TestApi/register/photo.php";
          }
          else
          {
            alert('data.message1');//= ;
          }
        }
      })
        //var serverUrl = ;
        $.ajax({
          type: "POST",
          beforeSend: function(request) {
            request.setRequestHeader("Content-Type", 'image/jpeg');
          },
          url:'https://www.callitme.com/desktop-test/accessapi/save_photo',
          data: fdata,
          processData: false,
          contentType: false,
          async:  false,
          success: function(data) {
            alert(data.message);
          },
        });
    })
  });
</script>-->
