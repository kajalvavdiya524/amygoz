<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Internal_email-29</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <style type="text/css">
            * {
                -ms-text-size-adjust:100%;
                -webkit-text-size-adjust:none;
                -webkit-text-resize:100%;
                text-resize:100%;
            }
            a{
                outline:none;
                color:#40aceb;
                text-decoration:underline;
            }
            a:hover{text-decoration:none !important;}
            .nav a:hover{text-decoration:underline !important;}
            .title a:hover{text-decoration:underline !important;}
            .title-2 a:hover{text-decoration:underline !important;}
            .btn:hover{opacity:0.8;}
            .btn a:hover{text-decoration:none !important;}
            .btn{
                -webkit-transition:all 0.3s ease;
                -moz-transition:all 0.3s ease;
                -ms-transition:all 0.3s ease;
                transition:all 0.3s ease;
            }
            table td {border-collapse: collapse !important;}
            .ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{line-height:inherit;}
            @media only screen and (max-width:500px) {
                table[class="flexible"]{width:100% !important;}
                table[class="center"]{
                    float:none !important;
                    margin:0 auto !important;
                }
                *[class="hide"]{
                    display:none !important;
                    width:0 !important;
                    height:0 !important;
                    padding:0 !important;
                    font-size:0 !important;
                    line-height:0 !important;
                }
                td[class="img-flex"] img{
                    width:100% !important;
                    height:auto !important;
                }
                td[class="aligncenter"]{text-align:center !important;}
                th[class="flex"]{
                    display:block !important;
                    width:100% !important;
                }
                td[class="wrapper"]{padding:0 !important;}
                td[class="holder"]{padding:30px 15px 20px !important;}
                td[class="nav"]{
                    padding:20px 0 0 !important;
                    text-align:center !important;
                }
                td[class="h-auto"]{height:auto !important;}
                td[class="description"]{padding:30px 20px !important;}
                td[class="i-120"] img{
                    width:120px !important;
                    height:auto !important;
                }
                td[class="footer"]{padding:5px 20px 20px !important;}
                td[class="footer"] td[class="aligncenter"]{
                    line-height:25px !important;
                    padding:20px 0 0 !important;
                }
                tr[class="table-holder"]{
                    display:table !important;
                    width:100% !important;
                }
                th[class="thead"]{display:table-header-group !important; width:100% !important;}
                th[class="tfoot"]{display:table-footer-group !important; width:100% !important;}
            }
        </style>
    </head>
    <?php $from = Auth::instance()->get_user(); ?>
    <body style="margin:0; padding:0;" bgcolor="#eaeced">
        <table style="min-width:320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eaeced">
            <!-- fix for gmail -->
            <tr>
                <td class="hide">
                    <table width="600" cellpadding="0" cellspacing="0" style="width:600px !important;">
                        <tr>
                            <td style="min-width:600px; font-size:0; line-height:0;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="wrapper" style="padding:0 10px;">
                    <!-- module 1 -->
                    <table data-module="module-1" data-thumb="thumbnails/01.png" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td data-bgcolor="bg-module" bgcolor="#eaeced">
                                <table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="padding:5px 0;" bgcolor="#00BCD4">
                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <th class="flex" width="" align="left" style="padding:0;">
                                                        <table class="left" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="line-height:0;">
                                                                    <a target="_blank" style="text-decoration:none;" href="<?php echo url::base();?>"><img src="<?php echo url::base();?>/img/logo1.png" border="0" style="font:bold 12px/12px Arial, Helvetica, sans-serif; color:#606060;" align="left" vspace="0" hspace="0" width="113" alt="CALLITME.COM" /></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                     <th class="" style="flote:right" align="right">
                                                        <table class="" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="color:#fff; flote:right">
                                                                   <?php echo ucwords($newemail1->first_name.' '.$newemail1->last_name);?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                    <th style="flote:right;width:20px; margin-left:20px;" align="right">
                                                        <table class="" cellpadding="4" cellspacing="0">
                                                            <tr>
                                                                   <td style="padding-left:5px;flote:right;padding-left:5px;" width="10" valign="middle">
                                                                    <?php 
                                                                     $photo = $newemail->photo->profile_pic;
                                                                     $photo_image1 = file_exists("upload/".$photo);
                                                                       if(!empty($photo)&& $photo_image1) { ?>
                                                                       <img alt="" src="<?php echo url::base().'upload/'.$newemail->photo->profile_pic;?>" style="border-radius:50%;outline:none;color:#ffffff;text-decoration:none;display:block" class="CToWUd" width="40" border="0" height="40">
                                                                      <?php }  else { ?>
                                                                        <td style="padding-left:10px;background-color: #fff;width:30px;height:30px;border-radius:50%">
                                                                            <font style="font-size:150%;"><?php echo ucwords($newemail1->first_name[0])."".ucwords($newemail1->last_name[0]);?></font>
                                                                      </td>        
                                                                    <?php } ?>
                                                                </td><td width="1">&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </th>        
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table> 
                    <!-- module 2 -->
                    <table data-module="module-2" data-thumb="thumbnails/02.png" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td data-bgcolor="bg-module" bgcolor="#eaeced">
                                <table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td data-bgcolor="bg-block" class="holder" style="padding:8px 60px 52px;" bgcolor="#f9f9f9">
                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/5px Arial, Helvetica, sans-serif; color:#888; padding:0 0 15px;">
                                                        <p>Hi <?php echo $newemail1->first_name;?>,<p>
                                                        <p style="margin:0;word-wrap:break-word;color:none;word-break:break-word;font-weight:400;font-size:14px;line-height:1.429;font:13px/25px Arial"><?php echo ucwords($sess_us->user_detail->first_name." ".$sess_us->user_detail->last_name);?> wants to see your profile picture.</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>           
                                                        <table border="0" cellspacing="0" cellpadding="0" width="100%"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td valign="top" style="padding:0 25px 0 0"> 
                                                                        <a href="<?php echo url::base() . "pages/redirect_to/" ."?page=" . urlencode($sess_us->username); ?>">  
                                                                              <?php 
                                                                                 $photo = $sess_us->photo->profile_pic;
                                                                                 $photo_image = file_exists("mobile/upload/".$photo);
                                                                                 $photo_image1 = file_exists("upload/".$photo);
                                                                                   if(!empty($photo)&& $photo_image) { ?>
                                                                                   <img alt="" border="0" height="70" width="70" style="border-radius:50%;outline:none;color:#ffffff;text-decoration:none" class="CToWUd" src="<?php echo url::base().'mobile/upload/'.$sess_us->photo->profile_pic;?>">
                                                                                  <?php } 
                                                                                 else if(!empty($photo)&& $photo_image1) { ?>
                                                                                  <img alt="" border="0" height="70" width="70" style="border-radius:50%;outline:none;color:#ffffff;text-decoration:none" class="CToWUd" src="<?php echo url::base().'upload/'.$sess_us->photo->profile_pic;?>">
                                                                                  <?php } else { ?>
                                                                                   <p style="padding-left:10px;padding-top:5px;background-color:#F2F3F4;width:60px;height:60px;border-radius:50%;color:black;text-decoration:none;margin-top: 0px;">
                                                                                    <font style="font-size:42px;"><?php echo $sess_us->user_detail->first_name[0]."".$sess_us->user_detail->last_name[0];?></font></p> 
                                                                                <?php } ?>
                                                                        </a>    
                                                                    </td>
                                                                    <td valign="top" width="100%">
                                                                        <span style="word-wrap:break-word;margin:0 0 8px 0;color:;word-break:break-word;font-weight:700;font-size:16px;line-height:1.5;"><a style="font:16px/25px Arial, Helvetica, sans-serif;color:#888;text-decoration: none;" href="<?php echo url::base() . "pages/redirect_to/" ."?page=" . urlencode($sess_us->username); ?>"><?php echo $sess_us->user_detail->first_name." ".$sess_us->user_detail->last_name; ?></a> </span>
                                                                        <p style="margin:0;word-wrap:break-word;color:none;word-break:break-word;font-weight:400;font-size:14px;line-height:1.429;font:12px/15px Arial, Helvetica, sans-serif;color:#888;">
                                                                                <?php echo ucwords($sess_us->user_detail->location); ?>
                                                                        </p>
                                                                        <p style="margin:0;word-wrap:break-word;color:none;word-break:break-word;font-weight:400;font-size:14px;line-height:1.429;font:12px/20px Arial, Helvetica, sans-serif;color:#888;">    
                                                                            <?php $recommendations = $sess_us->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                                                                                    $temp_words = array();
                                                                                    foreach($recommendations as $recommend) 
                                                                                    {
                                                                                        $words = explode(', ', $recommend->words);
                                                                                        $temp_words = array_merge($temp_words, $words);
                                                                                    }
                                                                                    $tags = array_count_values($temp_words);
                                                                                ?>
                                                                              Social % <?php echo $sess_us->calculate_social_percentage($tags);?>
                                                                        </p>
                                                                        <p data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">Your profile looks interesting and I want to see your photo. Please upload your picture on Callitme.</p>  
                                                                    </td>  
                                                                </tr> 
                                                            </tbody> 
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:0 0 20px;">
                                                        <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#7bb84f">
                                                                    <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="<?php echo url::base()."pages/redirect_to/".$newemail->username."?page=".urlencode($newemail->username."/edit_profile"); ?>">Upload Here</a>
                                                                </td>
                                                            </tr>                                                            
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="left" style="font:16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                        <small>Callitme is a crowd powered people review network to review your friends & family. If you know two single friends who would make a great pair, you can match them. You can also browse singles in your neighborhood. Who knows, your next door neighbor might be single and looking!If you have crush on someone, Callitme also lets you invite them anonymously on a date. No worries, your crush won't find out who you are unless your crush picks you!</small>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr><td height="28"></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- module 3 -->
                    <!-- module 7 -->
                    <table data-module="module-7" data-thumb="thumbnails/07.png" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td data-bgcolor="bg-module" bgcolor="#eaeced">
                                <table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="footer" style="padding:0 0 10px;">
                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                <tr class="table-holder">
                                                    <th class="tfoot" width="100%" align="left" style="vertical-align:top; padding:0;">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td data-color="text" data-link-color="link text color" data-link-style="text-decoration:underline; color:#797c82;" class="aligncenter" style="font:12px/16px Arial, Helvetica, sans-serif; color:#797c82; padding:0 0 10px;">
                                                                    Regards,<br />
                                                                    Callitme Team<br />
                                                                    <a href="<?php echo url::base();?>">www.callitme.com</a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                </tr>
                                                <tr class="table-holder">
                                                    <th class="thead" width="100%" align="left" style="vertical-align:top; padding:0;">
                                                        <table class="center" align="left" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                                                                    <a target="_blank" style="text-decoration:none;" href="https://www.callitme.com/blog/"><img src="<?php echo url::base();?>/img/icon/blogger.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="20" height="20" alt="bloog" /></a>
                                                                </td>
                                                                <td width="20"></td>
                                                                <td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                                                                    <a target="_blank" style="text-decoration:none;" href="https://www.facebook.com/callitme"><img src="<?php echo url::base();?>/img/icon/facebook.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="20" height="20" alt="facebook" /></a>
                                                                </td>
                                                                <td width="19"></td>
                                                                <td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                                                                    <a target="_blank" style="text-decoration:none;" href="https://plus.google.com/+Callitme"><img src="<?php echo url::base();?>/img/icon/google-plus.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="20" height="20" alt="google plus" /></a>
                                                                </td>
                                                                <td width="20"></td>
                                                                <td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                                                                    <a target="_blank" style="text-decoration:none;" href="https://twitter.com/call_it_me"><img src="<?php echo url::base();?>/img/icon/twitter.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="20" height="20" alt="twitter" /></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                </tr>
                                                <tr class="table-holder">
                                                    <th class="aligncenter" style="font:12px/16px Arial, Helvetica, sans-serif; color:#797c82; padding:10px 0;" data-link-style="text-decoration:underline; color:#797c82;" data-link-color="link text color" data-color="text">
                                                        <small>You are receiving this message because you are a member of Callitme. You can manage your email subscription preferences <a href="<?php echo url::base();?>/account/email_notification_settings">here</a></small>
                                                    </th>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="line-height:0;"><div style="display:none; white-space:nowrap; font:15px/1px courier;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div></td>
            </tr>
        </table>
    </body>
</html>