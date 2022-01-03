<section id="one">
    <div class="homecontainer" align="center">
        <h1>Do you know two singles who would be a great pair?</h1>
    </div>     
</section>


<section id="two">
     <div class="homecontainer" align="center">
        <h1>Join now</h1>
    
    
    <form role="form" class="validate-form register-form" method="post" action="<?php echo url::base()."pages/signup"; ?>">
            <label class="control-label" for="first_name">What's your first name?</label>
            <input type="text" class="required form-control" id="first_name" name="first_name" placeholder="First Name">
            <label class="control-label" for="last_name">What's your last name</label>
            <input type="text" class="required form-control" id="last_name" data-placement="top" name="last_name" placeholder="Last Name">
            <label class="control-label" for="sex">Are you a female or male?</label>
                            <select name="sex" class="required form-control">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        
                        
                        
                            <label class="control-label" for="birthday" class="required">Where are you in life?</label>
                            <select name="phase_of_life" class="form-control required">
                                <option value="">Phase of life:</option>
                                <?php foreach(Kohana::$config->load('profile')->get('phase_of_life') as $key => $value) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php } ?>
                            </select>
                                               
                        
                            <label class="control-label dis-block" for="birthday">When were you born?</label>
                            <select name="month" class="dis-in-block form-control"style="width:141px;">
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
                    
                            <select name="day" style="width:141px;" class="dis-in-block form-control">
                                <option value="">Day:</option>
                                <?php for($i = 1;$i<=31;$i++) { ?>
                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php } ?>      
                            </select>
                    
                            <select id="yearOfBirth" class="dis-in-block form-control" name="year" style="width:141px;" >
                                <option value="">Year:</option>
                                <?php $y = date('Y'); ?>
                                <?php for($n = $y-100;$n<=$y;$n++) { ?>
                                        <option value="<?php echo $n;?>"><?php echo $n;?></option>
                                <?php } ?> 
                            </select>
                        
                        <br />
                       
                            <label class="control-label" for="email">What's your email address?</label>
                            <input type="email" class="required email uniqueEmail form-control"  name="email" id="email" placeholder="Enter email">
                       
                        
                       
                            <label class="control-label" for="password">Choose a password</label>
                            <input type="password" class="required form-control" id="password" name="password" placeholder="Password">
                       
                        
                        
                            <label class="control-label" for="message">Solve this math:</label>
                                <?php 
                                    $first = rand(1, 20);
                                    $second = rand(1, 20);
                                    $total = ($first+$second);
                                ?>
                                <input type="hidden" value="<?php echo $total;?>" name="total" id="total">
                                <?php echo "( ".$first." + ".$second." ) = "; ?>
                                <input type="text" class="form-control required digits" name="answer" placeholder="Type your answer here">
                        
                       <br />
                        <button type="submit" class="btn btn-secondary pull-left marRight20">Join Now</button>

                        <p class="terms marTop10">
                            By clicking "Join Now" or using Callitme, you agree to our <a href="<?php echo url::base()."pages/terms"; ?>" class="cyan"><strong>User Agreement</strong></a> and
                            <a href="<?php echo url::base()."pages/privacy_policy"; ?>" class="cyan"><strong>Privacy Policy.</strong></a>
                        </p>

                    </form>
  </div>
</section>


<section id="home-middle">
    <div class="container">
        <div id="recommendation" class="steps">
            <h1> Become a Match-Maker!</h1>
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
            
       </div>
   </section>
   
<!--inserting google ad-->
	<div class="container">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- First Ad -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:728px;height:90px"
		     data-ad-client="ca-pub-5036589147869169"
		     data-ad-slot="1715880137"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
<!--end-->   

<section id="four">
    <div class="homecontainer">
        <h1>Join our fastest growing network over the globe </h1>
         </div>
</section>

<section id="five">
    Disclaimer: The content of the site is generated by members of Callitme.com. Members are not pre-screened by Callitme and Callitme.com takes no responsibility of the content on this site. Callitme and its owners, employees or affiliates are not responsible for any consequenses that may arise if you use this site. By using this website, you agree that you use the site at your own risk and assume all responsibility for the consequences and hold the owners or any affiliates of Callitme harmless.
</section>
    
    