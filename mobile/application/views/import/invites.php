<div class="row" style="padding-top: 15px;margin: 1px;">

    <div class="container">
        <form action="<?php echo url::base()."import/send_invites"?>" method="post" class="contactimporter-form">
            <fieldset class="fieldset">
                <p style="font-size: 17px;font-weight: 400;text-align: center;">Friends not registered on Amygoz</p>
        
                <div class="row" style="background: blanchedalmond;">
                    <div class="success">
                        <div class="container" style="font-size: 18px;">
                            <label class="checkbox">
                                <input type="checkbox" id="selectall"> <b>Select All</b>
                            </label>
                        </div>
                        <div class="container"></div>
                    </div>
                    <tr>

                        <?php $count = 1;?>
                        <?php foreach($invites as $user) { ?>
                            <div class="container">
                                <label class="checkbox">
                                    <input name="contacts[]" value="<?php echo $user;?>" type="checkbox" 
                                    class="contacts-chkbox"><?php echo $user;?>
                                </label>
                            </div>

                            <?php if($count%2 == 0) { ?>
                                </tr><tr>
                            <?php } ?>
                        <?php $count++; } ?>

                    </div>
                </div>
                
                <div>
                <div class="col-xs-12 text-center" style="margin-top: 28px;">
                    <button type="submit" class="btn" style="width: 100%; background: #fafafa;border: 1px solid #1f96a8;color: #2095a7;">Send Invite</button>
                    </div>
                    <p class="text-center">or</p>
                    <div class="col-xs-12 text-center" style="margin-bottom: 25px;">
                    <a href="<?php echo url::base().'import'; ?>">Skip this step >></a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

</div>