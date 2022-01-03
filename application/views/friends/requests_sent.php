<?php $session_user = Auth::instance()->get_user(); ?>
<div class="row">
    <div class="col-sm-4">
        <?php echo View::factory('friends/menu', array('submenu' => 'requests_sent')); ?>
    </div>
    <div class="col-sm-8">
        <div class="friends-block hb-p-0">

            <div class="friends">

                <h4 style="color:#096369;">Friend Requests You Sent</h4>

                <?php foreach ($session_user->requests->find_all()->as_array() as $request) { ?>

                 <?php 
                  $recommendations = $request->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                $temp_words = array();
                foreach($recommendations as $recommend) {
                    $words = explode(', ', $recommend->words);
                    $temp_words = array_merge($temp_words, $words);
                }
                $tags = array_count_values($temp_words);
                 ?>
                    <div class="post friend">

                        <div class="row">
                            <div class="col-sm-2">
                                <div class="user-img pull-left">
                                    <a href="<?php echo url::base() . $request->username; ?>">
                                        <?php 
                                        $photo = $request->photo->profile_pic_s;
                                        $rec_image = file_exists("mobile/upload/" .$photo);
                                        $rec_image1 = file_exists("upload/" .$photo);
                                        if (!empty($photo) && $rec_image) { ?>
                                            <img src="<?php echo url::base() . "mobile/upload/" . $request->photo->profile_pic_s; ?>" class="pull-left" width="50" height="50" alt="<?php echo $request->user_detail->first_name." ".$request->user_detail->last_name; ?>">
                                        <?php }
                                        else if (!empty($photo) && $rec_image1) { ?>
                                            <img src="<?php echo url::base() . "upload/" . $request->photo->profile_pic_s; ?>" class="pull-left" width="50" height="50" alt="<?php echo $request->user_detail->first_name." ".$request->user_detail->last_name; ?>">
                                        <?php } else { ?>
                                            <?php if($request->user_detail->first_name){?>
                                            <div id="inset" class="xs hb-mt-0">
                                                <h1>
                                                    <?php echo $request->user_detail->get_no_image_name(); ?>
                                                </h1>
                                                <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                            </div>
                                            <?php } else {?>
                                            <div id="inset" class="xs hb-mt-0">
                                                <h1>
                                                    <?php echo $request->email[0]; ?>
                                                </h1>
                                                <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                            </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="post-title">
                                    <strong>
                                        <a href="<?php echo url::base() . $request->username; ?>">
                                            <?php echo $request->user_detail->first_name . " " . $request->user_detail->last_name; ?>
                                        </a>
                                    </strong>
                                </div>

                                <div class="post-matter collapse-description collapseable in">
                                    <p>
                                        <?php 
                                           $details = array();
                                           if(!empty($request->user_detail->sex))
                                           {
                                             $details[] = $request->user_detail->sex;
                                           }

                                           if(!empty($request->user_detail->phase_of_life))
                                           {
                                              $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                              $details[] = $phase_of_life[$request->user_detail->phase_of_life]; 
                                           }
                                           if(!empty($request->user_detail->location))
                                           {
                                              $det = $request->user_detail->location;
                                              $b = explode(', ', $det);
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
                                       ?>
                                       <span style="color:#FF2A7F">
                                      <strong> Social % <?php echo $request->calculate_social_percentage($tags);?></strong>
                                  </span>
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                        <div style="clear:right;"></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>