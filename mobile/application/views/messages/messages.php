<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?php foreach($messages as $message) 
{ ?>
    <div class="">
    <div class="row" style="border-bottom: 1px solid #eee;margin-bottom: 5px;">
    <div class="col-xs-2">
        <center>
        <div id="imagenewmess">
        <a href="<?php echo url::base() . $message->owner->username; ?>">
            <?php if ($message->owner->photo->profile_pic_s) { ?>
                <img alt="" src="<?php echo url::base() . 'upload/' . $message->owner->photo->profile_pic_s; ?>" height="100%">
            <?php } else { ?>
                <div id="inset" class="xs" style="margin-top: 0px;">
                    <h1>
                        <?php echo $message->owner->user_detail->first_name[0] . $message->owner->user_detail->last_name[0]; ?>
                    </h1>
                    <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                </div>
            <?php } ?>
        </a>
        </div>
        </center>
        </div>
        <div class="col-xs-10" style="position: relative;left: 3px;">
        <div class="mesgContainer">
                    <p class="" style="font-size:16px;font-weight: 600;color: #f06292;">
                            <?php
                            echo ($message->owner->user_detail->first_name) ?
                                    $message->owner->user_detail->first_name . " " . $message->owner->user_detail->last_name :
                                    $message->owner->email;
                            ?>
                       </p>
                        <!--<small>
                        <?php //echo substr($message->message, 0, 70);?>
                            <span class="read-more" style="color:#01BF01;cursor:pointer"> 
                                <i> ...read more</i> 
                            </span>
                        </small>-->
                        <p style="font-size: 16px;font-weight: 500; color: black;margin-top: 0px;">
                        <?php echo nl2br($message->message); ?></p>
                        <small class="pull-left" style="font-size: 13px; color:#595757;margin-top: 1px;margin-bottom: 12px;">
                            <i class="fa fa-clock-o"></i>
                            <?php
                            $age = time() - strtotime($message->time);
                            if ($age >= 86400) {
                                echo date('jS M', strtotime($message->time));
                            } else {
                                echo date::time2string($age);
                            }
                            ?>

                            <?php if ($message->owner->id === Auth::instance()->get_user()->id) { ?>
                                <input type="hidden" value="<?php echo strtotime($message->time); ?>" class="message_time" />
                            <?php } else { ?>
                                <input type="hidden" value="<?php echo strtotime($message->time); ?>" class="message_time other-user-time" />
                            <?php } ?>
                        </small>                                  
            <div class="clearfix"></div>
        </div>
        </div>
        <div class="clearfix"></div>
        </div>
    </div>
<?php } ?>