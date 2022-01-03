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
                                <i class="ion-speakerphone" style="color: #00bcd4;font-size: 22px;"></i>Email Notification
                            </h4>    
                        </div>  
                            <div class="collapse in" id="collapseOrderItems4">
                            <div class="panel-body">
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
                                
                                    <label class="switch">
                                            <input type="checkbox" name="req_alert" <?php if($user->user_detail->req_alert) { ?> checked="checked"<?php } ?> >
                                             <div class="slider round"></div> 
                                           <div class="shadding"> <p> When someone sends me a request</p></div>
                            
                                    <label class="switch">
                                            <input type="checkbox" name="msg_alert" <?php if($user->user_detail->msg_alert) { ?> checked="checked"<?php } ?>/> 
                                            <div class="slider round"></div>
                                           <div class="shadding"><p>When someone sends me a message</p></div>
                               
                                    <label class="switch">
                                            <input type="checkbox" name="rec_alert" <?php if($user->user_detail->rec_alert) { ?> checked="checked"<?php } ?>/> 
                                            <div class="slider round"></div>
                                            <div class="shadding"> <p>When someone reviews me</p></div>
                                  
                                    <label class="switch">
                                            <input type="checkbox" name="friend_alert" <?php if($user->user_detail->friend_alert) { ?> checked="checked"<?php } ?>/>
                                            <div class="slider round"></div>
                                            <div class="shadding"> <p>When someone adds me as a friend</p></div>
                                                   <!---------------------------------------------------------------->
                                    <label class="switch">
                                            <input type="checkbox" name="join_alert" <?php if($user->user_detail->join_alert) { ?> checked="checked"<?php } ?>/>
                                           <div class="slider round"></div>
                                           <div class="shadding"> <p>When someone asks me to join Callitme</p></div>
                                  
                                    <label class="switch">
                                            <input type="checkbox" name="profile_alert" <?php if($user->user_detail->profile_alert) { ?> checked="checked"<?php } ?>/>
                                            <div class="slider round"></div>
                                           <div class="shadding"> <p> When someone views my profile</p></div>
                                      
                                    <label class="switch">
                                            <input type="checkbox" name="friend_request_alert" <?php if($user->user_detail->friend_request_alert) { ?> checked="checked"<?php } ?>/>
                                            <div class="slider round"></div>
                                            <div class="shadding"> <p>When someone accepts my friend request</p></div>
                                      
                                    <label class="switch">
                                            <input type="checkbox" name="meet_people_alert" <?php if($user->user_detail->meet_people_alert) { ?> checked="checked"<?php } ?>/>
                                            <div class="slider round"></div>
                                            <div class="shadding"> <p>Reminder to meet people around you email</p></div>
                                                  
                                    <label class="switch">
                                            <input type="checkbox" name="suggestion_email_alert" <?php if($user->user_detail->suggestion_email_alert) { ?> checked="checked"<?php } ?>/>
                                            <div class="slider round"></div>
                                            <div class="shadding"> <p>Connection suggestion email</p></div>
                                     
                                     <label class="switch">
                                          <input type="checkbox" name="profile_information_alert" <?php if($user->user_detail->profile_information_alert) { ?> checked="checked"<?php } ?>/>
                                            <div class="slider round"></div>
                                           <div class="shadding"> <p> When someone asks me for my profile information</p></div>
                                  
                                     <label class="switch">
                                            <input type="checkbox" name="photo_alert" <?php if($user->user_detail->photo_alert) { ?> checked="checked"<?php } ?>/>
                                            <div class="slider round"></div>
                                            <div class="shadding"> <p>When someone asks me for my photo</p></div>
                                     
                                    <label class="switch">
                                            <input type="checkbox" name="friend_email_alert" <?php if($user->user_detail->friend_email_alert) { ?> checked="checked"<?php } ?>/>
                                            <div class="slider round"></div>
                                            <div class="shadding"> <p>Get review by a friend email</p></div>
                                    <!---------------------------------------------------------------->
                                    <hr />
                                    <button type="submit" name="submit" value="true" class="btn btn-secondary marLeft20">Update</button>
                                </form>
                                </div>  
                            </div> 
                        </div>      
                            <div class="panel panel-default">
                                <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems5"> 
                                  <h4 class="panel-title" style="color: #00bcd4 !important;">
                                      <a href="<?php echo url::base();?>account/change_username">
                                      <i class="ion-person" style="color: #00bcd4;font-size: 22px;"></i> Change Username
                                      <i class="glyphicon glyphicon-plus pull-right"></i></a>
                                  </h4>    
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems6"> 
                                  <h4 class="panel-title" style="color: #00bcd4 !important;">
                                      <a href="<?php echo url::base().'account/privacy_settings';?>">
                                      <i class="ion-locked" style="color: #00bcd4;font-size: 22px;"></i>Privacy Setting
                                      <i class="glyphicon glyphicon-plus pull-right"></i></a>
                                  </h4>    
                                </div>
                            </div>
                    </div>  
            </div>
        </div>
    </div>
</section>
