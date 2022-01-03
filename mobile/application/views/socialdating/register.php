<div class="container">

    <div class="home-register-box" style="margin:-60px auto 20px; padding-top:0px;">
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
                <?php if(Session::instance()->get('error')) {?>
                    <div class="alert alert-danger">
                       <strong>ERROR!</strong>
                       <?php echo Session::instance()->get_once('error');?>
                    </div>
                <?php } ?>

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
                            <option value="02">Febrary</option>
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
                
                        <select id="yearOfBirth" class="dis-in-block form-control" name="year" style="width:141px;">
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
                   
                    <button type="submit" class="btn btn-secondary pull-left marTop10 marRight20">Join Now</button>

                    <p class="terms marTop10">
                        By clicking "Join Now" or using Callitme, you agree to our <a href="terms.php" class="cyan"><strong>User Agreement</strong></a> and
                        <a href="privacy.php" class="cyan"><strong>Privacy Policy.</strong></a>
                    </p>

                </form>

            </div>
        </div>
    </div>

</div>