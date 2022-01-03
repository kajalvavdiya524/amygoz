<script src='<?php echo url::base();?>js/jquery.knob.js'></script>
<script type="text/javascript">
   $(document).ready(function(){
       $('.dial').each(function () { 
   
           var elm = $(this);
           var color = elm.attr("data-fgColor");  
           var perc = elm.attr("value");  
   
           elm.knob({ 
                'value': 0, 
                 'min':0,
                 'max':100,
                 "skin":"tron",
                 "readOnly":true,
                 "thickness":.1,                 
                 "dynamicDraw": true,                
                 "displayInput":false
           });
   
           $({value: 0}).animate({ value: perc }, {
               duration: 1000,
               easing: 'swing',
               progress: function () {                  
                   elm.val(Math.ceil(this.value)).trigger('change')
               }
           });
   
           //circular progress bar color
           $(this).append(function() {
               elm.parent().parent().find('.circular-bar-content').css('color',color);
               elm.parent().parent().find('.circular-bar-content label').text(perc+'%');
           });
   
       });
   
   });
</script>
<?php $session_user = Auth::instance()->get_user(); ?>
<style type="text/css">
   @font-face {
   font-family: GreycliffCF-Bold;
   src: url(application/views/fonts/GreycliffCF-Bold.otf);
   }
   @font-face {
   font-family: GreycliffCF-Regular;
   src: url(application/views/fonts/GreycliffCF-Regular.otf);
   }
   @font-face {
   font-family: GreycliffCF-Light;
   src: url(application/views/fonts/GreycliffCF-Light.otf);
   } /*startnew*/
   .d-flex{display: flex;}
   .flex-between{justify-content: space-between;}
   .align-center{align-items: center;}
   .top-header{background-color: rgb(255,255,255,82%);border-bottom: 1px solid #979797;padding-bottom: 10px}
   .profile-section{background-color: #fff;border:1px solid #F1F3F8;}
   .profile-section img{border-radius: 50%;}
   .profile-section .post-items h6{font-size: 20px;}
   .profile-section .post-items h6 span{font-size: 20px;}
   .profile-section .user-description .user-name{font-size: 24px}
   .profile-section .user-description #description-more{display: none;}
   .profile-section .user-description #description-more:target{display: block;}
   .new-member{border:1px solid #F1F3F8;border-radius: 10px;padding: 14px;margin-top: 20px;}
   .new-member h2{font-size: 20px;margin: 0px;color: #000;}
   .btnDesktop{padding-top: 8px;}
   .new-member p{font-size: 14px;margin: 0px;color: #000;padding: 7px 0px 10px 0px}
   .btnDesktop .btn-get-inspired{background-color: #FF5A5F;padding: 9px 80px;color:#fff;border-radius: 20px;font-size: 15px;cursor: pointer;}
   .new-member .btn{background-color: #FF5A5F;width: 100%; height: 36px;color:#fff;border-radius: 20px;font-size: 15px}
   .new-member .btn:focus{outline: none;}
   .profile-section .user-description button:focus{outline: none;}
   .profile-section .user-description .btn-chat,.profile-section .user-description .btn-add{background: transparent; border:2px solid #F1F2F4; border-radius: 50%;width: 38px;height: 38px;line-height: 2.9; padding:0;margin-top: -8px;}
   .profile-section .location,.profile-section .study,.profile-section .friends{font-size: 16px}
   .profile-section .profile-link{font-size: 15px;color: #00BCD4}
   .profile-tabs{border-bottom: 1px solid #F1F2F4;margin-bottom: 0px;padding-bottom: 10px;background-color: #fff;display: flex;justify-content: space-around;list-style-type: none;padding: 0}
   .profile-tabs li{width:100%;text-align: center;}
   .profile-tabs li a{color: #8991A0;font-size: 14px;display: block;padding: 10px 0;border-bottom: 2px solid transparent}
   .profile-tabs li a.active{color: #FF5A5F;border-bottom: 2px solid #FF5A5F}
   .img-gradient{background-image: linear-gradient(#FF585D, #FB947F);height: 104px;width: 100%;border-radius: 4px;margin-left: auto;margin-right: auto;}
   .post-inner .item-text{font-size: 14px;display: inline-block;color: #fff;padding: 20px 10px}
   .post-inner:after{clear: both;content: '';display: block;width: 100%}
   .post-inner img{border-radius: 4px;margin-left: auto;margin-right: auto;}
   .post-img{border-radius: 2px;margin-left: auto;margin-right: auto;height: 104px;object-fit: cover;object-position: top;}
   .btn-edit-profile{background-color: #F1F2F4;width: 100%; height: 36px;color:#010101;border-radius: 20px;font-size: 15px;border:1px solid #DCE1EA;}
   .bg-img-inspiration{background-image: url('../images/Group 336.png');height: 104px;width: 108px;border-radius: 4px;margin-left: auto;margin-right: auto;}
   .bg-img-inspiration .item-text{ bottom: -7px;position: absolute;width: 80%;font-size: 12px;display: inline-block;color: #fff;}
   .btn-sign-up{background-color: #FF5A5F;width: 100%; height: 36px;color:#fff;border-radius: 20px;font-size: 15px}
   .btn-sign-in{background-color: #F1F2F4;width: 100%; height: 36px;color:#010101;border-radius: 20px;font-size: 15px;}
   .bg-img-inspiration{height: 120px;position: relative;background-size: cover;width: 100%;border-radius: 2px!important;}
   .bg-img-inspiration:after{content: "";position: absolute;background-color: rgba(0,0,0, 0.2);width: 100%;height: 100%;border-radius: 4px!important;}
   .bg-img-inspiration .item-text{ bottom: -11px!important;z-index:100;left:-2px!important;position: absolute;width: 100%;font-size: 12px;display: inline-block;color: #fff;}
   #inspiration,#post,#reviews,#about{display: none;margin-right: -15px;margin-left: -15px;}
   .active{display: block!important;background-color: #ffffff;}
   .event-list > li > name{
   width: 46px!important;
   }
   .event-list > li > .info{
   padding-top: 12px!important;
   padding-bottom: 5px!important;
   }
   .event-list > li > .info h5,.event-list > li > .info p{
   margin: 0px!important;
   }
   .event-list > li > .info h5 a{
   font-size: 14px!important;
   }
   .event-list > li > .info > .title, .event-list > li > .info > .desc{
   padding-left: 0px!important;
   }
   .zIndex{
   position: relative;
   z-index: 100;
   background: #fff;
   }
   .event-list > li{
   border-left: none!important;
   border-right: none!important;
   border-top: none!important;
   border-bottom: 1px solid #e5e5e5!important;
   padding-bottom: 10px!important;
   margin: 0!important;
   padding-top: 4px!important;
   }
   /*about sectiion*/
   #about .about-h{
   color: #FF5A5F;
   font-size: 12px;
   }
   #about .abt-value{
   font-size: 14px;
   color: #010101;
   }
   #about .divider-about{
   padding: 5px;
   background-color: #F1F2F4;
   }
   #about .abt-value.url{
   color: #FF5A5F;
   text-transform: lowercase;
   }
   #about .friends-h{
   font-size: 16px;
   color: #010101;
   padding: 10px 0px;
   }
   #about .friends-h span,#about .friends-h a{
   float: right;    
   }
   #about .friends-h a{
   margin-top: -2px;
   margin-left: 6px;
   }
   #about .inner-h{
   font-size: 12px;
   color: #8991A0;
   }
   /*endnew*/
   .trending-pro-main{
   border: 1px solid #F1F3F8;
   border-radius: 10px;
   margin-top: 20px;
   }
   .trending-pro-main img{
   margin-right: 10px;
   }
   .trending-pro-main .border-bottom{
   padding: 10px 10px;
   border-bottom: 1px solid #F1F3F8;
   }
   .trending-header{
   border-bottom: 1px solid #F1F3F8;
   }
   .trending-header p{
   padding: 15px 10px;
   font-size: 16px;
   font-weight: bold;
   margin: 0px;
   }
   .trending-header p a{
   float: right;
   font-size: 14px;
   font-weight: 400;
   color: #8991A0;
   }
   .btn-add-p{margin-left: auto;}
   .btn-add-p .btn-add{background-color: #FF5A5F;height: 36px;color:#fff;border-radius: 20px;font-size: 15px}
   .btn-add-p .btn-add:focus{outline: none}
   .px-20{
   padding: 20px 20px;
   }
   #badge_Sweet,#badge_Joyful,#badge_Friendly,#badge_Optimist,#badge_Generous,#badge_Egotistical,#badge_Funny,#badge_Sympathetic,#badge_Bossy{
   border-radius: 30px;
   margin-right: 3px;
   padding: 3px 16px;
   background-image: linear-gradient(to bottom, #FD5B5F, #FB907D)!important;
   font-size: 14px!important;
   /*font-family:GreycliffCF-Regular;*/
   color: #fff!important;
   }
   #badge_Social,#badge_Respectful,#badge_Sensitive,#badge_Smart,#badge_Mean,#badge_Courteous,#badge_Courageous,#badge_Considerate{
   border-radius: 30px;
   margin-right: 3px;
   padding: 3px 16px;
   background-color:#00BCD4!important;
   font-size: 14px!important;
   /*font-family:GreycliffCF-Regular;*/
   color: #fff!important;
   }
   #badge_Honest,#badge_Thoughtful,#badge_Charismatic,#badge_Materialistic,#badge_Ambitious,#badge_Affectionate,#badge_Dependable,#badge_Lazy{
   border-radius: 30px;
   margin-right: 3px;
   padding: 3px 16px;
   background-image: linear-gradient(to bottom, #FD935B, #FBC27D)!important;
   font-family:GreycliffCF-Regular;
   font-size: 14px!important;
   color: #fff!important;
   }
   .border-social{
   border-left:1px solid #F1F3F8!important;
   border-right:1px solid #F1F3F8!important;
   border-bottom:1px solid #F1F3F8!important;
   border-radius: 0px 0px 10px 10px;
   margin-bottom: 30px;
   }
   .bg-white{
   background: #fff;
   }
   .title-inspiration{
   margin-top: 20px;
   }
   #inset.profile-view{
   min-height: auto!important;
   width: 130px!important;
   height: 130px!important;
   border-radius: 50%;
   }
   #inset.profile-view h1{
   font-size: 54px!important;
   line-height: 94px!important;
   }
   .px-0{
   padding: 0px!important;
   }
   .event-list li{
   padding-right: 15px!important;
   padding-left: 15px!important;
   }
   .job-comment{
   font-size: 12px;
   font-weight: 400;
   }
   .post-item-top {
      margin-bottom: 0px;
   }
   .friend-request{
      position: initial;
      top: 54px;
      background: #fff;
      width: 200px;
      right: 0px;
      z-index: 100;
      text-align: center;
   }
</style>
<div class="bg-white">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 px-0">
            <div class="profile-section px-20">
               <div class="d-flex flex-between align-center">
                  <?php
                     $photo = $user->photo->profile_pic;
                     $photo_image = file_exists("mobile/upload/" .$photo);
                     $photo_image1 = file_exists("upload/" .$photo);
                     if(!empty($photo) && $photo_image) { ?>
                  <a id="single_2" width='100%' href="s<?php echo url::base() . 'mobile/upload/' . $user->photo->profile_pic; ?>"> <img class="img-responsive" width="130" height="130" alt="<?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>" src="<?php echo url::base().'mobile/upload/'.$user->photo->profile_pic;?>"></a>
                  <?php }
                     else if(!empty($photo) && $photo_image1) { ?>
                  <a id="single_2" width='100%' href="<?php echo url::base() . 'upload/' . $user->photo->profile_pic; ?>">
                  <img class="img-responsive" width="130" height="130" alt="<?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>" src="<?php echo url::base().'upload/'.$user->photo->profile_pic;?>">
                  </a>
                  <?php } else { ?>
                  <div id="inset" class="profile-view" style="width:100%; height:100%;">
                     <h1 style="font-size: 95px;line-height: 160px;">
                        <?php echo $user->user_detail->get_no_image_name(); ?>
                     </h1>
                     <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                  </div>
                  <?php } ?>
                  <div class="post-items">
                     <h6 class="post-item-top"><?php echo count($posts); ?> </h6>
                     <span class="post-item-bottom">Post</span>
                  </div>
                  <div class="post-items">
                     <h6 class="post-item-top"><?php echo count($inspires); ?> </h6>
                     <span class="post-item-bottom">Inspired</span>
                  </div>
                  <div class="post-items">
                     <h6 class="post-item-top"><?php echo $user->inspires->where('status', '=', 1)->count_all() ?></h6>
                     <span class="post-item-bottom">Inspires</span>
                  </div>
               </div>
               <div class="user-description">
                  <div class="row">
                     <div class="col-lg-4">
                        <h4 class="user-name"><?php echo $user->user_detail->first_name ." ".$user->user_detail->last_name?></h4>
                     </div>
                     <div class="col-lg-7 btnDesktop">
                        <?php if($session_user->id != $user->id) { ?>
                           <div style="position: absolute;">
                           <?php 
                              $inspire_count = ORM::factory('inspire')
                                 ->where('user_id', '=', $user->id)
                                 ->where('status', '=', 1)
                                 ->count_all();

                              $inspire_l = ORM::factory('inspire')
                                 ->where('user_id', '=', $user->id)
                                 ->where('user_by', '=', $session_user->id)
                                 ->where('status', '=', 1)
                                 ->find();
                           ?>
                           <form class="inspire-form" action="<?php echo url::base()."members/inspire"?>" method="post">
                              <input type="hidden" name="user_id" value="<?php echo $user->id;?>"/>
                              <input type="hidden" id="inspire-status" value="<?php echo ($inspire_l->id) ? 1 : 0;?>"/>

                              <img src="<?php echo url::base() . "img/ajax-loader.gif" ?>" class="inspire-loading" style="display:none;"/>
                              <span class="btn-get-inspired padding-btn <?php if($inspire_l->id) { ?>already-inspired<?php } ?>">
                                 <span class="inspire-submit-button">
                                    <?php if($inspire_l->id) { ?>
                                          <span class="inspire_btn">Inspired</span>
                                    <?php } else { ?>
                                          <span class="get_inspire_btn">Get Inspired</span>
                                    <?php } ?>
                                 </span>
                                 <!-- <span class="inspire-count inspire-list-popup" href="<?php echo url::base()."ajax/get_inspire_list?public=".$user->username; ?>" popup-modal="#genericPopup" popup-title="People who got inspired by <?php echo $user->user_detail->get_name(); ?>"> -->
                                    <!-- <?php //echo $inspire_count; ?> -->
                                 </span>
                              </span>
                           </form>
                           </div>
                        <?php } ?>
                        <?php if($session_user->id != $user->id) { ?>
                           <div class="col-lg-2" style="float:right;margin-right: 50px;">
                              <?php if($session_user->check_friends($user)) { ?>
                                 <form class="add-friend-form" id="friend_form" method="post">
                                    <div id="request_friend">
                                       <input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>
                                       <input type="hidden" name="friend-btn"  id="friend-btn" value="2"/>
                                       <button type="button" onclick="requestFriend()" class="btn <?php if(!isset($block)) {?>btn-block<?php } ?> btn-add" style="background: none;color: #797979;font-size: 12px !important;font-weight:600 !important;text-align: center;">
                                          <i class=" fa fa-check" style="position: relative;font-size: 18px;top: 2px;"></i>
                                       </button>
                                    </div>
                                 </form>
                              <?php } else if($session_user->has('requests', $user)) { ?>
                                 <form class="add-friend-form" id="friend_form" method="post">
                                    <div id="request_friend">
                                       <input type="hidden" name="del_request" value="<?php echo $user->id;?>"/>
                                       <input type="hidden" name="friend-btn"  id="friend-btn" value="1"/>
                                       <button type="button" onclick="requestFriend()" class="btn btn-add <?php if(!isset($block)) {?>btn-block<?php } ?> " style="background: none;color: #797979;font-size: 12px !important;font-weight:600 !important;text-align: center;">
                                          <i class="fa fa-paper-plane" style="position: relative;font-size: 16px;top: 1px;left:-1px;"></i> 
                                       </button>
                                    </div>
                                 </form>
                              <?php } else if($user->has('requests', $session_user)) { ?>
                                 <div class="friend-request" id="request_friend">
                                    <button type="button" class="btn btn-block btn-transparent request-btn" style="background: none;color: #797979;font-size: 12px !important;font-weight:600 !important;text-align: center;">
                                       <span class="btn-text">Respond to Request</span>
                                    </button>
                     
                                    <form class="respond-friend-form" id="friend_form"  method="post" style="display:inline-block;">
                                          <input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>
                                          <input type="hidden" name="friend-btn"  id="friend-btn" value="3"/>
                                          <button type="button" onclick="acceptRequestFriend()" class="btn btn-transparent" style="color: #797979;font-size: 12px !important;font-weight:600 !important;">
                                             <i class="fa fa-thumbs-o-up" style="font-size:18px;"></i>
                                             <span class="">Accept</span>
                                          </button>
                                    </form>
                                    <form class="respond-friend-form" id="friend_form" method="post" style="display:inline-block;margin-left:15px;">
                                          <input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>
                                          <input type="hidden" name="friend-btn"  id="friend-btn" value="4"/>
                                          <button type="button" onclick="rejectRequestFriend()" class="btn btn-transparent" style="color: #797979;font-size: 12px !important;font-weight:600 !important;">
                                             <i class="fa fa-thumbs-o-down" style="font-size:18px;"></i>
                                             <span class="">Reject</span>
                                          </button>
                                    </form>
                                 </div>
                              <?php } else { ?>
                                 <form class="add-friend-form" id="friend_form" method="post">
                                    <div id="request_friend">
                                       <input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>
                                       <input type="hidden" name="friend-btn"  id="friend-btn" value="0"/>
                                       <button type="button" onclick="requestFriend()" class="btn btn btn-add btn-transparent btn-block add-friend-btn" style="background: none;color: #797979;font-size: 12px !important;font-weight:600 !important;text-align: center;">
                                          <i class="fa fa-user-plus" style="position: relative;top: 1px;left:2px;font-size: 16px;"></i> <br/>
                                       </button>
                                    </div>
                                 </form>
                              <?php } ?>
                           </div>
                           
                           <div class="col-lg-2" style="float:right;">
                              <a href="<?php echo url::base() . 'chat/compose/' . $user->username; ?>" class="btn btn-chat">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <path id="Shape" d="M14,9.333a1.556,1.556,0,0,1-1.556,1.556H3.111L0,14V1.556A1.556,1.556,0,0,1,1.556,0H12.444A1.556,1.556,0,0,1,14,1.556Z" transform="translate(1 1)" fill="none" stroke="#9b9b9b" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                                 </svg>
                              </a>
                           </div>
                        <?php } ?>
                     </div>
                  </div>
                  <?php if($user->user_detail->about_private!=1) {?>
                  <?php if ($user->user_detail->about) { ?>
                  <p>
                     <?php echo $user->user_detail->about; ?>
                  </p>
                  <?php } ?>
                  <?php }?>
               </div>
               <div class="d-flex marTop10">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18.5" viewBox="0 0 18 18.5">
                     <g id="Icon_Map-pin" data-name="Icon Map-pin" transform="translate(0 0.25)">
                        <rect id="Bounds" width="18" height="18" fill="none" opacity="0"/>
                        <g id="Group" transform="translate(2.25 0.75)">
                           <path id="Shape" d="M13.5,6.75c0,5.25-6.75,9.75-6.75,9.75S0,12,0,6.75a6.75,6.75,0,0,1,13.5,0Z" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                           <circle id="Oval" cx="2.25" cy="2.25" r="2.25" stroke-width="2" transform="translate(4.5 4.5)" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/>
                        </g>
                     </g>
                  </svg>
                  <div class="location marLeft10">
                     Lives in 
                     <span class="city">
                        <?php if ($user->user_detail->location_private!=1) {  ?>
                        <?php if ($user->user_detail->location) {
                           ?>
                        <?php echo $user->user_detail->location; ?></p>
                        <?php }
                           else
                           {?>s
                        <!--  <div class="">
                           <div class="row">
                                  
                               <div class="col-sm-12">
                                   <p><span class="glyphicon glyphicon-map-marker"></span> <?php //echo  $user->ip;
                              if($user->ip) {
                                  $user_ip = $user->ip;
                                  $api_key = Kohana::$config->load('contact')->get('ip_api');
                              
                                  $url = "http://api.ipinfodb.com/v3/ip-city/?key=$api_key&ip=$user_ip&format=json";
                                  $ch = curl_init();
                              
                                  curl_setopt($ch, CURLOPT_URL, $url);
                                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                                  $data_country = curl_exec($ch);
                                  $location = json_decode( $data_country);
                                  echo $location->cityName." , ".$location->countryName;
                              }
                              else
                              {
                                  echo 'Washington, DC, United States';
                              }
                              ?></p>
                               </div>
                           </div>
                           </div> -->
                        <?php   }?>
                        <?php   }?>
                     </span>
                  </div>
               </div>
               <div class="d-flex">
                  <svg id="Icon_Book" data-name="Icon Book" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                     <rect id="Bounds" width="18" height="18" fill="none" opacity="0"/>
                     <g id="Group" transform="translate(3 1.5)">
                        <path id="Shape" d="M0,1.875A1.875,1.875,0,0,1,1.875,0H12" transform="translate(0 11.25)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                        <path id="Shape-2" data-name="Shape" d="M1.875,0H12V15H1.875A1.875,1.875,0,0,1,0,13.125V1.875A1.875,1.875,0,0,1,1.875,0Z" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                     </g>
                  </svg>
                  <div class="study marLeft10">Went to <span class="university"> <?php if ($user->user_detail->education_private!=1) { ?>
                     <?php if ($user->user_detail->education) { ?>
                     <?php echo $user->user_detail->education; ?>
                     <?php } ?>
                     <?php } ?></span>
                  </div>
               </div>
               <div class="d-flex marTop10">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                     <g id="Icon_Link" data-name="Icon Link" transform="translate(-2.056 -2.066)">
                        <g id="Group" transform="translate(3 3)">
                           <path id="Shape" d="M0,10.145a4.639,4.639,0,0,0,7,.5L9.779,7.862A4.639,4.639,0,0,0,3.22,1.3l-1.6,1.587" transform="translate(6.975 0.066)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                           <path id="Shape-2" data-name="Shape" d="M11.082,1.86a4.639,4.639,0,0,0-7-.5L1.3,4.143a4.639,4.639,0,0,0,6.56,6.56L9.449,9.116" transform="translate(0.056 6.061)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                        </g>
                     </g>
                  </svg>
                  <?php if ($user->user_detail->website_private!=1) { ?>
                  <?php if ($user->user_detail->website) { ?>
                  <a href="http://<?php echo $user->user_detail->website; ?>" class="marLeft10 profile-link" target="_blank"><?php echo $user->user_detail->website; ?></a>                        <?php }
                     else
                     {?>
                  <a href="http://www.amygoz.com/<?php echo $user->username; ?>" class="marLeft10 profile-link" target="_blank"> http://www.amygoz.com/<?php echo $user->username; ?></a>
                  <?php  }?>
                  <?php } ?>
               </div>
            </div>
            <div class="col-xs-12">
               <ul class="profile-tabs marTop10">
                  <li><a href="#post" class="active">Post</a></li>
                  <li><a href="#inspiration">Inspiration</a></li>
                  <li><a href="#reviews">Reviews</a></li>
                  <li><a href="#about">About</a></li>
               </ul>
               <!-- kamran comment code -->
               <div id="post" class="active">
                  <div class="post-inner">
                     <div class="row" style="margin:7px -6px;">
                        <?php foreach ($posts as $post){ ?>
                           <div class="col-xs-4 " style="padding:1px;margin-left: auto;margin-right: auto;">
                              <!-- onclick=openPostDialog(<?php echo $post['id']?>) -->
                              <div class="gallery-item" tabindex="0">
                                 <a href="<?php echo url::base()."post/".md5(sha1($post['id']));?>" style="font-weight: 300;">
                                    <?php if($post['photo']){ ?>
                                       <img src="<?php echo $post['photo'] ;?>" class="img-responsive post-img" width="100%" height="108px">
                                    <?php }
                                       else{ ?>
                                          <div class="img-gradient">
                                             <span class="item-text">
                                                <?php $photo = $user->photo->profile_pic;
                                                $photo_image = file_exists("upload/" .$photo);
                                                echo $post['post']; ?>
                                             </span>
                                          </div> 
                                    <?php } ?>
                                 </a>
                              </div>
                           </div>
                           <!-- <div id="postModal<?php echo $post['id']?>" class="modal" style="z-index: 9999;">
                              <div class="modal-content" style="width: 100%;height: 100%">
                                 <div class="row">
                                    <div class="modal-body">
                                       <div class="col-xs-3">
                                          <center>
                                             <div id="imagetilles">
                                                <?php $photo = $user->photo->profile_pic;
                                                $photo_image = file_exists("upload/" .$photo);
                                                if(!empty($photo) && $photo_image) { ?>
                                                   <img src="<?php echo url::base().'upload/'.$user->photo->profile_pic;?>" height="100%">
                                                <?php } else { ?>
                                                   <div id="inset" class="profile-view" style="margin-top: 0px;height: 75px;margin-top: -20px;">
                                                      <h1 style="font-size: 27px;line-height: 68px;">
                                                         <?php echo $user->user_detail->get_no_image_name(); ?>
                                                      </h1>
                                                   </div>
                                                <?php } ?>
                                             </div>
                                          </center>
                                       </div>
                                       <div class="col-xs-9">
                                          <span class="close pull-right" onclick=closeModal(<?php echo $post['id']?>) style="color: #4e4c4c;opacity: 1;">&times;</span>
                                       </div>
                                       <div class="col-xs-12" style="margin-top: 115px;">
                                          <p id="" style="font-size: 18px;font-weight: 500;margin-bottom: 10px;">
                                             <?php $photo = $user->photo->profile_pic;
                                                $photo_image = file_exists("upload/" .$photo);
                                                echo $post['post']; ?>
                                             <?php if($post['photo']){ ?>
                                                <img src="<?php echo $post['photo'] ;?>" class="img-responsive img-modal" height="100%" width="100%">
                                             <?php } ?>
                                          </p>                                              
                                       </div>                                     
                                    </div>
                                 </div>
                              </div>
                           </div> -->
                        <?php } ?>

                        <!-- <script>
                           function openPostDialog(postId){
                              $('#postModal'+postId).modal('toggle');
                           }
                           function closeModal(postId){
                              $('#postModal'+postId).modal('hide');
                           }
                        </script> -->
                     </div>
                  </div>
               <div>
            </div>
         </div>
         <div id="inspiration">
            <div class="post-inner">
               <div class="container" style="padding:0px;">
                  <div class="row" style="margin:7px -6px;">
                     <?php foreach ($inspires as $inspire) { ?>
                        <div class="col-xs-4" style="padding: 0px 1px; margin: 1px 0px">    
                           <?php
                           $photo = $user->photo->profile_pic;
                           $photo_image = file_exists("upload/" .$photo);
                           if($inspire['profile_pic'] != 'null' ){ ?>
                              <a href="<?php echo url::base().$inspire['username']; ?>" class="noname" style="font-size: 12px !important;text-decoration: none;color: #fff;">  
                                 <div class="bg-img-inspiration" style="background-image: url('<?php echo 'https://www.amygoz.com/mobile/upload/'.$inspire['profile_pic'];?>');">
                                    <span class="item-text">
                                       <?php echo $inspire['first_name'].' '.$inspire['last_name']; ?>
                                    </span>
                                 </div>  
                              </a>
                           <?php } else { ?>
                              <div id="inset" class="profile-view" style="margin-top: 0px;margin-top: -19px;height:165;">
                                 <h1 style="font-size: 66px;line-height: 155px;">
                                       <?php echo $user->user_detail->get_no_image_name(); ?>
                                 </h1>
                              </div>
                           <?php } ?> 
                        </div>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>
         <!-- kamran comment code -->
         <div id="reviews">
            <div class="box1">
               <div class="col-lg-12">
                  <div class="top">
                     <?php if(!empty($recommendations)) { ?>
                     <div class="">
                        <p class="title" style="font-size: 16px;font-weight: 400;padding: 10px 0px;font-family: GreycliffCF-Regular;"> <?php echo count($recommendations); ?> people say <?php echo $user->user_detail->first_name ." ".$user->user_detail->last_name?> is </p>
                     </div>
                  </div>
                  <div class="bottom">
                     <div class="">
                        <?php $tag_count = 0;?>
                        <?php foreach ($tags as $tag => $weight) { ?>
                        <?php echo '<a class="btn icon-btn btn-transparent btn-md marBottom5" '."id="."badge_".$tag.' href="#">'.$weight." ".$tag.'</a>' ?>
                        <?php $tag_count++; } ?>
                     </div>
                     <?php } ?>
                  </div>
               </div>
               <div class="row marTop10">
                  <div class="col-sm-4 text-center zIndex">
                     <div class="circular-bar marTop10">
                        <input type="text" class="dial" data-fgColor="#ff1744" data-width="150" data-height="150" data-linecap=round  value="<?php echo $social; ?>" >
                        <div class="circular-bar-content">
                           <label></label>
                        </div>
                     </div>
                     <h4 class="text-center">Social</h4>
                  </div>
                  <?php if(!empty($tags)) { ?>
                  <div id="wordWrap" class="col-sm-8 zIndex">
                     <div class="tag-box bordered-box">
                        <fieldset class="fieldset pull-left" style="width:100%;">
                           <div class="words">
                              <div id="wordcloud" class="jqcloud" style="height:300px;width: 550px;"></div>
                           </div>
                        </fieldset>
                        <div class="clearfix"></div>
                     </div>
                     <?php if($session_user->id !== $user->id) {
                        if($user->user_detail->reviews_private == 0) { ?>
                     <!--word cloud javascript-->
                     <link rel="stylesheet" type="text/css" href="<?php echo url::base(); ?>css/jqcloud.css" />
                     <script type="text/javascript" src="<?php echo url::base(); ?>js/jqcloud-1.0.3.min.js"></script>
                     <script type="text/javascript">
                        var word_list = new Array();
                        <?php foreach ($tags as $tag => $weight) { ?>
                              word_list.push({text: <?php echo "'" . $tag . "'"; ?>, weight: <?php echo $weight; ?>});
                        <?php } ?>
                        
                        $(function() {
                              $("#wordcloud").jQCloud(word_list, {
                                 width: ($("#wordWrap").width() - 30),
                                 height: 300
                              });
                        });
                     </script>
                     <?php }else { ?>
                     <!--word cloud javascript-->
                     <link rel="stylesheet" type="text/css" href="<?php echo url::base(); ?>css/jqcloud.css" />
                     <script type="text/javascript" src="<?php echo url::base(); ?>js/jqcloud-1.0.3.min.js"></script>
                     <script type="text/javascript">
                        var word_list = new Array();
                        <?php foreach ($tags as $tag => $weight) { ?>
                              //word_list.push({text: <?php echo "Ask about review's tags"; ?>, weight: <?php echo $weight; ?>});
                           word_list.push({text: <?php echo "'" . $tag . "'"; ?>, weight: <?php echo $weight; ?>});
                        <?php } ?>
                        
                        $(function() {
                              $("#wordcloud").jQCloud(word_list, {
                                 width: ($("#wordWrap").width() - 30),
                                 height: 300
                              });
                        });
                     </script>
                     <?php }
                        }else{ ?> 
                     <!--word cloud javascript-->
                     <link rel="stylesheet" type="text/css" href="<?php echo url::base(); ?>css/jqcloud.css" />
                     <script type="text/javascript" src="<?php echo url::base(); ?>js/jqcloud-1.0.3.min.js"></script>
                     <script type="text/javascript">
                        var word_list = new Array();
                        <?php foreach ($tags as $tag => $weight) { ?>
                              word_list.push({text: <?php echo "'" . $tag . "'"; ?>, weight: <?php echo $weight; ?>});
                        <?php } ?>
                        
                        $(function() {
                              $("#wordcloud").jQCloud(word_list, {
                                 width: ($("#wordWrap").width() - 30),
                                 height: 300
                              });
                        });
                     </script>
                     <?php  } ?>
                     <div class="clearfix"></div>
                  </div>
                  <?php } ?>
                  <div class="trending-pro-main">
                     <div class="trending-header">
                        <p></p>
                     </div>
                  </div>
                  <div class="fieldset-inner noMargin">
                     <?php if(empty($recommendations))
                        {   ?>
                     <div class="review-panel">
                        <?php if($session_user->id !== $user->id)
                           { ?>
                        <i class="fa fa-frown-o"></i>
                        <h4 style="text-align:center;">
                           No one has reviewed <?php echo $user->user_detail->first_name; ?> yet.<br>
                           <a href="<?php echo url::base() . 'peoplereview/compose?ask=' . $user->username; ?>" class="btn btn-transparent marTop10"> Review <?php echo $user->user_detail->first_name; ?> </a>
                        </h4>
                        <?php } else { ?>
                        <i class="fa fa-frown-o"></i>
                        <h4 style="text-align:center;"> No one has reviewed you yet.<br>
                           <a href="<?php echo url::base() . 'peoplereview/askreview'; ?>" class="btn btn-transparent marTop10"> Ask to be Reviewed </a>
                        </h4>
                        <?php } ?>        
                     </div>
                     <?php } else { ?>
                     <div class="row">
                        <div class="col-lg-12">
                           <?php if($session_user->id != $user->id) { ?>
                           <ul class="event-list">
                              <?php if($user->user_detail->reviews_private == 0 || $user->user_detail->reviews_private == '1') //foreach start  
                                 { 
                                       foreach ($recommendations as $recommendation) 
                                       { 
                                          if( $recommendation->type=='1')
                                          { ?>
                              <li class="padding-row">
                                 <name datetime="">
                                    <?php  
                                       $photo = $recommendation->owner->photo->profile_pic_s;
                                       $recomation_image = file_exists("mobile/upload/" .$photo);
                                       $recomation_image1 = file_exists("upload/" .$photo);
                                       if (!empty($photo) && $recomation_image) { ?>
                                    <img class="img-circle hb-mt-10" src="<?php echo url::base() . "mobile/upload/" . $recommendation->owner->photo->profile_pic_s ?>" width="36" height="36">
                                    <?php }
                                       else if (!empty($photo) && $recomation_image1) { ?>
                                    <img class="img-circle hb-mt-10" src="<?php echo url::base() . "upload/" . $recommendation->owner->photo->profile_pic_s ?>" width="36" height="36">
                                    <?php } else { ?>
                                    <img class="img-circle hb-mt-10" src="<?php echo url::base() . "img/no_image_s.png"; ?>" width="36" height="36">
                                    <?php } ?>
                                 </name>
                                 <div class="info">
                                    <p class="desc">
                                    <h5>
                                       <a href="<?php echo url::base().$recommendation->owner->username; ?>">
                                       <?php echo $recommendation->owner->user_detail->first_name . " " .$recommendation->owner->user_detail->last_name; ?>
                                       </a>   
                                    </h5>
                                    </p>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <a>
                                             <p class="job-comment">  <?php echo $user->user_detail->first_name." is ". $recommendation->owner->user_detail->first_name."`s ".$recommendation->relation ;?> </p>
                                          </a>
                                       </div>
                                       <div class="col-sm-6 text-right">
                                          <small>Reviewed On: <?php
                                             $age = time() - strtotime($recommendation->time);
                                             if ($age >= 86400) {
                                                   echo date('jS M', strtotime($recommendation->time));
                                             } else {
                                                   echo date::time2string($age);
                                             }
                                             ?>
                                          </small>
                                       </div>
                                    </div>
                                 </div>
                                 <?php echo $recommendation->message; ?>
                                 <div class="clearfix"></div>
                              </li>
                              <?php } ?>
                              <?php if($recommendation->type=='0')
                                 { ?>
                              <li>
                                 <name datetime="">
                                    <img class="img-circle hb-mt-10" src="<?php echo url::base() . "img/no_image_s.png"; ?>" width="70" height="70">
                                    <h5>
                                       <a>
                                       Anonymous User
                                       </a>   
                                    </h5>
                                 </name>
                                 <div class="info">
                                    <p class="desc">
                                    </p>
                                    <div class="clearfix"></div>
                                    <div class="row ">
                                       <div class="col-sm-6">
                                       </div>
                                       <div class="col-sm-6 text-right">
                                          <small>Reviewed On: <?php
                                             $age = time() - strtotime($recommendation->time);
                                             if ($age >= 86400) {
                                                   echo date('jS M', strtotime($recommendation->time));
                                             } else {
                                                   echo date::time2string($age);
                                             }
                                             ?> </small>
                                       </div>
                                    </div>
                                 </div>
                                 <?php echo $recommendation->message; ?>
                                 <div class="clearfix"></div>
                              </li>
                              <?php } ?>                                
                              <?php } //  foreach closed 
                                 }else {
                                    ?>
                              <i class="fa fa-frown-o" style="margin-left:38%;"></i>
                              <h4 style="text-align:center; margin-top: -21px;">
                                 Ask about reviews. 
                              </h4>
                              <?php } ?> 
                           </ul>
                           <?php }else{?>
                           <ul class="event-list">
                              <?php foreach ($recommendations as $recommendation) 
                                 { 
                                       if( $recommendation->type=='1')
                                       { ?>
                              <li>
                                 <name datetime="">
                                    <?php  
                                       $photo = $recommendation->owner->photo->profile_pic_s;
                                       $recommendation_image = file_exists("mobile/upload/" .$photo);
                                       $recommendation_image1 = file_exists("upload/" .$photo);
                                          if (!empty($photo) && $recommendation_image) { ?>
                                    <img class="img-circle hb-mt-10" src="<?php echo url::base() . "mobile/upload/" . $recommendation->owner->photo->profile_pic_s ?>" width="36" height="36">
                                    <?php }
                                       else if (!empty($photo) && $recommendation_image1) { ?>
                                    <img class="img-circle hb-mt-10" src="<?php echo url::base() . "upload/" . $recommendation->owner->photo->profile_pic_s ?>" width="36" height="36">
                                    <?php } else { ?>
                                    <img class="img-circle hb-mt-10" src="<?php echo url::base() . "img/no_image_s.png"; ?>" width="36" height="36">
                                    <?php } ?>
                                 </name>
                                 <div class="info">
                                    <p class="desc">
                                    <h5>
                                       <a href="<?php echo url::base().$recommendation->owner->username; ?>">
                                       <?php echo $recommendation->owner->user_detail->first_name . " " .$recommendation->owner->user_detail->last_name; ?>
                                       </a>   
                                    </h5>
                                    </p>
                                    <div class="clearfix"></div>
                                    <div class="row ">
                                       <div class="col-sm-6">
                                          <a>
                                             <p class="job-comment">  <?php echo $user->user_detail->first_name." is ". $recommendation->owner->user_detail->first_name."`s ".$recommendation->relation ;?> </p>
                                          </a>
                                       </div>
                                       <div class="col-sm-6 text-right">
                                          <small>Reviewed On: <?php
                                             $age = time() - strtotime($recommendation->time);
                                             if ($age >= 86400) {
                                                   echo date('jS M', strtotime($recommendation->time));
                                             } else {
                                                   echo date::time2string($age);
                                             }
                                             ?>
                                          </small>
                                       </div>
                                    </div>
                                 </div>
                                 <?php echo $recommendation->message; ?>
                                 <div class="clearfix"></div>
                              </li>
                              <?php } ?>
                              <?php if($recommendation->type=='0')
                                 { ?>
                              <li>
                                 <name datetime="">
                                    <img class="img-circle hb-mt-10" src="<?php echo url::base() . "img/no_image_s.png"; ?>" width="70" height="70">
                                    <h5>
                                       <a>
                                       Anonymous User
                                       </a>   
                                    </h5>
                                 </name>
                                 <div class="info">
                                    <p class="desc">
                                       <?php echo $recommendation->message; ?>
                                    </p>
                                    <div class="clearfix"></div>
                                    <div class="row marTop10">
                                       <div class="col-sm-6">
                                       </div>
                                       <div class="col-sm-6 text-right">
                                          <small>Reviewed On: <?php
                                             $age = time() - strtotime($recommendation->time);
                                             if ($age >= 86400) {
                                                   echo date('jS M', strtotime($recommendation->time));
                                             } else {
                                                   echo date::time2string($age);
                                             }
                                             ?> </small>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </li>
                              <?php } ?>                                
                              <?php } //  foreach closed ?>
                           </ul>
                           <?php }?>
                        </div>
                     </div>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>
         <div id="about">
            <div class="container">
               <h6 class="about-h">About Me</h6>
               <p class="abt-value"><?php echo $user->user_detail->about; ?></p>
            </div>
            <div class="divider-about"></div>
            <div class="container">
               <h5 class="friends-h">
                  Friends 
                  <svg id="Icon_List-arrow" data-name="Icon List-arrow" xmlns="http://www.w3.org/2000/svg" width="12" height="24" viewBox="0 0 12 24">
                     <rect id="Bounds" width="12" height="24" fill="none" opacity="0"/>
                     <path id="Shape" d="M0,10,5,5,0,0" transform="translate(6 7)" fill="none" stroke="#cfd4dd" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                  </svg>
                  <span>
                     <!--show total number of friends begin-->
                     <?php $n = ORM::factory('friendship')->where('user_id', '=', $user->id)->count_all(); ?>
                     <?php if($session_user->id != $user->id) { ?>
                     <?php
                        if ($n == 0) {
                              echo 'No Friends';
                        } else if ($n == 1) {
                              echo '<a href="'.url::base().$user->username .'/friends">1</a>';
                        } else {
                              echo '<a href="'.url::base().$user->username .'/friends">'.$n . '</a>';
                        }
                        ?>
                     <?php } ?> 
                  </span>
               </h5>
            </div>
            <div class="divider-about"></div>
            <div class="container">
               <h6 class="about-h">Basic Info</h6>
               <span class="inner-h">Education</span>
               <p class="abt-value"><?php echo $user->user_detail->education; ?></p>
               <span class="inner-h">Website</span>
               <p class="abt-value url"><a href="https://<?php echo $user->user_detail->website; ?>" target="_blank"><?php echo $user->user_detail->website; ?></a></p>
            </div>
            <div class="divider-about"></div>
            <div class="container">
               <h6 class="about-h">Location</h6>
               <span class="inner-h">From</span>
               <p class="abt-value"><?php echo $user->user_detail->home_town; ?></p>
               <span class="inner-h">Living</span>
               <p class="abt-value"><?php echo $user->user_detail->location; ?></p>
            </div>
            <div class="divider-about"></div>
            <div class="container">
               <h6 class="about-h">Work</h6>
               <span class="inner-h">Profession</span>
               <p class="abt-value"><?php echo $user->user_detail->designation; ?> at <?php echo $user->user_detail->employment; ?></p>
            </div>
         </div>
      </div>
   </div>
   <script>
      const tabs = document.querySelector(".profile-tabs")
      
      console.log(tabs)
      tabs.addEventListener("click",function(event) {
         const active = document.querySelectorAll('.active')
         
         for(var i = 0; i < active.length;i++){
            active[i].classList.remove("active")
         }
         event.preventDefault()
         event.target.classList.add("active");
         var getId = event.target.href.split('#')[1]
         document.getElementById(getId).classList.add("active")
      })
   </script>
   <!--   <div class="col-lg-4">
      <div class="new-member">
         <h2>New to Callitme?</h2>
         <p>Sign up now to get your own personalized timeline</p>
         <a href="https://www.callitme.com/" class="btn">Create an account</a>
      </div> -->
   <!--  <div class="trending-pro-main">
      <div class="trending-header">
         <p>Trending Profile <a href="">See more</a></p>
      </div>
      <div class="d-flex align-items-center py-2 border-bottom">
         <div class="pro-img mr-2">
            <img src="assets/images/pp-6-jDiXYGd0_o.png" class="img-responsive" width="44px" height="44px" />
         </div>
         <div class="pro-details">
            <div class="pro-title">Nellie Carlson</div>
            <span class="pro-insp text-capitalize">23.5K inspired 225 post</span>
         </div>
         <div class="btn-add-p">
            <button class="btn btn-add"><svg id="Icon_User_Plus" data-name="Icon User Plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
      <path id="Bounds" d="M0,0H24V24H0Z" fill="none" opacity="0"/>
      <g id="Group" transform="translate(1 3)">
      <path id="Shape" d="M15,5V4a4,4,0,0,0-4-4H4A4,4,0,0,0,0,4V5" transform="translate(0 12)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
      <circle id="Oval" cx="4" cy="4" r="4" stroke-width="2" transform="translate(4)" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/>
      <path id="Shape-2" data-name="Shape" d="M0,0V6" transform="translate(19 5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
      <path id="Shape-3" data-name="Shape" d="M6,0H0" transform="translate(16 8)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
      </g>
      </svg>
      </button>
         </div>
      </div>
      <div class="d-flex align-items-center py-2 border-bottom">
         <div class="pro-img mr-2">
            <img src="assets/images/pp-6-jDiXYGd0_o.png" class="img-responsive" width="44px" height="44px" />
         </div>
         <div class="pro-details">
            <div class="pro-title">Nellie Carlson</div>
            <span class="pro-insp text-capitalize">23.5K inspired 225 post</span>
         </div>
            <div class="btn-add-p">
            <button class="btn btn-add"><svg id="Icon_User_Plus" data-name="Icon User Plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
      <path id="Bounds" d="M0,0H24V24H0Z" fill="none" opacity="0"/>
      <g id="Group" transform="translate(1 3)">
      <path id="Shape" d="M15,5V4a4,4,0,0,0-4-4H4A4,4,0,0,0,0,4V5" transform="translate(0 12)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
      <circle id="Oval" cx="4" cy="4" r="4" stroke-width="2" transform="translate(4)" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/>
      <path id="Shape-2" data-name="Shape" d="M0,0V6" transform="translate(19 5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
      <path id="Shape-3" data-name="Shape" d="M6,0H0" transform="translate(16 8)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
      </g>
      </svg>
      </button>
         </div>
      </div>
      <div class="d-flex align-items-center py-2 border-bottom">
         <div class="pro-img mr-2">
            <img src="assets/images/pp-6-jDiXYGd0_o.png" class="img-responsive" width="44px" height="44px" />
         </div>
         <div class="pro-details">
            <div class="pro-title">Nellie Carlson</div>
            <span class="pro-insp text-capitalize">23.5K inspired 225 post</span>
         </div>
            <div class="btn-add-p">
            <button class="btn btn-add"><svg id="Icon_User_Plus" data-name="Icon User Plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
      <path id="Bounds" d="M0,0H24V24H0Z" fill="none" opacity="0"/>
      <g id="Group" transform="translate(1 3)">
      <path id="Shape" d="M15,5V4a4,4,0,0,0-4-4H4A4,4,0,0,0,0,4V5" transform="translate(0 12)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
      <circle id="Oval" cx="4" cy="4" r="4" stroke-width="2" transform="translate(4)" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/>
      <path id="Shape-2" data-name="Shape" d="M0,0V6" transform="translate(19 5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
      <path id="Shape-3" data-name="Shape" d="M6,0H0" transform="translate(16 8)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
      </g>
      </svg>
      </button>
         </div>
      </div>
      </div> -->
   <!-- </div> -->
      </div>
   </div>
</div>

<style type="text/css">
   .src-image {
   display: none;
   }
   .profile-user {
   height: 178px !important;
   width: 160px !important;
   }
   .profile-user img:hover {
   transform: scale(1.1);
   transition: ease-in 0.5s;
   }
   .profile-user > img {
   height: 148px;
   width: 150px;
   border-radius: 100%;
   }
   .profile-usertitl {
   margin-top: -22px;
   text-align: center;
   width: 151px;
   height: 44px;
   }
   .card {
   overflow: hidden;
   position: relative;
   border: 1px solid #F9F4F4;
   border-radius: 8px;
   text-align: center;
   padding: 0;
   background-color: #00bcd4;
   color: rgb(136, 172, 217);
   height: 200px;
   }
   .card .header-bg {
   /* This stretches the canvas across the entire hero unit */
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 90px;
   border-bottom: 1px #FFF solid;
   /* This positions the canvas under the text */
   z-index: 1;
   background-color: mintcream;
   }
   .card .avatar {
   position: relative;
   margin-top: 15px;
   z-index: 100;
   }
   .card .avatar img {
   width: 100px;
   height: 100px;
   -webkit-border-radius: 50%;
   -moz-border-radius: 50%;
   border-radius: 50%;
   border: 2px solid rgba(0,0,30,0.8);
   }
</style>
<script type="text/javascript">
   $(document).ready(function(){
      $( ".btn-get-inspired" ).click(function() {
         var inspire_id = $("#inspire-status").val();
         if(inspire_id == '1') {
            $(".inspire_btn").hide();
            $(".get_inspire_btn").show();
            $("#inspire-status").val('0');
            $(".inspire-submit-button").html('<span class="get_inspire_btn">Get Inspired</span>');
         }
         else {
            $(".get_inspire_btn").hide();
            $(".inspire_btn").show();
            $("#inspire-status").val('1');
            $(".inspire-submit-button").html('<span class="inspire_btn">Inspired</span>');
         }
      });
      
       $('.dial').each(function () { 
   
           var elm = $(this);
           var color = elm.attr("data-fgColor");  
           var perc = elm.attr("value");  
   
           elm.knob({ 
                'value': 0, 
                 'min':0,
                 'max':100,
                 "skin":"tron",
                 "readOnly":true,
                 "thickness":.1,                 
                 "dynamicDraw": true,                
                 "displayInput":false
           });
   
           $({value: 0}).animate({ value: perc }, {
               duration: 1000,
               easing: 'swing',
               progress: function () {                  
                   elm.val(Math.ceil(this.value)).trigger('change')
               }
           });
   
           //circular progress bar color
           $(this).append(function() {
               elm.parent().parent().find('.circular-bar-content').css('color',color);
               elm.parent().parent().find('.circular-bar-content label').text(perc+'%');
           });
   
       });
   
   });

   function requestFriend() {
      var form_data = $("#friend_form").serialize();
      var base_url = "<?php echo url::base(); ?>";
      var friend_btn = $("#friend-btn").val();
      if(friend_btn == '2') {
         $.ajax({
            url:base_url+"friends/delete_friend",
            data:form_data,
            type:'POST',
            success:function(result)
            {
               $("#request_friend").html('<input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>'+
               '<input type="hidden" name="friend-btn"  id="friend-btn" value="0"/>'+
               '<button type="button" onclick="requestFriend()" class="btn btn btn-add btn-transparent btn-block add-friend-btn" style="background: none;color: #797979;font-size: 12px !important;font-weight:600 !important;text-align: center;">'+
                  '<i class="fa fa-user-plus" style="position: relative;top: 1px;left:2px;font-size: 16px;"></i> <br/>'+
               '</button>');

               $('#request_friend_btn').html('<input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>'+
               '<input type="hidden" name="friend-btn"  id="friend-btn" value="0"/>'+
               '<button type="button" onclick="requestFriend()" class="btn btn-primary <?php if(!isset($block)) {?>btn-block<?php } ?> add-friend-btn">'+
                  '<span class="glyphicon glyphicon-plus"></span> &nbsp;&nbsp;<span class="btn-text">Add as a friend</span>'+
               '</button>');
            }
         });
      }
      else {
         $.ajax({
            url:base_url+"friends/add_friend",
            data:form_data,
            type:'POST',
            dataType: 'json',
            success:function(result)
            {
               console.log(result);
               if(friend_btn == '0') {
                  $("#request_friend").html('<input type="hidden" name="del_request" value="<?php echo $user->id;?>"/>'+
                  '<input type="hidden" name="friend-btn"  id="friend-btn" value="1"/>'+
                  '<button type="button" onclick="requestFriend()" class="btn btn-add <?php if(!isset($block)) {?>btn-block<?php } ?> " style="background: none;color: #797979;font-size: 12px !important;font-weight:600 !important;text-align: center;">'+
                     '<i class="fa fa-paper-plane" style="position: relative;font-size: 16px;top: 1px;left:-1px;"></i>'+
                  '</button>');

                  $('#request_friend_btn').html('<input type="hidden" name="del_request" value="<?php echo $user->id;?>"/>'+
                  '<input type="hidden" name="friend-btn"  id="friend-btn" value="1"/>'+
                  '<button type="button" onclick="requestFriend()" class="btn btn-primary <?php if(!isset($block)) {?>btn-block<?php } ?> request-btn">'+
                     '<span class="glyphicon glyphicon-send"></span> &nbsp;&nbsp;<span class="btn-text">Friend Request Sent</span>'+
                  '</button>');
               }
               else {
                  $("#request_friend").html('<input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>'+
                  '<input type="hidden" name="friend-btn"  id="friend-btn" value="0"/>'+
                  '<button type="button" onclick="requestFriend()" class="btn btn btn-add btn-transparent btn-block add-friend-btn" style="background: none;color: #797979;font-size: 12px !important;font-weight:600 !important;text-align: center;">'+
                     '<i class="fa fa-user-plus" style="position: relative;top: 1px;left:2px;font-size: 16px;"></i> <br/>'+
                  '</button>');

                  $('#request_friend_btn').html('<input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>'+
                  '<input type="hidden" name="friend-btn"  id="friend-btn" value="0"/>'+
                  '<button type="button" onclick="requestFriend()" class="btn btn-primary <?php if(!isset($block)) {?>btn-block<?php } ?> add-friend-btn">'+
                     '<span class="glyphicon glyphicon-plus"></span> &nbsp;&nbsp;<span class="btn-text">Add as a friend</span>'+
                  '</button>');
               }
            }
         });
      }
   }

   function acceptRequestFriend()  {
      var form_data = $("#friend_form").serialize();
      var base_url = "<?php echo url::base(); ?>";
      $.ajax({
         url:base_url+"friends/accept_friend",
         data:form_data,
         type:'POST',
         success:function(result)
         {
            $("#request_friend").html('<input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>'+
            '<input type="hidden" name="friend-btn"  id="friend-btn" value="2"/>'+
            '<button type="button" onclick="requestFriend()" class="btn btn-block btn-add" style="background: none;color: #797979;font-size: 12px !important;font-weight:600 !important;text-align: center;">'+
               '<i class=" fa fa-check" style="position: relative;font-size: 18px;top: 2px;"></i> <br/>'+
            '</button>');

            $('.respond-btn').html('<form class="respond-friend-form" id="friend_form"  method="post" style="display:inline-block;">'+
            '<input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>'+
            '<input type="hidden" name="friend-btn"  id="friend-btn" value="2"/>'+
            '<button type="button" onclick="requestFriend()" class="btn btn-block friend-btn btn-secondary">'+
               '<span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp;<span class="btn-text">Friend</span>'+
            '</button>'+
            '</form>');
         }
      });
   }

   function rejectRequestFriend()  {
      var form_data = $("#friend_form").serialize();
      var base_url = "<?php echo url::base(); ?>";
      $.ajax({
         url:base_url+"friends/reject_request",
         data:form_data,
         type:'POST',
         success:function(result)
         {
            $("#request_friend").html('<form class="respond-friend-form" id="friend_form"  method="post" style="display:inline-block;">'+
               '<input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>'+
            '<input type="hidden" name="friend-btn"  id="friend-btn" value="0"/>'+
            '<button type="button" onclick="requestFriend()" class="btn btn btn-add btn-transparent btn-block add-friend-btn" style="background: none;color: #797979;font-size: 12px !important;font-weight:600 !important;text-align: center;">'+
               '<i class="fa fa-user-plus" style="position: relative;top: 1px;left:2px;font-size: 16px;"></i> <br/>'+
            '</button>'+
            '</form>');

            $('.respond-btn').html('<input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>'+
            '<input type="hidden" name="friend-btn"  id="friend-btn" value="0"/>'+
            '<button type="button" onclick="requestFriend()" class="btn btn-primary <?php if(!isset($block)) {?>btn-block<?php } ?> add-friend-btn">'+
               '<span class="glyphicon glyphicon-plus"></span> &nbsp;&nbsp;<span class="btn-text">Add as a friend</span>'+
            '</button>');
         }
      });
   }
</script>