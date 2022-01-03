<?php $session_user = Auth::instance()->get_user(); ?>
<link rel="stylesheet" href="<?php echo url::base()?>sidemenu/css/components.css">
<link rel="stylesheet" href="<?php echo url::base()?>sidemenu/css/responsee.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="<?php echo url::base()?>css/bootstrap-switch.css">

<script type="text/javascript" src="<?php echo url::base()?>sidemenu/js/jquery-ui.min.js"></script>    
<script type="text/javascript" src="<?php echo url::base()?>sidemenu/js/modernizr.js"></script>
<script type="text/javascript" src="<?php echo url::base()?>sidemenu/js/responsee.js"></script>

<script type="text/javascript" src="<?php echo url::base()?>js/bootstrap-switch.min.js"></script>

<div class="row" style="border 1px solid grey;padding:25px;">
     <fieldset class="fieldset">
          
        <div class="col-sm-4">
            <div class="line">
       
                <div class="margin">
                    <aside class="s-12">
                  
                        <div class="aside-nav">
                            <ul>
                                <li class="active"><a href="<?php echo url::base();?>account/change_email">Change Email</a></li>
                                <li><a href="<?php echo url::base();?>account/change_password">Change Password</a></li>
                                <li><a href="<?php echo url::base().'account/subscription_details'?>">Subscription</a></li>
                                <li><a href="<?php echo url::base();?>account/email_notification_settings">Email Notification</a></li>
                                <li><a href="<?php echo url::base();?>account/change_username">Change Username</a></li>
                                <li><a href="<?php echo url::base().'account/privacy_settings';?>">Privacy Setting</a></li>
                            </ul>
                        </div>
                    </aside>
                </div>
         
            </div>
        </div>
        <div class="col-sm-8">
            <div class="line">
                <div class="recommendations-compose">
    
                    <fieldset class="fieldset">
                        <legend>Email Notifications Settings</legend>
                        
                        <?php if(Session::instance()->get('error')) {?>
                            <div class="alert alert-error">
                               <strong>Error !</strong>
                               <?php echo Session::instance()->get_once('error');?>
                            </div>
                        <?php } ?>
                        
                        <?php if(Session::instance()->get('success')) {?>
                            <div class="alert alert-success">
                               <strong>SUCCESS </strong>
                               <?php echo Session::instance()->get_once('success');?>
                            </div>
                        <?php } ?>
                        
                        
                        <form class="validate-form" method="post" role="form">
                        
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="req_alert" <?php if($user->user_detail->req_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> When someone sends me a request</p>
                                </div>
                            </div>
                            
                            <div class="row marTop20">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="msg_alert" <?php if($user->user_detail->msg_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> When someone sends me a message</p>
                                </div>
                            </div>
                            
                            <div class="row marTop20">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="rec_alert" <?php if($user->user_detail->rec_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> When someone reviews me</p>
                                </div>
                            </div>
                            
                            <div class="row marTop20">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="friend_alert" <?php if($user->user_detail->friend_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> When someone adds me as a friend</p>
                                </div>
                            </div>
                            
                            <div class="row marTop20">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="join_alert" <?php if($user->user_detail->join_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> When someone asks me to join Callitme</p>
                                </div>
                            </div>
                            
                            <div class="row marTop20">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="profile_alert" <?php if($user->user_detail->profile_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> When someone views my profile</p>
                                </div>
                            </div>
                            
                            <div class="row marTop20">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="friend_request_alert" <?php if($user->user_detail->friend_request_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> When someone accepts my friend request</p>
                                </div>
                            </div>
                            
                            <div class="row marTop20">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="meet_people_alert" <?php if($user->user_detail->meet_people_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> Reminder to meet people around you email</p>
                                </div>
                            </div>
                            
                            <div class="row marTop20">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="suggestion_email_alert" <?php if($user->user_detail->suggestion_email_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> Connection suggestion email</p>
                                </div>
                            </div>
                            
                            <div class="row marTop20">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="profile_information_alert" <?php if($user->user_detail->profile_information_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> When someone asks me for my profile information</p>
                                </div>
                            </div>
                            
                            <div class="row marTop20">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="photo_alert" <?php if($user->user_detail->photo_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> When someone asks me for my photo</p>
                                </div>
                            </div>
                            
                            <div class="row marTop20">
                                <div class="col-md-2">
                                    <input type="checkbox" class="chkbx-on-off" name="friend_email_alert" <?php if($user->user_detail->friend_email_alert) { ?> checked="checked"<?php } ?>/>
                                </div>
                                <div class="col-md-10">
                                    <p class="chkbx-on-off-text"> Get review by a friend email</p>
                                </div>
                            </div>
                                
                            <hr />
                            <button type="submit" name="submit" value="true" class="btn btn-secondary marLeft20">Update</button>
                        </form>
                    </fieldset>

                </div>
            </div>
        </div>
    </fieldset>

</div>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Responsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7641809175244151"
     data-ad-slot="3812425620"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<script>
    $(document).ready(function () {
        $(".chkbx-on-off").bootstrapSwitch({
            size: 'small',
            onColor: 'success'
        });
    });
</script>

<style>
.chkbx-on-off-text {
    color: #9E9E9E;
    font-family: arial;
    font-weight: bold;
    margin-top: 5px;
}
</style>