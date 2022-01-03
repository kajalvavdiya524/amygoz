<div class="container" style="padding-top: 47px;padding-bottom: 47px;">

    <div class="register-step-box">
        <div class="">
            <div class="">
                <h4>
                    Final Step - Find your friends already on Callitme
                </h4>
            </div>
            <div class="clearfix"></div>
            <div class="info" style="padding-top:20px;">
                
                <div class="row text-center">
                    <h4>See who you already know in Callitme</h4>

                    <h5>Import your email contacts</h5>

                    <?php 
                        $gmail_client_id = Kohana::$config->load('contact')->get('gmail_client_id');
                        $gmail_redirect_uri = Kohana::$config->load('contact')->get('gmail_redirect_uri');
                    ?>
                    <div class="col-xs-12">
                    <a href="https://accounts.google.com/o/oauth2/auth?client_id=<?php echo $gmail_client_id;?>&redirect_uri=<?php echo $gmail_redirect_uri;?>&scope=https://www.google.com/m8/feeds/&response_type=code">
                        <img class="img-responsive" src="<?php echo url::base()."img/gmail.png";?>" style="margin: 0px auto;" />
                    </a>
                </div>
                    <div class="col-xs-12" style="margin-top: 11px;">
                    <a href="https://login.live.com/oauth20_authorize.srf?client_id=00000000440F8B2B&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri=http://p1.Callitme.com/contactapi/apiget_hotmail">
                        <img class="img-responsive" src="<?php echo url::base()."img/hotmail.png";?>" style="margin: 0px auto;" />
                    </a>
                     </div>
                    <div class="col-xs-12" style="margin-top: 11px;">
                    <a href="<?php echo url::base()."contactapi/get_yahoo_list";?>">
                        <img class="img-responsive" src="<?php echo url::base()."img/yahoo.png";?>" style="margin: 0px auto;" />
                    </a>
                    </div>
                    
                    <div class="clearfix"></div>
                    
                </div>
                <div class="col-xs-12 text-center" style="margin-top: 25px;">
                <a href="<?php echo url::base().'pages/skip_step'; ?>" style="color: #0c0c0c;font-size: 18px !important;font-weight: 500;">Skip this step >></a>
                </div>
            </div>
        </div>
    </div>

</div>