
<style>
#imagePreview {
    width: 50px;
    height: 50px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    margin-top: 12px;
    position: relative;top: 2px;right: 6px;overflow: hidden; background-color: white;
}
</style>
<?php foreach($users as $user) { ?>
    <div class="result post" style="background: #1b9aad;box-shadow: 0 0 0 1px rgba(0,0,0,.1), 0 2px 3px rgba(0,0,0,.2);">
    <div class="col-xs-2">
            <center>
        <div id="imagePreview" style="top:2px;">
            <?php if($user->photo->profile_pic_s) { ?>
                <img src="<?php echo url::base()."upload/".$user->photo->profile_pic?>" height="100%">
            <?php } else { ?>
                <div class="xs" id="inset" style="margin-top: 0px;">                           
                    <h1 style="margin-left: 10px;"><?php echo $user->user_detail->first_name[0]."".$user->user_detail->last_name[0]; ?></h1>                      
                </div>
            <?php } ?>
        </div>
        </center>
        </div>

        <div class="col-xs-10">
        <div class="post-content">
            <div class="post-title" style="color: #fff;">
                <strong>
                    <?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>
                </strong>
            </div>
            
            <div class="post-matter" style="margin-left:5px;color: #fff;">
                <?php 
                  $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

                $temp_words = array();
                foreach($recommendations as $recommend) {
                    $words = explode(', ', $recommend->words);
                    $temp_words = array_merge($temp_words, $words);
                }
                $tags = array_count_values($temp_words);
                 ?>
                <p style="color: #fff;">
                    <?php 
                    if(!empty($user->user_detail->location))
                    {
                       /*echo $user->user_detail->location;*/
                       $loc =  $user->user_detail->location; 
                       $b   =  explode(', ', $loc);
                        if(!empty($b[0]) && !empty($b[2]))
                        {
                            echo $b[0].", ".$b[2];
                        }
                        else if(!empty($b[0]))
                        {
                            echo $b[0];
                        }
                        else
                        {
                            echo $b[2];
                        } 
                    }
                    else if(!empty($user->user_detail->home_town))
                    { 
                          echo $user->user_detail->home_town;
                    }
                    else
                    {
                        echo 'Washington, DC, United States';
                    }?>, <br/><strong> Social % <?php echo $user->calculate_social_percentage($tags);?></strong>
                </p>
            </div>
        </div>
        </div>
        <input type="hidden" class="user_email" value="<?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>" />
        <div class="clearfix"></div>
    </div>
<?php } ?>
