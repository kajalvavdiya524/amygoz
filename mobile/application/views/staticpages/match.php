<section class="review-sec-1 gap gap-fixed-height-large">        
    <div class="skrollable skrollable-between" id="intro">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="secondary-text">Do you know two single people who would be a great couple?</h3>
                </div>
                <div class="col-sm-6">
                    <h3 class="secondary-text">Take the lead and become a Match Maker!</h3>
                </div>
            </div>
        </div> <!-- end container -->
    </div> <!-- end intro -->                
</section>

<section id="review" class="secondarybg">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h3>Match Singles</h3>
                <p>Do you know two single people who would be a great couple? Take the lead and become a Match Maker!</p>
            </div>
            <div class="col-sm-4">
                <h1 style="color: #00BCD4;">Matches</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-3 col-sm-offset-3">
                <div class="step">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <h3>Step 1</h3>
                            <p>Select your connection.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="step">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <h3>Step 2</h3>
                            <p>Enter the email address or select the person you want to match with.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="deafult-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <h3>Top percentile profiles</h3>
                <hr>
                <div class="row">
           
           <?php $top_users= DB::select('*',array('COUNT("to")', 'totel'))
                            ->from('recommends')
                            ->where('state','=','approve')
                            ->group_by('to')
                            ->order_by(DB::expr('RAND()'))
                            ->execute();
                            $i = 0;
                          //print_r($top_users);
                                  foreach($top_users as $data_as)
                                  { if($i < 4)
                                    {

                                   $user_id=$data_as['to'];
                                     $user_top=DB::select()->from('users')->where('id','=',$user_id)->where('profile_public','=','0')->execute();
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
                       
                          <div class="imgbox" id="head">
                          
                          <?php if($user_pic['profile_pic']) { ?>
                            <img src="<?php echo url::base()."upload/".$user_pic['profile_pic'];?>" class="img-responsive" style="height: 100%; border-radius: 50%; width: 100%;">
                          <?php } ?>
                          </div>
                          <div class="panel-body">                              
                            <div class="user-title bg_colo">
                                <span class="user-name" style="font-size:15px;">
                                    <a href="<?php echo url::base().$data_single['username'];?>">
                                     <?php echo  $users_detail['first_name']." ".$users_detail['last_name']; ?>          
                                    </a>
                                </span>
                                <div class="clearfix"></div>
                                <span class="social-score">Social percentile: <?php echo $social; ?>%</span>
                            </div>
                          </div>                          
                    </div>
                      

                <?php     }                                          
                 }
                                    }
                                   
                                  $i=$i+1;  }  
                                     }
                                  

               ?> 
          </div>
        </div>
    </div>
</div>
</section>
<!--<section id="crush" class="secondary-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h3>Match Making</h3>
                <p>Get started with these simple steps.</p>
            </div>
            <div class="col-sm-4">
                <h1>Making</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-4">
                <div class="step">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <h3>Step 1</h3>
                            <p>Select an activity of your interest.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="step">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <h3>Step 2</h3>
                            <p>Enter the email address of your crush.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="step">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <h3>Step 3</h3>
                            <p>If you want, select a statement that best decribes your crush.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>-->



<!--<section class="deafult-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Top percentile profiles</h3>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="panel panel-default coupon">
                          <div class="panel-heading" id="head">
                            <img src="http://Callitme.com/upload/pp-6-nlnFNhe7.jpg" class="img-responsive">
                          </div>
                          <div class="panel-body">                              
                            <div class="user-title">
                                <span class="user-name">
                                    <a href="http://Callitme.com/ash">
                                        Ash Shrivastav            
                                    </a>
                                </span>
                                <div class="clearfix"></div>
                                <span class="social-score">Social percentile: Top 91%</span>
                            </div>
                          </div>                          
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

<section class="gap gap-fixed-height-small intro-sec-2 primary-bg">
    <div class="container">
        <p class="quote-text center-block text-center midnight-blue-text">Callitme started as a class project at Harvard where the initial idea was to match two friends who were too shy to express their feelings. Today, with added features, Callitme has become your hub for people review, match making and social dating. </p>
    </div>
</section>-->

<section id="home-bottom" class="hb-pt-50 hb-pb-30">

    <div class="container">
        
        <!--Object on left begin-->
        <div class="home-left pull-left">
            <!--<div class="home-left-content">-->
      	 Building trust online through reviews

        </div>
     <!--Object on left end--> 
     



