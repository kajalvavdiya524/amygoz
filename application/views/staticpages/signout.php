<section class="default-bg text-center">
    <div class="container text-center">
        <div class="row text-center">
            <div class="col-xs-6 text-center" style="margin-left: 274px;">
                <div class="alert alert-success alert-labeled hb-mt-15">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                    </button>
                    <div class="alert-labeled-row">
                        <p class="alert-body alert-body-right alert-labelled-cell">
                           <span class="alert-label alert-label-left alert-labelled-cell">
                            <i class="glyphicon glyphicon-info-sign"></i>
                        </span>You have signed out! Please come back soon!!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="gap gap-fixed-height-medium">        
    <div id="intro" class="skrollable skrollable-between">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-left" style="/*background: whitesmoke*/;">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                     <h3 class="black-text" style="font-size: 28px;">It’s a great day to invite someone for lunch.</h3>
                        <h4 class="" style="color:#666;line-height: 37px;font-size: 18px;text-align:center;padding: 15px;font-family: tahoma;">Your identity is not disclosed to the person you are inviting if the receiver doesn’t want to meet you for lunch.</h4>
                        <br/>
                        <a href="<?php echo url::base()."login?page=activity";?>" class="btn btn-primary btn-block btn-lg" style="width: 30%;margin: 0px auto;">Invite</a>
                        <br/>
                        <h3 style="font-size: 19px;line-height: 41px;color: #00bcd4;">While you leave, we want you to check out some of the interesting profiles on Callitme</h3>
                    </div>
                    <div class="col-sm-6">
                    <div class="text-center">
                        <h3 style="font-size: 28px;color:black;">Review Public Profile</h3>
                        <div class="text-center">
            <div class="">
                <h4>Top Public Profile</h4>
                <?php
                foreach($public_user as $item_fs)
                {
                    $recommendations = $item_fs->recommendations->where('state', '=', 'approve')->limit(2)->order_by('time', 'desc')->find_all()->as_array();
                    $recdations = $item_fs->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                    $temp_words = array();
                    foreach($recdations as $recommend) 
                    {
                        $words = explode(', ', $recommend->words);
                        $temp_words = array_merge($temp_words, $words);
                    }
                    $tags = array_count_values($temp_words);
                    $percentile_s= $item_fs->friends->calculate_social_percentage($tags);
                ?>
                <div class="row shad-item">
                    <div class="col-xs-12 colgit">
                        <div class="col-xs-5">
                        <div class="imgbox" id="head">
                            <?php
                            $photo = $item_fs->photo->profile_pic;
                            $photo_image = file_exists("mobile/upload/" .$photo);
                            $photo_image1 = file_exists("upload/" .$photo);
                            if (!empty($photo) && $photo_image) { ?>
                                <img src="<?php echo url::base() . "mobile/upload/" . $item_fs->photo->profile_pic; ?>" alt="<?php echo $item_fs->user_detail->first_name." ".$item_fs->user_detail->last_name;?>" class="img-responsive" style="height:100%;width:100%; border-radius: 50%;">
                            <?php }
                            else if (!empty($photo) && $photo_image1) { ?>
                                <img src="<?php echo url::base() . "upload/" . $item_fs->photo->profile_pic; ?>" alt="<?php echo $item_fs->user_detail->first_name." ".$item_fs->user_detail->last_name;?>" class="img-responsive" style="height:100%;width:100%; border-radius: 50%;">
                            <?php }  else { ?>
                                <div id="inset" style="width: 95px;height: 95px !important;min-height: 95px !important;border-radius: 50%;">
                                    <h1 style="font-size: 47px;line-height: 49px;">
                                        <?php echo $item_fs->user_detail->first_name[0].$item_fs->user_detail->last_name[0]; ?>
                                    </h1>
                                </div>
                            <?php } ?>
                        </div>
                        <br/>
                        <p class="user-name" style="font-size:15px;margin-top: -15px;">
                                        <a href="<?php echo url::base() . $item_fs->username; ?>">
                                            <?php echo $item_fs->user_detail->first_name . " " . $item_fs->user_detail->last_name; ?>
                                        </a>
                                    </p>
                        </div>
                            <div class="col-sm-7" style="position: relative;top: -25px;">
                               <div class="row mar-hy-10 text-center">
                                    <div class="circular-bar marTop10">
                                        <input type="text" class="dial" data-fgColor="#ff1744" data-width="100" data-height="100" data-linecap=round  value="<?php echo $percentile_s;?>" style="margin-top: 0px">
                                        <div class="circular-bar-content">
                                            <label style="font-size: 25px;margin-left: 6px;margin-top: 13px;"></label>
                                        </div>
                                    </div>
                                    <h5 class="text-center" style="color: black;margin-top: -69px;margin-left: 4px;text-align: center;">Social<br/> percentile</h5>
                                </div>
                             </div>
                        </div>
                        <br/><br/> <br/> <br/> <br/>
                        <?php foreach ($recommendations as $recommendation) 
                        {  
                            if( $recommendation->type=='1')
                            { ?>
                            <div class="col-xs-12" style="margin-top: 20px;">
                            <div class="col-xs-3">
                            <div id="imagepadt" style="top: -3px;left: -7px;">
                            <?php  
                                $photo = $recommendation->owner->photo->profile_pic;
                                $photo_image = file_exists("mobile/upload/" .$photo);
                                $photo_image1 = file_exists("upload/" .$photo);
                                if (!empty($photo) && $photo_image) { ?>
                                    <img src="<?php echo url::base() . "mobile/upload/" . $recommendation->owner->photo->profile_pic; ?>" alt="<?php echo $recommendation->owner->user_detail->first_name." ".$recommendation->owner->user_detail->last_name;?>" height="100%">
                                <?php }
                                else if (!empty($photo) && $photo_image1) { ?>
                                    <img src="<?php echo url::base() . "upload/" . $recommendation->owner->photo->profile_pic; ?>" alt="<?php echo $recommendation->owner->user_detail->first_name." ".$recommendation->owner->user_detail->last_name;?>" height="100%">
                                <?php }  else { ?>
                                    <div id="inset" style="width: 45px;height: 45px !important;min-height: 45px !important;">
                                        <h1 style="font-size: 18px;line-height:0px;">
                                            <?php echo $recommendation->owner->user_detail->first_name[0].$recommendation->owner->user_detail->last_name[0]; ?>
                                        </h1>
                                    </div>
                            <?php } ?>
                            </div>
                            </div>
                            <div class="col-xs-9 text-left" style="position: relative;left: -32px;top: -3px;">
                                <a href="<?php echo url::base() . $recommendation->owner->username; ?>">
                                    <?php echo $recommendation->owner->user_detail->first_name . " " . $recommendation->owner->user_detail->last_name; ?>
                                </a>
                                <br/>
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
                            <div class="col-xs-12 text-left">
                                  <?php echo substr($recommendation->message, 0, 50)."....."; ?>
                            </div>
                             
                            </div>
                            <?php }?>
                            <?php if( $recommendation->type=='0')
                            { ?>
                            <div class="col-xs-12" style="margin-top: 20px;">
                            <div class="col-xs-3">
                            <div id="imagepadt" style="top: -3px;left: -7px;">
                                <img src="<?php echo url::base() . "img/no_image_s.png"; ?>" height="100%">
                            </div>
                            </div>
                            <div class="col-xs-9 text-left" style="position: relative;left: -32px;top: -3px;">
                                <a>
                                    Anonymous User
                                </a>
                                <br/>
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
                            <div class="col-xs-12 text-left">
                                   <?php echo substr($recommendation->message, 0, 50)."....."; ?>
                            </div>
                             
                            </div>
                            <?php }?>
                        <?php } ?>
                        <div class="col-xs-12 mar-ghy">
                        <a href="<?php echo url::base(); ?>login?page=<?php echo $item_fs->username; ?>" style="color:#fff;background: #00bcd4;border: none;padding: 10px;">VIEW MORE
                        </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>                      
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </div> <!-- end intro -->                
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!--Use this block of code-->


            </div>
        </div>
    </div>
</section>
<br/><br/>
<section class="deafult-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 style="color: #FF2A7F;">Top percentile profiles up</h3>
                <hr>
                <div class="row">

<?php
           shuffle($item);
            $k=0;

            foreach ($item as $item_s) 

                {        $recommendations = $item_s->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                                         $temp_words = array();
                                        foreach($recommendations as $recommend) {
                                        $words = explode(', ', $recommend->words);
                                        $temp_words = array_merge($temp_words, $words);
                                    }
                                        $tags = array_count_values($temp_words);

                           $percentile_s= $item_s->friends->calculate_social_percentage($tags);
                    $photo = $item_s->photo->profile_pic;
                    $photo_image = file_exists("mobile/upload/" .$photo);
                           ?>
                     
                       <?php     if($percentile_s>90 && $item_s->photo->profile_pic && $photo_image)
                                {
                                    $k=$k+1;?>
                    <div class="col-sm-3" style="box-shadow: 0 0 0 1px rgba(0,0,0,.1),0 2px 3px rgba(0,0,0,.2);padding: 10px;">
                            <div class="imgbox" id="head">

                                <?php 
                                $photo = $item_s->photo->profile_pic;
                                 $photo_image = file_exists("mobile/upload/" .$photo);
                                 if ($item_s->photo->profile_pic && $photo_image) { ?>
                                    <img src="<?php echo url::base() . "mobile/upload/" . $item_s->photo->profile_pic; ?>" alt=" <?php echo $item_s->user_detail->first_name." ".$item_s->user_detail->last_name; ?>" class="img-responsive" style="height:100%;width:100%; border-radius: 50%;">
                                <?php }  else { ?>
                        <div id="inset" >
                            <h1>
                                <?php echo $item_s->user_detail->first_name[0].$item_s->user_detail->last_name[0]; ?>
                            </h1>
                            <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                        </div>
                    <?php } ?>
                            </div>
                            <div class="text-center">                              
                                <div class="">
                                    <span class="user-name" style="font-size:15px;">
                                        <a href="<?php echo url::base() . $item_s->username; ?>">
                                            <?php echo $item_s->user_detail->first_name . " " . $item_s->user_detail->last_name; ?>          
                                        </a>
                                    </span>
                                    <div class="clearfix"></div>
                                     <span class="social-score">Social percentile: <?php echo $percentile_s;?>%</span>
                                </div>
                            </div>                   
                    </div>
                  <?php 
                  if($k > 3){
                   break;
                  }
              }
                 }?> 
                </div>
            </div>
        </div>
    </div>
</section>
<br/><br/>
<style type="text/css">
    .panel-body{padding:0px;}
    #imagepadt {
    width: 45px;
    height: 45px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-top: 3px;
    position: relative;
    right: 19px;
    overflow: hidden;
}

.shad-item {
    box-shadow: 0 0 0 1px rgba(0,0,0,.1),0 2px 3px rgba(0,0,0,.2);
    padding: 6px 2px;
    margin: 0px 3px;
    border-radius: 15px 15px 0px 0px;
}
.colgit{background: #e6e7e7;
    }
.mar-ghy{margin:20px;}
</style>
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