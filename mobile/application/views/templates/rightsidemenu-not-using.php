<!--<?php $session_user = Auth::instance()->get_user(); ?>

<div class="panel panel-default">
    <div class="panel-heading c-list">
        <span class="title"><?php echo $session_user->user_detail->first_name;?>'s Friends</span>                
    </div>

    <ul class="list-group" id="contact-list">
        <?php
            if($friends){

            $i=0; 
            foreach($friends as $friend)
         {
            if($friend->is_blocked == 0) 
            {
                if($i==5) break;
        ?>
        <li class="list-group-item">
            <div class="col-xs-3">
                <div class="row picbox1">
                    <?php if($friend->photo->profile_pic_s) { ?>
                    <img src="<?php echo url::base()."upload/".$friend->photo->profile_pic_s;?>" alt="<?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>" style="width:100%;height:100%;" class="img-thumbnail">
                    <?php } else { ?>
                        <div id="inset" class="xs noMar">
                            <h1>
                                <?php echo $friend->user_detail->get_no_image_name();?>
                            </h1>
                            <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-xs-9">
                <span class="name" style="font-size:16px;"><a href="<?php echo url::base().$friend->username; ?>"><strong><?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?></strong></a></span><br/>
                <span style="font-size:14px;">
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
                </span>
            </div>
            <div class="col-xs-2">
                <div class="row">
                    <?php echo View::factory('members/friend_button', array('user' => $friend, 'block' => false)); ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </li>
        <?php $i++; }
    }} else { ?>
        <li class="text-center no-friend">
            <i class="fa fa-frown-o"></i>
            <span>No Friend Yet</span>
        </li>
        <?php } ?>
    </ul>
</div>-->