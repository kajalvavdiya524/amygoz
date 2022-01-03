<!DOCTYPE html>
<html lang="en" class="no-js" prefix="og: http://ogp.me/ns#">

    <head>

        <title><?php echo $title; ?></title>
        <?php $version = Kohana::$config->load('profile')->get('version');?>

        <?php 
            if(empty($description)){
                $description = "Get inspired by great people around you";
            }
        ?>

        <?php 
            if(empty($keywords)){
                $keywords = "Meet People, Inspirational People";
            }
        ?>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow/">

        <!--begin facebook-->
        <meta property="og:description" name="description" content="<?php echo $description; ?>">
        <meta property="og:image" content="<?php if(!empty($img)){echo $img;}?>"/>
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:url" content="<?php echo Request::current()->url(); ?>" />
        <meta property="og:site_name" content="AmygozApp">
        <meta property="og:type" content="website" />

        <!--begin twitter-->
        <meta name="twitter:site" content="@AmygozApp">
        <meta name="twitter:url" content="<?php echo Request::current()->url(); ?>">
        <meta name="twitter:title" content="<?php echo $title; ?>">
        <meta name="twitter:description" content="<?php echo $description; ?>">
        <meta name="twitter:image" content="<?php if(!empty($img)){echo $img;}?>">

        <link rel="alternate" media="only screen and (max-width: 640px)" href="<?php echo str_replace('/www.', '/m.', Request::current()->url()); ?>">
        <link rel="canonical" href="<?php echo Request::current()->url(); ?>">
        <link href='//fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link href="<?php echo url::base();?>css/bootstrap.3.3.4.min.css" rel="stylesheet">
        <link href="<?php echo url::base();?>css/style.css?v=<?php echo $version; ?>" rel="stylesheet">
        <link href="<?php echo url::base();?>assets/css/header.css?v=<?php echo $version; ?>" rel="stylesheet">
        <link href="<?php echo url::base();?>assets/css/footer.css?v=<?php echo $version; ?>" rel="stylesheet">
        <link href="<?php echo url::base();?>css/space.css?v=<?php echo $version; ?>" rel="stylesheet">

        <script src="<?php echo url::base();?>js/jquery-1.10.2.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-F94L5641VP"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-F94L5641VP');
        </script>
        <!--End Google Analytics-->

    </head>

    <body>
        <?php echo $header; ?>
        <div class="content">
            <input type="hidden" value="<?php echo url::base();?>" id="base_url" />
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
              <?php if(Session::instance()->get('error')) {?>
                <div class="alert alert-danger">
                   <strong>ERROR!</strong>
                   <?php echo Session::instance()->get_once('error');?>
                </div>
            <?php } else if(Session::instance()->get('success')) {?>
                <div class="alert alert-success">
                   <strong>SUCCESS </strong>
                   <?php echo Session::instance()->get_once('success');?>
                </div>
            <?php } ?>
            <?php echo $content;?>
            
        </div>

        <?php echo $footer; ?>

        <!-- Pop up converation modal-->
        <div class="modal fade" id="genericPopup" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.validate.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.form.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/common.js?v=<?php echo $version; ?>" type="text/javascript"></script>

        <?php if(!Auth::instance()->logged_in()) { ?>
            <script src="<?php echo url::base();?>js/pages.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <?php } else { ?>
            <script src="<?php echo url::base();?>js/function.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <?php } ?>
        <script src="<?php echo url::base();?>js/bootstrap-checkbox.js?v=<?php echo $version; ?>" type="text/javascript"></script>
    </body>

</html>