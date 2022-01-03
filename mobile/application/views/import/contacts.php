<?php $session_user = Auth::instance()->get_user();?>
<div class="row" style="margin-top: 15px;margin: 1px;">

    <div class="container">
    
        <form action="<?php echo url::base()."import/send_requests"?>" method="post" class="contactimporter-form">
            <input type="hidden" name="skip_url" value="<?php echo $skip_url; ?>" />
            
            <fieldset class="fieldset">
                <p style="font-size: 17px;font-weight: 400;text-align: center;">Friends Already on Amygoz</p>

                <?php if(!empty($already)) { ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div style="width: 50%; font-weight: bold;">
                                <label class="checkbox">
                                    <input type="checkbox" id="selectall"><b>Select All</b>
                                </label>
                            </div>
                            <div style="width: 50%; font-weight: bold;text-align:right;"></div>
                        </div>
                        <div>
                            <?php $count = 1;?>
                            <?php foreach($already as $user) { ?>
                                </div>
                                    <div class="row" style="background: #1e97a9;padding: 10px 0px 10px 0px;">
                                        <div class="col-xs-3" style="position: relative;left:16px;">
                                            <input type="checkbox" name="contacts[]" value="<?php echo $user->username; ?>" 
                                                class="contacts-chkbox pull-left" style="margin-right:10px;right:10px;position: relative;top: -3px;left: 0px;">
                                            <a href="<?php echo url::base().$user->username; ?>">
                                                <?php if($user->photo->profile_pic_m) { ?>
                                                    <img src="<?php echo url::base()."upload/".$user->photo->profile_pic_m;?>" class="img-rounded pull-left">
                                                <?php } else { ?>
                                                    <img src="<?php echo url::base()."img/no_image_m.png";?>" class="img-rounded pull-left">
                                                <?php } ?>
                                            </a>
                                        </div>

                                        <div class="col-xs-9" style="position: relative;top:21px;">
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
                    </div>
                <?php } else { ?>
                
                <h5>We couldn’t find your friends on Amygoz. You can skip this step and invite your friends in next step</h5>
                
                <?php } ?>
            
                <div>
                    <?php if(!empty($already)) { ?>
                        <div class="col-xs-12 text-center" style="margin-top: 28px;">
                        <button type="submit" class="btn" style="width: 100%; background: #fafafa;border: 1px solid #1f96a8;color: #2095a7;">Send Friend Request</button>
                        </div>
                       <p class="text-center"> or</p>
                    <?php } ?>
                    <div class="col-xs-12 text-center">
                    <a href="<?php echo $skip_url; ?>">Skip this step >></a>
                    </div>
                </div>
            
            </fieldset>
        </form>

    </div>

</div>