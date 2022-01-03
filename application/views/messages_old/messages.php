<?php foreach($messages as $message) { ?>

    <div class="view-message post collapse-box">
    
        <div class="collapse-header">
            <div class="user-img pull-left">
                <a href="<?php echo url::base().$message->owner->username; ?>">
                    <?php if($message->owner->photo->profile_pic_s) { ?>
                        <img src="<?php echo url::base().'upload/'.$message->owner->photo->profile_pic_s;?>">
                    <?php } else { ?>
                        <img src="<?php echo url::base().'img/no_image_m.png' ?>" />
                    <?php } ?>
                </a>
            </div>
            
            <span class="post-time pull-right dis-block">
                <?php 
                    $age = time() - strtotime($message->time); 
                    if ($age >= 86400) {
                        echo date('jS M', strtotime($message->time));
                    } else {
                        echo date::time2string($age);
                    }
                ?>
                <input type="hidden" value="<?php echo strtotime($message->time); ?>" class="message_time" />
            </span>
            
            <div class="post-content">
                <div class="post-title">
                    <strong>
                        <?php echo ($message->owner->user_detail->first_name) ? 
                            $message->owner->user_detail->first_name ." ".$message->owner->user_detail->last_name : 
                            $message->owner->email;
                        ?>
                    </strong>
                </div>
                
                <div class="post-matter collapse-description collapseable collapse">
                    <p><?php echo substr($message->message, 0, 70);?>
                        <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="collapse-body collapseable in">
            <div class="collapse-body-content">
                <p><?php echo nl2br($message->message);?></p>
            </div>
        </div>
    
    </div>
<?php } ?>