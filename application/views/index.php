<section id="home-bottom" class="hb-pt-50 hb-pb-30" style="background: #f06163;">
    <div class="container">
        <!--Object on left begin-->
        <!-- <div class="home-left pull-left">
        <h3 class="pink-text">TIRED OF HEARING ALL THE HUMBLE BRAGS?</h3>
        <h4 class="black-text">We are building a trusted community on the web. The Internet is too crowded with people bragging about themselves. Let’s see what people they know say about them.</h4>
        <h3 class="black-text">Review people you know and connect with the trusted strangers. Meeting strangers is always exciting! Just be sure to check their reviews and their percentile.</h3>
        </div> -->
        <div class="home-left pull-left">
        <!-- <h3 class="pink-text">TIRED OF HEARING ALL THE HUMBLE BRAGS?</h3> -->
        <h4 class="black-text" style="font-size: 60px;font-weight: bold;font-family: arial;margin-top: 120px;color: #fff !important;">Find and get inspired by great people</h4>
    </div>
        
<!--Object on right begin-->
        <div class="home-register-box pull-right">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        Join Now
                        <small>Its Free</small>
                    </h3>
                </div>
                <form role="form" class="validate-form register-form" method="post" action="<?php echo url::base() . "pages/signup"; ?>">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!--<label class="control-label" for="first_name">First Name</label>-->
                                    <input type="text"  class="required form-control" id="first_name" name="first_name" placeholder="First Name" onkeypress="return onlyAlphabets(event,this);" onkeyup="this.value=this.value.replace(/[^A-z/a-z]/g,'');" value="<?php echo Request::current()->post('first_name'); ?>">
                                </div>
                                <div class="col-xs-12 hb-mt-10 visible-xs"></div>
                                <div class="col-sm-6">
                                    <!-- <label class="control-label" for="last_name">Last Name</label>-->
                                    <input type="text"  class="required form-control" id="last_name" name="last_name" placeholder="Last Name" onkeypress="return onlyAlphabets(event,this);" onkeyup="this.value=this.value.replace(/[^A-z/a-z]/g,'');" value="<?php echo Request::current()->post('last_name'); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <!--<label class="control-label" for="sex">I am:</label>-->
                                    <select name="sex" class="required form-control">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 hb-mt-10 visible-xs"></div>
                                <div class="col-sm-6 col-xs-12">
                                    <!--<label class="control-label" for="birthday" class="required">Phase of Life:</label>-->
                                    <select name="phase_of_life" class="form-control required">
                                        <option value="">Phase of Life:</option>
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
                                <div class="col-xs-12 hb-mt-10 visible-xs"></div>
                                <div class="col-sm-4">
                                    <select name="day" class="dis-in-block form-control">
                                        <option value="">Day:</option>
                                        <?php for ($i = 1; $i <= 31; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>      
                                    </select>
                                </div>
                                <div class="col-xs-12 hb-mt-10 visible-xs"></div>
                                <div class="col-sm-4">
                                    <select id="yearOfBirth" class="dis-in-block form-control" name="year" >
                                        <option value="">Year:</option>
                                        <?php $y = date('Y'); ?>
                                        <?php for ($n = $y - 100; $n <= $y-18; $n++) { ?>
                                            <option value="<?php echo $n; ?>"><?php echo $n; ?></option>
                                        <?php } ?> 
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!--<label class="control-label" for="email">Email address</label>-->
                                    <input type="email" class="required form-control"  name="email" id="" placeholder="Enter email">
                                </div>
                                <div class="col-xs-12 hb-mt-10 visible-xs"></div>
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
                                    $total = ($first + $second);
                                    ?>
                                    <input type="hidden" value="<?php echo $total; ?>" name="total" id="total">
                                    <?php echo "( " . $first . " + " . $second . " ) = "; ?>
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
                            By clicking "Join Now" or using Amygoz, you agree to our <a href="https://about.amygoz.com/terms/" class="cyan"><strong>Terms</strong></a> and
                            <a href="https://about.amygoz.com/privacy/" class="cyan"><strong>Privacy Policy.</strong></a>
                        </p>
                        <div class="row">
<!--                         <div class="col-sm-7 text-right">
                        <a class="logo" href="https://play.google.com/store/apps/details?id=chat.callitme.com" target="blank">
                            <img src="<?php echo url::base(); ?>img/google-play.png" alt="googleplay" style="width: 126px;"/>
                                </a>
                            </div> -->
<!--                         <div class="col-sm-5">
                            <a class="logo" href="https://itunes.apple.com/in/app/callitme/id1443966727?mt=8">
                                <img src="<?php echo url::base(); ?>img/app-store.png" alt="appstore" target="blank" style="width: 172px;position: relative;bottom: 2px;"/>
                                </a>
                        </div> -->
                            </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>

<!--<section style="margin-top: 50px;">
    <div class="container text-center">
        <h2 style="font-size: 42px;font-weight: bold;font-family: arial;">Trending</h2>
    </div>
</section>

<section class="deafult-bg">
    <div class="row" style="padding: 15px;">
        <div class="col-sm-4">
            <div class="text-center">
                <h4>Profiles to check out</h4>
                <?php
                //$i=0;
                foreach($item_fix as $item_fs)
                {
                    $recommendations = $item_fs->recommendations->where('state', '=', 'approve')->limit(2)->order_by('time', 'desc')->find_all()->as_array();
                    $ommendations = $item_fs->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                    $temp_words = array();
                    foreach($ommendations as $recommend) {
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
                                    <span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>
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
                        <div class="col-xs-7">
                            <div class="row mar-hy-10 text-center">
                                            <div class="circular-bar marTop10">
                                                <input type="text" class="dial" data-fgColor="#ff1744" data-width="100" data-height="100" data-linecap=round  value="<?php echo $percentile_s;?>" style="margin-top: 0px">
                                                <div class="circular-bar-content">
                                                    <label style="font-size: 25px;margin-left: 6px;margin-top: 13px;"></label>
                                                </div>
                                            </div>
                                            <h5 class="text-center" style="color: black;margin-top: -69px;margin-left: 4px;text-align: center;">Social <br/>percentile</h5>
                                        </div>
                        </div>
                        </div>
                        <br/>   <br/> <br/> <br/> <br/>
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
                                    <span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>
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
                              <?php echo substr($recommendation->message, 0, 100)."....."; ?>
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
                             <?php echo substr($recommendation->message, 0, 100)."....."; ?>
                        </div>
                        
                        </div>
                        <?php }?>
                    <?php } ?>
                        <div class="col-xs-12 mar-ghy">
                        <a href="<?php echo url::base(); ?>login?page=<?php echo $item_fs->username; ?>" style="color:#414141;margin-top: 22px;margin-bottom: 10px;background: #fff;border: none;padding: 10px;border:2px solid #414141;">VIEW MORE
                        </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <div class="col-sm-4">
        <div class="">
            <div class="text-center">
              <h4>Top Viewed profiles</h4>
                <div class="row">
        <?php foreach ($viewer_count as $value) {
                $v  =   ORM::factory('user')->with('user_detail')
                    ->where('user.id', '=', $value->user_id)
                    ->where('is_deleted', '=', 0)
                    ->limit(50)
                    ->find_all()
                    ->as_array();
            foreach ($v as $item_ss) { 
                $recommendations = $item_ss->recommendations->where('state', '=', 'approve')->limit(2)->order_by('time', 'desc')->find_all()->as_array();
                $recomtions = $item_ss->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                            $temp_words = array();
                            foreach($recomtions as $recommend) 
                            {
                                $words = explode(', ', $recommend->words);
                                $temp_words = array_merge($temp_words, $words);
                            }
                            $tags = array_count_values($temp_words);
                            $percentile_s= $item_ss->friends->calculate_social_percentage($tags);
                ?>         
            <div class="row shad-item">
                <div class="col-xs-12 colgit">
                    <div class="col-xs-5">
                        <div class="imgbox" id="head">
                            <?php 
                                $photo1 = $item_ss->photo->profile_pic;
                                $photo_image = file_exists("mobile/upload/" .$photo1);
                                $photo_image1 = file_exists("upload/" .$photo1);
                                if (!empty($photo1) && $photo_image) { ?>
                                    <img src="<?php echo url::base() . "mobile/upload/" . $item_ss->photo->profile_pic; ?>" class="img-responsive" style="height:100%;width:100%; border-radius: 50%;">
                                <?php }
                                 else if (!empty($photo1) && $photo_image1) { ?>
                                    <img src="<?php echo url::base() . "upload/" . $item_ss->photo->profile_pic; ?>" class="img-responsive" style="height:100%;width:100%; border-radius: 50%;">
                                <?php }  else { ?>
                                <div id="inset" style="width: 95px;height: 95px !important;min-height: 95px !important;border-radius: 50%;">
                                    <h1 style="font-size: 47px;line-height: 49px;">
                                        <?php echo $item_ss->user_detail->first_name[0].$item_ss->user_detail->last_name[0]; ?>
                                    </h1>
                                    <span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>
                                </div>
                            <?php } ?>
                        </div>
                        <br/>
                        <p class="user-name" style="font-size:15px;margin-top: -15px;">
                                <a href="<?php echo url::base() . $item_ss->username; ?>">
                                    <?php echo $item_ss->user_detail->first_name . " " . $item_ss->user_detail->last_name; ?>          
                                </a>
                           </p>
                    </div>
                        <div class="col-sm-7">
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
                              <?php echo substr($recommendation->message, 0, 100)."....."; ?>
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
                             <?php echo substr($recommendation->message, 0, 100)."....."; ?>
                        </div>
                         
                        </div>
                        <?php }?>
                    <?php } ?>
                    <div class="col-xs-12 mar-ghy">
                <a href="<?php echo url::base(); ?>login?page=<?php echo $item_ss->username; ?>" style="color:#414141;margin-top: 22px;margin-bottom: 10px;background: #fff;border: none;padding: 10px;border:2px solid #414141;">VIEW MORE
                </a> 
                </div>        
            </div>
            <?php } } ?> 
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="text-center">
            <div class="">
                <h4>Top Public Profile</h4>
                <?php
                foreach($public_user as $public_fs)
                {
                    $recommendations = $public_fs->recommendations->where('state', '=', 'approve')->limit(2)->order_by('time', 'desc')->find_all()->as_array();
                    $recommetions = $public_fs->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                    $temp_words = array();
                    foreach($recommetions as $recommend) 
                    {
                        $words = explode(', ', $recommend->words);
                        $temp_words = array_merge($temp_words, $words);
                    }
                    $tags = array_count_values($temp_words);
                    $percentile_s = $public_fs->friends->calculate_social_percentage($tags);
                ?>
                <div class="row shad-item">
                    <div class="col-xs-12 colgit">
                        <div class="col-xs-5">
                        <div class="imgbox" id="head">
                            <?php
                            $photo = $public_fs->photo->profile_pic;
                            $photo_image = file_exists("mobile/upload/" .$photo);
                            $photo_image1 = file_exists("upload/" .$photo);
                            if (!empty($photo) && $photo_image) { ?>
                                <img src="<?php echo url::base() . "mobile/upload/" . $public_fs->photo->profile_pic; ?>" alt="<?php echo $public_fs->user_detail->first_name." ".$public_fs->user_detail->last_name;?>" class="img-responsive" style="height:100%;width:100%; border-radius: 50%;">
                            <?php }
                            else if (!empty($photo) && $photo_image1) { ?>
                                <img src="<?php echo url::base() . "upload/" . $public_fs->photo->profile_pic; ?>" alt="<?php echo $public_fs->user_detail->first_name." ".$public_fs->user_detail->last_name;?>" class="img-responsive" style="height:100%;width:100%; border-radius: 50%;">
                            <?php }  else { ?>
                                <div id="inset" style="width: 95px;height: 95px !important;min-height: 95px !important;border-radius: 50%;">
                                    <h1 style="font-size: 47px;line-height: 49px;">
                                        <?php echo $public_fs->user_detail->first_name[0].$public_fs->user_detail->last_name[0]; ?>
                                    </h1>
                                </div>
                            <?php } ?>
                        </div>
                        <br/>
                        <p class="user-name" style="font-size:15px;margin-top: -15px;">
                                        <a href="<?php echo url::base() . $public_fs->username; ?>">
                                            <?php echo $public_fs->user_detail->first_name . " " . $public_fs->user_detail->last_name; ?>
                                        </a>
                                    </p>
                        </div>
                            <div class="col-sm-7">
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
                        if($recommendation->owner->is_blocked == '0') 
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
                                  <?php echo substr($recommendation->message, 0, 100)."....."; ?>
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
                                  <?php echo substr($recommendation->message, 0, 100)."....."; ?>
                            </div>
                             
                            </div>
                            <?php }?>
                        <?php } ?>
                          <?php } ?>
                        <div class="col-xs-12 mar-ghy">
                        <a href="<?php echo url::base(); ?>login?page=<?php echo $public_fs->username; ?>" style="color:#414141;margin-top: 22px;margin-bottom: 10px;background: #fff;border: none;padding: 10px;border:2px solid #414141;">VIEW MORE
                        </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
