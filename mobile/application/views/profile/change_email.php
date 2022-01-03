<?php $session_user = Auth::instance()->get_user(); ?>
<section id="notificationFeed">
    <div class="row">
        <div class="row">
            <div class="col-xs-12">                  
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                          <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems1"> 
                                <h4 class="panel-title" style="color: #00bcd4 !important;">
                                    <i class="ion-email" style="color: #00bcd4;font-size: 22px;"></i> Change Email
                              </h4>
                            </div>
                          <div class="collapse in" id="collapseOrderItems1">
                              <div class="panel-body"> 
                                  <div class="table">
                                     <?php if(Session::instance()->get('error')) {?>
                                      <div class="alert alert-danger">
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
                                  <?php if($session_user->new_email) {?>
                                      <div class="alert alert-info">
                                          A Confirmation email has been sent to your requested email address ( i.e <b><?php echo $session_user->new_email; ?></b> ).
                                          Please click on the link provided in the email to complete the process.
                                          <p> if not receive yet click <b><a href="<?php echo url::base()."account/email_resend";?>">resend</a>   </b>                             
                                              </p>
                                      </div>
                                  <?php } ?>
                                      <form class="validate-form" method="post" role="form">  
                                          <div class="form-group">
                                              <label class="control-label" for="email">Email:</label>
                                              <input class="required check_un_avail form-control" id="email" type="text" name="email"
                                                  value="<?php echo $session_user->email;?>">
                                          </div>
                                          <button type="submit" class="btn btn-secondary">Update</button>
                                      </form>
                                  </div>
                              </div>
                          </div>  
                        </div>    
                            <div class="panel panel-default">
                                <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems2"> 
                                   <h4 class="panel-title" style="color: #00bcd4 !important;">  
                                         <a href="<?php echo url::base();?>account/change_password" >
                                         <i class="ion-compose" style="color: #00bcd4;font-size: 22px;"></i> Change Password
                                         <i class="glyphicon glyphicon-plus pull-right"></i></a>
                                    </h4>    
                                </div>  
                            </div>   
                            <div class="panel panel-default">
                                <div class="panel-heading collapsed" data-toggle="collapse" data-target="#collapseOrderItems3"> 
                                  <h4 class="panel-title" style="color: #00bcd4 !important;">
                                      <a href="<?php echo url::base().'account/subscription_details'?>">
                                      <i class="ion-social-rss-outline" style="color: #00bcd4;font-size: 22px;"></i> Subscription
                                      <i class="glyphicon glyphicon-plus pull-right"></i></a>
                                  </h4>    
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
