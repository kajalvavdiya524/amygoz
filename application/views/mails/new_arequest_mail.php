<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>friend request mail</title>
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
 <?php $from = Auth::instance()->get_user(); ?>
    <body>
    <table class="sprty brd-pag-2">
      <tr>
        <td>
        <table class="header" style="background-color:rgb(0, 188, 212);font-size: 12px;">
            <tr class="header" style="border: 1px solid #efefef;">
                <td>
                    <a target="_blank" style="position: relative;top:0px;height: 37px;" href="https://m.callitme.com/">
                       <img src="https://m.callitme.com/img/logo1.png" style="position: relative;top:0px;height: 37px;padding: 0px 0px 0px 25px;" alt="CALLITME.COM" />
                    </a>
                </td>
                <td style="text-align:right;padding-right:5px;vertical-align: middle;">
                    <p class="park-tf"> 
                    <?php echo ucwords($user_to->user_detail->first_name)." ".ucwords($user_to->user_detail->last_name);?>
                   </p>
                   </td>
                <td style="/*! text-align: right; */width: 49px;vertical-align: middle;">
                    <?php 
                       $photo = $user_to->photo->profile_pic;
                       $photo_image1 = file_exists("upload/".$photo);
                       if(!empty($photo)&& $photo_image1) { ?>
                       <img alt="<?php echo $user_to->user_detail->first_name[0].''.$user_to->user_detail->last_name[0];?>" src="<?php echo url::base().'upload/'.$user_to->photo->profile_pic;?>" style="width: 35px;height: 35px;border-radius: 50%;padding: 0px 2px 0px 0px;">
                      <?php }  else { ?>
                        <span style="background-color:#bdbcbc;border-radius:50%;padding:8px;float:left;font-size:20px;font-weight:600;"> 
                            <?php echo ucwords($user_to->user_detail->first_name[0])."".ucwords($user_to->user_detail->last_name[0]);?>
                        </span>        
                    <?php } ?>
                </td>
            </tr>    
        </table>
        <table class="sprty">
            <tr>
                <td>
                    <p style="color:#888; font-size:17px;padding: 15px 25px 12px 30px;"> Hi <?php echo $newemail1->first_name;?>,<br /><br />
                        <span style="color:#888;font-size:15px;padding: 2px 0px 0px 0px;">
                           One of the following Callitme members want to go for<?php echo $arequest->plan;?>  with you. 
                           Please "Accept" the person who you want to go for  with. If you accept the correct member,both of you will be notified.
                        </span>
                    </p>
                </td>
            </tr>
        </table>
        <table class="sprty" style="text-align: center;">
            <tr style="text-align: center;">
                <td class="row" style="text-align: center;">
                    <?php $index = 2; foreach($arequest->members->find_all()->as_array() as $member) { ?>
                    <ul class="list-pad col-xs-6" style="list-style-type: none;" style="text-align: center;">
                        <li class="unline-list" style="list-style-type: none;" style="text-align: center;">
                        <table>
                          <tr style="text-align: center;">
                            <td>
                            <a href="<?php echo url::base().$member->user->username; ?>">  
                                <?php 
                                    $photo = $member->user->photo->profile_pic;
                                    $photo_image = file_exists("mobile/upload/".$photo);
                                    $photo_image1 = file_exists("upload/".$photo);
                                    if(!empty($photo)&& $photo_image) { ?>
                                       <img alt="" class="img-rect posh-ytr" src="<?php echo url::base().'mobile/upload/'. $member->user->photo->profile_pic;?>" style="width: 50px; height:50px;border-radius: 50%;margin: 0px auto;">
                                    <?php } 
                                    else if(!empty($photo)&& $photo_image1) { ?>
                                      <img alt="" class="img-rect posh-ytr" src="<?php echo url::base().'upload/'.$member->user->photo->profile_pic;?>" style="width: 50px; height:50px;border-radius: 50%;margin: 0px auto;">
                                    <?php } else { ?>
                                     <span style="padding-left:10px;background-color:#bdbcbc;border-radius:50%;padding:14px;font-size:19px;margin:0px auto;text-align:center;"> 
                                   <?php echo $member->user->user_detail->first_name[0]."".$member->user->user_detail->last_name[0];?>
                                <?php } ?>
                                 </span>
                            </a>
                       </td>
                      </tr>

                        <tr style="text-align: center;">
                            <td>
                            <p class="text-sharp posh-ytr" style="text-align: center;">
                                <span class="text-shadding"><?php echo $member->user->user_detail->first_name ." ".$member->user->user_detail->last_name;?></span> 
                                <br/>
                                <?php $recommendations = $member->user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                                    $temp_words = array();
                                    foreach($recommendations as $recommend) 
                                    {
                                        $words = explode(', ', $recommend->words);
                                        $temp_words = array_merge($temp_words, $words);
                                    }
                                    $tags = array_count_values($temp_words);
                                ?>
                              Social % <?php echo $member->user->calculate_social_percentage($tags);?>
                            </p>
                          </td>
                      </tr>

                         <tr style="text-align: center;">
                            <td>
                            <form action="<?php echo url::base() . "pages/redirect_to/" ."?page=" . urlencode('activity/view/'.$arequest->id); ?>" method="post" style="text-align: center;">
                              <input type="hidden" name="arequest_action" value="<?php echo $member->user->id; ?>" />
                              <button type="btn primarry" style="background: #00bcd4;border:none;color: #fff;padding: 9px 30px;">Accept</button>
                            </form>
                                </td>
                            </tr>
                            </table>
                       </li>
                       <br/><br/><br/>
                    <?php if($index == 2) { ?>
                </ul>
                  <ul class="list-pad col-xs-6 text-center" style="list-style-type: none;">
                    <?php } ?>
                </ul>
                    <?php $index++; } ?>
                </td>
            </tr>
        </table>
        <table class="sprty">
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table class="sprty">
            <tr>
                <td style="padding: 5px;"> 
                    <span style="color: black">          
                        Regards,<br />
                        Callitme Team<br />
                        <a style="color: black;text-decoration: none;" href="<?php echo url::base();?>">www.callitme.com</a>
                    </span>
                    <br/>
                    <a target="_blank" style="text-decoration:none;" href="https://www.callitme.com/blog/">
                    <img src="<?php echo url::base();?>/img/icon/blogger.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;margin: 0px 6px 0px 0px;" align="left" vspace="0" hspace="0" width="20" height="20" alt="bloog" />
                    </a>

                        <a target="_blank" style="text-decoration:none;" href="https://www.facebook.com/callitme">
                        <img src="<?php echo url::base();?>/img/icon/facebook.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;margin: 0px 6px 0px 0px;" align="left" vspace="0" hspace="0" width="20" height="20" alt="facebook" />
                        </a> 

                        <a target="_blank" style="text-decoration:none;" href="https://plus.google.com/+Callitme">
                        <img src="<?php echo url::base();?>/img/icon/google-plus.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;margin: 0px 6px 0px 0px;" align="left" vspace="0" hspace="0" width="20" height="20" alt="google plus" />
                        </a> 

                        <a target="_blank" style="text-decoration:none;" href="https://twitter.com/call_it_me">
                        <img src="<?php echo url::base();?>/img/icon/twitter.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;margin: 0px 6px 0px 0px;" align="left" vspace="0" hspace="0" width="20" height="20" alt="twitter" />
                        </a>

                            <br/><br/> 
                        <p style="text-align: center;">                                                     
                           <small style="text-align: center;">You are receiving this message because you are a member of Callitme. You can manage your email subscription preferences 
                           <a href="">here</a>
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