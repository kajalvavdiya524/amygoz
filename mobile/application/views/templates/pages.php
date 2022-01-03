<!DOCTYPE html>
<html lang="en" class="no-js" prefix="og: http://ogp.me/ns#">
    <head>
        <title><?php echo $title; ?></title>
        <?php $version = Kohana::$config->load('profile')->get('version');?>

        <?php 
            if(empty($description)){
                $description = "Discover, meet and get inspired by great Amygoz on www.amygoz.com";
            }
        ?>

        <?php 
            if(empty($keywords)){
                $keywords = "Find Friends, Meet New People, Make New Friends, Amygoz, Amigos";
            }
        ?>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <meta name="viewport" content="user-scalable=0, initial-scale=1.0, width=device-width">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="robots" content="index, follow/">
        <!--begin facebook-->
        <meta property="og:description" name="description" content="<?php echo $description; ?>">
        <meta property="og:image" content="<?php if(!empty($img)){echo $img;}?>"/>
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:url" content="<?php echo Request::current()->url(); ?>" />
        <meta property="og:site_name" content="AmygozApp">
        <meta property="og:type" content="website" />
        <!--begin twitter-->
        <meta name="twitter:site" content="AmygozApp">
        <meta name="twitter:url" content="<?php echo Request::current()->url(); ?>">
        <meta name="twitter:title" content="<?php echo $title; ?>">
        <meta name="twitter:description" content="<?php echo $description; ?>">
        <meta name="twitter:image" content="<?php if(!empty($img)){echo $img;}?>">
        <!--end twitter-->
        <meta name="apple-itunes-app" content="app-id=1520089931, affiliate-data=#, app-argument=#">
        <link rel="canonical" href="<?php echo str_replace('/m.', '/www.', Request::current()->url()); ?>">
        <link href='//fonts.googleapis.com/css?family=Roboto|Abel|Economica|News+Cycle|Pontano+Sans|Lato' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo url::base();?>css/style.css?v=<?php echo $version; ?>" rel="stylesheet">
        <link href="<?php echo url::base();?>css/header.css?v=<?php echo $version; ?>" rel="stylesheet">
        <link href="<?php echo url::base();?>css/footer.css?v=<?php echo $version; ?>" rel="stylesheet">
        <link href="<?php echo url::base();?>css/space.css?v=<?php echo $version; ?>" rel="stylesheet">
        <script src="<?php echo url::base();?>js/jquery-1.10.2.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>
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
