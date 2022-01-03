<?php $session_user = Auth::instance()->get_user(); ?>

<?php
    $userss = ORM::factory('user')->with('user_detail')
        ->where('sex', '=', (($session_user->user_detail->sex == 'Male') ? 'Female' : 'Male'))
        ->where('is_deleted', '=', 0)
        ->where('is_blocked','=',0)
        ->where('profile_private','=',0)
        ->and_where('profile_public', '=', '0')
        ->limit(10)
        ->find_all()
        ->as_array();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading c-list">
                View More Profiles  
            </div>

            <ul class="list-group" id="contact-list">
                <?php
                foreach ($userss as $friend) {
                    ?>

                    <?php
                    $recommendations = $friend->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

                    $temp_words = array();
                    foreach ($recommendations as $recommend) {
                        $words = explode(', ', $recommend->words);
                        $temp_words = array_merge($temp_words, $words);
                    }
                    $tags = array_count_values($temp_words);
                    ?>
                    <li class="list-group-item">
                        <div class="col-xs-3">
                            <div class="row">
                                <?php 
                                $photo = $friend->photo->profile_pic_s;
                                $frd_image = file_exists("mobile/upload/" .$photo);
                                $frd_image1 = file_exists("upload/" .$photo);
                                if (!empty($photo) && $frd_image) { ?>
                                    <img src="<?php echo url::base() . "mobile/upload/" . $friend->photo->profile_pic_s; ?>" alt="<?php echo $friend->user_detail->first_name . " " . $friend->user_detail->last_name; ?>" width="100%" class="img-thumbnail">
                                <?php }
                                else if (!empty($photo) && $frd_image1) { ?>
                                    <img src="<?php echo url::base() . "upload/" . $friend->photo->profile_pic_s; ?>" alt="<?php echo $friend->user_detail->first_name . " " . $friend->user_detail->last_name; ?>" width="100%" class="img-thumbnail">
                                <?php } else { ?>
                                    <div id="inset" class="xs noMar">
                                        <h1>
                                            <?php echo $friend->user_detail->first_name[0] . $friend->user_detail->last_name[0]; ?>
                                        </h1>
                                        <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <span class="name"><a href="<?php echo url::base() . $friend->username; ?>"><?php echo $friend->user_detail->first_name . " " . $friend->user_detail->last_name; ?></a></span><br/>
                            <span>
                                <?php echo implode(', ', $friend->user_detail->list_attributes()); ?>
                            </span>
                        </div>
                        <div class="col-xs-2">
                            <div class="row">
                                <?php echo View::factory('members/friend_button', array('user' => $friend, 'block' => false)); ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </li>

                <?php } ?>
            </ul>
        </div>
    </div>
</div>