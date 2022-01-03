<?php if(!empty($messages)) { ?>
    <?php foreach ($messages as $message) {  ?>
        <?php 
            $conv_count = $message->conversations->count_all();
            $check_unread = ($message->to == Auth::instance()->get_user()->id) ? $message->to_unread : $message->from_unread;
        ?>

        <div class="post message">
            <?php
                $other_user = ($message->owner->id != Auth::instance()->get_user()->id) ?
                    $message->owner : $message->message_to;
            ?>
        
            <?php if($check_unread) { ?>
                <a href="<?php echo url::base()."messages/view_message/".$other_user->username; ?>" class="unread-sign">
                    <span class="glyphicon glyphicon-envelope" style=""></span>
                </a>
            <?php } ?>

            <form class="delete-message marLeft10" action="<?php echo url::base()."messages/delete_message"?>" method="post" style="display:none;">
                <input type="hidden" name="message" value="<?php echo $message->id; ?>" />
                <button type="submit" class="btn btn-primary">
                    <i class="icon-trash"></i>
                </button>
            </form>
            
            <div class="user-img pull-left">
                <a href="<?php echo url::base().$other_user->username; ?>" class="pull-left">
                    <?php if($other_user->photo->profile_pic_m) { ?>
                        <img src="<?php echo url::base().'upload/'.$other_user->photo->profile_pic_m;?>">
                    <?php } else { ?>
                        <img src="<?php echo url::base().'img/no_image_s.png' ?>" />
                    <?php } ?>
                </a>
            </div>
            
            <span class="post-time pull-right dis-block">
                <input type="hidden" value="<?php echo strtotime($message->replied_at); ?>" class="message_time" />
                    <input type="hidden" value="<?php echo $message->id; ?>" class="message_id" />
                    <?php 
                        $age = time() - strtotime($message->replied_at); 
                        if ($age >= 86400) {
                            echo date('jS M', strtotime($message->replied_at));
                        } else {
                            echo date::time2string($age);
                        }
                    ?>
            </span>
            
            <div class="post-content">
                <a href="<?php echo url::base()."messages/view_message/".$other_user->username; ?>">
                    <div class="post-title">
                        <strong>
                            <?php echo $other_user->user_detail->first_name ." ".$other_user->user_detail->last_name; ?>
                        </strong>
                    </div>
                </a>
                <div class="post-matter collapse-description collapseable in">
                    <a href="<?php echo url::base()."messages/view_message/".$other_user->username; ?>">
                        <p>
                            <?php if($conv_count > 0) {
                                echo nl2br(substr($message->conversations->order_by('id', 'desc')->limit(1)->find()->message,0,15))."....";
                            } else {
                                echo nl2br(substr($message->message, 0,20))."...";
                            } ?>
                            
                        </p>
                    </a>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
    <?php } ?>
<?php } ?>