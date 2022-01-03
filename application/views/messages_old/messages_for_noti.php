<?php $session_user = Auth::instance()->get_user();?>

<?php 
    $messages = ORM::factory('message')
        ->where('parent_id', '=', 0)
        ->where_open()
            ->where_open()
                ->where('to', '=', $session_user->id)
                ->where('to_deleted', '=', 0)
            ->where_close()
            ->or_where_open()
                ->where('from', '=', $session_user->id)
                ->and_where('from_deleted', '=', 0)
            ->or_where_close()
        ->where_close()
        ->order_by('replied_at', 'desc')
        ->order_by('time', 'desc')
        ->limit(3)
        ->find_all()
        ->as_array();
        
    $sent = '';
?>

<?php if(!empty($messages)) { ?>
    <?php foreach ($messages as $message) {  ?>
        <?php 
            $conv_count = $message->conversations->count_all();
            $check_unread = ($message->to == Auth::instance()->get_user()->id) ? $message->to_unread : $message->from_unread;
        ?>

        <div class="post message messages_for_noti <?php if(($check_unread)) { ?> unread <?php } ?>">
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
                        <img src="<?php echo url::base().'img/no_image_m.png' ?>" />
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
                <div class="post-title">
                    <strong>
                        <?php echo $other_user->user_detail->first_name ." ".$other_user->user_detail->last_name; ?>
                    </strong>
                </div>
                
                <div class="post-matter collapse-description collapseable in">
                    <a href="<?php echo url::base()."messages/view_message/".$other_user->username; ?>">
                        <p>
                            <?php if($conv_count > 0) {
                                $msg = $message->conversations->order_by('id', 'desc')->limit(1)->find()->message;
                            } else {
                                $msg = $message->message;
                            } ?>
                            <?php echo nl2br(substr($msg, 0, 100)."...");?>
                        </p>
                    </a>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>

    <?php } ?>
    
    <?php if(count($messages)) { ?>
        <div class="view_more">
            <a href="<?php echo url::base()."messages";?>">View All</a>
        </div>
    <?php } ?>
    
<?php } else { ?>
    <div class="post friend" style="width:160px;">
        <p class="text-center">No messages.</p>
    </div>
<?php } ?>