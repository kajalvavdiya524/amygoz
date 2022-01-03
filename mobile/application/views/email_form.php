<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 marTop50 marBottom50">
            <div class="text-center marBottom50">
                <?php if(Request::current()->action() == 'forgot_password') { ?>
                    <h3>Forgot Password?</h3>
                <?php } else { ?>
                    <h3>Activation Link</h3>
                <?php } ?>
            </div>
            
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="border">
                        <?php if(isset($msg)) {?>
                            <div class="alert alert-danger">
                               <strong>ERROR!</strong>
                               <?php echo $msg;?>
                            </div>
                        <?php } else if(Session::instance()->get('success')) {?>
                            <div class="alert alert-success">
                               <strong>SUCCESS </strong>
                               <?php echo Session::instance()->get_once('success');?>
                            </div>
                        <?php } ?>

                        <form role="form" class="validate-form" method="post">
                            <div class="form-group">
                                <input type="email" class="required email form-control input-lg" id="email" name="email" placeholder="Enter email">
                            </div>

                            <button type="submit" class="btn btn-secondary btn-lg">Submit</button>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>