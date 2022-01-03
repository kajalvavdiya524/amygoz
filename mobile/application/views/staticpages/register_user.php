<?php foreach($users as $user) { ?>
    <div class="result post">
        <div class="user-img pull-left">
            <?php if($user->photo->profile_pic_s) { ?>
                <img src="<?php echo url::base()."upload/".$user->photo->profile_pic_s?>">
            <?php } else { ?>
                <img src="<?php echo url::base()."img/no_image_s.png";?>">
            <?php } ?>
        </div>
        
        <div class="post-content">
            <div class="post-title">
                <strong>
                    <?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>
                </strong>
            </div>
            
            <!-- <div class="post-matter">
                <p>
                    <?php //echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>
                </p>
            </div> -->

            <div class="post-matter">
                <?php 
                  $recommendations = $user->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();

                $temp_words = array();
                foreach($recommendations as $recommend) {
                    $words = explode(', ', $recommend->words);
                    $temp_words = array_merge($temp_words, $words);
                }
                $tags = array_count_values($temp_words);
                 ?>
                <p>
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
                    }?>, <strong> Social % <?php echo $user->calculate_social_percentage($tags);?></strong>
                </p>
            </div>
        </div>
        
        <input type="hidden" class="user_email" value="<?php echo $user->email; ?>" />
        <div class="clearfix"></div>
    </div>

<?php } ?>