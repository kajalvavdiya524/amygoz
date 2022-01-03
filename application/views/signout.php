<section class="primary-bg">
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
                        </span> You've signed out
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="gap gap-fixed-height-large primary-bg">        
    <div id="intro" class="skrollable skrollable-between">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>See you again soon!</h3>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="hb-mt-50 hb-mb-20">Less screen time is better
                        </h4>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?php echo url::base()."login";?>" class="btn btn-primary btn-block btn-lg hb-mt-40">Login Again</a>
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
                <!--Will put some ad here-->

            </div>
        </div>
    </div>
</section>

<!-- <section class="deafult-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <h3>Trending profiles</h3>
                <hr>
                <div class="row">
           
           <?php $top_users= DB::select('*',array('COUNT("to")', 'totel'))
                            ->from('recommends')
                            ->where('state','=','approve')
                            ->group_by('to')
                            ->order_by('totel','desc')
                            ->limit(4)
                            ->execute();

                          //print_r($top_users);
                                  foreach($top_users as $data_as)
                                  {
                                   $user_id=$data_as['to'];
                                     $user_top=DB::select()->from('users')->where('id','=',$user_id)->execute();
                                                 foreach($user_top as $data_single)
                                                 {
                                                    $single_username=$data_single['username'];
                                                    //echo $single_username."<br>";
                                                    $recommendations = DB::select()
                                                    ->from('recommends')
                                                    ->where('state', '=', 'approve')
                                                    ->where('to','=',$user_id)
                                                    ->order_by('time', 'desc')
                                                    ->execute();

                                                          foreach($recommendations as $single_data)
                                                          {
                                                            //echo $single_data['words'];
                                                         $temp_words = array();
                                                            $words = explode(', ', $single_data['words']);

                                                             $temp_words = array_merge($temp_words, $words);
                                                          }
                                                            $tags = array();    
                                                           $tags = array_count_values($temp_words); 
                                                            

                                                            if(!empty($tags)) {
                                                                                    $keys = array_keys($tags);
                                                                                    
                                                                                    $multi = 0;
                                                                                    $weightages = DB::select()->from('recommend_words')->where('word', 'IN', $keys)->execute();
                                                                                    
                                                                                    foreach($weightages as $weightage) {

                                                                                        if(array_key_exists($weightage['word'], $tags)) {
                                                                                            $multi += ($tags[$weightage['word']]*$weightage['weightage']);
                                                                                        }

                                                                                    }

                                                                                    $sum = 0;
                                                                                    foreach($tags as $tag) {
                                                                                        $sum += $tag;
                                                                                    }
                                                                                    
                                                                                    $social = round(($multi/$sum)*100); //normalizing and rounding
                                                                                } else {
                                                                                    $social = 0;
                                                                                }


                                                          $users_details=DB::select()
                                                          ->from('user_details')
                                                          ->where('id','=',$data_single['user_detail_id'])
                                                            ->execute();

                                                          foreach($users_details as $users_detail){
                                                    // echo  $social; 
                                                    $user_pics=DB::select()->from('photos')->where('id','=',$data_single['photo_id'])->execute();
                                                    foreach($user_pics as $user_pic){

                                                        ?>
                                                            <div class="col-sm-3">
                        <div class="panel panel-default coupon">
                          <div class="panel-heading" id="head">
                          
                          <?php if($user_pic['profile_pic']) { ?>
                            <img src="<?php echo url::base()."upload/".$user_pic['profile_pic'];?>" class="img-responsive">
                          <?php } ?>
                          </div>
                          <div class="panel-body">                              
                            <div class="user-title">
                                <span class="user-name" style="font-size:15px;">
                                    <a href="http://ipintoo.com/<?php echo $data_single['username'];?>">
                                     <?php echo  $users_detail['first_name']." ".$users_detail['last_name']; ?>          
                                    </a>
                                </span>
                                <div class="clearfix"></div>
                                <span class="social-score">Social: <?php echo $social; ?>%</span>
                            </div>
                          </div>                          
                        </div>
                    </div>
                      

                <?php     }                                          
                 }
                                    }
                                  }
                                  

               ?> 
          </div>
        </div>
    </div>
</div>
</section> -->