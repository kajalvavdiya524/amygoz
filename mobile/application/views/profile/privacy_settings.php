<?php $session_user = Auth::instance()->get_user(); ?>
<section id="notificationFeed">
    <div class="row">
        <div class="row">
            <div class="col-xs-12">                  
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">   
                        <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems1"> 
                            <h4 class="panel-title" style="color: #00bcd4 !important;">
                               <a href="<?php echo url::base();?>account/change_email"> 
                                <i class="ion-email" style="color: #00bcd4;font-size: 22px;"></i>Change Email
                                 <i class="glyphicon glyphicon-plus pull-right"></i></a>
                          </h4>
                        </div> 
                        </div>   
                        <div class="panel panel-default">   
                        <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems2"> 
                            <h4 class="panel-title" style="color: #00bcd4 !important;">
                               <a href="<?php echo url::base();?>account/change_password">  
                               <i class="ion-compose" style="color: #00bcd4;font-size: 22px;"></i>Change Password
                                 <i class="glyphicon glyphicon-plus pull-right"></i></a>
                          </h4>
                        </div> 
                        </div> 
                        <div class="panel panel-default">   
                        <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems3"> 
                            <h4 class="panel-title" style="color: #00bcd4 !important;">
                               <a href="<?php echo url::base();?>account/subscription_details"> 
                                <i class="ion-social-rss-outline" style="color: #00bcd4;font-size: 22px;"></i>Subscription
                                 <i class="glyphicon glyphicon-plus pull-right"></i></a>
                          </h4>
                        </div> 
                        </div> 

                        <div class="panel panel-default">   
                        <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems4"> 
                            <h4 class="panel-title" style="color: #00bcd4 !important;">
                               <a href="<?php echo url::base();?>account/email_notification_settings"> 
                                <i class="ion-speakerphone" style="color: #00bcd4;font-size: 22px;"></i>Email Notification
                                 <i class="glyphicon glyphicon-plus pull-right"></i></a>
                          </h4>
                        </div> 
                        </div> 

                       <div class="panel panel-default">   
                        <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems5"> 
                            <h4 class="panel-title" style="color: #00bcd4 !important;">
                               <a href="<?php echo url::base();?>account/change_username"> 
                                <i class="ion-person" style="color: #00bcd4;font-size: 22px;"></i>Change Username
                                 <i class="glyphicon glyphicon-plus pull-right"></i></a>
                          </h4>
                        </div> 
                        </div> 

                        <div class="panel panel-default">
                        <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems6"> 
                           <h4 class="panel-title" style="color: #00bcd4 !important;">  
                                <i class="ion-locked" style="color: #00bcd4;font-size: 22px;"></i>Privacy Setting
                            </h4>    
                        </div>  
                            <div class="collapse in" id="collapseOrderItems6">
                            <div class="panel-body">
                                   <legend>Privacy Settings
                                    <small style="display: block; color: #999999; font-size: 16px;">Please mark the fields that you want to hide from public users.</small>
                                </legend>
                                
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
                               <label class="switch">
                                                      <input type="checkbox"  name="friends_private" <?php if($user->user_detail->friends_private) { ?> checked="checked"<?php } ?>/> 
                                                    <div class="slider round"></div>  
                                            <div class="shadding"> <p>Mark 'Friend' as private</p></div>

                                             <label class="switch">
                                                      <input type="checkbox" name="reviews_private" <?php if($user->user_detail->reviews_private) { ?> checked="checked"<?php } ?>/> 
                                                     <div class="slider round"></div>
                                               <div class="shadding"><p> Mark 'Reviews' as private</p></div>

                                              <label class="switch">
                                                      <input type="checkbox" name="people_say_private" <?php if($user->user_detail->people_say_private) { ?> checked="checked"<?php } ?>/> 
                                                      <div class="slider round"></div>
                                              <div class="shadding"><p> Mark 'What people say about you' as private</p></div>

                                              <button type="submit" name="submit" value="true" class="btn btn-secondary marLeft20">Update</button>
                                          </form>
                                </div>  
                            </div> 
                        </div>      
                    </div>  
            </div>
        </div>
    </div>
</section>
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
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color:#4CAF50;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #E91E63;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.shadding{
    width: 200px;
    margin-top: 50px;
    position: relative;
    top: -42px;
    left: 88px;
    color: #9E9E9E;
    font-family: arial;
}
</style>