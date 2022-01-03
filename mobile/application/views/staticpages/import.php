<section class="intro-sec-1 gap gap-fixed-height-large">        

    <div class="skrollable skrollable-between" id="intro">

        <div class="container">

            <h1>See who you know here</h1>

            <div class="search-form">

                  <form class="form-inline" method="post" action="<?php echo URL::base(); ?>pages/search_results">

                    <div class="form-group">

                        <input type="text" class="form-control input-lg" name="first_name" id="firstname" placeholder="First Name">

                    </div>

                    <div class="form-group">

                        <input type="text" class="form-control input-lg"  name="last_name" id="lasttname" placeholder="Last Name">

                    </div>

                    <button type="submit" class="btn btn-default btn-lg">Search</button>

                </form>

            </div>

        </div> <!-- end container -->

    </div> <!-- end intro -->                

</section>



<section class="gap gap-fixed-height-medium">

    <div class="container">

        <div class="row">

            <div class="col-sm-12">

                <div class="panel panel-default">

                    <div class="panel-body">

                        <h4 class="text-center">Import your email contacts</h4>

                        <hr>

                        <div class="row">

                            <div class="col-sm-4">

                                <?php

                              $gmail_client_id = Kohana::$config->load('contact')->get('gmail_client_id');

                                $gmail_redirect_uri = Kohana::$config->load('contact')->get('gmail_redirect_uri');

                               ?>



                         
                                
                                
                                  <!----------------------------------------login modal -------------------->
                               <a id="modal_trigger" href="#modal" >

                                    <img src="<?php echo url::base() . "img/gmail.png"; ?>" class="center-block hb-mt-20" />

                                </a>
                               
                            <!----------------------------------------login modal -------------------->
                            
                            
                            
                            
                            </div>

                            <div class="col-sm-4">

                                <?php

                                $hotmail_client_id = Kohana::$config->load('contact')->get('hotmail_client_id');

                                $hotmail_redirect_uri = Kohana::$config->load('contact')->get('hotmail_redirect_uri');

                                ?>

                              <!--  <a href="https://login.live.com/oauth20_authorize.srf?client_id=<?php echo $hotmail_client_id; ?>&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri=<?php echo $hotmail_redirect_uri; ?>">

                                    <img src="<?php echo url::base() . "img/hotmail.png"; ?>" class="center-block" />

                                </a>-->
                                <a id="modal_trigger1" href="#modal1" >

                                    <img src="<?php echo url::base() . "img/hotmail.png"; ?>" class="center-block" />

                                </a>
                            </div>

                            <div class="col-sm-4">

                                 <a id="modal_trigger2" href="#modal2" >

                                    <img src="<?php echo url::base() . "img/yahoo.png"; ?>" class="center-block" />

                                 </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>            

        </div>

    </div>

</section>





<!--added by Riti-->



<!--<div id="home-middle">



    <div class="container">



        <div id="recommendation" class="steps">

            <h3> Callitme is a crowd powered people review network where you can review your friends & family, match your single friends, anonymously ask your crush out for a date, and find singles around you.</h3>

        </div>



        <hr class="center" />



        <div id="recommendation" class="steps">

            <h1>Review people</h1>

            <h3>You have reviewed products and businesses, now you get to review people. </h3>

            <ul>

                <li class="step">

                    <span class="step-icon step-1"></span>

                    <span class="step-content">Enter the email address of the person you want to review</span>

                </li>

                <li class="step">

                    <span class="step-icon step-2"></span>

                    <span class="step-content">Pick the relationship between you and the person you are reviewing</span>

                </li>

                <li class="step">

                    <span class="step-icon step-3"></span>

                    <span class="step-content">Choose the attributes that best describes the person</span>

                </li>

                <li class="step">

                    <span class="step-icon step-4"></span>

                    <span class="step-content">Describe the person</span>

                </li>

            </ul>

        </div>





        <hr class="center" />

        <div id="anonymous" class="steps">

            <h1>Ask your crush out anonymously</h1>

            <h3>No one wants to be rejected! You don't have to be. Invite your crush out on a date anonymously. Only mutual crush will be disclosed. </h3>



            <ul>

                <li class="step">

                    <span class="step-icon step-1"></span>

                    <span class="step-content">Select an activity of your interest</span>

                </li>

                <li class="step">

                    <span class="step-icon step-2"></span>

                    <span class="step-content">Enter the email address of your crush</span>

                </li>

                <li class="step">

                    <span class="step-icon step-3"></span>

                    <span class="step-content">If you want, select a statement that best decribes your crush</span>

                </li>

                <li class="step">

                    <span class="step-icon step-4"></span>

                    <span class="step-content">Tell your crush something about yourself</span>

                </li>

            </ul>    

        </div>



        <hr class="center" />



        <div id="match" class="steps">

            <h1>Match singles</h1>

            <h3>Do you know two single people who would be a great couple? Take the lead and become a Match Maker!</h3>

            <ul>

                <li class="step">

                    <span class="step-icon step-1"></span>

                    <span class="step-content">Select your connection</span>

                </li>

                <li class="step">

                    <span class="step-icon step-2"></span>

                    <span class="step-content">Enter the email address or select the person you want to match with</span>

                </li>



            </ul>

        </div>

        <hr class="center" />

        <div id="match" class="steps">

            <h1>Find singles around you</h1>

            <h3>You don’t have to become Christopher Columbus and voyage around the world in search of a date. Your next door neighbor may be your match.</h3>

        </div>



    </div>



