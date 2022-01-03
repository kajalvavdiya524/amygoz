<?php if(!empty($users)) { ?>
    <?php foreach($users as $user) { ?>
        <?php $user = $user->by; ?>

        <?php if($user->is_blocked !== '0') { continue; } ?>
        <div class="post">

            <div class="user-img pull-left hb-mr-10">
                <a href="<?php echo url::base().$user->username; ?>">
                    <?php 
                        $photo = $user->photo->profile_pic_m;
                        $url = '';
                        if(!empty($photo) && file_exists("mobile/upload/" .$photo)) {
                            $url = url::base()."mobile/upload/".$photo;
                        } else if(!empty($photo) && file_exists("upload/" .$photo)) {
                            $url = url::base()."upload/".$photo;
                        }
                    ?>
                    <?php if(!empty($url)) { ?>
                        <img src="<?php echo $url;?>" width="30" height="30">
                    <?php } else { ?>
                        <div id="inset" class="xs hb-mt-0">
                            <h1>
                                <?php echo $user->user_detail->get_no_image_name(); ?>
                            </h1>
                        </div>
                    <?php } ?>
                </a>
            </div>

            <div class="post-content">
                <div class="post-title">
                    <a href="<?php echo url::base().$user->username; ?>">
                        <?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>
                    </a>
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

            <div class="clearfix"></div>

        </div>
    <?php } ?>

<?php } else { ?>
    <div class="post friend" style="width:160px;">
        <p class="text-center" style="color : black;">No user.</p>
    </div>
<?php } ?>