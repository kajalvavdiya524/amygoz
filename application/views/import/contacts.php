<?php $session_user = Auth::instance()->get_user();?>
<div class="profile-details">

    <div class="friends-block">
    
        <form action="<?php echo url::base()."import/send_requests"?>" method="post" class="contactimporter-form">
            <input type="hidden" name="skip_url" value="<?php echo $skip_url; ?>" />
            
            <fieldset class="fieldset">
                <legend style="margin-bottom:0px;color:#096369;">Friends Already on Callitme</legend>

                <?php if(!empty($already)) { ?>
                    <table class="table contact-table">
                        <tr class="success">
                            <td style="width: 50%; font-weight: bold;">
                                <label class="checkbox">
                                    <input type="checkbox" id="selectall"> <b>Select All</b>
                                </label>
                            </td>
                            <td style="width: 50%; font-weight: bold;text-align:right;"></td>
                        </tr>
                        <tr>
                            <?php $count = 1;?>
                            <?php foreach($already as $user) { ?>
                                <td>
                                    <div class="post friend">

                                        <div class="user-img pull-left">

                                            <input type="checkbox" name="contacts[]" value="<?php echo $user->username; ?>" 
                                                class="contacts-chkbox pull-left" style="margin-right:10px;">


                                            <a href="<?php echo url::base().$user->username; ?>">
                                                <?php 
                                                $photo = $user->photo->profile_pic_m;
                                                $user_image = file_exists("mobile/upload/" .$photo);
                                                $user_image1 = file_exists("upload/" .$photo);
                                                if(!empty($photo) && $user_image) { ?>
                                                    <img src="<?php echo url::base()."mobile/upload/".$user->photo->profile_pic_m;?>" class="img-rounded pull-left">
                                                <?php }
                                                else if(!empty($photo) && $user_image1) { ?>
                                                    <img src="<?php echo url::base()."upload/".$user->photo->profile_pic_m;?>" class="img-rounded pull-left">
                                                <?php } else { ?>
                                                    <img src="<?php echo url::base()."img/no_image_m.png";?>" class="img-rounded pull-left">
                                                <?php } ?>
                                            </a>
                                        </div>

                                        <div class="post-content">
                                            <div class="post-title">
                                                <strong>
                                                    <a href="<?php echo url::base().$user->username; ?>">
                                                        <?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>
                                                    </a>
                                                </strong>
                                            </div>
                                            
                                            <div class="post-matter collapse-description collapseable in">
                                                <p>
                                                    <?php
                                                        $details = array();
                                                        if(!empty($user->user_detail->location)) {
                                                            $details[] = $user->user_detail->location;
                                                        }
                                                        
                                                        if(!empty($user->user_detail->sex)) {
                                                            $details[] = $user->user_detail->sex;
                                                        }
                                                        
                                                        if(!empty($user->user_detail->phase_of_life)) {
                                                            $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                                            $details[] = $phase_of_life[$user->user_detail->phase_of_life];
                                                        }
                                                        
                                                        echo implode(', ', $details);
                                                    ?>
                                                </p>
                                                
                                            </div>
                                        </div>
                                        
                                        <div style="clear:right;"></div>

                                    </div>
                                </td>

                                <?php if($count%2 == 0) { ?>
                            </tr>
                            <tr>
                                <?php } ?>

                            <?php $count++; } ?>
                        </tr>
                    </table>
                <?php } else { ?>
                
                <h5>We couldn’t find your friends on Callitme. You can skip this step and invite your friends in next step</h5>
                
                <?php } ?>
            
                <div>
                    <?php if(!empty($already)) { ?>
                        <button type="submit" class="btn btn-long btn-secondary">Send Friend Request</button>
                        or
                    <?php } ?>
                    <a href="<?php echo $skip_url; ?>">Skip this step >></a>
                </div>
            
            </fieldset>
        </form>

    </div>

</div>