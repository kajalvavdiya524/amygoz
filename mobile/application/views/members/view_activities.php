<style>
    .park-spell{width: 44px; height: 44px;}
    a{color: #f0246c;}
    #imagePreview {
    width: 45px;
    height: 45px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    position: relative;
    overflow: hidden; 
    background-color: white;
    top:0px;}
    .sentiontwo{padding-top:15px; padding-bottom: 15px;border-bottom: 1px solid rgba(0, 0, 0, 0.07);}
</style>
<?php $session_user = Auth::instance()->get_user(); ?>

<div class="row">
    <div class="container">

        <fieldset class="fieldset">
            <a href="<?php echo url::base()."activity_notification";?>" style="position: relative;top: -4px;">
            <img class="web-sizing" alt="Callitme logo" src="<?php echo url::base() . 'img/callitme-arrow.png'; ?>" style="float: left;position: relative;top: 11px;"/>
                </a>
                <h4 style="position: relative;left: 15px;">Notifications</h4>

            <div class="friends">

                <?php foreach ($activities as $activity) { 
                    $activity_datas = DB::select('activities.*',array(DB::expr('COUNT(activities.target_id)'), 'total_profile_view'))
                        ->from('activities')
                        ->where('target_user', '=', $session_user->id)
                        ->where('target_id', '=', $activity->target_id)
                        ->where('type', '=', 'profile_view')
                        ->group_by(DB::expr("DATE(time)"))
                        ->having('target_id', '>', 1)
                        ->order_by('time', 'desc')
                        ->execute()
                        ->as_array();?>
                    <?php if($activity->type == 'profile_view') { 
                        if(!empty($activity_datas)) {
                            foreach($activity_datas as $row) {
                                if(date('Y-m-d') != date('Y-m-d', strtotime($row['time']))) { 
                                    if($activity->id == $row['id']) {?>
                                        <div class="post sentiontwo row activity <?php if ($activity->time > $session_user->read_notification_at) { ?> unread <?php } ?>">
                                            <?php
                                            $href = url::base() . "members/view_post/" . $activity->target_id;
                                            $class = "";
                                            if ($activity->type == 'arequest') {
                                                $href = url::base() . "activity/view/" . $activity->target_id;
                                                $class = '';
                                            } 
                                            else if ($activity->type == 'new_recommend' ) {
                                                $href = url::base() . "peoplereview/recommend_recieve";
                                                $class = '';
                                            } 
                                            else if ($activity->type == 'ask_recommend' || $activity->type == 'askreview') {
                                                $href = url::base() . "peoplereview/recommend_request/";
                                                $class = '';
                                            } 
                                            else if ($activity->type == 'anon_recommend') {
                                                $href = url::base() . "peoplereview/recommend_recieve";
                                                $class = '';
                                            } 
                                            else if ($activity->type == 'profile_view' || $activity->type == 'arequest_match') {
                                                $href = url::base() . ORM::factory('user', $activity->target_id)->username;
                                                $class = '';
                                            }
                                            else if ($activity->type == 'profile_pic') {
                                                $href = url::base() . "members/view_post/" . $activity->target_id;
                                                $class = "";
                                            }
                                            else if ($activity->type == 'ask_user_photo') {
                                                $postid=ORM::factory('post')->where('type','=',$activity->type)->order_by('id','desc')->limit(1)->find();
                                                $href = url::base().$session_user->username.'/edit_profile';
                                                $class = '';
                                            } ?>
                                            <div class="col-xs-2">
                                                <div class="user-img pull-left  hb-pt-5">
                                                    <?php if ($activity->type != 'arequest') {
                                                        if ($activity->type == 'anon_recommend') { ?>
                                                            <a href="<?php echo url::base() . "peoplereview/recommend_recieve"; ?>">
                                                                <div class="park-spell">
                                                                    <img src="<?php echo url::base() . "img/no_image_s.png"; ?>" width="30" height="30">
                                                                </div>
                                                            </a>
                                                        <?php } else { ?>
                                                            <div class="fileinput-preview" id="imagePreview" style="">
                                                                <center>
                                                                    <a href="<?php echo url::base() . $activity->user->username; ?>">
                                                                        <?php if ($activity->user->photo->profile_pic_m) { ?>
                                                                            <img src="<?php echo url::base() . "upload/" . $activity->user->photo->profile_pic_m; ?>" class="img-reponsive">
                                                                        <?php } else { ?>
                                                                            <div id="inset" class="xxs noMar">
                                                                                <h1>
                                                                                    <?php
                                                                                    $user = Auth::instance()->get_user();
                                                                                    echo $user->user_detail->first_name[0] . $user->user_detail->last_name[0];
                                                                                    ?>
                                                                                </h1>
                                                                                <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                                                            </div>
                                                                        <?php } ?>
                                                                    </a>
                                                                </center>
                                                            </div>
                                                        <?php }
                                                    } else { ?>
                                                        <div id="inset" class="xxs noMar">
                                                            <h1>
                                                                <?php
                                                                $user = Auth::instance()->get_user();
                                                                echo $user->user_detail->first_name[0] . $user->user_detail->last_name[0];
                                                                ?>
                                                            </h1>
                                                            <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-10">
                                                <a href="<?php echo $href; ?>" class="<?php echo $class; ?>">
                                                    <div class="post-content">
                                                        <div class="post-title" style="font-size: 16px;font-weight: 400;">
                                                            <?php
                                                            $user = Auth::instance()->get_user();
                                                            if($row['total_profile_view'] > 1) {
                                                                $cur_date = date('Y-m-d');
                                                                $time =  date('Y-m-d', strtotime($row['time']));
                                                                $activity_title = $row['total_profile_view'].' times.';
                                                                if($cur_date == $time) {
                                                                    $activity_title = $row['total_profile_view'].' times today.';
                                                                }
                                                                echo str_replace($user->user_detail->first_name . " " . $user->user_detail->last_name, 'you', $activity->activity.' '.$activity_title);
                                                            }
                                                            else {
                                                                echo str_replace($user->user_detail->first_name . " " . $user->user_detail->last_name, 'you', $activity->activity);
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div style="clear:both"></div>
                                                    <small class="post-time" style="color: grey;">
                                                        <i class="fa fa-clock-o"></i> 
                                                        <input type="hidden" value="<?php echo strtotime($activity->time); ?>" class="activity_time" />
                                                        <input type="hidden" value="<?php echo $activity->id; ?>" class="activity_id" />
                                                        <?php
                                                        $age = time() - strtotime($activity->time);
                                                        if ($age >= 86400) {
                                                            echo date('jS M', strtotime($activity->time));
                                                        } else {
                                                            echo date::time2string($age);
                                                        }
                                                        ?>
                                                    </small>
                                                </a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                        <?php } } } } ?>
                    <?php } else {?>
                        <div class="post sentiontwo row activity <?php if ($activity->time > $session_user->read_notification_at) { ?> unread <?php } ?>">
                            <?php
                            $href = url::base() . "members/view_post/" . $activity->target_id;
                            $class = "";
                            if ($activity->type == 'arequest') {
                                $href = url::base() . "activity/view/" . $activity->target_id;
                                $class = '';
                            } 
                            else if ($activity->type == 'new_recommend' ) {
                                $href = url::base() . "peoplereview/recommend_recieve";
                                $class = '';
                            } 
                            else if ($activity->type == 'ask_recommend' || $activity->type == 'askreview') {
                                $href = url::base() . "peoplereview/recommend_request/";
                                $class = '';
                            } 
                            else if ($activity->type == 'anon_recommend') {
                                $href = url::base() . "peoplereview/recommend_recieve";
                                $class = '';
                            } 
                            else if ($activity->type == 'profile_view' || $activity->type == 'arequest_match') {
                                $href = url::base() . ORM::factory('user', $activity->target_id)->username;
                                $class = '';
                            }
                            else if ($activity->type == 'profile_pic') {
                                $href = url::base() . "members/view_post/" . $activity->target_id;
                                $class = "";
                            }
                            else if ($activity->type == 'ask_user_photo') {
                                $postid=ORM::factory('post')->where('type','=',$activity->type)->order_by('id','desc')->limit(1)->find();
                                $href = url::base().$session_user->username.'/edit_profile';
                                $class = '';
                            } ?>
                            <div class="col-xs-2">
                                <div class="user-img pull-left  hb-pt-5">
                                    <?php if ($activity->type != 'arequest') {
                                        if ($activity->type == 'anon_recommend') { ?>
                                            <a href="<?php echo url::base() . "peoplereview/recommend_recieve"; ?>">
                                                <div class="park-spell">
                                                    <img src="<?php echo url::base() . "img/no_image_s.png"; ?>" width="30" height="30">
                                                </div>
                                            </a>
                                        <?php } else { ?>
                                            <div class="fileinput-preview" id="imagePreview" style="">
                                                <center>
                                                    <a href="<?php echo url::base() . $activity->user->username; ?>">
                                                        <?php if ($activity->user->photo->profile_pic_m) { ?>
                                                            <img src="<?php echo url::base() . "upload/" . $activity->user->photo->profile_pic_m; ?>" class="img-reponsive">
                                                        <?php } else { ?>
                                                            <div id="inset" class="xxs noMar">
                                                                <h1>
                                                                    <?php
                                                                    $user = Auth::instance()->get_user();
                                                                    echo $user->user_detail->first_name[0] . $user->user_detail->last_name[0];
                                                                    ?>
                                                                </h1>
                                                                <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                                            </div>
                                                        <?php } ?>
                                                    </a>
                                                </center>
                                            </div>
                                        <?php }
                                    } else { ?>
                                        <div id="inset" class="xxs noMar">
                                            <h1>
                                                <?php
                                                $user = Auth::instance()->get_user();
                                                echo $user->user_detail->first_name[0] . $user->user_detail->last_name[0];
                                                ?>
                                            </h1>
                                            <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-xs-10">
                                <a href="<?php echo $href; ?>" class="<?php echo $class; ?>">
                                    <div class="post-content">
                                        <div class="post-title" style="font-size: 16px;font-weight: 400;">
                                            <?php
                                            $user = Auth::instance()->get_user();
                                            echo str_replace($user->user_detail->first_name . " " . $user->user_detail->last_name, 'you', $activity->activity);
                                            ?>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <small class="post-time" style="color: grey;">
                                        <i class="fa fa-clock-o"></i> 
                                        <input type="hidden" value="<?php echo strtotime($activity->time); ?>" class="activity_time" />
                                        <input type="hidden" value="<?php echo $activity->id; ?>" class="activity_id" />
                                        <?php
                                        $age = time() - strtotime($activity->time);
                                        if ($age >= 86400) {
                                            echo date('jS M', strtotime($activity->time));
                                        } else {
                                            echo date::time2string($age);
                                        }
                                        ?>
                                    </small>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class=""><h4> No More Notification </h4></div>
        </fieldset>
    </div>
</div>