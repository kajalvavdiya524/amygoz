<?php if(!empty($requests)) { ?>
    
    <?php foreach($requests as $request) { 
        if($request->user->is_blocked == 0){ ?>
        <div class="post friend friends_for_noti hb-mb-5">

            <div class="user-img pull-left hb-mr-10">
                <a href="<?php echo url::base().$request->user->username; ?>">
                    <?php if($request->user->photo->profile_pic_m) { ?>
                    <img src="<?php echo url::base()."upload/".$request->user->photo->profile_pic_m;?>" width="30" height="30">
                    <?php } else { ?>
                        <div id="inset" class="xxs hb-mt-0">
                            <h1>
                                <?php echo $request->user->user_detail->first_name[0] . $request->user->user_detail->last_name[0]; ?>
                            </h1>
                            <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                        </div>
                    <?php } ?>
                </a>
            </div>
            
            <div class="request_action pull-right">
                <form class="respond-friend-popover dis-inline " action="<?php echo url::base()."friends/accept_friend";?>" method="post">
                    <input type="hidden" name="friend_id" value="<?php echo $request->user->id;?>"/>
                    <button type="submit" class="btn btn-secondary btn-xs">Accept</button>
                </form>
                <form class="respond-friend-popover dis-inline " action="<?php echo url::base()."friends/reject_request";?>" method="post">
                    <input type="hidden" name="friend_id" value="<?php echo $request->user->id;?>"/>
                    <button type="submit" class="btn btn-primary btn-xs">Reject</button>
                </form>
            </div>

            <div class="post-content">
                <div class="post-title">
                    <a href="<?php echo url::base().$request->user->username; ?>">
                        <?php echo $request->user->user_detail->first_name." ".$request->user->user_detail->last_name; ?>
                    </a>
                </div>
                
                <div class="post-matter collapse-description collapseable in">
                    <p>
                        <?php
                            $details = array();
                            if(!empty($request->user->user_detail->location)) {
                                $details[] = $request->user->user_detail->location;
                            }
                            
                            if(!empty($request->user->user_detail->sex)) {
                                $details[] = $request->user->user_detail->sex;
                            }
                            
                            if(!empty($request->user->user_detail->phase_of_life)) {
                                $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                $details[] = $phase_of_life[$request->user->user_detail->phase_of_life];
                            }
                            
                            echo implode(', ', $details);
                        ?>
                    </p>
                    
                </div>
            </div>
            
            
            
            <div class="clearfix"></div>

        </div>
    <?php }
    } ?>
    
    <?php if(count($requests) === 5) { ?>
        <div class="view_more">
            <a href="<?php echo url::base()."friends/requests";?>">View More</a>
        </div>
    <?php } ?>

<?php } else { ?>
    <div class="post friend" style="width:160px;">
        <p class="text-center" style="color : black;">No pending friend request.</p>
    </div>
<?php } ?>