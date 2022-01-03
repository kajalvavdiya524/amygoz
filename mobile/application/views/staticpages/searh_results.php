<style>
#imagePreview {
    width: 82px;
    height: 82px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-top: 3px;
    position: relative;top: -7px;right: 6px;overflow: hidden; background-color: white;
}
</style>
<?php
$clas_div='col-sm-8';
$flag=1;
if($session_user = Auth::instance()->get_user()){
    $clas_div='col-sm-12';
    $flag=0;

}?>
<head>
<title>
    <?php echo $search_for; ?> - Callitme Search 
</title>
</head>


<div class="row">
<div class="row">
    <?php    if($flag==1){?>
    <div class="col-sm-2">
        <div class="col-sm-12 hb-pt-10" >

<!--image ad wil go here-->
        </div>


        <div class="col-sm-12 hb-pt-10" >

<!--image ad wil go here-->
        </div>



        </div>
    <?php }?>
<div class="<?php echo $clas_div;?>">
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
          
                <hgroup class="">
                    <h1>Search Results</h1>
                     <?php if(count($search_user)==1){?>
                    <h2 class="lead"><strong class="text-danger"><?php echo count($search_user) ?></strong> result  found for the search <strong class="text-danger"><?php echo $search_for; ?></strong></h2>                               
               <?php } elseif(count($search_user)>1){?>
                <h2 class="lead"><strong class="text-danger"><?php echo count($search_user) ?></strong> results found for the search <strong class="text-danger"><?php echo $search_for; ?></strong></h2>                               
                 <?php }else{?>
                 <h2 class="lead"> No result found</h2>                               
                 <?php } ?>
                </hgroup>
                
               
            </div>
        </div>
        
        <div class="search_result main-content row">

            <?php
            foreach ($search_user as $searchuser) {

            $recommendations = $searchuser->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

            $temp_words = array();
            foreach ($recommendations as $recommend) {
                $words = explode(', ', $recommend->words);
                $temp_words = array_merge($temp_words, $words);
            }
            $tags = array_count_values($temp_words);



            $n = ORM::factory('friendship')->where('user_id', '=', $searchuser->id)->count_all();
            ?>
            <div class="col-sm-12 text-center">

                <div class="row" style="background-color:white;">

                    <div class="col-sm-12"  style="margin-top: 21px;">
                    <center>
                        <div id="imagePreview">
                            <?php if ($searchuser->photo->profile_pic_s) { ?>
                                <img src="<?php echo url::base() . "upload/" . $searchuser->photo->profile_pic_s; ?>" alt="<?php echo $searchuser->user_detail->first_name . " " . $searchuser->user_detail->last_name; ?>" height="100%;">
                            <?php } else { ?>
                                <div id="inset" style="width:100%; height:100%;margin-top:0px;" class="md">
                                    <h1 style="line-height: 75px;">
                                        <?php echo $searchuser->user_detail->first_name[0] . $searchuser->user_detail->last_name[0]; ?>
                                    </h1>

                                </div>
                            <?php } ?>
                        </div>
                  </center>
                        <a href="<?php echo url::base() . $searchuser->username; ?>" class="btn btn-secondary btn-block hb-mt-10 btn-sm">View Profile</a>
                        
                    </div>

                    <div class="col-sm-10">

                        <div class="row">

                            <div class="col-sm-8">

                                <h4 class="hb-mb-0">
                                   <a href="<?php echo url::base().$searchuser->username;?>">
                                    <?php
                                        echo $searchuser->user_detail->first_name . " " . $searchuser->user_detail->last_name;
                                    ?>
                                    </a>
                                </h4>

                                <p class="hb-mb-0">

                                    <?php $display_details = array();
                                    if(!empty($searchuser->user_detail->designation)) { 
                                    $display_details[] = $searchuser->user_detail->designation;//$searchuser->user_detail->sex; 
                                    } ?>
 
                                   <?php if (!empty($searchuser->user_detail->education)) {
                                        //$phase_of_life = Kohana::$config->load('profile')->get('education');
                                        $display_details[] = $searchuser->user_detail->education;
                                    }
                                    echo implode(', ', $display_details)
                                    ?><br>

                                    
                                    <?php if($searchuser->user_detail->location){?>
                                    Lives in: <?php echo $searchuser->user_detail->location; ?><br>
                                    <?php } if($searchuser->user_detail->website){?>
                                    Website: <a target="_blank" href="<?php echo url::base().$searchuser->username;//$searchuser->user_detail->website; ?>"><?php echo url::base().$searchuser->username;//$searchuser->user_detail->website; ?></a><br>
                                    <?php } ?>
                                </p>
                                <?php if(Auth::instance()->logged_in()) {?>
                                <p class="hb-mb-0">
                                <div class="row" style="margin: 30px 0px 30px 0px;">
                                    <a style="padding: 11px;border: 1px solid #11a7bc;color: black;" href="<?php echo url::base()."chat/compose?user=".$searchuser->username; ?>">Message</a> <a style="padding: 11px;border: 1px solid #11a7bc;color: black;" href="<?php echo url::base()."activity"; ?>">Send Request</a> <a style="padding: 11px;border: 1px solid #11a7bc;color: black;" href="<?php echo url::base()."peoplereview/compose?ask=".$searchuser->username; ?>">Review</a>
                                    </div>
                                </p>
                            <?php }?>
                            </div>
                            
                            <div class="col-sm-4">
                                <button class="btn btn-transparent btn-block"><strong class="secondary-text large-text"><?php echo $searchuser->calculate_social_percentage($tags); ?>%</strong> Social</button>
                                <?php if($searchuser->profile_public == '0'){?><button class="btn btn-transparent btn-block"><strong class="secondary-text large-text"><?php echo $n; ?></strong> Friends</button><?php } ?>
                                <button class="btn btn-transparent btn-block"><strong class="secondary-text large-text"><?php echo count($recommendations); ?></strong><?php if(count($recommendations) > 1) { ?> Reviews<?php } else{ ?> Review<?php }?></button>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <?php } ?>

        </div>
        <!--
        <a href="https://www.callitme.com/import"><button class="btn btn-transparent"><strong class="secondary-text large-text"><?php //echo $n; ?></strong>Search Again</button></a>-->
    <div class="col-sm-12 hb-pt-10" >

<!--image ad wil go here-->
    </div>
    </div>
    </div>
   <?php    if($flag==1){?>
        <div class="col-sm-2">
            <div class="col-sm-12 hb-pt-10" >

<!--image ad wil go here-->
            </div>



            <div class="col-sm-12 hb-pt-10" >

<!--image ad wil go here-->
            </div>
        </div>
    <?php }?>
    </div>
</div>
</div>