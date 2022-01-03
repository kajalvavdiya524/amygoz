<div class="login-box">
    <div class="bubble shadow">
        <div class="ribbion full shadow">
            <h2>Reset Password</h2>
        </div>
        <div class="triangle-l"></div>
        <div class="triangle-r"></div>

        <div class="info">
            <?php if(Session::instance()->get('error')) {?>
                <div class="alert alert-error">
                   <strong>ERROR!</strong>
                   <?php echo Session::instance()->get_once('errorrr');?>
                </div>
            <?php } ?>
            
            <?php if(Session::instance()->get('success')) {?>
                <div class="alert alert-success">
                   <strong>SUCCESS </strong>
                   <?php echo Session::instance()->get_once('success');?>
                </div>
            <?php } ?>
            
            <form role="form" class="validate-form" method="post">
                <div class="form-group">
                    <label class="control-label" for="password">New Password:</label>
                    <input class="required form-control" id="password" type="password" name="password">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="password_confirm">Confirm New Password:</label>
                    <input class="required form-control" id="password_confirm" type="password" name="password_confirm">
                </div>
                
                <button type="submit" class="btn btn-secondary btn-transparent">Reset Password</button>
            </form>
        </div>
    </div>
</div>