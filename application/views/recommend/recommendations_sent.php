
<div class="scroll-sec recommendations-block">

    <div class="recommendations">
    
        <?php if(!empty($recommends)) { ?>
            <h4 style="color:#096369;">These are the people you have reviewed</h4>
            
            <?php foreach($recommends as $recommend) { ?>
            <div class="post recommendation collapse-box" style="box-shadow:0 0 0 1px rgba(0,0,0,.1),0 2px 3px rgba(0,0,0,.2);">
            <div class="row">
            <div class="col-xs-2">
                    <div class="user-img pull-left">
                        <a href="<?php echo url::base().$recommend->recommend_to->username; ?>">
                            <?php 
                                $photo = $recommend->recommend_to->photo->profile_pic_s;
                                $rec_image = file_exists("mobile/upload/" .$photo);
                                $rec_image1 = file_exists("upload/" .$photo);
                            if(!empty($photo) && $rec_image) { ?>
                                <img class "square" style=" height: 65px;width: 65px;" src="<?php echo url::base().'mobile/upload/'.$recommend->recommend_to->photo->profile_pic_s;?>">
                            <?php }
                            else if(!empty($photo) && $rec_image1) { ?>
                                <img class "square" style=" height: 65px;width: 65px;" src="<?php echo url::base().'upload/'.$recommend->recommend_to->photo->profile_pic_s;?>">
                            <?php } else { ?>
                                <img  class "square" style=" height: 65px;width: 65px;" src="<?php echo url::base().'img/no_image_s.png' ?>" />
                            <?php } ?>
                        </a>
                    </div>
                    </div>
                    <div class="col-xs-5" style="position: relative;right: 22px;">
                    <div class="post-content">
                        <div class="post-title">
                            <strong>
                                <a href="<?php echo url::base().$recommend->recommend_to->username; ?>">
                                    <?php echo (($recommend->recommend_to->user_detail->first_name) ? 
                                    ($recommend->recommend_to->user_detail->first_name ." ".$recommend->recommend_to->user_detail->last_name) : 
                                    ($recommend->recommend_to->email)); ?>
                                </a>
                            </strong>
                        </div>
                        
                        <div class="post-matter collapse-description collapseable collapse">
                            <p>
                                <?php echo substr($recommend->message, 0, 70);?>
                                <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                            </p>
                        </div>
                    </div>
                    </div>
                    <div class="col-xs-5 text-right">
                    <small class="post-time dis-block" style="color: #7a7a7a;">
                        <?php 
                            $age = time() - strtotime($recommend->time); 
                            if ($age >= 86400) {
                                echo date('jS M', strtotime($recommend->time));
                            } else {
                                echo date::time2string($age);
                            }
                        ?>
                    </small>
                    </div>

                    <div class="col-xs-12">
                        <div class="post-actions pull-right">
                        <a href="<?php echo url::base()."peoplereview/compose?id=".$recommend->id; ?>">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </a>
                    </div>
                    
                    <div style="clear:right;"></div>

                <div class="col-xs-9 collapseable collapse in" style="position: relative;right: 17px;top: -10px;">
                    <div class="collapse-body-content">
                        <p><?php echo nl2br($recommend->message);?></p>
                    </div>
                </div>

                    </div>

                </div>
                    
                    
                    
                <div class="clearfix"></div>
            </div>
            <?php } ?>
        
        <?php } else { ?>
            <h3 class="textCenter">You have not reviewed anyone yet.</h3>
        <?php } ?>
    </div>
</div>