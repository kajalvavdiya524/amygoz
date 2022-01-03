<style>
    .post {
        padding: 20px;
    }
    .post-by {
        font-size: 18px;
        padding-left:20px;
        padding-top: 5px;
    }
    .post-by a {
        font-size: 18px;
    }
    .comments {
        display: block;
        font-size: 16px;
    }
    .comments a {
        font-size: 16px;
    }
    #imagerather {
        width: 75px;
        height: 75px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
        margin-top: 3px;
        position: relative;
        right:19px;
    }
    #imagebatter {
        width: 50px;
        height: 50px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
        margin-top: 3px;
    }
    #myTextArea {
      width: 100%;
      min-height: 35px;
      overflow-y: hidden;
    }
</style>

<script>
    $(function() {
      $('#myTextArea').on('keyup paste', function() {
        var $el = $(this),
            offset = $el.innerHeight() - $el.height();

        if ($el.innerHeight < this.scrollHeight) {
          //Grow the field if scroll height is smaller
          $el.height(this.scrollHeight - offset);
        } else {
          //Shrink the field and then re-set it to the scroll height in case it needs to shrink
          $el.height(1);
          $el.height(this.scrollHeight - offset);
        }
      });
    });
</script>

<?php  
if($post->user->is_blocked == 0) { //check user is blocked or not ?>
<div class="post" style="box-shadow:0 0 0 1px rgba(0,0,0,.1),0 2px 3px rgba(0,0,0,.2);background:#fefefe; border-radius: 3px 3px 0px 0px;padding: 20px;margin: 20px">
    <div class="row">
        <div class="container" style="margin-top: -6px;max-width: 800px;">
            <div class="col-sm-2">
                <div class="fileinput-preview" id="imagerather" style="overflow: hidden; background-color: white;">
                    <a href="<?php echo url::base().$post->user->username; ?>">
                        <?php 
                            $photo = $post->user->photo->profile_pic;
                            $post_image = file_exists("mobile/upload/" .$photo);
                            $post_image1 = file_exists("upload/" .$photo);
                        if(!empty($photo) && $post_image) { ?>
                            <img class="" src="<?php echo url::base().'mobile/upload/'.$post->user->photo->profile_pic;?>" alt="<?php echo $post->user->user_detail->first_name." ".$post->user->user_detail->last_name;?>" height="100%">
                        <?php }
                        else if(!empty($photo) && $post_image1) { ?>
                            <img class="" src="<?php echo url::base().'upload/'.$post->user->photo->profile_pic;?>" alt="<?php echo $post->user->user_detail->first_name." ".$post->user->user_detail->last_name;?>" height="100%">
                        <?php } else { ?>
                            <div id="inset" class="xs noMar">
                                <h1>
                                    <?php echo $post->user->user_detail->get_no_image_name();?>
                                </h1>
                            </div>
                        <?php } ?>
                    </a>
                </div>
            </div>
            <div class="col-sm-8 post-by">
                <strong>
                    <a href="<?php echo url::base().$post->user->username; ?>">
                        <?php if($post->type === 'profile_details2') {
                            echo $post->user->user_detail->first_name ." ".$post->user->user_detail->last_name ."'s" ;
                        } else { 
                            echo $post->user->user_detail->first_name ." ".$post->user->user_detail->last_name ;
                        } ?>
                    </a>
                </strong>
                <?php if($post->type == 'inspired' || $post->type == 'friend') {
                    $link = $post->action;                            
                    $regex='#\<a href="([^"]*)".*?\>(.+?)\<\/a\>#s';
                    preg_match_all($regex, $link, $matches, PREG_SET_ORDER);
                    $target_username = $matches[0][1];
                    $target_fullname = $matches[0][2];

                    echo str_replace('<a href="'.$target_username.'">', '<a href="'.url::base().$target_username.'">', $post->action);
                }
                else {
                    echo $post->action;
                } ?>
                <br/>
                <span class="post-time-box" style="font-size: 16px;color: #90949c;">
                    <i class="fa fa-clock-o"></i> 
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

            <div class="dropdown pull-right">
                <button style="margin-top: 1px;margin-right: 1px; border:none; background-color:#fafafa;"  class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>

                <ul class="dropdown-menu" style="background-color:#ebebeb;min-width:100px;" role="menu" aria-labelledby="menu1">
                    <li role="presentation">
                        <input type="hidden" name="hdnCopyPostURL" id="hdnCopyPostURL" value="<?php echo url::base()."post/".md5(sha1($post->id));?>" />
                        <button style="background:none!important;border:none;cursor:pointer;width: 100px;" id="copyPostURL">Copy Link</button>
                    </li>
                    <li role="presentation">
                        <button style="background:none!important;border:none;cursor:pointer;width: 100px;" type="submit" onclick=openShareDialog(<?php echo $post->id?>)>Share</button>
                    </li>
                </ul>
            </div>

            <div id="postModal<?php echo $post->id; ?>" class="modal" style="z-index: 9999;">
                <div class="modal-content" style="width: 30%;height: 50%;left: 35%;top: 25%;">
                    <div class="modal-header">
                        <div class="col-xs-12">
                            <h4 class="pull-left" style="margin-top: 0px;">Share</h4>
                            <span class="close pull-right" onclick=closeModal(<?php echo $post->id?>) style="color: #4e4c4c;opacity: 1;">&times;</span>
                        </div>   
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                $title = $post->post;
                                $url = urlencode(url::base()."post/".md5(sha1($post->id)));
                                ?>
                                <a href="http://www.facebook.com/sharer.php?u=<?php echo $url;?>&p[title]=<?php echo $title;?>" target="_blank"> <img src="<?php echo url::base().'img/fb.png' ?>" height="100%"/> </a>
                                <a href="http://twitter.com/share?text=<?php echo $title;?>&url=<?php echo $url;?>" target="_blank"> <img src="<?php echo url::base().'img/twitter.png' ?>" height="100%" style="margin-left: 10%;"/> </a>
                            </div>
                        </div>     
                    </div>
                </div>
            </div>
            <script>
                function openShareDialog(postId){
                    $('#postModal'+postId).modal('toggle');
                }
                function closeModal(postId){
                    $('#postModal'+postId).modal('hide');
                }
            </script>
        </div>

        <div class="container" style="margin-top: 5px;padding-left: 8px;white-space: normal;max-width: 800px;">
            <div id="postWrap">
                <div class="post-content"> 
                    <?php if($post->post){?>
                        <div class="post-matter">
                            <p style="font-size: 18px;color: #4d4d4d;">
                                <?php echo nl2br($post->post); ?>
                                <?php if(!empty($post->photo) && preg_match('/\.(?:jpe?g|png|gif)(?:$|[?#])/', $post->photo)) { ?>
                                    <span class="image padTopBottom5"><a href="<?php echo $post->photo; ?>" class="img-pop"><img src="<?php echo $post->photo; ?>"></a></span>
                                <?php } ?>
                            </p>
                        </div>
                    <?php } 
                    if(empty($post->post) && !empty($post->photo) && preg_match('/\.(?:jpe?g|png|gif)(?:$|[?#])/', $post->photo)) { ?>
                        <div class="post-matter">
                            <p style="font-size: 16px;">
                                <?php echo nl2br($post->post);?>
                                <span class="image padTopBottom5"><a href="<?php echo $post->photo; ?>" class="img-pop"><img src="<?php echo $post->photo; ?>"></a></span>
                            </p>
                        </div>
                    <?php } ?>
                </div>

                <hr style="margin-top: 11px;margin-bottom: 3px;"/>

                <div class="post-actions pull-left">
                    <span class="toggle_comments total_comments" style="color: #4b4f56;font-size: 12px;font-weight: bold;margin-left: 9px;">
                        <span class="glyphicon glyphicon-comment"></span> 
                        <?php $count_comments = $post->comments->where('is_deleted', '=', 0)->count_all(); ?> 
                        <span class="comment-count"><?php echo $count_comments; ?></span>
                        <span class="comment-text"><?php echo ($count_comments > 1) ? " comments" : " comment" ?></span>
                    </span> 
                    <span class="seperator" style="color: #4b4f56;margin-left: 26px;">|</span>

                    <span style="color: #4b4f56;font-size: 12px;font-weight: bold;margin-left: 24px;">
                        <a href="<?php echo url::base(); ?>" style="color: #4b4f56;text-decoration:none;">
                        <i class="fa fa-star"></i> Review</a></li>
                    </span>

                    <span class="seperator" style="color: #4b4f56;margin-left: 26px;">|</span>

                    <span style="color: #4b4f56;font-size: 12px;font-weight: bold;margin-left: 24px;">
                        <a href="<?php echo url::base(); ?>" style="color: #4b4f56;text-decoration:none;">
                        <i class="demo-icon icon-user-add"></i> Invite</a>
                    </span>
            
                </div>

                <div class="clearfix"></div>

                <div class="comments" style="background: none;">
                    <div class="row" style="background: #f3f6f8;">
                        <?php $comments = $post->comments->where('is_deleted', '=', 0)->find_all()->as_array(); ?>
                        <?php if (!empty($comments)) { ?>
                            <?php foreach ($comments as $comment) { ?>
                                <div class="comment clearfix container">
                                    <div class="comment-user-img pull-left col-md-1" style="padding: 7px;">
                                        <a href="<?php echo url::base().$comment->user->username; ?>">
                                            <center>
                                                <div class="fileinput-preview" id="imagebatter" style="overflow: hidden; background-color: white;">
                                                    <?php 
                                                        $photo = $comment->user->photo->profile_pic;
                                                        $comt_image = file_exists("mobile/upload/" .$photo);
                                                        $comt_image1 = file_exists("upload/" .$photo);
                                                    if(!empty($photo) && $comt_image) { ?>
                                                        <img src="<?php echo url::base().'mobile/upload/'.$comment->user->photo->profile_pic;?>" height="100%">
                                                    <?php }
                                                    else if(!empty($photo) && $comt_image1) { ?>
                                                        <img src="<?php echo url::base().'upload/'.$comment->user->photo->profile_pic;?>" height="100%">
                                                    <?php } else { ?>
                                                        <img src="<?php echo url::base().'img/no_image_m.png' ?>" height="100%"/>
                                                    <?php } ?>
                                                </div>
                                            </center>
                                        </a>
                                    </div>

                                    <div class="col-md-9" style="margin-top:6px;">
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

                                    <!-- <div class="col-md-2" style="margin-top:8px;">
                                        <?php //if($comment->user->id == Auth::instance()->get_user()->id) { ?>
                                            <form class="delete_comment pull-right" action="<?php echo url::base()."members/delete_comment"?>" method="post">
                                                <input type="hidden" name="comment" value="<?php echo $comment->id; ?>" />
                                                <button type="submit" class="btn btn-primary btn-xs" style="background: #d5d2d2;color: #00bcd4;border-radius: 50%;">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </form>
                                        <?php //} ?>
                                    </div> -->
                                </div>
                            <?php } ?>

                        <?php } else { ?>
                            <span class="no_comment">No comments yet. Be the first to comment.</span>
                        <?php } ?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php
}
?>
<script src='<?php echo url::base();?>js/clipboard.min.js'></script>
<script>
var link = $("#hdnCopyPostURL").val();
var clipboard = new Clipboard('#copyPostURL', {
    text: function() {
        return link;
    }
});
</script>