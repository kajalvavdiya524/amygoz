<?php foreach($messages as $message) 
{ ?>
    <div class=" mesgSender">
        <a href="<?php echo url::base() . $message->owner->username; ?>">
            <?php 
            $photo = $message->owner->photo->profile_pic_s;
                                        $msg_image = file_exists("mobile/upload/" .$photo);
                                        $msg_image1 = file_exists("upload/" .$photo);
            if (!empty($photo) && $msg_image) { ?>
                <img alt="" class="img-responsive" src="<?php echo url::base() . 'mobile/upload/' . $message->owner->photo->profile_pic_s; ?>">
            <?php }
            else if (!empty($photo) && $msg_image1) { ?>
                <img alt="" class="img-responsive" src="<?php echo url::base() . 'upload/' . $message->owner->photo->profile_pic_s; ?>">
            <?php } else { ?>
                <div id="inset" class="xs">
                    <h1>
                        <?php echo $message->owner->user_detail->first_name[0] . $message->owner->user_detail->last_name[0]; ?>
                    </h1>
                    <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                </div>
            <?php } ?>
        </a>

        <div class="mesgContainer">

            <div class="row">

                <div class="col-xs-9">

                    <h6>
                        <strong>
                            <?php
                            echo ($message->owner->user_detail->first_name) ?
                                    $message->owner->user_detail->first_name . " " . $message->owner->user_detail->last_name :
                                    $message->owner->email;
                            ?>
                        </strong>
                        <!--<small>
                        <?php //echo substr($message->message, 0, 70);?>
                            <span class="read-more" style="color:#01BF01;cursor:pointer"> 
                                <i> ...read more</i> 
                            </span>
                        </small>-->
                    </h6>                                            

                </div>

                <div class="col-xs-3">

                    <h6 class="text-right">

                        <small>
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

                    </h6>

                </div>

            </div>                                       

            <div class="clearfix"></div>

            <p><?php echo nl2br($message->message); ?></p>

        </div>

        <div class="clearfix"></div>

    </div>

    <!--<div class="view-message post collapse-box">
    
        <div class="collapse-header">
            <div class="user-img pull-left">
                <a href="<?php //echo url::base().$message->owner->username; ?>">
                    <?php //if($message->owner->photo->profile_pic_s) { ?>
                        <img src="<?php //echo url::base().'upload/'.$message->owner->photo->profile_pic_s;?>">
                    <?php //} else { ?>
                        <img src="<?php //echo url::base().'img/no_image_m.png' ?>" />
                    <?php //} ?>
                </a>
            </div>
            
            <span class="post-time pull-right dis-block">
                <?php 
                    /*$age = time() - strtotime($message->time); 
                    if ($age >= 86400) {
                        echo date('jS M', strtotime($message->time));
                    } else {
                        echo date::time2string($age);
                    }*/
                ?>
                <input type="hidden" value="<?php //echo strtotime($message->time); ?>" class="message_time" />
            </span>
            
            <div class="post-content">
                <div class="post-title">
                    <strong>
                        <?php /*echo ($message->owner->user_detail->first_name) ? 
                            $message->owner->user_detail->first_name ." ".$message->owner->user_detail->last_name : 
                            $message->owner->email;*/
                        ?>
                    </strong>
                </div>
                
                <div class="post-matter collapse-description collapseable collapse">
                    <p><?php //echo substr($message->message, 0, 100);?>
                        <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="collapse-body collapseable in">
            <div class="collapse-body-content">
                <p><?php //echo nl2br($message->message);?></p>
            </div>
        </div>
    
    </div>-->
<?php } ?>