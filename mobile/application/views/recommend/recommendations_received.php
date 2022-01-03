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
    right: 10px;
    overflow: hidden; 
    background-color: white;
}
</style>
<div class="scroll-sec recommendations-block">
    <div class="">
        <?php if (!empty($recommends)) { ?>
            <h4 style="color:#0009;font-weight:500;font-size:16px;">Following are the reviews you have received</h4>
            <hr/> 
            <?php foreach ($recommends as $recommend) { ?>
                <div class="post recommendation collapse-box">
                <div class="" style="border-bottom:1px solid #eee;margin-bottom: 8px;">
                    <?php if ($recommend->type == '1') { ?>
                                <div class="col-xs-2">
                                <center>
                                     <div class="fileinput-preview" id="imagePreview">
                                        <a href="<?php echo url::base() . $recommend->owner->username; ?>">
                                            <?php if ($recommend->owner->photo->profile_pic_s) { ?>
                                                <img class="img-responsive" src="<?php echo url::base() . 'upload/' . $recommend->owner->photo->profile_pic; ?>" height="100%">
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
                            </center>
                                    </div>
                                     <div class="col-xs-8">
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
                                <div class="col-sm-2">
                                    <div class="post-actions state-actions pull-right">
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
                                        <br/>
                                        <small>
                                        <span class="post-time-box pull-left" style="margin-left: 16px;color:rgba(0, 0, 0, 0.47)">
                                            <?php
                                         //   echo $recommend->time;
                                            $age = time() - strtotime($recommend->time);
                                            if ($age >= 86400) {
                                                echo date('jS M', strtotime($recommend->time));
                                            } else {
                                                echo date::time2string($age);
                                            }
                                            ?>
                                        </span>
                                        </small>
                               
                                    <div class="row">
                                        <div class="col-xs-9">
                                                <p style="font-size: 15px;font-weight: 500;"><?php echo nl2br($recommend->message); ?></p>
                                        </div>

                                        <div class="post-matter collapse-description collapse collapseable">
                                            <p><?php echo substr($recommend->message, 0, 70); ?>
                                                <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                                            </p>
                                        </div>
                                    </div>

                        

                    <?php }
                    ?>


                    <div class="clearfix"></div>
                    <?php if ($recommend->type == '0') { ?>
                        <div class="collapse-header">
                            <div class="row">
                                <div class="container" style="margin-bottom: 8px;">
                                    <div class="user-img pull-left" style="position: relative;left: 4px;">
                                        <a href="">

                                            <div id="inset" class="xs center-block hb-mt-5 hb-mr-10">
                                                <h1>
                                                    <i class='fa fa-user'></i>
                                                </h1>
                                            </div>

                                        </a>
                                    </div>
                                    
                                    <div class="post-content">
                                        <div class="post-title">
                                            <strong>
                                                <a href="" style="font-size: 15px;">
                                                    Anonymous User (one of your connections)
                                                </a>
                                            </strong>
                                            <br/>
                                            <span class="post-time-box pull-left">
                                            <?php
                                                $age = time() - strtotime($recommend->time);
                                                if ($age >= 86400) {
                                                    echo date('jS M', strtotime($recommend->time));
                                                } else {
                                                    echo date::time2string($age);
                                                }
                                            ?>
                                        </span>
                                            <span class="">
                                  <!-- Making this block anonymous-->
                                   <div class="post-actions state-actions pull-right text-right" style="position: relative;top: -10px;">
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
                                    
                                </span>
                                        </div>

                                        <div class="post-matter collapse-description collapse collapseable">
                                            <p><?php echo substr($recommend->message, 0, 70); ?>
                                                <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                                            </p>
                                        </div>

                                        <div class="container" style="margin-top: 20px;">
                                            <div class="row">
                                                <p style="margin: 0px 0px 0px 0px;"><?php echo nl2br($recommend->message); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>


                            <div style="clear:right;"></div>

                        </div>



                        <div class="clearfix"></div>
                    <?php }
                    ?>
                </div>
                </div>
            <?php }
            ?>

        <?php } else { ?>
            <h3 class="textCenter">No one has reviewed you yet</h3>
        <?php } ?>
    </div>
</div>