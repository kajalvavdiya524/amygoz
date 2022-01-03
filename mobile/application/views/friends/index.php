<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?php $session_user = Auth::instance()->get_user(); ?>
    <div class="row">
        <div class="friends-block hb-p-0">
            <div class="friends" style="background: #fff;">
                <?php foreach ($session_user->friends->find_all()->as_array() as $friend) { ?>
                    <div class="post friend">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                            <center>
                                <div id="imagePreview">
                                    <a href="<?php echo url::base() . $friend->username; ?>">
                                        <?php if ($friend->photo->profile_pic_s) { ?>
                                            <img src="<?php echo url::base() . "upload/" . $friend->photo->profile_pic; ?>" alt="<?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name?>" height="100%">
                                        <?php } else { ?>
                                            <div id="inset" class="xs hb-mt-0" style="min-width: 80px;height: 80px;max-height: 80px !important;">
                                                <h1 style="line-height: 74px;font-size: 26px;">
                                                    <?php echo $friend->user_detail->get_no_image_name(); ?>
                                                </h1>
                                                <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                            </div>
                                        <?php } ?>
                                    </a>
                            </div>
                   </center>
                            </div>
                            </div>
                            <div class="row text-center">
                            <div class="col-xs-12">
                                <div class="post-title">
                                    <strong>
                                        <a href="<?php echo url::base() . $friend->username; ?>" class="clr-pad-1">
                                            <?php echo $friend->user_detail->first_name . " " . $friend->user_detail->last_name; ?>
                                        </a>
                                    </strong>
                                </div>

                                <div class="post-matter collapse-description collapseable in">
                                    <p class="clr-pad-2">
                                        <!--show total number of friends begin-->
                                         <span class="badge" style="color:rgba(51, 49, 51, 0.84);background-color: rgba(167, 179, 168, 0.3);">
                                        <?php $n = ORM::factory('friendship')->where('user_id', '=', $friend->id)->count_all(); ?>
                                        <?php
                                        if ($n == 0) {
                                            echo 'No Friends';
                                        } else if ($n == 1) {
                                            echo '1 Friend';
                                        } else {
                                            echo $n . ' Friends';
                                        }
                                        ?>
                                    </span>
                                    <?php 
                                       //echo $friend->user_detail->sex;
                                        $loc = $friend->user_detail->location; 
                                        $b = explode(',', $loc);
                                        if(!empty($b[0]) && !empty($b[2]))
                                        {
                                            echo $b[0].", ".$b[2];
                                        }
                                        /*else if(!empty($b[0]))*/
                                        else if(!empty($b[0]) && empty($b[2]))
                                        {
                                             echo $b[0];
                                        }
                                        else
                                        {
                                             echo " ";
                                        }
                                    ?>
                                       

                                     <div class="row brd-pad-1">
                                     <div class="col-xs-6 brd-pad-2">
                                        <a class="clr-pad-3" href="<?php echo url::base() . 'chat/compose?user=' . $friend->username; ?>"><span class="glyphicon glyphicon-envelope" style="position: relative;top: 2px;">&nbsp;</span>Message</a>
                                        </div>
                                        <!--<div class="col-xs-6 brd-pad-2"> 
                                        <a class="clr-pad-3" href="<?php echo url::base() . 'members/index?user=' . $friend->username; ?>">Send Request</a>
                                        </div>-->
                                        <div class="col-xs-6" style="padding: 6px 0px 6px 0px;"> 
                                        <a class="clr-pad-3" href="<?php echo url::base() . 'peoplereview/compose?ask=' . $friend->username; ?>">
                                      <i class="demo-icon icon-edit web-slizing" style="font-size: 17px;"></i>&nbsp;Review</a>
                                        </div>
                                       </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div style="clear:right;"></div>
                    </div>
                <?php } ?>

            </div>

        </div>
    </div>
    <div class="row" style="background: #fff;">
    <div class="col-xs-12">
        <?php echo View::factory('friends/menu', array('submenu' => 'friends')); ?>
    </div>
</div>
<!-start sidebar-->
<?php $session_user = Auth::instance()->get_user(); ?>

<?php
    $userss = ORM::factory('user')->with('user_detail')
        ->where('sex', '=', (($session_user->user_detail->sex == 'Male') ? 'Female' : 'Male'))
        ->where('is_deleted', '=', 0)
        ->where('profile_private','=',0)
        ->and_where('profile_public', '=', '0')
        ->order_by(DB::expr('RAND()'))
        ->limit(10)
        ->find_all()
        ->as_array();
?>

<div class="row"  style="background: #12a6bb;">
    <div class="col-xs-12">
            <h4>
                Profiles to Check Out    
            </h4>
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
                    <li class="list-group-item brd-pad-3">
                        <div class="col-xs-2">
                         <center>
                            <div id="imagebatter">
                                <?php if ($friend->photo->profile_pic_s) { ?>
                                    <img src="<?php echo url::base() . "upload/" . $friend->photo->profile_pic; ?>" alt="<?php echo $friend->user_detail->first_name . " " . $friend->user_detail->last_name; ?>" height="100%">
                                <?php } else { ?>
                                    <div id="inset" class="xs noMar" style="margin-top: 0px;">
                                        <h1>
                                            <?php echo $friend->user_detail->first_name[0] . $friend->user_detail->last_name[0]; ?>
                                        </h1>
                                        <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                    </div>
                                <?php } ?>
                            </div>
                        </center>
                        </div>
                        <div class="col-xs-8">
                            <span class="name"><a href="<?php echo url::base() . $friend->username; ?>" style="color: #fff;font-size: 16px;font-weight: 500;"><?php echo $friend->user_detail->first_name . " " . $friend->user_detail->last_name; ?></a></span><br/>
                            <span style="color: #fff;">
                                <?php
                                $details = array();
                                if (!empty($friend->user_detail->sex)) {
                                    $details[] = $friend->user_detail->sex;
                                }

                                if (!empty($friend->user_detail->phase_of_life)) {
                                    $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                    $details[] = $phase_of_life[$friend->user_detail->phase_of_life];
                                }

                                echo implode(', ', $details);
                                ?>
                            </span>
                            <br>
                            <span style="color:#fff;">
                                <strong> Social % <?php echo $friend->calculate_social_percentage($tags); ?></strong></span>
                        </div>
                        <div class="col-xs-2">
                            <div class="row">
                                <?php echo View::factory('members/friend_button', array('user' => $friend, 'block' => false)); ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr/>
                    </li>

                <?php } ?>
            </ul>
    </div>
</div>
<!-end sidebar-->
<style>
#imagePreview {
    width: 80px;
    height: 80px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-top: 3px;
    overflow: hidden;
    border: 2px solid #fff;
    left: 0px;
}
#imagebatter {
    width: 50px;
    height: 50px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-top: 3px;
    overflow: hidden; 
    background-color: white;
    position: relative;
    border: 2px solid #fff;
    right: 15px;
    top: -5px;
}
.brd-pad-1
{
    border-bottom:1px solid #e4e3e3;
    border-top:1px solid #e4e3e3;
}
.brd-pad-2
{
    border-right: 1px solid #e4e3e3;
    padding: 6px 0px 6px 0px;"
}
.brd-pad-3
{
    border: none;
    background: #12a6bb;
}

.clr-pad-1
{    
    color: #1c9aad;
    font-size: 17px;
    font-weight: 600;
}
.clr-pad-2
{ 
    color: #0a0a0a;
    font-size: 13px;
    font-weight: 400;
}
.clr-pad-3
{ 
    color: #0a0a0a;
    font-size: 17px;
    font-weight: 400;
}
</style>