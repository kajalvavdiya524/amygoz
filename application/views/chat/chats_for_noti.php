<?php $session_user = Auth::instance()->get_user(); ?>

<?php 
    $chats = ORM::factory('chat')
        ->where_open()
            ->where_open()
                ->where('user_to', '=', $session_user->id)
                ->where('to_deleted', '=', 0)
            ->where_close()
            ->or_where_open()
                ->where('user_from', '=', $session_user->id)
                ->where('from_deleted', '=', 0)
            ->or_where_close()
        ->where_close()
        ->order_by('last_message_time', 'desc')
        ->find_all()
        ->as_array();

?>

<?php if (!empty($chats)) { ?>
    <?php foreach ($chats as $chat) { ?>
        <?php
            $other_user = ($chat->from->id != Auth::instance()->get_user()->id) ? $chat->from : $chat->to;
        ?>

        <div class="post message messages_for_noti">

            
            <div class="user-img hb-mr-5 pull-left">
                <?php
                    $photo = $other_user->photo->profile_pic_m;
                    $photo_image = file_exists("mobile/upload/" . $photo);
                    $photo_image1 = file_exists("upload/" .$photo);
                ?>
                    
                <?php if($other_user->is_blocked == 0) { ?>
                    <a href="<?php echo url::base() . $other_user->username; ?>" class="pull-left">
                        <?php if(!empty($photo) && $photo_image) { ?>
                            <img src="<?php echo url::base() . 'mobile/upload/' . $other_user->photo->profile_pic_m; ?>" width="50" height="50">
                        <?php } else if(!empty($photo) && $photo_image1) { ?>
                            <img src="<?php echo url::base() . 'upload/' . $other_user->photo->profile_pic_m; ?>" width="50" height="50">
                        <?php } else { ?>
                            <div id="inset" class="xxs visible-xs noMar">
                                <h1><?php echo $other_user->user_detail->get_no_image_name(); ?></h1>
                            </div>
                            
                            <div id="inset" class="xs hidden-xs noMar">
                                <h1><?php echo $other_user->user_detail->get_no_image_name(); ?></h1>
                            </div>
                        <?php } ?>
                    </a>
                <?php } else { ?>
                    <img src="<?php echo url::base() . 'img/logo-sm.png'; ?>" width="50" height="50">
                <?php } ?>
            </div>

            <div class="post-content">
                <div class="post-title">
                    <strong>
                        <?php if($other_user->is_blocked == 0) { ?>
                            <?php echo $other_user->user_detail->get_name(); ?>
                        <?php } else {?>
                            <?php echo "Callitme User"; ?>
                        <?php } ?>
                    </strong>
                </div>

                <div class="post-matter collapse-description collapseable in">
                    <a href="<?php echo url::base()."chat/view_message/".$other_user->username; ?>">
                        <p>
                            <?php echo $chat->last_message; ?>

                            <small class="pull-right">
                                <span class="post-time pull-right dis-block">
                                    <i class="fa fa-clock-o"></i> 
                                    
                                    <input type="hidden" value="<?php echo strtotime($chat->last_message_time); ?>" class="message_time" />
                                    <input type="hidden" value="<?php echo $chat->id; ?>" class="message_id" />
                                    <?php 
                                        $age = time() - strtotime($chat->last_message_time); 
                                        if ($age >= 86400) {
                                            echo date('jS M', strtotime($chat->last_message_time));
                                        } else {
                                            echo date::time2string($age);
                                        }
                                    ?>
                                </span>
                            </small>
                        </p>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    <?php } ?>

    <?php if(count($chats)) { ?>
        <div class="view_more">
            <a href="<?php echo url::base()."chat"; ?>">View All</a>
        </div>
    <?php } ?>

<?php } else { ?>
    <div class="post friend" style="width:160px;">
        <p class="text-center" style="color : black;">No messages.</p>
    </div>
<?php } ?>