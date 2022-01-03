<div class="profile-details">

    <div class="friends-block">
        <form action="<?php echo url::base()."import/send_invites"?>" method="post" class="contactimporter-form">
            <fieldset class="fieldset">
                <legend style="margin-bottom:0px;color:#096369;">Friends not registered on Amygoz</legend>
        
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
                                    <input name="contacts[]" value="<?php echo $user;?>" type="checkbox" 
                                    class="contacts-chkbox"><?php echo $user;?>
                                </label>
                            </td>

                            <?php if($count%2 == 0) { ?>
                                </tr><tr>
                            <?php } ?>
                        <?php $count++; } ?>

                    </tr>
                </table>
                
                <div>
                    <button type="submit" class="btn btn-long btn-secondary">Send Invite</button>
                    or
                    <a href="<?php echo url::base().'import'; ?>">Skip this step >></a>
                </div>
            </fieldset>
        </form>
    </div>

</div>