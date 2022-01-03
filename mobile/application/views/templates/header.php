
    <link rel='shortcut icon' href='<?php echo url::base(); ?>img/favicon.ico' type='image/x-icon'/>
    <div class="container header" style="border-bottom: 1px solid #a8a8a8;padding: 6px 0px 10px 0px;">
            <div class="col-xs-6">
                <a class="logo" href="<?php echo url::base(); ?>">
                    <img class="img-responsive" src="<?php echo url::base(); ?>img/amygoz.png" alt="Amygoz Logo" style="position: relative; top: 6px; width: 130px;padding: 2px 8px;"/>
                </a>
            </div>
            <?php if (!Auth::instance()->logged_in()) { ?>
                <div class="col-xs-6 text-right" style="margin-top: 10px;">
                    <p class="pull-right">
                            <a class="" href="<?php echo url::base() . 'login'; ?>" style="color: black;font-size: 15px;font-weight: 600;">Login</a>
<!--                             | 
                            <a class="" href="<?php echo url::base() . "register"; ?>" style="color: black;font-size: 15px;font-weight: 600;">Register</a> -->
                        </p>
                            <!--
                            | 
                            <a href="#"><i class="fa fa-facebook"></i> Sign up with Facebook</a>--> 
                    </div>
                    <!-- /.header-login -->
                </div>        
            <?php } ?>
        </div>
