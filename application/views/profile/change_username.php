<?php $session_user = Auth::instance()->get_user(); ?>
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
                            <li ><a href="<?php echo url::base();?>account/change_email">Change Email</a></li>
                            <li class="active" ><a href="<?php echo url::base();?>account/change_password">Change Password</a></li>
                            <li><a href="<?php echo url::base().'account/subscription_details'?>">Subscription</a></li>
                            <li><a href="<?php echo url::base();?>account/email_notification_settings">Email Notification</a></li>
                             <li class="active" ><a href="<?php echo url::base();?>account/change_username">Change Username</a></li>
                              <li ><a href="<?php echo url::base().'account/privacy_settings';?>">Privacy Setting</a></li>
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
            <legend>Change Username</legend>
            
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

            <form class="validate-form" method="post" role="form">
                
                <div class="form-group">
                    <label class="control-label" for="username">Username:</label>
                    <input class="required callusername usernameRegex uniqueUsername check_un_avail form-control" id="selected-username" type="text" name="username"
                        value="<?php echo $user->username;?>">
                </div>
                
                <fieldset style="margin-bottom:15px;">
                    <legend>Username Suggestions</legend>
                    <?php foreach($suggestions as $suggestion) { ?>
                        <div class="radio">
                            <label>
                                <input type="radio" name="suggestion" class="un-suggestion" value="<?php echo str_replace(' ', '', $suggestion); ?>">
                                <?php echo str_replace(' ', '', $suggestion); ?>
                            </label>
                        </div>
                    <?php } ?>
                </fieldset>

                <button type="submit" id="button" class="btn btn-secondary">Update</button>
            </form>
            
        </fieldset>

    </div>
</div>
</div>
</fieldset>
<!-- <fieldset class="fieldset deactivate-section">
            <legend></legend>

            <div>
                <?php if(!$session_user->is_deleted) { ?>
                    <button class="btn btn-primary pull-right" id="deactivate-btn">Deactivate My Account</button>
                <?php } else { ?>
                    <p class="text-danger">Your account has been 'Deactivated'. Please login again with in 30 days to 'Reactivate' your account or contact our support team.</p>
                <?php } ?>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<?php header("Access-Control-Allow-Origin: https://www.callitme.com"); ?>
<script type="text/javascript">
  $('document').ready(function(){
    $('#button').click( function(){
      var selectedusername = $('.callusername').val();
      var email = "<?php echo $user->email;?>";
      //alert(selectedusername);
      $.ajax({
        method: 'GET',
        dataType:'jsonp',
        //url:'https://www.maangu.com/profile/callitme_username',
        url:'https://www.nepalivivah.com/profile/callitme_username',
        //url:'http://localhost/nv-web/profile/callitme_username',
        data:{selectedusername:selectedusername,email:email},
        success: function(data)
        {
            $('.callusername').val(data.username);
            alert(data);
        }
      });

      $.ajax({
        method: 'GET',
        dataType:'jsonp',
        url:'https://www.maangu.com/profile/callitme_username',
        //url:'https://www.nepalivivah.com/profile/callitme_username',
        //url:'http://localhost/nv-web/profile/callitme_username',
        data:{selectedusername:selectedusername,email:email},
        success: function(data)
        {
            $('.callusername').val(data.username);
            alert(data);
        }
      });
    });
  });
  </script>