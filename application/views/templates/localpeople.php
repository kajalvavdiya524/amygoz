<!DOCTYPE html>
<html lang="en">

    <head>
        <title><?php echo $title; ?></title>

        <?php $version = Kohana::$config->load('profile')->get('version');?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="People Review, Online Trust, Trusted Network, Social Dating, Match Singles, Match Friends, Review, Review Friends, Find Singles, Anonymous Requests, Crush Love" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow/">

        <meta property="og:description" name="description" content="<?php echo $description; ?>">
        <meta property="og:image" content="<?php echo url::base(); ?>img/scraper_img.png"/>
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:url" content="<?php echo Request::current()->url(); ?>" />
        <meta property="og:site_name" content="Callitme">

        <!--begin twitter-->
        <meta name="twitter:site" content="@Callitme">
        <meta name="twitter:url" content="<?php echo Request::current()->url(); ?>">
        <meta name="twitter:title" content="<?php echo $title; ?>">
        <meta name="twitter:description" content="<?php echo $description; ?>">
        <meta name="twitter:image" content="<?php echo url::base(); ?>img/scraper_img.png">

        <link href="<?php echo url::base();?>css/bootstrap.css?v=<?php echo $version; ?>" rel="stylesheet" >
        
        <?php if(Request::current()->controller() == 'profile') { ?>
            <link href="<?php echo url::base();?>css/imgareaselect-default.css?v=<?php echo $version; ?>" rel="stylesheet" >
        <?php } ?>
        
        <link href="<?php echo url::base();?>css/style.css?v=<?php echo $version; ?>" rel="stylesheet" >
        <link href="<?php echo url::base();?>assets/css/header.css?v=<?php echo $version; ?>" rel="stylesheet">
        <link href="<?php echo url::base();?>assets/css/footer.css?v=<?php echo $version; ?>" rel="stylesheet">
        <link href="<?php echo url::base();?>css/space.css?v=<?php echo $version; ?>" rel="stylesheet">
        
        <link href="<?php echo url::base();?>css/jquery.custom-scrollbar.css?v=<?php echo $version; ?>" rel="stylesheet" >
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
        
        <script src="<?php echo url::base();?>js/jquery-1.10.2.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src='<?php echo url::base();?>js/jquery.knob.js'></script>
        
        <script src="http://lipis.github.io/bootstrap-sweetalert/lib/sweet-alert.js"></script>
        <link rel="stylesheet" href="http://lipis.github.io/bootstrap-sweetalert/lib/sweet-alert.css">
        
        <?php if(Request::current()->controller() == 'profile') { ?>
            <script src="<?php echo url::base();?>js/jquery.imgareaselect.pack.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <?php } ?>
    </head>
    
    <body>
        <?php $session_user = Auth::instance()->get_user(); ?>
        <?php echo $header; ?>
        
        <div class="content marTop20">
            <input type="hidden" value="<?php echo url::base();?>" id="base_url" />
            <div class="container" style="position:relative;">
                <div class="row">
                    <?php if(isset($session_user->id) && $session_user->is_active == 0) { ?>
                        <div class="alert alert-warning" style="margin-bottom:0px;">
                            <span class="not-active-warning">
                                <?php echo $session_user->user_detail->first_name; ?>, go to <?php echo $session_user->email; ?> to complete the sign-up process.
                            </span>

                            <?php if(Session::instance()->get_once('resend_success')) { ?>
                                <span class="label label-success">Success</span>
                            <?php } ?>

                            <form class="dis-inline" action="<?php echo url::base()."pages/resend_link"; ?>" method="post">
                                <input type="hidden" name="email" value="<?php echo $session_user->email; ?>" />
                                <button type="submit" class="pull-right btn btn-secondary">Resend Activation Link</button>
                            </form>

                           <div class="clearfix"></div>
                        </div>
                    <?php } ?>

                   
                    <div class="main-content <?php if(Request::current()->controller() == 'peoplereview' && Request::current()->action() == 'compose') { ?> recommend-compose-main <?php } ?> col-sm-12">
                        <?php if(Session::instance()->get('main_error')) {?>
                            <div class="alert alert-danger">
                               <strong>ERROR!</strong>
                               <?php echo Session::instance()->get_once('main_error');?>
                            </div>
                        <?php } else if(Session::instance()->get('main_success')) {?>
                            <div class="alert alert-success">
                               <strong>SUCCESS </strong>
                               <?php echo Session::instance()->get_once('main_success');?>
                            </div>
                        <?php } ?>

                        <!--
                        if your friends have matched you, following notification will pop up
                        -->

                        <?php
                            if(isset($session_user->id)) {
                                $match_exists = ORM::factory('match')
                                    ->where('with', '=', $session_user->id)
                                    ->where('with_agree', '=', 0)
                                    ->find();
                            if ($match_exists->id) {
                                ?>
                                <div class="alert alert-info text-center">
                                    <input type="hidden" value="<?php echo $match_exists->id; ?>" class="match_id" />

                                    <h4 class="dis-inline marRight20"><?php echo $match_exists->match_by->user_detail->first_name; ?> 
                                        thinks <a href="<?php echo url::base().$match_exists->match_to->username; ?>"><?php echo $match_exists->match_to->user_detail->first_name; ?></a> is a good match for you. What do you think?
                                    </h4>

                                    <button class="accept-match btn btn-secondary marRight20">
                                        <small class="dis-block">I'm interested in <?php echo $match_exists->match_to->user_detail->first_name; ?></small>
                                        Accept Match
                                    </button>

                                    <button class="reject-match btn btn-primary">
                                        <small class="dis-block">Not interested in <?php echo $match_exists->match_to->user_detail->first_name; ?></small>
                                        Reject Match
                                    </button>
                                </div>
                            <?php } ?>

                            <?php
                            $match_conf = ORM::factory('match')
                                    ->where('match_user', '=', $session_user->id)
                                    ->where('with_agree', '=', 1)
                                    ->where('user_agree', '=', 0)
                                    ->find();
                            if ($match_conf->id) {
                                ?>
                                <div class="alert alert-info text-center">
                                    <input type="hidden" value="<?php echo $match_conf->id; ?>" class="match_id" />

                                    <h4 class="in-block marRight20"><?php echo $match_conf->match_by->user_detail->first_name; ?> 
                                        thinks <a href="<?php echo url::base().$match_conf->match_with->username; ?>"><?php echo $match_conf->match_with->user_detail->first_name; ?></a> is a good match for you. <a href="<?php echo url::base().$match_conf->match_with->username; ?>"><?php echo $match_conf->match_with->user_detail->first_name; ?></a> 
                                        agrees with <?php echo $match_conf->match_by->user_detail->first_name; ?>. What do you think?
                                    </h4>

                                    <button class="accept-match btn btn-secondary marRight20">
                                        <small class="dis-block">I'm interstested in <?php echo $match_conf->match_with->user_detail->first_name; ?></small>
                                        Accept Match
                                    </button>

                                    <button class="reject-match btn btn-primary">
                                        <small class="dis-block">Not interested in <?php echo $match_conf->match_with->user_detail->first_name; ?></small>
                                        Reject Match
                                    </button>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <?php echo $content;?>

                        <div class="ribbion-modal modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <img src="<?php echo url::base(); ?>img/close.png" />
                                        </button>
                                        <div class="ribbion">
                                            <h2 class="modal-title">View Post</h2>
                                        </div>
                                        <div class="triangle-l"></div>

                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="modal-body">

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                                    </div>

                                </div><!-- /.modal-content -->

                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    <div style="clear:both"></div>
                </div>
            </div>

        </div>
        <section>
 <div class="footer">
            <div class="container">  
                <div class="visible-xs">
                    <div class="col-xs-12">
                        <select class="form-control select-menu input-block-level">
                            
                            <option value="">Register</option>
                            <option value="">Log In</option>
                            <option value="">Find Connections</option>
                            <option value="">People Directory</option>
                            <option value="">About</option>
                            <option value="">Careers</option>
                            <option value="">Pricing</option>
                            <option value="">Advertising</option>
                            <option value="">Help & Support</option>
                            <option value="">Terms</option>
                            <option value="">Blog</option>
                            <option value="">Privacy</option>
                            <option value="">Callitme Activities</option> 
                            <option value="">Social Dating</option>
                            <option value="">MatchMaking</option>
                            <option value="">Local People </option>

                               
                            
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
                                    <li><a href="<?php echo url::base()."company/about"?>">About</a></li>                                            
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="footer-links">
                                    <li><a href="<?php echo url::base()."careers"?>">Careers</a></li>
                                    <li><a href="<?php echo url::base()."pages/pricing"?>">Pricing</a></li>
                                    <li><a href="#">Advertising</a></li>            
                                </ul>
                            </div> 
                        </div>                                      
                    </div>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="footer-links">
                                    <li><a href="<?php echo url::base()."pages/support"?>">Help & Support</a></li>
                                    <li><a href="<?php echo url::base()."company/terms"?>">Terms</a></li>   
                                    <li><a href="">Social Dating</a></li>                   
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="footer-links">
                                    <li><a href="https://www.Callitme.com/blog/" target="_blank">Blog</a></li>
                                    <li><a href="<?php echo url::base()."company/privacypolicy"?>">Privacy</a></li>
                                    <li><a href="<?php echo  url::base()."match" ?>">MatchMaking</a></li>                       
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
                            <li><a href="https://angel.co/Callitme" target="_blank"><span class="fa fa-angellist"></span></a></li>
                        </ul>
                    </div>
                    <div class="clearfix visible-xs"></div>
                    <div class="col-sm-6">
                        <p class="copy"> © Callitme 2015. All rights reserved.<br />System for Anonymous Messaging, Reviewing, Quantifying, Matching and Searching protected by US Patent.</p>    
                    </div>
                </div>
            </div>
        </div>
</section>
        
        

        <script src="<?php echo url::base();?>js/bootstrap.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.validate.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.form.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.expandable.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/function.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/common.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.custom-scrollbar.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/bootstrap-checkbox.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        
    </body>
    
</html>