<!--
        <div class="home-left pull-left" id="features">
            <div class="home-left-content">

                <ul>
                    <li class="features review">
                       <span>Review people</span>
                    </li>
                    <li class="features match">
                        <span>Match singles</span>
                    </li>

                    <li class="features find">
                        <span>Find singles around you</span>
                    </li>
                    <li class="features send">
                        <span>Ask your crush out anonymously</span>
                    </li>
                </ul>
               
            </div>
        </div> 
        
        -->

        <div class="home-register-box pull-right">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        Register Now
                        <small>Its Free</small>
                    </h3>
                </div>
                <form role="form" class="validate-form register-form" method="post" action="<?php echo url::base()."pages/signup"; ?>">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!--<label class="control-label" for="first_name">First Name</label>-->
                                    <input type="text" class="required form-control" id="first_name" name="first_name" placeholder="First Name">
                                </div>
                                <div class="col-sm-6">
                                    <!-- <label class="control-label" for="last_name">Last Name</label>-->
                                    <input type="text" class="required form-control" id="last_name" data-placement="top" name="last_name" placeholder="Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group dis-in-block">
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
                                        <?php foreach(Kohana::$config->load('profile')->get('phase_of_life') as $key => $value) { ?>
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
                                        <?php for($i = 1;$i<=31;$i++) { ?>
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php } ?>      
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select id="yearOfBirth" class="dis-in-block form-control" name="year" >
                                        <option value="">Year:</option>
                                        <?php $y = date('Y'); ?>
                                        <?php for($n = $y-100;$n<=$y;$n++) { ?>
                                                <option value="<?php echo $n;?>"><?php echo $n;?></option>
                                        <?php } ?> 
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!--<label class="control-label" for="email">Email address</label>-->
                                    <input type="email" class="required email uniqueEmail form-control"  name="email" id="email" placeholder="Enter email">
                                </div>
                                <div class="col-sm-6">
                                    <!--<label class="control-label" for="password">Password</label>-->
                                    <input type="password" class="required form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-5 answer-varification">
                                    <label class="control-label" for="message">Answer:</label>
                                    <?php 
                                        $first = rand(1, 20);
                                        $second = rand(1, 20);
                                        $total = ($first+$second);
                                    ?>
                                    <input type="hidden" value="<?php echo $total;?>" name="total" id="total">
                                    <?php echo "( ".$first." + ".$second." ) = "; ?>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control required digits" name="answer" placeholder="Type your answer here">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-secondary pull-left marTop10 marRight20">Join Now</button>

                        <p class="terms marTop10">
                            By clicking "Join Now" or using Callitme, you agree to our <a href="<?php echo url::base()."company/terms"; ?>" class="cyan"><strong>User Agreement</strong></a> and
                            <a href="<?php echo url::base()."company/privacypolicy"; ?>" class="cyan"><strong>Privacy Policy.</strong></a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>

   <!--<div id="home-middle">
    
        <div class="container">
         
         <div id="recommendation" class="steps">
            <h3> Callitme is a crowd powered people review network where you can review your friends & family, match your single friends, anonymously ask your crush out for a date, and find singles around you.</h3>
            </div>
            
            <hr class="center" />
            
            <div id="recommendation" class="steps">
                <h1>Review people</h1>
                <h3>You have reviewed products and businesses, now you get to review people. </h3>
                <ul>
                    <li class="step">
                        <span class="step-icon step-1"></span>
                        <span class="step-content">Enter the email address of the person you want to review</span>
                    </li>
                    <li class="step">
                        <span class="step-icon step-2"></span>
                        <span class="step-content">Pick the relationship between you and the person you are reviewing</span>
                    </li>
                    <li class="step">
                        <span class="step-icon step-3"></span>
                        <span class="step-content">Choose the attributes that best describes the person</span>
                    </li>
                    <li class="step">
                        <span class="step-icon step-4"></span>
                        <span class="step-content">Describe the person</span>
                    </li>
                </ul>
            </div>
            
            
            <hr class="center" />
              <div id="anonymous" class="steps">
                <h1>Ask your crush out anonymously</h1>
                <h3>No one wants to be rejected! You don't have to be. Invite your crush out on a date anonymously. Only mutual crush will be disclosed. </h3>

                <ul>
                    <li class="step">
                        <span class="step-icon step-1"></span>
                        <span class="step-content">Select an activity of your interest</span>
                    </li>
                    <li class="step">
                        <span class="step-icon step-2"></span>
                        <span class="step-content">Enter the email address of your crush</span>
                    </li>
                    <li class="step">
                        <span class="step-icon step-3"></span>
                        <span class="step-content">If you want, select a statement that best decribes your crush</span>
                    </li>
                    <li class="step">
                        <span class="step-icon step-4"></span>
                        <span class="step-content">Tell your crush something about yourself</span>
                    </li>
                </ul>    
            </div>
            
            <hr class="center" />
            
            <div id="match" class="steps">
                <h1>Match singles</h1>
                <h3>Do you know two single people who would be a great couple? Take the lead and become a Match Maker!</h3>
                <ul>
                    <li class="step">
                        <span class="step-icon step-1"></span>
                        <span class="step-content">Select your connection</span>
                    </li>
                    <li class="step">
                        <span class="step-icon step-2"></span>
                        <span class="step-content">Enter the email address or select the person you want to match with</span>
                    </li>

                </ul>
            </div>
            <hr class="center" />
              <div id="match" class="steps">
                <h1>Find singles around you</h1>
                <h3>You don’t have to become Christopher Columbus and voyage around the world in search of a date. Your next door neighbor may be your match.</h3>
            </div>

        </div>

   </div>-->


    <!--<div id="section-steps">
    Disclaimer: The content of the site is generated by members of Callitme.com. Members are not pre-screened by Callitme and Callitme.com takes no responsibility of the content on this site. Callitme and its owners, employees or affiliates are not responsible for any consequenses that may arise if you use this site. By using this website, you agree that you use the site at your own risk and assume all responsibility for the consequences and hold the owners or any affiliates of Callitme harmless.
    </div>-->
    <style type="text/css">
    #sidemenu-up-block > .user-title, .user-title { 
        background-color:#F5F5F5;
        margin-right:27px;

     }

    </style>
    
    