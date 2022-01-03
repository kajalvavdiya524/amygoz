<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 marTop50 marBottom50">
            <div class="text-center marBottom50">
                <h3>Log in to your account</h3>
            </div>
            
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="border">
                        <?php if (isset($msg)) { ?>
                            <div class="alert alert-danger">
                                <strong>ERROR!</strong>
                                <?php echo $msg; ?>
                            </div>
                        <?php } ?>
                        <form role="form" class="validate-form" method="post">
                            <!-- <input type="hidden" name="page" value="<?php echo $page;?>"> remove by pchauhan 21 july -->
                            <div class="form-group">
                                <input type="email" class="required email form-control input-lg" id="email" value="<?php echo Request::current()->post('email'); ?>" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="required form-control input-lg" id="password" value="<?php echo Request::current()->post('password'); ?>" name="password" placeholder="Password">
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-default btn-lg">Sign in</button>
                                </div>
                                <div class="col-sm-9">
                                    <p class="pull-right text-right marTop10">
                                        <a href="<?php echo url::base()."pages/forgot_password";?>" class="dis-block">Forgot Password?</a>
                                        <a href="<?php echo url::base()."pages/resend_link";?>" class="dis-block">Resend Activation Mail?</a>
                                    </p>
                                </div>
                            </div>                            
                        </form>  
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>