<div class="comment">
 <div class="row">
  <div class="col-xs-2 col-md-2 col-log-2">
    <div class="comment-user-img pull-left">
        <a href="<?php echo url::base().$comment->user->username; ?>">
            <?php if($comment->user->photo->profile_pic_m) { ?>
                <img src="<?php echo url::base().'upload/'.$comment->user->photo->profile_pic_s;?>">
            <?php } else { ?>
                <img src="<?php echo url::base().'img/no_image_m.png' ?>" />
            <?php } ?>
        </a>
    </div>
    </div>
    <div class="col-xs-10 col-md-10 col-log-2">
    <span class="comment-time-box pull-right dis-block">
        <?php $comment_time = time() - strtotime($comment->time);
            if ($comment_time >= 86400) {
                echo date('jS M', strtotime($comment->time));
            } else {
                echo Date::time2string($comment_time);
            }
        ?>
    </span>
    
    <div class="comment-content">
        <strong>
            <a href="<?php echo url::base().$comment->user->username; ?>">
                <?php echo $comment->user->user_detail->first_name .' '. $comment->user->user_detail->last_name; ?>
            </a>
        </strong>
        
        <?php
            echo ' '.nl2br(preg_replace(
                "/(http:\/\/|ftp:\/\/|https:\/\/|www\.)([^\s,]*)/i",
                "<a href=\"$1$2\" target=\"_blank\">$1$2</a>",
                $comment->comment
            ));
        ?>
    </div>
   </div>
   </div> 
    <?php if($comment->user->id == Auth::instance()->get_user()->id) { ?>
        <form class="delete_comment pull-right" action="<?php echo url::base()."members/delete_comment"?>" method="post">
            <input type="hidden" name="comment" value="<?php echo $comment->id; ?>" />
            <button type="submit" class="btn btn-primary btn-xs">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </form>
    <?php } ?>
    
    <div class="clearfix"></div>
</div>