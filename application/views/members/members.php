<div class="friends-block">

    <?php $total_user = count($users); ?>
    <div>
        <h3>There are <?php echo $total_user; ?> members available for your search for "<?php echo $search_word; ?>"</h3>
    </div>

    <div class="friends">
        
        <?php foreach($users as $friend) { ?>
            <div class="post friend">

                <div class="user-img pull-left">
                    <a href="<?php echo url::base().$friend->username; ?>">
                        <?php 
                        $photo = $friend->photo->profile_pic_s;
                        $frd_image = file_exists("mobile/upload/" .$photo);
                        $frd_image1 = file_exists("upload/" .$photo);
                        if(!empty($photo) && $frd_image) { ?>
                            <img src="<?php echo url::base()."mobile/upload/".$friend->photo->profile_pic_s;?>">
                        <?php }
                        else if(!empty($photo) && $frd_image1) { ?>
                            <img src="<?php echo url::base()."upload/".$friend->photo->profile_pic_s;?>">
                        <?php } else { ?>
                            <img src="<?php echo url::base()."img/no_image_s.png";?>">
                        <?php } ?>
                    </a>
                </div>

                <div class="post-content">
                    <div class="post-title">
                        <strong>
                            <a href="<?php echo url::base().$friend->username; ?>">
                                <?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name."asdas"; ?>
                            </a>
                        </strong>
                    </div>
                    
                    <div class="post-matter collapse-description collapseable in">
                        <p>
                            <!--show total number of friends begin-->
                            <?php $n = ORM::factory('friendship')->where('user_id','=',$friend->id)->count_all();?>
                            <?php 
                                if($n == 0) {
                                    echo 'No Friends';
                                } else if($n == 1) {
                                    echo '1 friend';
                                } else {
                                    echo $n.' friends';
                                }
                            ?>
                            <!--show total number of friends end-->
                            <!--location begin-->
                             <?php echo $friend->user_detail->location; ?>
                            <!--end location-->

                            <br />
                            <a href="<?php echo url::base().'chat/compose?user='.$friend->username; ?>">Message</a> | 
                            <a href="<?php echo url::base().'members/index?user='.$friend->username; ?>">Request</a> |
                            <a href="<?php echo url::base().'peoplereview/compose?ask='.$friend->username; ?>">Review</a>
                            <br />
                        </p>
                    </div>
                </div>
                
                
                <div style="clear:right;"></div>

            </div>
        <?php } ?>
        
    </div>

</div>