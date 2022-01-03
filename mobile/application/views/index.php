<script type="text/javascript">
var count = 0; // To count blank fields.
function validation(event) {
var radio_check = document.getElementsByName('gender'); // Fetching radio button by name.
var input_field = document.getElementsByClassName('text_field'); // Fetching all inputs with same class name text_field and an html tag textarea.
var text_area = document.getElementsByTagName('textarea');
// Validating radio button.
if (radio_check[0].checked == false && radio_check[1].checked == false) {
var y = 0;
} else {
var y = 1;
}
// For loop to count blank inputs.
for (var i = input_field.length; i > count; i--) {
if (input_field[i - 1].value == '' || text_area.value == '') {
count = count + 1;
} else {
count = 0;
}
}
if (count != 0 || y == 0) {
alert("*All Fields are mandatory*"); // Notifying validation
event.preventDefault();
} else {
return true;
}
}
/*---------------------------------------------------------*/
// Function that executes on click of first next button.
function next_step1() {
document.getElementById("first").style.display = "none";
document.getElementById("second").style.display = "block";
document.getElementById("active2").style.color = "red";
}
// Function that executes on click of first previous button.
function prev_step1() {
document.getElementById("first").style.display = "block";
document.getElementById("second").style.display = "none";
document.getElementById("active1").style.color = "red";
document.getElementById("active2").style.color = "gray";
}
// Function that executes on click of second next button.
function next_step2() {
document.getElementById("second").style.display = "none";
document.getElementById("third").style.display = "block";
document.getElementById("active3").style.color = "red";
}
// Function that executes on click of second previous button.
function prev_step2() {
document.getElementById("third").style.display = "none";
document.getElementById("second").style.display = "block";
document.getElementById("active2").style.color = "red";
document.getElementById("active3").style.color = "gray";
}

</script>
<style type="text/css">
.content{
/*margin:20px auto*/
}
.main{
float:left;
margin-top:80px
}
#progressbar{
margin:0;
padding:0;
font-size:18px
}
#active1{
color:red
}
fieldset{
display:none;
padding:20px;
border-radius:5px;
/*border: 1px solid #929292;*/
}
#first{
display:block;
padding:20px;
border-radius:5px;
/*border: 1px solid #929292;*/
}

.form-control{
    height: 43px !important;
}

input[type=text],input[type=password],select{
width:100%;
margin:10px 0;
height:43px;
padding:5px;
border:1px solid #929292;
border-radius:2px
}
textarea{
width:100%;
margin:10px 0;
height:70px;
padding:5px;
border:3px solid #ecb0dc;
border-radius:4px
}
input[type=submit],input[type=button]{
width:120px;
margin:15px 25px;
padding:5px;
height:40px;
background-color:#a0522d;
border:none;
border-radius:4px;
color:#fff;
}
h2,p{
text-align:center;
}
li{
margin-right:52px;
display:inline;
color:#c1c5cc;
}
</style>
<section id="home-bottom" class="" style="background: #fff !important;">
<div class="container drager">
<form role="form" action="<?php echo url::base() . "pages/signup"; ?>" class="regform validate-form register-form" method="post">
<!-- Fieldsets -->
<fieldset id="first">
<h2 class="fs-title" style="color: black;">Find and get inspired by great people</h2>
<!-- <p class="subtitle" style="font-size: 15px;">Review people you know. Connect with trusted strangers. Make strangers your friends. </p> -->
<!-- <label class="control-label" for="first_name">First Name</label> -->
<input class="text_field" name="first_name" placeholder="First Name" type="text" value="">
<!-- <label class="control-label" for="last_name">Last Name</label> -->
<input class="text_field" name="last_name" placeholder="Last Name" type="text" value="">
  <!--  <label class="control-label" for="sex">I am:</label> -->
   <select name="sex" class="required form-control">
   <option value="">Select Gender</option>
   <option value="Male">Male</option>
   <option value="Female">Female</option>
    </select>
    <!-- <label class="control-label" for="birthday" class="required">Phase of Life:</label> -->
    <select name="phase_of_life" class="form-control required">
    <option value="">Phase of Life:</option>
    <?php foreach (Kohana::$config->load('profile')->get('phase_of_life') as $key => $value) { ?>
    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
    <?php } ?>
    </select>
    <div class="col-xs-12 text-center" style="margin-top: 25px;">
