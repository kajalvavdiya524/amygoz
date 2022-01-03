 <style type="text/css">
    @font-face {
    font-family: GreycliffCF-Bold;
    src: url(application/views/fonts/GreycliffCF-Bold.otf);
    }
    @font-face {
    font-family: GreycliffCF-Regular;
    src: url(application/views/fonts/GreycliffCF-Regular.otf);
    }
    @font-face {
    font-family: GreycliffCF-Light;
    src: url(application/views/fonts/GreycliffCF-Light.otf);
    } /*startnew*/
    .d-flex{display: flex;}
    .flex-between{justify-content: space-between;}
    .top-header{background-color: rgb(255,255,255,82%);border-bottom: 1px solid #979797;padding-bottom: 10px}
    .profile-section{background-color: #fff;border:1px solid #F1F3F8;border-radius: 10px;}
    .profile-section .post-items h6{font-size: 20px;}
    .profile-section .post-items h6 span{font-size: 20px;}
    .profile-section .user-description .user-name{font-size: 24px}
    .profile-section .user-description #description-more{display: none;}
    .profile-section .user-description #description-more:target{display: block;}
    .new-member{border:1px solid #F1F3F8;border-radius: 10px;padding: 14px;margin-top: 20px;}
    .new-member h2{font-size: 20px;margin: 0px;color: #000;}
    .new-member p{font-size: 14px;margin: 0px;color: #000;padding: 7px 0px 10px 0px}
    .profile-section .user-description .btn-get-inspired{background-color: #FF5A5F;width: 248px; height: 36px;color:#fff;border-radius: 20px;font-size: 15px}
    .new-member .btn{background-color: #FF5A5F;width: 100%; height: 36px;color:#fff;border-radius: 20px;font-size: 15px}
    .new-member .btn:focus{outline: none;}
    .profile-section .user-description button:focus{outline: none;}
    .profile-section .user-description .btn-chat,.profile-section .user-description .btn-add{background: transparent; border:2px solid #F1F2F4; border-radius: 50%;width: 38px;height: 38px;line-height: 2.9; padding:0;margin-top: -8px;}
    .profile-section .location,.profile-section .study,.profile-section .friends{font-size: 16px}
    .profile-section .profile-link{font-size: 15px;color: #00BCD4}
    .profile-tabs{margin-bottom: 0px;padding-bottom: 10px;background-color: #fff;display: flex;justify-content: space-around;list-style-type: none;padding: 0}
    .profile-tabs li{width:100%;text-align: center;}
    .profile-tabs li a{color: #8991A0;font-size: 14px;display: block;padding: 10px 0;border-bottom: 2px solid transparent}
    .profile-tabs li a.active{color: #FF5A5F;border-bottom: 2px solid #FF5A5F}
    .img-gradient{background-image: linear-gradient(#FF585D, #FB947F);height: 104px;border-radius: 4px;margin-left: auto;margin-right: auto;}
    .post-inner .item-text{font-size: 14px;display: inline-block;color: #fff;padding: 20px 10px}
    .post-inner:after{clear: both;content: '';display: block;width: 100%}
    .post-inner img{border-radius: 4px;margin-left: auto;margin-right: auto;}
    .btn-edit-profile{background-color: #F1F2F4;width: 100%; height: 36px;color:#010101;border-radius: 20px;font-size: 15px;border:1px solid #DCE1EA;}
    .bg-img-inspiration{background-image: url('../images/Group 336.png');height: 104px;border-radius: 4px;margin-left: auto;margin-right: auto;}
    .bg-img-inspiration .item-text{ bottom: -7px;position: absolute;width: 80%;font-size: 12px;display: inline-block;color: #fff;}
    .btn-sign-up{background-color: #FF5A5F;width: 100%; height: 36px;color:#fff;border-radius: 20px;font-size: 15px}
    .btn-sign-in{background-color: #F1F2F4;width: 100%; height: 36px;color:#010101;border-radius: 20px;font-size: 15px;}
    .bg-img-inspiration{height: 120px;position: relative;background-size: cover;width: 100%;border-radius: 2px!important;}
    .bg-img-inspiration:after{content: "";position: absolute;background-color: rgba(0,0,0, 0.2);width: 100%;height: 100%;border-radius: 4px!important;}
    .bg-img-inspiration .item-text{ bottom: -11px!important;z-index:100;left:-2px!important;position: absolute;width: 100%;font-size: 12px;display: inline-block;color: #fff;}
    #inspiration,#post,#reviews,#about{display: none;margin-right: -15px;margin-left: -15px;}
    .active{display: block!important;background-color: #ffffff;}
    .btnDesktop{padding-top: 8px;}
    .btnDesktop .btn-get-inspired{background-color: #FF5A5F;padding: 9px 80px;color:#fff;border-radius: 20px;font-size: 15px}
    .event-list > li > name{
    width: 46px!important;
    }
    .event-list > li > .info{
    padding-top: 12px!important;
    padding-bottom: 5px!important;
    }
    .event-list > li > .info h5,.event-list > li > .info p{
    margin: 0px!important;
    }
    .event-list > li > .info h5 a{
    font-size: 14px!important;
    }
    .event-list > li > .info > .title, .event-list > li > .info > .desc{
    padding-left: 0px!important;
    }
    .zIndex{
    position: relative;
    z-index: 100;
    background: #fff;
    }
    .event-list > li{
    border-left: none!important;
    border-right: none!important;
    border-top: none!important;
    border-bottom: 1px solid #e5e5e5!important;
    padding-bottom: 10px!important;
    margin: 0!important;
    padding-top: 4px!important;
    }
    /*about sectiion*/
    #about .about-h{
        color: #FF5A5F;
        font-size: 12px;
    }
    #about .abt-value{
        font-size: 14px;
        color: #010101;
    }
    #about .divider-about{
        padding: 5px;
        background-color: #F1F2F4;
    }
    #about .abt-value.url{
        color: #FF5A5F;
        text-transform: lowercase;
    }
    #about .friends-h{
    font-size: 16px;
    color: #010101;
    padding: 10px 0px;

    }
    #about .friends-h span,#about .friends-h a{
        float: right;    
    }
    #about .friends-h a{
        margin-top: -2px;
        margin-left: 6px;

    }
    #about .inner-h{
        font-size: 12px;
        color: #8991A0;
    }
    /*endnew*/
    .trending-pro-main{
        border: 1px solid #F1F3F8;
        border-radius: 10px;
        margin-top: 20px;
    }
    .trending-pro-main img{
        margin-right: 10px;
    }
    .trending-pro-main .border-bottom{
        padding: 10px 10px;
        border-bottom: 1px solid #F1F3F8;
    }
    .trending-header{
        border-bottom: 1px solid #F1F3F8;
    }
    .trending-header p{
        padding: 15px 10px;
        font-size: 16px;
        font-weight: bold;
        margin: 0px;
    }
    .trending-header p a{
        float: right;
        font-size: 14px;
        font-weight: 400;
        color: #8991A0;
    }
    .btn-add-p{margin-left: auto;}
    .btn-add-p .btn-add{background-color: #FF5A5F;height: 36px;color:#fff;border-radius: 20px;font-size: 15px}
    .btn-add-p .btn-add:focus{outline: none}
    .px-20{
    padding: 20px 20px;
    }
    #badge_Sweet,#badge_Joyful,#badge_Friendly,#badge_Optimist,#badge_Generous,#badge_Egotistical,#badge_Funny,#badge_Sympathetic,#badge_Bossy{
        border-radius: 30px;
        margin-right: 3px;
        padding: 3px 16px;
        background-image: linear-gradient(to bottom, #FD5B5F, #FB907D)!important;
        font-size: 14px!important;
        /*font-family:GreycliffCF-Regular;*/
        color: #fff!important;
    }
    #badge_Social,#badge_Respectful,#badge_Sensitive,#badge_Smart,#badge_Mean,#badge_Courteous,#badge_Courageous,#badge_Considerate{
        border-radius: 30px;
        margin-right: 3px;
        padding: 3px 16px;
        background-color:#00BCD4!important;
        font-size: 14px!important;
        /*font-family:GreycliffCF-Regular;*/
        color: #fff!important;
    }
    #badge_Honest,#badge_Thoughtful,#badge_Charismatic,#badge_Materialistic,#badge_Ambitious,#badge_Affectionate,#badge_Dependable,#badge_Lazy{
        border-radius: 30px;
        margin-right: 3px;
        padding: 3px 16px;
        background-image: linear-gradient(to bottom, #FD935B, #FBC27D)!important;
        font-family:GreycliffCF-Regular;
        font-size: 14px!important;
        color: #fff!important;
    }
    .border-social{
        border-left:1px solid #F1F3F8!important;
        border-right:1px solid #F1F3F8!important;
        border-bottom:1px solid #F1F3F8!important;
        border-radius: 0px 0px 10px 10px;
        margin-bottom: 30px;
    }
    .bg-white{
        background: #fff;
    }
    .title-inspiration{
        margin-top: 20px;
    }
    #inset{
        min-height: auto!important;
        width: 130px!important;
        height: 130px!important;
        border-radius: 50%;
    }
    #inset h1{
        font-size: 54px!important;
        line-height: 94px!important;
    }
    .img-width{
        width: 75px;
        height: 75px;
        object-fit: cover;
    }
    .post-item-top {
        margin-bottom: 0px;
    }
    .comments {
        display: block;
        font-size: 16px;
    }
    @media (min-width: 540px) {
        .post-username {
            margin-right: 30%;
        }
    }
    .modal-header {
        min-height: 16.43px;
        padding: 20px 0px 25px 0px;
        border-bottom: 1px solid #e5e5e5;
    }
    #imagebatter {
        width: 80px;
        height: 80px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
        margin-top: 3px;
    }
</style>
<?php if($post->user->is_blocked == 0) { //check user is blocked or not ?>
    <div class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" style="top: 20px;">
                    <div class="profile-section px-20">
                        <div class="d-flex flex-between align-center">
                            <div class="col-sm-2" style="padding-left: 0px;padding-right: 0px;">
                                <?php $photo = $post->user->photo->profile_pic;
                                $post_image = file_exists("mobile/upload/" .$photo);
                                $post_image1 = file_exists("upload/" .$photo);
                                if(!empty($photo) && $post_image) { ?>
                                    <img class="img-responsive img-width" alt="<?php echo $post->user->user_detail->first_name." ".$post->user->user_detail->last_name; ?>" src="<?php echo url::base().'mobile/upload/'.$post->user->photo->profile_pic;?>">
                                <?php }
                                else if(!empty($photo) && $post_image1) { ?>
                                    <img class="img-responsive img-width" alt="<?php echo $post->user->user_detail->first_name." ".$post->user->user_detail->last_name; ?>" src="<?php echo url::base().'upload/'.$post->user->photo->profile_pic;?>">
                                <?php } else { ?>
                                    <div id="inset" style="width:100%; height:100%;">
                                        <h1 style="font-size: 95px;line-height: 160px;">
                                        <?php echo $post->user->user_detail->get_no_image_name(); ?>
                                        </h1>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-sm-6 post-items post-username" style="padding-left: 0px;">
                                <strong>
                                    <a href="<?php echo url::base().$post->user->username; ?>" style="font-size: 16px;">
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
                            <div class="col-sm-2 post-items"  style="padding-right: 0px;">
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
                                            <button style="background:none!important;border:none;cursor:pointer;width: 100px;" type="submit" onclick="openShareDialog(<?php echo $post->id?>)">Share</button>
                                        </li>
                                    </ul>
                                </div>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <?php if($post->post){?>
                                    <div class="post-matter" style="padding-top: 15px;">
                                        <p style="font-size: 16px;color: #4d4d4d;">
                                            <?php echo nl2br($post->post); ?>
                                            <?php if(!empty($post->photo) && preg_match('/\.(?:jpe?g|png|gif)(?:$|[?#])/', $post->photo)) { ?>
                                                <span class="image padTopBottom5"><a href="<?php echo $post->photo; ?>" class="img-pop"><img src="<?php echo $post->photo; ?>"></a></span>
                                            <?php } ?>
                                        </p>
                                    </div>
                                <?php } 
                                if(empty($post->post) && !empty($post->photo) && preg_match('/\.(?:jpe?g|png|gif)(?:$|[?#])/', $post->photo)) { ?>
                                    <div class="post-matter" style="padding-top: 15px;">
                                        <p style="font-size: 16px;">
                                            <?php echo nl2br($post->post);?>
                                            <span class="image padTopBottom5"><a href="<?php echo $post->photo; ?>" class="img-pop"><img src="<?php echo $post->photo; ?>"></a></span>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <hr style="margin-top: 11px;margin-bottom: 3px;"/>
                        <div class="d-flex marTop10">
                            <div class="post-actions pull-left">
                                <span class="toggle_comments total_comments" style="color: #4b4f56;font-size: 15px;font-weight: bold;margin-left: 9px;">
                                    <span class="glyphicon glyphicon-comment"></span> 
                                    <?php $count_comments = $post->comments->where('is_deleted', '=', 0)->count_all(); ?> 
                                    <span class="comment-count"><?php echo $count_comments; ?></span>
                                    <span class="comment-text"><?php echo ($count_comments > 1) ? " comments" : " comment" ?></span>
                                </span> 
                                <span class="seperator" style="color: #4b4f56;margin-left: 10px;">|</span>

                                <span style="color: #4b4f56;font-weight: bold;margin-left: 10px;">
                                    <a href="javascript:void(0)" onclick="openShareDialog(<?php echo $post->id?>)" style="color: #4b4f56;text-decoration:none;font-size: 15px;">
                                    <i class="fa fa-share-alt"></i> Share</a></li>
                                </span>

                                <!-- <span class="seperator" style="color: #4b4f56;margin-left: 10px;">|</span>

                                <span style="color: #4b4f56;font-weight: bold;margin-left: 10px;">
                                    <a href="<?php echo url::base(); ?>" style="color: #4b4f56;text-decoration:none;font-size: 15px;">
                                    <i class="demo-icon icon-user-add"></i> Invite</a>
                                </span> -->
                        
                            </div>
                        </div>
                        <div class="d-flex">
                            
                        </div>
                        <div class="d-flex marTop10">
                            <div class="comments" style="background: none;width: 100%;">
                                <div class="row" style="background: #f3f6f8;">
                                    <?php $comments = $post->comments->where('is_deleted', '=', 0)->find_all()->as_array(); ?>
                                    <?php if (!empty($comments)) { ?>
                                        <?php foreach ($comments as $comment) { ?>
                                            <div class="comment clearfix">
                                                <div class="comment-user-img pull-left col-sm-2" style="padding: 7px;">
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

                                                <div class="col-sm-10" style="margin-top:6px;">
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
                <div class="col-lg-4">
                    <div class="new-member">
                        <h2>New to Amygoz??</h2>
                        <p>Sign up now to get your own personalized timeline</p>
                        <a href="https://www.amygoz.com/" class="btn">Create an account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<style>
    .user-pro-pic-admit {
        width: 200px;
        height: 200px;
        background: #fff;
        overflow: hidden;
        margin: 0px auto;
        margin-top: 0px;
        position: relative;
        margin-top: -50px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px 1px #d1d1d1;
        border:5px solid #fff;
        background-size: cover;
        background-position: center center;
    }
    .src-image {
    display: none;
    }

    .col-sm-12.marTop20 {
        margin-top: 45px !important;
    }
    .list-group-item.col-sm-3.boxpanal {
        margin: width;
        width: 255px;
        margin: 2px;
    }
    .row.left{ margin-left: 0px; }

    body{padding-top:30px;}

    .glyphicon {  margin-bottom: 10px;margin-right: 10px;}

    small {
    display: block;
    line-height: 1.428571429;
    color: #999;
    }

    .card {
    overflow: hidden;
    position: relative;
    border: 1px solid #F9F4F4;
    border-radius: 8px;
    text-align: center;
    padding: 0;
    background-color:#708090;
    color: rgb(136, 172, 217);
    }

    .card .header-bg {
    /* This stretches the canvas across the entire hero unit */
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 90px;
    border-bottom: 1px #FFF solid;
    /* This positions the canvas under the text */
    z-index: 1;
    background-color:#C4BFBD;
    }
    .card .avatar {
    position: relative;
    margin-top: 15px;
    z-index: 100;
    }

    .card .avatar img {
    width: 100px;
    height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 2px solid rgba(0,0,30,0.8);
    }
</style>
<script src='<?php echo url::base();?>js/clipboard.min.js'></script>
<script>
var link = $("#hdnCopyPostURL").val();
var clipboard = new Clipboard('#copyPostURL', {
    text: function() {
        return link;
    }
});
</script>