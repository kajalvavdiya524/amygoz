

<?php
        $other_person = ($message->owner->id != Auth::instance()->get_user()->id) ?
                $message->owner : $message->message_to;
        ?>




    <?php foreach (array_reverse($message->conversations->where('id','<',$msg_id)->order_by('id','DESC')->limit(4)->find_all()->as_array()) as $conversation) { ?>
       
        <input type="hidden" id="valu" value="<?php echo $conversation->id; ?>">
        <input type="hidden" id="other_person" value="<?php echo $other_person->username; ?>">
        

        <div class=" mesgSender marTop20">
            <a href="<?php echo url::base() . $conversation->owner->username; ?>">
                <?php 
                    $photo = $conversation->owner->photo->profile_pic_s;
                    $oth_image = file_exists("mobile/upload/" .$photo);
                    $oth_image1 = file_exists("upload/" .$photo);
                if (!empty($photo) && $oth_image) { ?>
                    <img alt="" class="img-responsive" src="<?php echo url::base() . 'mobile/upload/' . $conversation->owner->photo->profile_pic_s; ?>">
                <?php }
                else if (!empty($photo) && $oth_image1) { ?>
                    <img alt="" class="img-responsive" src="<?php echo url::base() . 'upload/' . $conversation->owner->photo->profile_pic_s; ?>">
                <?php } else { ?>
                    <div id="inset" class="xs">
                        <h1>
                            <?php echo $conversation->owner->user_detail->first_name[0] . $conversation->owner->user_detail->last_name[0]; ?>
                        </h1>
                    </div>
                <?php } ?>
            </a>

            <div class="mesgContainer marTop20">
                <div class="row">
                    <div class="col-xs-9">
                        <h6>
                            <strong>
                                <?php
                                echo ($conversation->owner->user_detail->first_name) ?
                                        $conversation->owner->user_detail->first_name . " " . $conversation->owner->user_detail->last_name :
                                        $conversation->owner->email;
                                ?>
                            </strong>
                         
                        </h6>

                    </div>

                    <div class="col-xs-3">
                        <h6 class="text-right">
                            <small>
                                <i class="fa fa-clock-o"></i>
                                <?php
                                $age = time() - strtotime($conversation->time);
                                if ($age >= 86400) {
                                    echo date('jS M', strtotime($conversation->time));
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

                        </h6>

                    </div>

                </div>

                <div class="clearfix"></div>

                <p><?php echo nl2br($conversation->message); ?></p>

            </div>

            <div class="clearfix"></div>

        </div>
        
<script type="text/javascript">

    $(function () {

        $('#chatContainer').scrollTop($('#chatContainer')[0].scrollHeight).jScrollPane();

        $('#reply').focus();

    })

</script>
    <?php } exit;?>




