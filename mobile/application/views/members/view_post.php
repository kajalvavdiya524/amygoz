<div class="post">
    
            <div class="post-actions pull-right" style="margin-top: -50px;">
                <?php if ($post->user->id == Auth::instance()->get_user()->id) { ?>
                    <form class="delete-post pull-right marLeft10" action="<?php echo url::base()."members/delete_post"?>" method="post">
                        <input type="hidden" name="post" value="<?php echo $post->id; ?>" />
                        <button type="submit" class="btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </form>
                <?php } ?>
            </div>



    <div class="post-content">
        <div class="row">    
            <div class="container" style="margin-top: 12px;">
            <div class="col-xs-2">
            <center>
                <div id="imagePreview" style="top: 2px;">
                <a href="<?php echo url::base().$post->user->username; ?>">
                    <?php if($post->user->photo->profile_pic_s) { ?>
                        <img src="<?php echo url::base().'upload/'.$post->user->photo->profile_pic;?>" height="100%">
                    <?php } else { ?>
                        <img src="<?php echo url::base().'img/no_image_s.png' ?>" height="100%"/>
                    <?php } ?>
                </a>
            </div>
            </center>
            </div>
            <div class="col-xs-10">
             <div class="post-title">
            <strong>
                <a href="<?php echo url::base().$post->user->username; ?>">
                    <?php echo $post->user->user_detail->first_name ." ".$post->user->user_detail->last_name ; ?>
                </a>
            </strong>
            <span style="font-size: 14px; font-weight:500;">
            <?php echo $post->action; ?>
            </span>
            <br/>
            <span class="post-time-box pull-left dis-block" style="top: 2px;">
        <input type="hidden" value="<?php echo strtotime($post->time); ?>" class="post_time" />
        <?php $age = time() - strtotime($post->time);
            if ($age >= 86400) {
                echo date('jS M', strtotime($post->time));
            } else {
                echo Date::time2string($age);
            }
        ?>
    </span>
        </div>

            </div>
            </div>
            <div class="col-xs-12 post-matter">
                <p style="font-size:16px; font-weight:500;"><?php
                    echo nl2br($post->post);
                ?></p>
            </div>
            <div class="container" style="border-top: 1px solid rgba(211, 211, 211, 0.56);">
            
            <div class="comments" style="display:block; /*overflow:scroll;overflow-x:hidden;max-height:430px;*/background: none;">
                <?php $comments = $post->comments->where('is_deleted', '=', 0)->find_all()->as_array(); ?>
                <?php if (!empty($comments)) { ?>
                    <?php foreach ($comments as $comment) { ?>



                        <div class="comment row" style="border-bottom: 1px solid rgba(211, 211, 211, 0.56);background: #fafafa;">
                       <div class="row">
                     <div class="col-xs-2">
                     <center>
                            <div id="imagecommter" style="overflow: hidden; left: -2px;">
                                <a href="<?php echo url::base().$comment->user->username; ?>">
                                    <?php if($comment->user->photo->profile_pic_m) { ?>
                                        <img src="<?php echo url::base().'upload/'.$comment->user->photo->profile_pic;?>" height="100%">
                                    <?php } else { ?>
                                        <img src="<?php echo url::base().'img/no_image_m.png' ?>" height="100%"/>
                                    <?php } ?>
                                </a>
                            </div>
                            </center>
                      </div>
                       <div class="col-xs-10">       
                            <div class="comment-content">
                                <strong>
                                    <a href="<?php echo url::base().$comment->user->username; ?>">
                                        <?php echo $comment->user->user_detail->first_name .' '. $comment->user->user_detail->last_name; ?>
                                    </a>
                                </strong>
                                <span style="font-size: 14px; font-weight:400;">
                                <?php
                                    echo ' '.nl2br(preg_replace(
                                        "/(http:\/\/|ftp:\/\/|https:\/\/|www\.)([^\s,]*)/i",
                                        "<a href=\"$1$2\" target=\"_blank\">$1$2</a>",
                                        $comment->comment
                                    ));
                                ?>
                                </span>
                            </div>
                    <span class="post-time-box comment-time-box pull-left dis-block" style="top: 2px;">
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

                            <?php if($comment->user->id == Auth::instance()->get_user()->id) { ?>
                                <form class="delete_comment pull-right" action="<?php echo url::base()."members/delete_comment"?>" method="post" style="margin-top: -20px;">
                                    <input type="hidden" name="comment" value="<?php echo $comment->id; ?>" />
                                    <button type="submit" class="btn btn-primary btn-xs" style="background: none;border-radius: 50%;color: rgba(0, 0, 0, 0.44);background: lightgray;">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </form>
                            <?php } ?>
                            
                            <div class="clearfix"></div>
                        </div>
                        
                    <?php } ?>
                
                <?php } else { ?>
                    <span class="no_comment">No comment yet. Be the first one to comment.</span>
                <?php } ?>
                
            </div>
    </div>
    <div class="container" style="margin-top: 12px;">
    <form role="form" class="add_comment text-center" action="<?php echo url::base()."members/add_comment"?>" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post->id;?>" />
                    <textarea name="comment" class="form-control input-comment" rows="2" placeholder="Type a comment..." style="height: 37px;font-size: 13px;width:70%;"></textarea>
                    <button type="btn" class="btn" style="background: #00bcd4;color: #fff;margin-top: -61px;position: relative;left: 111px;border-radius: 5px;">submit</button>
                </form>
                </div>
</div>
</div>
<style>
.modal-content{
    width: 200%;
    margin-left: -260px;
}
</style>
<script type="text/javascript">
    $('document').ready(function(){
        $(".comments").animate({ scrollTop: $(this).height() }, "slow")
    return false;  
    });
       
</script>