</section>
-->
<section class="gap gap-fixed-height-small intro-sec-2" style="background: #F8F8F8;">
    <div class="container">
        <p class="quote-text center-block text-center secondary-text">See who you already know in Amygoz</p>
        <div class="row-fluid">
            <dic class="col-sm-6 col-sm-offset-3">
                <form class="form-inline text-center" action="<?php echo URL::base(); ?>pages/search_results" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="first_name" id="exampleInputFirstName" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="last_name" id="exampleInputLastName" placeholder="Last Name">
                    </div>
                    <button type="submit" class="btn btn-default">Search Now</button>
                </form>
            </dic>
        </div>
    </div>
</section>

<!-- <section class="gap gap-fixed-height-small intro-sec-2 secondarybg">
    <div class="container">
        <p class="quote-text center-block text-center midnight-blue-text">Callitme started as a class project at Harvard where the initial idea was to match two friends who were too shy to express their feelings. Today, with added features, Callitme has become your hub for people review, match making and social dating. </p>
    </div>
</section> -->

<!-- <section id="review" class="secondarybg">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h3>Review People</h3>
                <p>You have reviewed products and businesses, now you get to review people.</p>
            </div>
            <div class="col-sm-4">
             
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="step">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <h3>Step 1</h3>
                            <p>Enter the email address of the person you want to review.</p>
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
                            <p>Pick the relationship between you and the person you are reviewing.</p>
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
                            <h3>Step 3</h3>
                            <p>Choose the attributes that best describes the person.</p>
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
                            <h3>Step 4</h3>
                            <p>Describe the person.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="gap gap-fixed-height-small">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 hb-pt-50">
                <h3 class="primary-text">One Goal</h3>
                <p>We are dedicated to establishing trust online</p>
            </div>
            <div class="col-sm-9">
                <img src="<?php// echo url::base(); ?>images/home1.png" alt="" class="pull-right" />                    
                <h4 class="pink-text hb-mt-80">
                    Callitme is a crowd powered people review network where you can review your friends & family, match your single friends, anonymously ask your crush out for a date, and find singles around you.
                </h4>
            </div>
        </div>
    </div>
