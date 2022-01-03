<?php $session_user = Auth::instance()->get_user();?>
<div class="main-content">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 marTop20">
                <?php if(Auth::instance()->logged_in())
                {
                    $ds = ORM::factory('recommend', array('from' => $session_user->id, 'to' => $user->id));
                    if(!$ds->id) { ?>
                <div class="text-center">
                    <h3>
                        What you think about 
                        <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?>.?
                    </h3>
                    <!-- Modal -->
                    <div tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 9999;"aria-hidden="true" >
                        <div class="modal-dialog">
                            <div class="modal-content modal-content-four">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"> Write Review to <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?>  </h4>
                                </div>
                                <div class="modal-body">

                                    <link rel="stylesheet" href="<?php echo url::base(); ?>assets/multiple/css/normalize.css">
                                    <link rel="stylesheet" href="<?php echo url::base(); ?>assets/multiple/css/stylesheet.css">

                                    <script src="<?php echo url::base(); ?>assets/multiple/dist/js/standalone/selectize.js"></script>
                                    <script src="<?php echo url::base(); ?>assets/multiple/js/index.js"></script>
                                    <script>
                            $(document).ready(function () {
                                $('.password').hide();
                                $('.first_name').hide();
                                $('.last_name').hide();

                                var base_url = 'https://m.callitme.com/';
                                $('#search-query5').keyup(function ()
                                {

                                    var query = $(this).val();
                                    query = $.trim(query);


                                    if (query !== "")
                                    {  // If something was entered
                                        if (isValidEmailAddress(query))
                                        {
                                            $('#loading').show();

                                            $.ajax({
                                                type: 'get',
                                                url: base_url + "pages/select_user",
                                                data: 'query=' + query,
                                                success: function (data)
                                                {

                                                    if (data == 'True')
                                                    {
                                                        $('#loading').hide();
                                                        $('.first_name').hide();
                                                        $('.last_name').hide();
                                                        $('.password').show();
                                                        $('#p_type').val('Yes');
                                                        $('#next_div').hide();
                                                        $('.submit_review').show();

                                                    }
                                                    else
                                                    {
                                                        $('.first_name').show();
                                                        $('.last_name').show();
                                                        $('.password').show();

                                                        $('#p_type').val('No');
                                                        $('#loading').hide();
                                                    }
                                                }
                                            });

                                        }
                                        else
                                        {
                                            $('.password').hide();
                                            $('.first_name').hide();
                                            $('.last_name').hide();
                                        }



                                    }
                                    if (query == '')
                                    {
                                        $('.password').hide();
                                        $('.first_name').hide();
                                        $('.last_name').hide();

                                    }

                                });




                                function isValidEmailAddress(emailAddress) {
                                    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
                                    return pattern.test(emailAddress);
                                }
                                ;
                            });
                                    </script>

                                    <div class="row marTop20">
                                        <div class="col-sm-12">


                                            <fieldset class="fieldset">
                                                <?php
                                                if (Auth::instance()->logged_in()) {
                                                    ?>

                                                    <form role="form" class="validate-form" method="post"  action="<?php echo url::base() . "pp/write_review" ?> " autocomplete="off">
                                                        <input type="hidden" name="username" value="<?php echo $user->username; ?>">

                                                        <input type="hidden" id="p_type" name="password_type" value="1">
                                                        <label class="control-label pull-left" for="message">Words that describe <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?></label>

                                                        <div class="form-group">

                                                            <div class="control-group">

                                                                <select id="select-state" name="words[]" multiple class="demo-default selectized"  placeholder="Enter option separated by comma">
                                                                    <option value="Sweet">Sweet</option>

                                                                    <option value="Rude">Rude</option>

                                                                    <option value="Selfish">Selfish</option>

                                                                    <option value="Shy">Shy</option>

                                                                    <option value="Silly">Silly</option>

                                                                    <option value="Materialistic">Materialistic</option>

                                                                    <option value="Social">Social</option>

                                                                    <option value="Honest">Honest</option>

                                                                    <option value="Generous">Generous</option>

                                                                    <option value="Lazy">Lazy</option>

                                                                    <option value="Mean">Mean</option>

                                                                    <option value="Moody">Moody</option>

                                                                    <option value="Courteous">Courteous</option>

                                                                    <option value="Sensitive">Sensitive</option>

                                                                    <option value="Miser">Miser</option>

                                                                    <option value="Considerate">Considerate</option>

                                                                    <option value="Affectionate">Affectionate</option>

                                                                    <option value="Ambitious">Ambitious</option>

                                                                    <option value="Bad-tempered">Bad-tempered</option>

                                                                    <option value="Greedy">Greedy</option>

                                                                    <option value="Bossy">Bossy</option>

                                                                    <option value="Charismatic">Charismatic</option>

                                                                    <option value="Courageous">Courageous</option>

                                                                    <option value="Dependable">Dependable</option>

                                                                    <option value="Devious">Devious</option>

                                                                    <option value="Joyful">Joyful</option>

                                                                    <option value="Talkative">Talkative</option>

                                                                    <option value="Sympathetic">Sympathetic</option>

                                                                    <option value="Optimist">Optimist</option>

                                                                    <option value="Pessimist">Pessimist</option>

                                                                    <option value="Dim">Dim</option>

                                                                    <option value="Egotistical">Egotistical</option>

                                                                    <option value="Impulsive">Impulsive</option>

                                                                    <option value="Smart">Smart</option>

                                                                    <option value="Respectful">Respectful</option>

                                                                    <option value="Thoughtful">Thoughtful</option>

                                                                    <option value="Friendly">Friendly</option>

                                                                    <option value="Funny">Funny</option>
                                                                    <option value="Pessimist">Pessimist</option>

                                                                    <option value="Dim">Dim</option>

                                                                    <option value="Egotistical">Egotistical</option>

                                                                    <option value="Impulsive">Impulsive</option>

                                                                    <option value="Smart">Smart</option>

                                                                    <option value="Respectful">Respectful</option>

                                                                    <option value="Thoughtful">Thoughtful</option>

                                                                    <option value="Friendly">Friendly</option>

                                                                    <option value="Funny">Funny</option>
                                                                    <option value="Intelligent">Intelligent</option>

                                                                    <option value="Religious">Religious</option>

                                                                    <option value="Corrupt">Corrupt</option>

                                                                    <option value="Traitor">Traitor</option>

                                                                    <option value="Unskilled">Unskilled</option>

                                                                    <option value="Leader">Leader</option>

                                                                    <option value="Follower">Follower</option>


                                                                    <option value="Selfless">Selfless</option>
                                                                    <option value="Unattractive">Unattractive</option>

                                                                    <option value="Charming">Charming</option>

                                                                    <option value="Communicator">Communicator</option>

                                                                    <option value="Negotiator">Negotiator</option>

                                                                    <option value="Intellectual">Intellectual</option>

                                                                    <option value="Energetic">Energetic</option>

                                                                    <option value="Lethargic">Lethargic</option>

                                                                    <option value="Liar">Liar</option>

                                                                    <option value="Pleasing">Pleasing</option>

                                                                    <option value="Disgusting">Disgusting</option>

                                                                    <option value="Flip-flop">Flip-flop</option>

                                                                    <option value="Competent">Competent</option>

                                                                    <option value="Incompetent">Incompetent</option>
                                                                </select>
                                                                <small class="text-muted dis-block">Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.</small>
                                                            </div>
                                                            <script>
                                                                $('#select-state').selectize({
                                                                    maxItems: 15
                                                                });
                                                            </script>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="control-label pull-left" for="message">Detail review:</label>
                                                            <textarea class="required form-control" id="message" name="message" rows="6" placeholder="Please describe the person you are reviewing. Example: Good habits, bad habits, your experiences etc."><?php echo (isset($recommend) ? $recommend->message : ''); ?></textarea>
                                                        </div>
                                                        <button type="submit" onclick="myfunction()" class="btn btn-primary">Review Publicly</button>

                                                    </form>
                                                <?php } else {
                                                    ?>

                                                    <form role="form" class="validate-form" method="post"  action="<?php echo url::base() . "pp/write_review" ?> " autocomplete="off">
                                                        <input type="hidden" name="username" value="<?php echo $user->username; ?>">
                                                        <input type="hidden" id="p_type" name="password_type" value="">
                                                        <div id="st1"  style="display: none;">
                                                            <div class="form-group" style="position:relative;">
                                                                <label class="control-label pull-left" for="recommend-email"> To continue, please enter your email address:</label>

                                                                <input type="email" id="search-query5" name="email" class="required email find_user form-control" id="recommend-email" placeholder="Enter email address" autocomplete='off'
                                                                       value="">
                                                            </div>
                                                            <div class="form-group first_name"  style="position:relative;">
                                                                <label class="control-label pull-left" for="recommend-email"> First Name:</label>

                                                                <input type="text" name="first_name" id="first_name" class="form-control required"  placeholder="Enter First name" autocomplete='off'
                                                                       value="">

                                                            </div>
                                                            <div class="form-group last_name" style="position:relative;">
                                                                <label class="control-label pull-left" > Last Name:</label>

                                                                <input type="text" name="last_name" id="last_name" class="form-control required"  placeholder="Enter Last name" autocomplete='off'
                                                                       value="">

                                                            </div>

                                                            <div class="form-group password"  style="position:relative;display:none;">
                                                                <label class="control-label pull-left" > Password :</label>

                                                                <input type="password" name="password" id="password" class="form-control"  placeholder="Enter Password"  value="" autocomplete='off'>

                                                            </div>
                                                            <div id="next_div">
                                                                <a class="btn btn-success" id="btnnxt3">Next </a>
                                                            </div>

                                                            <div class="form-group submit_review"  style="position:relative;display:none;">
                                                                <button type="submit" class="btn btn-primary" name="submit" id="submit_review">Submit Review</button>

                                                            </div>
                                                        </div> 

                                                        <!---------------------------popup 3--------------------------------------------------------->
                                                        <div id="st3"  style="display: none;">
                                                            <div class="form-group">
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
                                                                    <div class="col-sm-4">
                                                                        <select name="day" class="dis-in-block form-control">
                                                                            <option value="">Day:</option>
                                                                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php } ?>      
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select id="yearOfBirth" class="dis-in-block form-control" name="year" >
                                                                            <option value="">Year:</option>
                                                                            <?php $y = date('Y'); ?>
                                                                            <?php for ($n = $y - 100; $n <= $y; $n++) { ?>
                                                                                <option value="<?php echo $n; ?>"><?php echo $n; ?></option>
                                                                            <?php } ?> 
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="submit" onclick="myfunction()" class="btn btn-primary">Submit Review </button>

                                                        </div>

                                                        <!------------------------------------------------------------------------------------------>
                                                        <div id="st2">
                                                            <label class="control-label pull-left" for="message">Words that describe <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?></label>

                                                            <div class="form-group">

                                                                <div class="control-group">

                                                                    <select id="select-state" name="words[]" multiple class="demo-default selectized"  placeholder="Enter option separated by comma">

                                                                        <option value="Sweet">Sweet</option>

                                                                        <option value="Rude">Rude</option>

                                                                        <option value="Selfish">Selfish</option>

                                                                        <option value="Shy">Shy</option>

                                                                        <option value="Silly">Silly</option>

                                                                        <option value="Materialistic">Materialistic</option>

                                                                        <option value="Social">Social</option>

                                                                        <option value="Honest">Honest</option>

                                                                        <option value="Generous">Generous</option>

                                                                        <option value="Lazy">Lazy</option>

                                                                        <option value="Mean">Mean</option>

                                                                        <option value="Moody">Moody</option>

                                                                        <option value="Courteous">Courteous</option>

                                                                        <option value="Sensitive">Sensitive</option>

                                                                        <option value="Miser">Miser</option>

                                                                        <option value="Considerate">Considerate</option>

                                                                        <option value="Affectionate">Affectionate</option>

                                                                        <option value="Ambitious">Ambitious</option>

                                                                        <option value="Bad-tempered">Bad-tempered</option>

                                                                        <option value="Greedy">Greedy</option>

                                                                        <option value="Bossy">Bossy</option>

                                                                        <option value="Charismatic">Charismatic</option>

                                                                        <option value="Courageous">Courageous</option>

                                                                        <option value="Dependable">Dependable</option>

                                                                        <option value="Devious">Devious</option>

                                                                        <option value="Joyful">Joyful</option>

                                                                        <option value="Talkative">Talkative</option>

                                                                        <option value="Sympathetic">Sympathetic</option>

                                                                        <option value="Optimist">Optimist</option>

                                                                        <option value="Pessimist">Pessimist</option>

                                                                        <option value="Dim">Dim</option>

                                                                        <option value="Egotistical">Egotistical</option>

                                                                        <option value="Impulsive">Impulsive</option>

                                                                        <option value="Smart">Smart</option>

                                                                        <option value="Respectful">Respectful</option>

                                                                        <option value="Thoughtful">Thoughtful</option>

                                                                        <option value="Friendly">Friendly</option>

                                                                        <option value="Funny">Funny</option>
                                                                        <option value="Pessimist">Pessimist</option>

                                                                        <option value="Dim">Dim</option>

                                                                        <option value="Egotistical">Egotistical</option>

                                                                        <option value="Impulsive">Impulsive</option>

                                                                        <option value="Smart">Smart</option>

                                                                        <option value="Respectful">Respectful</option>

                                                                        <option value="Thoughtful">Thoughtful</option>

                                                                        <option value="Friendly">Friendly</option>

                                                                        <option value="Funny">Funny</option>
                                                                        <option value="Intelligent">Intelligent</option>

                                                                        <option value="Religious">Religious</option>

                                                                        <option value="Corrupt">Corrupt</option>

                                                                        <option value="Traitor">Traitor</option>

                                                                        <option value="Unskilled">Unskilled</option>

                                                                        <option value="Leader">Leader</option>

                                                                        <option value="Follower">Follower</option>


                                                                        <option value="Selfless">Selfless</option>
                                                                        <option value="Unattractive">Unattractive</option>

                                                                        <option value="Charming">Charming</option>

                                                                        <option value="Communicator">Communicator</option>

                                                                        <option value="Negotiator">Negotiator</option>

                                                                        <option value="Intellectual">Intellectual</option>

                                                                        <option value="Energetic">Energetic</option>

                                                                        <option value="Lethargic">Lethargic</option>

                                                                        <option value="Liar">Liar</option>

                                                                        <option value="Pleasing">Pleasing</option>

                                                                        <option value="Disgusting">Disgusting</option>

                                                                        <option value="Flip-flop">Flip-flop</option>

                                                                        <option value="Competent">Competent</option>

                                                                        <option value="Incompetent">Incompetent</option>
                                                                    </select>
                                                                    <small class="text-muted dis-block">Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.</small>
                                                                </div>
                                                                <script>
                                                                    $('#select-state').selectize({
                                                                        maxItems: 15
                                                                    });
                                                                </script>
                                                            </div>


                                                            <div class="form-group">
                                                                <label class="control-label pull-left" for="message">Detail review:</label>
                                                                <textarea class="required form-control" id="message" name="message" rows="6" placeholder="Please describe the person you are reviewing. Example: Good habits, bad habits, your experiences etc."><?php echo (isset($recommend) ? $recommend->message : ''); ?></textarea>
                                                            </div>
                                                            <a class="btn btn-success" id="btnnxt1"> Review Publicly </a>
                                                        </div>
                                                    </form>
                                                <?php } ?>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#btnnxt1').click(function ()
                                            {

                                                if ($('#message').val().trim().length > 0)
                                                {
                                                    $('#st2').hide();
                                                    $('#st3').hide();
                                                    $('#st1').show();

                                                }
                                                else
                                                {
                                                    alert('Please fill details..');
                                                    $('#message').focus();
                                                }




                                            });
                                            $('#btnnxt3').click(function ()
                                            {

                                                if ($('#first_name').val() == '')
                                                {
                                                    $('#first_name').focus();
                                                }
                                                else if ($('#last_name').val() == '')
                                                {
                                                    $('#last_name').focus();
                                                }
                                                else if ($('#password').val() == '')
                                                {
                                                    $('#password').focus();
                                                }
                                                else
                                                {

                                                    $('#st2').hide();
                                                    $('#st1').hide();
                                                    $('#st3').show();
                                                }
                                            });

                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php  } 
    } else { ?>
    <div class="">
                    <div class="" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 9999;"aria-hidden="true" >
                        <div class="modal-dialog">
                            <div class="modal-content modal-content-four">
                                <div class="modal-header">
                                    
                                    <h4 class="modal-title" id="myModalLabel"> Write Review to <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?>  </h4>
                                </div>
                                <div class="modal-body">

                                    <link rel="stylesheet" href="<?php echo url::base(); ?>assets/multiple/css/normalize.css">
                                    <link rel="stylesheet" href="<?php echo url::base(); ?>assets/multiple/css/stylesheet.css">

                                    <script src="<?php echo url::base(); ?>assets/multiple/dist/js/standalone/selectize.js"></script>
                                    <script src="<?php echo url::base(); ?>assets/multiple/js/index.js"></script>
                                    <script>
                            $(document).ready(function () {
                                $('.password').hide();
                                $('.first_name').hide();
                                $('.last_name').hide();

                                var base_url = 'https://m.callitme.com/';
                                $('#search-query5').keyup(function ()
                                {

                                    var query = $(this).val();
                                    query = $.trim(query);


                                    if (query !== "")
                                    {  // If something was entered
                                        if (isValidEmailAddress(query))
                                        {
                                            $('#loading').show();

                                            $.ajax({
                                                type: 'get',
                                                url: base_url + "pages/select_user",
                                                data: 'query=' + query,
                                                success: function (data)
                                                {

                                                    if (data == 'True')
                                                    {
                                                        $('#loading').hide();
                                                        $('.first_name').hide();
                                                        $('.last_name').hide();
                                                        $('.password').show();
                                                        $('#p_type').val('Yes');
                                                        $('#next_div').hide();
                                                        $('.submit_review').show();

                                                    }
                                                    else
                                                    {
                                                        $('.first_name').show();
                                                        $('.last_name').show();
                                                        $('.password').show();

                                                        $('#p_type').val('No');
                                                        $('#loading').hide();
                                                    }
                                                }
                                            });

                                        }
                                        else
                                        {
                                            $('.password').hide();
                                            $('.first_name').hide();
                                            $('.last_name').hide();
                                        }



                                    }
                                    if (query == '')
                                    {
                                        $('.password').hide();
                                        $('.first_name').hide();
                                        $('.last_name').hide();

                                    }

                                });

                                function isValidEmailAddress(emailAddress) {
                                    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
                                    return pattern.test(emailAddress);
                                }
                                ;
                            });
                                    </script>

                                    <div class="row marTop20">
                                        <div class="col-sm-12">


                                            <fieldset class="fieldset">
                                                <?php
                                                if (Auth::instance()->logged_in()) {
                                                    ?>

                                                    <form role="form" class="validate-form" method="post"  action="<?php echo url::base() . "pp/write_review" ?> " autocomplete="off">
                                                        <input type="hidden" name="username" value="<?php echo $user->username; ?>">

                                                        <input type="hidden" id="p_type" name="password_type" value="1">
                                                        <label class="control-label pull-left" for="message">Words that describe <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?></label>

                                                        <div class="form-group">

                                                            <div class="control-group">

                                                                <select id="select-state" name="words[]" multiple class="demo-default selectized"  placeholder="Enter option separated by comma">
                                                                    <option value="Sweet">Sweet</option>

                                                                    <option value="Rude">Rude</option>

                                                                    <option value="Selfish">Selfish</option>

                                                                    <option value="Shy">Shy</option>

                                                                    <option value="Silly">Silly</option>

                                                                    <option value="Materialistic">Materialistic</option>

                                                                    <option value="Social">Social</option>

                                                                    <option value="Honest">Honest</option>

                                                                    <option value="Generous">Generous</option>

                                                                    <option value="Lazy">Lazy</option>

                                                                    <option value="Mean">Mean</option>

                                                                    <option value="Moody">Moody</option>

                                                                    <option value="Courteous">Courteous</option>

                                                                    <option value="Sensitive">Sensitive</option>

                                                                    <option value="Miser">Miser</option>

                                                                    <option value="Considerate">Considerate</option>

                                                                    <option value="Affectionate">Affectionate</option>

                                                                    <option value="Ambitious">Ambitious</option>

                                                                    <option value="Bad-tempered">Bad-tempered</option>

                                                                    <option value="Greedy">Greedy</option>

                                                                    <option value="Bossy">Bossy</option>

                                                                    <option value="Charismatic">Charismatic</option>

                                                                    <option value="Courageous">Courageous</option>

                                                                    <option value="Dependable">Dependable</option>

                                                                    <option value="Devious">Devious</option>

                                                                    <option value="Joyful">Joyful</option>

                                                                    <option value="Talkative">Talkative</option>

                                                                    <option value="Sympathetic">Sympathetic</option>

                                                                    <option value="Optimist">Optimist</option>

                                                                    <option value="Pessimist">Pessimist</option>

                                                                    <option value="Dim">Dim</option>

                                                                    <option value="Egotistical">Egotistical</option>

                                                                    <option value="Impulsive">Impulsive</option>

                                                                    <option value="Smart">Smart</option>

                                                                    <option value="Respectful">Respectful</option>

                                                                    <option value="Thoughtful">Thoughtful</option>

                                                                    <option value="Friendly">Friendly</option>

                                                                    <option value="Funny">Funny</option>
                                                                    <option value="Pessimist">Pessimist</option>

                                                                    <option value="Dim">Dim</option>

                                                                    <option value="Egotistical">Egotistical</option>

                                                                    <option value="Impulsive">Impulsive</option>

                                                                    <option value="Smart">Smart</option>

                                                                    <option value="Respectful">Respectful</option>

                                                                    <option value="Thoughtful">Thoughtful</option>

                                                                    <option value="Friendly">Friendly</option>

                                                                    <option value="Funny">Funny</option>
                                                                    <option value="Intelligent">Intelligent</option>

                                                                    <option value="Religious">Religious</option>

                                                                    <option value="Corrupt">Corrupt</option>

                                                                    <option value="Traitor">Traitor</option>

                                                                    <option value="Unskilled">Unskilled</option>

                                                                    <option value="Leader">Leader</option>

                                                                    <option value="Follower">Follower</option>


                                                                    <option value="Selfless">Selfless</option>
                                                                    <option value="Unattractive">Unattractive</option>

                                                                    <option value="Charming">Charming</option>

                                                                    <option value="Communicator">Communicator</option>

                                                                    <option value="Negotiator">Negotiator</option>

                                                                    <option value="Intellectual">Intellectual</option>

                                                                    <option value="Energetic">Energetic</option>

                                                                    <option value="Lethargic">Lethargic</option>

                                                                    <option value="Liar">Liar</option>

                                                                    <option value="Pleasing">Pleasing</option>

                                                                    <option value="Disgusting">Disgusting</option>

                                                                    <option value="Flip-flop">Flip-flop</option>

                                                                    <option value="Competent">Competent</option>

                                                                    <option value="Incompetent">Incompetent</option>
                                                                </select>
                                                                <small class="text-muted dis-block">Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.</small>
                                                            </div>
                                                            <script>
                                                                $('#select-state').selectize({
                                                                    maxItems: 15
                                                                });
                                                            </script>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="control-label pull-left" for="message">Detail review:</label>
                                                            <textarea class="required form-control" id="message" name="message" rows="6" placeholder="Please describe the person you are reviewing. Example: Good habits, bad habits, your experiences etc."><?php echo (isset($recommend) ? $recommend->message : ''); ?></textarea>
                                                        </div>
                                                        <button type="submit" onclick="myfunction()" class="btn btn-primary">Review Publicly</button>

                                                    </form>
                                                <?php } else {
                                                    ?>

                                                    <form role="form" class="validate-form" method="post"  action="<?php echo url::base() . "pp/write_review" ?> " autocomplete="off">
                                                        <input type="hidden" name="username" value="<?php echo $user->username; ?>">
                                                        <input type="hidden" id="p_type" name="password_type" value="">
                                                        <div id="st1"  style="display: none;">
                                                            <div class="form-group" style="position:relative;">
                                                                <label class="control-label pull-left" for="recommend-email"> To continue, please enter your email address:</label>

                                                                <input type="email" id="search-query5" name="email" class="required email find_user form-control" id="recommend-email" placeholder="Enter email address" autocomplete='off'
                                                                       value="">
                                                            </div>
                                                            <div class="form-group first_name"  style="position:relative;">
                                                                <label class="control-label pull-left" for="recommend-email"> First Name:</label>

                                                                <input type="text" name="first_name" id="first_name" class="form-control required"  placeholder="Enter First name" autocomplete='off'
                                                                       value="">

                                                            </div>
                                                            <div class="form-group last_name" style="position:relative;">
                                                                <label class="control-label pull-left" > Last Name:</label>

                                                                <input type="text" name="last_name" id="last_name" class="form-control required"  placeholder="Enter Last name" autocomplete='off'
                                                                       value="">

                                                            </div>

                                                            <div class="form-group password"  style="position:relative;display:none;">
                                                                <label class="control-label pull-left" > Password :</label>

                                                                <input type="password" name="password" id="password" class="form-control"  placeholder="Enter Password"  value="" autocomplete='off'>

                                                            </div>
                                                            <div id="next_div">
                                                                <a class="btn btn-success" id="btnnxt3">Next </a>
                                                            </div>

                                                            <div class="form-group submit_review"  style="position:relative;display:none;">
                                                                <button type="submit" class="btn btn-primary" name="submit" id="submit_review">Submit Review</button>

                                                            </div>
                                                        </div> 

                                                        <!---------------------------popup 3--------------------------------------------------------->
                                                        <div id="st3"  style="display: none;">
                                                            <div class="form-group">
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
                                                                    <div class="col-sm-4">
                                                                        <select name="day" class="dis-in-block form-control">
                                                                            <option value="">Day:</option>
                                                                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php } ?>      
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select id="yearOfBirth" class="dis-in-block form-control" name="year" >
                                                                            <option value="">Year:</option>
                                                                            <?php $y = date('Y'); ?>
                                                                            <?php for ($n = $y - 100; $n <= $y; $n++) { ?>
                                                                                <option value="<?php echo $n; ?>"><?php echo $n; ?></option>
                                                                            <?php } ?> 
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="submit" onclick="myfunction()" class="btn btn-primary">Submit Review </button>

                                                        </div>

                                                        <!------------------------------------------------------------------------------------------>
                                                        <div id="st2">
                                                            <label class="control-label pull-left" for="message">Words that describe <?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name; ?></label>

                                                            <div class="form-group">

                                                                <div class="control-group">

                                                                    <select id="select-state" name="words[]" multiple class="demo-default selectized"  placeholder="Enter option separated by comma">

                                                                        <option value="Sweet">Sweet</option>

                                                                        <option value="Rude">Rude</option>

                                                                        <option value="Selfish">Selfish</option>

                                                                        <option value="Shy">Shy</option>

                                                                        <option value="Silly">Silly</option>

                                                                        <option value="Materialistic">Materialistic</option>

                                                                        <option value="Social">Social</option>

                                                                        <option value="Honest">Honest</option>

                                                                        <option value="Generous">Generous</option>

                                                                        <option value="Lazy">Lazy</option>

                                                                        <option value="Mean">Mean</option>

                                                                        <option value="Moody">Moody</option>

                                                                        <option value="Courteous">Courteous</option>

                                                                        <option value="Sensitive">Sensitive</option>

                                                                        <option value="Miser">Miser</option>

                                                                        <option value="Considerate">Considerate</option>

                                                                        <option value="Affectionate">Affectionate</option>

                                                                        <option value="Ambitious">Ambitious</option>

                                                                        <option value="Bad-tempered">Bad-tempered</option>

                                                                        <option value="Greedy">Greedy</option>

                                                                        <option value="Bossy">Bossy</option>

                                                                        <option value="Charismatic">Charismatic</option>

                                                                        <option value="Courageous">Courageous</option>

                                                                        <option value="Dependable">Dependable</option>

                                                                        <option value="Devious">Devious</option>

                                                                        <option value="Joyful">Joyful</option>

                                                                        <option value="Talkative">Talkative</option>

                                                                        <option value="Sympathetic">Sympathetic</option>

                                                                        <option value="Optimist">Optimist</option>

                                                                        <option value="Pessimist">Pessimist</option>

                                                                        <option value="Dim">Dim</option>

                                                                        <option value="Egotistical">Egotistical</option>

                                                                        <option value="Impulsive">Impulsive</option>

                                                                        <option value="Smart">Smart</option>

                                                                        <option value="Respectful">Respectful</option>

                                                                        <option value="Thoughtful">Thoughtful</option>

                                                                        <option value="Friendly">Friendly</option>

                                                                        <option value="Funny">Funny</option>
                                                                        <option value="Pessimist">Pessimist</option>

                                                                        <option value="Dim">Dim</option>

                                                                        <option value="Egotistical">Egotistical</option>

                                                                        <option value="Impulsive">Impulsive</option>

                                                                        <option value="Smart">Smart</option>

                                                                        <option value="Respectful">Respectful</option>

                                                                        <option value="Thoughtful">Thoughtful</option>

                                                                        <option value="Friendly">Friendly</option>

                                                                        <option value="Funny">Funny</option>
                                                                        <option value="Intelligent">Intelligent</option>

                                                                        <option value="Religious">Religious</option>

                                                                        <option value="Corrupt">Corrupt</option>

                                                                        <option value="Traitor">Traitor</option>

                                                                        <option value="Unskilled">Unskilled</option>

                                                                        <option value="Leader">Leader</option>

                                                                        <option value="Follower">Follower</option>

                                                                        <option value="Selfless">Selfless</option>
                                                                        <option value="Unattractive">Unattractive</option>

                                                                        <option value="Charming">Charming</option>

                                                                        <option value="Communicator">Communicator</option>

                                                                        <option value="Negotiator">Negotiator</option>

                                                                        <option value="Intellectual">Intellectual</option>

                                                                        <option value="Energetic">Energetic</option>

                                                                        <option value="Lethargic">Lethargic</option>

                                                                        <option value="Liar">Liar</option>

                                                                        <option value="Pleasing">Pleasing</option>

                                                                        <option value="Disgusting">Disgusting</option>

                                                                        <option value="Flip-flop">Flip-flop</option>

                                                                        <option value="Competent">Competent</option>

                                                                        <option value="Incompetent">Incompetent</option>
                                                                    </select>
                                                                    <small class="text-muted dis-block">Feel free to select whatever you want. This information is confidential and will not be revealed to anyone.</small>
                                                                </div>
                                                                <script>
                                                                    $('#select-state').selectize({
                                                                        maxItems: 15
                                                                    });
                                                                </script>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label pull-left" for="message">Detail review:</label>
                                                                <textarea class="required form-control" id="message" name="message" rows="6" placeholder="Please describe the person you are reviewing. Example: Good habits, bad habits, your experiences etc."><?php echo (isset($recommend) ? $recommend->message : ''); ?></textarea>
                                                            </div>
                                                            <a class="btn btn-success" id="btnnxt1"> Review Publicly </a>
                                                        </div>
                                                    </form>
                                                <?php } ?>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#btnnxt1').click(function ()
                                            {
                                                if ($('#message').val().trim().length > 0)
                                                {
                                                    $('#st2').hide();
                                                    $('#st3').hide();
                                                    $('#st1').show();
                                                }
                                                else
                                                {
                                                    alert('Please fill details..');
                                                    $('#message').focus();
                                                }
                                            });
                                            $('#btnnxt3').click(function ()
                                            {
                                                if ($('#first_name').val() == '')
                                                {
                                                    $('#first_name').focus();
                                                }
                                                else if ($('#last_name').val() == '')
                                                {
                                                    $('#last_name').focus();
                                                }
                                                else if ($('#password').val() == '')
                                                {
                                                    $('#password').focus();
                                                }
                                                else
                                                {
                                                    $('#st2').hide();
                                                    $('#st1').hide();
                                                    $('#st3').show();
                                                }
                                            });

                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          <?php } ?>
            </div>
        </div>
        <div class="row">
            <?php if ($user->user_detail->about_private != 1) { ?>
            <div class="col-sm-12 marTop20">
                <?php if ($user->user_detail->about) { ?>
                <div class="row" id="sroll_pan">
                    <div class="col-sm-12">
                        <div class="panel-heading" >
                            <p class="panel-title"><span class="glyphicon glyphicon-comment"></span> What people say about  <?php echo $user->user_detail->first_name; ?> </p>
                        </div>
                        <div class="panel-body hb-p-0" id="comments">
                            <?php if (!empty($recommends)) { ?>
                            <ul class="list-group hb-m-0">
                                <?php foreach ($recommends as $recommend) { ?>  
                                <?php if($recommend->owner->is_blocked == '0') { ?>   
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4">
                                            <a href="<?php echo url::base() . $recommend->owner->username; ?>">
                                                <?php 
                                                $photo = $recommend->owner->photo->profile_pic_s;
                                                $rec_image = file_exists("mobile/upload/" .$photo);
                                                $rec_image1 = file_exists("upload/" .$photo);
                                                if (!empty($photo) && $rec_image) { ?>
                                                <img src="<?php echo url::base() . 'mobile/upload/' . $recommend->owner->photo->profile_pic_s; ?>"  class="pull-left hb-mr-10" style="width:55px;height:55px; border-radius:50%;">
                                                <?php }
                                                else if (!empty($photo) && $rec_image1) { ?>
                                                <img src="<?php echo url::base() . 'upload/' . $recommend->owner->photo->profile_pic_s; ?>"  class="pull-left hb-mr-10" style="width:55px;height:55px; border-radius:50%;">
                                                <?php } else { ?>
                                                <span class="glyphicon glyphicon-user fa-3x" style="width:63px; height:63px;  border-radius:50%;float: left;"></span>
                                                <?php } ?>
                                                
                                                <span style="color:#FF2A7F;" class="hb-m-0">
                                                    <?php
                                                    if ($recommend->owner->user_detail->first_name != '') {
                                                        echo $recommend->owner->user_detail->first_name . " " . $recommend->owner->user_detail->last_name;
                                                    } else {
                                                        echo "Anonymous User";
                                                    }
                                                    ?>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-9 col-sm-8">
                                            <div class="collapse-body collapseable collapse in" style="border-top: 0px ;">
                                                <div class="collapse-body-content hb-p-0" style="border-top: 0px ;">
                                                    <p class="hb-m-0"><?php echo nl2br($recommend->message); ?></p>
                                                </div>
                                            </div>

                                            <div class="post-matter collapse-description collapse collapseable">
                                                <p class="hb-m-0"><?php echo substr($recommend->message, 0, 70); ?>
                                                    <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                            <?php } ?>                            
                            </ul>    
                            <?php } else { ?>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>

        <style type="text/css">
            .src-image {
                display: none;
            }

            .card {
                overflow: hidden;
                position: relative;
                border: 1px solid #F9F4F4;
                border-radius: 8px;
                text-align: center;
                padding: 0;
                background-color: #00bcd4;
                color: rgb(136, 172, 217);
            }

            .card .header-bg {
                /* This stretches the canvas across the entire hero unit */
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 90px;
                border-bottom: 1px #FFF solid;
                /* This positions the canvas under the text */
                z-index: 1;
                background-color: mintcream;
            }
            .card .avatar {
                position: relative;
                margin-top: 15px;
                z-index: 100;
            }

            .card .avatar img {
                width: 100px;
                height: 100px;
                -webkit-border-radius: 50%;
                -moz-border-radius: 50%;
                border-radius: 50%;
                border: 2px solid rgba(0,0,30,0.8);
            }


        </style>


    </div>
</div>

<script src='<?php echo url::base(); ?>js/jquery.knob.js'></script>
<script>
$(document).ready(function () {
    $('.dial').each(function () {

        var elm = $(this);
        var color = elm.attr("data-fgColor");
        var perc = elm.attr("value");

        elm.knob({
            'value': 0,
            'min': 0,
            'max': 100,
            "skin": "tron",
            "readOnly": true,
            "thickness": .1,
            "dynamicDraw": true,
            "displayInput": false
        });

        $({value: 0}).animate({value: perc}, {
            duration: 1000,
            easing: 'swing',
            progress: function () {
                elm.val(Math.ceil(this.value)).trigger('change')
            }
        });

        //circular progress bar color
        $(this).append(function () {
            elm.parent().parent().find('.circular-bar-content').css('color', color);
            elm.parent().parent().find('.circular-bar-content label').text(perc + '%');
        });

    });

});
</script>
<div class="ribbion-modal modal fade" id="editBasicInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <img src="<?php echo url::base(); ?>img/close.png" />
                                </button>
                                <div class="ribbion">
                                    <h2>Profession</h2>
                                </div>
                                <div class="triangle-l"></div>
                                
                                <div class="clearfix"></div>
                            </div>
                            
                            <form method="post" action="<?php echo url::base(); ?>pp/edit_public_data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label" for="designation">Designation:</label>
                                        <input class="form-control" id="designation" type="text" name="designation" placeholder="What is your job title?" value="<?php echo $user->user_detail->designation; ?>">
                                        <input class="hidden" name="user_detail_id" value="<?php echo $user->user_detail_id; ?>">
                                        <input class="hidden" name="user_detail_username" value="<?php echo $user->username; ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-secondary">Save changes</button>
                                </div>
                            </form>

                        </div><!-- /.modal-content -->
                        
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->