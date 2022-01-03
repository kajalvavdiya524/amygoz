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
    .lin-bord-1{list-style:none;margin: 0px 0px 35px 0px;border-bottom: 1px solid whitesmoke;}
</style> 
<div class="arequest">

    <div class="compose-box arequest">
        <p class="marBottom20" style="color: #6c6c6c;margin: 26px 0px;font-size: 15px;font-weight: 500;">One of these Callitme members has a <?php echo $arequest->plan;?> request
            for you. Please choose the person you like.</p>
            
        <ul class="arequest_members">
            <?php $index = 1; foreach($arequest->members->find_all()->as_array() as $member) { ?>
                <li class="lin-bord-1">

                    <a href="<?php echo url::base().$member->user->username; ?>">
                        <?php if($member->user->photo->profile_pic_s) { ?>
                        <div class="">
                        <center>
                <div class="fileinput-preview" id="imagePreview">
                            <img src="<?php echo url::base()."upload/".$member->user->photo->profile_pic;?>" height="100%">
                            </div>
                            </center>
                            </div>
                        <?php } else { ?>
                        <div class="">
                            <img src="<?php echo url::base()."img/no_image_s.png";?>" style="width: 50px;height: 50px;">
                            </div>
                        <?php } ?>
                  
                    <div class="">
                    <span class="dis-block"><?php echo $member->user->user_detail->first_name ." ".$member->user->user_detail->last_name?>
                    </span>
                      </a>
                    </div>
                    <div class="" style="margin:10px 0px 20px 0px;">
                    <form method="post" style="cursor:pointer;">
                        <input type="hidden" name="arequest_action" value="<?php echo $member->user->id; ?>" />
                        <a class="mem_selected" style="background: none;padding: 8px 34px;color: #12a6bb;border: 1px solid #12a6bb;">Accept</a>
                    </form>
                    </div>
                </li>
                <?php if($index == 4) { ?> </ul><ul class="arequest_members"> <?php } ?>
                
            <?php $index++; } ?>
        </ul>
        
        <form method="post" class="text-center marTop20" style="margin: 15px;">
            <input type="hidden" name="arequest_action" value="delete" />
            <button class="btn btn-secondary" style="border-radius: 5px;">
            <span class="glyphicon glyphicon-trash"></span> 
            Delete this Request</button>
        </form>
    </div>
    
</div>