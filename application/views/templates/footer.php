        <div class="footer">
            <div class="container"> 
              <span>
           <a href="#" id="totop"><i class="icon-up-open"></i>
             <span>
           <i class="qodef-icon-font-awesome fa-lg fa fa-chevron-up "></i></span>
           </a>
             </span> 
                <div class="visible-xs">
                    <div class="col-xs-12">
                        <select class="form-control select-menu input-block-level"  
                                onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                            
                            <option value="<?php echo url::base()."register"?>">Register</option>
                            <option value="<?php echo url::base()."login"?>">Log In</option>
                            <option value="<?php echo url::base()."import"?>">Find Connections</option>
                            <option value="<?php echo url::base()."directory/people"?>">People Directory</option>
                            <option value="<?php echo url::base()."directory/public-personality"?>">Public Directory</option>
                            <option value="<?php echo url::base()."company/about"?>">About</option>
                            <option value="<?php echo url::base()."careers"?>">Careers</option>
                            <option value="<?php echo url::base()."activity"?>">Pricing</option>
                            <option value="<?php echo url::base()."pages/"?>">Advertising</option>
                            <option value="<?php echo url::base()."company/support"?>">Help & Support</option>
                            <option value="<?php echo url::base()."company/terms"?>">Terms</option>
                            <option value="<?php echo url::base()."blog"?>" > Blog </option>
                            <option value="<?php echo url::base()."company/privacypolicy"?>"> Privacy</option>
                            <option value="<?php echo url::base()."activity"?>"> Callitme Activities</option> 
                            <option value="">Social Dating</option>
                            <option value="">MatchMaking</option>
                            <option value="<?php echo url::base()."localpeople"?>">Local People </option>

                               
                            
                        </select>
                    </div>
                </div>  
                <div class="row-fluid hidden-xs">
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="footer-links">
                                    <li><a href="<?php echo url::base()."import"?>">Find Connections</a></li>
                                    <li><a href="<?php echo url::base()."directory/people"?>">People Directory</a></li>
                                    <li><a href="<?php echo url::base()."directory/public-personality"?>">Public Directory</a></li>                                            
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="footer-links">
                                    <li><a href="<?php echo url::base()."careers"?>">Careers</a></li>
                                    <li><a href="<?php echo url::base()."pages/pricing"?>">Pricing</a></li>
                                    <li><a href="<?php echo  url::base()."match" ?>">Match Making</a></li>   
                                    <!--<li><a href="#">Advertising</a></li>        --> 
                                </ul>
                            </div> 
                        </div>                                      
                    </div>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="footer-links">
                                    <li><a href="<?php echo url::base()."company/about"?>">About</a></li> 
                                    <li><a href="<?php echo url::base()."company/support"?>">Help & Support</a></li>
                                    <li><a href="<?php echo url::base()."company/terms"?>">Terms</a></li>   
                                    <!--<li><a href="">Social Dating</a></li>       -->         
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="footer-links">
                                    <li><a href="https://www.callitme.com/blog/" target="_blank">Blog</a></li>
                                    <li><a href="<?php echo url::base()."company/privacypolicy"?>">Privacy</a></li>
                                                        
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="footer-links">
                                    <li><a href="<?php echo url::base()."activity"?>">Activities</a></li>
                                    <li><a href="<?php echo url::base()."localpeople"?>">Local People</a></li>                      
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="bottom-footer row-fluid">
                    <div class="col-sm-6">
                        <ul class="social-links">
                            <li><a href="https://www.facebook.com/Callitme" target="_blank"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="https://www.twitter.com/Callitmedotcom" target="_blank"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="https://www.google.com/+Callitme" target="_blank"><span class="fa fa-google-plus"></span></a></li>
                            <li><a href="http://www.linkedin.com/company/Callitme" target="_blank"><span class="fa fa-linkedin"></span></a></li>
                            <!--<li><a href="https://angel.co/Callitme" target="_blank"><span class="fa fa-angellist"></span></a></li>-->
                        </ul>
                    </div>
                    <div class="clearfix visible-xs"></div>
                    <div class="col-sm-6">
                        <p class="copy"> © Callitme <?php echo date('Y'); ?>. All rights reserved.<br />System for Anonymous Messaging, Reviewing, Quantifying, Matching and Searching protected by US Patent.</p>    
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
    var windowScroll_t;
    jQuery(window).scroll(function(){
        clearTimeout(windowScroll_t);
        windowScroll_t = setTimeout(function(){
            if(jQuery(this).scrollTop() > 100){
                jQuery('#totop').fadeIn();
            }else{
                jQuery('#totop').fadeOut();
            }
        }, 500);
    });
    jQuery('#totop').click(function(){
        jQuery('html, body').animate({scrollTop: 0}, 600);
        return false;
    });
    jQuery(function($){
        $(".cms-index-index .footer-container.fixed-position .footer-top,.cms-index-index .footer-container.fixed-position .footer-middle").remove();
    });
</script>    