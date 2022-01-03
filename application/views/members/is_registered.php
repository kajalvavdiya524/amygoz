<?php foreach($users as $user) { ?>
    <div class="result">
        <a class="pull-left" href="<?php echo url::base().$user->username; ?>">
            <?php 
            $photo = $user->photo->profile_pic_s;
            $oth_image = file_exists("mobile/upload/" .$photo);
            $oth_image1 = file_exists("upload/" .$photo);
            if(!empty($photo) && $oth_image) { ?>
                <img src="<?php echo url::base()."mobile/upload/".$user->photo->profile_pic_s?>" class="img-rounded pull-left">
            <?php }
            else if(!empty($photo) && $oth_image1) { ?>
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