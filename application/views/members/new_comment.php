<style>
#imagerather {
    width: 47px;
    height: 47px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-top: 3px;
    position: relative;
    right:19px;
}
#imagebatter {
    width: 35px;
    height: 35px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-top: 3px;
}
</style>

<div class="">
 <div class="container" style="border-bottom: 1px solid #e3e3e3;padding: 12px;">
  <div class="col-md-1">
    <center>
    <div class="fileinput-preview" id="imagebatter" style="overflow: hidden; background-color: white;position:relative;right: 8px;">
        <a href="<?php echo url::base().$comment->user->username; ?>">
            <?php 
            $photo = $comment->user->photo->profile_pic_s;
            $oth_image = file_exists("mobile/upload/" .$photo);
            $oth_image1 = file_exists("upload/" .$photo);
            if(!empty($photo) && $oth_image) { ?>
                <img src="<?php echo url::base().'mobile/upload/'.$comment->user->photo->profile_pic;?>" height="100%">
            <?php }
            else if(!empty($photo) && $oth_image1) { ?>
                <img src="<?php echo url::base().'upload/'.$comment->user->photo->profile_pic;?>" height="100%">
            <?php } else { ?>
                <img src="<?php echo url::base().'img/no_image_m.png' ?>" />
            <?php } ?>
        </a>
    </div>
    </center>
    </div>
    <div class="col-md-9">
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
        <br/>
        <span class="comment-time-box pull-left dis-block" style="font-size: 12px; color: #90949c;">
        <?php $comment_time = time() - strtotime($comment->time);
            if ($comment_time >= 86400) {
                echo date('jS M', strtotime($comment->time));
            } else {
                echo Date::time2string($comment_time);
            }
        ?>
    </span>
    </div>
       </div>
       <div class="col-md-2" style="margin-top:8px;">
       <?php if($comment->user->id == Auth::instance()->get_user()->id) { ?>
        <form class="delete_comment pull-right" action="<?php echo url::base()."members/delete_comment"?>" method="post">
            <input type="hidden" name="comment" value="<?php echo $comment->id; ?>" />
            <button type="submit" class="btn btn-primary btn-xs" style="background: #d5d2d2;color: #00bcd4;border-radius: 50%;">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </form>
    <?php } ?>
    
   </div> 

    <div class="clearfix"></div>
</div>