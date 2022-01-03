<?php $session_user = Auth::instance()->get_user();?>
<style type="text/css">
@font-face {
  font-family: GreycliffCF-Bold;
  src: url(../application/views/fonts/GreycliffCF-Bold.otf);
}
@font-face {
  font-family: GreycliffCF-Regular;
  src: url(../application/views/fonts/GreycliffCF-Regular.otf);
}
 @font-face {
  font-family: GreycliffCF-Light;
  src: url(../application/views/fonts/GreycliffCF-Light.otf);
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
.profile-section .post-items h6{font-family:GreycliffCF-Bold;font-size: 16px;margin-bottom: 0px;}
.profile-section .post-items span{font-size: 16px;font-family:GreycliffCF-Regular;}
.user-name{font-size: 20px;font-family:GreycliffCF-Bold;margin-bottom: 5px;}
.profile-section .location,.profile-section .study,.profile-section .study{font-size: 16px;font-family:GreycliffCF-Regular;}
.profile-section .location .city,.profile-section .study .university{
  font-family:GreycliffCF-Bold!important;
}
.profile-section .user-description #description-more{display: none;}
.profile-section .user-description #description-more:target{display: block;}
.btn-get-inspired{background-color: #FF5A5F;width: 248px; height: 36px;color:#fff;border-radius: 20px;font-size: 15px;display: block;text-align: center;}
.btn-review{margin: 0 auto!important;background-color: #FF5A5F;width: 248px; height: 36px;color:#fff;border-radius: 20px;font-size: 15px;display: block;text-align: center;}
.btn-get-inspired.padding-btn{padding: 8px 22px;}
.marTop10{margin-top: 10px;}
.profile-section .user-description button:focus{outline: none;}
.btn-chat,.btn-add{background: transparent; border:2px solid #F1F2F4!important; border-radius: 50%;width: 36px;height: 36px;line-height: 2.2!important; padding-left: 8px;}
.profile-section .location,.profile-section .study,.profile-section .friends{font-size: 16px}
.profile-section .profile-link{font-size: 15px;color: #00BCD4}
.profile-tabs{border-bottom:1px solid #F1F2F4;margin-bottom: 0px;padding-bottom: 10px;background-color: #fff;display: flex;justify-content: space-around;list-style-type: none;padding: 0;margin-left: -15px;margin-right: -15px;}
.profile-tabs li{width:100%;text-align: center;}
.profile-tabs li a{font-size: 14px;display: block;padding: 10px 0;border-bottom: 2px solid transparent;text-decoration: none;font-family:GreycliffCF-Bold;color: #8991A0;}
.profile-tabs li a.active{color: #FF5A5F;border-bottom: 2px solid #FF5A5F}
.img-gradient{background-image: linear-gradient(#FF585D, #FB947F);height: 120px;width: 100%;border-radius: 2px;}
.post-inner .item-text{font-size: 10px;display: inline-block;color: #fff;padding: 20px 10px}
.post-inner:after{clear: both;content: '';display: block;width: 100%}
.post-img{border-radius: 2px;margin-left: auto;margin-right: auto;height: 120px;object-fit: cover;}
.btn-edit-profile{background-color: #F1F2F4!important;width: 100%; height: 36px;color:#010101!important;border-radius: 20px;font-size: 15px;border:1px solid #DCE1EA!important;}
.friends a{color: #00BCD4;}
.user-description .about{font-family:GreycliffCF-Regular;}
.btn-edit-profile a{text-decoration: none;color:#010101!important;}
.bg-img-inspiration{height: 120px;position: relative;background-size: cover;width: 100%;border-radius: 2px!important;}
.bg-img-inspiration:after{content: "";position: absolute;background-color: rgba(0,0,0, 0.2);width: 100%;height: 100%;border-radius: 4px!important;}
.bg-img-inspiration .item-text{ bottom: -11px!important;z-index:100;left:-2px!important;position: absolute;width: 100%;font-size: 12px;display: inline-block;color: #fff;}
.btn-sign-up{background-color: #FF5A5F!important;width: 100%; height: 36px;color:#fff!important;border-radius: 20px;font-size: 15px}
.btn-sign-in{background-color: #F1F2F4!important;width: 100%; height: 36px;color:#010101!important;border-radius: 20px;font-size: 15px;}
.marLeft10{margin-left: 10px;}
#inspiration,#post,#reviews,#about{display: none;margin-right: -15px;margin-left: -15px;}
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
/*new code */
#imagerather{
    box-shadow: none!important;
    border-width: 0px!important;
}
#imagerather img{
    width: 130px!important;
    height: 130px!important;
    object-fit: cover!important;
}
.d-flex.flex-between.align-center{
    height: 160px;
}
.btn-xs, .btn-designed{
    padding: 0!important;
}
.inspire-button-wrapper,  .btn-xs{
    border-radius: 20px!important;
}
/*reviews*/
.btn-badge{
     border-radius: 30px;
    margin-right: 3px;
    padding: 10px 16px!important;
    background-color:#00BCD4!important;
    margin-top: 8px;
    font-size: 14px!important;
    font-family:GreycliffCF-Regular;
    color: #fff;
}
#badge_Sweet,#badge_Joyful,#badge_Intelligent,#badge_Friendly,#badge_Optimist,#badge_Religious,#badge_Pleasing,#badge_Generous,#badge_Egotistical,#badge_Funny,#badge_Sympathetic,#badge_Bossy{
  border-radius: 30px;
    margin-right: 3px;
    padding: 3px 16px;
    background-image: linear-gradient(to bottom, #FD5B5F, #FB907D);
    margin-top: 8px;
    font-size: 14px!important;
    font-family:GreycliffCF-Regular;
    color: #fff;
}
#badge_Social,#badge_Respectful,#badge_Leader,#badge_Sensitive,#badge_Smart,#badge_Mean,#badge_Negotiator,#badge_Courteous,#badge_Courageous,#badge_Considerate{
  border-radius: 30px;
    margin-right: 3px;
    padding: 3px 16px;
    background-color:#00BCD4;
    margin-top: 8px;
    font-size: 14px!important;
    font-family:GreycliffCF-Regular;
    color: #fff;
}
#badge_Honest,#badge_Thoughtful,#badge_Charismatic,#badge_Charming,#badge_Competent,#badge_Materialistic,#badge_Ambitious,#badge_Affectionate,#badge_Dependable,#badge_Lazy{
  border-radius: 30px;
    margin-right: 3px;
    padding: 3px 16px;
    background-image: linear-gradient(to bottom, #FD935B, #FBC27D);
    margin-top: 8px;
    font-size: 14px!important;
    font-family:GreycliffCF-Regular;
    color: #fff;
}
.brager{
    padding-top: 20px!important;
}
  .active{display: block!important;background-color: #ffffff;}

.post-item-top{
    font-size: 16px!important;
    font-family:GreycliffCF-Bold;
}
.post-item-bottom {
    font-family:GreycliffCF-Regular;
}
.bg-white{
    background: #fff;
}
</style>
<?php 
    $inspire_count = ORM::factory('inspire')
        ->where('user_id', '=', $user->id)
        ->where('status', '=', 1)
        ->count_all();
?>
<div class="bg-white">
<div class="main-content container" style="padding-bottom: 50px;">
<div class="container">
    <div class="row">
        <div class="profile-section">
        <div class="row">
            <div class="col-xs-5">
                <?php if (Auth::instance()->logged_in('admin')) { ?>
                    <div class="col-md-3 col-xs-10" style="padding-right:0px">
                        <form  enctype="multipart/form-data" action="https://m.amygoz.com/pp/upload_pic" method="POST">
                            <input class="input_pp" name="picture" onchange="readURL(this);" type="file" style="display:none;">
                            <input type="hidden" name="name" value="1">
                            <input type="hidden" name="username" value="<?php echo $user->username; ?>">
                            <label for="file-upload"  style="margin-bottom:-100px;margin-left:180px;position: relative;right: 131px;top: 43px;" class="btn uploadProPic btn-primary">
                            <i class="glyphicon glyphicon-camera"></i>
                            </label>
                        </form>
                    </div>
                <?php } ?>
                
                <div id="imagerather" style="margin-top: 19px;margin-bottom:15px;">
                    <?php
                    $photo = $user->photo->profile_pic;
                    $photo_image = file_exists("upload/" . $photo);
                    if (!empty($photo) && $photo_image) {
                    ?>
                        <img src="<?php echo url::base() . 'upload/' . $user->photo->profile_pic; ?>" height="100%"  class="gallery-image">
                    <?php } else { ?>
                        <div id="inset" style="margin-top: 0px;height: 122px;margin-top: -20px;">
                            <h1 style="font-size: 50px;line-height: 117px;">
                                <?php echo $user->user_detail->get_no_image_name(); ?>
                            </h1>

                        </div>
                    <?php } ?>
                </div>
                
               
            </div>

            <div class="col-xs-7" style="margin-top: -2px;">
                <div class="d-flex flex-between align-center">
                    <div class="post-items">
                        <h6 class="post-item-top"><?php echo count($posts); ?></h6>
                        <span class="post-item-bottom">Posts</span>
                    </div>
                    <div class="post-items">
                        <h6 class="post-item-top"> <?php echo count($inspires); ?></h6>
                        <span class="post-item-bottom">Inspires</span>
                    </div>
                    <div class="post-items">
                        <h6 class="post-item-top"> <?php echo $inspire_count; ?> </h6>
                        <span class="post-item-bottom">Inspired</span>
                    </div>
                </div>
            </div>
        </div>
         <span class="user-name" style="font-size: 18px;color: #0e0d0d;font-weight:500;">
                    <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name ?>
                </span>
                <div class="mad-angle">
                    <span class="user-name" style="font-size: 15px !important;color: #717070 !important;font-weight:500;">
                    <?php $data_p = $user->user_detail->designation; ?>
                    <?php
                    $data_ps = explode(',', $data_p);
                    foreach ($data_ps as $tag) {
                        ?>
                        <?php echo '<a class="btn icon-btn btn-designed btn-transparent btn-md marBottom5" href="#" style="font-size: 15px !important;color: #717070 !important;font-weight:500;"><i class="fa fa-certificate" aria-hidden="true"></i>
                                 ' . $tag . '</a>' ?>
                    <?php }
                    ?>
                    <?php if (Auth::instance()->logged_in('admin')) { ?>
                      <a data-toggle="modal" href="#editBasicInfo" class="btn icon-btn btn-transparent btn-md btn-designed marBottom5" style="font-size: 15px !important;color: #717070 !important;font-weight:500;">
                        <!-- <span class="badge"> --><i class="fa fa-certificate" aria-hidden="true"></i>
                        <!-- </span> --> Update Info
                    </a>
                   <?php } ?>
                   </span>
                </div>
        </div>
        <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
            <div class="col-xs-6 text-center">
                <div class="wrapper">                    
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
                            <span class="inspire-button-wrapper btn-get-inspired <?php if($inspire->id) { ?>already-inspired<?php } ?>">
                                <span class="inspire-text inspire-submit-button">
                                    <?php if($inspire->id) { ?>
                                        <!--<i class="fa fa-thumbs-up text-success"></i>-->
                                        <span>Inspired</span>
                                    <?php } else { ?>
                                        <!-- <i class="fa fa-thumbs-o-up"></i> -->
                                        <span>Get Inspired</span>
                                    <?php } ?>
                                </span>
                                <span class="inspire-count inspire-list-popup" href="<?php echo url::base()."ajax/get_inspire_list?public=".$user->username; ?>" popup-modal="#genericPopup" popup-title="People who got inspired by <?php echo $user->user_detail->get_name(); ?>"><?php echo $inspire_count; ?></span>
                            </span>
                        </form>
                    <?php } else { ?>
                        <a href="<?php echo url::base(); ?>login?page=public/<?php echo $user->username; ?>" class="btn-primary btn btn-labeled marginVertical btn-xs" style="border: 1px solid #f06163;padding: 1px 28px;border-radius: 5px;font-size: 15px;color: #fff !important;text-decoration: none;font-weight: 500;background: #f06163;">
                            <span class="inspire-button-wrapper btn-get-inspired">
                                <span class="inspire-text">
                                    <span>Get Inspired</span>
                                </span>
                                <span class="inspire-count" style="top:0px;"><?php echo $inspire_count; ?></span>
                            </span>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>

        </div>
            
   
                              
                                
                            
                            </div> 
                             <ul class="profile-tabs marTop10">
            <li><a href="#post" class="active">Posts</a></li>
            <li><a href="#inspiration">Inspiration</a></li>
            <li><a href="#reviews" >Reviews</a></li>
            <li><a href="#about" >About</a></li>
        </ul>
<div id="post" class="active">
           <div class="post-inner">
           
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
                     <div id="inspiration">
            <div class="post-inner">
              <div class="container" style="padding:0px;">
                <div class="row" style="margin:7px -6px;">
                
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
              <?php if(Auth::instance()->logged_in()) {
            $ds = ORM::factory('recommend', array('from' => $session_user->id, 'to' => $user->id));
            if(!$ds->id) { ?>
                <div class="text-center">
                    <h5 class="brager">
                        What you think about 
                        <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?>.?
                    </h5>
                    <a href="<?php echo url::base()."review/$user->username";?>" class="btn-bg btn-review btn" style="background: #f06163;border: none;box-shadow: none;border-radius: 40px;padding: 9px 10px;color: #fff;">
                        <!-- <img src="https://www.amygoz.com/mobile-test/img/review-icon.png" alt="" class="img-responsive" style="margin: 0px auto;width: 36px;float: left;"> --> Review 
                            </a>
                </div>
            <?php } ?>    
        <?php } else { ?>
            <div class="text-center">
                <h5 class="brager">
                    What you think about 
                    <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?>.?
                </h5>
                <a href="<?php echo url::base()."review/$user->username";?>" class="btn-bg btn-review btn" style="background: #f06163;border: none;box-shadow: none;border-radius: 40px;padding: 9px 10px;color: #fff;">
                    <!-- <img src="https://www.amygoz.com/mobile-test/img/review-icon.png" alt="" class="img-responsive" style="margin: 0px auto;width: 36px;float: left;"> --> Review
                </a>
            </div>
       <?php } ?> 
            </div>      

      
                 </div>
            </div>
            <div id="about">
                <div class="box">
                    <div class="col-xs-12" > 
                        <div class="top">
                            <div class="">
                                <p class="title" style="font-size: 16px;font-weight: 400;margin-top:10px;color: #3e3e3e;">Profession <i class="fa fa-chevron-down pull-right"></i></p>
                            </div>
                        </div>
                        <div class="bottom">
                            <div class="">
                                <?php $data_p = $user->user_detail->designation; ?>
                                <?php
                                $data_ps = explode(',', $data_p);
                                foreach ($data_ps as $tag) {
                                ?>
                                    <?php echo '<a class="btn icon-btn btn-transparent btn-badge btn-md marBottom5" href="#"><span class="badge"><i class="glyphicon glyphicon-ok"></i></span> ' . $tag . '</a>' ?>
                                <?php } ?>
                                <?php if (Auth::instance()->logged_in('admin')) { ?>
                                    <a data-toggle="modal" href="#editBasicInfo" class="btn btn-badge icon-btn btn-transparent btn-md marBottom5">
                                        <span class="badge"><i class="glyphicon glyphicon-ok"></i></span> Update Info
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--start tabs-->
       <!--  <div class="row">
            <div class="row">
                <div class="board">
                    <div class="board-inner">
                        <ul class="nav nav-tabs" id="myTab" style="border: none !important;">
                            <li class="active">
                                <a href="#home" data-toggle="tab" title="Posts">
                                    <span class="round-tabs one">
                                        <img class="img-responsive" src="<?php echo url::base(); ?>img/insert-picture-icon.png" alt="Posts" style="width: 20px;margin: 0px auto;line-height: 50px;top: 5px;position: relative;"/>
                                    </span> 
                                </a>
                            </li>

                            <li>
                                <a href="#doner" data-toggle="tab" title="Reviewed">
                                    <span class="round-tabs five">
                                        <img class="img-responsive" src="<?php echo url::base(); ?>img/review-icon.png" alt="Reviewed" style="width: 20px;margin: 0px auto;line-height: 50px;top: 4px;position: relative;"/>
                                    </span> 
                                </a>
                            </li>

                            <li>
                                <a href="#about" data-toggle="tab" title="About">
                                    <span class="round-tabs five"> 
                                        <img class="img-responsive" src="<?php echo url::base(); ?>img/info.png" alt="Reviewed" style="width: 21px;margin: 0px auto;line-height: 50px;top: 4px;position: relative;"/>
                                    </span> 
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home">
                            <div class="container marBottom20">
                                <div class="col-md-12">
                                    <?php 
                                        $inspires = ORM::factory('inspire')
                                            ->where('user_id', '=', $user->id)
                                            ->where('status', '=', 1)
                                            ->order_by('time', 'desc')
                                            ->find_all()
                                            ->as_array();
                                    ?>
                                    
                                    <?php foreach($inspires as $insp) { ?>
                                        <?php $by = $insp->by; ?>
                                        <div class="post row" style="margin-top: 5px;padding-top:5px;border-top: 1px solid rgba(0, 0, 0, 0.06);"> 
                                            <div class="col-xs-3 noPad text-center">
                                                <div class="fileinput-preview" id="imagePreview" style="top: 0px;left: 0px;">
                                                    <a href="<?php echo url::base().$insp->by->username; ?>">
                                                        <?php if($by->photo->profile_pic_s) { ?>
                                                            <img src="<?php echo url::base()."upload/".$by->photo->profile_pic;?>" alt="<?php echo $by->user_detail->get_name();?>" height="100%" class="gallery-image">
                                                        <?php } else { ?>
                                                            <div id="inset" class="xs noMar" style="margin-top: 0px;">
                                                                <h1>
                                                                    <?php echo $by->user_detail->get_no_image_name();?>
                                                                </h1>
                                                            </div>
                                                        <?php } ?>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-xs-9 noPad">
                                                <strong>
                                                    <a href="<?php echo url::base().$insp->by->username; ?>" style="font-size: 14px !important;">
                                                        <?php echo $by->user_detail->get_name();?>
                                                    </a>
                                                </strong>
                                                <span>
                                                    is inspired by <?php echo $user->user_detail->get_name();?>.
                                                    <br>
                                                    <span class="post-time-box" style="font-size: 11px;font-weight: 500;">
                                                        <i class="fa fa-clock-o"></i> 
                                                        <input type="hidden" value="<?php echo strtotime($insp->time); ?>" class="post_time">
                                                        <?php $age = time() - strtotime($insp->time);
                                                            if ($age >= 86400) {
                                                                echo date('jS M', strtotime($insp->time));
                                                            } else {
                                                                echo Date::time2string($age);
                                                            }
                                                        ?>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="doner">
                            <div class="container" style="border: 1px solid #e5e5e5;padding: 4px 15px;">
                                <div class="box">
                                    <div class="col-xs-12">
                                        <?php if (!empty($recommendations)) { ?>
                                            <div class="top">
                                                <div class="">
                                                    <h4 class="title" style="font-size: 16px;font-weight: 400;color: #333;"><?php echo count($recommendations); ?> Reviews, people say <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name ?> is
                                                    <i class="fa fa-chevron-down pull-right"></i> </h4>
                                                </div>
                                            </div>
                                            <div class="bottom">
                                                <div class="">
                                                        <?php $tag_count = 0; ?>
                                                        <?php foreach ($tags as $tag => $weight) { ?>
                                                        <?php echo '<a class="btn icon-btn btn-transparent btn-md marBottom5" href="#"><span class="badge">' . $weight . '</span> ' . $tag . '</a>' ?>
                                                        <?php $tag_count++;
                                                    } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="container" style="margin-bottom: 21px; border: 1px solid #e5e5e5;padding:10px 0px;">
                                <div class="box">
                                    <div class="col-xs-12">
                                        <?php if ($user->user_detail->about_private != 1) { ?>
                                            <div class="col-sm-12 marTop20">
                                                <?php if ($user->user_detail->about) { ?>
                                                    <div class="row" id="sroll_pan">
                                                        <div class="col-sm-12">
                                                            <div class="top">
                                                                <p class="panel-title" style="font-size: 16px;font-weight: 400;color:  #333;"><span class="glyphicon glyphicon-comment"></span> What people say about  <?php echo $user->user_detail->first_name; ?>
                                                                    <i class="fa fa-chevron-down pull-right"></i> 
                                                                </p>
                                                            </div>
                                                            <div class="bottom">
                                                                <div class="hb-p-0" id="comments">
                                                                    <?php if (!empty($recommends)) { ?>
                                                                    <ul class="list-group hb-m-0">
                                                                        <?php foreach ($recommends as $recommend) { ?>     
                                                                            <li class="list-group-item">
                                                                                <div class="row">
                                                                                    <div class="col-md-3 col-sm-4">
                                                                                        <a href="<?php echo url::base() . $recommend->owner->username; ?>">
                                                                                            <?php if ($recommend->owner->photo->profile_pic_s) { ?>
                                                                                                <img src="<?php echo url::base() . 'upload/' . $recommend->owner->photo->profile_pic_s; ?>"  class="pull-left hb-mr-10" style="width:55px;height:55px; border-radius:50%;">
                                                                                            <?php } else { ?>
                                                                                                <span class="glyphicon glyphicon-user fa-3x" style="width:63px; height:63px;  border-radius:50%;float: left;"></span>
                                                                                            <?php } ?>

                                                                                            <span style="color:#FF2A7F;" class="hb-m-0">
                                                                                                <?php
                                                                                                if ($recommend->owner->user_detail->first_name != '') {
                                                                                                    echo $recommend->owner->user_detail->first_name . " " . $recommend->owner->user_detail->last_name;
                                                                                                } else {
                                                                                                    echo "Anonymous User";
                                                                                                }
                                                                                                ?>
                                                                                            </span>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="col-md-9 col-sm-8">
                                                                                        <div class="collapse-body collapseable collapse in" style="border-top: 0px ;">
                                                                                            <div class="collapse-body-content hb-p-0" style="border-top: 0px ;">
                                                                                                <p class="hb-m-0"><?php echo nl2br($recommend->message); ?></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="post-matter collapse-description collapse collapseable">
                                                                                            <p class="hb-m-0"><?php echo substr($recommend->message, 0, 70); ?>
                                                                                                <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                    <?php } else { ?>
                                                                    <ul class="list-group hb-m-0">
                                                                        <li class="list-group-item text-center">
                                                                            <i class="fa fa-user-secret fa-5x"></i>
                                                                            <h4 style="text-align: center;">No one has reviewed <?php echo $user->user_detail->last_name; ?> yet. Be the first to review </h4>
                                                                            <div class="clearfix marBottom20"></div>
                                                                            <a href="<?php echo url::base()."review/$user->username";?>" class="btn btn-secondary btn-lg marBottom10" data-toggle="" data-target="">
                                                                                Write Review 
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    <?php } ?> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>   
                            </div>
                        </div>
                   
                        <div class="tab-pane fade" id="about">
                            <div class="hb-mt-20 container" style="margin-bottom:20px;">
                                <div class="box">
                                    <div class="col-xs-12" style="border: 1px solid #e5e5e5;padding-top: 10px;"> 
                                        <div class="top">
                                            <div class="">
                                                <p class="title" style="font-size: 16px;font-weight: 400;color: #3e3e3e;">Profession <i class="fa fa-chevron-down pull-right"></i></p>
                                            </div>
                                        </div>
                                        <div class="bottom">
                                            <div class="">
                                                <?php $data_p = $user->user_detail->designation; ?>
                                                <?php
                                                $data_ps = explode(',', $data_p);
                                                foreach ($data_ps as $tag) {
                                                ?>
                                                    <?php echo '<a class="btn icon-btn btn-transparent btn-md marBottom5" href="#"><span class="badge"><i class="glyphicon glyphicon-ok"></i></span> ' . $tag . '</a>' ?>
                                                <?php } ?>
                                                <?php if (Auth::instance()->logged_in('admin')) { ?>
                                                    <a data-toggle="modal" href="#editBasicInfo" class="btn icon-btn btn-transparent btn-md marBottom5">
                                                        <span class="badge"><i class="glyphicon glyphicon-ok"></i></span> Update Info
                                                    </a>
                                               <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xs-12">
            <div class="col-xs-12">
                <?php if (Session::instance()->get('error_pp')) { ?>
                    <div class="alert alert-danger">
                        <strong>ERROR!</strong>
                        <?php echo Session::instance()->get_once('error_pp'); ?>
                    </div>
                <?php } else if (Session::instance()->get('success_pp')) { ?>
                    <div class="alert alert-success">
                        <strong>SUCCESS  !  </strong>
                        <?php echo Session::instance()->get_once('success_pp'); ?>
                    </div>
                <?php } ?>    
                <?php if (Session::instance()->get('s_img')) { ?>
                    <div class="alert alert-success">
                        <strong>ERROR!</strong>
                        <?php echo Session::instance()->get_once('s_img'); ?>
                    </div>
                <?php } ?>      
            </div>
        </div>
    </div>
</div>
</div> -->

<script>
    $(function(){
        $('a[title]').tooltip();
    });  
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
          });
</script>


<script src='<?php echo url::base(); ?>js/jquery.knob.js'></script>
<script>
$(document).ready(function () {
    $('.dial').each(function () {

        var elm = $(this);
        var color = elm.attr("data-fgColor");
        var perc = elm.attr("value");

        elm.knob({
            'value': 0,
            'min': 0,
            'max': 100,
            "skin": "tron",
            "readOnly": true,
            "thickness": .1,
            "dynamicDraw": true,
            "displayInput": false
        });

        $({value: 0}).animate({value: perc}, {
            duration: 1000,
            easing: 'swing',
            progress: function () {
                elm.val(Math.ceil(this.value)).trigger('change')
            }
        });

        //circular progress bar color
        $(this).append(function () {
            elm.parent().parent().find('.circular-bar-content').css('color', color);
            elm.parent().parent().find('.circular-bar-content label').text(perc + '%');
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
<div class="ribbion-modal modal fade" id="editBasicInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <img src="<?php echo url::base(); ?>img/close.png" />
                </button>
                <div class="ribbion">
                    <h2>Profession</h2>
                </div>
                <div class="triangle-l"></div>
                
                <div class="clearfix"></div>
            </div>
            
            <form method="post" action="<?php echo url::base(); ?>pp/edit_public_data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label" for="designation">Designation:</label>
                        <input class="form-control" id="designation" type="text" name="designation" placeholder="What is your job title?" value="<?php echo $user->user_detail->designation; ?>">
                        <input class="hidden" name="user_detail_id" value="<?php echo $user->user_detail_id; ?>">
                        <input class="hidden" name="user_detail_username" value="<?php echo $user->username; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Save changes</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
        
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
