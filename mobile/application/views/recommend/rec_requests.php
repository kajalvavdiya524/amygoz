
<div class="scroll-sec recommendations-block">

    <div class="container">
    
        <?php if(!empty($requests)) { ?>
            <h4 style="color:#096369;">Friends requesting a review from you</h4>
            
            <?php foreach($requests as $request) { ?>
            <div class="post recommendation collapse-box">
            
                <div class="collapse-header">
                    <div class="user-img pull-left">
                        <a href="<?php echo url::base().$request->owner->username; ?>">
                            <?php if($request->owner->photo->profile_pic_s) { ?>
                                <img src="<?php echo url::base().'upload/'.$request->owner->photo->profile_pic_s;?>">
                            <?php } else { ?>
                                <img src="<?php echo url::base().'img/no_image_s.png' ?>" />
                            <?php } ?>
                        </a>
                    </div>
                    
                    <span class="post-time pull-right dis-block">
                        <?php 
                            $age = time() - strtotime($request->time); 
                            if ($age >= 86400) {
                                echo date('jS M', strtotime($request->time));
                            } else {
                                echo date::time2string($age);
                            }
                        ?>
                    </span>

                    <div class="post-content">
                        <div class="post-title">
                            <strong>
                                <a href="<?php echo url::base().$request->owner->username; ?>">
                                    From:
                                    <?php echo (($request->owner->user_detail->first_name) ? 
                                    ($request->owner->user_detail->first_name ." ".$request->owner->user_detail->last_name) : 
                                    ($request->owner->email)); ?>
                                </a>
                            </strong>
                        </div>
                        
                        <div class="post-matter collapse-description collapseable collapse">
                            <p><?php echo substr($request->message, 0, 70);?>
                                <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="post-actions pull-right state-actions">
                        <a href="<?php echo url::base()."peoplereview/compose?ask=".$request->owner->username; ?>">
                           <span class="glyphicon glyphicon-thumbs-up"></span> <span> Review</span>
                        </a>
                        <span class="seperator">|</span>
                        <form action="<?php echo url::base()."peoplereview/delete_request"?>" method="post" class="dis-inline">
                            <input type="hidden" name="request" value="<?php echo $request->id?>" />
                            <a class="delete-request btn btn-primary btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                        </form>
                        
                        <img src="<?php echo url::base()."img/loader.gif"; ?>" style="display:none;"/>
                    </div>
                    
                    <div style="clear:right;"></div>

                </div>

                <div class="collapse-body collapseable collapse in">
                    <div class="collapse-body-content">
                        <p><?php echo nl2br($request->message);?></p>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
            <?php } ?>
        
        <?php } else { ?>
            <h4 class="text-Center">No one has requested a review from you.</h3>
        <?php } ?>
    </div>
</div>