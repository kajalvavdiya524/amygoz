<?php if (!empty($messages)) { ?>
    <div style="width:100%">
    <?php foreach ($messages as $message) { ?>
        <?php
        $conv_count = $message->conversations->count_all();
        $check_unread = ($message->to == Auth::instance()->get_user()->id) ? $message->to_unread : $message->from_unread;
        ?>
        <?php
        $other_user = ($message->owner->id != Auth::instance()->get_user()->id) ?
            $message->owner : $message->message_to;
        ?>
    <li>

            <a href="#" class="">
                <div class="row-fluid mesgSender">
                    <div class="col-xs-12 hb-pl-0">


                        <?php if ($check_unread) { ?>
                            <a href="<?php echo url::base() . "messages/view_message/" . $other_user->username; ?>" class="unread-sign secondary-text">
                                <span class="glyphicon glyphicon-envelope" style=""></span>
                            </a>
                        <?php } ?>
                       

                        <div class="row">
                            <div class="col-xs-12">
                                <?php if($other_user->is_blocked == 0) { ?>
                                <a href="<?php echo url::base() . $other_user->username; ?>" class="pull-left">
                                   <?php 
                                        $photo = $other_user->photo->profile_pic_m;
                                        $oth_image = file_exists("mobile/upload/" .$photo);
                                        $oth_image1 = file_exists("upload/" .$photo);
                                    if(!empty($photo) && $oth_image) { ?>
                                        <img alt="" class="img-responsive" src="<?php echo url::base().'mobile/upload/'.$other_user->photo->profile_pic_m;?>">
                                    <?php }
                                    else if(!empty($photo) && $oth_image1) { ?>
                                        <img alt="" class="img-responsive" src="<?php echo url::base().'upload/'.$other_user->photo->profile_pic_m;?>">
                                    <?php } else { ?>
                                        <div id="inset" class="xxs">
                                            <h1>
                                                <?php echo $other_user->user_detail->first_name[0].$other_user->user_detail->last_name[0]; ?>
                                            </h1>
                                            <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                        </div>
                                    <?php } ?>
                                </a>
                                <?php } else { ?>
                                    <a href="<?php echo url::base(); ?>" class="pull-left">
                                   <img alt="" class="img-responsive" src="<?php echo url::base() . 'img/logo-sm.png'; ?>">
                                </a>
                                <?php }?>

                                <div class="mesgContainer">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <?php if($other_user->is_blocked == 0) { ?>
                                            <h6>
                                                <a href="<?php echo url::base() . "messages/view_message/" . $other_user->username; ?>">
                                                    <strong>
                                                        <?php echo $other_user->user_detail->first_name; //. " " . $other_user->user_detail->last_name; ?>
                                                    </strong>
                                                </a>
                                            </h6>
                                            <?php } else { ?>
                                            <h6>
                                                <a href="<?php echo url::base() . "messages/view_message/".$other_user->username; ?>">
                                                    <strong>
                                                        <?php echo "Callitme User"; ?>
                                                    </strong>
                                                </a>
                                            </h6>  
                                            <?php } ?>
                                        </div>

                                        <div class="col-xs-5">
                                            <h6 class="text-right">
                                                <small>
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
                                                </small>
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <p class="text-justify">
                            <form action="<?php echo url::base() . "messages/delete_message" ?>" method="post">
                                <input type="hidden" name="message" value="<?php echo $message->id; ?>" />
                                <input type="hidden" name="username" value="<?php echo $other_user->username;?>" />
                            <button type="submit" title="Delete message" class="btn btn- secondary btn-xs pull-right">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                       
                                        <a href="<?php echo url::base() . "messages/view_message/" . $other_user->username; ?>">
                                            <small>
                                            <?php
                                                if ($conv_count > 0) {
                                                    echo nl2br(substr($message->conversations->order_by('id', 'desc')->limit(1)->find()->message, 0, 20)) . "....";
                                                } else {
                                                    echo nl2br(substr($message->message, 0, 20)) . "...";
                                                }
                                            ?>
                                            </small>
                                        </a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <div class="clearfix"></div>


        <!-- Start -->

        <!--<div class="post message">


            <form class="delete-message marLeft10" action="<?php //echo url::base() . "messages/delete_message" ?>" method="post" style="display:none;">
                <input type="hidden" name="message" value="<?php //echo $message->id; ?>" />
                <button type="submit" class="btn btn-primary">
                    <i class="icon-trash"></i>
                </button>
            </form>

            <div class="user-img pull-left">
                <a href="<?php //echo url::base() . $other_user->username; ?>" class="pull-left">
                    <?php //if ($other_user->photo->profile_pic_m) { ?>
                        <img src="<?php //echo url::base() . 'upload/' . $other_user->photo->profile_pic_m; ?>">
                    <?php //} else { ?>
                        <img src="<?php //echo url::base() . 'img/no_image_s.png' ?>" />
                    <?php //} ?>
                </a>
            </div>

            <span class="post-time pull-right dis-block">
                <input type="hidden" value="<?php //echo strtotime($message->replied_at); ?>" class="message_time" />
                <input type="hidden" value="<?php //echo $message->id; ?>" class="message_id" />
                <?php
                /*$age = time() - strtotime($message->replied_at);
                if ($age >= 86400) {
                    echo date('jS M', strtotime($message->replied_at));
                } else {
                    echo date::time2string($age);
                }*/
                ?>
            </span>

            <div class="post-content">
                <a href="<?php //echo url::base() . "messages/view_message/" . $other_user->username; ?>">
                    <div class="post-title">
                        <strong>
                            <?php //echo $other_user->user_detail->first_name . " " . $other_user->user_detail->last_name; ?>
                        </strong>
                    </div>
                </a>
                <div class="post-matter collapse-description collapseable in">
                    <a href="<?php //echo url::base() . "messages/view_message/" . $other_user->username; ?>">
                        <p>
                            <?php
                            /*if ($conv_count > 0) {
                                echo nl2br(substr($message->conversations->order_by('id', 'desc')->limit(1)->find()->message, 0, 15)) . "....";
                            } else {
                                echo nl2br(substr($message->message, 0, 20)) . "...";
                            }*/
                            ?>

                        </p>
                    </a>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>-->
    </li>
    <?php } ?>

<?php } ?>