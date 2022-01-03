<?php $session_user = Auth::instance()->get_user(); ?>

<div id="sidemenu-up-block">
    <div class="user-pro-pic3">
        <?php 
        $photo = $user->photo->profile_pic;
        $photo_image = file_exists("mobile/upload/" .$photo);
        $photo_image1 = file_exists("upload/" .$photo);
         if(!empty($photo) && $photo_image) { ?>
         <a id="single_2" width='100%' href="<?php echo url::base() . 'mobile/upload/' . $user->photo->profile_pic; ?>">
            <img width="100%"  src="<?php echo url::base().'mobile/upload/'.$user->photo->profile_pic;?>" alt="<?php echo $user->user_detail->first_name." ".$user->user_detail->last_name;?>">
         </a>
        <?php }
        else if(!empty($photo) && $photo_image1) { ?>
        <a id="single_2" width='100%' href="<?php echo url::base() . 'upload/' . $user->photo->profile_pic; ?>">
            <img width="100%"  src="<?php echo url::base().'upload/'.$user->photo->profile_pic;?>" alt="<?php echo $user->user_detail->first_name." ".$user->user_detail->last_name;?>">
        </a>
        <?php } else { ?>
            <div id="inset" class="profile-view">
           
                <h1>
                   <?php echo $user->user_detail->get_no_image_name();?>
                </h1>

<!-------------------------------------------------------------------------------------------------------------->
<?php if ($user->id != $session_user->id) {
                        ?>
                                     <?php 
                                           $ask_photo =DB::select()->from('askphoto')
                                           ->where('user_id', '=', $user->id)
                                           ->where('asker_id', '=', $session_user->id)
                                           ->execute();

                                     if(count($ask_photo)>0) 
                                        { ?>
                                           <span>
                                                 <i class="fa fa-question-circle"></i> Photo Requested
                                            </span>
                                            
                                    <?php } else { ?>

           <span><a href="<?php echo url::base().$user->username."/askphoto";?>"><i class="fa fa-question-circle"></i> ask photo</a></span>
         
            
        <?php }?>
       
       <?php } ?>
 </div>       
        <?php }?>
    </div>
    
    <div class="user-title">
        <span class="user-name">
            <?php echo $user->user_detail->first_name ." ".$user->user_detail->last_name;?>
        </span>
    </div>
    
    <?php if ($user->has('friends', $session_user) && $user->user_detail->phase_of_life == 1) { ?>
        <div class="user-title">
            <div class="ribbion-modal modal fade" id="matchModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">                
                    <div class="modal-content">                    
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <img src="<?php echo url::base(); ?>img/close.png" />
                            </button>
                            <div class="ribbion">
                                <h2>Match your friend</h2>
                            </div>
                            <div class="triangle-l"></div>
                            
                            <div class="clearfix"></div>
                        </div>

                        <form class="validate-form" method="post" action="<?php echo url::base() . "members/match" ?>" role="form">
                            <div class="modal-body">
                                <h4>Match <?php echo $user->user_detail->first_name; ?> with your friend.</h4>
                                
                                <div class="form-group" style="position:relative;">
                                    <label class="control-label" for="email">Enter Name or Email address:</label>
                                    <input class="form-control required email find_user" id="message-email" type="text" name="email" autocomplete='off'>
                                    
                                    <div id="message-suggestion" class="registered_users well-box">
                                    </div>
                                    
                                    <input type="hidden" name="match_user" value="<?php echo $user->id; ?>" />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-secondary">Match</button>
                            </div>
                        </form>

                    </div><!-- /.modal-content -->
                    
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    <?php } ?>

</div>

