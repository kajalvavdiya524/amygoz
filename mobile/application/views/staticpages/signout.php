<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<section class="default-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
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
<section class="gap gap-fixed-height-medium FloralWhite-bg text-pad-1">        
    <div id="" class="skrollable skrollable-between text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="black-text">It’s a great day to invite someone for lunch.</h3>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="hb-mt-50 hb-mb-20">Your identity is not disclosed to the person you are inviting if the receiver doesn’t want to meet you for lunch.</h4>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?php echo url::base()."login?page=activity";?>" class="btn pad-a-1">Invite</a>
                    </div>
                </div>
            </div>
            
            
        </div> <!-- end container -->
    </div> <!-- end intro -->                
</section>

<section class="text-pad-2">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!--Use this block of code-->

<h4>While you leave, we want you to check out some of the interesting profiles on Callitme</h4>
            </div>
        </div>
    </div>
</section>

<section class="deafult-bg text-pad-2">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h3 class="text-pad-2">Top percentile profiles</h3>
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
                    $photo_image = file_exists("upload/" .$photo);
                           ?>
                     
                       <?php     if($percentile_s>90 && $item_s->photo->profile_pic && $photo_image)
                                {
                                    $k=$k+1;?>
                    <div class="col-sm-3 text-center" style="margin-bottom: 18px;">
                            <div class="imgbox" id="head">

                                <?php 
                                $photo = $item_s->photo->profile_pic;
                                 $photo_image = file_exists("upload/" .$photo);
                                 if ($item_s->photo->profile_pic && $photo_image) { ?>
                                    <img src="<?php echo url::base() . "upload/" . $item_s->photo->profile_pic; ?>" class="img-responsive" style="height:180px;width:180px; border-radius: 50%;margin: 0px auto;">
                                <?php }  else { ?>
                        <div id="inset" >
                            <h1>
                                <?php echo $item_s->user_detail->first_name[0].$item_s->user_detail->last_name[0]; ?>
                            </h1>
                            <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                        </div>
                    <?php } ?>
                            </div>
                            <div class="panel-body">                              
                                <div class="">
                                    <span class="user-name" style="font-size:15px;line-height: 43px;">
                                    <a href="<?php echo url::base() . $item_s->username; ?>" style="color: #fff;">
                                            <?php echo $item_s->user_detail->first_name . " " . $item_s->user_detail->last_name; ?>          
                                        </a>
                                    </span>
                                    <div class="clearfix"></div>
                                     <span class="social-score text-pad-2" style="background: #00bcd4;padding: 5px;">Social percentile: <?php echo $percentile_s;?>%</span>
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
<style type="text/css">
    .panel-body{padding:0px;}
    .pad-a-1
{
    border: 1px solid #ff2a7f;
    width: 50%;
}
.text-pad-1
{
    background: #00bcd4;
    color: #fff;
}
.text-pad-2
{
    background: #ff2a7f;
    color: #fff;
}
</style>

