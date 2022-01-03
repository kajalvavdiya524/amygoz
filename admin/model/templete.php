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
            <img  class="img-responsive" src="https://www.maangu.com/admin/dist/images/maangu.png" width="100"/>
        </td>
    </tr>
    <tr>
        <td>
            <div class="content">
                Hi <?php echo $name; ?>,
                <p>
                    We have waived your membership fee as part of our promotion. Please <a href="https://www.facebook.com/maangu">help spread the word around</a> as this offer is for a limited time only. Log in to your account to complete your profile and upload pictures. 
                </p>
                <br/>

                <center>
                    <a href="www.maangu.com/login" class="button"
                    style="background-color: #fa396f;border-color: #990000;color: #fff;-moz-user-select: none;background-image: none;border: 1px solid transparent;border-radius: 4px;cursor: pointer;display: inline-block;font-size: 14px;font-weight: 400;line-height: 1.42857;margin-bottom: 0;padding: 6px 12px;text-align: center;vertical-align: middle;white-space: nowrap;">Login</a>
                </center>

                <br/><br/>
                Best Regards,<br/>
                Your Dedicated Team at maangu<br/>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <a class="social" href="https://www.facebook.com/maangu"> <i id="social" class="fa fa-facebook-square fa-3x social-fb"></i> </a>
            <a class="social" href="https://twitter.com/maangu"> <i id="social" class="fa fa-twitter-square fa-3x social-tw"></i> </a>
            <a class="social" href="https://plus.google.com/+maangu/"><i id="social" class="fa fa-google-plus-square fa-3x social-gp"></i></a>
            <a class="social" href="https://www.linkedin.com/company/maangu"><i id="social" class="fa fa-linkedin-square fa-3x social-li"></i></a>
        </td>
    </tr> 
</table>
</body>
</html>