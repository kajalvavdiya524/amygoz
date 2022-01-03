<link rel="stylesheet" type="text/css" href="<?php echo url::base().'css/ddsmoothmenu.css';?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo url::base().'css/ddsmoothmenu-v.css';?>" />
<script type="text/javascript" src="<?php echo url::base().'js/typeahead.min.js';?>"></script>
<script type="text/javascript" src="<?php echo url::base().'js/hogan.js';?>"></script>
<script type="text/javascript" src="<?php echo url::base().'js/ddsmoothmenu.js';?>"></script>
<script type="text/javascript">

ddsmoothmenu.init({ 
    mainmenuid: "smoothmenu2", //Menu DIV id
    orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
    classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
    method: 'hover', // set to 'hover' (default) or 'toggle'
    arrowswap: true, // enable rollover effect on menu arrow images?
    //customtheme: ["#804000", "#482400"],
    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>
<script>
    (function($){
        $.fn.juizScrollTo = function(speed, v_indent){
            
            if(!speed) var speed = 'slow';
            if(!v_indent) var v_indent = 0;
            
            return this.each(function(){
                $(this).click(function(){
                    
                    var goscroll = false;
                    var the_hash = $(this).attr("href");
                    var regex = new RegExp("\#(.*)","gi");

                    if(the_hash.match("\#(.+)")) {

                        the_hash = the_hash.replace(regex,"$1");

                        if($("#"+the_hash).length>0) {
                            the_element = "#" + the_hash;
                            goscroll = true;
                        }
                        else if($("a[name=" + the_hash + "]").length>0) {
                            the_element = "a[name=" + the_hash + "]";
                            goscroll = true;
                        }
                    
                        if(goscroll) {
                            var container = 'html';
                            if ($.browser.webkit) container = 'container';
                            
                            $(container).animate({
                                scrollTop:$(the_element).offset().top + v_indent
                            }, speed, 
                                function(){$(the_element).attr('tabindex','0').focus().removeAttr('tabindex');});
                            return false;
                        }
                    }
                });
            });
        };
    })(jQuery)

    $('a:first').juizScrollTo('fast',-75).css('color', 'red');
    $('a:not(:first)').juizScrollTo('slow').css('color', '#444');
    
    $(document).ready(function() {
        
        $('#search-help').typeahead([
            {
                name: 'ques1',
                prefetch: '../js/question.json',
                template: '<a href="#{{year}}">{{value}}</a>',
                engine: Hogan
            }
        ]);
    });

</script>

<div class="container">
    <div class="<?php if(!Auth::instance()->logged_in()) { ?>static-pages-not <?php } else { ?> static-pages <?php } ?> row pos-rel"> 
        <div id="smoothmenu2" class="ddsmoothmenu-v" data-spy="affix" data-offset-top="150">
            <ul>
                <li><a href="">The Basics to Start</a>
                    <ul>
                        <li><a href="#guide1">How do I register with Callitme?</a></li>
                        <li><a href="#guide2">How do I login and logout from Callitme?</a></li>
                    </ul>
                </li>
                
                <li><a href="">Account Management</a>
                    <ul>
                        <li><a href="#guide3">How do I deactivate my account?</a></li>
                        <li><a href="#guide4">How do I reactivate my account?</a></li>
                        <li><a href="#guide5">How do I edit my profile?</a></li>
                        <li><a href="#guide6">How do I change or recover my Password?</a></li>
                        <li><a href="#guide7">How do I change my profile photo and information?</a></li>
                        <li><a href="#guide8">How do I change my username?</a></li>
                        <li><a href="#guide9">How do I change my email address?</a></li>
                        <li><a href="#guide10">How do I change my email notification preferences?</a></li>
                    </ul>
                </li>

                <li><a href="">Personal Connections</a>
                    <ul>
                      <li><a href="#guide11">How do I find people on Callitme?</a></li>
                      <li><a href="#guide12">How do I add people?</a></li>
                      <li><a href="#guide13">How do I remove people?</a></li>
                    </ul>
                </li>

                <li><a href="">Posting and Messages</a>
                    <ul>
                        <li><a href="#guide14">How do I post an update?</a></li>
                        <li><a href="#guide15">How do I delete a Post?</a></li>
                        <li><a href="#guide16">How do I send a message?</a></li>
                    </ul>
                </li>

                <li><a href="">Search</a>
                    <ul>
                        <li><a href="#guide17">How do I use search in top navigation?</a></li>
                        <li><a href="#guide18">How do I use geolocation Search?</a></li>

                    </ul>
                </li>

                <li><a href="">Privacy</a>
                    <ul>
                        <li><a href="#guide19">Can someone else sign up and use my account on my behalf?</a></li>
                        <li><a href="#guide20">Will I be searchable online through a search engine?</a></li>
                        <li><a href="#guide21">How do I close my account?</a></li>
                    </ul>
                </li>

                <li><a href="">Anonymous Requests</a>
                    <ul>
                        <li><a href="#guide33">What is Anonymous Request?</a></li>
                        <li><a href="#guide34">How does anonymous request work?</a></li>
                    </ul>
                </li>

                <li><a href="">Reviews</a>
                    <ul>
                        <li><a href="#guide35">What are Reviews?</a></li>
                        <li><a href="#guide36">How do I review someone?</a></li>
                        <li><a href="#guide37">How do I edit a review I had sent to someone?</a></li>
                        <li><a href="#guide38">I want to be reviewed. How do I request for a review?</a></li>
                    </ul>
                </li>

                <li><a href="">Match Making</a>
                    <ul>
                        <li><a href="#guide39">What is match making?</a></li>
                        <li><a href="#guide40">How do I match my connection with someone?</a></li>
                    </ul>
                </li>

                <li><a href="">Social Percentile</a>
                    <ul>
                        <li><a href="#guide41">What is social percentile?</a></li>
                    </ul>
                </li>

                <li><a href="">Photographs</a>
                    <ul>
                        <li><a href="#guide24">Why should I add my photograph to Callitme profile?</a></li>
                        <li><a href="#guide25">Is it safe to add my photos along with the profile?</a></li>
                        <li><a href="#guide26">How do I add my photo to my profile?</a></li>
                        <li><a href="#guide27">While uploading my photograph, I saw an error message that the image must be in jpg, gif, bmp or png format, what does this mean?</a></li>
                        <li><a href="#guide28">How do I remove my photo from my profile?</a></li>
                    </ul>
                </li>

                <li><a href="">Payment Options</a>
                    <ul>
                        <li><a href="#guide29">What are the different ways of payment accepted?</a></li>
                        <li><a href="#guide30">Is online credit card payment on Callitme secure?</a></li>
                        <li><a href="#guide31">How long does it take to activate my account after I register?</a></li>
                        <li><a href="#guide32">What is the refund policy?</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!--navigation ends-->

        <div class="col-md-offset-3 col-md-8 support-guide marTop20" id="">
            <!--begin Search Help-->
            <div class="support">
                <?php  $user = Auth::instance()->get_user(); 
                    if(!empty($user->user_detail->first_name)){ ?>
                        Hi <?php echo $user->user_detail->first_name;?>, how can we help you?
            <?php }else{ ?>
                Hi, how can we help you?
            <?php } ?>
           </div>

            <div class="input-group">
                <input type="text" id="search-help" class="form-control" type="text" placeholder="Type your query here">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-transparent"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>

            <!--end Search Help-->
            <hr class="soften" />
                
            <h4 class="muted">Profile Management</h4>
            <hr class="soften marBottom20" />
            <p id="guide1" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I register with Callitme?<a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>To register with Callitme:</b>
                        <ol>
                            <li>Go to <a href="<?php echo url::base();?>"> www.Callitme.com </a> and fill your information on the registration form.</li>
                            <li>Enter your first name, last name, email address, password, gender, birthday and phase of life.</li>
                            <li>Click Join Now button.</li>
                            <li>You will get a message to check your email to activate your account.</li>
                            <li>Check the email you used to register for Callitme and click on the Activation Link.</li>
                            <li>Once you click on the link, the account will be activated.</li>
                            <li>You will be redirected to member home.</li>
                        </ol>
                        
                        <b>Tips for picking a username:</b>
                        <ul>
                            <li>Your username is unique to you.  If you provide your username to anyone, they can search you by username.</li>
                            <li>Please note: You can change your username in your account settings at any time, as long as the new username is not already in use.</li>
                            <li>Usernames must be fewer than 15 characters in length and cannot contain "admin" or "Callitme",in order to avoid brand confusion.</li>
                        </ul>
                        
                        <b>Important information about your email address:</b>
                        <ul>
                            <li>An email address can only be associated with one account at a time.</li>
                            <li>The email address you use on your account is not publicly visible to others on Callitme.</li>
                            <li>We use the email you enter to confirm your new account. Be sure to enter an email address that you actively use and have access to. Check your inbox for a confirmation email to make sure you signed up for your account correctly.</li>
                        </ul>
                    </div>
                </fieldset>
            </div>
                
            <p id="guide2" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I login and logout from Callitme?<a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>
                            The login option is found at the very top of the Callitme website at www.Callitme.com . To Log Out, simply click on the 'Logout' link in dropdown menu on the top right of your screen.
                        </p>
                    </div>
                </fieldset>
            </div>
                
            <p id="guide3" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I deactivate my account?<a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>
                            Deactivation puts your account in a queue for permanent deletion from Callitme. To deactivate your account:
                        </p>
                        <ul>
                            <li>Login to your Callitme account. </li>
                            <li>Go to your account settings and click on Deactivate button at the bottom of the page.</li>
                        </ul>
                        
                        <p>
                            <b>Before you deactivate your account, you should know:</b>
                        </p>
                        <ul>
                            <li>You may reactivate your account at any time with in 30 days from the date of deactivation by logging in. Once 30 days have passed, you will need to contact our support team to reactivate your account</li>
                            <li>You do not need to deactivate your account to change your username or email address; you can change it at any time in your account settings.</li>
                            <li>To use a username or email address on another account, you must first change them and then confirm the change prior to deactivation.</li>
                            <li>After deactivation, your account will be removed within a few minutes, however some content or old links may be viewable on Callitme for a few days.</li>
                        </ul>
                    </div>
                </fieldset>
            </div>
                
            <p id="guide4" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I reactivate my account?<a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>
                            Accounts cannot be reactivated after 30 days from the date they were deactivated. After that you need to contact our support team to reactivate your account. If it has been less than 30 days, follow the steps below to reactivate your account.
                        </p>
                        
                        <ul>
                            <li>Visit <a href="<?php echo url::base()?>"> Callitme</a> login page.</a></li>
                            <li>Enter your email address and your password.</li>
                            <li>Once you click Sign in, your account is reactivated.</li>
                        </ul>
                        
                        <p>
                            <b>If it is past 30 days from the date of deactivation you can ask a support agent to help you reactivate your account by filing a support request <a href="<?php echo url::base()."company/support"?>">Here</a>.</b>
                        </p>
                    </div>
                </fieldset>
            </div>
                
            <p id="guide5" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I edit my profile?<a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>Please follow the following steps to edit your profile:</b>
                        <ul>
                            <li>Login to your Account. </li>
                            <li>Click on the drop down menu on the right side of the header where you see your first name.</li>
                            <li>Click on Edit Profile.</li>
                            <li>Edit your personal profile according to the instructions provided and click the 'Save Changes' button</li>
                        </ul>
                    </div>
                </fieldset>
            </div>
                
            <p id="guide6" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I Change or Recover my Password? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>How to change your password while you're logged in:</b>
                        <ol>
                            <li>From your logged in account, click on the Home drop down on the upper right hand corner of your screen and select Edit Profile.</li>
                            <li>Click on the Change Password on the left of the screen.</li>
                            <li>Enter your current password.</li>
                            <li>Choose your new password.</li>
                            <li>Save your changes by clicking Save changes.</li>
                        </ol>
                        
                        <p>
                            <b>Note:</b>
                            If you're able to log in but can't remember your password, you can send yourself a password reminder from the reset password  page.
                        </p>
                        <b>How do I  send myself a password reset via email:</b>
                        <ol>
                            <li>From the sign in page select the Forgot password? link or <a href="<?php echo url::base()."forgot_password"?>">click here</a>. </li>
                            <li>Enter your email address.</li>
                            <li>Check your email inbox.</li>
                            <li>Click the reset link in that email.</li>
                            <li>Choose a new password that you haven't used before.</li>
                        </ol>
                        <b>Still need help? <a href="<?php echo url::base().'company/about';?>">Contact Support</a>.</b>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide7" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I change my profile photo and information? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <ul>
                            <li>You can edit your profile photo or information from Edit Profile link. </li>
                            <li>Click on the Edit profile link from the drop down menu after you log in.</li>
                        </ul>
                        
                        <b>To change or remove your profile photo:</b>
                        <ol>
                            <li>Sign in to your account.</li>
                            <li>From your logged in account, click on the Edit Profile from drop down menu on the upper right hand corner of your screen.</li>
                            <li>Click on the Change Picture link on the left of the screen.</li>
                            <li>Click the Browse button to locate the picture.</li>
                            <li>After selecting the file, click Open.</li>
                            <li>You will see a notification that your image has been successfully published to your profile.</li>
                        </ol>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide8" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I change my Username? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>Follow these steps to change your username:</b>
                        <ol>
                            <li>Log in to Callitme and Edit Profile from the dropdown menu in the top right corner.</li>
                            <li>You will see change username link.</li>
                            <li>If the username is taken, you will be prompted to choose another one</li>
                            <li>Click Update at the bottom of the page.</li>
                        </ol>
                        
                        <p>
                            <b>NOTE:</b> Changing your username will not affect your messages your profile in general. People who are interested in you will simply see a new username next to your profile photo when you update.
                        </p>
                        
                        <b>What is the difference between my username and my real name?</b>
                        <ul>
                            <li>Your username appears in your profile URL and is unique to you. </li>
                            <li>Your name is your real name displayed in your profile page and used to identify you to friends, especially if your username is something different. Change your real name in your profile settings tab.</li>
                        </ul>
                        
                        <b>How long can real names and usernames be?</b>
                        <ul>
                            <li>Your username can contain up to 15 characters. </li>
                            <li>Your real name can be 20 characters long. </li>
                        </ul>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide9" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I change my email address? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>Follow these steps to change your email address::</b>
                        <ol>
                            <li>Log in to account and visit your account settings page from the dropdown menu in the top right corner.</li>
                            <li>Under account settings, type your new email address into the Email field. Note: An email address can only be associated with one account at a time.</li>
                            <li>Click Update at the bottom of the page.</li>
                            <li>You will see a yellow reminder message on your homepage asking you to confirm your email change. It will stay there until you confirm your new email address (see steps to confirm below).</li>
                        </ol>
                        
                        <p>
                            Your email address is not displayed in your public profile on Callitme.
                        </p>
                        
                        <b>To confirm your email address change (required):</b>
                        <ol>
                            <li>Log in to the email for the address you just updated. </li>
                            <li>You should see a new email from Callitme.com. Open it.</li>
                            <li>Click on the confirmation link in that email. </li>
                            <li>You should then be directed to your Callitme account. Your change is now complete! </li>
                            <li>You will also receive an email notification at your old email address - no action is needed and this is not a confirmation of the email address change, just an alert.</li>
                        </ol>
                        
                        <p class="text-warning">
                            <b>Warning:</b> If you do not complete the confirmation process above, your email will not be changed. Callitme uses your email address to let you know about changes to your account. It is important you know what email address is associated with your account at all times. </p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide10" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I change my email notification preferences? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>To change your email preferences:</b>
                        <ol>
                            <li>Log in to Callitme.</li>
                            <li>Click on the drop down on the upper right hand corner of your screen</li>
                            <li>Click on edit Profile link in the drop down.</li>
                            <li>Click on "Email Notification". </li>
                            <li>Select the check boxes for which you want to receive email notifications.</li>
                        </ol>
                        
                        
                        <p><b>NOTE:</b> Symbol showing along with 'Email Notification' tells the current status of your email notification.</p>
                    </div>
                </fieldset>
            </div>
            
            <hr class="soften" />
            <h4 class="muted">Finding and adding contacts</h4>
            <hr class="soften marBottom20" />
            <p id="guide11" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I find people? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>How to find people by name:</b>
                        <ul>
                            <li>Type the person's name into the search box at the top of your homepage.</li>
                        </ul>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide12" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I add people? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>How do I add members to my contacts list?</b>
                        <ol>
                            <li>Click on a name or profile image of a user or navigate to a user's profile.</li>
                            <li>Click the Add Friend button when you see on a user's profile page</li>
                        </ol>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide13" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I a remove a member from my contacts list? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>Why would I want to remove someone?</b>
                        <ul>
                            <li>You add a contact when you know the contact or willing to know the contact. If you no longer want to remain connected, it means you won't see their posts in your homepage when you log in. You can still view them on an as-needed basis by visiting their Profile.</li>
                        </ul>
                        <b>To cancel connection request:</b>
                        <ol>
                            <li>Click on your friends list.</li>
                            <li>Click the remove button.</li>
                        </ol>
                    </div>
                </fieldset>
            </div>
            
            <hr class="soften" />
            <h4 class="muted">Postings and messages</h4>
            <hr class="soften marBottom20" />
            <p id="guide14" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I post an update? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>To post an update:</b>
                        <ol>
                            <li>Sign in to your Callitme account.</li>
                            <li>Type your update in the box "Add New Post" box and click on post. </li>
                        </ol>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide15" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I delete a post?  <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <ol>
                            <li>Hover over the post that you want to delete. </li>
                            <li>Click red trash icon on the right of your post. </li>
                            <li>The message will be deleted immediately. </li>
                        </ol>
                        
                        <p>
                            <b>NOTE: </b> you can only delete posts which you posted yourself. You cannot delete posts which were posted by other members. Instead, you can remove the member from your contacts list whose posts you do not want to see.</p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide16" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I message a member?  <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>To send a direct message via the web:</b>
                        <ol>
                            <li>Search the member you want to send message to. </li>
                            <li>Click on the message button where you can type your message. </li>
                            <li>Enter your message and click Send.</li>
                        </ol> 
                    </div>
                </fieldset>
            </div>
            
            <hr class="soften" />
            <h4 class="muted">Search</h4>
            <hr class="soften marBottom20" />
            <p id="guide17" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I use search in top navigation?  <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <ol>
                            <li>Start typing the First name or Last Name of the user you want to find.</li>
                            <li>Choose right user In the suggestions below </li>
                            <li>Click on Search and you will be redirected to that user's profile.</li>
                        </ol>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide18" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I Use Advanced Member Search? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>Can't find exactly what you're looking for in search?:</b> 
                        <p>
                            You may want to use advanced search where you can enter parameters of your choice to help you narrow down your choices.
                        </p>
                    </div>
                </fieldset>
            </div>
            
            <hr class="soften" />
            <h4 class="muted">Privacy</h4>
            <hr class="soften marBottom20" />
            <p id="guide19" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">Can someone else sign up and use my account on my behalf? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p> 
                            No. Your can create account only for yourself. 
                        </p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide20" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">Will I be searchable online through search engine? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p> 
                            No. We will show your full name only to registered users of Callitme, and your profile will not be discoverable through search engines by searching your full name.
                        </p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide21" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I close my account? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>You can close your account by following these steps.</p>
                        <ol>
                            <li>Move your cursor over Settings.</li>
                            <li>Click the Accounts tab toward the bottom of the page and select Close your account.</li>
                        </ol>
                    </div>
                </fieldset>
            </div>
            
              
            <hr class="soften" />
            <h4 class="muted">Photographs</h4>
            <hr class="soften marBottom20" />
            <p id="guide24" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">Why should I add my photograph to my profile?<a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p> 
                            Statistics show that adding a photo to your profile increases the number of times your profile is viewed.
                        </p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide25" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">Is it safe to add my photos along with the profile? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p> 
                            Yes, it is absolutely safe to add photos to your profile. 
                        </p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide26" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I add my photo to my profile? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <b>To add your photo to your profile please follow these steps.</b>
                        <ol>
                            <li>Click on your profile link and then click on Photos. </li>
                            <li>Hover on the profile photo box, a blue arrow box will appear.</li>
                            <li>Click on the arrow box</li>
                            <li>Choose image and the image will be uploaded</li>
                        </ol>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide27" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">While uploading my photograph, I saw an error message that the image must be in jpg, gif, bmp or png format, what does this mean? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p> jpg, gif, bmp, and png are the most popular digital image formats on the internet. Callitme accepts only these image formats for photos on your profile.
                        </p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide28" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I replace my photo from my profile on Callitme? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20"></div>
                    <p>Click on edit profile and you will see an option to change your photo.</p>
                </fieldset>
                
            </div>
            
            
            <hr class="soften" />
            <h4 class="muted">Payment options</h4>
            <hr class="soften marBottom20" />
            <p id="guide29" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">What are the different methods of payment? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>We accept all leading credit/debit cards.</p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide30" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">Is online Credit Card payment on Callitme website secure? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>
                            Yes. Your credit card information is entered on a Secure Server using SSL Technology and 128 Bit Encryption which is one of the highest level of security provided by websites. The information is transmitted in an encrypted fashion to our payment gateway and your card is charged online. Finally, to provide the highest level of security, we do not store your credit card information on our online server at any time.
                        </p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide31" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How long does it take to activate my plan after I place an order for upgrade? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p> If the payment is successful your plan will be activated immediately. </p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide32" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">What is the refund policy? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>
                            Since Callitme members pay on a monthly basis, we generally do not refund membership fees. Any exceptions to this policy will be made at the sole discretion of Callitme. 
                        </p>
                    </div>
                </fieldset>
            </div>
            
            <hr class="soften" />
            <h4 class="muted">Anonymous Requests</h4>
            <hr class="soften marBottom20" />
            <p id="guide33" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">What is Anonymous Request? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>If you have a crush on a girl or a guy, you can invite him or her for an activity such a biking, group study or to have a cup of coffee. The interesting part is that your crush would not know that you are the one who sent the invitation.  Your crush will only know that you were the one who sent the request only if your crush chooses you.  If your crush chooses you, it means that you and your crush both wanted to join for the activity but couldn't really ask for it.  If your crush doesn't choose you, the crush would never find out that you sent a request anonymously. Very safe game, right? </p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide34" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How does anonymous request work? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>
                        <ol>
                            <li>Select the Callitme member or enter the email address of your crush</li>
                            <li>Select the activity of interest</li>
                            <li>Click send</li>
                        </ol>
                        </p>
                    </div>
                </fieldset>
            </div>
            
            <hr class="soften" />
            <h4 class="muted">Reviews</h4>
            <hr class="soften marBottom20" />
            <p id="guide35" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">What are Reviews? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>You have reviewed products, services, businesses and few other things. Callitme reviews are personal reviews where you review a person you know. Tell the good and bad things and share!</p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide36" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I review someone? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>
                        <ol>
                            <li>Click on Review</li>
                            <li>Select the Callitme member or email address</li>
                            <li>Write anything you want--just be fair:)</li>
                            <li>Click Send</li>
                        </ol>
                    </p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide37" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I edit a review I had sent to someone? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>Go to your profile. Click on Reviews. Click on Reviews Sent. Edit the review you want to.</p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide38" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">I want to be reviewed. How do I request someone to review me? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>Go to your profile. Click on Reviews. Click on Ask for Review. Select the Callitme member or enter the email address and click send.</p>
                    </div>
                </fieldset>
            </div>
            
            <hr class="soften" />
            <h4 class="muted">Match Making</h4>
            <hr class="soften marBottom20" />
            <p id="guide39" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">What is match making? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>If you know two eligible singles and want to hook them up, you can match them.</p>
                    </div>
                </fieldset>
            </div>
            
            <p id="guide40" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">How do I match my connection with someone? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>If you have single connections, you will see an option to match them. Select the two people you want to match and hit send. </p>
                    </div>
                </fieldset>
            </div>
            
            <hr class="soften" />
            <h4 class="muted">Social Percentile</h4>
            <hr class="soften marBottom20" />
            <p id="guide41" class="anchor"></p>
            <div>
                <fieldset class="fieldset">
                    <legend class="marTop20">What is social percentile? <a href="#top" class="muted pull-right"><small>top</small></a></legend>
                    <div class="marLeft20">
                        <p>Social percentile is your overall personality rated by your family, friends and relatives. It's a number that represents a story about you told by people you know.</p>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>