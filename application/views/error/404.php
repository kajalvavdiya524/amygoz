<!DOCTYPE html>
<html lang="en">
  	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nepal's Largest Social Matrimony Site</title>
        
        <!-- Bootstrap -->
        <link href="<?php echo url::base(); ?>new_assets/css/style.css" rel="stylesheet">
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- Include map script -->   
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        
        <style>
            .error-template {padding: 40px 15px;text-align: center;}
            .error-actions {margin-top:15px;margin-bottom:15px;}
            .error-actions .btn { margin-right:10px; }
        </style>

    </head>
    <body style="padding-top:15%" class="primary-bg">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-template paddingBottom">
                        <center>
                            <img src="<?php echo url::base(); ?>img/logo1.png" class="marginVertical" />
                        </center>
                        <h1 style="font-size:300%" class="secondary-text">
                            Oops!</h1>
                        <h2 class="secondary-text">
                           Something is wrong. We have no idea where we are</h2>
                        <div class="error-details white-text">
                            The best is to Return Home.
                            If you think this area should work normally, please contact us. You can 
                            find out the reasons why this happens at our Support Page
                        </div>
                        <div class="error-actions">
                            <a href="<?php echo url::base(); ?>" class="btn btn-secondary btn-lg">
                                <span class="glyphicon glyphicon-home"></span>
                                Take Me Home </a>
                                
                            <a href="<?php echo url::base(); ?>contact_us" class="btn btn-default btn-lg">
                                <span class="glyphicon glyphicon-envelope"></span>
                                Contact Support </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
    </body>
</html>