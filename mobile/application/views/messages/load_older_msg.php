<?php
        $other_person = ($message->owner->id != Auth::instance()->get_user()->id) ?
                $message->owner : $message->message_to;
        ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php foreach (array_reverse($message->conversations->where('id','<',$msg_id)->order_by('id','DESC')->limit(4)->find_all()->as_array()) as $conversation) { ?>
       
        <input type="hidden" id="valu" value="<?php echo $conversation->id; ?>">
        <input type="hidden" id="other_person" value="<?php echo $other_person->username; ?>">
        <div class="ui-grid-a messageList">
        <div class="row" style="border-bottom: 1px solid #eee;margin-bottom: 5px;">
        <div class="col-xs-2">
        <center>
        <div id="imagelodmess">
            <a href="<?php echo url::base() . $conversation->owner->username; ?>">
                <?php if ($conversation->owner->photo->profile_pic_s) { ?>
                    <img alt="" src="<?php echo url::base() . 'upload/' . $conversation->owner->photo->profile_pic; ?>" height="100%">
                <?php } else { ?>
                    <div id="inset" class="xs" style="margin-top: 0px;">
                        <h1>
                            <?php echo $conversation->owner->user_detail->first_name[0] . $conversation->owner->user_detail->last_name[0]; ?>
                        </h1>
                    </div>
                <?php } ?>
            </a>
            </div>
             </center>
            </div>
            <div class="col-xs-10" style="position: relative;left: 3px;">
                <div class="messageWrap">
                    <p class="" style="font-size:16px;font-weight: 600;color: #f06292;">
                                <?php
                                echo ($conversation->owner->user_detail->first_name) ?
                                        $conversation->owner->user_detail->first_name . " " . $conversation->owner->user_detail->last_name :
                                        $conversation->owner->email;
                                ?>
                         
                            
                                </p>
                <p style="font-size: 16px;font-weight: 500; color: black;margin-top: -10px;"><?php echo nl2br($conversation->message); ?></p>
                <small class="pull-left" style="font-size: 13px; color:#595757;margin-top: -9px;margin-bottom: 12px;">
                                <?php
                                $age = time() - strtotime($conversation->time);
                                if ($age >= 86400) {
                                    echo date('M j', strtotime($conversation->time));
                                } else {
                                    echo date::time2string($age);
                                }
                                ?>

                                <?php if ($conversation->owner->id === Auth::instance()->get_user()->id) { ?>
                                    <input type="hidden" value="<?php echo strtotime($conversation->time); ?>" class="message_time" />
                                <?php } else { ?>
                                    <input type="hidden" value="<?php echo strtotime($conversation->time); ?>" class="message_time other-user-time" />
                                <?php } ?>
                            </small>
                </div>
                                <div class="clearfix"></div>
                                </div>

                </div>

            </div>

            <div class="clearfix"></div>
            </div>
        </div>
        
<script type="text/javascript">

    $(function () {

        $('#chatContainer').scrollTop($('#chatContainer')[0].scrollHeight).jScrollPane();

        $('#reply').focus();

    })

</script>
    <?php } exit;?>




