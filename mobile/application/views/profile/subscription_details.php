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
                                <i class="ion-social-rss-outline" style="color: #00bcd4;font-size: 22px;"></i>Subscription
                            </h4>    
                        </div>  
                            <div class="collapse in" id="collapseOrderItems3">
                            <div class="panel-body">
                                   <h4>You are <?php echo ucwords($session_user->plan->name);?> member. Your account at a glance</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Used</th>
                                                <th>Remaining</th>
                                            </tr>
                                        </thead>
                                        
                                        <tr>
                                            <td>Requests to friends (<?php echo $session_user->plan->r_to_friend;?>)</td>
                                            <td><?php echo $session_user->plan->r_to_friend_used;?></td>
                                            <td><?php echo $session_user->plan->r_to_friend - $session_user->plan->r_to_friend_used;?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Requests to Anyone (<?php echo $session_user->plan->r_to_anyone;?>)</td>
                                            <td><?php echo $session_user->plan->r_to_anyone_used;?></td>
                                            <td><?php echo $session_user->plan->r_to_anyone - $session_user->plan->r_to_anyone_used;?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Message to Anyone (<?php echo $session_user->plan->m_to_anyone;?>)</td>
                                            <td><?php echo $session_user->plan->m_to_anyone_used;?></td>
                                            <td><?php echo $session_user->plan->m_to_anyone - $session_user->plan->m_to_anyone_used;?></td>
                                        </tr>
                                    
                                    </table>
                                    
                                    <h4>
                                    <?php if(!empty($session_user->last_payment)) { ?>
                                    Your last payment was <?php echo date('Y-m-d', strtotime($session_user->last_payment));?>. 
                                    <?php } ?>
                                    Your current plan expires on <?php echo date('Y-m-d', strtotime($session_user->plan->plan_expires));?></h4>

                                    <?php if($session_user->next_plan) { ?>
                                        <?php $next_plan = ORM::factory('payment', $session_user->next_plan);?>
                                        <h4>Your next plan is <?php echo ucwords($next_plan->plan); ?> and will be activated when your current plan expires.</h4>
                                    <?php } ?>  
                                </div>  
                            </div> 
                        </div>      
                            <div class="panel panel-default">
                                <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems4"> 
                                  <h4 class="panel-title" style="color: #00bcd4 !important;">
                                      <a href="<?php echo url::base();?>account/email_notification_settings">
                                      <i class="ion-speakerphone" style="color: #00bcd4;font-size: 22px;"></i> Email Notification
                                      <i class="glyphicon glyphicon-plus pull-right"></i></a>
                                  </h4>    
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
                                      <i class="ion-locked" style="color: #00bcd4;font-size: 22px;"></i> Privacy Setting
                                      <i class="glyphicon glyphicon-plus pull-right"></i></a>
                                  </h4>    
                                </div>
                            </div>
                    </div>  
            </div>
        </div>
    </div>
</section>
