<section class="default-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger alert-labeled hb-mt-15 ">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                    </button>
                    <div class="alert-labeled-row text-center">
                       
                        <p class="alert-body alert-body-right alert-labelled-cell">
                           <span class="alert-label alert-label-left alert-labelled-cell">
                            <i class="glyphicon glyphicon-info-sign"></i>
                        </span>This is not valid username. Please search with name!!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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



                                <a href="https://accounts.google.com/o/oauth2/auth?client_id=<?php echo $gmail_client_id; ?>&redirect_uri=<?php echo $gmail_redirect_uri; ?>&scope=https://www.google.com/m8/feeds/&response_type=code">

                                    <img src="<?php echo url::base() . "img/gmail.png"; ?>" class="center-block hb-mt-20" />

                                </a>

                            </div>

                            <div class="col-sm-4">

                                <?php

                                $hotmail_client_id = Kohana::$config->load('contact')->get('hotmail_client_id');

                                $hotmail_redirect_uri = Kohana::$config->load('contact')->get('hotmail_redirect_uri');

                                ?>

                                <a href="https://login.live.com/oauth20_authorize.srf?client_id=<?php echo $hotmail_client_id; ?>&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri=<?php echo $hotmail_redirect_uri; ?>">

                                    <img src="<?php echo url::base() . "img/hotmail.png"; ?>" class="center-block" />

                                </a>

                            </div>

                            <div class="col-sm-4">

                                <a href="<?php echo url::base() . "contactapi/get_yahoo_list"; ?>">

                                    <img src="<?php echo url::base() . "img/yahoo.png"; ?>" class="center-block hb-mt-30" />

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



