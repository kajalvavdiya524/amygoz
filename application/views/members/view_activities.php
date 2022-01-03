<?php $session_user = Auth::instance()->get_user(); ?>
<div class="feeds_sec">
    <div class="friends-block">
        <fieldset class="fieldset">
            <legend>Notifications</legend>
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
                        ->as_array(); ?>
                    <?php if($activity->type == 'profile_view') {
                        if(!empty($activity_datas)) {
                            foreach($activity_datas as $row) {
                                if(date('Y-m-d') != date('Y-m-d', strtotime($row['time']))) {
                                    if($activity->id == $row['id']) {?>
                                    <div class="post activity <?php if ($activity->time > $session_user->read_notification_at) { ?> unread <?php } ?>">
                                        <?php
                                        $href = url::base() . "members/view_post/" . $activity->target_id;
                                        // $class = "noti_pop";
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
                                            //$class = "noti_pop";
                                        }
                                        else if ($activity->type == 'ask_user_photo') {
                                            $postid=ORM::factory('post')->where('type','=',$activity->type)->order_by('id','desc')->limit(1)->find();
                                            $href = url::base().$session_user->username.'/edit_profile';
                                            $class = '';
                                        } ?>
                                        <div class="user-img pull-left  hb-pt-5">
                                            <?php if ($activity->type != 'arequest') {
                                                if ($activity->type == 'anon_recommend') { ?>
                                                    <a href="<?php echo url::base() . "peoplereview/recommend_recieve"; ?>">
                                                        <img src="<?php echo url::base() . "img/no_image_s.png"; ?>" width="30" height="30">
                                                    </a>
                                                <?php }
                                                else { ?>
                                                    <a href="<?php echo url::base() . $activity->user->username; ?>">
                                                        <?php 
                                                        $photo = $activity->user->photo->profile_pic_m;
                                                        $act_image = file_exists("mobile/upload/" .$photo);
                                                        $act_image1 = file_exists("upload/" .$photo);
                                                        if (!empty($photo) && $act_image) { ?>
                                                            <img src="<?php echo url::base() . "mobile/upload/" . $activity->user->photo->profile_pic_m; ?>" width="30" height="30">
                                                        <?php }
                                                        else if (!empty($photo) && $act_image1) { ?>
                                                            <img src="<?php echo url::base() . "upload/" . $activity->user->photo->profile_pic_m; ?>" width="30" height="30">
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
                                                <?php }
                                            } else { ?>
                                                <div id="inset" class="xxs noMar">
                                                    <h1>
                                                        <?php
                                                        $user = Auth::instance()->get_user();
                                                        echo $user->user_detail->first_name[0] . $user->user_detail->last_name[0];
                                                        ?>
                                                    </h1>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="pull-left hb-ml-10">
                                            <a href="<?php echo $href; ?>" class="">
                                                <div class="post-content">
                                                    <div class="post-title">
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
                                                        } else {
                                                            echo str_replace($user->user_detail->first_name . " " . $user->user_detail->last_name, 'you', $activity->activity);
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div style="clear:both"></div>
                                                <small class="post-time">
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
                        <div class="post activity <?php if ($activity->time > $session_user->read_notification_at) { ?> unread <?php } ?>">
                            <?php
                            $href = url::base() . "members/view_post/" . $activity->target_id;
                            // $class = "noti_pop";
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
                                //$class = "noti_pop";
                            }
                            else if ($activity->type == 'ask_user_photo') {
                                $postid=ORM::factory('post')->where('type','=',$activity->type)->order_by('id','desc')->limit(1)->find();
                                $href = url::base().$session_user->username.'/edit_profile';
                                $class = '';
                            } ?>
                            <div class="user-img pull-left  hb-pt-5">
                                <?php if ($activity->type != 'arequest') {
                                    if ($activity->type == 'anon_recommend') { ?>
                                        <a href="<?php echo url::base() . "peoplereview/recommend_recieve"; ?>">
                                            <img src="<?php echo url::base() . "img/no_image_s.png"; ?>" width="30" height="30">
                                        </a>
                                    <?php }
                                    else { ?>
                                        <a href="<?php echo url::base() . $activity->user->username; ?>">
                                            <?php 
                                            $photo = $activity->user->photo->profile_pic_m;
                                            $act_image = file_exists("mobile/upload/" .$photo);
                                            $act_image1 = file_exists("upload/" .$photo);
                                            if (!empty($photo) && $act_image) { ?>
                                                <img src="<?php echo url::base() . "mobile/upload/" . $activity->user->photo->profile_pic_m; ?>" width="30" height="30">
                                            <?php }
                                            else if (!empty($photo) && $act_image1) { ?>
                                                <img src="<?php echo url::base() . "upload/" . $activity->user->photo->profile_pic_m; ?>" width="30" height="30">
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
                                    <?php }
                                } else { ?>
                                    <div id="inset" class="xxs noMar">
                                        <h1>
                                            <?php
                                            $user = Auth::instance()->get_user();
                                            echo $user->user_detail->first_name[0] . $user->user_detail->last_name[0];
                                            ?>
                                        </h1>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="pull-left hb-ml-10">
                                <a href="<?php echo $href; ?>" class="">
                                    <div class="post-content">
                                        <div class="post-title">
                                            <?php
                                            $user = Auth::instance()->get_user();
                                            echo str_replace($user->user_detail->first_name . " " . $user->user_detail->last_name, 'you', $activity->activity);
                                            ?>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <small class="post-time">
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
                    <?php }?>
                <?php } ?>
            </div>
            <div class=""><h4> No More Notification </h4></div>
        </fieldset>
    </div>
</div>