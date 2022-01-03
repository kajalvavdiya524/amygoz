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
<div class="post" style="box-shadow:0 0 0 1px rgba(0,0,0,.1),0 2px 3px rgba(0,0,0,.2);background:#fefefe; border-radius: 3px 3px 0px 0px;padding: 20px;">
    <div class="row">
        <div class="container" style="margin-top: -6px;">
            <div class="col-md-1">
                <center>
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
                </center>
            </div>
            <div class="col-md-10 post-by">
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

                    echo str_replace('<a href="'.$target_username.'">', '<a href="'.url::base().$target_username.'" style="font-weight:600;">', $post->action);
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
                    <?php if ($post->user->id == Auth::instance()->get_user()->id) { ?>
                        <form class="delete-post" action="<?php echo url::base()."members/delete_post"?>" method="post">
                            <li role="presentation">
                                <input type="hidden" name="post" value="<?php echo $post->id; ?>" />
                                <button style="background:none!important;border:none;cursor:pointer;width: 100px;" type="submit">Delete</button>
                            </li>
                        </form>
                    <?php } ?>
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
                                $title = ($post->post) ? $post->post : $post->photo;
                                $url = ($post->photo == '') ? urlencode(url::base()."post/".md5(sha1($post->id))) : $post->photo;
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

        <div class="container" style="margin-top: 5px;padding-left: 8px;white-space: normal;/*word-break: break-all;*/">
            <div id="postWrap">
                <div class="post-content"> 
                    <?php if($post->post){?>
                        <div class="post-matter">
                            <p style="font-size: 18px;color: #4d4d4d;">
                                <?php
                                    echo nl2br($post->post);
                                    if($post->type == 'recommend' && $post->user->id != Auth::instance()->get_user()->id) {
                                        $recommendations = $post->user->recommendations->where('state', '=', 'approve')->find_all()->as_array();
                                        $temp_words = array();
                                        foreach($recommendations as $recommend) {
                                            if($recommend->state == 'approve') { 
                                                $words = explode(', ', $recommend->words);
                                                $temp_words = array_merge($temp_words, $words);
                                            }
                                        }
                                        $tags = array_count_values($temp_words);
                                        $social = $post->user->calculate_social_percentage($tags);
                                ?>
                                <small class="dis-block">
                                    <button class="btn btn-primary btn-xs"><?php echo $post->user->user_detail->first_name."'s social percentile $social%."; ?></button> & <button class="btn btn-secondary btn-xs">Your social percentile <?php echo Session::instance()->get('social')."%."?></button>
                                    <br>
                                    <?php echo "Stay ahead of ".$post->user->user_detail->first_name;?> 
                                    <a class="btn btn-secondary btn-xs" href="<?php echo url::base()."peoplereview/askreview?ask=".$post->user->username;?>">Ask for Review</a>
                                </small>
                                <?php } else if($post->type == 'recommend') { ?>
                                    <small class="dis-block">
                                        Your social percentile is <button class="btn btn-secondary btn-xs"><?php echo Session::instance()->get('social')."%"; ?></button> Stay ahead of your friends. <a class="btn btn-secondary btn-xs" href="<?php echo url::base()."peoplereview/askreview?ask=".$post->user->username;?>">Ask for Review</a>
                                    </small>
                                <?php } ?>
                                <?php if(!empty($post->photo) && preg_match('/\.(?:jpe?g|png|gif)(?:$|[?#])/', $post->photo)) { ?>
                                    <img src="<?php echo $post->photo; ?>" alt="<?php echo $post->user->user_detail->first_name .' '.$post->user->user_detail->last_name ;?>" class="ballary_img" height="100%" width="100%"></a>
                                <?php } ?>
                            </p>
                        </div>
                    <?php } 
                    if(empty($post->post) && !empty($post->photo) && preg_match('/\.(?:jpe?g|png|gif)(?:$|[?#])/', $post->photo)) { ?>
                        <p style="font-size: 15px;color:black;font-weight: 500;margin-left: 2px;margin-right: 2px;" class="img-pop">
                            <?php echo nl2br($post->post);?>
                            <img src="<?php echo $post->photo; ?>" alt="<?php echo $post->user->user_detail->first_name .' '.$post->user->user_detail->last_name ;?>" class="ballary_img" height="100%" width="100%"></a>
                        </p>
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
                        <a href="<?php echo url::base().'peoplereview/compose?ask='.$post->user->username; ?>" style="color: #4b4f56;text-decoration:none;">
                        <i class="fa fa-star"></i> Review</a></li>
                    </span>

                    <span class="seperator" style="color: #4b4f56;margin-left: 26px;">|</span>

                    <span style="color: #4b4f56;font-size: 12px;font-weight: bold;margin-left: 24px;">
                        <a href="<?php echo url::base().'activity?user='.$post->user->username; ?>" style="color: #4b4f56;text-decoration:none;">
                        <i class="demo-icon icon-user-add"></i> Invite</a>
                    </span>
            
                </div>

                <div class="clearfix"></div>

                <div class="comments" style="background: none;">
                    <div class="row" style="background: #f3f6f8;">
                        <?php $comments = $post->comments->where('is_deleted', '=', 0)->find_all()->as_array(); ?>
                        <?php if (!empty($comments)) { ?>
                            <?php foreach ($comments as $comment) { ?>

                                <div class="comment clearfix container" style="background: #f3f6f8;margin-top:6px;border-bottom: 1px solid #e3e3e3;">
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

                            <?php } ?>

                        <?php } else { ?>
                            <span class="no_comment">No comments yet. Be the first to comment.</span>
                        <?php } ?>

                        <form role="form" class="add_comment" action="<?php echo url::base()."members/add_comment"?>" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post->id;?>" />
                            <textarea id="myTextArea" name="comment" class="form-control input-comment" rows="1" placeholder="Type a comment and press enter to post" style="border-radius: 5px !important;"></textarea>
                        </form>
                        <div class="clearfix"></div>    
                    </div>
                </div>
                <div class="clearfix"></div>
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