<button id="next_btn1" type="button" onclick="next_step1()" class="btn btn-secondary marTop10 marRight20" style="width: auto;background: #FF5A5F; border: 40px !important;color: #FFF;letter-spacing:1px;font-weight: 600;font-size:17px;border-radius: 40px;padding: 9px 75px;box-shadow: 0px 0px 8px 0px #ff5a5f;">Next</button>
</div>

<div class="col-xs-12" style="margin-top: 25px;">

<?php if (!Auth::instance()->logged_in()) { ?>
                <div class="text-right" style="margin-top: 10px;">
                    <p class="text-center">
                           Alreagy an Amygoz member? <a class="white-text" href="<?php echo url::base() . 'login'; ?>" style="color: #f06163 !important;font-size: 17px;font-weight: 600;">Login</a>
                            <!-- | 
                            <a class="white-text" href="<?php// echo url::base() . "register"; ?>" style="color: black !important;font-size: 16px;">Register</a> -->
                        </p>
                            <!--
                            | 
                            <a href="#"><i class="fa fa-facebook"></i> Sign up with Facebook</a>--> 
                    </div>
                    <!-- /.header-login -->
                </div>        
            <?php } ?>
        </div> 
</fieldset>

<fieldset id="second">
<!-- <h4 class="title">Personal Info</h4> -->
<h2 class="fs-title" style="color: black;">Date of Birth</h2>
<!-- <label class="control-label dis-block" for="birthday">Birthday:</label> -->
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
<!-- <label class="control-label dis-block" for="birthday">Day</label> -->
<select name="day" class="dis-in-block form-control">
      <option value="">Day:</option>
       <?php for($i = 1;$i<=31;$i++) { ?>
       <option value="<?php echo $i;?>"><?php echo $i;?></option>
       <?php } ?>      
       </select>
<!--  <label class="control-label dis-block" for="birthday">Year</label> -->
<select id="yearOfBirth" class="dis-in-block form-control" name="year" >
    <option value="">Year:</option>
    <?php $y = date('Y'); ?>
     <?php for($n = $y-100;$n<=$y-18;$n++) { ?>
     <option value="<?php echo $n;?>"><?php echo $n;?></option>
    <?php } ?> 
    </select>
<!-- <label class="control-label dis-block" for="birthday">Location</label> -->
    <input class="required form-control" id="current_city" type="text" name="location" placeholder="Where do you live?" value="">
    <div class="col-xs-12 text-center" style="margin-top: 35px;">
<button id="pre_btn1" type="button" onclick="prev_step1()" value="Previous" class="btn btn-secondary marTop10 marRight20" style="width: auto;background: #FF5A5F; border: 40px !important;color: #FFF;letter-spacing:1px;font-weight: 600;font-size:17px;border-radius: 40px;padding: 9px 75px;box-shadow: 0px 0px 8px 0px #ff5a5f;">Previous</button>
<br/><br/>
<button id="next_btn2" name="next" type="button" onclick="next_step2()" value="Next" class="btn btn-secondary marTop10 marRight20" style="width: auto;background: #FF5A5F; border: 40px !important;color: #FFF;letter-spacing:1px;font-weight: 600;font-size:17px;border-radius: 40px;padding: 9px 75px;box-shadow: 0px 0px 8px 0px #ff5a5f;">Next</button>
</div>
</fieldset>

