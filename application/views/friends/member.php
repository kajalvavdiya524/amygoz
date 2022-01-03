<?php $session_user = Auth::instance()->get_user();?>

<div class="scroll-sec">
    <div class="friends-block">

        <fieldset class="fieldset">
            <legend><?php echo $user->user_detail->first_name ."'s Friends"; ?></legend>
            <?php if($session_user->id !== $user->id) { 
                if($user->user_detail->friends_private == 0 ) { ?>
            <div class="friends">
            
                <?php $friends = $user->friends->find_all()->as_array(); 
                    if(Request::current()->query('mutual')) {
                        $friends = $user->mutual_friends($session_user);
                    }                    
                ?>
                
                <?php foreach($friends as $friend) { ?>
                    <div class="post friend">

                        <div class="user-img pull-left">
                            <a href="<?php echo url::base().$friend->username; ?>">
                                <?php 
                                $photo = $friend->photo->profile_pic_s;
                                $fri_image = file_exists("mobile/upload/" .$photo);
                                $fri_image1 = file_exists("upload/" .$photo);
                                if(!empty($photo) && $fri_image) { ?>
                                    <img style="height:60px;width:60px;" src="<?php echo url::base()."mobile/upload/".$friend->photo->profile_pic_s;?>">
                                <?php } 
                                else if(!empty($photo) && $fri_image1) { ?>
                                    <img style="height:60px;width:60px;" src="<?php echo url::base()."upload/".$friend->photo->profile_pic_s;?>">
                                <?php } else { ?>
                                    <img src="<?php echo url::base()."img/no_image_s.png";?>">
                                <?php } ?>
                            </a>
                        </div>
                        
                        <div class="friend-actions request_action pull-right">
                            <?php echo View::factory('members/friend_button', array('user' => $friend, 'block' => true)); ?>
                        </div>

                        <div class="post-content">
                            <div class="post-title">
                                <strong>
                                    <a href="<?php echo url::base().$friend->username; ?>">
                                        <?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>
                                    </a>
                                </strong>
                            </div>
                            
                            <div class="post-matter collapse-description collapseable in">
                                <p>
                                <?php
                                    $details = array();
                                    if(!empty($friend->user_detail->location)) {
                                        $details[] = $friend->user_detail->location;
                                    }
                                    
                                    if(!empty($friend->user_detail->sex)) {
                                        $details[] = $friend->user_detail->sex;
                                    }
                                    
                                    if(!empty($friend->user_detail->phase_of_life)) {
                                        $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                        $details[] = $phase_of_life[$friend->user_detail->phase_of_life];
                                    }
                                    
                                    echo implode(', ', $details);
                                ?>
                            </p>
                            </div>
                        </div>
                        
                        
                        
                        <div style="clear:both;"></div>

                    </div>
                <?php } ?>
                
            </div>
            <?php } else{ ?>

            <div class="review-panel">
                                            <i class="fa fa-frown-o"></i>
                        <h4 style="text-align:center;">
                            Friend's list not made public.<br>
                        </h4>
                            
                </div>





            <?php }?>


            <?php }else{?>

                <div class="friends">
            
                <?php $friends = $user->friends->find_all()->as_array(); 
                    if(Request::current()->query('mutual')) {
                        $friends = $user->mutual_friends($session_user);
                    }                    
                ?>
                
                <?php foreach($friends as $friend) { ?>
                    <div class="post friend">

                        <div class="user-img pull-left">
                            <a href="<?php echo url::base().$friend->username; ?>">
                                <?php if($friend->photo->profile_pic_s) { ?>
                                    <img style="height:60px;width:60px;" src="<?php echo url::base()."upload/".$friend->photo->profile_pic_s;?>">
                                <?php } else { ?>
                                    <img src="<?php echo url::base()."img/no_image_s.png";?>">
                                <?php } ?>
                            </a>
                        </div>
                        
                        <div class="friend-actions request_action pull-right">
                            <?php echo View::factory('members/friend_button', array('user' => $friend, 'block' => true)); ?>
                        </div>

                        <div class="post-content">
                            <div class="post-title">
                                <strong>
                                    <a href="<?php echo url::base().$friend->username; ?>">
                                        <?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>
                                    </a>
                                </strong>
                            </div>
                            
                            <div class="post-matter collapse-description collapseable in">
                                <p>
                                <?php
                                    $details = array();
                                    if(!empty($friend->user_detail->location)) {
                                        $details[] = $friend->user_detail->location;
                                    }
                                    
                                    if(!empty($friend->user_detail->sex)) {
                                        $details[] = $friend->user_detail->sex;
                                    }
                                    
                                    if(!empty($friend->user_detail->phase_of_life)) {
                                        $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                        $details[] = $phase_of_life[$friend->user_detail->phase_of_life];
                                    }
                                    
                                    echo implode(', ', $details);
                                ?>
                            </p>
                            </div>
                        </div>
                        
                        
                        
                        <div style="clear:both;"></div>

                    </div>
                <?php } ?>
                
            </div>

           <?php } ?>
        </fieldset>

    </div>
</div>