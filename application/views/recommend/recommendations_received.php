<div class="scroll-sec recommendations-block">

    <div class="recommendations">

        <?php if (!empty($recommends)) { ?>
            <h4>Following are the reviews you have received</h4>

            <?php foreach ($recommends as $recommend) { ?>
                <div class="post recommendation collapse-box" style="box-shadow: 0 0 0 1px rgba(0,0,0,.1),0 2px 3px rgba(0,0,0,.2);padding: 20px;">
                    <?php if ($recommend->type == '1') { ?>
                        <div class="collapse-header">
                            <div class="row">
                                <div class="row">
                                    <div class="col-xs-1">
                                        <div class="user-img pull-left hb-mr-10">
                                            <a href="<?php echo url::base() . $recommend->owner->username; ?>">
                                            <?php 
                                            $photo = $recommend->owner->photo->profile_pic_s;
                                             $rec_image = file_exists("mobile/upload/" .$photo);
                                             $rec_image1 = file_exists("upload/" .$photo);
                                            if (!empty($photo) && $rec_image) { ?>
                                                <img src="<?php echo url::base() . 'mobile/upload/' . $recommend->owner->photo->profile_pic_s; ?>" width="50" height="50">
                                            <?php }
                                            else if (!empty($photo) && $rec_image1) { ?>
                                                <img src="<?php echo url::base() . 'upload/' . $recommend->owner->photo->profile_pic_s; ?>" width="50" height="50">
                                            <?php } else { ?>
                                                    <!--<img src="<?php //echo url::base().'img/no_image_s.png'?>" />-->
                                                <div id="inset" class="xs pull-left hb-mt-5">
                                                    <h1>
                                                        <?php
                                                        if ($recommend->owner->user_detail->first_name != '') {
                                                            echo $recommend->owner->user_detail->first_name[0] . " " . $recommend->owner->user_detail->last_name[0];
                                                        } else {
                                                            echo "<i class='fa fa-user'></i>";
                                                        }
                                                        ?>
                                                    </h1>
                                                </div>
                                            <?php } ?>
                                        </a>
                                    </div>
                                    </div>
                                    <div class="col-xs-9">
                                    <div class="post-content" style="position: relative;left: 10px;">
                                        <div class="post-title">
                                            <strong>
                                                <a href="<?php if ($recommend->owner->username != 'nagecs9pm8t3347') echo url::base() . $recommend->owner->username; ?>">
                                                    <?php
                                                    if ($recommend->owner->user_detail->first_name != '') {
                                                        echo $recommend->owner->user_detail->first_name . " " . $recommend->owner->user_detail->last_name;
                                                    } else {
                                                        echo "Anonymous User";
                                                    }
                                                    ?>
                                                </a>
                                            </strong>
                                        </div>
                                         </div>
                                        <div class="col-xs-12 collapseable collapse in">
                                            <div class="collapse-body-content">
                                                <p><?php echo nl2br($recommend->message); ?></p>
                                            </div>
                                        </div>

                                        <div class="post-matter collapse-description collapse collapseable">
                                            <p><?php echo substr($recommend->message, 0, 70); ?>
                                                <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                                            </p>
                                        </div>
                                    </div>
                                                   <div class="col-sm-2">
                                    <div class="post-actions state-actions pull-right">
                                        <small class="post-time pull-right dis-block" style="color: #717070;cursor: auto;">
                                            <?php
                                         //   echo $recommend->time;
                                            $age = time() - strtotime($recommend->time);
                                            if ($age >= 86400) {
                                                echo date('jS M', strtotime($recommend->time));
                                            } else {
                                                echo date::time2string($age);
                                            }
                                            ?>
                                        </small>
                                        <div class="clearfix"></div>
                                        <?php if ($recommend->state == 'pending') { ?>

                                            <form action="<?php echo url::base() . "peoplereview/state" ?>" method="post" class="dis-inline">
                                                <input type="hidden" name="state" value="approve" />
                                                <input type="hidden" name="recommend" value="<?php echo $recommend->id ?>" />
                                                <a class="state-change"><span class="glyphicon glyphicon-thumbs-up"></span> <span>Approve</span></a>
                                            </form>
                                            <form action="<?php echo url::base() . "peoplereview/state" ?>" method="post" class="dis-inline">
                                                <input type="hidden" name="state" value="decline" />
                                                <input type="hidden" name="recommend" value="<?php echo $recommend->id ?>" />
                                                <a class="state-change"><span class="glyphicon glyphicon-thumbs-down"></span> <span>Decline</span></a>
                                            </form>
                                        <?php } else if ($recommend->state == 'decline') { ?>

                                            <form action="<?php echo url::base() . "peoplereview/state" ?>" method="post" class="dis-inline">
                                                <input type="hidden" name="state" value="approve" />
                                                <input type="hidden" name="recommend" value="<?php echo $recommend->id ?>" />
                                                <a class="state-change"><span class="glyphicon glyphicon-thumbs-up"></span> <span>Approve</span></a>
                                            </form>

                                        <?php } else if ($recommend->state == 'approve') { ?>

                                            <form action="<?php echo url::base() . "peoplereview/state" ?>" method="post" class="dis-inline">
                                                <input type="hidden" name="state" value="hide" />
                                                <input type="hidden" name="recommend" value="<?php echo $recommend->id ?>" />
                                                <a class="state-change"><span class="glyphicon glyphicon-eye-close"></span> <span>Hide</span></a>
                                            </form>

                                        <?php } else if ($recommend->state == 'hide') { ?>

                                            <form action="<?php echo url::base() . "peoplereview/state" ?>" method="post" class="dis-inline">
                                                <input type="hidden" name="state" value="approve" />
                                                <input type="hidden" name="recommend" value="<?php echo $recommend->id ?>" />
                                                <a class="state-change"><span class="glyphicon glyphicon-eye-open"></span> <span>Show</span></a>
                                            </form>

                                        <?php } ?>
                                        <img src="<?php echo url::base() . "img/loader.gif"; ?>" style="display:none;"/>
                                    </div>                                    
                                </div>

                                    </div>
                
                            </div>

                        </div>
                    <?php }
                    ?>


                    <div class="clearfix"></div>
                    <?php if ($recommend->type == '0') { ?>
                        <div class="collapse-header">
                            <div class="row">
                                <div class="row">
                                <div class="col-xs-1">
                                    <div class="user-img pull-left">
                                        <a href="">

                                            <div id="inset" class="xs center-block hb-mt-5 hb-mr-10">
                                                <h1>
                                                    <i class='fa fa-user'></i>
                                                </h1>
                                            </div>

                                        </a>
                                    </div>
                                    </div>
                                    <div class="col-xs-9">
                                    <div class="post-content" style="position: relative;left: 10px;">
                                        <div class="post-title">
                                            <strong>
                                                <a href="">
                                                    Anonymous User (one of your connections)
                                                </a>
                                            </strong>
                                        </div>

                                        <div class="post-matter collapse-description collapse collapseable">
                                            <p><?php echo substr($recommend->message, 0, 70); ?>
                                                <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                                            </p>
                                        </div>
                                         </div>
                                        <div class="col-xs-12 collapseable collapse in">
                                            <div class="collapse-body-content">
                                                <p><?php echo nl2br($recommend->message); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                                     <div class="col-sm-2">
                                  <!--  Making this block anonymous -->
                                   <div class="post-actions state-actions pull-right text-right">
                                         
                                         <small class="post-time pull-right dis-block" style="color: #717070;cursor: auto;">
                                            <?php
                                                $age = time() - strtotime($recommend->time);
                                                if ($age >= 86400) {
                                                    echo date('jS M', strtotime($recommend->time));
                                                } else {
                                                    echo date::time2string($age);
                                                }
                                            ?>
                                        </small> 
                                        <div class="clearfix"></div>
                                        <?php if ($recommend->state == 'pending') { ?>
                                            <form action="<?php echo url::base() . "peoplereview/state" ?>" method="post" class="dis-inline">
                                                <input type="hidden" name="state" value="approve" />
                                                <input type="hidden" name="recommend" value="<?php echo $recommend->id ?>" />
                                                <a class="state-change"><span class="glyphicon glyphicon-thumbs-up"></span> <span>Approve</span></a>
                                            </form>
                                            <form action="<?php echo url::base() . "peoplereview/state" ?>" method="post" class="dis-inline">
                                                <input type="hidden" name="state" value="decline" />
                                                <input type="hidden" name="recommend" value="<?php echo $recommend->id ?>" />
                                                <a class="state-change"><span class="glyphicon glyphicon-thumbs-down"></span> <span>Decline</span></a>
                                            </form>
                                        <?php } else if ($recommend->state == 'decline') { ?>
                                            <form action="<?php echo url::base() . "peoplereview/state" ?>" method="post" class="dis-inline">
                                                <input type="hidden" name="state" value="approve" />
                                                <input type="hidden" name="recommend" value="<?php echo $recommend->id ?>" />
                                                <a class="state-change"><span class="glyphicon glyphicon-thumbs-up"></span> <span>Approve</span></a>
                                            </form>
                                        <?php } else if ($recommend->state == 'approve') { ?>
                                            <form action="<?php echo url::base() . "peoplereview/state" ?>" method="post" class="dis-inline">
                                                <input type="hidden" name="state" value="hide" />
                                                <input type="hidden" name="recommend" value="<?php echo $recommend->id ?>" />
                                                <a class="state-change"><span class="glyphicon glyphicon-eye-close"></span> <span>Hide</span></a>
                                            </form>
                                        <?php } else if ($recommend->state == 'hide') { ?>
                                            <form action="<?php echo url::base() . "peoplereview/state" ?>" method="post" class="dis-inline">
                                                <input type="hidden" name="state" value="approve" />
                                                <input type="hidden" name="recommend" value="<?php echo $recommend->id ?>" />
                                                <a class="state-change"><span class="glyphicon glyphicon-eye-open"></span> <span>Show</span></a>
                                            </form>
                                        <?php } ?>
                                        <img src="<?php echo url::base() . "img/loader.gif"; ?>" style="display:none;"/>
                                    </div>
                                    <!-- <small class="post-time pull-right dis-block">
                                            <?php
                                            //echo $recommend->time;
                                            $age = time() - strtotime($recommend->time);
                                            if ($age >= 86400) {
                                                echo date('jS M', strtotime($recommend->time));
                                            } else {
                                                echo date::time2string($age);
                                            }
                                            ?>
                                        </small> -->
                                </div>
                                </div>
               
                            </div>


                            <div style="clear:right;"></div>

                        </div>



                        <div class="clearfix"></div>
                    <?php }
                    ?>
                </div>
            <?php }
            ?>

        <?php } else { ?>
            <h3 class="textCenter">No one has reviewed you yet</h3>
        <?php } ?>
    </div>
</div>