<?php
$i = 0;
$total_users = count($users);
if ($total_users == 0) {
    ?>
    <div class="result-content">
        <h5>No result found</h5>
    </div>
<?php } else { ?>
    <?php foreach($users as $user) { ?>

        <?php if ($i < 5) { ?>
            <div class="post friends_for_noti">
                <a href="<?php echo url::base().$user->username; ?>">
                    <div class="user-img hb-mr-5 pull-left picbox">
                        <?php 
                            $photo = $user->photo->profile_pic_s;
                            $search_image = file_exists("mobile/upload/" .$photo);
                            $search_image1 = file_exists("upload/" .$photo);
                         if(!empty($photo) && $search_image) { ?>
                            <img src="<?php echo url::base()."mobile/upload/".$user->photo->profile_pic_s;?>" width="100%" height="100%">
                        <?php }
                        else if(!empty($photo) && $search_image1) { ?>
                            <img src="<?php echo url::base()."upload/".$user->photo->profile_pic_s;?>" width="100%" height="100%">
                        <?php } else { ?>
                            <div id="inset" class="xs">
                                <h1>
                                    <?php echo $user->user_detail->first_name[0].$user->user_detail->last_name[0]; ?>
                                </h1>
                                <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="post-content">
                        <div class="post-title">
                            <strong>
                                <?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>
                            </strong>
                        </div>
                        
                        <div class="post-matter">
                            <p>
                                <?php
                                   if($user->profile_public == '1')
                                   {
                                            $details = array();

                                            if(!empty($user->user_detail->designation)) {
                                                $details[] = $user->user_detail->designation;
                                            }
                                            
                                            if(!empty($user->user_detail->phase_of_life)) {
                                                $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                                $details[] = $phase_of_life[$user->user_detail->phase_of_life];
                                            }
                                             
                                            /*if(!empty($user->user_detail->location)) {
                                                $details[] = $user->user_detail->location;
                                            }*/

                                            if(!empty($user->user_detail->location)) 
                                            {
                                                $det = $user->user_detail->location;
                                                $b = explode(',', $det);
                                                if(!empty($b[0]) && !empty($b[2]))
                                                {
                                                    $details[] = $b[0].", ".$b[2];
                                                }
                                                else if(!empty($b[0]))
                                                {
                                                    $details[] = $b[0];
                                                }
                                                else
                                                {
                                                    $details[] =  $b[2];
                                                }
                                            }

                                            echo implode(', ', $details);
                                   }
                                   else
                                   {
                                            $details = array();
                                            if(!empty($user->user_detail->sex)) {
                                                $details[] = $user->user_detail->sex;
                                            }
                                            
                                            if(!empty($user->user_detail->phase_of_life)) {
                                                $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                                $details[] = $phase_of_life[$user->user_detail->phase_of_life];
                                            }
                                            
                                            /*if(!empty($user->user_detail->location)) {
                                                $details[] = $user->user_detail->location;
                                            }*/

                                            if(!empty($user->user_detail->location)) 
                                            {
                                                $det = $user->user_detail->location;
                                                $b = explode(',', $det);
                                                if(!empty($b[0]) && !empty($b[2]))
                                                {
                                                    $details[] = $b[0].", ".$b[2];
                                                }
                                                else if(!empty($b[0]))
                                                {
                                                    $details[] = $b[0];
                                                }
                                                else
                                                {
                                                    $details[] =  $b[2];
                                                }
                                            }
                                            
                                            echo implode(', ', $details);
                                   }
                                ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                </a>
            </div>
        <?php } else { ?>
            <div class="post friends_for_noti">
                <form action="<?php echo url::base() . 'members/search'; ?>" method="post">

                    <h5 style="margin-left: 5px;"><?php echo $total_users - 5; ?> More available </h5>
                    <input type="hidden" name="search_word" value="<?php print_r($search_word); ?>">
                    <input type="submit" style="background: none;border: 0px;font-size: 20px;color: #FD8D3C;" value="See more result for '<?php print_r($search_word); ?>'"  name="submit">

                </form>
            </div>
        <?php break; } ?>

    <?php
        $i++;
        }
    ?>
<?php } ?>