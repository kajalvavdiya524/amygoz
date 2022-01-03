<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<style>
body{background: #fff;}
p {
    margin: 0 0 10px;
}
</style>
<?php if (!empty($messages)) { ?>
    <div>
    <?php foreach ($messages as $message) { ?>
        <?php
        $conv_count = $message->conversations->count_all();
        $check_unread = ($message->to == Auth::instance()->get_user()->id) ? $message->to_unread : $message->from_unread;
        ?>
        <?php
        $other_user = ($message->owner->id != Auth::instance()->get_user()->id) ?
            $message->owner : $message->message_to;
        ?>
    <div>

            <a href="#" class="">
                <div class="row mesgSender" style="/*border-bottom: 1px solid #e2e0e0;*/">
                    <div class="row hb-pl-0">
                        <?php if ($check_unread) { ?>
                            <a href="<?php echo url::base() . "messages/view_message/" . $other_user->username; ?>" class="unread-sign secondary-text">
                                <span class="glyphicon glyphicon-envelope" style="position: relative;top: 13px;"></span>
                            </a>
                        <?php } ?>
                        <div class="row">
                            <div class="col-xs-2" style="position: relative;top: 13px;">
                            <center>
                            <div id="imagemessge">
                                <?php if($other_user->is_blocked == 0) { ?>
                                <a href="<?php echo url::base() . $other_user->username; ?>" class="">
                                   <?php if($other_user->photo->profile_pic_m) { ?>
                                        <img alt="" src="<?php echo url::base()."upload/".$other_user->photo->profile_pic;?>" height="100%">
                                    <?php } else { ?>
                                        <div id="inset" class="xxs">
                                            <h1 style="font-size: 22px;line-height: 44px;">
                                                <?php echo $other_user->user_detail->first_name[0].$other_user->user_detail->last_name[0]; ?>
                                            </h1>
                                        </div>
                                    <?php } ?>
                                </a>
                                </div>
                            
                                <?php } else { ?>
                                    <a href="<?php echo url::base(); ?>" class="">
                                   <img alt="" class="img-responsive" src="<?php echo url::base() . 'img/logo-sm.png'; ?>">
                                </a>
                                <?php }?>

                                </center>
                            </div>

                                <div class="container" style="margin-left: 46px;">
                                <a href="<?php echo url::base() . "messages/view_message/" . $other_user->username; ?>">
                                 <h6 style="font-size: 17px;">
                                                <a href="<?php echo url::base() . "messages/view_message/" . $other_user->username; ?>" style="color: black;font-weight: 400;">
                                                    <p style="color: black;font-weight: 500;position: relative;top: 11px;"> 
                                                        <?php echo $other_user->user_detail->first_name. " " .$other_user->user_detail->last_name; //. " " . $other_user->user_detail->last_name; ?>
                                                    </p>
                                                
                                            </h6>
                                        </a>
                                
                                        <div class="pull-right" style="margin-top: -31px;position: relative;top: 6px;">
                                            <h6 class="pull-right">
                                                <small style="font-size: 14px;" class="pull-right">
                                                    <input type="hidden" value="<?php echo strtotime($message->replied_at); ?>" class="message_time" />
                                                    <input type="hidden" value="<?php echo $message->id; ?>" class="message_id" />
                                                    <?php
                                                        $age = time() - strtotime($message->replied_at);
                                                        if ($age >= 86400) {
                                                            echo date('M j', strtotime($message->replied_at));
                                                        } else {
                                                            echo date::time2string($age);
                                                        }
                                                    ?>
                                                </small>
                                            </h6>
                                        </div>
                                           
                                <div class="clearfix"></div>
                                <a href="<?php echo url::base() . "messages/view_message/" . $other_user->username; ?>">
                                 <!--<h6 style="font-size: 17px;">
                                                <a href="<?php// echo url::base() . "messages/view_message/" . $other_user->username; ?>" style="color: black;font-weight: 400;">
                                                    <strong style="color: #f06292;"> 
                                                        <?php// echo $other_user->user_detail->first_name; //. " " . $other_user->user_detail->last_name; ?>
                                                    </strong>
                                                
                                            </h6>-->
                                            <p style="font-size: 16px; font-weight: 400; color:#636262;">
                                            <?php
                                                if ($conv_count > 0) {
                                                    echo nl2br(substr($message->conversations->order_by('id', 'desc')->limit(1)->find()->message, 0, 75)) . "";
                                                } else {
                                                    echo nl2br(substr($message->message, 0, 75)) . "";
                                                }
                                            ?>
                                            </p>
                                        </a>
                                            <?php if($other_user->is_blocked == 0) { ?>
                                           
                                            <?php } else { ?>
                                            <h6 style=" font-size: 13px;">
                                                <a href="<?php echo url::base() . "messages/view_message/".$other_user->username; ?>" style="color: black;font-weight: 400;">
                                                    <strong>
                                                        <?php echo "Callitme User"; ?>
                                                    </strong>
                                             </a>
                                            </h6>  
                                            <?php } ?>
                                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">          
                    <hr style="margin-top: 0px;margin-bottom: 0px;width: 251px;"/>
                </div>
            </a>
        <div class="clearfix"></div>
    </div>
    <?php } ?>
<?php } ?>