</div>



<!--inserting google ad-->

<!--<div class="container">

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <!-- First Ad -->

    <!--<ins class="adsbygoogle"

         style="display:inline-block;width:728px;height:90px"

         data-ad-client="ca-pub-5036589147869169"

         data-ad-slot="1715880137"></ins>

    <script>

        (adsbygoogle = window.adsbygoogle || []).push({});

    </script>

</div>

<!--end-->   



<!--<div id="home-bottom">

    <div class="container">

        <div id="home-join-us" class="pull-left">

            <h3>Join our fastest growing network over the globe</h3>

        </div>



        <img src="<?php //echo url::base(); ?>img/home-bottom.png" alt="Callitme crowdprofiling social dating" class="pull-right"/>



    </div>







</div>





<div id="section-steps">

    Disclaimer: The content of the site is generated by members of Callitme.com. Members are not pre-screened by Callitme and Callitme.com takes no responsibility of the content on this site. Callitme and its owners, employees or affiliates are not responsible for any consequenses that may arise if you use this site. By using this website, you agree that you use the site at your own risk and assume all responsibility for the consequences and hold the owners or any affiliates of Callitme harmless.

</div>-->

 <div id="modal" class="popupContainer" style="display:none;">
		<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
          
            <div class="account-wall">
                <h1 class="text-center login-title">Sign in to Callitme </h1>
                <form class="form-signin" action="<?php echo url::base();?>login" method="post">
                       <input type="hidden" name="page1" value="https://accounts.google.com/o/oauth2/auth?client_id=<?php echo $gmail_client_id; ?>&redirect_uri=<?php echo $gmail_redirect_uri; ?>&scope=https://www.google.com/m8/feeds/&response_type=code">
                      <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                      <input type="password" class="form-control" placeholder="Password"  name="password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                <label class="checkbox pull-left" style="margin-left:10px;">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                
                </form>
                <br>
                
                 <a href="#" class="text-center new-account">Create an account </a>
            </div>
           
        </div>
    </div>
</div>
	</div>
<div id="modal1" class="popupContainer" style="display:none;">
		<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
          
            <div class="account-wall">
                <h1 class="text-center login-title">Sign in to Callitme </h1>
                <form class="form-signin" action="<?php echo url::base();?>login" method="post">
                       <input type="hidden" name="page1" value="https://login.live.com/oauth20_authorize.srf?client_id=<?php echo $hotmail_client_id; ?>&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri=<?php echo $hotmail_redirect_uri; ?>">
                      <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                      <input type="password" class="form-control" placeholder="Password"  name="password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                <label class="checkbox pull-left" style="margin-left:10px;">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                
                </form>
                <br>
                
                 <a href="#" class="text-center new-account">Create an account </a>
            </div>
           
        </div>
    </div>
</div>
</div>
    <div id="modal2" class="popupContainer" style="display:none;">
		<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
          
            <div class="account-wall">
                <h1 class="text-center login-title">Sign in to Callitme </h1>
                <form class="form-signin" action="<?php echo url::base();?>login" method="post">
                       <input type="hidden" name="page1" value="<?php echo url::base() . "contactapi/get_yahoo_list"; ?>">
                      <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                      <input type="password" class="form-control" placeholder="Password"  name="password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                <label class="checkbox pull-left" style="margin-left:10px;">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                
                </form>
                <br>
                
                 <a href="#" class="text-center new-account">Create an account </a>
            </div>
           
        </div>
    </div>
</div>
    
	</div>

 <script type="text/javascript" src="<?php echo  url::base();?>assets/popup/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo  url::base();?>assets/popup/js/jquery.leanModal.min.js"></script>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="" />
<style>
    .form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #00CAD4;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: white;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
</style>
 <script type="text/javascript">
	     $("#modal_trigger").leanModal({top : 150, overlay : 0.6, closeButton: ".modal_close" });
             $("#modal_trigger1").leanModal({top : 150, overlay : 0.6, closeButton: ".modal_close" });  
             $("#modal_trigger2").leanModal({top : 150, overlay : 0.6, closeButton: ".modal_close" });  
	$(function(){
		// Calling Login Form
		$("#login_form").click(function(){
			$(".social_login").hide();
			$(".user_login").show();
			return false;
		});

		// Calling Register Form
		$("#register_form").click(function(){
			$(".social_login").hide();
			$(".user_register").show();
			$(".header_title").text('Register');
			return false;
		});

		// Going back to Social Forms
		$(".back_btn").click(function(){
			$(".user_login").hide();
			$(".user_register").hide();
			$(".social_login").show();
			$(".header_title").text('Login');
			return false;
		});

	})
</script>

