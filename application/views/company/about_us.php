<div class="container">
    <div class="<?php if(!Auth::instance()->logged_in()) { ?>static-pages-not <?php } else { ?> static-pages <?php } ?> row">
        <div class="tabbable tabs-left">
            <!--begin tabs-->
            <ul class="nav nav-pills col-md-8 marTop20" style="padding-right:0px;">
                <li <?php if(!Request::current()->query('page')) { ?> class="active" <?php } ?>>
                    <a href="#lA" data-toggle="tab">About Callitme</a>
                </li>
                <li <?php if(Request::current()->query('page') == 'contact') { ?> class="active" <?php } ?>>
                    <a href="#lB" data-toggle="tab">Contact Us</a>
                </li>
                <!--<li>
                    <a href="#lC" data-toggle="tab">Press</a>
                </li>
                <li>
                    <a href="#lD" data-toggle="tab">Team</a>
                </li>-->
                <li>
                    <a href="#lE" data-toggle="tab">Find a Flaw</a>
                </li>
                <li>
                    <a href="<?php echo url::base()."pages/support"?>">Support</a>
                </li>
            </ul>
            <!--end tabs-->
            
            
            <!--begin Callitme About-->
            <div class="tab-content col-md-8 marTop20">
                <!--begin Callitme About details-->
                <div class="tab-pane <?php if(!Request::current()->query('page')) { ?> active <?php } ?>" id="lA">
                    <h3 style="color: #FF2A7F;">Callitme is a crowd powered people review network.</h3>
                    <hr>
                    <h3>Callitme started as a class project at Harvard where the initial idea was to match two friends who were too shy to express their feelings. Today, with added features, Callitme has become your hub for people review, match making and social dating. </h3>
                    
                </div>
 
                <!--end Callitme About details-->
                <!--begin contact form-->
                <div class="tab-pane <?php if(Request::current()->query('page') == 'contact') { ?> active <?php } ?>" id="lB">
                    <h3>Contact Us</h3>
                    <form role="form" class="contact-form col-md-11 validate-form" method="post" action="<?php echo url::base().'pages/contact_us'?>">
                        <fieldset>
                            <legend class="marTop20">Submit your Query</legend>

                            <div class="alert alert-danger" style="display:none;">
                                <span><b>Please correct the error in the form.</b></span>
                            </div>

                            <div class="alert alert-success" style="display:none;">
                                <span><b>Thanks for contacting us! We will get back to you shortly.</b></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="first_name">First Name</label>
                                <input type="text" class="required form-control" id="first_name" name="first_name" placeholder="First Name">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="last_name">Last Name</label>
                                <input type="text" class="required form-control" id="last_name" name="last_name" placeholder="Last Name">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="email">Email address</label>
                                <input type="email" class="required email form-control"  name="email" id="email" placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="issue">Issue Type:</label>
                                <select id="issue" name="issue" class="form-control required">
                                    <option value="">Select One:</option>
                                        <?php foreach(Kohana::$config->load('profile')->get('issues') as $key => $value) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="subject">Subject:</label>
                                <input type="text" class="required form-control" id="subject" name="subject" placeholder="Subject">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="message">Message:</label>
                                <textarea class="required form-control" id="message" name="message" placeholder="Message"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="message">Answer:</label>
                                    <?php $first = rand(1, 20);
                                        $second = rand(1, 20);
                                        $total = ($first+$second);
                                    ?>

                                <input type="hidden" value="<?php echo $total;?>" name="total" id="total">
                                <?php echo "( ".$first." + ".$second." ) = "; ?>

                                <input type="text" class="form-control required digits" name="answer">
                            </div>

                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </fieldset>
                    </form>
                </div>
                <!--end contact form-->
                
                <!--begin press form
                <div class="tab-pane" id="lC">
                    <h3>Press Inquires</h3>
                    <p>
                        To contact our media team, please send an email to <br/> press[@]Callitme[dot]com
                    </p>
                    <p>
                        For all non-press inquiries, please visit out Support Page.
                    </p>
                </div>
                end press form--> 

                <!--begin Callitme Team
                <div class="tab-pane" id="lD">
                    <h4>Team</h4>
                    <p>
                    	<a href="https://www.Callitme.com/ash" target="_blank"> Ash Shrivastav </a>
                    </p>
                    <p>
                        <a href="https://www.Callitme.com/ritipatel" target="_blank"> Riti Patel </a>
                    </p>
                </div> -->
                             
                <!--begin find a flaw-->    

               <div class="tab-pane <?php if(Request::current()->query('page') == 'flaw') { ?> active <?php } ?>" id="">
                    <h3>Find a flaw</h3>
                    <form role="form" class="contact-form col-md-11 validate-form" method="post" action="<?php echo url::base().'pages/contact_us'?>">
                        <fieldset>
                            <legend class="marTop20">Submit your Query</legend>

                            <div class="alert alert-danger" style="display:none;">
                                <span><b>Please correct the error in the form.</b></span>
                            </div>

                            <div class="alert alert-success" style="display:none;">
                                <span><b>Thanks for contacting us! We will get back to you shortly.</b></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="first_name">First Name</label>
                                <input type="text" class="required form-control" id="first_name" name="first_name" placeholder="First Name">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="last_name">Last Name</label>
                                <input type="text" class="required form-control" id="last_name" name="last_name" placeholder="Last Name">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="email">Email address</label>
                                <input type="email" class="required email form-control"  name="email" id="email" placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="issue">Issue Type:</label>
                                <select id="issue" name="issue" class="form-control required">
                                    <option value="">Select One:</option>
                                        <?php foreach(Kohana::$config->load('profile')->get('issues') as $key => $value) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="subject">Subject:</label>
                                <input type="text" class="required form-control" id="subject" name="subject" placeholder="Subject">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="message">Message:</label>
                                <textarea class="required form-control" id="message" name="message" placeholder="Message"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="message">Answer:</label>
                                    <?php $first = rand(1, 20);
                                        $second = rand(1, 20);
                                        $total = ($first+$second);
                                    ?>

                                <input type="hidden" value="<?php echo $total;?>" name="total" id="total">
                                <?php echo "( ".$first." + ".$second." ) = "; ?>

                                <input type="text" class="form-control required digits" name="answer">
                            </div>

                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </fieldset>
                    </form>
                </div>

                <div class="tab-pane" id="lE">                    
                    <h3>Find a flaw</h3>                    
                    <div class="flaw-content">                        
                        <p>                            
                            You gotta be creative here! Find something that is wrong or something that you don't like about this website. Please be specific in your report.                        
                        </p>                        
                        <p class="textCenter">                            
                            <a href="<?php echo url::base()."company/about?page=flaw"; ?>" class="btn btn-large btn-primary">Report</a>                        
                        </p>                    
                    </div>                    
                    <img class="flaw-img" src="<?php echo url::base().'img/flaw.png';?>" />                
                </div>                
                <!--end find a flaw-->  
  
            </div>        
        </div>    
    </div>
</div>