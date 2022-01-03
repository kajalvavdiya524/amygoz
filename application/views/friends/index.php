<?php $session_user = Auth::instance()->get_user(); ?>

<div class="row">
    <div class="col-sm-4">
        <?php echo View::factory('friends/menu', array('submenu' => 'friends')); ?>
    </div>
    <div class="col-sm-8">
        <div class="friends-block hb-p-0">
            <div class="friends">
                <?php foreach ($session_user->friends->find_all()->as_array() as $friend) { ?>
                    <div class="post friend">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="user-img pull-left">
                                    <a href="<?php echo url::base() . $friend->username; ?>">
                                        <?php 
                                        $photo = $friend->photo->profile_pic_s;
                                        $fri_image = file_exists("mobile/upload/" .$photo);
                                        $fri_image1 = file_exists("upload/" .$photo);
                                        if (!empty($photo) && $fri_image) { ?>
                                            <img src="<?php echo url::base() . "mobile/upload/" . $friend->photo->profile_pic_s; ?>" width="50" height="50" alt="<?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name?>">
                                        <?php }
                                        else if (!empty($photo) && $fri_image1) { ?>
                                            <img src="<?php echo url::base() . "upload/" . $friend->photo->profile_pic_s; ?>" width="50" height="50" alt="<?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name?>">
                                        <?php } else { ?>
                                            <div id="inset" class="xs hb-mt-0">
                                                <h1>
                                                    <?php echo $friend->user_detail->get_no_image_name(); ?>
                                                </h1>
                                                <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                            </div>
                                        <?php } ?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="post-title">
                                    <strong>
                                        <a href="<?php echo url::base() . $friend->username; ?>">
                                            <?php echo $friend->user_detail->first_name . " " . $friend->user_detail->last_name; ?>
                                        </a>
                                    </strong>
                                </div>

                                <div class="post-matter collapse-description collapseable in">
                                    <p>
                                        <!--show total number of friends begin-->
                                         <span class="badge" style="color:rgba(51, 49, 51, 0.84);background-color: rgba(167, 179, 168, 0.3);">
                                        <?php $n = ORM::factory('friendship')->where('user_id', '=', $friend->id)->count_all(); ?>
                                        <?php
                                        if ($n == 0) {
                                            echo 'No Friends';
                                        } else if ($n == 1) {
                                            echo '1 Friend';
                                        } else {
                                            echo $n . ' Friends';
                                        }
                                        ?>
                                    </span>
                                    <?php 
                                        $loc = $friend->user_detail->location; 
                                        $b = explode(',', $loc);
                                        if(!empty($b[0]) && !empty($b[2]))
                                        {
                                            echo $b[0].", ".$b[2];
                                        }
                                        /*else if(!empty($b[0]))*/
                                        else if(!empty($b[0]) && empty($b[2]))
                                        {
                                             echo $b[0];
                                        }
                                        else
                                        {
                                             echo " ";
                                        }
                                    ?>
                                       

                                        <br />
                                        <a href="<?php echo url::base() . 'chat/compose?user=' . $friend->username; ?>">Message</a> | 
                                        <a href="<?php echo url::base() . 'members/index?user=' . $friend->username; ?>">Send Request</a> |
                                        <a href="<?php echo url::base() . 'peoplereview/compose?ask=' . $friend->username; ?>">Review</a>
                                        <br />
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div style="clear:right;"></div>
                    </div>
                <?php } ?>

            </div>

        </div>
    </div>
</div>