<?php if($session_user->id != $user->id) { ?>
    <div class="row-fluid marTop10 friendshipStat">
        <?php if($session_user->id != $user->id) { ?>
            <div class="friend-actions marTop10">
                <?php echo View::factory('members/friend_button', array('user' => $user)); ?>
            </div>
        <?php } ?>
    </div>

    <div class="row-fluid marTop10">
        <button href="<?php echo url::base()."chat/compose_popup?user=".$user->username; ?>" popup-modal="#composeMessage" class="btn btn-transparent btn-block btn-compose-popup"><span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp;<span class="btn-text">Message</span></button>
    </div>

    <div class="row-fluid marTop10">
        <a href="<?php echo url::base() . 'activity?user=' . $user->username; ?>" class="btn btn-transparent btn-block">
            <span class="glyphicon glyphicon-info-sign"></span> &nbsp;&nbsp;<span class="btn-text">Request</span>
        </a>
    </div>

    <div class="row-fluid marTop10">
        <a href="<?php echo url::base() . 'peoplereview/compose?ask=' . $user->username; ?>" class="btn btn-transparent btn-block">
            <span class="glyphicon glyphicon-star"></span> &nbsp;&nbsp;<span class="btn-text">Review</span>
        </a>
    </div>
<?php } else { ?>
    <div id="sidemenu-nav">
        <ul>
            <li class="feeds">
                <a href="<?php echo url::base();?>" class="btn btn-transparent btn-block"><i class="fa fa-feed"></i> Feeds</a>
            <li class="requests">
                <a href="<?php echo url::base()."activity"; ?>" class="btn btn-transparent btn-block"><i class="fa fa-user-plus"></i> Requests
                    <?php 
                        $arequest_count = $session_user->arequests->count_all(); 
                        if($arequest_count) {
                    ?>
                        <span class="badge pull-right"><?php echo $arequest_count; ?></span>
                    <?php } ?>
                </a>
            </li>
            <li class="friends">
                <a href="<?php echo url::base()."friends"; ?>" class="btn btn-transparent btn-block"><i class="fa fa-users"></i> Friends</a>
            </li>
            <li  class="messages">
                <a href="<?php echo url::base()."messages"; ?>" class="btn btn-transparent btn-block"><i class="fa fa-envelope"></i> Messages</a>
            </li>
            <li class="reviews">
                <a href="<?php echo url::base()."peoplereview"; ?>" class="btn btn-transparent btn-block"><i class="fa fa-commenting"></i> Reviews</a>
            </li>
            <li class="around">
                <a href="<?php echo url::base()."around"; ?>" class="btn btn-transparent btn-block"><i class="fa fa-street-view"></i> Around</a>
            </li>
            <li class="upgrade">
                <a href="<?php echo url::base()."upgrade"; ?>" class="btn btn-transparent btn-block"><i class="fa fa-money"></i> Upgrade</a>
            </li>
        </ul>
    </div>

<?php } ?>


<div class="row marTop10">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading c-list">
                <span class="title" style="font-weight:500;"><?php echo $user->user_detail->first_name;?>'s Friends</span>                
            </div>

            <ul class="list-group" id="contact-list">
                <?php
                    if($friends){
                
                    $i=0; 
                    foreach($friends as $friend) { 
                        if($i==5) break;
                ?>
                <li class="list-group-item">
                    <div class="col-xs-2">
                        <div class="row">
                        <center>
                 <div class="fileinput-preview" id="imagerather" style="overflow: hidden; background-color: white;">
                            <?php 
                            $phott = $friend->photo->profile_pic_s;
                            $pho_image = file_exists("mobile/upload/" .$photo);
                            $pho_image1 = file_exists("upload/" .$photo);
                            if(!empty($phott) && $pho_image) { ?>
                            <img src="<?php echo url::base()."mobile/upload/".$friend->photo->profile_pic_s;?>" alt="<?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>" height="100%">
                            <?php }
                            else if(!empty($phott) && $pho_image1) { ?>
                            <img src="<?php echo url::base()."upload/".$friend->photo->profile_pic_s;?>" alt="<?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>" height="100%">
                            <?php } else { ?>
                                <div id="inset" class="xs noMar">
                                    <h1>
                                        <?php echo $friend->user_detail->get_no_image_name(); ?>
                                    </h1>
                                    <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                </div>
                            <?php } ?>
                            </div>
                            </center>
                        </div>
                    </div>
                    <div class="col-xs-9">
                        <span class="name">
                        <a href="<?php echo url::base().$friend->username; ?>" style="font-size: 14px;font-weight: 600;"><?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?></a></span><br/>
                        <span style="font-size: 13px;font-weight: 400;">
                            <?php echo implode(', ', $friend->user_detail->list_attributes()); ?>
                            <?php
                                $details = array();
                                if(!empty($friend->user_detail->sex)) {
                                    $details[] = $friend->user_detail->sex;
                                }

                                if(!empty($friend->user_detail->phase_of_life)) {
                                    $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                    $details[] = $phase_of_life[$friend->user_detail->phase_of_life];
                                }

                                echo implode(', ', $details);
                            ?>
                            <p>
                                <?php 
                                    $recommendations = $friend->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                                         $temp_words = array();
                                        foreach($recommendations as $recommend) {
                                        $words = explode(', ', $recommend->words);
                                        $temp_words = array_merge($temp_words, $words);
                                    }
                                        $tags = array_count_values($temp_words);

                         ?>Social <?php echo $friend->calculate_social_percentage($tags); ?>% </p>
                                    </span>
                        </span>
                    </div>
                    <div class="">
                        <div class="pull-right" style="margin-top: -69px;">
                            <?php echo View::factory('members/friend_button', array('user' => $friend, 'block' => false)); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <?php $i++; }} else { ?>
                <li class="text-center no-friend">
                    <i class="fa fa-frown-o"></i>
                    <span>No Friend Yet</span>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<!-- Pop up converation modal-->

<div class="modal fade" id="composeMessage" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="lineModalLabel">Isn't it exciting to start a new conversation?</h4>
            </div>

            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div>



<style>
#imagerather {
    width: 47px;
    height: 47px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-top: 6px;
    position: relative;
    right:7px;
}
#myTextArea {
  width: 100%;
  min-height: 35px;
  overflow-y: hidden;
}
</style>