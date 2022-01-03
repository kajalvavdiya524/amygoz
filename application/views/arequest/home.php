<style>
    .ui-autocomplete-loading {
        background: white url("<?php echo url::base(); ?>img/load_er.gif") right center no-repeat;
    }
    
    .post.selected-user {
        background-color: #d9edf7;
        padding: 10px;
        border-color: #bce8f1;
        
    }
    .post.selected-user .xs {
        margin-top: 0px !important;
    }
    .post.selected-user .post-title {
        margin-left: 5px;
        color: #3a87ad !important;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p>Requests Received</p>
            </div>
            <?php if (!empty($arequests)) { ?>
                <div class="panel-body">
                    <?php foreach ($arequests as $arequest) { ?>
                        <a href="<?php echo url::base() . "activity/view/" . $arequest->id; ?>" style="display:block;">
                            <span style="font-size:18px;">You have a <?php echo $arequest->plan; ?> request</span>
                        </a>
                    <?php } ?>
                </div>    
            <?php } else { ?>
                <div class="request-review-panel">
                    <i class="fa fa-frown-o"></i>
                    <h4 style="text-align: center;">You don't have any incoming requests</h4>

                    <div class="clearfix marBottom20"></div>

                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="199.268px" height="71.779px" viewBox="0 0 199.268 71.779" enable-background="new 0 0 199.268 71.779"
                         xml:space="preserve">
                        <g>
                            <g>
                                <path fill="#FFFFFF" d="M70.628,35.89c0,19.185-15.553,34.738-34.738,34.738S1.151,55.075,1.151,35.89
                                      c0-19.186,15.553-34.739,34.738-34.739S70.628,16.704,70.628,35.89z"/>
                                <path fill="#016064" d="M35.89,71.779C16.1,71.779,0,55.679,0,35.89C0,16.1,16.1,0,35.89,0s35.89,16.1,35.89,35.89
                                      C71.779,55.679,55.679,71.779,35.89,71.779z M35.89,2.303C17.37,2.303,2.303,17.37,2.303,35.89
                                      c0,18.52,15.067,33.586,33.587,33.586S69.477,54.41,69.477,35.89C69.477,17.37,54.41,2.303,35.89,2.303z"/>
                            </g>
                            <g>
                                <path fill="#016064" d="M13.042,25.282c0.606,0.374,1.492,0.684,2.424,0.684c1.383,0,2.191-0.73,2.191-1.787
                                      c0-0.979-0.56-1.539-1.974-2.082c-1.709-0.606-2.766-1.492-2.766-2.968c0-1.632,1.352-2.844,3.387-2.844
                                      c1.072,0,1.849,0.25,2.315,0.514l-0.373,1.103c-0.342-0.187-1.041-0.497-1.989-0.497c-1.429,0-1.973,0.854-1.973,1.569
                                      c0,0.979,0.637,1.46,2.082,2.021c1.771,0.684,2.673,1.538,2.673,3.076c0,1.616-1.196,3.015-3.667,3.015
                                      c-1.01,0-2.113-0.295-2.673-0.668L13.042,25.282z"/>
                                <path fill="#016064" d="M21.699,23.417c0.031,1.85,1.212,2.611,2.58,2.611c0.979,0,1.569-0.171,2.083-0.389l0.233,0.979
                                      c-0.482,0.217-1.305,0.466-2.501,0.466c-2.315,0-3.698-1.522-3.698-3.792c0-2.269,1.336-4.056,3.527-4.056
                                      c2.455,0,3.107,2.16,3.107,3.543c0,0.28-0.031,0.498-0.046,0.637H21.699z M25.708,22.438c0.016-0.87-0.357-2.222-1.896-2.222
                                      c-1.383,0-1.989,1.274-2.098,2.222H25.708z"/>
                                <path fill="#016064" d="M28.725,21.444c0-0.777-0.016-1.414-0.063-2.036h1.212l0.078,1.243h0.031
                                      c0.373-0.715,1.243-1.414,2.486-1.414c1.041,0,2.657,0.622,2.657,3.201v4.491H33.76v-4.335c0-1.212-0.451-2.222-1.741-2.222
                                      c-0.901,0-1.601,0.637-1.833,1.398c-0.062,0.171-0.093,0.404-0.093,0.637v4.522h-1.367V21.444z"/>
                                <path fill="#016064" d="M43.846,15.896v9.09c0,0.668,0.016,1.43,0.062,1.942h-1.227l-0.063-1.306h-0.031
                                      c-0.419,0.839-1.336,1.477-2.563,1.477c-1.818,0-3.216-1.538-3.216-3.822c-0.016-2.502,1.538-4.041,3.372-4.041
                                      c1.15,0,1.927,0.544,2.269,1.15h0.031v-4.491H43.846z M42.479,22.469c0-0.171-0.016-0.404-0.063-0.575
                                      c-0.202-0.87-0.948-1.585-1.973-1.585c-1.414,0-2.253,1.243-2.253,2.906c0,1.523,0.746,2.782,2.222,2.782
                                      c0.917,0,1.756-0.606,2.004-1.632c0.047-0.187,0.063-0.373,0.063-0.591V22.469z"/>
                                <path fill="#016064" d="M53.577,26.929l-0.109-0.948h-0.046c-0.42,0.591-1.228,1.119-2.3,1.119c-1.522,0-2.299-1.072-2.299-2.16
                                      c0-1.818,1.616-2.813,4.522-2.797v-0.155c0-0.622-0.171-1.741-1.709-1.741c-0.699,0-1.43,0.218-1.958,0.56l-0.311-0.901
                                      c0.622-0.404,1.522-0.668,2.47-0.668c2.3,0,2.859,1.57,2.859,3.077v2.813c0,0.653,0.031,1.29,0.124,1.803H53.577z M53.375,23.091
                                      c-1.492-0.031-3.185,0.233-3.185,1.694c0,0.886,0.59,1.306,1.29,1.306c0.979,0,1.601-0.622,1.818-1.259
                                      c0.047-0.14,0.078-0.295,0.078-0.435V23.091z"/>
                                <path fill="#016064" d="M12.133,36.146c0-0.886-0.016-1.647-0.063-2.347h1.197l0.046,1.476h0.063
                                      c0.342-1.01,1.165-1.647,2.082-1.647c0.155,0,0.264,0.016,0.389,0.047v1.29c-0.14-0.031-0.28-0.047-0.466-0.047
                                      c-0.963,0-1.647,0.73-1.833,1.756c-0.031,0.186-0.063,0.403-0.063,0.637v4.009h-1.352V36.146z"/>
                                <path fill="#016064" d="M17.822,37.809c0.031,1.85,1.212,2.611,2.579,2.611c0.979,0,1.569-0.171,2.083-0.389l0.233,0.979
                                      c-0.482,0.217-1.305,0.466-2.501,0.466c-2.315,0-3.698-1.523-3.698-3.792s1.336-4.056,3.527-4.056c2.455,0,3.107,2.16,3.107,3.543
                                      c0,0.28-0.031,0.497-0.046,0.637H17.822z M21.831,36.83c0.016-0.871-0.357-2.223-1.896-2.223c-1.383,0-1.989,1.274-2.098,2.223
                                      H21.831z"/>
                                <path fill="#016064" d="M29.975,40.155h-0.031c-0.404,0.746-1.243,1.336-2.455,1.336c-1.756,0-3.186-1.522-3.186-3.807
                                      c0-2.813,1.818-4.056,3.403-4.056c1.166,0,1.942,0.575,2.315,1.305h0.031l0.046-1.134h1.29c-0.031,0.637-0.047,1.29-0.047,2.066
                                      v8.531h-1.368V40.155z M29.975,36.846c0-0.187-0.015-0.404-0.062-0.575c-0.202-0.839-0.932-1.554-1.958-1.554
                                      c-1.414,0-2.269,1.196-2.269,2.89c0,1.492,0.714,2.797,2.222,2.797c0.886,0,1.647-0.544,1.958-1.492
                                      c0.062-0.187,0.108-0.451,0.108-0.653V36.846z"/>
                                <path fill="#016064" d="M39.891,39.27c0,0.777,0.016,1.46,0.063,2.051h-1.212l-0.078-1.227h-0.031
                                      c-0.357,0.606-1.15,1.398-2.486,1.398c-1.181,0-2.595-0.652-2.595-3.294V33.8h1.367v4.165c0,1.43,0.435,2.393,1.678,2.393
                                      c0.917,0,1.554-0.638,1.802-1.244c0.078-0.202,0.125-0.45,0.125-0.699V33.8h1.367V39.27z"/>
                                <path fill="#016064" d="M42.923,37.809c0.031,1.85,1.212,2.611,2.58,2.611c0.979,0,1.569-0.171,2.082-0.389l0.233,0.979
                                      c-0.482,0.217-1.306,0.466-2.502,0.466c-2.315,0-3.698-1.523-3.698-3.792s1.336-4.056,3.527-4.056c2.455,0,3.108,2.16,3.108,3.543
                                      c0,0.28-0.031,0.497-0.047,0.637H42.923z M46.932,36.83c0.015-0.871-0.357-2.223-1.896-2.223c-1.383,0-1.989,1.274-2.098,2.223
                                      H46.932z"/>
                                <path fill="#016064" d="M49.762,39.922c0.404,0.264,1.119,0.543,1.803,0.543c0.994,0,1.46-0.497,1.46-1.119
                                      c0-0.653-0.389-1.01-1.398-1.383c-1.352-0.482-1.989-1.228-1.989-2.129c0-1.212,0.979-2.207,2.595-2.207
                                      c0.761,0,1.43,0.218,1.849,0.466l-0.342,0.995c-0.295-0.186-0.839-0.435-1.539-0.435c-0.808,0-1.258,0.467-1.258,1.026
                                      c0,0.621,0.451,0.901,1.429,1.274c1.305,0.498,1.974,1.15,1.974,2.269c0,1.32-1.025,2.253-2.813,2.253
                                      c-0.824,0-1.585-0.202-2.113-0.513L49.762,39.922z"/>
                                <path fill="#016064" d="M57.75,31.64v2.16h1.958v1.041H57.75v4.056c0,0.933,0.264,1.461,1.026,1.461
                                      c0.357,0,0.622-0.046,0.792-0.093l0.062,1.025c-0.264,0.108-0.684,0.187-1.212,0.187c-0.637,0-1.15-0.202-1.476-0.575
                                      c-0.389-0.404-0.528-1.072-0.528-1.958v-4.102h-1.166V33.8h1.166v-1.802L57.75,31.64z"/>
                                <path fill="#016064" d="M22.446,50.227c0-0.777-0.016-1.414-0.063-2.036h1.212l0.078,1.243h0.031
                                      c0.373-0.714,1.243-1.414,2.486-1.414c1.041,0,2.657,0.622,2.657,3.201v4.491H27.48v-4.335c0-1.212-0.451-2.222-1.74-2.222
                                      c-0.901,0-1.601,0.637-1.833,1.399c-0.062,0.171-0.093,0.403-0.093,0.637v4.521h-1.367V50.227z"/>
                                <path fill="#016064" d="M37.878,51.89c0,2.781-1.927,3.993-3.745,3.993c-2.036,0-3.605-1.491-3.605-3.869
                                      c0-2.518,1.647-3.994,3.729-3.994C36.417,48.021,37.878,49.59,37.878,51.89z M31.911,51.967c0,1.647,0.948,2.89,2.284,2.89
                                      c1.306,0,2.284-1.228,2.284-2.921c0-1.274-0.637-2.891-2.253-2.891S31.911,50.538,31.911,51.967z"/>
                                <path fill="#016064" d="M40.04,48.191l0.994,3.823c0.218,0.838,0.42,1.616,0.56,2.393h0.046c0.171-0.761,0.42-1.569,0.668-2.377
                                      l1.228-3.838h1.15l1.166,3.76c0.28,0.901,0.497,1.694,0.668,2.455h0.047c0.124-0.761,0.326-1.554,0.575-2.439l1.072-3.776h1.352
                                      l-2.424,7.521h-1.243l-1.149-3.589c-0.265-0.839-0.482-1.585-0.668-2.471h-0.031c-0.186,0.902-0.419,1.679-0.684,2.486
                                      l-1.212,3.574H40.91l-2.269-7.521H40.04z"/>
                            </g>
                            <circle fill="#016064" cx="85.072" cy="36.565" r="4.926"/>
                            <circle fill="#016064" cx="100.998" cy="36.565" r="4.926"/>
                            <circle fill="#016064" cx="117.059" cy="36.565" r="4.926"/>
                            <circle fill="#016064" cx="132.985" cy="36.565" r="4.926"/>
                            <circle fill="#016064" cx="148.453" cy="36.565" r="4.926"/>
                            <circle fill="#016064" cx="164.379" cy="36.565" r="4.926"/>
                            <polygon fill="#016064" points="164.379,21.498 180.926,38.045 165.699,53.271 199.268,37.646 	"/>
                        </g>
                    </svg>

                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p>Don't be shy! Send a Request</p>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <?php if (Session::instance()->get('error')) { ?>
                            <div class="alert alert-danger">
                                <strong>ERROR!</strong>
                                <?php echo Session::instance()->get_once('error'); ?>
                            </div>
                        <?php } else if (Session::instance()->get('success')) { ?>
                            <div class="alert alert-success">
                                <strong>SUCCESS </strong>
                                <?php echo Session::instance()->get_once('success'); ?>
                            </div>
                        <?php } ?>

                        <div class="fieldset-inner">
                            <form class="validate-form userAutoCompleteForm" method="post" action="<?php echo url::base() . "activity/send"; ?>" role="form">

                                <div class="form-group">
                                    <label class="control-label" for="plan">What's the plan?
                                        <!-- <small class="muted dis-block">Please select one</small> -->
                                    </label>
                                    <select class="required form-control" id="plan" name="plan">
                                        <?php foreach ($plans as $plan) { ?>
                                            <option value="<?php echo $plan->name; ?>"><?php echo $plan->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <?php
                                    if (Request::current()->query('user')) {
                                        $send_user = ORM::factory('user', array('username' => Request::current()->query('user')));
                                    }
                                ?>
                                
                                <div class="form-group" style="position:relative;">
                                    <label class="control-label" for="message-email">With Whom?</label>
                                    
                                    <input type="text" name="search" id="user-autocomplete-search" class="find_user_autocomplete form-control required" placeholder="Enter Name or email address" autocomplete='off' value="<?php echo (isset($send_user) ? $send_user->user_detail->first_name." ".$send_user->user_detail->last_name  : Request::current()->post('search')); ?>" <?php if(isset($send_user)) { ?> disabled="disabled" <?php } ?>  />

                                    <span class="help-block user-autocomplete-search-error text-danger" style="margin-top:2px;">
                                        <small style="font-size:90%;" class="text-danger"><strong><?php echo session::instance()->get_once('error-email'); ?></strong></small>
                                    </span>
                                </div>
                                
                                <?php if(!empty($send_user->email)) { ?>
                                    <input type="hidden" id="user_email" name="email" value="<?php echo $send_user->email; ?>" />
                                <?php } else { ?>
                                    <input type="hidden" id="user_email" name="email" value="" />
                                <?php } ?>
                                <div class="alert alert-info post selected-user" <?php if(empty($send_user->user_detail->first_name)) { ?>style="display:none;"<?php } ?>>
                                    <?php 
                                        $selected_user_name = '';
                                        $selected_user_no_image = '';
                                        $img_src = '';
                                        $selected_user_location = '';
                                        if(!empty($send_user->email)) {
                                            $photo = $send_user->photo->profile_pic_s;
                                            $user_image_mob = file_exists("mobile/upload/" .$photo);
                                            $user_image = file_exists("upload/" .$photo);
                                            if(!empty($photo) && $user_image_mob) {
                                                $img_src = url::base()."mobile/upload/".$send_user->photo->profile_pic_s; 
                                            } else if(!empty($photo) && $user_image) {
                                                $img_src = url::base()."upload/".$send_user->photo->profile_pic_s; 
                                            }
                                            
                                            $selected_user_no_image = $send_user->user_detail->get_no_image_name();
                                            $selected_user_name = $send_user->user_detail->get_name();
                                            
                                            if(!empty($send_user->user_detail->location)) {
                                                $loc =  $send_user->user_detail->location; 
                                                $b   =  explode(', ', $loc);

                                                if(!empty($b[0]) && !empty($b[2])) {
                                                    $selected_user_location = $b[0].", ".$b[2];
                                                } else if(!empty($b[0])) {
                                                    $selected_user_location = ucwords($b[0]);
                                                } else {
                                                    $selected_user_location = ucwords($b[2]);
                                                }
                                            } else if(!empty($send_user->user_detail->home_town)) { 
                                                $selected_user_location = $send_user->user_detail->home_town;
                                            } else {
                                                $selected_user_location = 'Washington, DC, United States';
                                            }
                                        }
                                    ?>
                                    <div class="user-img pull-left">
                                        <img src="<?php echo !empty($img_src) ? $img_src : '/'; ?>" <?php if(empty($img_src)) { ?>style="display:none;max-height:49px;"<?php } else { ?>style="max-height:49px;"<?php } ?>>
                                        <div class="xs" id="inset" <?php if(!empty($img_src)) { ?>style="display:none;"<?php } ?>>
                                            <h1><?php echo $selected_user_no_image; ?></h1>
                                        </div>
                                    </div>
                                    
                                    <div class="post-content">
                                        <div class="post-title">
                                            <strong> <?php echo $selected_user_name; ?> </strong><br />
                                            <span> <?php echo $selected_user_location; ?> </span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="about">About the recipient?
                                        <!-- <small class="muted dis-block">Please select one:</small> -->
                                    </label>
                                    <select class="required form-control" id="about" name="about">
                                        <?php foreach ($abouts as $about) { ?>
                                            <option value="<?php echo $about->name; ?>"><?php echo $about->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="why">Why this person?
                                        <!-- <small class="muted dis-block">Please select one:</small> -->
                                    </label>
                                    <select class="required form-control" id="why" name="why">
                                        <?php foreach ($whies as $why) { ?>
                                            <option value="<?php echo $why->title; ?>"><?php echo $why->title; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <!-- <label class="control-label" for="message">Any message from you
                                         <small class="muted dis-block">Please write:</small>
                                     </label>-->
                                    <textarea class="required form-control" id="message" name="message" placeholder="Please write any message from you. Don't disclose your name"></textarea>
                                </div>

                                <button type="submit" class="btn btn-secondary"><span class="glyphicon glyphicon-send"></span> Send Anonymously</button>

                            </form>
                            <?php
                            //echo Session::instance()->get('plan');
                            //echo Session::instance()->get('user_email');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="result post suggestion-sample" style="display:none;">
    <div class="user-img pull-left">
        <img style="width:90%; height:90%;" src="">
        <div class="xs" id="inset" style="margin-top:0px;">                           
            <h1></h1>
        </div>
    </div>
    
    <div class="post-content">
        <div class="post-title">
            <strong></strong>
        </div>
        
        <div class="post-matter" style="margin-left:5px;">
            <span></span>, <strong></strong>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<script>
    $(document).ready(function() {
        $('.userAutoCompleteForm').submit(function() {
            if($(this).valid()) {
                var email = $('#user_email').val();

                if(email == '') {
                    var search = $('#user-autocomplete-search').val();
                    if(!isValidEmailAddress(search)) {
                        var msg = 'The email Id is not valid. Please enter a valid email address or select any registered member';
                        $('.user-autocomplete-search-error strong').html(msg);
                    } else {
                        $('#user_email').val(search);
                        return true;
                    }
                } else {
                    return true;
                }
            }

            return false;
        });

        $(".find_user_autocomplete").autocomplete({
            source: "<?php echo url::base(); ?>members/find_user_json",
            minLength: 2,
            select: function( event, ui ) {
                event.preventDefault();
                $(".find_user_autocomplete").val(ui.item.name);
                $('#user_email').val(ui.item.email);
                
                elem = $('.selected-user');
                
                elem.find('.post-title strong').html(ui.item.name);
                elem.find('.post-title span').html(ui.item.location);

                if(ui.item.image !== '') {
                    elem.find('img').attr('src', ui.item.image);
                    elem.find('img').show();
                    elem.find('.xs').hide();
                } else {
                    elem.find('img').hide();
                    elem.find('.xs h1').html(ui.item.no_image);
                    elem.find('.xs').show();
                }
                elem.show();
                
            },
            response: function(event, ui) {
                $('#user_email').val('');
                elem = $('.selected-user');
                elem.hide();
                elem.find('.post-title strong').html('');
                elem.find('.post-title span').html('');
                elem.find('.xs h1').html('');
                elem.find('.xs').hide();
                elem.find('img').attr('src', '/');
                elem.find('img').hide();
            }
        }).autocomplete( "instance" )._renderItem = function( ul, item ) {
            elem = $('.suggestion-sample').clone();
            elem.removeClass('suggestion-sample');
            elem.show();
            
            elem.find('.post-title strong').html(item.name);
            elem.find('.post-matter span').html(item.location);
            elem.find('.post-matter strong').html("Social "+item.social+" %");

            if(item.image !== '') {
                elem.find('img').attr('src', item.image);
                elem.find('.xs').remove();
            } else {
                elem.find('img').remove();
                elem.find('.xs h1').html(item.no_image);
            }

            return $( "<li>" )
                .append( elem )
                .appendTo(ul);
        };
        
    });

</script>