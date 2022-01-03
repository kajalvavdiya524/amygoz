<div class="post">

    
    
    <span class="post-time-box pull-right dis-block">
        <input type="hidden" value="<?php echo strtotime($post->time); ?>" class="post_time" />
        <?php $age = time() - strtotime($post->time);
            if ($age >= 86400) {
                echo date('jS M', strtotime($post->time));
            } else {
                echo Date::time2string($age);
            }
        ?>
    </span>

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
            <div class="col-sm-5 post-matter">
                <p><?php
                    echo nl2br($post->post);
                ?></p>
            </div>
            
            <div class="user-img pull-left">
                <a href="<?php echo url::base().$post->user->username; ?>">
                    <?php 
                    $photo = $post->user->photo->profile_pic_s;
                    $post_image = file_exists("mobile/upload/" .$photo);
                    $post_image1 = file_exists("upload/" .$photo);
                    if(!empty($photo) && $post_image) { ?>
                        <img src="<?php echo url::base().'mobile/upload/'.$post->user->photo->profile_pic_s;?>">
                    <?php }
                    else if(!empty($photo) && $post_image1) { ?>
                        <img src="<?php echo url::base().'upload/'.$post->user->photo->profile_pic_s;?>">
                    <?php } else { ?>
                        <img src="<?php echo url::base().'img/no_image_s.png' ?>" />
                    <?php } ?>
                </a>
            </div>
             <div class="post-title">
            <strong>
                <a href="<?php echo url::base().$post->user->username; ?>">
                    <?php echo $post->user->user_detail->first_name ." ".$post->user->user_detail->last_name ; ?>
                </a>
            </strong>
            
            <?php echo $post->action; ?>
        </div>
            
            <div class="col-sm-7">
            
            <div class="comments" style="display:block; overflow:scroll;overflow-x:hidden;max-height:430px;">
                <?php $comments = $post->comments->where('is_deleted', '=', 0)->find_all()->as_array(); ?>
                <?php if (!empty($comments)) { ?>
                    <?php foreach ($comments as $comment) { ?>



                        <div class="comment">
                       <div class="row">
                     <div class="col-xs-2 col-md-2 col-log-2">
                            <div class="comment-user-img pull-left">
                                <a href="<?php echo url::base().$comment->user->username; ?>">
                                    <?php 
                                     $photo = $comment->user->photo->profile_pic_m;
                                    $comt_image = file_exists("mobile/upload/" .$photo);
                                    $comt_image1 = file_exists("upload/" .$photo);
                                    if(!empty( $photo) &&  $comt_image) { ?>
                                        <img src="<?php echo url::base().'mobile/upload/'.$comment->user->photo->profile_pic_s;?>">
                                    <?php }
                                    else if(!empty( $photo) &&  $comt_image1) { ?>
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
                        
                    <?php } ?>
                
                <?php } else { ?>
                    <span class="no_comment">No comment yet. Be the first one to comment.</span>
                <?php } ?>
                
                <form role="form" class="add_comment" action="<?php echo url::base()."members/add_comment"?>" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post->id;?>" />
                    <textarea name="comment" class="form-control input-comment" rows="2" placeholder="Type a comment and press enter to post" style="height: 35px;"></textarea>
                </form>
            </div>
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