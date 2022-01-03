<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Internal_email-29</title>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */

.header{background-color:rgb(0, 188, 212);font-size: 12px;width: 600px;margin: 0px auto;}

.sprty{font-size: 12px;width: 600px;margin: 0px auto;background: #fff;}

.park-tf{color: #fff;font-size: 13px;font-weight: 600;}

.img-rect{width: 145px; height:145px;border-radius: 50%;position: relative;top: 38px;left:-4px;}

.text-sharp{position: relative;font-size: 13px;color:#888;font-weight: 500;position: relative;top: -102px;left: 17px;}

.text-shadding{font-weight:500;font-size:16px;color: #888;}

.list-pad{list-style-type: none;padding: 13px 25px 10px 30px;}

.unline-list{display: inline-table;}

.frm{position: relative;top: -88px;left: 17px;}

.dasy-one{position: relative;top: -99px;left: 36px;}

.brd-pag-2{border-left:65px solid #eaeaea;border-right: 65px solid #eaeaea;border-bottom: 65px solid #eaeaea;}
@media only screen and (max-width: 768px) {

      .header{background-color:rgb(0, 188, 212);font-size: 12px;width: 350px;}
      .sprty{font-size: 12px;width: 350px;}
      .text-sharp{position: relative;font-size: 13px;color:#888;font-weight: 500;position: relative;top: 0px;left: 0px;}
      .img-rect{width: 55px; height:55px;border-radius: 50%;position: relative;top: 10px;left:-4px;}
      .col-xs-6{width: 350px;}
      .frm{position: relative;top: 0px;left: 0px;}
      .dasy-one{position: relative;top: 0px;left: 0px;}
      .brd-pag-2{border-top:0px solid #eaeaea;border-left:0px solid #eaeaea;border-right: 0px solid #eaeaea;border-bottom: 0px solid #eaeaea;}
}


</style>
 </head>
    <body>
       <table class="sprty brd-pag-2">
      <tr>
        <td>
          <table class="header" style="background-color:rgb(0, 188, 212);font-size: 12px;">
          <tr class="header">
          <td>        
        <a target="_blank" style="position: relative;top:0px;height: 37px;" href="<?php echo url::base();?>">
        <img src="<?php echo url::base();?>/img/logo1.png" alt="CALLITME.COM" style="height:37px;padding: 0px 0px 0px 25px;"/>
        </a>
     </td>
        
        <td style="text-align:right;padding-right:5px;vertical-align: middle;"> 
        <p class="park-tf">                                                        
        <?php
        $owner = $arequest->owner;
        $to = $arequest->request_to;
        $plan = $arequest->plan;
        ?>
                                                                
        <?php echo ucwords($to->user_detail->first_name.' '.$to->user_detail->last_name); ?>
        </p>                                                         
           </td>

        <td style="/*! text-align: right; */width: 49px;vertical-align: middle;">                                        
        <?php 
        $photo = $to->photo->profile_pic;
        $photo_image1 = file_exists("mobile/upload/".$photo);
        $photo_image2 = file_exists("upload/".$photo);
        if(!empty($photo)&& $photo_image1) { ?>
        <img alt="<?php echo ucwords($to->user_detail->first_name.' '.$to->user_detail->last_name); ?>" src="<?php echo url::base().'mobile/upload/'.$to->photo->profile_pic;?>" style="width: 35px;height: 35px;border-radius: 50%;padding: 0px 2px 0px 0px;">
        <?php } 
        else if(!empty($photo)&& $photo_image2) { ?>
        <img alt="<?php echo ucwords($to->user_detail->first_name.' '.$to->user_detail->last_name); ?>" src="<?php echo url::base().'upload/'.$to->photo->profile_pic;?>" style="width: 35px;height: 35px;border-radius: 50%;padding: 0px 2px 0px 0px;">
        <?php } else { ?>
        <span style="background-color:#bdbcbc;border-radius:50%;padding:8px;font-size:20px;margin:0px auto;text-align:center;">
        <?php echo ucwords($to->user_detail->first_name[0])."".ucwords($to->user_detail->last_name[0]);?>
           </span>                                                   
        <?php } ?>
         </td>
      </tr>
      </table>                                       
        <br/><br/>
        <table class="sprty">
            <tr>
              <td>
                <br/>
          <span style="color:#888; font-size:14px;position: relative;top: 9px;padding: 2px 25px 2px 30px;">
        <?php
        $owner = $arequest->owner;
        $to = $arequest->request_to;
        $plan = $arequest->plan;
        ?>
        <h4 style="padding: 0px 27px;">Surprised <?php echo $to->user_detail->first_name; ?> ?</h4>                                                     
            </span>
          </td>
        </tr>
      </table> 

      <table class="sprty">
            <tr>
              <td>                                            
          <p style="color:#888; font-size:15px;padding: 0px 25px 0px 30px;">  
        <a href="<?php echo url::base()."pages/redirect_to/".$to->username ."?page=".urlencode($owner->username); ?>" style="color: #01BF01;text-decoration:none;">
        <?php echo $owner->user_detail->first_name ." ".$owner->user_detail->last_name; ?></a> 
        was the one who sent you a <?php echo $plan; ?> request.  
                </p>
            </td>
          </tr>

          <tr>
              <td>
          <p style="color:#888; font-size:15px;padding: 0px 25px 0px 30px;"> 
          You accepted 
        <a href="<?php echo url::base()."pages/redirect_to/".$to->username ."?page=".urlencode($owner->username); ?>" style="color: #01BF01;text-decoration:none;">
        <?php echo $owner->user_detail->first_name ."'s request"; ?></a>.<br/> Indeed, both of you wanted the same.  
            </p>
          </td>
        </tr>

        <tr>
              <td>
          <p style="color:#888; font-size:16px;padding: 0px 25px 0px 30px;">
        <a href="<?php echo url::base()."pages/redirect_to/".$to->username ."?page=".urlencode($owner->username); ?>" style="color: #01BF01;text-decoration:none;">
        Why wait? <br/>log in</a> to your Callitme account and get in touch with <a href="<?php echo url::base()."pages/redirect_to/".$to->username ."?page=".urlencode($owner->username); ?>" style="color: #01BF01;text-decoration:none;">
        <?php echo $owner->user_detail->first_name; ?></a> right now!
            </p>
        </td>
      </tr>
        </table>   
<br/><br/>
      <table class="sprty">
            <tr>
              <td>
          <p style="color:#888; font-size:16px;padding: 25px 25px 35px 30px;">                                             
        Enjoy <?php echo $plan; ?>
        </p>
          </td>
        </tr>
      </table>                                         
             
<br/><br/>
        <table class="sprty">
            <tr>
                <td style="padding: 5px;"> 
                <span style="color: black"> 
                      Regards,<br /><br/>
                      Callitme Team<br />
                     <a style="color: black;text-decoration: none;" href="<?php echo url::base();?>">www.callitme.com</a>
                     </span>
                     <br/>
<a target="_blank" style="text-decoration:none;" href="https://www.callitme.com/blog/">
<img src="<?php echo url::base();?>/img/icon/blogger.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;margin: 0px 6px 0px 0px;padding: 0px 2px;" align="left" vspace="0" hspace="0" width="20" height="20" alt="bloog" /></a>
                                                             
     <a target="_blank" style="text-decoration:none;" href="https://www.facebook.com/callitme">
     <img src="<?php echo url::base();?>/img/icon/facebook.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;margin: 0px 6px 0px 0px;padding: 0px 2px;" align="left" vspace="0" hspace="0" width="20" height="20" alt="facebook" /></a>
                                                                 
     <a target="_blank" style="text-decoration:none;" href="https://plus.google.com/+Callitme">
     <img src="<?php echo url::base();?>/img/icon/google-plus.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;margin: 0px 6px 0px 0px;padding: 0px 2px;" align="left" vspace="0" hspace="0" width="20" height="20" alt="google plus" /></a>
                                                                
      <a target="_blank" style="text-decoration:none;" href="https://twitter.com/call_it_me">
      <img src="<?php echo url::base();?>/img/icon/twitter.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;margin: 0px 6px 0px 0px;padding: 0px 2px;" align="left" vspace="0" hspace="0" width="20" height="20" alt="twitter" /></a>
           <br/><br/> 
      <p style="word-break: break-all;text-align: center;">                                                     
       <small style="text-align: center;word-break: break-all;">You are receiving this message because you are a member of Callitme. You can manage your email subscription preferences <a href="<?php echo url::base();?>/account/email_notification_settings">here</a>
                </small>
                </p>
              </td>
            </tr>
          </table>
         </td>
      </tr>
  </table>              
    </body>
</html>