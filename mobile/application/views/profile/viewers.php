<?php $session_user = Auth::instance()->get_user();?>

<fieldset class="fieldset">
    <legend>Who's viewed your profile</legend>

    <div class="friends">

        <?php foreach($viewers as $viewer) { ?>
            <div class="post friend">
                <div class="col-sm-6">
                    <div class="user-img pull-left">
                        <a href="<?php echo url::base().$viewer->viewer->username; ?>">
                            <?php if($viewer->viewer->photo->profile_pic_s) { ?>
                                <img src="<?php echo url::base().'upload/'.$viewer->viewer->photo->profile_pic_s;?>">
                            <?php } else { ?>
                                <div id="inset" class="xs">
                                    <h1>
                                        <?php echo $viewer->viewer->user_detail->first_name[0].$viewer->viewer->user_detail->last_name[0]; ?>
                                    </h1>
                                    <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                </div>
                            <?php } ?>    
                        </a>
                    </div>

                    <div class="post-content">
                        <div class="post-title">
                            <strong>
                                <a href="<?php echo url::base().$viewer->viewer->username; ?>">
                                    <?php echo $viewer->viewer->user_detail->first_name." ".$viewer->viewer->user_detail->last_name; ?>
                                </a>
                            </strong>
                        </div>

                        <div class="post-matter collapse-description collapseable in">
                            <p>
                                <?php
                                    $details = array();
                                    if(!empty($viewer->viewer->user_detail->location)) {
                                        $details[] = $viewer->viewer->user_detail->location;
                                    }

                                    if(!empty($viewer->viewer->user_detail->sex)) {
                                        $details[] = $viewer->viewer->user_detail->sex;
                                    }

                                    if(!empty($viewer->viewer->user_detail->phase_of_life)) {
                                        $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                        $details[] = $phase_of_life[$viewer->viewer->user_detail->phase_of_life];
                                    }

                                    echo implode(', ', $details);
                                ?>

                                <br />
                                <a href="<?php echo url::base().'chat/compose?user='.$viewer->viewer->username; ?>">Message</a> | 
                                <a href="<?php echo url::base().'members/index?user='.$viewer->viewer->username; ?>">Send Request</a> |
                                <a href="<?php echo url::base().'peoplereview/compose?ask='.$viewer->viewer->username; ?>">Review</a>
                                <br />
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <!--<div class="oaerror success text-center"> 
                        <large>0 %</large>Social Percentile
                    </div>-->
                </div>
                <div class="col-sm-3">
                    <div class="friend-actions request_action pull-right">
                        <?php echo View::factory('members/friend_button', array('user' => $viewer->viewer, 'block' => true)); ?>
                    </div>
                </div>      
                
               <div style="clear:both;"></div>

            </div>
        <?php } ?>

    </div>

</fieldset>
