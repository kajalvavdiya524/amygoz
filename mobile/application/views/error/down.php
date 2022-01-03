<div class="container">
    <div class="row">
        <?php if(!Auth::instance()->logged_in()) { ?>
        <div class="col-sm-6 col-sm-offset-3 marTop50 marBottom50">
            <div class="title-wrap">
                <h3><strong>Oops !!! Callitme website is too tired. It's taking a little break.</strong></h3>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="border">
                        <i class="fa fa-frown-o fa-5x"></i>
                        
                        <p><?php echo $error_message; ?></p>

                        <p>Please check back afterasad some time. </p>

                        <p>To go back to the previous page, click the Back button.</p>

                        <p><a href="<?php echo URL::site('/', true) ?>">If you wanted to go to the main page instead, click here.</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="col-sm-6 col-sm-offset-3 marTop50 marBottom50">
            <div class="title-wrap">
                <h3><strong>Oops !!! Page not found</strong></h3>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="border">
                        <i class="fa fa-frown-o fa-5x"></i>
                        
                        <p><?php echo $error_message; ?></p>

                        <p>Please check back after some time. </p>

                        <p>To go back to the previous page, click the Back button.</p>

                        <p><a href="<?php echo URL::site('/', true) ?>">If you wanted to go to the main page instead, click here.</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>