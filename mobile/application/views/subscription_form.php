<style>
.stripe-button-inner {
    margin-left:40% !important;
}
</style>
<fieldset>
    <legend>Subscription Details</legend>
    
    <?php if(Session::instance()->get('error')) {?>
        <div class="alert alert-error">
            <strong>Oops!</strong>
            <?php echo Session::instance()->get_once('error');?>
        </div>
    <?php } ?>
    
    <?php if(Session::instance()->get('success')) {?>
        <div class="alert alert-success">
           <strong>Great!</strong>
           <?php echo Session::instance()->get_once('success');?>
        </div>
    <?php } ?>
    
    <?php if(isset($member->user->payment_expires)) { ?>
        
        <?php if($member->user->payment_expires > date("Y-m-d H:i:s")) { ?>
            <div class="alert alert-info padTop20">
                <strong></strong>
                You can feature your profile on our Home page, so that anyone who visits our website will see you profile first.
                
                <div class="textCenter padTop20">
                    <a href="<?php echo url::base();?>profile/feature" class="pay-btn btn btn-primary">Feature my profile in HomePage</a>
                </div>
            </div>
        <?php } ?>
    
        <div class="padTop20 textCenter">
            <p>
                <label><strong>Your last payment was made on:</strong></label>
                
                <?php echo isset($member->user->last_payment) ? date('g:ia \o\n l jS F Y', strtotime($member->user->last_payment)) : "--";?>
            </p>
            
            <p>
                <label><strong>Your subscription expires on:</strong></label>
                <?php echo date('g:ia \o\n l jS F Y', strtotime($member->user->payment_expires));?>
            </p>
        </div>
        
        <?php
            $today = strtotime('now');
            $expires = strtotime($member->user->payment_expires);
            $interval = $expires - $today;
            
            if($interval > 0) {
                $days = ceil($interval/(60*60*24));
                if($days < 10) {
        ?>
                    <div class="alert alert-block">
                        <strong>Warning!</strong>
                        Your Subscription will expire in <?php echo $days;?> days. Please Renew Now
                    </div>
        <?php   }
            } else {
                $pos = ceil($interval*(-1)/(60*60*24));
        ?>
                <div class="alert alert-error">
                   <strong>Error !</strong>
                   Your Subscription has already expired <?php echo $pos;?> days before. Please renew your subscription to continue using Meri Bahu.
                </div>
      <?php } ?>
        
        <div class="form-actions textCenter">
            <a href="<?php echo url::base();?>profile/monthly_subscription" class="pay-btn btn btn-primary">Renew Now</a>
        </div>
    
    <?php } else { ?>
        <div class="alert alert-error">
           Please subscribe to use the features of this website.
        </div>
        
        <div class="form-actions textCenter">
            <a href="<?php echo url::base();?>profile/monthly_subscription" class="pay-btn btn btn-primary">Subscribe Now</a>
        </div>
        
        <p>If you are unable to pay for your membership, please click on the "Waive My Fee" button below.</p>
        <div class="textCenter">
            <a class="btn btn-primary" href="<?php echo url::base();?>pages/about_us?page=contact">Waive My Fee</a>
        </div>
    <?php } ?>
    
</fieldset>