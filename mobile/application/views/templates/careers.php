<!DOCTYPE html>
<html lang="en">

    <head>
        <title><?php echo $title; ?></title>

        <?php $version = Kohana::$config->load('profile')->get('version');?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="Dating, Match Singles, Match Friends, Review, Review Friends, Find Singles, Anonymous Requests, Crush Love" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
         <link href="<?php echo url::base();?>css/style.css?v=1.1" rel="stylesheet">
        <link href="<?php echo url::base();?>assets/css/header.css?v=1.1" rel="stylesheet">
        <link href=<?php echo url::base();?>assets/css/footer.css?v=1.1" rel="stylesheet">
        <link href="<?php echo url::base();?>css/bootstrap.css?v=<?php echo $version; ?>" rel="stylesheet" >
        <link href="<?php echo url::base();?>css/style.css?v=<?php echo $version; ?>" rel="stylesheet" >

        <script src="<?php echo url::base();?>js/jquery-1.10.2.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>

    </head>

    <body>
        <?php echo $header; ?>

        <?php echo $careers_header; ?>

        <div class="content">
            <input type="hidden" value="<?php echo url::base();?>" id="base_url" />
            <div class="container" style="position:relative;">

                <?php echo $content; ?>

                <div style="clear:both"></div>
            </div>

        </div>

        <?php echo $footer; ?>

        <script src="<?php echo url::base();?>js/bootstrap.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.validate.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.form.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/common.js?v=<?php echo $version; ?>" type="text/javascript"></script>

    </body>

</html>