<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Activate Your Account Email</title>
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

.sprty{font-size: 12px;width: 600px;margin: 0px auto;background:#fff;}

.park-tf{color: #fff;font-size: 13px;font-weight: 600;}

.img-rect{width: 145px; height:145px;border-radius: 50%;position: relative;top: 38px;left:-4px;}

.text-sharp{position: relative;font-size: 13px;color:#888;font-weight: 500;position: relative;top: -102px;left: 17px;}

.text-shadding{font-weight:500;font-size:16px;color: #888;}

.list-pad{list-style-type: none;padding: 13px 25px 10px 30px;}

.unline-list{display: inline-block;}

.frm{position: relative;top: -88px;left: 17px;}

.dasy-one{position: relative;top: -99px;left: 36px;}

.brd-pag-2{border-left:65px solid #eaeaea;border-right: 65px solid #eaeaea;border-bottom: 65px solid #eaeaea;}
@media only screen and (max-width: 768px) {

      /*.header{background-color:rgb(0, 188, 212);font-size: 12px;width: 350px;}*/
      /*.sprty{font-size: 12px;width: 350px;}*/
      .text-sharp{position: relative;font-size: 13px;color:#888;font-weight: 500;position: relative;top: 0px;left: 0px;}
      .img-rect{width: 55px; height:55px;border-radius: 50%;position: relative;top: 10px;left:-4px;}
      /*.col-xs-6{width: 350px;}*/
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
        <a style="position: relative;top:0px;height: 37px;" target="_blank" href="<?php echo url::base();?>">
        <img src="<?php echo url::base();?>/img/amygoz.png" alt="Amygoz Logo" style="position: relative;top:0px;height: 37px;padding: 0px 0px 0px 25px;"/>
        </a>
      </td>

      <td style="text-align:right;padding-right:5px;vertical-align: middle;"> 
          <p class="park-tf">                                                       
        <?php echo ucwords($user->user_detail->first_name.' '.$user->user_detail->last_name);?>
         </p>  
           </td>

    <td style="/*! text-align: right; */width: 49px;vertical-align: middle;">                                                      
        <?php 
        $photo = $user->photo->profile_pic;
        $photo_image1 = file_exists("mobile/upload/".$photo);
        $photo_image2 = file_exists("upload/".$photo);
        if(!empty($photo)&& $photo_image1) { ?>
        <img alt="" src="<?php echo url::base().'mobile/upload/'.$user->photo->profile_pic;?>" style="width: 35px;height: 35px;border-radius: 50%;position:relative;top:-6px;padding: 0px 2px 0px 0px;">
        <?php } 
        else if(!empty($photo)&& $photo_image2) { ?>
        <img alt="" src="<?php echo url::base().'upload/'.$user->photo->profile_pic;?>" style="width: 35px;height: 35px;border-radius: 50%;position:relative;top:-6px;padding: 0px 2px 0px 0px;">
        <?php } else { ?>
        <span style="background-color:#bdbcbc;border-radius:50%;padding:8px;font-size:20px;margin:0px auto;text-align:center;position: relative;bottom: 13px;">
        <?php echo ucwords($user->user_detail->first_name[0])."".ucwords($user->user_detail->last_name[0]);?>
        </span> 
        <?php } ?>
            </td>
          </tr>
      </table>

      <table class="sprty">
        <tr>
            <td>                                               
          <p style="color:#888; font-size:17px;padding: 25px 25px 0px 30px;">                                                        
        Hi <?php echo $user->user_detail->first_name; ?>,
                </p>
            </td>
        </tr>
        <tr>
          <td>
          <p style="color:#888; font-size:15px;padding:15px 25px 0px 30px;">
       Please click on the link below to activate your account.
       </p>
      </td>
    </tr>
       
      <tr>
          <td>
          <p style="color:#888; font-size:15px;padding: 25px 25px 35px 30px;">                                             
        <a href="<?php echo $link;?>" style="color: #00bcd4;text-decoration:none;"><?php echo $link;?></a> 
                                                    
        If the link above doesn't work, please copy and paste the link into the address bar of your browser.
        </p>
      </td>
    </tr>
  </table>                                            
  <br/><br/>
  <table class="sprty">
            <tr>
                <td style="padding: 5px;"> 
                <span style="color: black"> 
                      Regards,<br /><br />
                      Amygoz<br />
                     </span>
                     <br/>                                                   
        <p style="text-align: center;">                                                                                     
        <small style="text-align: center;">You are receiving this message because you are a member of Callitme. You can manage your email subscription preferences <a href="<?php echo url::base();?>/account/email_notification_settings">here</a>
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