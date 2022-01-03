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
                            <li  ><a href="<?php echo url::base();?>account/change_password">Change Password</a></li>
                            <li><a href="<?php echo url::base().'account/subscription_details'?>">Subscription</a></li>
                            <li><a href="<?php echo url::base();?>account/email_notification_settings">Email Notification</a></li>
                             <li  ><a href="<?php echo url::base();?>account/change_username">Change Username</a></li>
                             <li  class="active" ><a href="<?php echo url::base().'account/privacy_settings';?>">Privacy Setting</a></li>
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
            
            <form class="validate-form" method="post" role="form">

               <!-- <div class="checkbox">
                    <label class="style-chkbox-lbl">
                        <input type="checkbox" class="style-chkbox" name="profile_private" <?php if($user->profile_private) { ?> checked="checked"<?php } ?> >
                        Don't Show my profile publically.
                    </label>
                </div>

                 these are hide becouse these are not under privacy policy 
                <div class="checkbox">
                    <label class="style-chkbox-lbl">
                        <input type="checkbox" class="style-chkbox" name="sex_private" <?php if($user->user_detail->sex_private) { ?> checked="checked"<?php } ?> >
                        Mark 'Gender' as private.
                    </label>
                </div>

                <div class="checkbox">
                    <label class="style-chkbox-lbl">
                        <input type="checkbox" class="style-chkbox" name="phase_of_life_private" <?php if($user->user_detail->phase_of_life_private) { ?> checked="checked"<?php } ?>/> 
                        Mark 'Phase of Life' as private
                    </label>
                </div>

                <div class="checkbox">
                    <label class="style-chkbox-lbl">
                        <input type="checkbox" class="style-chkbox" name="location_private" <?php if($user->user_detail->location_private) { ?> checked="checked"<?php } ?>/> 
                        Mark 'Current City' as private
                    </label>
                </div>

                <div class="checkbox">
                    <label class="style-chkbox-lbl">
                        <input type="checkbox" class="style-chkbox" name="home_town_private" <?php if($user->user_detail->home_town_private) { ?> checked="checked"<?php } ?>/> 
                        Mark 'Home Town' as private
                    </label>
                </div>

                <div class="checkbox">
                    <label class="style-chkbox-lbl">
                        <input type="checkbox" class="style-chkbox" name="about_private" <?php if($user->user_detail->about_private) { ?> checked="checked"<?php } ?>/> 
                        Mark 'About' as private
                    </label>
                </div>
                    
                <div class="checkbox">
                    <label class="style-chkbox-lbl">
                        <input type="checkbox" class="style-chkbox" name="education_private" <?php if($user->user_detail->education_private) { ?> checked="checked"<?php } ?>/> 
                        Mark 'Education' as private
                    </label>
                </div>

                <div class="checkbox">
                    <label class="style-chkbox-lbl">
                        <input type="checkbox" class="style-chkbox" name="employment_private" <?php if($user->user_detail->employment_private) { ?> checked="checked"<?php } ?>/> 
                        Mark 'Employment' as private
                    </label>
                </div>

                <div class="checkbox">
                    <label class="style-chkbox-lbl">
                        <input type="checkbox" class="style-chkbox" name="designation_private" <?php if($user->user_detail->designation_private) { ?> checked="checked"<?php } ?>/> 
                        Mark 'Designation' as private
                    </label>
                </div>

                <div class="checkbox">
                    <label class="style-chkbox-lbl">
                        <input type="checkbox" class="style-chkbox" name="website_private" <?php if($user->user_detail->website_private) { ?> checked="checked"<?php } ?>/> 
                        Mark 'Website' as private
                    </label>
                </div>-->

  


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
            <div class="marTop10"></div>
            <!-- <small> Note : setting is public when button is transparent !</small> -->
        </fieldset>

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
    width: 500px;
    margin-top: 50px;
    position: relative;
    top: -42px;
    left: 88px;
    color: #9E9E9E;
    font-family: arial;
}
</style>