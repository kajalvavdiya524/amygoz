<style type="text/css">
    .profile-pic img{
      height: 130px;  
      width: 130px!important;
      object-fit: cover;
      border-radius: 50%;
    }

    .pp-username{
        font-size: 24px!important;
    }
    .btn-inspire{
        background-color: #FF5A5F;
width:248px;
height: 36px;
color: #fff;
border-radius: 20px;
font-size: 15px;
    }
    .btn-inner{
        padding-top: 5px;
    display: block;
    font-size: 16px;
    }
    .profile-tabs{border-bottom: 1px solid #F1F2F4;margin-bottom: 0px;padding-bottom: 10px;background-color: #fff;display: flex;justify-content: space-around;list-style-type: none;padding: 0;margin: 0 -15px;}
   .profile-tabs li{width:100%;text-align: center;}
   .profile-tabs li a{color: #8991A0;font-size: 14px;display: block;padding: 10px 0;border-bottom: 2px solid transparent;text-decoration: none;}
   .profile-tabs li a.active{color: #FF5A5F;border-width: 0 0 2px 0px!important;border-color:#FF5A5F;border-style: solid;}
   .profile-tabs li a:focus{outline: none;}
      #inspiration,#post,#reviews,#about{display: none;margin-right: -15px;margin-left: -15px;}
   .active{display: block!important;background-color: #ffffff;}
#badge_Sweet,#badge_Joyful,#badge_Intelligent,#badge_Friendly,#badge_Optimist,#badge_Religious,#badge_Pleasing,#badge_Generous,#badge_Egotistical,#badge_Funny,#badge_Sympathetic,#badge_Bossy{
  border-radius: 30px;
    margin-right: 3px;
    padding: 3px 16px;
    background-image: linear-gradient(to bottom, #FD5B5F, #FB907D)!important;
    margin-top: 8px;
    font-size: 14px!important;
    font-family:GreycliffCF-Regular;
    color: #fff!important;
}
#badge_Social,#badge_Respectful,#badge_Leader,#badge_Sensitive,#badge_Smart,#badge_Mean,#badge_Negotiator,#badge_Courteous,#badge_Courageous,#badge_Considerate{
  border-radius: 30px;
    margin-right: 3px;
    padding: 3px 16px;
    background-color:#00BCD4!important;
    margin-top: 8px;
    font-size: 14px!important;
    font-family:GreycliffCF-Regular;
    color: #fff!important;
}
#badge_Honest,#badge_Thoughtful,#badge_Charismatic,#badge_Charming,#badge_Competent,#badge_Materialistic,#badge_Ambitious,#badge_Affectionate,#badge_Dependable,#badge_Lazy{
  border-radius: 30px;
    margin-right: 3px;
    padding: 3px 16px;
    background-image: linear-gradient(to bottom, #FD935B, #FBC27D)!important;
    margin-top: 8px;
    font-size: 14px!important;
    font-family:GreycliffCF-Regular;
    color: #fff!important;
}
.list-group-item{
	border-width: 0!important;
	margin: 0px 20px!important;
}
.comment-user{
	color: #010101!important;
	    margin-top: 20px!important;
    display: inline-block;
}
.list-group.hb-m-0{
	padding: 0 20px;
}
.circular-bar.marTop10{
	margin-top: 46px!important;
}
.px{
	padding: 0 10px;
}
</style>
<?php $session_user = Auth::instance()->get_user();?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<div class="main-content">
    <div class="container">
        <div class="row">
           <div class="row">
            <div class="col-sm-8">
                <div class="profile-pic">
                     <?php if (Auth::instance()->logged_in('admin')) { ?>
                    <div class="col-md-3 col-xs-10" style="padding-right:0px">
                    <form  enctype="multipart/form-data" action="https://www.callitme.com/pp/upload_pic" method="POST">
                        <input class="input_pp" name="picture" onchange="readURL(this);" type="file" style="display:none;">
                        <input type="hidden" name="name" value="1">
                        <input type="hidden" name="username" value="<?php echo $user->username; ?>">
                        <label for="file-upload"  style="margin-bottom:-100px; margin-left:180px;" class="btn uploadProPic btn-primary">
                        <i class="glyphicon glyphicon-camera"></i>
                        </label>
                    </form>
                </div>
                <?php } ?>
                    <?php
                    $photo = $user->photo->profile_pic;
                    $photo_image = file_exists("mobile/upload/" . $photo);
                    $photo_image1 = file_exists("upload/" . $photo);
                    if (!empty($photo) && $photo_image) {
                        ?>
                        <img src="<?php echo url::base() . 'mobile/upload/' . $user->photo->profile_pic; ?>" alt=" <?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>" style="margin:0px auto;width:215px;">
                    <?php }
                    else if (!empty($photo) && $photo_image1) {
                        ?>
                        <img src="<?php echo url::base() . 'upload/' . $user->photo->profile_pic; ?>" alt=" <?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>" style="margin:0px auto;width:215px;">
                    <?php } else { ?>
                        <div id="inset" style="width:100%;height:100%;">
                            <h1>
                                <?php echo $user->user_detail->get_no_image_name(); ?>
                            </h1>

                        </div>
                    <?php } ?>
                </div>
               <div class="" style="padding-top: 20px;padding-bottom: 20px;">
                    <span class="user-name pp-username" style="font-size: 20px;font-weight: 600;">
                        <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name ?>
                    </span>
                </div>
                <div class="wrapper" style="margin-bottom: 26px;">

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
                            <span class="">
                                <span class="">
                                    <?php if($inspire->id) { ?>
                                        <!-- <i class="fa fa-thumbs-up text-success"></i> -->
                                        <span class="">Inspired</span>
                                    <?php } else { ?>
                                       <!--  <i class="fa fa-thumbs-o-up"></i> -->
                                        <span>Inspire</span>
                                    <?php } ?>
                                </span>
                                <span class="inspire-count btn-inspire inspire-list-popup" href="<?php echo url::base()."ajax/get_inspire_list?public=".$user->username; ?>" popup-modal="#genericPopup" popup-title="People who got inspired by <?php echo $user->user_detail->get_name(); ?>"><?php echo $inspire_count; ?></span>
                            </span>
                        </form>
                    <?php } else { ?>
                        <a href="<?php echo url::base(); ?>login?page=public/<?php echo $user->username; ?>" class="btn-primary btn-inspire btn btn-labeled marginVertical btn-xs ">
                            <span class="">
                                <span class="">
                                    <!-- <i class="fa fa-thumbs-o-up"></i> -->
                                    <span class="btn-inner">Get Inspired</span>
                                </span>
                                <!-- <span class="inspire-count"><?php// echo $inspire_count; ?></span> -->
                            </span>
                        </a>
                    <?php } ?>
                </div>
                <div class="col-sm-12">
                    <?php $data_p = $user->user_detail->designation; ?>
                    <?php
                    $data_ps = explode(',', $data_p);
                    foreach ($data_ps as $tag) {
                        ?>
                        <?php echo '<p class="marBottom5" style="margin-bottom: 12px !important;color: #878585;font-weight: 500;"><span class=""><i class="glyphicon glyphicon-ok"></i></span> ' . $tag . '</p>' ?>
                    <?php }
                    ?>
                     <?php if (Auth::instance()->logged_in('admin')) { ?>
                      <a data-toggle="modal" href="#editBasicInfo" class="btn icon-btn btn-transparent btn-md marBottom5">
                        <span class="badge"><i class="glyphicon glyphicon-ok"></i></span> Update Info
                    </a>
               <?php } ?>
               <ul class="profile-tabs marTop10">
                  <li><a href="#post" >Post</a></li>
                  <li><a href="#inspiration">Inspiration</a></li>
                  <li><a href="#reviews" class="active">Reviews</a></li>
                  <li><a href="#about" >About</a></li>
               </ul>
               <div id="post"></div>
               <div id="inspiration"></div>
               <div id="reviews" class="active">
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
                    <div class="row px ">
                  
                    <div class="col-sm-4 pull-right" >
                        <div class="circular-bar marTop10">
                            <input type="text" class="dial" data-fgColor="#ff1744" data-width="150" data-height="150" data-linecap=round  value="<?php echo $social; ?>" >
                            <div class="circular-bar-content">
                                <label></label>
                            </div>
                        </div>
                        <h4 class="text-center">Social</h4>
                    </div>
                      <?php if (!empty($tags)) { ?>
                        <div id="wordWrap" class="col-sm-8">

                            <div class="tag-box bordered-box">

                                <fieldset class="fieldset pull-left" style="width:100%;">
                                    <div class="words">
                                        <div id="wordcloud" class="jqcloud" style="height:300px;width: 550px;"></div>
                                    </div>
                                </fieldset>

                                <div class="clearfix"></div>
                            </div>

                            <!--word cloud javascript-->
                            <link rel="stylesheet" type="text/css" href="<?php echo url::base(); ?>css/jqcloud.css" />
                            <script type="text/javascript" src="<?php echo url::base(); ?>js/jqcloud-1.0.3.min.js"></script>
                            <script type="text/javascript">
                                var word_list = new Array();
                            <?php foreach ($tags as $tag => $weight) { ?>
                                word_list.push({text: <?php echo "'" . $tag . "'"; ?>, weight: <?php echo $weight; ?>});
                            <?php } ?>

                                $(function () {
                                    $("#wordcloud").jQCloud(word_list, {
                                        width: ($("#wordWrap").width() - 30),
                                        height: 300
                                    });
                                });
                            </script>

                            <div class="clearfix"></div>

                        </div>
                    <?php } ?>
                      <div class="row">
            <?php if ($user->user_detail->about_private != 1) { ?>
            <div class="col-sm-12 marTop20">
                <?php if ($user->user_detail->about) { ?>
                <div class="row" id="sroll_pan">
                    <div class="col-sm-12">
                        <div class="hb-p-0" id="comments">
                            <?php if (!empty($recommends)) { ?>
                            <ul class="list-group hb-m-0">
                                <?php foreach ($recommends as $recommend) { ?>     
                                <li class="list-group-item">
                                    <div class="row">
                                        
                                            <a href="<?php echo url::base() . $recommend->owner->username; ?>">
                                                <?php 
                                                $photo = $recommend->owner->photo->profile_pic_s;
                                                $rec_image = file_exists("mobile/upload/" .$photo);
                                                $rec_image1 = file_exists("upload/" .$photo);
                                                if (!empty($photo) && $rec_image) { ?>
                                                <img src="<?php echo url::base() . 'mobile/upload/' . $recommend->owner->photo->profile_pic_s; ?>"  class="pull-left hb-mr-10" style="width:55px;height:55px; border-radius:50%;">
                                                <?php }
                                                else if (!empty($photo) && $rec_image1) { ?>
                                                <img src="<?php echo url::base() . 'upload/' . $recommend->owner->photo->profile_pic_s; ?>"  class="pull-left hb-mr-10" style="width:55px;height:55px; border-radius:50%;">
                                                <?php } else { ?>
                                                <span class="glyphicon glyphicon-user fa-4x" style="width:63px; height:63px;  border-radius:50%;float: left;"></span>
                                                <?php } ?>
                                                
                                                <span style="color:#FF2A7F;" class="hb-m-0 comment-user">
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
                                    <div class="row">
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
                                </li>
                            
                            <?php } ?>                            
                            </ul>    
                            <?php } else { ?>
                            <ul class="list-group hb-m-0">
                                <li class="list-group-item text-center">
                                    <i class="fa fa-user-secret fa-5x"></i>
                                    <h4 style="text-align: center;">No one has reviewed <?php echo $user->user_detail->last_name; ?> yet. Be the first to review </h4>

                                    <div class="clearfix marBottom20"></div>

                                    <a href="#" class="btn btn-secondary btn-lg marBottom10" data-toggle="modal" data-target="#modal4">
                                        Write Review 
                                    </a>


                                </li>                                
                            </ul>
                            <?php } ?> 
                        </div>
                        <!--<div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-success center-block">Load More</button>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>

                </div>
               </div>
               <div id="about">
                   
               </div>
                </div>
                 
          </div>  
</div>

            </div>
        </div>

        <!-- <div class="row hb-mt-20">
            <div class="col-xs-12"> 
                <div class="panel-heading">
                    <h3 class="title">Profession </h3>
                </div>
                

            </div>

        </div>
 -->
        <div class="row">

            <div class="row">
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
        <div class="row">
            <div class="col-sm-12 marTop20">

                <?php if(Auth::instance()->logged_in())
                {
                    $ds = ORM::factory('recommend', array('from' => $session_user->id, 'to' => $user->id));
              
                    if(!$ds->id) { ?>

                <div class="">
                    <!-- <h3>
                        What you think about 
                        <?php// echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?>.?

                    </h3>

                    <a href="#" class="btn btn-secondary btn-lg marBottom10" data-toggle="modal" data-target="#modal4">
                        Write Review 
                    </a> -->


                    <!-- Modal -->
                    <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 9999;"aria-hidden="true" >
                        <div class="modal-dialog">
                            <div class="modal-content modal-content-four">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">?</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel"> Write Review to <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?>  </h4>
                                </div>
                                <div class="modal-body">

                                    <link rel="stylesheet" href="<?php echo url::base(); ?>assets/multiple/css/normalize.css">
                                    <link rel="stylesheet" href="<?php echo url::base(); ?>assets/multiple/css/stylesheet.css">

                                    <script src="<?php echo url::base(); ?>assets/multiple/dist/js/standalone/selectize.js"></script>
                                    <script src="<?php echo url::base(); ?>assets/multiple/js/index.js"></script>
                                    <script>
                            $(document).ready(function () {
                                $('.password').hide();
                                $('.first_name').hide();
                                $('.last_name').hide();

                                var base_url = 'https://www.callitme.com/';
                                $('#search-query5').keyup(function ()
                                {

                                    var query = $(this).val();
                                    query = $.trim(query);


                                    if (query !== "")
                                    {  // If something was entered
                                        if (isValidEmailAddress(query))
                                        {
                                            $('#loading').show();

                                            $.ajax({
                                                type: 'get',
                                                url: base_url + "pages/select_user",
                                                data: 'query=' + query,
                                                success: function (data)
                                                {

                                                    if (data == 'True')
                                                    {
                                                        $('#loading').hide();
                                                        $('.first_name').hide();
                                                        $('.last_name').hide();
                                                        $('.password').show();
                                                        $('#p_type').val('Yes');
                                                        $('#next_div').hide();
                                                        $('.submit_review').show();

                                                    }
                                                    else
                                                    {
                                                        $('.first_name').show();
                                                        $('.last_name').show();
                                                        $('.password').show();

                                                        $('#p_type').val('No');
                                                        $('#loading').hide();
                                                    }
                                                }
                                            });

                                        }
                                        else
                                        {
                                            $('.password').hide();
                                            $('.first_name').hide();
                                            $('.last_name').hide();
                                        }



                                    }
                                    if (query == '')
                                    {
                                        $('.password').hide();
                                        $('.first_name').hide();
                                        $('.last_name').hide();

                                    }

                                });




                                function isValidEmailAddress(emailAddress) {
                                    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
                                    return pattern.test(emailAddress);
                                }
                                ;
                            });
                                    </script>

                                    <div class="row marTop20">
                                        <div class="col-sm-12">


                                            <fieldset class="fieldset">
                                                <?php
                                                if (Auth::instance()->logged_in()) {
                                                    ?>

                                                    <form role="form" class="validate-form" method="post"  action="<?php echo url::base() . "pp/write_review" ?> " autocomplete="off">
                                                        <input type="hidden" name="username" value="<?php echo $user->username; ?>">

                                                        <input type="hidden" id="p_type" name="password_type" value="1">
                                                        <label class="control-label pull-left" for="message">Words that describe <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?></label>

                                                        <div class="form-group">

                                                            <div class="control-group">

                                                                <select id="select-state" name="words[]" multiple class="demo-default selectized"  placeholder="Enter option separated by comma">
                                                                    <option value="Sweet">Sweet</option>

                                                                    <option value="Rude">Rude</option>

                                                                    <option value="Selfish">Selfish</option>

                                                                    <option value="Shy">Shy</option>

                                                                    <option value="Silly">Silly</option>

                                                                    <option value="Materialistic">Materialistic</option>

                                                                    <option value="Social">Social</option>

                                                                    <option value="Honest">Honest</option>

                                                                    <option value="Generous">Generous</option>

                                                                    <option value="Lazy">Lazy</option>

                                                                    <option value="Mean">Mean</option>

                                                                    <option value="Moody">Moody</option>

                                                                    <option value="Courteous">Courteous</option>

                                                                    <option value="Sensitive">Sensitive</option>

                                                                    <option value="Miser">Miser</option>

                                                                    <option value="Considerate">Considerate</option>

                                                                    <option value="Affectionate">Affectionate</option>

                                                                    <option value="Ambitious">Ambitious</option>

                                                                    <option value="Bad-tempered">Bad-tempered</option>

                                                                    <option value="Greedy">Greedy</option>

                                                                    <option value="Bossy">Bossy</option>

                                                                    <option value="Charismatic">Charismatic</option>

                                                                    <option value="Courageous">Courageous</option>

                                                                    <option value="Dependable">Dependable</option>

                                                                    <option value="Devious">Devious</option>

                                                                    <option value="Joyful">Joyful</option>

                                                                    <option value="Talkative">Talkative</option>

                                                                    <option value="Sympathetic">Sympathetic</option>

                                                                    <option value="Optimist">Optimist</option>

                                                                    <option value="Pessimist">Pessimist</option>

                                                                    <option value="Dim">Dim</option>

                                                                    <option value="Egotistical">Egotistical</option>

                                                                    <option value="Impulsive">Impulsive</option>

                                                                    <option value="Smart">Smart</option>

                                                                    <option value="Respectful">Respectful</option>

                                                                    <option value="Thoughtful">Thoughtful</option>

                                                                    <option value="Friendly">Friendly</option>

                                                                    <option value="Funny">Funny</option>
                                                                    <option value="Pessimist">Pessimist</option>

                                                                    <option value="Dim">Dim</option>

                                                                    <option value="Egotistical">Egotistical</option>

                                                                    <option value="Impulsive">Impulsive</option>

                                                                    <option value="Smart">Smart</option>

                                                                    <option value="Respectful">Respectful</option>

                                                                    <option value="Thoughtful">Thoughtful</option>

                                                                    <option value="Friendly">Friendly</option>

                                                                    <option value="Funny">Funny</option>
                                                                    <option value="Intelligent">Intelligent</option>

                                                                    <option value="Religious">Religious</option>

                                                                    <option value="Corrupt">Corrupt</option>

                                                                    <option value="Traitor">Traitor</option>

                                                                    <option value="Unskilled">Unskilled</option>

                                                                    <option value="Leader">Leader</option>

                                                                    <option value="Follower">Follower</option>


                                                                    <option value="Selfless">Selfless</option>
                                                                    <option value="Unattractive">Unattractive</option>

                                                                    <option value="Charming">Charming</option>

                                                                    <option value="Communicator">Communicator</option>

                                                                    <option value="Negotiator">Negotiator</option>

                                                                    <option value="Intellectual">Intellectual</option>

                                                                    <option value="Energetic">Energetic</option>

                                                                    <option value="Lethargic">Lethargic</option>

                                                                    <option value="Liar">Liar</option>

                                                                    <option value="Pleasing">Pleasing</option>

                                                                    <option value="Disgusting">Disgusting</option>

                                                                    <option value="Flip-flop">Flip-flop</option>

                                                                    <option value="Competent">Competent</option>

                                                                    <option value="Incompetent">Incompetent</option>
                                                                </select>
                                                                <small class="text-muted dis-block">Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.</small>
                                                            </div>
                                                            <script>
                                                                $('#select-state').selectize({
                                                                    maxItems: 15
                                                                });
                                                            </script>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="control-label pull-left" for="message">Detail review:</label>
                                                            <textarea class="required form-control" id="message" name="message" rows="6" placeholder="Please describe the person you are reviewing. Example: Good habits, bad habits, your experiences etc."><?php echo (isset($recommend) ? $recommend->message : ''); ?></textarea>
                                                        </div>
                                                        <button type="submit" onclick="myfunction()" class="btn btn-primary">Review Publicly</button>

                                                    </form>
                                                <?php } else {
                                                    ?>

                                                    <form role="form" class="validate-form" method="post"  action="<?php echo url::base() . "pp/write_review" ?> " autocomplete="off">
                                                        <input type="hidden" name="username" value="<?php echo $user->username; ?>">
                                                        <input type="hidden" id="p_type" name="password_type" value="">
                                                        <div id="st1"  style="display: none;">
                                                            <div class="form-group" style="position:relative;">
                                                                <label class="control-label pull-left" for="recommend-email"> To continue, please enter your email address:</label>

                                                                <input type="email" id="search-query5" name="email" class="required email find_user form-control" id="recommend-email" placeholder="Enter email address" autocomplete='off'
                                                                       value="">

                                                                <div  id="loading" style="display:none;margin-top: 5px;" class="form-group" >
                                                                    <img src="<?php echo url::base() . "upload/loading_test.gif"; ?>">

                                                                </div>
                                                            </div>
                                                            <div class="form-group first_name"  style="position:relative;">
                                                                <label class="control-label pull-left" for="recommend-email"> First Name:</label>

                                                                <input type="text" name="first_name" id="first_name" class="form-control required"  placeholder="Enter First name" autocomplete='off'
                                                                       value="">

                                                            </div>
                                                            <div class="form-group last_name" style="position:relative;">
                                                                <label class="control-label pull-left" > Last Name:</label>

                                                                <input type="text" name="last_name" id="last_name" class="form-control required"  placeholder="Enter Last name" autocomplete='off'
                                                                       value="">

                                                            </div>

                                                            <div class="form-group password"  style="position:relative;display:none;">
                                                                <label class="control-label pull-left" > Password :</label>

                                                                <input type="password" name="password" id="password" class="form-control"  placeholder="Enter Password"  value="" autocomplete='off'>

                                                            </div>
                                                            <div id="next_div">
                                                                <a class="btn btn-success" id="btnnxt3">Next </a>
                                                            </div>

                                                            <div class="form-group submit_review"  style="position:relative;display:none;">
                                                                <button type="submit" class="btn btn-primary" name="submit" id="submit_review">Submit Review</button>

                                                            </div>
                                                        </div> 

                                                        <!---------------------------popup 3--------------------------------------------------------->
                                                        <div id="st3"  style="display: none;">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <!--<label class="control-label" for="sex">I am:</label>-->
                                                                        <select name="sex" class="required form-control">
                                                                            <option value="">Select Gender</option>
                                                                            <option value="Male">Male</option>
                                                                            <option value="Female">Female</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!--<label class="control-label" for="birthday" class="required">Phase of Life:</label>-->
                                                                        <select name="phase_of_life" class="form-control required">
                                                                            <option value="">Phase of life:</option>
                                                                            <?php foreach (Kohana::$config->load('profile')->get('phase_of_life') as $key => $value) { ?>
                                                                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label dis-block" for="birthday">Birthday:</label>

                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <select name="month" class="dis-in-block form-control">
                                                                            <option value="">Month:</option>
                                                                            <option value="01">January</option>
                                                                            <option value="02">February</option>
                                                                            <option value="03">March</option>
                                                                            <option value="04">April</option>
                                                                            <option value="05">May</option>
                                                                            <option value="06">June</option>
                                                                            <option value="07">July</option>
                                                                            <option value="08">August</option>
                                                                            <option value="09">September</option>
                                                                            <option value="10">October</option>
                                                                            <option value="11">November</option>
                                                                            <option value="12">December</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="day" class="dis-in-block form-control">
                                                                            <option value="">Day:</option>
                                                                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php } ?>      
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select id="yearOfBirth" class="dis-in-block form-control" name="year" >
                                                                            <option value="">Year:</option>
                                                                            <?php $y = date('Y'); ?>
                                                                            <?php for ($n = $y - 100; $n <= $y; $n++) { ?>
                                                                                <option value="<?php echo $n; ?>"><?php echo $n; ?></option>
                                                                            <?php } ?> 
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="submit" onclick="myfunction()" class="btn btn-primary">Submit Review </button>

                                                        </div>

                                                        <!------------------------------------------------------------------------------------------>
                                                        <div id="st2">
                                                            <label class="control-label pull-left" for="message">Words that describe <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?></label>

                                                            <div class="form-group">

                                                                <div class="control-group">

                                                                    <select id="select-state" name="words[]" multiple class="demo-default selectized"  placeholder="Enter option separated by comma">

                                                                        <option value="Sweet">Sweet</option>

                                                                        <option value="Rude">Rude</option>

                                                                        <option value="Selfish">Selfish</option>

                                                                        <option value="Shy">Shy</option>

                                                                        <option value="Silly">Silly</option>

                                                                        <option value="Materialistic">Materialistic</option>

                                                                        <option value="Social">Social</option>

                                                                        <option value="Honest">Honest</option>

                                                                        <option value="Generous">Generous</option>

                                                                        <option value="Lazy">Lazy</option>

                                                                        <option value="Mean">Mean</option>

                                                                        <option value="Moody">Moody</option>

                                                                        <option value="Courteous">Courteous</option>

                                                                        <option value="Sensitive">Sensitive</option>

                                                                        <option value="Miser">Miser</option>

                                                                        <option value="Considerate">Considerate</option>

                                                                        <option value="Affectionate">Affectionate</option>

                                                                        <option value="Ambitious">Ambitious</option>

                                                                        <option value="Bad-tempered">Bad-tempered</option>

                                                                        <option value="Greedy">Greedy</option>

                                                                        <option value="Bossy">Bossy</option>

                                                                        <option value="Charismatic">Charismatic</option>

                                                                        <option value="Courageous">Courageous</option>

                                                                        <option value="Dependable">Dependable</option>

                                                                        <option value="Devious">Devious</option>

                                                                        <option value="Joyful">Joyful</option>

                                                                        <option value="Talkative">Talkative</option>

                                                                        <option value="Sympathetic">Sympathetic</option>

                                                                        <option value="Optimist">Optimist</option>

                                                                        <option value="Pessimist">Pessimist</option>

                                                                        <option value="Dim">Dim</option>

                                                                        <option value="Egotistical">Egotistical</option>

                                                                        <option value="Impulsive">Impulsive</option>

                                                                        <option value="Smart">Smart</option>

                                                                        <option value="Respectful">Respectful</option>

                                                                        <option value="Thoughtful">Thoughtful</option>

                                                                        <option value="Friendly">Friendly</option>

                                                                        <option value="Funny">Funny</option>
                                                                        <option value="Pessimist">Pessimist</option>

                                                                        <option value="Dim">Dim</option>

                                                                        <option value="Egotistical">Egotistical</option>

                                                                        <option value="Impulsive">Impulsive</option>

                                                                        <option value="Smart">Smart</option>

                                                                        <option value="Respectful">Respectful</option>

                                                                        <option value="Thoughtful">Thoughtful</option>

                                                                        <option value="Friendly">Friendly</option>

                                                                        <option value="Funny">Funny</option>
                                                                        <option value="Intelligent">Intelligent</option>

                                                                        <option value="Religious">Religious</option>

                                                                        <option value="Corrupt">Corrupt</option>

                                                                        <option value="Traitor">Traitor</option>

                                                                        <option value="Unskilled">Unskilled</option>

                                                                        <option value="Leader">Leader</option>

                                                                        <option value="Follower">Follower</option>


                                                                        <option value="Selfless">Selfless</option>
                                                                        <option value="Unattractive">Unattractive</option>

                                                                        <option value="Charming">Charming</option>

                                                                        <option value="Communicator">Communicator</option>

                                                                        <option value="Negotiator">Negotiator</option>

                                                                        <option value="Intellectual">Intellectual</option>

                                                                        <option value="Energetic">Energetic</option>

                                                                        <option value="Lethargic">Lethargic</option>

                                                                        <option value="Liar">Liar</option>

                                                                        <option value="Pleasing">Pleasing</option>

                                                                        <option value="Disgusting">Disgusting</option>

                                                                        <option value="Flip-flop">Flip-flop</option>

                                                                        <option value="Competent">Competent</option>

                                                                        <option value="Incompetent">Incompetent</option>
                                                                    </select>
                                                                    <small class="text-muted dis-block">Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.</small>
                                                                </div>
                                                                <script>
                                                                    $('#select-state').selectize({
                                                                        maxItems: 15
                                                                    });
                                                                </script>
                                                            </div>


                                                            <div class="form-group">
                                                                <label class="control-label pull-left" for="message">Detail review:</label>
                                                                <textarea class="required form-control" id="message" name="message" rows="6" placeholder="Please describe the person you are reviewing. Example: Good habits, bad habits, your experiences etc."><?php echo (isset($recommend) ? $recommend->message : ''); ?></textarea>
                                                            </div>
                                                            <a class="btn btn-success" id="btnnxt1"> Review Publicly </a>
                                                        </div>
                                                    </form>
                                                <?php } ?>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#btnnxt1').click(function ()
                                            {

                                                if ($('#message').val().trim().length > 0)
                                                {
                                                    $('#st2').hide();
                                                    $('#st3').hide();
                                                    $('#st1').show();

                                                }
                                                else
                                                {
                                                    alert('Please fill details..');
                                                    $('#message').focus();
                                                }




                                            });
                                            $('#btnnxt3').click(function ()
                                            {

                                                if ($('#first_name').val() == '')
                                                {
                                                    $('#first_name').focus();
                                                }
                                                else if ($('#last_name').val() == '')
                                                {
                                                    $('#last_name').focus();
                                                }
                                                else if ($('#password').val() == '')
                                                {
                                                    $('#password').focus();
                                                }
                                                else
                                                {

                                                    $('#st2').hide();
                                                    $('#st1').hide();
                                                    $('#st3').show();
                                                }
                                            });

                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php  } 
    } else { ?>


    <div class="">
<!--                     <h3>
                        What you think about 
                        <?php// echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?>.?

                    </h3>

                    <a href="#" class="btn btn-secondary btn-lg marBottom10" data-toggle="modal" data-target="#modal4">
                        Write Review 
                    </a> -->


                    <!-- Modal -->
                    <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 9999;"aria-hidden="true" >
                        <div class="modal-dialog">
                            <div class="modal-content modal-content-four">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">?</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel"> Write Review to <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?>  </h4>
                                </div>
                                <div class="modal-body">

                                    <link rel="stylesheet" href="<?php echo url::base(); ?>assets/multiple/css/normalize.css">
                                    <link rel="stylesheet" href="<?php echo url::base(); ?>assets/multiple/css/stylesheet.css">

                                    <script src="<?php echo url::base(); ?>assets/multiple/dist/js/standalone/selectize.js"></script>
                                    <script src="<?php echo url::base(); ?>assets/multiple/js/index.js"></script>
                                    <script>
                            $(document).ready(function () {
                                $('.password').hide();
                                $('.first_name').hide();
                                $('.last_name').hide();

                                var base_url = 'https://www.callitme.com/';
                                $('#search-query5').keyup(function ()
                                {

                                    var query = $(this).val();
                                    query = $.trim(query);


                                    if (query !== "")
                                    {  // If something was entered
                                        if (isValidEmailAddress(query))
                                        {
                                            $('#loading').show();

                                            $.ajax({
                                                type: 'get',
                                                url: base_url + "pages/select_user",
                                                data: 'query=' + query,
                                                success: function (data)
                                                {

                                                    if (data == 'True')
                                                    {
                                                        $('#loading').hide();
                                                        $('.first_name').hide();
                                                        $('.last_name').hide();
                                                        $('.password').show();
                                                        $('#p_type').val('Yes');
                                                        $('#next_div').hide();
                                                        $('.submit_review').show();

                                                    }
                                                    else
                                                    {
                                                        $('.first_name').show();
                                                        $('.last_name').show();
                                                        $('.password').show();

                                                        $('#p_type').val('No');
                                                        $('#loading').hide();
                                                    }
                                                }
                                            });

                                        }
                                        else
                                        {
                                            $('.password').hide();
                                            $('.first_name').hide();
                                            $('.last_name').hide();
                                        }



                                    }
                                    if (query == '')
                                    {
                                        $('.password').hide();
                                        $('.first_name').hide();
                                        $('.last_name').hide();

                                    }

                                });




                                function isValidEmailAddress(emailAddress) {
                                    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
                                    return pattern.test(emailAddress);
                                }
                                ;
                            });
                                    </script>

                                    <div class="row marTop20">
                                        <div class="col-sm-12">


                                            <fieldset class="fieldset">
                                                <?php
                                                if (Auth::instance()->logged_in()) {
                                                    ?>

                                                    <form role="form" class="validate-form" method="post"  action="<?php echo url::base() . "pp/write_review" ?> " autocomplete="off">
                                                        <input type="hidden" name="username" value="<?php echo $user->username; ?>">

                                                        <input type="hidden" id="p_type" name="password_type" value="1">
                                                        <label class="control-label pull-left" for="message">Words that describe <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?></label>

                                                        <div class="form-group">

                                                            <div class="control-group">

                                                                <select id="select-state" name="words[]" multiple class="demo-default selectized"  placeholder="Enter option separated by comma">
                                                                    <option value="Sweet">Sweet</option>

                                                                    <option value="Rude">Rude</option>

                                                                    <option value="Selfish">Selfish</option>

                                                                    <option value="Shy">Shy</option>

                                                                    <option value="Silly">Silly</option>

                                                                    <option value="Materialistic">Materialistic</option>

                                                                    <option value="Social">Social</option>

                                                                    <option value="Honest">Honest</option>

                                                                    <option value="Generous">Generous</option>

                                                                    <option value="Lazy">Lazy</option>

                                                                    <option value="Mean">Mean</option>

                                                                    <option value="Moody">Moody</option>

                                                                    <option value="Courteous">Courteous</option>

                                                                    <option value="Sensitive">Sensitive</option>

                                                                    <option value="Miser">Miser</option>

                                                                    <option value="Considerate">Considerate</option>

                                                                    <option value="Affectionate">Affectionate</option>

                                                                    <option value="Ambitious">Ambitious</option>

                                                                    <option value="Bad-tempered">Bad-tempered</option>

                                                                    <option value="Greedy">Greedy</option>

                                                                    <option value="Bossy">Bossy</option>

                                                                    <option value="Charismatic">Charismatic</option>

                                                                    <option value="Courageous">Courageous</option>

                                                                    <option value="Dependable">Dependable</option>

                                                                    <option value="Devious">Devious</option>

                                                                    <option value="Joyful">Joyful</option>

                                                                    <option value="Talkative">Talkative</option>

                                                                    <option value="Sympathetic">Sympathetic</option>

                                                                    <option value="Optimist">Optimist</option>

                                                                    <option value="Pessimist">Pessimist</option>

                                                                    <option value="Dim">Dim</option>

                                                                    <option value="Egotistical">Egotistical</option>

                                                                    <option value="Impulsive">Impulsive</option>

                                                                    <option value="Smart">Smart</option>

                                                                    <option value="Respectful">Respectful</option>

                                                                    <option value="Thoughtful">Thoughtful</option>

                                                                    <option value="Friendly">Friendly</option>

                                                                    <option value="Funny">Funny</option>
                                                                    <option value="Pessimist">Pessimist</option>

                                                                    <option value="Dim">Dim</option>

                                                                    <option value="Egotistical">Egotistical</option>

                                                                    <option value="Impulsive">Impulsive</option>

                                                                    <option value="Smart">Smart</option>

                                                                    <option value="Respectful">Respectful</option>

                                                                    <option value="Thoughtful">Thoughtful</option>

                                                                    <option value="Friendly">Friendly</option>

                                                                    <option value="Funny">Funny</option>
                                                                    <option value="Intelligent">Intelligent</option>

                                                                    <option value="Religious">Religious</option>

                                                                    <option value="Corrupt">Corrupt</option>

                                                                    <option value="Traitor">Traitor</option>

                                                                    <option value="Unskilled">Unskilled</option>

                                                                    <option value="Leader">Leader</option>

                                                                    <option value="Follower">Follower</option>


                                                                    <option value="Selfless">Selfless</option>
                                                                    <option value="Unattractive">Unattractive</option>

                                                                    <option value="Charming">Charming</option>

                                                                    <option value="Communicator">Communicator</option>

                                                                    <option value="Negotiator">Negotiator</option>

                                                                    <option value="Intellectual">Intellectual</option>

                                                                    <option value="Energetic">Energetic</option>

                                                                    <option value="Lethargic">Lethargic</option>

                                                                    <option value="Liar">Liar</option>

                                                                    <option value="Pleasing">Pleasing</option>

                                                                    <option value="Disgusting">Disgusting</option>

                                                                    <option value="Flip-flop">Flip-flop</option>

                                                                    <option value="Competent">Competent</option>

                                                                    <option value="Incompetent">Incompetent</option>
                                                                </select>
                                                                <small class="text-muted dis-block">Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.</small>
                                                            </div>
                                                            <script>
                                                                $('#select-state').selectize({
                                                                    maxItems: 15
                                                                });
                                                            </script>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="control-label pull-left" for="message">Detail review:</label>
                                                            <textarea class="required form-control" id="message" name="message" rows="6" placeholder="Please describe the person you are reviewing. Example: Good habits, bad habits, your experiences etc."><?php echo (isset($recommend) ? $recommend->message : ''); ?></textarea>
                                                        </div>
                                                        <button type="submit" onclick="myfunction()" class="btn btn-primary">Review Publicly</button>

                                                    </form>
                                                <?php } else {
                                                    ?>

                                                    <form role="form" class="validate-form" method="post"  action="<?php echo url::base() . "pp/write_review" ?> " autocomplete="off">
                                                        <input type="hidden" name="username" value="<?php echo $user->username; ?>">
                                                        <input type="hidden" id="p_type" name="password_type" value="">
                                                        <div id="st1"  style="display: none;">
                                                            <div class="form-group" style="position:relative;">
                                                                <label class="control-label pull-left" for="recommend-email"> To continue, please enter your email address:</label>

                                                                <input type="email" id="search-query5" name="email" class="required email find_user form-control" id="recommend-email" placeholder="Enter email address" autocomplete='off'
                                                                       value="">

                                                                <div  id="loading" style="display:none;margin-top: 5px;" class="form-group" >
                                                                    <img src="<?php echo url::base() . "upload/loading_test.gif"; ?>">

                                                                </div>
                                                            </div>
                                                            <div class="form-group first_name"  style="position:relative;">
                                                                <label class="control-label pull-left" for="recommend-email"> First Name:</label>

                                                                <input type="text" name="first_name" id="first_name" class="form-control required"  placeholder="Enter First name" autocomplete='off'
                                                                       value="">

                                                            </div>
                                                            <div class="form-group last_name" style="position:relative;">
                                                                <label class="control-label pull-left" > Last Name:</label>

                                                                <input type="text" name="last_name" id="last_name" class="form-control required"  placeholder="Enter Last name" autocomplete='off'
                                                                       value="">

                                                            </div>

                                                            <div class="form-group password"  style="position:relative;display:none;">
                                                                <label class="control-label pull-left" > Password :</label>

                                                                <input type="password" name="password" id="password" class="form-control"  placeholder="Enter Password"  value="" autocomplete='off'>

                                                            </div>
                                                            <div id="next_div">
                                                                <a class="btn btn-success" id="btnnxt3">Next </a>
                                                            </div>

                                                            <div class="form-group submit_review"  style="position:relative;display:none;">
                                                                <button type="submit" class="btn btn-primary" name="submit" id="submit_review">Submit Review</button>

                                                            </div>
                                                        </div> 

                                                        <!---------------------------popup 3--------------------------------------------------------->
                                                        <div id="st3"  style="display: none;">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <!--<label class="control-label" for="sex">I am:</label>-->
                                                                        <select name="sex" class="required form-control">
                                                                            <option value="">Select Gender</option>
                                                                            <option value="Male">Male</option>
                                                                            <option value="Female">Female</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!--<label class="control-label" for="birthday" class="required">Phase of Life:</label>-->
                                                                        <select name="phase_of_life" class="form-control required">
                                                                            <option value="">Phase of life:</option>
                                                                            <?php foreach (Kohana::$config->load('profile')->get('phase_of_life') as $key => $value) { ?>
                                                                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label dis-block" for="birthday">Birthday:</label>

                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <select name="month" class="dis-in-block form-control">
                                                                            <option value="">Month:</option>
                                                                            <option value="01">January</option>
                                                                            <option value="02">February</option>
                                                                            <option value="03">March</option>
                                                                            <option value="04">April</option>
                                                                            <option value="05">May</option>
                                                                            <option value="06">June</option>
                                                                            <option value="07">July</option>
                                                                            <option value="08">August</option>
                                                                            <option value="09">September</option>
                                                                            <option value="10">October</option>
                                                                            <option value="11">November</option>
                                                                            <option value="12">December</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="day" class="dis-in-block form-control">
                                                                            <option value="">Day:</option>
                                                                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php } ?>      
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select id="yearOfBirth" class="dis-in-block form-control" name="year" >
                                                                            <option value="">Year:</option>
                                                                            <?php $y = date('Y'); ?>
                                                                            <?php for ($n = $y - 100; $n <= $y; $n++) { ?>
                                                                                <option value="<?php echo $n; ?>"><?php echo $n; ?></option>
                                                                            <?php } ?> 
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="submit" onclick="myfunction()" class="btn btn-primary">Submit Review </button>

                                                        </div>

                                                        <!------------------------------------------------------------------------------------------>
                                                        <div id="st2">
                                                            <label class="control-label pull-left" for="message">Words that describe <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?></label>

                                                            <div class="form-group">

                                                                <div class="control-group">

                                                                    <select id="select-state" name="words[]" multiple class="demo-default selectized"  placeholder="Enter option separated by comma">

                                                                        <option value="Sweet">Sweet</option>

                                                                        <option value="Rude">Rude</option>

                                                                        <option value="Selfish">Selfish</option>

                                                                        <option value="Shy">Shy</option>

                                                                        <option value="Silly">Silly</option>

                                                                        <option value="Materialistic">Materialistic</option>

                                                                        <option value="Social">Social</option>

                                                                        <option value="Honest">Honest</option>

                                                                        <option value="Generous">Generous</option>

                                                                        <option value="Lazy">Lazy</option>

                                                                        <option value="Mean">Mean</option>

                                                                        <option value="Moody">Moody</option>

                                                                        <option value="Courteous">Courteous</option>

                                                                        <option value="Sensitive">Sensitive</option>

                                                                        <option value="Miser">Miser</option>

                                                                        <option value="Considerate">Considerate</option>

                                                                        <option value="Affectionate">Affectionate</option>

                                                                        <option value="Ambitious">Ambitious</option>

                                                                        <option value="Bad-tempered">Bad-tempered</option>

                                                                        <option value="Greedy">Greedy</option>

                                                                        <option value="Bossy">Bossy</option>

                                                                        <option value="Charismatic">Charismatic</option>

                                                                        <option value="Courageous">Courageous</option>

                                                                        <option value="Dependable">Dependable</option>

                                                                        <option value="Devious">Devious</option>

                                                                        <option value="Joyful">Joyful</option>

                                                                        <option value="Talkative">Talkative</option>

                                                                        <option value="Sympathetic">Sympathetic</option>

                                                                        <option value="Optimist">Optimist</option>

                                                                        <option value="Pessimist">Pessimist</option>

                                                                        <option value="Dim">Dim</option>

                                                                        <option value="Egotistical">Egotistical</option>

                                                                        <option value="Impulsive">Impulsive</option>

                                                                        <option value="Smart">Smart</option>

                                                                        <option value="Respectful">Respectful</option>

                                                                        <option value="Thoughtful">Thoughtful</option>

                                                                        <option value="Friendly">Friendly</option>

                                                                        <option value="Funny">Funny</option>
                                                                        <option value="Pessimist">Pessimist</option>

                                                                        <option value="Dim">Dim</option>

                                                                        <option value="Egotistical">Egotistical</option>

                                                                        <option value="Impulsive">Impulsive</option>

                                                                        <option value="Smart">Smart</option>

                                                                        <option value="Respectful">Respectful</option>

                                                                        <option value="Thoughtful">Thoughtful</option>

                                                                        <option value="Friendly">Friendly</option>

                                                                        <option value="Funny">Funny</option>
                                                                        <option value="Intelligent">Intelligent</option>

                                                                        <option value="Religious">Religious</option>

                                                                        <option value="Corrupt">Corrupt</option>

                                                                        <option value="Traitor">Traitor</option>

                                                                        <option value="Unskilled">Unskilled</option>

                                                                        <option value="Leader">Leader</option>

                                                                        <option value="Follower">Follower</option>


                                                                        <option value="Selfless">Selfless</option>
                                                                        <option value="Unattractive">Unattractive</option>

                                                                        <option value="Charming">Charming</option>

                                                                        <option value="Communicator">Communicator</option>

                                                                        <option value="Negotiator">Negotiator</option>

                                                                        <option value="Intellectual">Intellectual</option>

                                                                        <option value="Energetic">Energetic</option>

                                                                        <option value="Lethargic">Lethargic</option>

                                                                        <option value="Liar">Liar</option>

                                                                        <option value="Pleasing">Pleasing</option>

                                                                        <option value="Disgusting">Disgusting</option>

                                                                        <option value="Flip-flop">Flip-flop</option>

                                                                        <option value="Competent">Competent</option>

                                                                        <option value="Incompetent">Incompetent</option>
                                                                    </select>
                                                                    <small class="text-muted dis-block">Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.</small>
                                                                </div>
                                                                <script>
                                                                    $('#select-state').selectize({
                                                                        maxItems: 15
                                                                    });
                                                                </script>
                                                            </div>


                                                            <div class="form-group">
                                                                <label class="control-label pull-left" for="message">Detail review:</label>
                                                                <textarea class="required form-control" id="message" name="message" rows="6" placeholder="Please describe the person you are reviewing. Example: Good habits, bad habits, your experiences etc."><?php echo (isset($recommend) ? $recommend->message : ''); ?></textarea>
                                                            </div>
                                                            <a class="btn btn-success" id="btnnxt1"> Review Publicly </a>
                                                        </div>
                                                    </form>
                                                <?php } ?>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#btnnxt1').click(function ()
                                            {

                                                if ($('#message').val().trim().length > 0)
                                                {
                                                    $('#st2').hide();
                                                    $('#st3').hide();
                                                    $('#st1').show();

                                                }
                                                else
                                                {
                                                    alert('Please fill details..');
                                                    $('#message').focus();
                                                }




                                            });
                                            $('#btnnxt3').click(function ()
                                            {

                                                if ($('#first_name').val() == '')
                                                {
                                                    $('#first_name').focus();
                                                }
                                                else if ($('#last_name').val() == '')
                                                {
                                                    $('#last_name').focus();
                                                }
                                                else if ($('#password').val() == '')
                                                {
                                                    $('#password').focus();
                                                }
                                                else
                                                {

                                                    $('#st2').hide();
                                                    $('#st1').hide();
                                                    $('#st3').show();
                                                }
                                            });

                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




<?php } ?>
            </div>
        </div>

        <!-- <?php if (!empty($user->user_detail->location)) { ?>
                 <div class="row">
                     <div class="col-sm-12" id="mapWrap">
                         <div class="map-box pull-right marTop10 marBottom10">
                             <div id="member-location-map" class="marTop10">
                                 <input id="geocomplete" type="hidden" size="90" />
                                 <div class="map_canvas"></div>
                             </div>
                         </div>
                     </div>
                 </div>
         
            <!--google maps javascript-->
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo Kohana::$config->load('settings')->get('location_api_key'); ?>&libraries=places"></script>
            <script src="<?php echo url::base(); ?>js/jquery.geocomplete.min.js" type="text/javascript"></script>
            <script>
                                            $(function () {

                                                var options = {
                                                    map: ".map_canvas",
                                                    location: "<?php echo $user->user_detail->location; ?>"
                                                };

                                                $("#member-location-map .map_canvas").width($("#mapWrap").width());
                                                $("#geocomplete").geocomplete(options);
                                            });
            </script>
<?php } ?> 


        <style>
        body{
            padding-top: 50px !important;
        }
.user-pro-pic-admit {
    width: 200px;
    height: 200px;
    background: #fff;
    overflow: hidden;
    margin: 0px auto;
    position: relative;
    margin-top: -50px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px 1px #d1d1d1;
    border: 5px solid #fff;
    background-size: cover;
    background-position: center center;
}
            .src-image {
                display: none;
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


    </div>
</div>

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
<div class="ribbion-modal modal fade" id="editBasicInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <img src="<?php echo url::base(); ?>img/close.png" />
                                </button>
                                <!-- <div class="ribbion">
                                    <h2>Profession</h2>
                                </div> -->
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