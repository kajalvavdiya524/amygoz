<!DOCTYPE html>
<html>
    <head>
        <?php $title = (!empty($title)) ? $title : 'Callitme'; ?>
        <title><?php echo $title; ?></title>
        <?php $version = Kohana::$config->load('profile')->get('version');?>
        <?php 
            if(empty($description)){
                $description = "Get inspired at Callitme";
            }
        ?>

        <?php 
            if(empty($keywords)){
                $keywords = "Get Inspired";
            }
        ?>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <meta name="robots" content="index, follow/">
        <!--begin facebook-->
        <meta property="og:description" name="description" content="<?php echo $description; ?>">
        <meta property="og:image" content="<?php if(!empty($img)){echo $img;}?>"/>
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:url" content="<?php echo Request::current()->url(); ?>" />
        <meta property="og:site_name" content="Callitme">
        <meta property="og:type" content="website" />
        <!--end facebook-->

        <!--begin twitter-->
        <meta name="twitter:site" content="@Callitme">
        <meta name="twitter:url" content="<?php echo Request::current()->url(); ?>">
        <meta name="twitter:title" content="<?php echo $title; ?>">
        <meta name="twitter:description" content="<?php echo $description; ?>">
        <meta name="twitter:image" content="<?php if(!empty($img)){echo $img;}else {echo url::base()."img/scraper_img.png"; }?>">
        <!--end twitter-->
        <link rel="canonical" href="<?php echo str_replace('/m.', '/www.', Request::current()->url()); ?>">

        <!-- bootstrap 4.0 link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.4.1/cerulean/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css">

        <!-- custom style css link -->
        <link rel="stylesheet" type="text/css" href="<?php echo url::base();?>assets/new/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo url::base();?>assets/new/css/nav.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-44906509-2', 'auto');
		  ga('send', 'pageview');

		</script>
        <!--End Google Analytics-->

    </head>

    <body style="margin-bottom:85px;">
        <?php $session_user = Auth::instance()->get_user(); ?>
        <input type="hidden" value="<?php echo url::base();?>" id="base_url" />
        <?php echo $content;?>

        <?php if(!empty($header)) { echo $header; } ?>
        <?php echo View::factory('templates/firebase_registration'); ?>


        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </body>
</html>