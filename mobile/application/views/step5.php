<div class="container">

    <div class="register-step-box">
        <div class="bubble shadow">

            <div class="ribbion shadow">
                <h2>
                    Step 5. People that have invited you.
                </h2>
            </div>
            <div class="triangle-l"></div>
            
            <div class="clearfix"></div>
            <div class="info" style="min-height:450px;">
                
                <div class="step4-box friends" style="padding: 0px 50px;min-height:400px;">
                    <?php if(!empty($invites)) { ?>
                        <?php foreach($invites as $invite) { ?>
                            <?php $user = $invite->by; ?>
                            <div class="post friend">

                                <div class="user-img pull-left">
                                    <?php if($user->photo->profile_pic_m) { ?>
                                        <img src="<?php echo url::base()."upload/".$user->photo->profile_pic_m;?>" class="img-rounded pull-left">
                                    <?php } else { ?>
                                        <img src="<?php echo url::base()."img/no_image_m.png";?>" class="img-rounded pull-left">
                                    <?php } ?>
                                </div>

                                <div class="friend-actions request_action pull-right">
                                    <?php echo View::factory('members/friend_button', array('user' => $user, 'block' => true)); ?>
                                </div>

                                <div class="post-content">
                                    <div class="post-title">
                                        <strong>
                                            <?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>
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
                        <?php } ?>
                    <?php } ?>
                </div>
                <a href="<?php echo url::base().'pages/skip_step'; ?>" class="pull-right" style="color: #0c0c0c;font-size: 18px !important;font-weight: 500;">Skip this step >></a>
            </div>
        </div>
    </div>

</div>