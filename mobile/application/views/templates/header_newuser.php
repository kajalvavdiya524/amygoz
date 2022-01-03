
    <link rel='shortcut icon' href='<?php echo url::base(); ?>img/callitme_fav.ico' type='image/x-icon'/>
    <div class="container header" style="background: #00bcd4;">
            <div class="col-xs-6">
                <a class="logo" href="<?php echo url::base(); ?>">
                    <img class="img-responsive" src="<?php echo url::base(); ?>img/logo1.png" alt="callitme logo" />
                </a>
            </div>
            <?php if (!Auth::instance()->logged_in()) { ?>
                <div class="col-xs-6 text-right" style="margin-top: 10px;">
                    <p class="pull-right">
                            <a class="white-text" href="<?php echo url::base() . 'login'; ?>">Login</a>
                            | 
                            <a class="white-text" href="<?php echo url::base() . "register"; ?>">Register</a>
                        </p>
                            <!--
                            | 
                            <a href="#"><i class="fa fa-facebook"></i> Sign up with Facebook</a>--> 
                    </div>
                    <!-- /.header-login -->
                </div>        
            <?php } ?>
        </div>
