<header class="hidden-xs">
    <link rel='shortcut icon' href='<?php echo url::base(); ?>img/callitme_fav.ico' type='image/x-icon'/>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <a class="logo" >
                    <img src="<?php echo url::base(); ?>img/logo1.png" alt="callitme logo" />
                </a>
            </div>
            <?php if (!Auth::instance()->logged_in()) { ?>
                <div class="col-sm-6 col-sm-offset-4">
                    <div class="header-login">
                        <div class="headerRegister">
                            <a href="<?php echo url::base() . "forgot_password"; ?>">Forgot Your Password?</a>
                            | 
                            <a href="<?php echo url::base() . "register"; ?>">Register</a><!--
                            | 
                            <a href="#"><i class="fa fa-facebook"></i> Sign up with Facebook</a>-->
                        </div><!-- /.headerRegistrater -->
                        <div class="clearfix marTop5"></div>
                        <form action="<?php echo url::base() . "login"; ?>" method="post" class="form-inline row" role="search">
                            <div class="form-group">
                                <!-- <label class="block" for="exampleInputEmail2">Email address</label> -->
                                <!-- Please uncomment to make lable active -->
                                <input type="email" class="required email form-control input-sm" name="email" id="header_email" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <!-- <label class="block" for="exampleInputPassword2">Password </label> -->
                                <!-- Please uncomment to make lable active -->
                                <input type="password" class="required form-control input-sm"  name="password" id="header_password"  placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-secondary btn-sm">Login</button>
                        </form>
                        <!-- /.form -->
                    </div>
                    <!-- /.header-login -->
                </div>        
            <?php } ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</header>

<nav class="navbar navbar-default navbar-fixed-top visible-xs">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img class="memberlogo" alt="Callitme logo" src="<?php echo url::base() . 'img/logo1.png'; ?>" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo url::base() . 'login'; ?>">Login</a></li>
                <li><a href="#">Register</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>