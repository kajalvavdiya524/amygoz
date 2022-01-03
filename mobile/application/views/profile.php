
<!--Profile view when a user is NOT logged in-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
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
} 
  .modal-backdrop.in {
    z-index: 100;
}
/*startnew*/
.d-flex{display: flex;}
.flex-between{justify-content: space-between;}
.align-center{align-items: center;}
.top-header{background-color: rgb(255,255,255,82%);border-bottom: 1px solid #979797;padding-bottom: 10px}
.profile-section{background-color: #fff;padding:20px 0;}
.profile-section .img-profile{height: 130px!important;object-fit: cover;}
.profile-section img{border-radius: 50%;}
.profile-section .post-items h6{font-size: 16px;font-family:GreycliffCF-Bold;margin-bottom: 0px;}
.profile-section .post-items span{font-size: 16px;font-family:GreycliffCF-Regular;}
.profile-section .user-description .user-name{font-size: 20px;font-family:GreycliffCF-Bold;margin-bottom: 5px;}
.profile-section .user-description #description-more{display: none;}
.profile-section .user-description #description-more:target{display: block;}
.profile-section .user-description .btn-get-inspired{background-color: #FF5A5F;width: 248px; height: 36px;color:#fff;border-radius: 20px;font-size: 15px;line-height: 36px;}
.marTop10{margin-top: 10px;}
.profile-section .user-description button:focus{outline: none;}
.profile-section .user-description .btn-chat,.profile-section .user-description .btn-add{background: transparent; border:2px solid #F1F2F4; border-radius: 50%;width: 36px;height: 36px;line-height: 2.2; padding-left: 8px;}
.profile-section .location,.profile-section .study,.profile-section .study{font-size: 16px;font-family:GreycliffCF-Regular;}
.profile-section .location .city,.profile-section .study .university{
  font-family:GreycliffCF-Bold!important;
}
.profile-section .profile-link{font-size: 15px;color: #00BCD4}
.profile-tabs{border-bottom:1px solid #F1F2F4;margin-bottom: 0px;padding-bottom: 10px;background-color: #fff;display: flex;justify-content: space-around;list-style-type: none;padding: 0}
.user-description .about{font-family:GreycliffCF-Regular;}
.profile-tabs li{width:100%;text-align: center;}
.profile-tabs li a{font-size: 14px;display: block;padding: 10px 0;border-bottom: 2px solid transparent;text-decoration: none;font-family:GreycliffCF-Bold;color: #8991A0;}
.profile-tabs li a.active{color: #FF5A5F;border-bottom: 2px solid #FF5A5F}
.img-gradient{background-image: linear-gradient(#FF585D, #FB947F);height: 135px;width: 100%;border-radius: 2px;}
.post-inner .item-text{font-size: 14px;display: inline-block;color: #fff;padding: 20px 10px}
.post-inner:after{clear: both;content: '';display: block;width: 100%}
.post-img{border-radius: 2px;margin-left: auto;margin-right: auto;height: 135px;object-fit: cover; object-position: top;}
.btn-edit-profile{background-color: #F1F2F4;width: 100%; height: 36px;color:#010101;border-radius: 20px;font-size: 15px;border:1px solid #DCE1EA;}
.bg-img-inspiration{height: 120px;position: relative;background-size: cover;width: 100%;border-radius: 2px!important;}
.bg-img-inspiration:after{content: "";position: absolute;background-color: rgba(0,0,0, 0.2);width: 100%;height: 100%;border-radius: 4px!important;}
.bg-img-inspiration .item-text{ bottom: -11px!important;z-index:100;left:-2px!important;position: absolute;width: 100%;font-size: 12px;display: inline-block;color: #fff;}
.btn-sign-up{background-color: #FF5A5F!important;width: 100%; height: 36px;color:#fff!important;border-radius: 20px;font-size: 15px}
.btn-sign-in{background-color: #F1F2F4!important;width: 100%; height: 36px;color:#010101!important;border-radius: 20px;font-size: 15px;}
.marLeft10{margin-left: 10px;}
#inspiration,#post,#reviews,#about{display: none;}
      .active{display: block!important;background-color: #ffffff;}
      .modal-body img, .img-modal{height: 100%!important,margin-top:10px!important;}
      .close{margin-top: 10px}
      /*about sec*/
      #about .about-h{
    color: #FF5A5F;
    font-size: 12px;
    font-family:GreycliffCF-Regular;
}
#about .abt-value{
    font-size: 14px;
    color: #010101;
    font-family:GreycliffCF-Regular;
}
#about .divider-about{
    padding: 5px;
    background-color: #F1F2F4;
}
#about .abt-value.url a{
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
    font-family:GreycliffCF-Regular;
}
/*endnew*/
/* reviews*/
#badge_Sweet,#badge_Joyful,#badge_Friendly,#badge_Optimist,#badge_Generous,#badge_Egotistical,#badge_Funny,#badge_Sympathetic,#badge_Bossy{
  border-radius: 30px;
    margin-right: 3px;
    padding: 3px 16px;
    background-image: linear-gradient(to bottom, #FD5B5F, #FB907D);
    margin-top: 8px;
    font-size: 14px!important;
    font-family:GreycliffCF-Regular;
    color: #fff;
}
#badge_Social,#badge_Respectful,#badge_Sensitive,#badge_Smart,#badge_Mean,#badge_Courteous,#badge_Courageous,#badge_Considerate{
  border-radius: 30px;
    margin-right: 3px;
    padding: 3px 16px;
    background-color:#00BCD4;
    margin-top: 8px;
    font-size: 14px!important;
    font-family:GreycliffCF-Regular;
    color: #fff;
}
#badge_Honest,#badge_Thoughtful,#badge_Charismatic,#badge_Materialistic,#badge_Ambitious,#badge_Affectionate,#badge_Dependable,#badge_Lazy{
  border-radius: 30px;
    margin-right: 3px;
    padding: 3px 16px;
    background-image: linear-gradient(to bottom, #FD935B, #FBC27D);
    margin-top: 8px;
    font-family:GreycliffCF-Regular;
    font-size: 14px!important;
    color: #fff;
}



</style>
<?php
    
  //foreach ($posts as $key => $value) {
      //if($key == 0){
        //echo json_encode($inspires);
      //}
  //}
    
  
?>
<!--  <div class="top-header">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="d-flex flex-between align-center">
              <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <g id="Group_449" data-name="Group 449" transform="translate(32.5 4)">
                    <g id="Group_456" data-name="Group 456" transform="translate(-33)">
                      <path id="Bounds" d="M0,0H24V24H0Z" transform="translate(0.5 0.5)" fill="none" opacity="0"/>
                      <path id="Arrow_Left" data-name="Arrow Left" d="M7.993,14.119A1.176,1.176,0,0,1,8,15.677a.936.936,0,0,1-1.418,0L.3,8.779a1.173,1.173,0,0,1,0-1.56L6.582.326A.939.939,0,0,1,8,.321,1.174,1.174,0,0,1,7.993,1.88L3.414,6.9H17A1.05,1.05,0,0,1,18,8a1.055,1.055,0,0,1-1,1.1H3.414Z" transform="translate(3.5 4.5)" fill="#1d1d26"/>
                    </g>
                  </g>
                </svg>
              </a>
              <span class="user-name"> <?php echo $user->user_detail->first_name ." ".$user->user_detail->last_name?></span>
              <span>
                <svg id="Group_1359" data-name="Group 1359" xmlns="http://www.w3.org/2000/svg" width="18" height="4" viewBox="0 0 18 4">
                  <circle id="Ellipse_36" data-name="Ellipse 36" cx="2" cy="2" r="2" transform="translate(14)" fill="#010101"/>
                  <circle id="Ellipse_37" data-name="Ellipse 37" cx="2" cy="2" r="2" fill="#010101"/>
                  <circle id="Ellipse_38" data-name="Ellipse 38" cx="2" cy="2" r="2" transform="translate(7)" fill="#010101"/>
                </svg>
              </span>
            </div>
          </div>
        </div>
        <div class="row" style="margin-top: 15px;">
          <div class="col-xs-6" style="padding-right: 7px;">
            <button class="btn btn-sign-up">Join Now</button>
          </div>
          <div class="col-xs-6" style="padding-left: 7px;">
            <button class="btn btn-sign-in">Sign In</button>
          </div>
        </div>
      </div>
    </div> -->
    <div class="profile-section">
      <div class="container">
        <div class="d-flex flex-between align-center">
            <?php
                    $photo = $user->photo->profile_pic;
                    $photo_image = file_exists("upload/" .$photo);
                    if(!empty($photo) && $photo_image) { ?>
                        
                        <img src="<?php echo url::base().'upload/'.$user->photo->profile_pic;?>" class="img-responsive img-profile"width="130" height="130">
                    <?php } else { ?>
                        <div id="inset" style="margin-top: 0px;height: 122px;width: 122px;border-radius: 50%;">
                            <h1 style="font-size: 50px;line-height: 86px;">
                                <?php echo $user->user_detail->get_no_image_name(); ?>
                            </h1>
                            <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                        </div>
                    <?php } ?>
          
          <div class="post-items">
            <h6 class="post-item-top"><?php echo count($posts); ?></h6>
            <span class="post-item-bottom">Post</span>
          </div>
          <div class="post-items">
            <h6 class="post-item-top"><?php echo count($inspires); ?></h6>
            <span class="post-item-bottom">Inspired</span>
          </div>
          <div class="post-items">
            <h6 class="post-item-top"><?php echo $user->inspires->where('status', '=', 1)->count_all() ?></h6>
            <span class="post-item-bottom">Inspires</span>
          </div>
        </div>
        <div class="user-description">
          <h4 class="user-name"> <?php echo $user->user_detail->first_name ." ".$user->user_detail->last_name?></h4>
          <!-- <p>
            Hello I am Ash Shrivastav! I post everyday! I love Facebook , Instagram,Pinterest, and You guys..
            <span id="description-more">Hello I am Ash Shrivastav! I post everyday! I love Facebook , Instagram,Pinterest, and You guys <a href="">less</a></span> 

            <a href="#description-more">more</a>
          </p> -->
          <p class="about"><?php echo $user->user_detail->about; ?></p>
          <div class="d-flex flex-between align-center">
              <?php 
                            $inspire_count = ORM::factory('inspire')
                                ->where('user_id', '=', $user->id)
                                ->where('status', '=', 1)
                                ->count_all();
                        ?>
                        <?php if(isset($session_user->id)) { ?>
                            <?php 
                                $inspire = ORM::factory('inspire')
                                    ->where('user_id', '=', $user->id)
                                    ->where('user_by', '=', $session_user->id)
                                    ->where('status', '=', 1)
                                    ->find();
                            ?>

                            <form class="inspire-form" action="<?php echo url::base()."members/inspire"?>" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $user->id;?>"/>
                                <input type="hidden" id="inspire-status" value="<?php echo ($inspire->id) ? 1 : 0;?>"/>

                                <img src="<?php echo url::base() . "img/ajax-loader.gif" ?>" class="inspire-loading" style="display:none;"/>
                                <span class="inspire-button-wrapper">
                                    <span class="inspire-text inspire-submit-button">
                                        <?php if($inspire->id) { ?>
                                           <!--  <i class="fa fa-thumbs-up text-success"></i> -->
                                            <span class="text-success">Inspired</span>
                                        <?php } else { ?>
                                           <!--  <i class="fa fa-thumbs-o-up"></i> -->
                                            <span>Get Inspired</span>
                                        <?php } ?>
                                    </span>
                                    <span class="inspire-count inspire-list-popup" href="<?php echo url::base()."ajax/get_inspire_list?public=".$user->username; ?>" popup-modal="#genericPopup" popup-title="People who got inspired by <?php echo $user->user_detail->get_name(); ?>"><?php echo $inspire_count; ?></span>
                                </span>
                            </form>
                        <?php } else { ?>
                            <a href="<?php echo url::base(); ?>login?page=public/<?php echo $user->username; ?>"   class="btn btn-get-inspired">
                               Get Inspired
                            </a>
                        <?php } ?>

            <a href="<?php echo url::base(); ?>login?page=public/<?php echo $user->username; ?>"   class="btn-chat">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                <path id="Shape" d="M14,9.333a1.556,1.556,0,0,1-1.556,1.556H3.111L0,14V1.556A1.556,1.556,0,0,1,1.556,0H12.444A1.556,1.556,0,0,1,14,1.556Z" transform="translate(1 1)" fill="none" stroke="#9b9b9b" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
              </svg>
            </a>
            <a href="<?php echo url::base(); ?>login?page=public/<?php echo $user->username; ?>"   class="btn-add">
              <svg id="Icon_User_Check" data-name="Icon User Check" xmlns="http://www.w3.org/2000/svg" width="18.524" height="18" viewBox="0 0 18.524 18">
                <rect id="Bounds" width="18" height="18" fill="none" opacity="0"/>
                <g id="Group" transform="translate(1 2)">
                  <path id="Shape" d="M11.266,3.755V3a3,3,0,0,0-3-3H3A3,3,0,0,0,0,3v.751" transform="translate(0 9.013)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                  <circle id="Oval" cx="3" cy="3" r="3" stroke-width="2" transform="translate(3 0)" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/>
                  <path id="Shape-2" data-name="Shape" d="M0,0V4.506" transform="translate(14.27 3.755)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                  <path id="Shape-3" data-name="Shape" d="M4.506,0H0" transform="translate(12.017 6.009)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                </g>
              </svg>
            </a>
          </div>
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
          <div class="location marLeft10">Lives in <span class="city"><?php echo $user->user_detail->location; ?></span></div>
        </div>
        <div class="d-flex marTop10">
          <svg id="Icon_Book" data-name="Icon Book" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <rect id="Bounds" width="18" height="18" fill="none" opacity="0"/>
            <g id="Group" transform="translate(3 1.5)">
              <path id="Shape" d="M0,1.875A1.875,1.875,0,0,1,1.875,0H12" transform="translate(0 11.25)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
              <path id="Shape-2" data-name="Shape" d="M1.875,0H12V15H1.875A1.875,1.875,0,0,1,0,13.125V1.875A1.875,1.875,0,0,1,1.875,0Z" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
            </g>
          </svg>
          <div class="study marLeft10">Went to <span class="university"><?php echo $user->user_detail->education; ?></span></div>
        </div>
       <!--  <div class="d-flex marTop10">
          <svg xmlns="http://www.w3.org/2000/svg" width="18.5" height="18" viewBox="0 0 18.5 18">
            <g id="Icon_Users" data-name="Icon Users" transform="translate(0.25)">
              <rect id="Bounds" width="18" height="18" fill="none" opacity="0"/>
              <g id="Group" transform="translate(0.75 2.25)">
                <path id="Shape" d="M12,4.5V3A3,3,0,0,0,9,0H3A3,3,0,0,0,0,3V4.5" transform="translate(0 9)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                <circle id="Oval" cx="3" cy="3" r="3" stroke-width="2" transform="translate(3)" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" fill="none"/>
                <path id="Shape-2" data-name="Shape" d="M2.25,4.4V2.9A3,3,0,0,0,0,0" transform="translate(14.25 9.097)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                <path id="Shape-3" data-name="Shape" d="M0,0A3,3,0,0,1,2.256,2.906,3,3,0,0,1,0,5.813" transform="translate(11.25 0.097)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
              </g>
            </g>
          </svg> -->
          <!-- <div class="marLeft10 friends">140 Friends - 5 Mutual Friends</div> -->
        <!-- </div> -->
        <div class="d-flex marTop10">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
            <g id="Icon_Link" data-name="Icon Link" transform="translate(-2.056 -2.066)">
              <g id="Group" transform="translate(3 3)">
                <path id="Shape" d="M0,10.145a4.639,4.639,0,0,0,7,.5L9.779,7.862A4.639,4.639,0,0,0,3.22,1.3l-1.6,1.587" transform="translate(6.975 0.066)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                <path id="Shape-2" data-name="Shape" d="M11.082,1.86a4.639,4.639,0,0,0-7-.5L1.3,4.143a4.639,4.639,0,0,0,6.56,6.56L9.449,9.116" transform="translate(0.056 6.061)" fill="none" stroke="#8991a0" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
              </g>
            </g>
          </svg>
          <a class="marLeft10 profile-link" href="https://<?php echo $user->user_detail->website; ?>" target="_blank"><?php echo $user->user_detail->website; ?></a>
        </div>
      </div>
    </div>
    <ul class="profile-tabs marTop10">
            <li><a href="#post" class="active">Post</a></li>
            <li><a href="#inspiration">Inspiration</a></li>
            <li><a href="#reviews" >Reviews</a></li>
            <li><a href="#about" >About</a></li>
        </ul>
         <div id="post" class="active">
           <div class="post-inner">
              <div class="container" style="padding:0px 5px; ">
                <div class="row" style="margin:7px -6px;">
                  
                    <?php
                                      foreach ($posts as $post) {
                                        ?>
                                         <div class="col-xs-4 " style="padding:1px;margin-left: auto;margin-right: auto;">
                                         <!-- onclick=openPostDialog(<?php echo $post['id']?>)  -->
                                           <div class="gallery-item" tabindex="0" >
                                           <!-- <div class="gallery-imager text-center"> -->
                                      
                                       <!--  <div class="gallery">
                                        <div class="gallery-item" tabindex="0"> -->
                                        <a href="<?php echo url::base()."post/".md5(sha1($post['id']));?>" style="font-weight: 300;">
                                             <?php
                                                if($post['photo']){
                                                    ?>
                                                        <img src="<?php echo $post['photo'] ;?>" class="img-responsive post-img" width="100%" height="108px">
                                                    <?php
                                                }
                                                else{
                                                  
                                                    ?>
                                                     <div class="img-gradient">
             <span class="item-text">
                  <?php

                                                          $photo = $user->photo->profile_pic;
                                                          $photo_image = file_exists("upload/" .$photo);

                                                          echo $post['post'];

                                                         ?>
             </span>
            </div> 
                                                   
                                                    <?php
                                                
                                                }
                                             
                                             ?>
</a>
                                      </div>
                                    </div>
                                        <div id="postModal<?php echo $post['id']?>" class="modal" style="z-index: 999;">

                                          <!-- Modal content -->
                                            <div class="modal-content" style="width: 100%;height: 100%">
                                              <div class="row">
                                             
                                              
                                              <div class="modal-body">
                                                   <div class="col-xs-3">
                                                  <center>
                                                    <div id="imagetilles">
                                                      <?php
                                                        $photo = $user->photo->profile_pic;
                                                        $photo_image = file_exists("upload/" .$photo);
                                                        if(!empty($photo) && $photo_image) { ?>
                                                          <img src="<?php echo url::base().'upload/'.$user->photo->profile_pic;?>" height="100%">
                                                          <?php 
                                                        } else { ?>
                                                          <div id="inset" style="margin-top: 0px;height: 75px;margin-top: -20px;">
                                                              <h1 style="font-size: 27px;line-height: 68px;">
                                                                  <?php echo $user->user_detail->get_no_image_name(); ?>
                                                              </h1>
                                                          </div>
                                                          <?php 
                                                        } 
                                                      ?>
                                                    </div>
                                                  </center>
                                                </div>
                                              <div class="col-xs-9">
                                                <span class="close pull-right" onclick=closeModal(<?php echo $post['id']?>) style="color: #4e4c4c;opacity: 1;">&times;</span>
                                              </div>
                                                <div class="col-xs-12" style="padding-top: 8px;">
                                                  <p id="" style="font-size: 18px;font-weight: 500;margin-bottom: 10px;">
                                                    <?php

                                                      $photo = $user->photo->profile_pic;
                                                      $photo_image = file_exists("upload/" .$photo);

                                                      echo $post['post'];
                                                    ?>
                                                    <?php
                                                      if($post['photo']){
                                                        ?>
                                                            <img src="<?php echo $post['photo'] ;?>" class="img-responsive img-modal" height="100%" width="100%">
                                                        <?php
                                                      }                                             
                                                    ?>
                                                  </p>                                              
                                                </div>                                     
                                              </div>

                                            </div>
                                          </div>

                                      </div>
                                    <?php
                                  } ?> 
                                  <script>

function openPostDialog(postId){
  $('#postModal'+postId).modal('toggle');
}

function closeModal(postId){
  $('#postModal'+postId).modal('hide');
}

</script>
            
                    
                  
            
                 
                  
                </div>
              </div>
            
            </div>
   
                              
                                
                                
                                <div>
                                 
                                  
                                  
                               </div>
                            </div> 
        
        <div id="inspiration">
            <div class="post-inner">
              <div class="container" style="padding:0px;">
                <div class="row" style="margin:7px -6px;">
                  <?php
                        foreach ($inspires as $inspire) {
                          ?>

                                  <div class="col-xs-4" style="padding: 0px 1px; margin: 1px 0px">
                              
                               
                                  <?php
                                  $photo = $user->photo->profile_pic;
                                  $photo_image = file_exists("upload/" .$photo);
                                  if($inspire['profile_pic'] != 'null' ){
                                    ?>
                                    <a href="<?php echo url::base().$inspire['username']; ?>" class="noname" style="font-size: 12px !important;text-decoration: none;color: #fff;">
                                        
             <div class="bg-img-inspiration" style="background-image: url('<?php echo 'https://www.amygoz.com/mobile/upload/'.$inspire['profile_pic'];?>');">
             <span class="item-text"><?php echo $inspire['first_name'].' '.$inspire['last_name']; ?>
             </span>

            </div>  
            </a>  
                  
                                    <?php
                                  }else{
                                    ?>
                                      <div id="inset" style="margin-top: 0px;margin-top: -19px;height:165;">
                                          <h1 style="font-size: 66px;line-height: 155px;">
                                              <?php echo $user->user_detail->get_no_image_name(); ?>
                                          </h1>
                                          <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                      </div>
                                    <?php
                                  } ?> 
                              
                                
                                
                                <div>
                                 
                                  
                                  
                               </div>
                            </div> 

                          <?php
                        }
                      ?>
                 </div>
                </div>
                
               
              </div>
            
            </div>
            <div id="reviews"> 

                                <div class="box">
                             <div class="col-xs-12">

            <div class="top">
                <?php if(!empty($recommendations)) { ?>
                <div class="">
                    <p class="title" style="font-size: 16px;font-weight: 400;padding: 10px 0px;font-family: GreycliffCF-Regular;"> <?php echo count($recommendations); ?> people say <?php echo $user->user_detail->first_name ." ".$user->user_detail->last_name?> is <i class="fa fa-chevron-down pull-right"></i></p>
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
                 </div>
            </div></div>
        <div id="about">
 <div class="container">
          <h6 class="about-h">About Me</h6>
          <p class="abt-value"><?php echo $user->user_detail->about; ?></p>

        </div>
          <div class="divider-about"></div>
          <!-- <div class="container"> -->
         <!--    <h5 class="friends-h">Friends <a href=""><svg id="Icon_List-arrow" data-name="Icon List-arrow" xmlns="http://www.w3.org/2000/svg" width="12" height="24" viewBox="0 0 12 24">
  <rect id="Bounds" width="12" height="24" fill="none" opacity="0"/>
  <path id="Shape" d="M0,10,5,5,0,0" transform="translate(6 7)" fill="none" stroke="#cfd4dd" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
</svg>
</a> <span>167K </span></h5>
          </div>
          <div class="divider-about"></div> -->
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
<!-- main content -->
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

</div>
<div class="clearfix"></div>

       <script>
           $(function(){
$('a[title]').tooltip();
});

       </script>    

<?php 
        if($user->profile_private!=1) {?>

            <?php if($user->user_detail->about_private!=1) {?>

            <?php }?>


        <?php } ?>

<style type="text/css">

<style type="text/css">

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 98%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}


/*add instagram css*/
.btn {
    display: inline-block;
    font: inherit;
    background: none;
    border: none;
    color: inherit;
    padding: 0;
    cursor: pointer;
}

.btn:focus {
    outline: 0.5rem auto #4d90fe;
}

.visually-hidden {
    position: absolute !important;
    height: 1px;
    width: 1px;
    overflow: hidden;
    clip: rect(1px, 1px, 1px, 1px);
}

/* Profile Section */

.profile {
    padding: 5rem 0;
}

.profile::after {
    content: "";
    display: block;
    clear: both;
}

.profile-image {
    float: left;
    width: calc(33.333% - 1rem);
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 3rem;
}

.profile-image img {
    border-radius: 50%;
}

.profile-user-settings,
.profile-stats,
.profile-bio {
    float: left;
    width: calc(66.666% - 2rem);
}

.profile-user-settings {
    margin-top: 1.1rem;
}

.profile-user-name {
    display: inline-block;
    font-size: 3.2rem;
    font-weight: 300;
}

.profile-edit-btn {
    font-size: 1.4rem;
    line-height: 1.8;
    border: 0.1rem solid #dbdbdb;
    border-radius: 0.3rem;
    padding: 0 2.4rem;
    margin-left: 2rem;
}

.profile-settings-btn {
    font-size: 2rem;
    margin-left: 1rem;
}

.profile-stats {
    margin-top: 2.3rem;
}

.profile-stats li {
    display: inline-block;
    font-size: 1.6rem;
    line-height: 1.5;
    margin-right: 4rem;
    cursor: pointer;
}

.profile-stats li:last-of-type {
    margin-right: 0;
}

.profile-bio {
    font-size: 1.6rem;
    font-weight: 400;
    line-height: 1.5;
    margin-top: 2.3rem;
}

.profile-real-name,
.profile-stat-count,
.profile-edit-btn {
    font-weight: 600;
}

/* Gallery Section */

.gallery {
    display: flex;
    flex-wrap: wrap;
    margin: -1rem -1rem;
    padding-bottom: 3rem;
}

.gallery-item {
    position: relative;
    flex: 1 0 22rem;
    margin: 0.2rem;
    color: #fff;
    cursor: pointer;
}

.gallery-item:hover .gallery-item-info,
.gallery-item:focus .gallery-item-info {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
}

.gallery-item-info {
    display: none;
}

.gallery-item-info li {
    display: inline-block;
    font-size: 1.7rem;
    font-weight: 600;
}

.gallery-item-likes {
    margin-right: 2.2rem;
}

.gallery-item-type {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 2.5rem;
    text-shadow: 0.2rem 0.2rem 0.2rem rgba(0, 0, 0, 0.1);
}

.fa-clone,
.fa-comment {
    transform: rotateY(180deg);
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    max-height: 128px;
}

.gallery-imager {
    width: 100%;
    height: auto;
    object-fit: cover;
    max-height: 128px;
}
/* Loader */

.loader {
    width: 5rem;
    height: 5rem;
    border: 0.6rem solid #999;
    border-bottom-color: transparent;
    border-radius: 50%;
    margin: 0 auto;
    animation: loader 500ms linear infinite;
}

/* Media Query */

@media screen and (max-width: 40rem) {
    .profile {
        display: flex;
        flex-wrap: wrap;
        padding: 4rem 0;
    }

    .profile::after {
        display: none;
    }

    .profile-image,
    .profile-user-settings,
    .profile-bio,
    .profile-stats {
        float: none;
        width: auto;
    }

    .profile-image img {
        width: 7.7rem;
    }

    .profile-user-settings {
        flex-basis: calc(100% - 10.7rem);
        display: flex;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .profile-user-name {
        font-size: 2.2rem;
    }

    .profile-edit-btn {
        order: 1;
        padding: 0;
        text-align: center;
        margin-top: 1rem;
    }

    .profile-edit-btn {
        margin-left: 0;
    }

    .profile-bio {
        font-size: 1.4rem;
        margin-top: 1.5rem;
    }

    .profile-edit-btn,
    .profile-bio,
    .profile-stats {
        flex-basis: 100%;
    }

    .profile-stats {
        order: 1;
        margin-top: 1.5rem;
    }

    .profile-stats ul {
        display: flex;
        text-align: center;
        padding: 1.2rem 0;
        border-top: 0.1rem solid #dadada;
        border-bottom: 0.1rem solid #dadada;
    }

    .profile-stats li {
        font-size: 1.4rem;
        flex: 1;
        margin: 0;
    }

    .profile-stat-count {
        display: block;
    }
}

/* Spinner Animation */

@keyframes loader {
    to {
        transform: rotate(360deg);
    }
}

/*

The following code will only run if your browser supports CSS grid.

Remove or comment-out the code block below to see how the browser will fall-back to flexbox & floated styling. 

*/

@supports (display: grid) {
    .profile {
        display: grid;
        grid-template-columns: 1fr 2fr;
        grid-template-rows: repeat(3, auto);
        grid-column-gap: 3rem;
        align-items: center;
    }

    .profile-image {
        grid-row: 1 / -1;
    }

    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(12rem, 1fr));
        grid-gap: 0.2rem;
    }

    .profile-image,
    .profile-user-settings,
    .profile-stats,
    .profile-bio,
    .gallery-item,
    .gallery {
        width: auto;
        margin: 0;
    }

    @media (max-width: 40rem) {
        .profile {
            grid-template-columns: auto 1fr;
            grid-row-gap: 1.5rem;
        }

        .profile-image {
            grid-row: 1 / 2;
        }

        .profile-user-settings {
            display: grid;
            grid-template-columns: auto 1fr;
            grid-gap: 0.2rem;
        }

        .profile-edit-btn,
        .profile-stats,
        .profile-bio {
            grid-column: 1 / -1;
        }

        .profile-user-settings,
        .profile-edit-btn,
        .profile-settings-btn,
        .profile-bio,
        .profile-stats {
            margin: 0;
        }
    }
}

/*end css*/
#imagebetter{
    width: 155px;
    height: 155px;
    background-position: center center;
    background-size: cover;
    display: inline-block;
    /*margin-top: 6px;*/
    position: relative;
    overflow: hidden;
    word-wrap:break-word;
    text-overflow: ellipsis;
    overflow: hidden;
    text-align: center;
    background: #f06163;
    box-shadow: 0px 0px 2px black;
    border: 4px solid #fff;
}

#imagetilles {

    width: 68px;
    height: 68px;
    background-position: center center;
    background-size: cover;
    display: inline-block;
    margin-top: 5px;
    position: relative;
    overflow: hidden;
    background-color: #fff;
    border-radius: 50%;

}
.col-xs-6{
    /*padding-right: 0px;
    padding-left:0px; */
}

#imagerather {
    width: 122px;
    height: 122px;
    background-position: center center;
    background-size: cover;
    display: inline-block;
    margin-top: 6px;
    position: relative;
    overflow: hidden;
    background-color: white;
    border-radius: 50%;
    border: 3px solid #f0616399;
    box-shadow: 0px 0px 7px 5px #f0616399;
}


.col-xs-4{
   /* padding-left: 0px;
    padding-right: 0px;*/
}
.pos-rl{
    position: relative;
    bottom: 5px;
}
.spn-text{
color: black;
position: relative;
font-size: 22px;
font-weight: 600;
/*right: 11px;*/
}

.spn-text1{
    background: #f63819;
     padding: 2px;
    border-radius: 7px;
    color: #fff;
    position: relative;
    bottom: 11px;
    font-size: 11px;
    font-weight: 600;
    left: 3px;
}

@import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700);
/* written by riliwan balogun http://www.facebook.com/riliwan.rabo*/
.board{
    width: 75%; 
height: 500px;
background: #fff;
/*border-top: 1px solid #ddd;*/
/*box-shadow: 10px 10px #ccc,-10px 20px #ddd;*/
}
.board .nav-tabs {
    position: relative;
    /* border-bottom: 0; */
    /* width: 80%; */
    margin-bottom: 0;
    box-sizing: border-box;

}

.board > div.board-inner{
/*border: 1px solid red;*/
}

p.narrow{
    width: 60%;
    margin: 10px auto;
}

.liner{
    height: 1px;
    background: #ddd;
    position: absolute;
    width: 100%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    /* background-color: #ffffff; */
    border: 0;
    border-bottom-color: transparent;
}

span.round-tabs{
    width: 35px;
    height: 35px;
    line-height: 70px;
    display: inline-block;
    border-radius: 5px;
    background: white;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}

span.round-tabs.one{
    color: rgb(0, 0, 0);border: 1px solid rgb(0, 0, 0);
}

li.active span.round-tabs.one{
    background: #fff !important;
    border: 3px solid #151414;
    color: rgb(34, 194, 34);
}

span.round-tabs.two{
    color: #febe29;border: 1px solid #000;
}

li.active span.round-tabs.two{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #febe29;
}

span.round-tabs.three{
    color: #3e5e9a;border: 1px solid #000;
}

li.active span.round-tabs.three{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #3e5e9a;
}

span.round-tabs.four{
    color: #f1685e;border: 1px solid #000;
}

li.active span.round-tabs.four{
    background: #fff !important;
    border: 3px solid #141313;
    color: #f1685e;
}

span.round-tabs.five{
    color: #999;border: 1px solid #000;
}

li.active span.round-tabs.five{
    background: #fff !important;
    border: 3px solid #1b1a1a;
    color: #999;
}

.nav-tabs > li.active > a span.round-tabs{
    background: #fafafa;
}
.nav-tabs > li {
    width: 25%;
}
/*li.active:before {
    content: " ";
    position: absolute;
    left: 45%;
    opacity:0;
    margin: 0 auto;
    bottom: -2px;
    border: 10px solid transparent;
    border-bottom-color: #fff;
    z-index: 1;
    transition:0.2s ease-in-out;
}*/
.nav-tabs > li:after {
    content: " ";
    position: absolute;
    left: 45%;
   opacity:0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #ddd;
    transition:0.1s ease-in-out;
    
}
.nav-tabs > li.active:after {
    content: " ";

position: absolute;

left: 45%;

opacity: 1;

margin: 0 auto;

bottom: 0px;

/*border: 20px solid transparent;*/

    border-bottom-color: transparent;

/*border-bottom-color: #b9b6b6;*/
    
}
.nav-tabs > li a{
   width: 70px;
   height: 70px;
   margin: 20px auto;
  /* border-radius: 100%;*/
   padding: 0;
}

.nav-tabs > li a:hover{
    background: transparent;
}

.tab-content{
}
.tab-pane{
   position: relative;
}
.tab-content .head{
    font-family: 'Roboto Condensed', sans-serif;
    font-size: 25px;
    text-transform: uppercase;
    padding-bottom: 10px;
}
.btn-outline-rounded{
    padding: 10px 40px;
    margin: 20px 0;
    border: 2px solid transparent;
    border-radius: 25px;
}

.btn.green{
    background-color:#5cb85c;
    /*border: 2px solid #5cb85c;*/
    color: #ffffff;
}



@media( max-width : 585px ){
    
    .board {
width: 100%;
height:auto !important;
}
    span.round-tabs {
        font-size:16px;
width: 35px;
height: 35px;
line-height: 50px;
    }
    .tab-content .head{
        font-size:20px;
        }
    .nav-tabs > li a {
width: 50px;
height: 50px;
line-height:50px;
}

.nav-tabs > li.active:after {
content: " ";
position: absolute;
left: 35%;
}

.btn-outline-rounded {
    padding:12px 20px;
    }
}


.brd-pad-1
{
    border-top: 1px solid rgba(0, 0, 0, 0.18);
    border-bottom: 1px solid rgba(0, 0, 0, 0.17);
}
.container .box {
  
}

.container .box .top {
  cursor: pointer;
}

.container .box .bottom {
  display: none;
}
#profile .accordion li i.fa-chevron-down {
    right: 12px;
    left: auto;
    font-size: 16px;
}
style.css:1088
#profile .accordion li i {
    position: absolute;
    top: 16px;
    left: 12px;
    font-size: 18px;
    color: #595959;
    -webkit-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease;
}
font-awesome.min.css:4
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.src-image {
  display: none;
}

.col-sm-12.marTop20 {
    margin-top: 45px !important;
}
.list-group-item.col-sm-3.boxpanal {
    margin: width;
    width: 255px;
    margin: 2px;
}
.row.left{ margin-left: 0px; }



.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
}

.card {
  overflow: hidden;
  position: relative;
  border: 1px solid #F9F4F4;
  border-radius: 8px;
  text-align: center;
  padding: 0;
  background-color:#708090;
  color: rgb(136, 172, 217);
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
  background-color:#C4BFBD;
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
#imagePreview {
    width: 252px;
    height: 252px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    overflow: hidden; 
    border: 3px solid white; 
    background-color: white;
    border-radius: 1px !important;   
}
#imagebrageer {
    width: 100px;
    height: 100px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    overflow: hidden;
    border: 3px solid white;
    background-color: white;
}

</style>


        <!--<div class="row marTop10">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading c-list">
                        <span class="title">Most Viewed Profile</span>                
                    </div>
                    <div class="panel-body">
                        <ul class="list-group" id="contact-list">
                            <?php
                                if($friends){

                                $i=0; 
                                foreach($friends as $friend) { 
                                    if($i==5) break;
                            ?>
                            <li class="list-group-item col-sm-3">
                                <div class="col-xs-3">
                                    <div class="row">
                                        <?php if($friend->photo->profile_pic_s) { ?>
                                        <img src="<?php echo url::base()."upload/".$friend->photo->profile_pic_s;?>" alt="<?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?>" width="100%" class="img-thumbnail">
                                        <?php } else { ?>
                                            <div id="inset" class="xs noMar">
                                                <h1>
                                                    <?php echo $friend->user_detail->get_no_image_name(); ?>
                                                </h1>
                                            </div>
                                        <?php } ?>
                                    </div>                        
                                </div>
                                <div class="col-xs-9">
                                    <span class="name"><a href="<?php echo url::base().$friend->username; ?>"><?php echo $friend->user_detail->first_name." ".$friend->user_detail->last_name; ?></a></span><br/>
                                    <span>
                                        <?php
                                            $details = array();
                                            if(!empty($friend->user_detail->sex)) {
                                                $details[] = $friend->user_detail->sex;
                                            }

                                            if(!empty($friend->user_detail->phase_of_life)) {
                                                $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                                $details[] = $phase_of_life[$friend->user_detail->phase_of_life];
                                            }

                                            echo implode(', ', $details);
                                        ?>
                                    </span>
                                </div>
                            </li>
                            <?php $i++; }} else { ?>
                            <li class="text-center no-friend">
                                <i class="fa fa-frown-o"></i>
                                <span>No Friend Yet</span>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</div>

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
<script>
    $('.top').on('click', function() {
    $parent_box = $(this).closest('.box');
    $parent_box.siblings().find('.bottom').slideUp();
    $parent_box.find('.bottom').slideToggle(1000, 'swing');
});
</script>
