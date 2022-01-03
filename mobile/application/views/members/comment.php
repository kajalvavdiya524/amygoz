<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<style>
.hed-pad-1{background: white;}
.hed-pad-2{position: relative;left: 35px;}
.btn-pad-1{margin-top: 1px;margin-right: 1px; border:none; background-color:#fefefe;}
.menu-pad-1{background-color:#fefefe;min-width:100px;}
.btn-pad-2{background:none!important;border:none;cursor:pointer;width: 100px;}
.text-pad-1{font-weight: 500; font-size: 15px;}
.text-pad-2{font-weight: 500; font-size: 17px;}
.text-pad-3{font-weight: 500; font-size: 16px;}
.text-pad-4{font-weight: 500; font-size: 14px;}
.btn-pad-3{
    margin-top: 29px;
    margin-left: 134px;
    background: #ff2a7f;
    color: #fff;
}
.mar-pad-1
{
    margin: 10px 0px 10px 0px;
}
</style>
<?php foreach ($posts as $post) { 
    if($post->user->is_blocked == 0) { //check user is blocked or not ?>
<div class="container marTop10"></div>
    <div class="col-xs-12 post hed-pad-1">
    <div class="row mar-pad-1">
    <div class="col-xs-12">
    <a href="<?php echo url::base();?>">
   <img class="web-sizing" alt="Callitme logo" src="https://m.callitme.com/img/callitme-arrow.png" style="float: left;position: relative;left: -35px;">
   </a>
    </div>
    </div>
        <div class="row">
            <div class="row">
                <div class="col-xs-1">
                    <center>
                    <div id="imagecommt" >
                    <a href="<?php echo url::base().$post->user->username; ?>">
                        <?php if($post->user->photo->profile_pic_s) { ?>
                            <img src="<?php echo url::base().'upload/'.$post->user->photo->profile_pic;?>" alt="<?php echo $post->user->user_detail->first_name." ".$post->user->user_detail->last_name;?>" height="100%">
                        <?php } else { ?>
                            <div id="inset" class="xs noMar">
                                <h1>
                                    <?php echo $post->user->user_detail->get_no_image_name();?>
                                </h1>
                                <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                            </div>
                        </div>
                            </center>
                        <?php } ?>
                    </a>
                </div>
            </div>
                <div class="col-xs-8 hed-pad-2">
                    <strong class="text-pad-2">
                                <a href="<?php echo url::base().$post->user->username; ?>" style="color: #f06292;">
                                    <?php if($post->type === 'profile_details2') {
                                        echo $post->user->user_detail->first_name ." ".$post->user->user_detail->last_name ."'s" ;
                                    } else { 
                                        echo $post->user->user_detail->first_name ." ".$post->user->user_detail->last_name ;
                                    } ?>
                                </a>
                            </strong>
                            <span class="text-pad-1">
                            <?php echo $post->action; ?>
                            </span>
                            <br/>
                            <small class="post-time-box">
                            <i class="fa fa-clock-o"></i> 
                            <input type="hidden" value="<?php echo strtotime($post->time); ?>" class="post_time" />
                            <?php $age = time() - strtotime($post->time);
                                if ($age >= 86400) {
                                    echo date('jS M', strtotime($post->time));
                                } else {
                                    echo Date::time2string($age);
                                }
                            ?>
                        </small>
                </div>
            <div class="dropdown col-xs-2">
              <button class="btn-pad-1 btn  dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
              <span class="caret"></span></button>

             <ul class="dropdown-menu menu-pad-1" role="menu" aria-labelledby="menu1">
                <form class="delete-post" action="<?php echo url::base()."members/delete_post"?>" method="post">
                <li role="presentation">
                                <input type="hidden" name="post" value="<?php echo $post->id; ?>" />
                                <button class="btn-pad-2" type="submit">Delete</button>
                </li>
            </form>
           <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Edit</a></li> -->
          </ul>
             </div>
            </div>
        </div>

                <div class="row">
                        <div class="row" style="margin-left: -10px;">
                        <?php $comments = $post->comments->where('is_deleted', '=', 0)->find_all()->as_array(); ?>
                        <?php if (!empty($comments)) { ?>
                            <?php foreach ($comments as $comment) { ?>

                                <div class="comment clearfix container" style="background: whitesmoke;margin-top:6px">
                                    <div class="col-xs-1" style="padding: 7px;">
                                        <a href="<?php echo url::base().$comment->user->username; ?>">
                                            <?php if($comment->user->photo->profile_pic_m) { ?>
                                            <center>
                                            <div id="imagecommter" style="overflow: hidden; background-color: white;">
                                                <img src="<?php echo url::base().'upload/'.$comment->user->photo->profile_pic;?>" height="100%">
                                            <?php } else { ?>
                                                <img class="img-responsive" src="<?php echo url::base().'img/no_image.png' ?>"/>
                                            <?php } ?>
                                        </a>
                                    </div>
                                </center>
                                    </div>
                                    <div class="col-xs-11" style="margin-top:6px;position: relative;left: 18px;">
                                    <div class="comment-content" style="padding-left: 0px;">
                                        <strong class="text-pad-3">
                                            <a href="<?php echo url::base().$comment->user->username; ?>" style="color: #f06292;">
                                                <?php echo $comment->user->user_detail->first_name .' '. $comment->user->user_detail->last_name; ?>
                                            </a>
                                        </strong>
                                        <span class="text-pad-4">
                                        <?php
                                            echo ' '.nl2br(preg_replace(
                                                "/(http:\/\/|ftp:\/\/|https:\/\/|www\.)([^\s,]*)/i",
                                                "<a href=\"$1$2\" target=\"_blank\">$1$2</a>",
                                                $comment->comment
                                            ));
                                        ?>
                                    </span>

                                    </div>
                                    <span class="comment-time-box pull-left dis-block" style="font-size: 12px; color: #807d7d;">
                                        <?php $comment_time = time() - strtotime($comment->time);
                                            if ($comment_time >= 86400) {
                                                echo date('M jS', strtotime($comment->time));
                                            } else {
                                                echo Date::time2string($comment_time);
                                            }
                                        ?>
                                    </span>
                                 </div>
                                  
                            
                            <div class="" style="margin-top:8px;position: relative;top: 10px;left: 7px;">
                                        <?php if($comment->user->id == Auth::instance()->get_user()->id) { ?>
                                    
                                        <form class="delete_comment pull-right" action="<?php echo url::base()."members/delete_comment"?>" method="post" style="position: relative;top: -12px;">
                                            <input type="hidden" name="comment" value="<?php echo $comment->id; ?>" />
                                            <button type="submit" class="btn btn-primary btn-xs" style="background: #d5d2d2;color: #00bcd4;border-radius: 50%;"> 
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </form>
                                    <?php } ?>
                                    <br/>
                                    
                                    </div>
                                    </div>
                                      <div class="clearfix"></div>
                            <?php } ?>
                    </div></div></div></div></center></div></div></div></div>
                    <div class="row">
                            <?php } else { ?>
                            <span class="no_comment">No comments yet. Be the first to comment.</span>
                        <?php } ?>

                        <form role="form" class="add_comment" action="<?php echo url::base()."members/add_comment"?>" method="post" style="position: ;width: 100%;">
                            <input type="hidden" name="post_id" value="<?php echo $post->id;?>" />
                            <textarea name="comment" class="form-control input-comment" rows="2" placeholder="Type a comment and press enter to post" style="margin-top: 8px;height: 46px;font-size: 12px;position: relative;top: 25px;width: 90%;margin-left: 17px;"></textarea>                      
                        <button type="submit" value="submit" class="btn btn-pad-3">Submit</button>
                        </form>
                         
                        </div>
                        <div class="row">
                        &nbsp;
                        </div>
                        <div class="row">
                        &nbsp;
                        </div>
              
<?php } //end if for inblocked users 
} ?>

