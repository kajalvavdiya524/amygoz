<div class="container verpal-shadd" style="padding-top: 50px;padding-bottom: 100px;">
<div class="col-xs-12 text-center">
<p class="fs-title" style="font-weight: 800 !important;font-size: 24px !important;text-transform:inherit;color: #0e0d0d;">
Login to your account
</p>
<!-- <img class="img-responsive" src="https://m.callitme.com/img/logo1.png" alt="callitme logo" style="width: 180px;margin: 0px auto;"> -->
</div>
    <div class="row">
        <div class="col-xs-12" style="padding-top: 40px;">
         <?php if (isset($msg)) { ?>
           <div class="alert alert-danger">
              <strong>ERROR!</strong>
                  <?php echo $msg; ?>
                     </div>
                      <?php } ?>
          <form role="form" class="validate-form" method="post">
               <!-- <input type="hidden" name="page" value="<?php //echo $page;?>"> remove by pchauhan 21 july -->
              <div class="form-group">
                 <input type="email" class="required email form-control rapper-soul" id="email" value="<?php echo Request::current()->post('email'); ?>" name="email" placeholder="Email address" style="height: 45px;font-size:17px;">
                       </div>
                   <div class="form-group">
                 <input type="password" class="required form-control rapper-soul" id="password" value="<?php echo Request::current()->post('password'); ?>" name="password" placeholder="Password" style="height: 45px;font-size:17px;">
                       </div>
                            <div class="row">
                                <div class="col-sm-12" style="margin-bottom: 35px;margin-top: 25px;">
                                    <button type="submit" class="btn btn-default no-bg-image secondary-bg btn-block white-text" style="width: auto;background: #FF5A5F; border: 40px !important;color: #FFF;letter-spacing:1px;font-weight: 600;font-size:17px;border-radius: 40px;padding: 9px 75px;box-shadow: 0px 0px 8px 0px #ff5a5f;">Sign in
                                    </button>
                                </div>
                                </div>
                                <div class="row text-right">
                                <div class="col-xs-12">
                                    <p>
                                        <a href="<?php echo url::base()."pages/forgot_password";?>" class="dis-block" style="color: #666;">Forgot Password?
                                        </a>
                                     </p>
                                </div>
                                <div class="col-xs-12">
                                <p>   
                                        <a href="<?php echo url::base()."pages/resend_link";?>" class="dis-block" style="color: #666;">Resend Activation Mail?
                                        </a>
                                    </p>
                            </div>                              
                    
                    </form> 
                </div>
            </div>
            </div>