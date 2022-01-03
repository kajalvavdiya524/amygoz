<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<style>
#imagePreview {
    width: 50px;
    height: 50px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-top: 13px;
    position: relative;
    top: -7px;
    right: 13px;
    overflow: hidden; 
    background-color: white;
}
</style>
<div class="scroll-sec recommendations-block">
    <div class="">
        <?php if(!empty($recommends)) { ?>
            <h4 style="color:#0009;font-weight:500;font-size:16px;">These are the people you have reviewed</h4>
            <hr/> 
            <?php foreach($recommends as $recommend) { ?>
            <div class="post recommendation collapse-box">
                <div class="" style="border-bottom:1px solid #eee;margin-bottom: 8px;">
                <div class="col-xs-2">
           <center>
                    <div id="imagePreview">
                        <a href="<?php echo url::base().$recommend->recommend_to->username; ?>">
                            <?php if($recommend->recommend_to->photo->profile_pic_s) { ?>
                                <img src="<?php echo url::base().'upload/'.$recommend->recommend_to->photo->profile_pic;?>" height="100%">
                            <?php } else { ?>
                                <img src="<?php echo url::base().'img/no_image_s.png' ?>" height="100%"/>
                            <?php } ?>
                            </a>
                    </div>
            </center>
                    </div>
                    <div class="col-xs-8">
                        <div class="post-title">
                            <strong>
                                <a href="<?php echo url::base().$recommend->recommend_to->username; ?>">
                                    <?php echo (($recommend->recommend_to->user_detail->first_name) ? 
                                    ($recommend->recommend_to->user_detail->first_name ." ".$recommend->recommend_to->user_detail->last_name) : 
                                    ($recommend->recommend_to->email)); ?>
                                </a>
                            </strong>
                        </div>
                    </div>
                    <div class="">
                        <div class="post-actions pull-right">
                        <a href="<?php echo url::base()."peoplereview/compose?id=".$recommend->id; ?>">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </a>
                    </div>
                    </div>
                    <br/>
                    <small>
                        <span class="post-time-box pull-left" style="margin-left: 16px;color:rgba(0, 0, 0, 0.47)">
                        <?php 
                            $age = time() - strtotime($recommend->time); 
                            if ($age >= 86400) {
                                echo date('jS M', strtotime($recommend->time));
                            } else {
                                echo date::time2string($age);
                            }
                        ?>
                    </span>
                </small>
                    <div class="post-content">
                        <div class="post-matter collapse-description collapseable collapse">
                            <p>
                                <?php echo substr($recommend->message, 0, 70);?>
                                <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-xs-9">
                        <p style="font-size: 15px;font-weight: 500;"><?php echo nl2br($recommend->message);?></p>
                    </div>
                    <div style="clear:right;"></div>
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
