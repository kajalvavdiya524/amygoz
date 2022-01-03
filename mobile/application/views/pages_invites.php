<div class="container">

    <div class="register-step-box">
        <div class="bubble shadow">

            <div class="ribbion shadow">
                <h2>
                    Step 4. Find your friends already on Callitme
                </h2>
            </div>
            <div class="triangle-l"></div>
            
            <div class="clearfix"></div>
            <div class="info" style="min-height:450px;">
                
                <div class="step4-box">
                    <form action="<?php echo url::base()."import/send_invites"?>" method="post" class="contactimporter-form">
                        <table class="table contact-table">
                            <tr class="success">
                                <td style="width: 50%; font-weight: bold;">
                                    <label class="checkbox">
                                        <input type="checkbox" id="selectall"> <b>Select All</b>
                                    </label>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <?php $count = 1;?>
                                <?php foreach($invites as $user) { ?>
                                    <td>
                                        <label class="checkbox">
                                            <input name="contacts[]" value="<?php echo $user;?>" type="checkbox"  class="contacts-chkbox"><?php echo $user;?>
                                        </label>
                                    </td>

                                    <?php if($count%2 == 0) { ?>
                                        </tr><tr>
                                    <?php } ?>
                                <?php $count++; } ?>
                            </tr>
                        </table>
                        
                        <div>
                            <button type="submit" class="btn btn-long">Send Invite</button>
                            or
                            <a href="<?php echo url::base().'pages/skip_step'; ?>">Skip this step >></a>
                        </div>
                    
                    </form>
                    <div class="clearfix"></div>
                    
                </div>
            </div>
        </div>
    </div>

</div>