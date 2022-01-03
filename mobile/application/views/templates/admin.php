<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $version = Kohana::$config->load('profile')->get('version');?>

        <link href="<?php echo url::base();?>css/bootstrap.css?v=<?php echo $version; ?>" rel="stylesheet" >
        <link href="<?php echo url::base();?>css/style.css?v=<?php echo $version; ?>" rel="stylesheet">
        <link href="<?php echo url::base();?>css/colorbox.css?v=<?php echo $version; ?>" rel="stylesheet">
        <script src="<?php echo url::base();?>js/jquery-1.10.2.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>
    </head>
    <body>
        <?php echo $header; ?>
        
        <div class="content">
            <input type="hidden" value="<?php echo url::base();?>" id="base_url" />
            <div class="admin-container container" style="position:relative;">
            
                
                <div class="row" style="margin-top:20px;">
                    <?php echo $content; ?>
                </div>
            
            </div>
        </div>
        
        <?php echo $footer; ?>
        
        <script src="<?php echo url::base();?>js/jquery.form.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.validate.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/bootstrap.min.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/jquery.colorbox-min.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/admin.js?v=<?php echo $version; ?>" type="text/javascript"></script>
        <script src="<?php echo url::base();?>js/common.js?v=<?php echo $version; ?>" type="text/javascript"></script>
    </body>
    
</html>