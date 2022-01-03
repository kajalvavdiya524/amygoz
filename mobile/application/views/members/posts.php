<style>
.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus {
    text-decoration: none;
    background-color: #ebebeb;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<?php foreach ($posts as $post) { 
    if($post->user->is_blocked == 0) { //check user is blocked or not ?>
        <div class="container marTop10"></div>
        <div class="post row" style="background: #fff;margin-top: 7px;border-top: 1px solid rgba(0, 0, 0, 0.06);"> 
            <div class="row" style="margin-top: 2px;">
                <div class="col-xs-1">
                    <center>
                        <div class="fileinput-preview" id="imagePreview" style="top: -3px;left: -7px;">
                            <a href="<?php echo url::base().$post->user->username; ?>">
                                <?php if($post->user->photo->profile_pic_s) { ?>
                                    <img src="<?php echo url::base()."upload/".$post->user->photo->profile_pic;?>" alt="<?php echo $post->user->user_detail->first_name." ".$post->user->user_detail->last_name;?>" height="100%">
                                <?php } else { ?>
                                    <div id="inset" class="xs noMar" style="margin-top: 0px;">
                                        <h1>
                                            <?php echo $post->user->user_detail->get_no_image_name();?>
                                        </h1>
                                    </div>
                                <?php } ?>
                            </a>
                        </div>
                    </center>
                </div>

                <div class="col-xs-10" style="position: relative;left: 14px;top: -6px;white-space: normal;word-spacing: normal;word-wrap: break-word;">
                    <strong>
                        <a href="<?php echo url::base().$post->user->username; ?>" style="font-size: 14px;">
                            <?php if($post->type === 'profile_details2') {
                                echo $post->user->user_detail->first_name ." ".$post->user->user_detail->last_name ."'s" ;
                            } else { 
                                echo $post->user->user_detail->first_name ." ".$post->user->user_detail->last_name ;
                            } ?>
                        </a>
                    </strong>
                    <span style="font-size: 14px;color:black;font-weight: 500;">
                        <?php echo $post->action; ?>
                        <br>
                        <span class="post-time-box" style="font-size: 11px;font-weight: 500;">
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
                    </span>
                </div>

                <div class="dropdown pull-right" style="margin-top: -59px;">
                    <button style="margin-top: 1px;border:none; background-color:#fafafa; border-radius: 50%;width: 37px;height: 37px;"  class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                        <img class="img-responsive" alt="Callitme logo" src="<?php echo url::base() . 'img/ver-menu.png'; ?>" / style="transform: rotate(90deg);">
                    </button>

                    <ul class="dropdown-menu" style="background-color:#ebebeb;min-width:100px;" role="menu" aria-labelledby="menu1">
                        <?php if ($post->user->id == Auth::instance()->get_user()->id) { ?>
                            <form class="delete-post" action="<?php echo url::base()."members/delete_post"?>" method="post">
                                <li role="presentation">
                                    <input type="hidden" name="post" value="<?php echo $post->id; ?>" />
                                    <button style="background:none!important;border:none;cursor:pointer;width: 100px;" type="submit">Delete</button>
                                </li>
                            </form>
                        <?php } ?>
                        <li role="presentation">
                            <a href="<?php echo url::base()."post/".md5(sha1($post->id));?>" style="font-size: 14px !important;padding: 0px;"><button style="background:none!important;border:none;cursor:pointer;width: 100px;" type="submit">View Post</button></a>                                
                        </li>
                        <li role="presentation">
                            <?php $post_url = url::base()."post/".md5(sha1($post->id)); ?>
                            <button style="background:none!important;border:none;cursor:pointer;width: 100px;" id="copyPostURL" onclick="copyPostURL('<?php echo $post_url;?>')">Copy Link</button>
                        </li>
                        <li role="presentation">
                            <button style="background:none!important;border:none;cursor:pointer;width: 100px;" type="submit" onclick=openShareDialog(<?php echo $post->id;?>)>Share</button>
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
                                    $name = $post->user->user_detail->first_name ." ".$post->user->user_detail->last_name;
                                    $post_title = $name."s post on Amygoz";
                                    $title = ($post->post) ? $post->post : $post_title;
                                    $url = urlencode(url::base()."post/".md5(sha1($post->id)));
                                    ?>
                                    <a href="http://www.facebook.com/sharer.php?u=<?php echo $url;?>&t=<?php echo $title;?>" target="_blank"> <img src="<?php echo url::base().'img/fb.png' ?>" height="100%"/> </a>
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

            <div class="row">
                <div class="post-content">
                    <?php if($post->post) { ?>
                        <div class="post-matter" style="font-size: 14px;">
                            <p style="font-size: 15px;color:black;font-weight: 500;margin-left: 2px;margin-right: 2px;" class="img-pop">
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
                                    <br>
                                    <small class="dis-block" style="color: #0f9db0;font-size: 15px;">
                                        <?php echo $post->user->user_detail->first_name;?>s social percentile
                                        <button class="btn btn-secondary btn-xs" style="border-radius: 50%;width: 40px;height: 40px;color: #fff;background: rgb(255, 23, 68);font-weight: 600;"> 
                                        <?php echo $social."%"; ?></button>
                                        & <br>Your social percentile <button class="btn btn-secondary btn-xs" style="border-radius: 50%;font-weight: 600;width: 40px;height: 40px;color: #fff;background: rgb(255, 23, 68)"><?php echo Session::instance()->get('social')."%"?></button><br><?php echo "Stay ahead of ".$post->user->user_detail->first_name;?>
                                        <br>
                                        <a class="btn btn-secondary btn-xs" href="<?php echo url::base()."peoplereview/askreview?ask=".$post->user->username;?>" style="padding: 7px;border-radius: 5px;">Ask for Review</a>
                                    </small>
                                <?php } else if($post->type == 'recommend') { ?>
                                    <br/>
                                    <small class="dis-block" style="color: #ff2a7f;font-size: 15px;">
                                        Your social percentile is <button class="btn btn-secondary btn-xs" style="border-radius: 50%;width: 40px;height: 40px;color: #fff;background: rgb(255, 23, 68);font-weight: 600;"><?php echo Session::instance()->get('social')."%"; ?></button> <br>Stay ahead of your friends. <a class="btn btn-secondary btn-xs" href="<?php echo url::base()."peoplereview/askreview?ask=".$post->user->username;?>" style="padding: 7px;border-radius: 5px;">Ask for Review</a>
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

            </div>

            <div class="clearfix"></div>

            <div class="row text-center" style="position: relative;top: 15px;border: 1px solid rgba(0, 0, 0, 0.06);padding: 6px 0px 6px 0px;background: white;margin-top:-6px">
                <div class="col-xs-4 total_comments" style="font-size:14px;font-weight: 400;">
                    <a href="<?php echo url::base() . "members/view_post/" . $post->id; ?>">
                        <span class="glyphicon glyphicon-comment" style="color: #747474;font-size: 19px;"></span>
                        <?php $count_comments = $post->comments->where('is_deleted', '=', 0)->count_all(); ?> 
                        <span class="comment-count" style="font-size: 12px;color: #747474;padding-left: 18px;position: absolute;">(<?php echo $count_comments; ?>)</span>
                        <span class="comment-text"><?php echo ($count_comments > 1) ? " " : " " ?></span>
                    </a>
                </div>

                <div class="col-xs-4 text-center">
                    <a style="color: #747474;" href="<?php echo url::base().'peoplereview/compose?ask='.$post->user->username; ?>">
                        <i class="fa fa-star" style="font-size: 19px;"></i>
                    </a>
                </div>

                <div class="col-xs-4 text-center">
                    <a style="color: black;" href="<?php echo url::base().'activity?user='.$post->user->username; ?>">
                        <i class="icon-user-add" style="color: #747474;font-size: 18px;position: relative;top: -2px;"></i>
                    </a>
                </div>

            </div>
            <div class="clearfix"></div>

            <div class="comments" style="background:whitesmoke;">
                <?php $comments = $post->comments->where('is_deleted', '=', 0)->find_all()->as_array(); ?>
                <?php if (!empty($comments)) { ?>
                    <?php foreach ($comments as $comment) { ?>

                        <div class="clearfix">
                            <div class="col-xs-2">
                                <div class="fileinput-preview" id="imagebatter">
                                    <a href="<?php echo url::base().$comment->user->username; ?>">
                                        <?php if($comment->user->photo->profile_pic_m) { ?>
                                            <img src="<?php echo url::base()."upload/".$post->user->photo->profile_pic_s;?>">
                                        <?php } else { ?>
                                            <img src="<?php echo url::base().'img/no_image_m.png' ?>" />
                                        <?php } ?>
                                    </a>
                                </div>
                            </div>
                            <span class="comment-time-box pull-right dis-block" style="font-size: 11px;font-weight: 500;">
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

                            <?php if($comment->user->id == Auth::instance()->get_user()->id) { ?>
                                <form class="delete_comment pull-right" action="<?php echo url::base()."members/delete_comment"?>" method="post">
                                    <input type="hidden" name="comment" value="<?php echo $comment->id; ?>" />
                                    <button type="submit" class="btn btn-primary btn-xs" style="background:white;color: #7d7474;border-radius: 50%;">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </form>
                            <?php } ?>

                            <div class="clearfix"></div>
                        </div>

                    <?php } ?>

                <?php } else { ?>
                    <span class="no_comment">No comments yet. Be the first to comment.</span>
                <?php } ?>
                    <form role="form" class="add_comment" action="<?php echo url::base()."members/add_comment"?>" method="post">
                        <input type="hidden" name="post_id" value="<?php echo $post->id;?>" />
                        <textarea name="comment" class="form-control input-comment" rows="2" placeholder="Type a comment and press enter to post" style="height: 22px;font-size: 12px;line-height: 10px;border-radius: 0px;"></textarea>
                    </form>

                    <div class="clearfix"></div>    
            </div>
        </div>
<?php } //end if for inblocked users 
} ?>
<script src='<?php echo url::base();?>js/clipboard.min.js'></script>
<script>
function copyPostURL(link) {
    var clipboard = new Clipboard('#copyPostURL', {
        text: function() {
            return link;
        }
    });
}
</script>