<style>
    .park-spell{width: 44px; height: 44px;}
    a{color: #f0246c;}
    .sention{padding-top:10px; padding-bottom: 17px;border-bottom: 1px solid rgba(0, 0, 0, 0.07);}
</style>
<?php $session_user = Auth::instance()->get_user(); ?>

<?php if (!empty($activities)) { ?>
    <?php foreach ($activities as $activity) { 
        $activity_datas = DB::select('activities.*',array(DB::expr('COUNT(activities.target_id)'), 'total_profile_view'),array(DB::expr('MAX(activities.id)'), 'activity_id'))
            ->from('activities')
            ->where('target_user', '=', $session_user->id)
            ->where('target_id', '=', $activity->target_id)
            ->where('type', '=', 'profile_view')
            ->group_by(DB::expr("DATE(time)"))
            ->having('target_id', '>', 1)
            ->order_by('id', 'desc')
            ->execute()
            ->as_array();?>
        <?php if($activity->type == 'profile_view') {
            if(!empty($activity_datas)) {
                foreach($activity_datas as $row) {
                    if(date('Y-m-d') != date('Y-m-d', strtotime($row['time']))) {
                        if($activity->id == $row['activity_id']) {?>
                            <div class="post row sention<?php if ($activity->time > $session_user->read_notification_at) { ?> unread <?php } ?>">
                                <?php $href = url::base() . "members/view_post/" . $activity->target_id;
                                $class = "";
                                if ($activity->type == 'arequest') {
                                    $href = url::base() . "activity/view/" . $activity->target_id;
                                    $class = '';
                                } 
                                else if ($activity->type == 'new_recommend') {
                                    $href = url::base() . "peoplereview/recommend_recieve";
                                    $class = '';
                                }
                                else if ($activity->type == 'edit_review') {
                                    $href = url::base() . "peoplereview/recommend_recieve";
                                    $class = '';
                                }
                                else if ($activity->type == 'anon_recommend') {
                                    $href = url::base() . "peoplereview/recommend_recieve";
                                    $class = '';
                                }
                                else if ($activity->type == 'anon_edit_recommend') {
                                    $href = url::base() . "peoplereview/recommend_recieve";
                                    $class = '';
                                }
                                else if ($activity->type == 'ask_recommend' || $activity->type == 'askreview') {
                                    $href = url::base() . "peoplereview/recommend_request/";
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
                                    <?php if ($activity->type != 'arequest') {
                                        if ($activity->type == 'anon_recommend') { ?>
                                            <a href="<?php echo url::base() . "peoplereview/recommend_recieve"; ?>" style="margin-left: 15px;">
                                            <div class="park-spell">
                                                <img class="img-responsive" src="<?php echo url::base() . "img/no_image.png"; ?>">
                                                </div>
                                            </a>
                                        <?php } else { ?>
                                            <center>
                                                <div id="imageactivty">
                                                    <a href="<?php echo url::base() . $activity->user->username; ?>">
                                                        <?php if ($activity->user->photo->profile_pic_m) { ?>
                                                            <img src="<?php echo url::base()."upload/".$activity->user->photo->profile_pic; ?>" height="100%">
                                                        <?php } else { ?>
                                                            <div id="inset" class="xxs noMar">
                                                                <h1 style="font-size: 22px;line-height: 42px;">
                                                                    <?php
                                                                    $user = Auth::instance()->get_user()->user_detail;
                                                                    echo  $activity->user->user_detail->first_name[0] . $activity->user->user_detail->last_name[0];
                                                                    ?>
                                                                </h1>
                                                            </div>
                                                        <?php } ?>
                                                    </a>
                                                </div>
                                            </center>
                                        <?php } ?>   
                                    <?php }  else { ?>
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
                                <div class="col-xs-10" style="position: relative;top: 7px;">
                                    <a href="<?php echo $href; ?>" class="<?php echo $class; ?>">
                                        <div class="post-content">
                                            <div class="post-title" style="font-size: 14px;font-weight: 400;">
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
                                    </a>
                                    <div class="" style="position: relative;left: 5px;color: #797979;font-size: 12px;font-weight: 500;">
                                        <small class="post-time">
                                            <i class="fa fa-clock-o"></i>
                                            <input type="hidden" value="<?php echo strtotime($activity->time); ?>" class="activity_time" />
                                            <input type="hidden" value="<?php echo $activity->id; ?>" class="activity_id" />
                                            <?php
                                            $age = time() - strtotime($activity->time);
                                            if ($age >= 86400) {
                                                echo date('j M', strtotime($activity->time));
                                            } else {
                                                echo date::time2string($age);
                                            }
                                            ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
            <?php } } } } ?>
        <?php } else {?>
            <div class="post row sention<?php if ($activity->time > $session_user->read_notification_at) { ?> unread <?php } ?>">
                <?php $href = url::base() . "members/view_post/" . $activity->target_id;
                $class = "";
                if ($activity->type == 'arequest') {
                    $href = url::base() . "activity/view/" . $activity->target_id;
                    $class = '';
                } 
                else if ($activity->type == 'new_recommend') {
                    $href = url::base() . "peoplereview/recommend_recieve";
                    $class = '';
                }
                else if ($activity->type == 'edit_review') {
                    $href = url::base() . "peoplereview/recommend_recieve";
                    $class = '';
                }
                else if ($activity->type == 'anon_recommend') {
                    $href = url::base() . "peoplereview/recommend_recieve";
                    $class = '';
                }
                else if ($activity->type == 'anon_edit_recommend') {
                    $href = url::base() . "peoplereview/recommend_recieve";
                    $class = '';
                }
                else if ($activity->type == 'ask_recommend' || $activity->type == 'askreview') {
                    $href = url::base() . "peoplereview/recommend_request/";
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
                    <?php if ($activity->type != 'arequest') {
                        if ($activity->type == 'anon_recommend') { ?>
                            <a href="<?php echo url::base() . "peoplereview/recommend_recieve"; ?>" style="margin-left: 15px;">
                            <div class="park-spell">
                                <img class="img-responsive" src="<?php echo url::base() . "img/no_image.png"; ?>">
                                </div>
                            </a>
                        <?php } else { ?>
                            <center>
                                <div id="imageactivty">
                                    <a href="<?php echo url::base() . $activity->user->username; ?>">
                                        <?php if ($activity->user->photo->profile_pic_m) { ?>
                                            <img src="<?php echo url::base()."upload/".$activity->user->photo->profile_pic; ?>" height="100%">
                                        <?php } else { ?>
                                            <div id="inset" class="xxs noMar">
                                                <h1 style="font-size: 22px;line-height: 42px;">
                                                    <?php
                                                    $user = Auth::instance()->get_user()->user_detail;
                                                    echo  $activity->user->user_detail->first_name[0] . $activity->user->user_detail->last_name[0];
                                                    ?>
                                                </h1>
                                            </div>
                                        <?php } ?>
                                    </a>
                                </div>
                            </center>
                        <?php } ?>   
                    <?php }  else { ?>
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
                <div class="col-xs-10" style="position: relative;top: 7px;">
                    <a href="<?php echo $href; ?>" class="<?php echo $class; ?>">
                        <div class="post-content">
                            <div class="post-title" style="font-size: 14px;font-weight: 400;">
                                <?php
                                $user = Auth::instance()->get_user();
                                echo str_replace($user->user_detail->first_name . " " . $user->user_detail->last_name, 'you', $activity->activity);
                                ?>
                            </div>
                        </div>
                        <div style="clear:both"></div>
                    </a>
                    <div class="" style="position: relative;left: 5px;color: #797979;font-size: 12px;font-weight: 500;">
                        <small class="post-time">
                            <i class="fa fa-clock-o"></i>
                            <input type="hidden" value="<?php echo strtotime($activity->time); ?>" class="activity_time" />
                            <input type="hidden" value="<?php echo $activity->id; ?>" class="activity_id" />
                            <?php
                            $age = time() - strtotime($activity->time);
                            if ($age >= 86400) {
                                echo date('j M', strtotime($activity->time));
                            } else {
                                echo date::time2string($age);
                            }
                            ?>
                        </small>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if (count($activities)) { ?>
        <div class="view_more" style="margin-bottom: 12px;">
            <a href="<?php echo url::base() . "members/view_activities"; ?>">View All</a>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="post activity" style="width:160px;">
        <p class="text-center" style="color:black;">No new notification.</p>
    </div>
<?php } ?>