</section>
 -->
<!--
<section class="intro-sec-1 gap gap-fixed-height-medium">        
    <div class="skrollable skrollable-between" id="intro">
        <div class="container">
            <h2>We are builig a trusted community on the web</h2>
            <h3>Review people you know and connect with the trusted strangers. Meeting strangers is always exiciting! Just be sure to check their reviews and their percentile.</h3>
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
</section>-->


<!-- <section class="gap gap-fixed-height-small">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h4 class="hb-mb-10">Making the Web trustworthy</h4>
                        <div class="col-sm-6 col-sm-offset-3">
                            <img src="<?php echo url::base(); ?>images/trustworthy.png" alt="" class="img-responsive center-block" /> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h4 class="hb-mb-10">Making people believe in each other</h4>
                        <div class="col-sm-6 col-sm-offset-3">
                            <img src="<?php echo url::base(); ?>images/believe.png" alt="" class="img-responsive center-block" />
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<script type="text/javascript">
    
   

        $('#first_name').keyup(function()
        {
            $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1).toLowerCase());
        });

        $('#last_name').keyup(function()
        {
            $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1).toLowerCase());
        });

        $('#first_name').bind("paste",function(e) { //prevent user to paste anything...
            e.preventDefault();
        });

        $('#last_name').bind("paste",function(e) { //prevent user to paste anything...
            e.preventDefault();
        });

        $('#last_name').blur // first name and last name should not be same 
        (function(){
            var fname=$('#first_name').val();
            var lname = $('#last_name').val();
            if(lname)
            {
                if(fname == lname)
                {
                    $('#last_name').val("");
                    alert('First name and last name should not be same ');
                } else
                {
                    return true;
                } 
            }   
        });

        $('#first_name').blur(function() //first name' length should be greater then 2 
        {
            var fname=$('#first_name').val();
            if(fname)
            {
                if(fname.length < 3)
                {
                    $('#first_name').val("");
                    alert('First name should have 3 letters');
                }else
                {
                return true;
                }
            }
        });


   
    
</script>
<!--added by Riti-->

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


<style type="text/css">
    .shad-item
{           /*box-shadow: 0 0 0 1px rgba(0,0,0,.1),0 2px 3px rgba(0,0,0,.2);*/
           box-shadow: 0 0 0 1px rgba(0,0,0,.1),0 2px 3px rgba(0,0,0,.2);
            padding: 6px 2px;
            margin: 25px 3px;
            border-radius: 8px 8px 0px 0px;
           /* border-radius: 15px 15px 0px 0px;*/
}

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
.colgit{background: #e6e7e7;
/*box-shadow: 0 0 0 1px rgba(0,0,0,.1),0 2px 3px rgba(0,0,0,.2);*/
border-radius: 6px 6px 0px 0px;
}
.mar-hy-10{margin-top: -24px;}
.mar-ghy{margin: 22px 0px 14px 0px;}
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
