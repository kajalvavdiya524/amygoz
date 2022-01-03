<div class="container">

    <div class="register-step-box">
        <div class="bubble shadow">

            <div class="ribbion shadow">
                <h2>
                    Final Step - Find your friends already in Amygoz
                </h2>
            </div>
            <div class="triangle-l"></div>
            
            <div class="clearfix"></div>
            <div class="info" style="min-height:450px;">
                
                <div class="step4-box" style="padding-left: 0px; width: 450px; margin: 50px auto 110px;">
                    <h3>See who you already know in Amygoz</h3>

                    <h4>Import your email contacts</h4>

                    <?php 
                        $gmail_client_id = Kohana::$config->load('contact')->get('gmail_client_id');
                        $gmail_redirect_uri = Kohana::$config->load('contact')->get('gmail_redirect_uri');
                    ?>

                    <a href="https://accounts.google.com/o/oauth2/auth?client_id=<?php echo $gmail_client_id;?>&redirect_uri=<?php echo $gmail_redirect_uri;?>&scope=https://www.google.com/m8/feeds/&response_type=code">
                        <img src="<?php echo url::base()."img/gmail.png";?>" />
                    </a>

                    <a href="https://login.live.com/oauth20_authorize.srf?client_id=00000000440F8B2B&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri=http://p1.Callitme.com/contactapi/apiget_hotmail">
                        <img src="<?php echo url::base()."img/hotmail.png";?>" />
                    </a>
                    
                    <a href="<?php echo url::base()."contactapi/get_yahoo_list";?>">
                        <img src="<?php echo url::base()."img/yahoo.png";?>" />
                    </a>
                    
                    <div class="clearfix"></div>
                    
                </div>
                <a href="<?php echo url::base().'pages/skip_step'; ?>" class="pull-right">Skip this step >></a>
            </div>
        </div>
    </div>

</div>