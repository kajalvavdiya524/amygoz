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

            <h3 class="had-pad-1">See who you know here</h3>

            <div class="search-form">

                  <form class="form-inline" method="post" action="<?php echo URL::base(); ?>pages/search_results">

                    <div class="form-group">

                        <input type="text" class="form-control" name="first_name" id="firstname" placeholder="First Name">

                    </div>

                    <div class="form-group">

                        <input type="text" class="form-control"  name="last_name" id="lasttname" placeholder="Last Name">

                    </div>

                    <button type="submit" class="btn btn-pad-1">Search</button>

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
<style>
.btn-pad-1
{
    background: rgba(250, 250, 250, 0.06);
    border: 1px solid #ff2a7f;
    color: #ffffff;
    width: 100%;
}
.had-pad-1
{
    color: #fff;
}
</style>