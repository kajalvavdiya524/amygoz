<?php $session_user = Auth::instance()->get_user(); ?>
<div class="container" style="margin: 0px;">
<div id="row">
<div class="row">
<div class="col-xs-2" style="position: relative;right:12px;">
<center>
    <div id="imagenavi">
    <a href="<?php echo url::base().$session_user->username; ?>" >
        <?php 
        $photo = $user->photo->profile_pic;
        $photo_image = file_exists("upload/" .$photo);
        if(!empty($photo) || $photo_image) { ?>
            <img height="100%"  src="<?php echo url::base()."upload/".$user->photo->profile_pic;?>" alt="<?php echo $user->user_detail->first_name." ".$user->user_detail->last_name;?>">
        <?php } else { ?>
            <div id="inset" style="width: 60px;height: 60px;">
                <h1 style="font-size: 30px;line-height: 60px;">
                   <?php echo $user->user_detail->get_no_image_name();?>
                </h1>
              </div>       
        <?php }?>
       </a> 
       </div>
       </center>
    </div>
    
    <div class="col-xs-10" style="position: relative;left: 12px;top: 25px;">
        <span class="user-name">
            <a href="<?php echo url::base().$session_user->username; ?>" style="font-size: 22px;font-weight:600;color:black;" ><?php echo $user->user_detail->first_name ." ".$user->user_detail->last_name?></a>
        </span>
    </div>
    </div>
    <span><hr style="margin-top:10px;margin-bottom:0px;"/></span>
<div class="row">
    <div class="pad-t20 row">
    <div class="col-xs-2">
        <a href="<?php echo url::base() . 'account/edit_profile'; ?>" class="pad-t10">
    
<i class="ion-android-person pad-t30"></i></a>
</div>
<div class="col-xs-10 pad-bd-1">
    <a href="<?php echo url::base() . 'account/edit_profile'; ?>" class="pad-t10"> Edit Profile</a>
            </div>
    </div>
    <span><hr style="margin: 0px;"/></span>

<div class="pad-t20 row">
<div class="col-xs-2">
        <a class="pad-t10" href="<?php echo url::base() . 'localpeople' ?>">
    <i class="demo-icon icon-street-view pad-t30" style="position: relative;right: 6px;"></i>
    </a>
    </div>
    <div class="col-xs-10 pad-bd-1">
    <a class="pad-t10" href="<?php echo url::base() . 'localpeople' ?>">
    Around
    </a>
    </div>
    </div>
    <span><hr style="margin: 0px;"/></span>

    <div class="pad-t20 row">
        <div class="col-xs-2">
        <a href="<?php echo url::base()."friends"; ?>" class="pad-t10">
        <i class="ion-person-stalker pad-t30"> 
        </i> 
        </a>
        </div>  
        <div class="col-xs-10 pad-bd-1">
        <a href="<?php echo url::base()."friends"; ?>" class="pad-t10">
        Friends
        </a>
        </div>
    </div>
    <span><hr style="margin: 0px;"/></span>

    <div class="pad-t20 row">
        <div class="col-xs-2">
        <a href="<?php echo url::base().'peoplereview/recommend_sent'; ?>" class="pad-t10">
        <img src="https://www.callitme.com/mobile-test/img/review-icon.png" alt="" class="img-responsive" style="margin: 0px auto;width: 30px;float: left;"></a>
        </div>
    <div class="col-xs-10 pad-bd-1" style="top: -4px;">
        <a href="<?php echo url::base().'peoplereview/recommend_sent'; ?>" class="pad-t10">Review sent</a>
        </div>
    </div>
    <span><hr style="margin: 0px;"/></span>

    <div class="pad-t20 row">
    <div class="col-xs-2">
        <a href="<?php echo url::base().'peoplereview/recommend_recieve'; ?>" class="pad-t10">
        <img src="https://www.callitme.com/mobile-test/img/review-icon.png" alt="" class="img-responsive" style="margin: 0px auto;width: 30px;float: left;"></a>
        </div>
        <div class="col-xs-10 pad-bd-1" style="top: -4px;">
        <a href="<?php echo url::base().'peoplereview/recommend_recieve'; ?>" class="pad-t10">
        Review recieved
        </a>
        </div>
    </div>
    <span><hr style="margin: 0px;"/></span>

    <div class="pad-t20 row">
    <div class="col-xs-2">
        <a href="<?php echo url::base() . 'account/change_email'; ?>" class="pad-t10">
        <i class="ion-gear-b pad-t30"></i></a>
            </div>
<div class="col-xs-10 pad-bd-1">
<a href="<?php echo url::base() . 'account/change_email'; ?>" class="pad-t10">Account Setting</a>
    </div>
  </div>
    <span><hr style="margin: 0px;"/></span>
    <div class="pad-t20 row">
    <div class="col-xs-2">
        <a href="<?php echo url::base() . 'logout' ?>" class="pad-t10">
<i class="ion-power pad-t30"></i>
</a>
</div>
    <div class="col-xs-10 pad-bd-1">
         <a href="<?php echo url::base() . 'logout' ?>" class="pad-t10">Logout</a>
         </div>
     </div>
     <span><hr style="margin: 0px;"/></span>
</div>
</div>
<style>
.pad-t20{padding: 13px 0px 13px 0px;}
.pad-t10
{
    color: black;
    font-size: 18px;
    font-weight: 400;
}
.pad-t30{color:#0cc7de;font-size: 25px;}
.pad-bd-1{position: relative;top: 5px;right:20px;}
</style>
