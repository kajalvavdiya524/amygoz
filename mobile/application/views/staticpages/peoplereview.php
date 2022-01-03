<section id="sd-one">
    <div class="container">
        
       <!--Object on left begin-->
        <div class="home-left pull-left">
       		World's first peer reviewed social dating website
        </div>
     <!--Object on left end--> 
     


        <div class="home-register-box pull-right">
            <div class="bubble shadow">
                <div class="ribbion full shadow">
                    <h2>
                        Register Now
                        <small>Its Free</small>
                    </h2>
                </div>
                <div class="triangle-l"></div>
                <div class="triangle-r"></div>

                <div class="info">
                    <form role="form" class="validate-form register-form" method="post" action="<?php echo url::base()."pages/signup"; ?>">
                        
                        <div class="form-group dis-in-block">
                            <!--<label class="control-label" for="first_name">First Name</label>-->
                            <input type="text" class="required form-control" id="first_name" name="first_name" placeholder="First Name">
                        </div>
                        
                        <div class="form-group dis-in-block" style="margin-left:21px;">
                           <!-- <label class="control-label" for="last_name">Last Name</label>-->
                            <input type="text" class="required form-control" id="last_name" data-placement="top" name="last_name" placeholder="Last Name">
                        </div>
                        
                        <div class="form-group dis-in-block">
                            <!--<label class="control-label" for="sex">I am:</label>-->
                            <select name="sex" class="required form-control">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        
                        <div class="form-group dis-in-block" style="margin-left:21px;">
                            <!--<label class="control-label" for="birthday" class="required">Phase of Life:</label>-->

                            <select name="phase_of_life" class="form-control required">
                                <option value="">Phase of life:</option>
                                <?php foreach(Kohana::$config->load('profile')->get('phase_of_life') as $key => $value) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label dis-block" for="birthday">Birthday:</label>
                    
                            <select name="month" class="dis-in-block form-control" style="width:141px;">
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
                        </div>
                        
                        <div class="form-group">
                            <!--<label class="control-label" for="email">Email address</label>-->
                            <input type="email" class="required email uniqueEmail form-control"  name="email" id="email" placeholder="Enter email">
                        </div>
                        
                        <div class="form-group">
                            <!--<label class="control-label" for="password">Password</label>-->
                            <input type="password" class="required form-control" id="password" name="password" placeholder="Password">
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label" for="message">Answer:</label>
                                <?php 
                                    $first = rand(1, 20);
                                    $second = rand(1, 20);
                                    $total = ($first+$second);
                                ?>
                                <input type="hidden" value="<?php echo $total;?>" name="total" id="total">
                                <?php echo "( ".$first." + ".$second." ) = "; ?>
                                <input type="text" class="form-control required digits" name="answer" placeholder="Type your answer here">
                        </div>
                       
                        <button type="submit" class="btn btn-secondary pull-left marRight20">Join Now</button>

                        <p class="terms marTop10">
                            By clicking "Join Now" or using Callitme, you agree to our <a href="<?php echo url::base()."pages/terms"; ?>" class="cyan"><strong>User Agreement</strong></a> and
                            <a href="<?php echo url::base()."pages/privacy_policy"; ?>" class="cyan"><strong>Privacy Policy.</strong></a>
                        </p>

                    </form>

                </div>
            </div>
        </div>

    </div>
</section>


<section id="two">
    <div class="container">
        <div id="recommendation" class="steps">
            <h3> Callitme Dating lets you match your single friends, anonymously ask your crush out for a date, and find singles around you.</h3>
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
   </section>
   
<!--inserting google ad-->
	<div class="container">
<!--removed google ad- add image ad -->
	</div>
<!--end-->   

<section id="sd-three">
    <div class="container">
        <div id="home-join-us" class="pull-left">
            <h1>Join our fastest growing network over the globe</h1>
        </div>

        <img src="<?php echo url::base(); ?>img/home-bottom.png" alt="Callitme crowdprofiling social dating" class="pull-right"/>

    </div>
   
   
   
</section>

<section id="section-steps">
    Disclaimer: The content of the site is generated by members of Callitme.com. Members are not pre-screened by Callitme and Callitme.com takes no responsibility of the content on this site. Callitme and its owners, employees or affiliates are not responsible for any consequenses that may arise if you use this site. By using this website, you agree that you use the site at your own risk and assume all responsibility for the consequences and hold the owners or any affiliates of Callitme harmless.
</section>
    
    