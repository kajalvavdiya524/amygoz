<style>
    .delete-chat-btn {
        margin-top: 2px;
        line-height: 0.5px;
        padding: 1px 3px;
    }
</style>
<ul id="message_list" class="scroll-pane hb-mt-10" style="overflow: hidden; padding: 0px; width:100%;">
    <?php if (!empty($chats)) { ?>
        
        <?php foreach($chats as $chat) { ?>
        
            <?php
                $other_user = ($chat->from->id != Auth::instance()->get_user()->id) ? $chat->from : $chat->to;
            ?>

            <li>
                <div class="row-fluid mesgSender">
                    <div class="col-xs-12 hb-pl-0">
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="<?php echo url::base()."chat/view_message/".$other_user->username; ?>" class="pull-left">
                                    <?php
                                        $photo = $other_user->photo->profile_pic_m;
                                        $photo_image_mob = file_exists("mobile/upload/".$photo);
                                        $photo_image = file_exists("upload/".$photo);
                                    ?>
                                    
                                    <?php if($other_user->is_blocked == 0 && $other_user->is_deleted == 0 ) { ?>
                                    
                                        <?php if(!empty($photo) && $photo_image_mob) { ?>
                                            <img alt="" class="img-responsive" src="<?php echo url::base().'mobile/upload/'.$photo; ?>">
                                        <?php } else if(!empty($photo) && $photo_image) { ?>
                                            <img alt="" class="img-responsive" src="<?php echo url::base().'upload/'.$photo; ?>">
                                        <?php } else { ?>
                                            <div id="inset" class="xxs">
                                                <h1>
                                                    <?php echo $other_user->user_detail->get_no_image_name(); ?>
                                                </h1>
                                            </div>
                                        <?php } ?>

                                    <?php } else { ?>
                                        <a href="<?php echo url::base(); ?>" class="pull-left">
                                           <img alt="" class="img-responsive" src="<?php echo url::base() . 'img/logo-sm.png'; ?>">
                                        </a>
                                    <?php } ?>
                                </a>
                                    
                                <div class="mesgContainer">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <?php if($other_user->is_blocked == 0 && $other_user->is_deleted == 0 ) { ?>
                                                <h6>
                                                    <a href="<?php echo url::base()."chat/view_message/".$other_user->username; ?>">
                                                        <strong><?php echo $other_user->user_detail->get_name(); ?></strong>
                                                    </a>
                                                </h6>
                                            <?php } else { ?>
                                                <h6>
                                                    <a href="<?php echo url::base()."chat/view_message/".$other_user->username; ?>">
                                                        <strong>Callitme User</strong>
                                                    </a>
                                                </h6>  
                                            <?php } ?>
                                        </div>

                                        <div class="col-xs-4">
                                            <h6 class="text-right">
                                                <small>
                                                    <?php
                                                        $age = time() - strtotime($chat->last_message_time); 
                                                        if ($age >= 86400) {
                                                            echo date('jS M', strtotime($chat->last_message_time));
                                                        } else {
                                                            echo date::time2string($age);
                                                        }
                                                    ?>
                                                </small>
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <form action="<?php echo url::base()."chat/delete_message/".$other_user->username ?>" method="post">
                                        <input type="hidden" name="chat" value="<?php echo $chat->id; ?>" />

                                        <button type="submit" title="Delete message" class="btn btn-secondary delete-chat-btn btn-xs pull-right">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                           
                                    <a href="<?php echo url::base()."chat/view_message/".$other_user->username; ?>" style="color:black;">
                                        <small>
                                            <?php echo $chat->last_message; ?>
                                        </small>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </li>
        <?php } ?>

    <?php } ?>
</ul>