<fieldset id="third">
<!-- <h4 class="title">Login Details</h4> -->
<h2 class="fs-title" style="color: black;">Please Enter Your Valid Email Address</h2>
<input type="email" class="required form-control"  name="email" id="" placeholder="Enter email addres">
<input type="password" class="required form-control" id="password" name="password" placeholder="Password">
<div class="row">
    <div class="col-xs-12 answer-varification">
    <span style="font-size:17px;font-weight: 500 !important;">
        <label class="control-label" for="message">Answer:</label>
        <?php 
            $first = rand(1, 20);
            $second = rand(1, 20);
            $total = ($first+$second);
        ?>
        </span>
        <input type="hidden" value="<?php echo $total;?>" name="total" id="total">
        <?php echo "( ".$first." + ".$second." ) = "; ?>
    </div>
    <div class="col-xs-12" style="margin-top: 6px;">
        <input type="text" class="form-control required digits" name="answer" placeholder="Type your answer here">
    </div>
</div>
<div class="col-xs-12 text-center" style="margin-top: 35px;">
<button id="pre_btn2" type="button" onclick="prev_step2()" value="Previous" class="btn btn-secondary marTop10 marRight20" style="width: auto;background: #FF5A5F; border: 40px !important;color: #FFF;letter-spacing:1px;font-weight: 600;font-size:17px;border-radius: 40px;padding: 9px 75px;box-shadow: 0px 0px 8px 0px #ff5a5f;">Previous</button>
<br/><br/>
<button id="next_btn2" type="submit" onclick="validation(event)" value="Submit" class="btn btn-secondary marTop10 marRight20 submit_btn" style="width: auto;background: #FF5A5F; border: 40px !important;color: #FFF;letter-spacing:1px;font-weight: 600;font-size:17px;border-radius: 40px;padding: 9px 75px;box-shadow: 0px 0px 8px 0px #ff5a5f;">Submit</button>
</div>
</fieldset>
</form>
</div>
</div>

