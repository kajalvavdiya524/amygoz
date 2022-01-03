<style>
    body {
        background: #fff;
    }
    p {
        margin: 0 0 10px;
    }
</style>

<ul id="message_list" style="margin-top: -43px;margin-bottom: 40px;">
    <?php if (!empty($chats)) { ?>
    
        <?php foreach($chats as $chat) { ?>
        
            <?php
                $other_user = ($chat->from->id != Auth::instance()->get_user()->id) ? $chat->from : $chat->to;
            ?>
        <li>
            <div style="">
                <div class="row mesgSender">
                    <div class="row hb-pl-0">
                        <div class="row">
                            <div class="col-xs-2" style="position: relative;top: 13px;">
                                <center>
                                    <div id="imagemessge">
                                        <?php if($other_user->is_blocked == 0) { ?>
                                            <a href="<?php echo url::base() . $other_user->username; ?>" class="">
                                                <?php
                                                    $photo = $other_user->photo->profile_pic;
                                                    $photo_image = file_exists("upload/".$photo);
                                                ?>
                                            
                                                <?php if(!empty($photo) && $photo_image) { ?>
                                                    <img alt="" src="<?php echo url::base()."upload/".$other_user->photo->profile_pic;?>" height="100%" style="width:45px;height:45px;">
                                                <?php } else { ?>
                                                    <div id="inset" class="xxs">
                                                        <h1 style="font-size: 22px;line-height: 44px;">
                                                            <?php echo $other_user->user_detail->get_no_image_name(); ?>
                                                        </h1>
                                                    </div>
                                                <?php } ?>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo url::base(); ?>" class="">
                                                <img alt="" class="img-responsive" src="<?php echo url::base() . 'img/logo-sm.png'; ?>">
                                            </a>
                                        <?php } ?>
                                    </div>
                                </center>
                            </div>

                            <div class="container" style="margin-left: 46px;">
                                <h6 style="font-size: 16px;">
                                    <a href="<?php echo url::base() . "chat/view_message/" . $other_user->username; ?>" style="color: black;font-weight: 500;font-size:15px;">
                                        <p style="color: black;font-size:15px;font-weight: 500;position: relative;top: 11px;"> 
                                            <?php if($other_user->is_blocked == 0 && $other_user->is_deleted == 0 ) { ?>
                                                <?php echo $other_user->user_detail->get_name(); ?>
                                            <?php } else { ?>
                                                Callitme User
                                            <?php } ?>
                                        </p>
                                    </a>
                                </h6>
                                                
                                <div class="pull-right" style="margin-top: -31px;position: relative;top: 6px;">
                                    <h6 class="pull-right">
                                        <small style="font-size: 12px;" class="pull-right">
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
                                                           
                                <div class="clearfix"></div>
                                <a href="<?php echo url::base() . "chat/view_message/" . $other_user->username; ?>">
                                    <p style="font-size: 14px; font-weight: 400; color:#636262;">
                                        <?php echo $chat->last_message; ?>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="clearfix"></div>
            </div>
        </li>
        <?php } ?>
    <?php } ?>
</ul>