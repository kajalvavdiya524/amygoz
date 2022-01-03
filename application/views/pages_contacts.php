<div class="container">

    <div class="register-step-box">
        <div class="bubble shadow">

            <div class="ribbion shadow">
                <h2>
                    Step 4. Find your contacts already on Callitme
                </h2>
            </div>
            <div class="triangle-l"></div>
            
            <div class="clearfix"></div>
            <div class="info" style="min-height:450px;">
                
                <div class="step4-box">
                    
                    <form action="<?php echo url::base()."import/send_requests"?>" method="post" class="contactimporter-form">
                        <input type="hidden" name="skip_url" value="<?php echo $skip_url; ?>" />
                        
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
                                            <input type="checkbox" name="contacts[]" value="<?php echo $user->username; ?>" class="contacts-chkbox pull-left" style="margin-right:10px;">

                                            <?php 
                                                $photo = $u$user->photo->profile_pic_s;
                                                $photo_image = file_exists("mobile/upload/" .$photo);
                                                $photo_image1 = file_exists("upload/" .$photo);
                                            if(!empty($photo) && $photo_image) { ?>
                                                <img src="<?php echo url::base()."mobile/upload/".$user->photo->profile_pic_s;?>" alt="<?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>" class="img-rounded pull-left">
                                            <?php }
                                            else if(!empty($photo) && $photo_image1) { ?>
                                                <img src="<?php echo url::base()."upload/".$user->photo->profile_pic_s;?>" alt="<?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>" class="img-rounded pull-left">
                                            <?php } else { ?>
                                                <img src="<?php echo url::base()."img/no_image_m.png";?>" alt ="<?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>" class="img-rounded pull-left">
                                            <?php } ?>
                                            
                                            <div class="contact-detail pull-left" style="margin-left:15px;">
                                                <h5>
                                                    <?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>
                                                </h5>
                                                
                                                <p>
                                                    <?php echo $user->user_detail->location; ?>
                                                </p>
                                            </div>
                                        </td>
                                        
                                        <?php if($count%2 == 0) { ?>
                                            </tr><tr>
                                        <?php } ?>
                                        
                                        
                                    <?php $count++; } ?>
                                </tr>
                            </table>
                        <?php } else { ?>
                            <h5>We couldn’t find any of your contacts on Callitme. You can skip this step and invite your friends in next step.</h5>
                        <?php } ?>

                        <div>
                            <?php if(!empty($already)) { ?>
                                <button type="submit" class="btn btn-long btn-secondary">Add contact</button>
                                or
                            <?php } ?>
                            <a href="<?php echo $skip_url; ?>">Skip this step >></a>
                        </div>
                    
                    </form>

                    <div class="clearfix"></div>
                    
                </div>
            </div>
        </div>
    </div>

</div>