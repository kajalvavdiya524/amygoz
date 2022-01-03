<?php $session_user = Auth::instance()->get_user();?>

<link rel="stylesheet" href="<?php echo url::base()?>sidemenu/css/components.css">
      <link rel="stylesheet" href="<?php echo url::base()?>sidemenu/css/responsee.css">
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="<?php echo url::base()?>sidemenu/js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="<?php echo url::base()?>sidemenu/js/jquery-ui.min.js"></script>    
      <script type="text/javascript" src="<?php echo url::base()?>sidemenu/js/modernizr.js"></script>
      <script type="text/javascript" src="<?php echo url::base()?>sidemenu/js/responsee.js"></script>


<div class="row" style="border 1px solid grey;padding:25px;">
     <fieldset class="fieldset">
           
<div class="col-sm-4">
 <div class="line">
       
            <div class="margin">
 <aside class="s-12">
                  
                  <div class="aside-nav">
                     <ul>
                            <li class="active"><a href="<?php echo url::base();?>account/change_email">Change Email</a></li>
                            <li ><a href="<?php echo url::base();?>account/change_password">Change Password</a></li>
                            <li><a href="<?php echo url::base().'account/subscription_details'?>">Subscription</a></li>
                            <li><a href="<?php echo url::base();?>account/email_notification_settings">Email Notification</a></li>
                             <li  ><a href="<?php echo url::base();?>account/change_username">Change Username</a></li>
                              <li ><a href="<?php echo url::base().'account/privacy_settings';?>">Privacy Setting</a></li>
                     </ul>
                  </div>
               </aside>
            </div>
         
      </div>
</div>
<div class="col-sm-8">

    <div class="recommendations-compose">
        
        <fieldset class="fieldset">
            <legend>Subscription Details</legend>
            
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
            
            <div class="clearfix"></div>
        </fieldset>

    </div>
</div>
</fieldset>

<!-- <fieldset class="fieldset deactivate-section">
            <legend></legend>

            <div>
                   
                    <a class="btn btn-primary pull-right" href="<?php echo url::base()."upgrade"; ?>" id="">Upgrade My Account</a>
               
            </div>
            
            <form style="display:none;" id="deactivate-form" action="<?php echo url::base()."profile/deactivate"?>" method="post">
                <input type="hidden" name="confirm" value="ok" />
            </form>

        </fieldset> -->
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