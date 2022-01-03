
<div class="scroll-sec recommendations-block">

    <div class="recommendations">

        <?php if(!empty($recommends)) { ?>
            <h4 style="color:#096369;">Following are the reviews you have received</h4>

            <?php foreach($recommends as $recommend) { ?>
            <div class="post recommendation collapse-box">
            <?php if($recommend->type=='1'){ ?>
                <div class="collapse-header">
                    <div class="user-img pull-left">
                        <a href="<?php echo url::base().$recommend->owner->username; ?>">
                            <?php if($recommend->owner->photo->profile_pic_s) { ?>
                                <img src="<?php echo url::base().'upload/'.$recommend->owner->photo->profile_pic_s;?>">
                            <?php } else { ?>
                                <img src="<?php echo url::base().'img/no_image_s.png' ?>" />
                            <?php } ?>
                        </a>
                    </div>

                    <span class="post-time pull-right dis-block">
                        <?php
                            $age = time() - strtotime($recommend->time);
                            if ($age >= 86400) {
                                echo date('jS M', strtotime($recommend->time));
                            } else {
                                echo date::time2string($age);
                            }
                        ?>
                    </span>

                    <div class="post-content">
                        <div class="post-title">
                            <strong>
                                <a href="<?php if($recommend->owner->username!='nagecs9pm8t3347')echo url::base().$recommend->owner->username; ?>">
                                    From: <?php if($recommend->owner->user_detail->first_name!='' ){echo $recommend->owner->user_detail->first_name ." ".$recommend->owner->user_detail->last_name;}else{echo "Anonymous User";} ?>
                                </a>
                            </strong>
                        </div>

                        <div class="post-matter collapse-description collapse collapseable">
                            <p><?php echo substr($recommend->message, 0, 70);?>
                                <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                            </p>
                        </div>
                    </div>

                    <div class="post-actions state-actions pull-right">
                        <?php if($recommend->state == 'pending') { ?>

                                <form action="<?php echo url::base()."peoplereview/state"?>" method="post" class="dis-inline">
                                    <input type="hidden" name="state" value="approve" />
                                    <input type="hidden" name="recommend" value="<?php echo $recommend->id?>" />
                                    <a class="state-change marRight20"><span class="glyphicon glyphicon-thumbs-up"></span> <span>Approve</span></a>
                                </form>
                                <form action="<?php echo url::base()."peoplereview/state"?>" method="post" class="dis-inline">
                                    <input type="hidden" name="state" value="decline" />
                                    <input type="hidden" name="recommend" value="<?php echo $recommend->id?>" />
                                    <a class="state-change marRight20"><span class="glyphicon glyphicon-thumbs-down"></span> <span>Decline</span></a>
                                </form>
                        <?php } else if($recommend->state == 'decline') { ?>

                                <form action="<?php echo url::base()."peoplereview/state"?>" method="post" class="dis-inline">
                                    <input type="hidden" name="state" value="approve" />
                                    <input type="hidden" name="recommend" value="<?php echo $recommend->id?>" />
                                    <a class="state-change marRight20"><span class="glyphicon glyphicon-thumbs-up"></span> <span>Approve</span></a>
                                </form>

                        <?php } else if($recommend->state == 'approve') { ?>

                                <form action="<?php echo url::base()."peoplereview/state"?>" method="post" class="dis-inline">
                                    <input type="hidden" name="state" value="hide" />
                                    <input type="hidden" name="recommend" value="<?php echo $recommend->id?>" />
                                    <a class="state-change marRight20"><span class="glyphicon glyphicon-eye-close"></span> <span>Hide</span></a>
                                </form>

                        <?php } else if($recommend->state == 'hide') { ?>

                                <form action="<?php echo url::base()."peoplereview/state"?>" method="post" class="dis-inline">
                                    <input type="hidden" name="state" value="approve" />
                                    <input type="hidden" name="recommend" value="<?php echo $recommend->id?>" />
                                    <a class="state-change marRight20"><span class="glyphicon glyphicon-eye-open"></span> <span>Show</span></a>
                                </form>

                        <?php } ?>
                        <img src="<?php echo url::base()."img/loader.gif"; ?>" style="display:none;"/>
                    </div>

                    <div style="clear:right;"></div>

                </div>

                <div class="collapse-body collapseable collapse in">
                    <div class="collapse-body-content">
                        <p><?php echo nl2br($recommend->message);?></p>
                    </div>
                </div>

                <div class="clearfix"></div>
                <?php
            } ?>

                <?php if($recommend->type=='0'){ ?>
                    <div class="collapse-header">
                        <div class="user-img pull-left">
                            <a href="">

                                    <img src="<?php echo url::base().'img/no_image_s.png' ?>" />

                            </a>
                        </div>

                    <span class="post-time pull-right dis-block">
                        <?php
                        $age = time() - strtotime($recommend->time);
                        if ($age >= 86400) {
                            echo date('jS M', strtotime($recommend->time));
                        } else {
                            echo date::time2string($age);
                        }
                        ?>
                    </span>

                        <div class="post-content">
                            <div class="post-title">
                                <strong>
                                    <a href="">
                                        From:  Anonymous User
                                    </a>
                                </strong>
                            </div>

                            <div class="post-matter collapse-description collapse collapseable">
                                <p><?php echo substr($recommend->message, 0, 70);?>
                                    <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                                </p>
                            </div>
                        </div>

                      <!--  <div class="post-actions state-actions pull-right">
                            <?php if($recommend->state == 'pending') { ?>

                                <form action="<?php echo url::base()."peoplereview/state"?>" method="post" class="dis-inline">
                                    <input type="hidden" name="state" value="approve" />
                                    <input type="hidden" name="recommend" value="<?php echo $recommend->id?>" />
                                    <a class="state-change marRight20"><span class="glyphicon glyphicon-thumbs-up"></span> <span>Approve</span></a>
                                </form>
                                <form action="<?php echo url::base()."peoplereview/state"?>" method="post" class="dis-inline">
                                    <input type="hidden" name="state" value="decline" />
                                    <input type="hidden" name="recommend" value="<?php echo $recommend->id?>" />
                                    <a class="state-change marRight20"><span class="glyphicon glyphicon-thumbs-down"></span> <span>Decline</span></a>
                                </form>
                            <?php } else if($recommend->state == 'decline') { ?>

                                <form action="<?php echo url::base()."peoplereview/state"?>" method="post" class="dis-inline">
                                    <input type="hidden" name="state" value="approve" />
                                    <input type="hidden" name="recommend" value="<?php echo $recommend->id?>" />
                                    <a class="state-change marRight20"><span class="glyphicon glyphicon-thumbs-up"></span> <span>Approve</span></a>
                                </form>

                            <?php } else if($recommend->state == 'approve') { ?>

                                <form action="<?php echo url::base()."peoplereview/state"?>" method="post" class="dis-inline">
                                    <input type="hidden" name="state" value="hide" />
                                    <input type="hidden" name="recommend" value="<?php echo $recommend->id?>" />
                                    <a class="state-change marRight20"><span class="glyphicon glyphicon-eye-close"></span> <span>Hide</span></a>
                                </form>

                            <?php } else if($recommend->state == 'hide') { ?>

                                <form action="<?php echo url::base()."peoplereview/state"?>" method="post" class="dis-inline">
                                    <input type="hidden" name="state" value="approve" />
                                    <input type="hidden" name="recommend" value="<?php echo $recommend->id?>" />
                                    <a class="state-change marRight20"><span class="glyphicon glyphicon-eye-open"></span> <span>Show</span></a>
                                </form>

                            <?php } ?>
                            <img src="<?php echo url::base()."img/loader.gif"; ?>" style="display:none;"/>
                        </div>-->

                        <div style="clear:right;"></div>

                    </div>

                    <div class="collapse-body collapseable collapse in">
                        <div class="collapse-body-content">
                            <p><?php echo nl2br($recommend->message);?></p>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <?php
                } ?>
            </div>
            <?php
                } ?>

        <?php } else { ?>
            <h3 class="textCenter">No one has reviewed you yet.</h3>
        <?php } ?>
    </div>
</div>