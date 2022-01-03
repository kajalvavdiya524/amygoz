
<!--Added by Ash-->

<form class="form-horizontal validate-form" method="post">
    <fieldset>
        
        <legend>Edit Your Account Details</legend>
        
        <?php if($member->user->new_email) {?>
            <div class="alert">
                A Confirmation Mail has been sent to your requested email address (i.e <?php echo $member->user->new_email; ?>).
                Please click on the link provided in the mail to complete the process.
            </div>
        <?php } ?>
        
        <?php if(Session::instance()->get('error')) {?>
            <div class="alert alert-error">
               <strong>Error !</strong>
                <?php $errors = Session::instance()->get_once('error');
                    foreach($errors as $err_val) {
                ?>
                    <?php echo $err_val;?><br />
                <?php
                    }
                ?>
            </div>
        <?php } ?>
        
        <?php if(Session::instance()->get('username_success')) {?>
            <div class="alert alert-success">
               <strong>SUCCESS </strong>
               <?php echo Session::instance()->get_once('username_success');?>
            </div>
        <?php } else if(Session::instance()->get('username_error')) { ?>
            <div class="alert alert-error">
               <strong>Error !</strong>
                <?php echo Session::instance()->get_once('username_error');?>
            </div>
        <?php } ?>

        <?php if(Session::instance()->get('email_error')){ ?>
            <div class="alert alert-error">
               <strong>Error !</strong>
                <?php echo Session::instance()->get_once('email_error');?>
            </div>
        <?php } ?>

        <div class="control-group">
            <label class="control-label" for="email">Email:</label>
            <div class="controls">
                <input class="input-xlarge required email uniqueEmail" id="email" type="text" name="email" value="<?php echo $member->user->email;?>">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="username">Username:</label>
            <div class="controls">
                <input class="input-xlarge required uniqueUsername usernameRegex" maxlength="15" id="username" type="text" name="username" value="<?php echo $member->user->username;?>">
            </div>
        </div>
        
        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </fieldset>
</form>

<!-- <div class="form-actions">
    <?php if(!$member->is_deleted) { ?>
        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#deactivateModal">Deactivate My Account</button>
    <?php } else { ?>
        <p class="text-error">Your account has been 'Deactivated'. Please login again with in 30 days to 'Reactivate' your account or contact our support team.</p>
    <?php } ?>
</div>

<?php if(!$member->is_deleted) { ?>
<div id="deactivateModal" class="modal hide fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body padTop20">
        <div class="alert">
            <strong>Warning!</strong> Are you sure, you want to 'Deactivate' your account.
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <form style="display:inline;" action="<?php echo url::base()."profile/deactivate"?>" method="post">
            <input type="hidden" name="confirm" value="ok" />
            <button id="deactivate-btn" type="submit" class="btn btn-primary">Deactivate My Account</button>
        </form>
    </div>
</div> -->
<?php } ?>