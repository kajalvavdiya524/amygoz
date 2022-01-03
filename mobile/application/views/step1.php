<div class="container" style="padding-top: 38px;padding-bottom: 47px;">

    <div class="register-step-box">
        <div class="" style="min-height:500px;">

            <div class="text-center">
                <h4>
                    Step 2. Tell us about yourself
                </h4>
            </div>
            <div class="clearfix"></div>

            <div class="info" style="z-index:0; position:relative;">

                <form class="validate-form form-horizontal" method="post" role="form">
                    <div class="profile-detail-box pull-left"> 
                        <fieldset class="fieldset">
                            <h4>Basic Information</h4>

                            <div class="fieldset-inner">

                                <div class="form-group">
                                    <label for="first_name" class="col-sm-3 control-label">First Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text"  class="required form-control" id="first_name" name="first_name" placeholder="First Name" onkeypress="return onlyAlphabets(event,this);" onkeyup="this.value=this.value.replace(/[^A-z/a-z]/g,'');" value="<?php echo $user->user_detail->first_name;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="last_name" class="col-sm-3 control-label">Last Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text"  class="required form-control" id="last_name" name="last_name" placeholder="Last Name" onkeypress="return onlyAlphabets(event,this);" onkeyup="this.value=this.value.replace(/[^A-z/a-z]/g,'');" value="<?php echo $user->user_detail->last_name; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="sex" class="col-sm-3 control-label">I am:</label>
                                    <div class="col-sm-8">
                                        <select class="required form-control" name="sex">
                                            <option value="">Select Sex</option>
                                            <?php if($user->user_detail->sex == 'Male') { ?>
                                                <option value="Male" selected="selected">Male</option>
                                            <?php } else { ?>
                                                <option value="Male">Male</option>
                                            <?php } ?>
                                            <?php if($user->user_detail->sex == 'Female') { ?>
                                                <option value="Female" selected="selected">Female</option>
                                            <?php } else { ?>
                                                <option value="Female">Female</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="phase_of_life" class="col-sm-3 control-label">Phase of Life:</label>
                                    <div class="col-sm-8">
                                        <select class="required form-control" name="phase_of_life">
                                            <option value="">Please Select:</option>
                                            <?php foreach(Kohana::$config->load('profile')->get('phase_of_life') as $key => $value) { ?>
                                                <?php if($user->user_detail->phase_of_life == $key) { ?>
                                                    <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </fieldset>
                    </div>

                    <div class="profile-detail-box pull-right"> 
                        <fieldset class="fieldset">
                            <h4>Contact Information</h4>
                            <?php
                                $user_ip = $_SERVER['REMOTE_ADDR'];
                                $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
                                $country = $geo["geoplugin_countryCode"];

                            ?>
                            <input type="hidden" id="country_code" value="<?php echo $country; ?>">
                            <div class="form-group">
                                <script src="<?php echo url::base()?>js/intlTelInput.js"></script> 
                                <link rel="stylesheet" href="<?php echo url::base() ?>css/intlTelInput.css">
                                <label for="phone" class="col-sm-3 control-label">Mobile Number:</label>
                                <div class="col-sm-8">
                                    <input class="form-control required" id="mobile-number" maxlength="14"  type="text" name="phone" placeholder="What's your phone number?" value="<?php //echo $user->user_detail->phone; ?>">
                                </div>
                                <br />
                                <?php if(session::instance()->get('phone_exists')){ ?>
                                    <div style="margin-top: 30px;margin-left: 30%;"><h6 style="color:red"><?php echo session::instance()->get_once('phone_exists'); ?></h6></div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label for="website" class="col-sm-3 control-label">Website:</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="website" type="text" name="website" placeholder="What is your website?" value="<?php echo strtolower($user->user_detail->website); ?>">
                                </div>
                            </div>

                        </fieldset>
                    </div>

                    <div class="profile-detail-box pull-right"> 
                        <fieldset class="fieldset">
                            <h4>Living</h4>

                            <div class="form-group">
                                <label for="location" class="col-sm-3 control-label">Current City:</label>
                                <div class="col-sm-8">
                                    <input class="required form-control" id="current_city" type="text" name="location" placeholder="Where do you live?" value="<?php echo $user->user_detail->location; ?>" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="home_town" class="col-sm-3 control-label">Home Town:</label>
                                <div class="col-sm-8">
                                    <input class="required form-control" id="birth_place" type="text" name="home_town" placeholder="Where are your originally from?" value="<?php echo $user->user_detail->home_town; ?>" autocomplete="off">
                                </div>
                            </div>

                        </fieldset>
                    </div>

                    <div class="profile-detail-box pull-left"> 
                        <fieldset class="fieldset">
                            <h4>Work and Education</h4>

                            <div class="form-group">
                                <label for="education" class="col-sm-3 control-label">Education Institute:</label>
                                <div class="col-sm-8">
                                    <input class="form-control js-autocomplete" id="education" type="text" name="education" placeholder="Where did you study?" value="<?php echo $user->user_detail->education; ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="employment" class="col-sm-3 control-label">Working At:</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="employment" type="text" name="employment" placeholder="Where do you work?" value="<?php echo $user->user_detail->employment; ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="designation" class="col-sm-3 control-label">Designation:</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="designation" type="text" name="designation" placeholder="What is your job title?" value="<?php echo $user->user_detail->designation; ?>">
                                </div>
                            </div>

                        </fieldset>
                    </div>

                    <div class="profile-detail-box pull-right"> 
                        <fieldset class="fieldset">
                            <h4>About Me</h4>

                            <div class="form-group">
                                <label for="about" class="col-sm-3 control-label">About You:</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="about" placeholder="Write a few lines about yourself"><?php echo $user->user_detail->about; ?></textarea>
                                </div>
                            </div>

                        </fieldset>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn no-bg-image btn-block" style="/*! width: 100%; */background: none;background:#f06163;color: #fff;font-weight: 500;border-radius: 40px;padding: 10px 46px;font-size: 18px;">Update Details</button>
                       </div>
                        <div class="col-xs-12 text-center">
                        or
                        </div>
                        <div class="col-xs-12 text-center">
                        <a href="<?php echo url::base().'pages/skip_step'; ?>" style="color: #0c0c0c;font-size: 18px !important;font-weight: 500;">Skip this step >></a>
                    </div>

                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- Google Maps-->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo Kohana::$config->load('settings')->get('location_api_key'); ?>&libraries=places"></script>
<script src="<?php echo url::base();?>js/jquery.geocomplete.min.js" type="text/javascript"></script>
<script>
    $(function(){
        $("#birth_place").geocomplete();
        $("#current_city").geocomplete();
    });
</script>
<script type="text/javascript">
    var ccode = $('#country_code').val();
    var res = ccode.toLowerCase();
    $("#mobile-number").intlTelInput({
        autoFormat: false,
        //autoHideDialCode: false,
        defaultCountry:res,
        //nationalMode: true,
        //numberType: "MOBILE",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['cn', 'jp'],
        //responsiveDropdown: true,
        utilsScript: "<?php echo url::base()?>js/lib/libphonenumber/build/utils.js"
    });

    $('#first_name').keyup(function() {
        $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1).toLowerCase());
    });

    $('#last_name').keyup(function() {
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
        if(lname) {
            if(fname == lname) {
                $('#last_name').val("");
                alert('First name and last name should not be same ');
            } else {
                return true;
            }
        }
    });

    $('#first_name').blur(function() { //first name' length should be greater then 2 
        var fname=$('#first_name').val();
        if(fname) {
            if(fname.length < 3) {
                $('#first_name').val("");
                alert('First name should have 3 letters');
            } else {
                return true;
            }
        }
    });

    $("#phone").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
           return false;
        }
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