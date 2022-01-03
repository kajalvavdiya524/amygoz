<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?php $session_user = Auth::instance()->get_user();?>
<div class="scroll-sec">
    <div class="">

            <h4><?php echo $user->user_detail->first_name ."'s Friends"; ?></h4>
            <?php if($session_user->id !== $user->id) { 
                if($user->user_detail->friends_private == 0 ) { ?>
            <div class="friends">
            
                <?php $friends = $user->friends->find_all()->as_array(); 
                    if(Request::current()->query('mutual')) {
                        $friends = $user->mutual_friends($session_user);
                    }                    
                ?>
                
                <?php foreach($friends as $friend) { ?>
                    <div class="post friend text-center" style="border-bottom: 1px solid #cfcfcf;">
                        <div class="col-xs-12">
                         <center>
                            <div id="imagePreview">
                            <a href="<?php echo url::base().$friend->username; ?>">
                                <?php if($friend->photo->profile_pic_s) { ?>
                        <img src="<?php echo url::base()."upload/".$friend->photo->profile_pic;?>" height="100%">
                                <?php } else { ?>
                                    <img src="<?php echo url::base()."img/no_image_s.png";?>" height="100%">
                                <?php } ?>
                            </a>
                        </div>
                        </center>
                        </div>
                        
                        <div class="col-xs-12">
                        <div class="post-content">
                            <div class="post-title" style="padding: 0px;">
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
                        </div>

                            <div class="friend-actions request_action">
                            <?php echo View::factory('members/friend_button', array('user' => $friend, 'block' => true)); ?>
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
                    <div class="post friend text-center" style="border-bottom: 1px solid #cfcfcf;">
                        <div class="col-xs-12">
                         <center>
                            <div id="imagePreview">
                            <a href="<?php echo url::base().$friend->username; ?>">
                                <?php if($friend->photo->profile_pic_s) { ?>
                        <img src="<?php echo url::base()."upload/".$friend->photo->profile_pic_s;?>" height="100%">
                                <?php } else { ?>
                                    <img src="<?php echo url::base()."img/no_image_s.png";?>" height="100%">
                                <?php } ?>
                            </a>
                        </div>
                        </center>
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
                         
                        <div class="friend-actions request_action">
                            <?php echo View::factory('members/friend_button', array('user' => $friend, 'block' => true)); ?>
                        </div>

                        <div style="clear:both;"></div>

                    </div>
                <?php } ?>
                
            </div>

           <?php } ?>
    </div>
</div>

<style>
#imagePreview {
    width: 100px;
    height: 100px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-top: 12px;
    position: relative;
    top: -7px;
    overflow: hidden;
    background-color: white;
}
</style>