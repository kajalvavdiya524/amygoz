<div class="container verpal-shadd" style="padding-top: 30px;padding-bottom: 100px;">
<div class="container">
        <div class="col-xs-12 text-center">
        <h3 class="fs-title">Join the trusted community <strong> <br/> 
        Its Free</strong>
        </h3>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="">
                        <form role="form" class="validate-form register-form" method="post" action="<?php echo url::base()."pages/signup"; ?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <!--<label class="control-label" for="first_name">First Name</label>-->
                                        <!-- <input type="text" class="required form-control" id="first_name" name="first_name" placeholder="First Name"> -->
                                        <input type="text"  class="required form-control" id="first_name" name="first_name" placeholder="First Name" onkeypress="return onlyAlphabets(event,this);" onkeyup="this.value=this.value.replace(/[^A-z/a-z]/g,'');" value="<?php echo Request::current()->post('first_name'); ?>">
                                    </div>
                                    <div class="col-xs-12" style="margin-top: 6px;">
                                        <!-- <label class="control-label" for="last_name">Last Name</label>-->
                                        <!-- <input type="text" class="required form-control" id="last_name" data-placement="top" name="last_name" placeholder="Last Name"> -->
                                        <input type="text"  class="required form-control" id="last_name" name="last_name" placeholder="Last Name" onkeypress="return onlyAlphabets(event,this);" onkeyup="this.value=this.value.replace(/[^A-z/a-z]/g,'');" value="<?php echo Request::current()->post('last_name'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <!--<label class="control-label" for="sex">I am:</label>-->
                                        <select name="sex" class="required form-control">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12" style="margin-top: 6px;">
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
                                <label class="control-label dis-block white-text" for="birthday">Birthday:</label>

                                <div class="row">
                                    <div class="col-xs-12">
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
                                    <div class="col-xs-12" style="margin-top: 6px;">
                                        <select name="day" class="dis-in-block form-control">
                                            <option value="">Day:</option>
                                            <?php for($i = 1;$i<=31;$i++) { ?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                            <?php } ?>      
                                        </select>
                                    </div>
                                    <div class="col-xs-12" style="margin-top: 6px;">
                                        <select id="yearOfBirth" class="dis-in-block form-control" name="year" >
                                            <option value="">Year:</option>
                                            <?php $y = date('Y'); ?>
                                            <?php for($n = $y-100;$n<=$y-18;$n++) { ?>
                                                    <option value="<?php echo $n;?>"><?php echo $n;?></option>
                                            <?php } ?> 
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <!--<label class="control-label" for="email">Email address</label>-->
                                        <input type="email" class="required form-control"  name="email" id="" placeholder="Enter email">
                                    </div>
                                    <div class="col-xs-12" style="margin-top: 6px;">
                                        <!--<label class="control-label" for="password">Password</label>-->
                                        <input type="password" class="required form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 answer-varification">
                                        <label class="control-label white-text" for="message" style="color: #2d2d2d !important;">Answer:</label>
                                        <?php 
                                            $first = rand(1, 20);
                                            $second = rand(1, 20);
                                            $total = ($first+$second);
                                        ?>
                                        <input type="hidden" value="<?php echo $total;?>" name="total" id="total">
                                        <?php echo "( ".$first." + ".$second." ) = "; ?>
                                    </div>
                                    <div class="col-xs-12" style="margin-top: 6px;">
                                        <input type="text" class="form-control required digits" name="answer" placeholder="Type your answer here">
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <button type="submit" class="btn btn-default no-bg-image secondary-bg btn-block white-text" style="width: auto;background: #FF5A5F; border: 40px !important;color: #FFF;letter-spacing:1px;font-weight: 600;font-size:17px;border-radius: 40px;padding: 9px 75px;box-shadow: 0px 0px 8px 0px #ff5a5f;">Join Now</button>
                        </form>
                        <div class="row">
                            &nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
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