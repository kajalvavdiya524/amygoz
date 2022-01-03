<!DOCTYPE html>
<html lang="en">

    <head>
        <title><?php echo $title; ?></title>
        <?php $version = Kohana::$config->load('profile')->get('version');?>
        <?php 
            if(empty($description)){
                $description = "Discover, Meet, Get Inspired by Great Amygoz at www.amygoz.com";
            }
        ?>

        <?php 
            if(empty($keywords)){
                $keywords = "Amygoz, Amigos, Find Friends, Meet New People, Get Inspired";
            }
        ?>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <meta name="robots" content="index, follow/">
        <!--begin facebook-->
        <meta property="og:description" name="description" content="<?php echo $description; ?>">
        <meta property="og:image" content="<?php if(!empty($img)){echo $img;}else {echo url::base()."img/scraper_img.png"; }?>"/>
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:url" content="<?php echo Request::current()->url(); ?>" />
        <meta property="og:site_name" content="AmygozApp">
        <meta property="og:type" content="website" />
        <!--end facebook-->

        <!--begin twitter-->
        <meta name="twitter:site" content="@AmygozApp">
        <meta name="twitter:url" content="<?php echo Request::current()->url(); ?>">
        <meta name="twitter:title" content="<?php echo $title; ?>">
        <meta name="twitter:description" content="<?php echo $description; ?>">
        <meta name="twitter:image" content="<?php if(!empty($img)){echo $img;}else {echo url::base()."img/scraper_img.png"; }?>">
        <!--end twitter-->
        <link rel="canonical" href="<?php echo str_replace('/m.', '/www.', Request::current()->url()); ?>">

        <link href="<?php echo url::base();?>css/bootstrap.css?v=<?php echo $version; ?>" rel="stylesheet" >
        
        <?php if(Request::current()->controller() == 'profile') { ?>
            <link href="<?php echo url::base();?>css/imgareaselect-default.css?v=<?php echo $version; ?>" rel="stylesheet" >
        <?php } ?>
        
        <link href="<?php echo url::base();?>css/style.css?v=<?php echo $version; ?>" rel="stylesheet" >
        <link href="<?php echo url::base();?>css/header.css?v=<?php echo $version; ?>" rel="stylesheet">
        <link href="<?php echo url::base();?>css/footer.css?v=<?php echo $version; ?>" rel="stylesheet">
        <link href="<?php echo url::base();?>css/space.css?v=<?php echo $version; ?>" rel="stylesheet">        
        <link href="<?php echo url::base();?>css/jquery.custom-scrollbar.css?v=<?php echo $version; ?>" rel="stylesheet" >        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
        
        <script src="<?php echo url::base();?>js/jquery-1.10.2.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src='<?php echo url::base();?>js/jquery.knob.js'></script>        
        <script src="https://lipis.github.io/bootstrap-sweetalert/lib/sweet-alert.js"></script>
        <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/lib/sweet-alert.css">        
        <?php if(Request::current()->controller() == 'profile') { ?>
            <script src="<?php echo url::base();?>js/jquery.imgareaselect.pack.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <?php } ?>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-7NNPF14SM7"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-7NNPF14SM7');
        </script>
        <!--End Google Analytics-->
</head>
    
    <body> 
     <div class="feeds-sec">
        <?php $session_user = Auth::instance()->get_user(); ?>
        <?php if(!empty($header)){echo $header;} ?>
      
        <div class="content marTop20">
            <input type="hidden" value="<?php echo url::base();?>" id="base_url" />
            <div class="container" style="position:relative;">
                <div class="row">
                    <?php if(isset($session_user->id) && $session_user->is_active == 0) { ?>
                        <div class="alert bag-pt-bg">
                            <span class="">
                                <?php echo $session_user->user_detail->first_name; ?> , go to <?php echo $session_user->email; ?> to complete the sign-up process.
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

                    <div class="<?php if(Request::current()->controller() == 'peoplereview' && Request::current()->action() == 'compose') { ?> recommend-compose-main <?php } ?> col-sm-12">
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
                                <div class="alert alert-info text-center hb-mt-20">
                                    <input type="hidden" value="<?php echo $match_exists->id; ?>" class="match_id" />

                                    <h4 class="dis-inline text-center"><?php echo $match_exists->match_by->user_detail->first_name; ?> 
                                        thinks <a href="<?php echo url::base().$match_exists->match_to->username; ?>"><?php echo $match_exists->match_to->user_detail->first_name; ?></a> is a good match for you. What do you think?
                                    </h4>

                                    <div class="clearfix hb-mb-10"></div>
                                    
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
                        <div class="marTop20">
                        <?php echo $content;?>
                        </div>
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

                    <div class="sidemenu col-sm-3 marTop20">
                        <?php if(!empty($sidemenu)){echo $sidemenu;}?>
             
             
             <br/>
             
                        
                       <div class="row">
                            <div class="col-sm-12">
                                <?php if(!empty($footer)){echo $footer;}  ?>
                            </div>
                        </div> 
                    </div>
                    
                    <div style="clear:both"></div>
                </div>
            </div>

        </div>
        </div>
        
        <!-- Pop up converation modal-->
        <div class="modal fade" id="genericPopup" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="top:50px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Isn't it exciting to start a new conversation?</h4>
                    </div>

                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo url::base();?>js/bootstrap.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.validate.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.form.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.expandable.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/function.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/common.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.custom-scrollbar.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/bootstrap-checkbox.js?v=<?php echo $version; ?>" type="text/javascript"></script>

        <?php echo View::factory('templates/firebase_registration'); ?>
    </body>
    
</html>
<style>
.bag-pt-bg{background: #00bcd4;color: #fff;font-weight: 500;border: 2px solid #fff;}
</style>
