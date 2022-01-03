<style>
    .arequest_members {
        text-align:center;
        margin-left:0px;
        padding-left:0px;
        margin-bottom:20px;
    }
    .arequest_member {
        display: inline-block;
        margin-left: 25px;
    }
</style>
<div class="arequest">

    <div class="compose-box arequest">
        <h3 class="textCenter marBottom20">One of these Callitme members has a <?php echo $arequest->plan;?> request
            for you. Please choose the person you like.</h3>
            
        <ul class="arequest_members">
            <?php $index = 1; foreach($arequest->members->find_all()->as_array() as $member) { ?>
                <li class="arequest_member">

                    <a href="<?php echo url::base().$member->user->username; ?>">
                        <?php 
                        $photo = $member->user->photo->profile_pic_s;
                        $mem_image = file_exists("mobile/upload/" .$photo);
                        $mem_image1 = file_exists("upload/" .$photo);
                        if($photo && $mem_image) { ?>
                            <img src="<?php echo url::base()."mobile/upload/".$member->user->photo->profile_pic_s;?>" class="img-rounded">
                        <?php }
                        else if($photo && $mem_image1) { ?>
                            <img src="<?php echo url::base()."upload/".$member->user->photo->profile_pic_s;?>" class="img-rounded">
                        <?php } else { ?>
                            <img src="<?php echo url::base()."img/no_image_s.png";?>" class="img-rounded">
                        <?php } ?>
                    </a>

                    <span class="dis-block"><?php echo $member->user->user_detail->first_name ." ".$member->user->user_detail->last_name?></span>
                    <form method="post">
                        <input type="hidden" name="arequest_action" value="<?php echo $member->user->id; ?>" />
                        <a class="mem_selected">Accept</a>
                    </form>
                </li>
                <?php if($index == 4) { ?> </ul><ul class="arequest_members"> <?php } ?>
                
            <?php $index++; } ?>
        </ul>
        
        <form method="post" class="textCenter marTop20">
            <input type="hidden" name="arequest_action" value="delete" />
            <button class="btn btn-secondary"><span class="glyphicon glyphicon-trash"></span> Delete this Request</button>
        </form>
    </div>
    
</div>