<?php foreach($users as $user) { ?>
    <div class="result">
        <a class="pull-left" href="<?php echo url::base().$user->username; ?>">
            <?php if($user->photo->profile_pic_s) { ?>
                <img src="<?php echo url::base()."upload/".$user->photo->profile_pic_s?>" class="img-rounded pull-left">
            <?php } else { ?>
                <img src="<?php echo url::base()."img/no_image_s.png";?>" class="img-rounded pull-left">
            <?php } ?>

            <div class="result-content">
                <h5><?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?></h5>
                <p>
                    <?php echo $user->email; ?>
                </p>
            </div>
        
        </a>
        <div class="clear"></div>
    </div>

<?php } ?>