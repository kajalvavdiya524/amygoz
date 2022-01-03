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
                                <i class="ion-person" style="color: #00bcd4;font-size: 22px;"></i>Change Username
                            </h4>    
                        </div>  
                            <div class="collapse in" id="collapseOrderItems5">
                            <div class="panel-body">
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
                                </div>  
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