</section>
<!-- <section class="deafult-bg text-pad-2">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
            <h4 style="font-size: 25px;letter-spacing: 2px;">Trending</h4>
                <hr style="color: red;height: 1px;background: #333;"/>
                <?php
                foreach ($viewer_count as $value) 
                {
                    $v = ORM::factory('user')->with('user_detail')
                            ->where('user.id', '=', $value->user_id)
                            ->where('is_deleted', '=', 0)
                            ->limit(10)
                            ->find_all()
                            ->as_array();
                foreach ($v as $item_ss) {             
                    $recommendations = $item_ss->recommendations->where('state', '=', 'approve')->limit(2)->order_by('time', 'desc')->find_all()->as_array();
                    $recommetions = $item_ss->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                    $temp_words = array();
                    foreach($recommetions as $recommend) 
                    {
                        $words = explode(', ', $recommend->words);
                        $temp_words = array_merge($temp_words, $words);
                    }
                    $tags = array_count_values($temp_words);
                    $percentile_s = $item_ss->friends->calculate_social_percentage($tags);
                ?>
                <div class="row row-stye" style="">
                <div class="row me-rw-colr" style="">
                     <div class="col-xs-3 pst-dy">
                            <div class="imgbox" id="head">
                            <?php
                            $photo = $item_ss->photo->profile_pic;
                            $photo_image = file_exists("mobile/upload/" .$photo);
                            $photo_image1 = file_exists("upload/" .$photo);
                            if (!empty($photo) && $photo_image) { ?>
                                <img src="<?php echo url::base() . "mobile/upload/" . $item_ss->photo->profile_pic; ?>" alt="<?php echo $item_ss->user_detail->first_name." ".$item_ss->user_detail->last_name;?>" class="img-responsive" style="height: 50px;width:50px;border-radius: 50%;">
                            <?php }
                            else if (!empty($photo) && $photo_image1) { ?>
                                <img src="<?php echo url::base() . "upload/" . $item_ss->photo->profile_pic; ?>" alt="<?php echo $item_ss->user_detail->first_name." ".$item_ss->user_detail->last_name;?>" style="height: 50px;width:50px;border-radius: 50%;">
                            <?php }  else { ?>
                                <div id="inset" class="enemy" style="border-radius: 50%;position: relative;bottom: 18px;">
                                    <h1 class="headwrap">
                                        <?php echo $item_ss->user_detail->first_name[0].$item_ss->user_detail->last_name[0]; ?>
                                    </h1>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                        <div class="col-xs-9 text-left pst-dtu">
                            <div class="user-title bg_color text-left" style="background:none;text-align: left !important;">
                                    <span class="user-name text-left" style="font-size:15px;">
                                        <a href="<?php echo url::base() . $item_ss->username; ?>">
                                            <?php echo $item_ss->user_detail->first_name . " " . $item_ss->user_detail->last_name; ?>
                                        </a>
                                    </span>
                                <div class="clearfix"></div>
                                <span class="social-score text-left">Social <?php echo $percentile_s;?>%</span>
                            </div>
                        </div>
                        </div>
                        <div class="">
                        <?php foreach ($recommendations as $recommendation) 
                        {?>  
                        <?php if($recommendation->owner->is_blocked == '0') 
                        {  ?>
                        <?php if( $recommendation->type=='1')
                        { ?>
                            <div class="col-xs-3">
                            <div class="imgbox me-it" id="head" style="left: 19px;">
                         <?php
                            $photo = $recommendation->owner->photo->profile_pic;
                            $photo_image = file_exists("mobile/upload/" .$photo);
                            $photo_image1 = file_exists("upload/" .$photo);
                            if (!empty($photo) && $photo_image) { ?>
                                <img src="<?php echo url::base() . "mobile/upload/" . $recommendation->owner->photo->profile_pic; ?>" alt="<?php echo $recommendation->owner->user_detail->first_name." ".$recommendation->owner->user_detail->last_name;?>" class="img-responsive" style="height:36px;width:36px;position: relative;top: 20px;">
                            <?php }
                            else if (!empty($photo) && $photo_image1) { ?>
                                <img src="<?php echo url::base() . "upload/" . $recommendation->owner->photo->profile_pic; ?>" alt="<?php echo $recommendation->owner->user_detail->first_name." ".$recommendation->owner->user_detail->last_name;?>" class="img-responsive" style="height:36px;width:36px;position: relative;top: 20px;">
                            <?php }  else { ?>
                                <div id="inset" class="enemy me-it-pos">
                                    <h1 class="headwrap me-it-post">
                                        <?php echo $recommendation->owner->user_detail->first_name[0].$recommendation->owner->user_detail->last_name[0]; ?>
                                    </h1>
                                </div>
                            <?php } ?>
                        </div>
                            </div>
                            <div class="col-xs-9 me-small-pos">
                        <span class="me-it-ht"> 
                            <a href="<?php echo url::base() . $recommendation->owner->username; ?>"> 
                            <?php echo $recommendation->owner->user_detail->first_name . " " . $recommendation->owner->user_detail->last_name; ?></span>
                            </a>
                        <br/>
                        <span class="me-textshadow">Reviewed On: <?php
                                        $age = time() - strtotime($recommendation->time);
                                        if ($age >= 86400) {
                                            echo date('jS M', strtotime($recommendation->time));
                                        } else {
                                            echo date::time2string($age);
                                        }
                                        ?> </span>
                        </div>

                        <div class="col-xs-12 text-left mar-lft">
                            <p class="pera-text">
                            <?php echo substr($recommendation->message, 0, 25)."....."; ?>
                            </p>
                        </div>
                        <?php }?>
                        <?php if( $recommendation->type=='0')
                        { ?>
                            <div class="col-xs-3">
                            <div class="imgbox me-it" id="head" style="left: 19px;">
                         <img src="<?php echo url::base() . "img/no_image_s.png"; ?>" height="100%" style="position: relative;top: 20px;width: 36px;height: 36px;">
                        </div>
                            </div>
                            <div class="col-xs-9 me-small-pos">
                        <span class="me-it-ht">  Anonymous User</span>
                        <br/>
                        <span class="me-textshadow">Reviewed On: <?php
                                        $age = time() - strtotime($recommendation->time);
                                        if ($age >= 86400) {
                                            echo date('jS M', strtotime($recommendation->time));
                                        } else {
                                            echo date::time2string($age);
                                        }
                                        ?> </span>
                        </div>

                        <div class="col-xs-12 text-left mar-lft">
                            <p class="pera-text">
                            <?php echo substr($recommendation->message, 0, 25)."....."; ?>
                            </p>
                        </div>
                        <?php }?>
                        <?php }?>
                      <?php }?>
                       <?php }?>  
                       <div class="col-xs-12 mar-ghy">
                        <a href="<?php echo url::base(); ?>login?page=<?php echo $item_ss->username; ?>" class="viw-btn">View More
                        </a>
                        </div>  
                        </div>
                    </div>
                    <?php }?>
            </div>
        </div>
    </div>
</section>
<section class="deafult-bg text-pad-2">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
               
                <?php
                foreach ($item_fix as $item_ss) {             
                    $recommendations = $item_ss->recommendations->where('state', '=', 'approve')->limit(2)->order_by('time', 'desc')->find_all()->as_array();
                    $recommetions = $item_ss->recommendations->where('state', '=', 'approve')->order_by('time', 'desc')->find_all()->as_array();
                    $temp_words = array();
                    foreach($recommetions as $recommend) 
                    {
                        $words = explode(', ', $recommend->words);
                        $temp_words = array_merge($temp_words, $words);
                    }
                    $tags = array_count_values($temp_words);
                    $percentile_s = $item_ss->friends->calculate_social_percentage($tags);
                ?>
                <div class="row row-stye" style="">
                <div class="row me-rw-colr" style="">
                     <div class="col-xs-3 pst-dy">
                            <div class="imgbox" id="head">
                            <?php
                            $photo = $item_ss->photo->profile_pic;
                            $photo_image = file_exists("mobile/upload/" .$photo);
                            $photo_image1 = file_exists("upload/" .$photo);
                            if (!empty($photo) && $photo_image) { ?>
                                <img src="<?php echo url::base() . "mobile/upload/" . $item_ss->photo->profile_pic; ?>" alt="<?php echo $item_ss->user_detail->first_name." ".$item_ss->user_detail->last_name;?>" class="img-responsive" style="height: 50px;width:50px;border-radius: 50%;">
                            <?php }
                            else if (!empty($photo) && $photo_image1) { ?>
                                <img src="<?php echo url::base() . "upload/" . $item_ss->photo->profile_pic; ?>" alt="<?php echo $item_ss->user_detail->first_name." ".$item_ss->user_detail->last_name;?>" style="height: 50px;width:50px;border-radius: 50%;">
                            <?php }  else { ?>
                                <div id="inset" class="enemy" style="border-radius: 50%;position: relative;bottom: 18px;">
                                    <h1 class="headwrap">
                                        <?php echo $item_ss->user_detail->first_name[0].$item_ss->user_detail->last_name[0]; ?>
                                    </h1>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                        <div class="col-xs-9 text-left pst-dtu">
                            <div class="user-title bg_color text-left" style="background:none;text-align: left !important;">
                                    <span class="user-name text-left" style="font-size:15px;">
                                        <a href="<?php echo url::base() . $item_ss->username; ?>">
                                            <?php echo $item_ss->user_detail->first_name . " " . $item_ss->user_detail->last_name; ?>
                                        </a>
                                    </span>
                                <div class="clearfix"></div>
                                <span class="social-score text-left">Social <?php echo $percentile_s;?>%</span>
                            </div>
                        </div>
                        </div>
                        <div class="">
                        <?php foreach ($recommendations as $recommendation) 
                        {?>  
                        <?php if($recommendation->owner->is_blocked == '0') 
                        {  ?>
                        <?php if( $recommendation->type=='1')
                        { ?>
                            <div class="col-xs-3">
                            <div class="imgbox me-it" id="head" style="left: 19px;">
                         <?php
                            $photo = $recommendation->owner->photo->profile_pic;
                            $photo_image = file_exists("mobile/upload/" .$photo);
                            $photo_image1 = file_exists("upload/" .$photo);
                            if (!empty($photo) && $photo_image) { ?>
                                <img src="<?php echo url::base() . "mobile/upload/" . $recommendation->owner->photo->profile_pic; ?>" alt="<?php echo $recommendation->owner->user_detail->first_name." ".$recommendation->owner->user_detail->last_name;?>" class="img-responsive" style="height:36px;width:36px;position: relative;top: 20px;">
                            <?php }
                            else if (!empty($photo) && $photo_image1) { ?>
                                <img src="<?php echo url::base() . "upload/" . $recommendation->owner->photo->profile_pic; ?>" alt="<?php echo $recommendation->owner->user_detail->first_name." ".$recommendation->owner->user_detail->last_name;?>" class="img-responsive" style="height:36px;width:36px;position: relative;top: 20px;">
                            <?php }  else { ?>
                                <div id="inset" class="enemy me-it-pos">
                                    <h1 class="headwrap me-it-post">
                                        <?php echo $recommendation->owner->user_detail->first_name[0].$recommendation->owner->user_detail->last_name[0]; ?>
                                    </h1>
                                </div>
                            <?php } ?>
                        </div>
                            </div>
                            <div class="col-xs-9 me-small-pos">
                        <span class="me-it-ht"> 
                            <a href="<?php echo url::base() . $recommendation->owner->username; ?>"> 
                            <?php echo $recommendation->owner->user_detail->first_name . " " . $recommendation->owner->user_detail->last_name; ?></span>
                            </a>
                        <br/>
                        <span class="me-textshadow">Reviewed On: <?php
                                        $age = time() - strtotime($recommendation->time);
                                        if ($age >= 86400) {
                                            echo date('jS M', strtotime($recommendation->time));
                                        } else {
                                            echo date::time2string($age);
                                        }
                                        ?> </span>
                        </div>

                        <div class="col-xs-12 text-left mar-lft">
                            <p class="pera-text">
                            <?php echo substr($recommendation->message, 0, 25)."....."; ?>
                            </p>
                        </div>
                        <?php }?>
                        <?php if( $recommendation->type=='0')
                        { ?>
                            <div class="col-xs-3">
                            <div class="imgbox me-it" id="head" style="left: 19px;">
                         <img src="<?php echo url::base() . "img/no_image_s.png"; ?>" height="100%" style="position: relative;top: 20px;width: 36px;height: 36px;">
                        </div>
                            </div>
                            <div class="col-xs-9 me-small-pos">
                        <span class="me-it-ht">  Anonymous User</span>
                        <br/>
                        <span class="me-textshadow">Reviewed On: <?php
                                        $age = time() - strtotime($recommendation->time);
                                        if ($age >= 86400) {
                                            echo date('jS M', strtotime($recommendation->time));
                                        } else {
                                            echo date::time2string($age);
                                        }
                                        ?> </span>
                        </div>

                        <div class="col-xs-12 text-left mar-lft">
                            <p class="pera-text">
                            <?php echo substr($recommendation->message, 0, 25)."....."; ?>
                            </p>
                        </div>
                        <?php }?>
                        
                        <?php }?>
                      <?php }?>
                      <div class="col-xs-12 mar-ghy">
                        <a href="<?php echo url::base(); ?>login?page=<?php echo $item_ss->username; ?>" class="viw-btn">View More
                    
                        </a>
                        </div>
                        </div>
                    </div>
                    <?php }?>
            </div>
        </div>
    </div>
</section> -->

<section class="vertical-padding-lg" style="background: #fff;">
    <div class="container">
        <p class="quote-text center-block text-center primary-text" style="color: black !important;font-size: 18px;font-weight: 500;">Search for Amygoz</p>
        <div class="row-fluid">
            <dic class="col-sm-6 col-sm-offset-3">
                <form class="form-inline text-center" action="<?php echo URL::base(); ?>pages/search_results" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="first_name" id="exampleInputFirstName" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="last_name" id="exampleInputLastName" placeholder="Last Name">
                    </div>
                    <button type="submit" class="btn btn-default secondary-bg no-bg-image white-text no-text-shadow btn-block" style="background: #fff !important;border: 1px solid #181818;color: #121212 !important;font-size:17px;">Search Now</button>
                </form>
            </dic>
        </div>
    </div>
</section>

<!-- <section class="vertical-padding-lg default-bg text-center">
    <div class="container">
        <div class="row">
           <div class="col-xs-12 text-center">
                <h3 class="primary-text">One Goal</h3>
                <p>We are dedicated to establishing trust online</p>
            </div>
            <div class="col-xs-12 vertical-margin-md">
                <img src="<?php// echo url::base(); ?>images/home1.png" alt="" class="img-responsive  center-block" />                    
               </div>
                <div class="col-xs-12">                      
                <h4 class="text-justify hb-mt-80">
                    Callitme is a crowd powered people review network where you can review your friends &amp; family, match your single friends, anonymously ask your crush out for a date, and find singles around you.
                </h4>
            </div>
        </div>
    </div>
</section> -->

<!-- <section id="" class="secondary-bg vertical-padding-lg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h3 class="white-text">Review People</h3>
                <p class="white-text">You have reviewed products and businesses, now you get to review people.</p>
            </div>
            <div class="col-sm-4">
               
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="step vertical-margin-sm">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <h3 class="white-text">Step 1</h3>
                            <p class="white-text text-left">Enter the email address of the person you want to review.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="step vertical-margin-sm">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <h3 class="white-text">Step 2</h3>
                            <p class="white-text text-left">Pick the relationship between you and the person you are reviewing.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="step vertical-margin-sm">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <h3 class="white-text">Step 3</h3>
                            <p class="white-text text-left">Choose the attributes that best describes the person.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="step vertical-margin-sm">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-wrap">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <h3 class="white-text">Step 4</h3>
                            <p class="white-text text-left">Describe the person.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- <section class="vertical-padding-lg primary-bg" style="background: #ff2a7f;">
    <div class="container">
        <p class="white-text text-center">Callitme started as a class project at Harvard where the initial idea was to match two friends who were too shy to express their feelings. Today, with added features, Callitme has become your hub for people review, match making and social dating. </p>
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

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 9000); // Change image every 2 seconds
}
</script>
<style>
.mySlides {display:none;}
</style>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo Kohana::$config->load('settings')->get('location_api_key'); ?>&libraries=places"></script>
<script src="<?php echo url::base();?>js/jquery.geocomplete.min.js" type="text/javascript"></script>
<script>
      $(function(){
        $("#current_city").geocomplete();
        
      });
</script>
<script>
    var element = document.getElementsByClassName('js-autocomplete')[0];
    var autocompleteSchools = new google.maps.places.Autocomplete(element);
    google.maps.event.addListener(autocompleteSchools, 'place_changed', function () {
        var place = autocompleteSchools.getPlace();
        var resultNode = document.getElementsByClassName('js-result')[0];
        resultNode.innerHTML = '';
        resultNode.appendChild(document.createTextNode(JSON.stringify(place.address_components, null, 4)));
    });
</script>

