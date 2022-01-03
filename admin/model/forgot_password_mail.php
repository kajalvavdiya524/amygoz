<html>
<head>
<style>
    @import "http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css";
    a, a:hover{text-decoration:none;}

    .button{
        background-color: #fa396f;
        border-color: #990000;
        color: #fff;
        -moz-user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857;
        margin-bottom: 0;
        padding: 6px 12px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }

    .button:hover{
        background:#ff5555;
        border-color:#990000;
        color:#fff;
    }

    #social:hover {
        -webkit-transform:scale(1.1); 
        -moz-transform:scale(1.1); 
        -o-transform:scale(1.1); 
    }
    .social{
        color:#fa396f;
    }
    #social {
        -webkit-transform:scale(0.8);
        /* Browser Variations: */
        -moz-transform:scale(0.8);
        -o-transform:scale(0.8); 
        -webkit-transition-duration: 0.5s; 
        -moz-transition-duration: 0.5s;
        -o-transition-duration: 0.5s;
    }

    /* 
        Only Needed in Multi-Coloured Variation 
    */
    .social-fb:hover {
        color: #3B5998;
    }
    .social-tw:hover {
        color: #4099FF;
    }
    .social-gp:hover {
        color: #d34836;
    }
    .social-li:hover {
        color: #007bb6;
    }
</style>

</head>
<body>
<table border="0" width="100%">
    <tr>
        <td>
            <img  class="img-responsive" src="https://www.callitme.com/admin/assets/img/logo1.png" width="100"/>
        </td>
    </tr>
    <tr>
        <td>
            <div class="content">
                Hi <?php echo $name; ?>,
               
                    <p>Please click on the link below to reset your password.</p> 
               
                <br/>
                <div style="width:300px; height:auto; margin: 0 auto;">
                                    <div style="text-align: justify; word-break:break-all;">
                                      <a href="<?php echo $link;?>">  <?php echo $link;?></a>
                                    </div>
                                </div>
                <center>
                    <a href="www.callitme.com/admin/view/login.php" class="button"
                    style="background-color: #fa396f;border-color: #990000;color: #fff;-moz-user-select: none;background-image: none;border: 1px solid transparent;border-radius: 4px;cursor: pointer;display: inline-block;font-size: 14px;font-weight: 400;line-height: 1.42857;margin-bottom: 0;padding: 6px 12px;text-align: center;vertical-align: middle;white-space: nowrap;">Login</a>
                </center>

                <br/><br/>
                Best Regards,<br/>
                Your Dedicated Team at Callitme<br/>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <a href="https://www.callitme.com/blog/" target="_blank"><i class="fa fa-pencil"></i> Blog</a> |
                                            <a href="https://www.facebook.com/callitme" target="_blank"><i class="fa fa-facebook"></i> Facebook</a> |
                                            <a href="https://plus.google.com/+Callitme" target="_blank"><i class="fa fa-google-plus"></i> Google Plus</a> |
                                            <a href="https://twitter.com/call_it_me" target="_blank"><i class="fa fa-twitter"></i> Twitter</a><br>
                                                You are receiving this message because you are a member of Callitme. You can manage your email subscription preferences <a href="https://www.callitme.com/account/email_notification_settings">here</a>.
        </td>
    </tr> 
</table>
</body>
</html>