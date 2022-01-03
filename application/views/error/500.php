<div class="container">
    <div class="row">
        <?php if(!Auth::instance()->logged_in()) { ?>
        <div class="col-sm-6 col-sm-offset-3 marTop50 marBottom50">
            <div class="title-wrap">
                <h3><strong>500 Error:</strong> Internal server error</h3>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="border">
                        <i class="fa fa-exclamation fa-5x"></i>
                        
                        <p>Something went wrong while we are processing your request. You can try the following:</p>

                        <ul>
                            <li>Reload / refresh the page.</li>
                            <li>Go back to the previous page.</li>
                        </ul>

                        <p>This incident is logged and we are already notified about this problem. 
                        We will trace the cause of this problem.</p>

                        <p>For the mean time, you may want to go to the main page.</p>

                        <p><a href="<?php echo URL::site('/', true) ?>">If you wanted to go to the main page, click here.</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="col-sm-6 col-sm-offset-3 marTop50 marBottom50">
            <div class="title-wrap">
                <h3><strong>500 Error:</strong> Internal server error</h3>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="border">
                        <i class="fa fa-exclamation fa-5x"></i>
                        
                        <p>Something went wrong while we are processing your request. You can try the following:</p>

                        <ul>
                            <li>Reload / refresh the page.</li>
                            <li>Go back to the previous page.</li>
                        </ul>

                        <p>This incident is logged and we are already notified about this problem. 
                        We will trace the cause of this problem.</p>

                        <p>For the mean time, you may want to go to the main page.</p>

                        <p><a href="<?php echo URL::site('/', true) ?>">If you wanted to go to the main page, click here.</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
