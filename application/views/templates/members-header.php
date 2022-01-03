<?php $session_user = Auth::instance()->get_user(); ?>
<header id="inner">
    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-xs-2">
                <a href="<?php echo url::base(); ?>">
                    <img class="memberlogo hidden-xs" alt="Callitme logo" src="<?php echo url::base() . 'img/logo1.png'; ?>" />
                    <img class="memberlogo visible-xs" alt="Callitme logo" src="<?php echo url::base() . 'img/logo-sm.png'; ?>" />
                </a>
            </div>
            <div class="col-sm-2 col-xs-8">
                <ul id="nav-noti-icons" class="nav navbar-nav">
                    <li>
                        <a href="<?php echo url::base() . "friends/friends_for_noti"; ?>" class="noti-icons icon icon_user" id="friend-noti">
                            <span class="badge"></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo url::base() . "chat/chats_for_noti"; ?>" class="noti-icons icon icon_message" id="message-noti">
                            <span class="badge"></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo url::base() . "members/activity_notification"; ?>" class="noti-icons icon icon_notification" id="activity-noti">
                            <span class="badge"></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo url::base() . "import" ?>" class="icon icon_import"></a>
                    </li>
                    <li id="searchWrapBtn" class="visible-xs">
                        <a href="javascript:void(0)" class="icon icon_search"> </a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-4 col-xs-12" id="searchWrap">
                <a href="javascript:void(0)" id="searchWrapBtnClose" class="visible-xs"><i class="fa fa-close"></i></a>

                <form action="<?php echo url::base() . 'members/search_results' ?>" method="post">
                    <div class="input-group">
                        <input type="text" id="search-query" class="form-control input-sm" type="text" name="first_name" value="<?php echo Request::current()->post('first_name'); ?>" placeholder="Search for your connection" style="height: 28px;border: none;border-radius: 4px 0px 0px 4px !important;font-size: 14px;">
                        <span class="input-group-btn">
                            <button style="background: rgb(243, 246, 248);border: none;color: rgba(0, 0, 0, 0.65);width: 54px;height: 28px;border-radius: 0px 4px 4px 0px;" type="submit" class="btn btn-secondary btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-sm-4 col-xs-2">
                <div class="btn-group visible-xs" id="memberBtn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $session_user->user_detail->first_name[0]; ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" style="right: 0; left: auto; top: 31px;">
                        <?php if (Auth::instance()->logged_in('admin')) { ?>
                            <li>
                                <a href="<?php echo url::base() . 'admin' ?>">Use as Admin</a>
                            </li>
                        <?php } ?>

                        <li>
                            <a href="<?php echo url::base() . 'account/edit_profile'; ?>">Edit Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo url::base() . 'account/change_email'; ?>">Account Setting</a>
                        </li>
                        <li>
                            <a href="<?php echo url::base() . 'account/privacy_settings' ?>">Privacy Settings</a>
                        </li>

                        <!-- <li>
                             <a href="<?php echo url::base() . 'account/email_notification_settings' ?>">Email Settings</a>
                         </li>

                         <li>
                             <a href="<?php echo url::base() . 'account/subscription_details' ?>">Subscription Details</a>
                         </li>-->
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo url::base() . 'logout' ?>">Log Out</a>
                        </li>
                    </ul>
                </div>
                <ul id="nav-user" class="nav navbar-nav navbar-right hidden-xs">
                     <li  id="pp" > <a href="<?php echo url::base() . $session_user->username; ?>" >
                            <?php 
                              $photo = $session_user->photo->profile_pic_s;
                              $memhed_image = file_exists("mobile/upload/" .$photo);
                              $memhed_image1 = file_exists("upload/" .$photo);
                              if (!empty($photo) && $memhed_image) { ?>
                                <img src="<?php echo url::base() . 'mobile/upload/' . $session_user->photo->profile_pic; ?>" alt="<?php echo $session_user->user_detail->first_name." ".$session_user->user_detail->last_name;?>">
                            <?php } 
                            else if (!empty($photo) && $memhed_image1) { ?>
                                <img src="<?php echo url::base() . 'upload/' . $session_user->photo->profile_pic; ?>" alt="<?php echo $session_user->user_detail->first_name." ".$session_user->user_detail->last_name;?>">
                            <?php } else { ?>
                                <div id="inset" class="xxs pull-left hb-mr-5">
                                    <h1>
                                        <?php echo $session_user->user_detail->get_no_image_name(); ?>
                                    </h1>
                                    <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                </div>
                            <?php } ?></li>
                    <li class="dropdown" id="pp">
                       

                        <a class="dropdown-toggle" data-toggle="dropdown"><?php echo $session_user->user_detail->first_name; ?> <span class="caret"></span></a>

<!--  <?php /* echo $session_user->user_detail->first_name ." ".$session_user->user_detail->last_name; */ ?> <span class="caret"></span> -->

                        </a>
                        <ul class="dropdown-menu">
                            <?php if (Auth::instance()->logged_in('admin')) { ?>
                                <li>
                                    <a href="<?php echo url::base() . 'admin' ?>">Use as Admin</a>
                                </li>
                            <?php } ?>

                            <li>
                                <a href="<?php echo url::base() . 'account/edit_profile'; ?>">Edit Profile</a>
                            </li>
                            <li>
                                <a href="<?php echo url::base() . 'account/change_email'; ?>">Account Setting</a>
                            </li>
                            <li>
                                <a href="<?php echo url::base() . 'account/privacy_settings' ?>">Privacy Settings</a>
                            </li>

                            <!-- <li>
                                 <a href="<?php echo url::base() . 'account/email_notification_settings' ?>">Email Settings</a>
                             </li>
                                 
                             <li>
                                 <a href="<?php echo url::base() . 'account/subscription_details' ?>">Subscription Details</a>
                             </li>-->
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo url::base() . 'logout' ?>">Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="clearfix visible-xs"></div>
            </div>
            <div class="clearfix visible-xs"></div>
        </div>
    </div>
</header>

<!--<nav class="navbar navbar-default" role="navigation">
    <div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<!-- <div class="navbar-header visible-xs">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"><img class="memberlogo" alt="Callitme logo" src="<?php //echo url::base() . 'img/logo1.png';  ?>" /></a>
</div>

<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul id="nav-logo" class="nav navbar-nav hidden-xs">
        <li>
            <a href="<?php //echo url::base();  ?>">
                <img class="memberlogo" alt="Callitme logo" src="<?php //echo url::base() . 'img/logo1.png';  ?>" />
            </a>
        </li>
    </ul>



    <ul class="nav navbar-nav">
        <li>

        </li>
    </ul>

    <ul id="nav-user" class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="<?php //echo url::base() . $session_user->username;  ?>" class="dropdown-toggle" data-toggle="dropdown">
<?php //echo $session_user->user_detail->first_name; ?> <span class="caret"></span>

<!--  <?php /* echo $session_user->user_detail->first_name ." ".$session_user->user_detail->last_name; */ ?> <span class="caret"></span> -->

<!-- </a>
<ul class="dropdown-menu">
<?php //if (Auth::instance()->logged_in('admin')) { ?>
        <li>
            <a href="<?php //echo url::base() . 'admin'  ?>">Use as Admin</a>
        </li>
<?php //} ?>

    <li>
        <a href="<?php //echo url::base() . 'account/edit_profile';  ?>">Edit Profile</a>
    </li>
    <li>
        <a href="<?php //echo url::base() . 'account/change_email';  ?>">Account Setting</a>
    </li>
    <li>
        <a href="<?php //echo url::base() . 'account/privacy_settings'  ?>">Privacy Settings</a>
    </li>

<!-- <li>
     <a href="<?php //echo url::base() . 'account/email_notification_settings'  ?>">Email Settings</a>
 </li>
     
 <li>
     <a href="<?php //echo url::base() . 'account/subscription_details'  ?>">Subscription Details</a>
 </li>-->
<!-- <li class="divider"></li>
<li>
    <a href="<?php //echo url::base() . 'logout'  ?>">Log Out</a>
</li>
</ul>
</li>
<li id="pp">
<a href="<?php ///echo url::base() . $session_user->username;  ?>">
<?php //if ($session_user->photo->profile_pic_s) { ?>
    <img src="<?php //echo url::base() . 'upload/' . $session_user->photo->profile_pic_s;  ?>">
<?php ///} else { ?>
    <div id="inset" class="xxs">
        <h1>
<?php //echo $session_user->user_detail->first_name[0] . $session_user->user_detail->last_name[0]; ?>
        </h1>
        <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
<!-- </div>
<?php //} ?>
</a>
</li>
</ul>
</div>
</div>
</nav>-->

<nav class="navbar navbar-default navbar-xs navbar-fixed-top" role="navigation">

    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header visible-xs">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                <span class="sr-only">Toggle navigation</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand" href="#"><b>User</b> Navbar</a>

        </div>



        <!-- Collect the nav links, forms, and other content for toggling -->

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav">
                <li><a href="<?php echo url::base() . 'activity'; ?>"><i class="demo-icon icon-user-add"></i> Requests</a></li>

                <li><a href="<?php echo url::base() . 'friends'; ?>"><i class="demo-icon icon-users"></i> Friends</a></li>
                <li><a href="<?php echo url::base() . 'chat'; ?>"><i class="fa fa-envelope"></i> Message</a></li>

                <li><a href="<?php echo url::base() . 'peoplereview' ?>"><i class="demo-icon icon-edit"></i> Review</a></li>

                <li><a href="<?php echo url::base() . 'localpeople' ?>"><i class="demo-icon icon-street-view"></i> Around</a></li>

                <li><a href="<?php echo url::base() . 'upgrade' ?>"><i class="demo-icon icon-up-circled2"></i> Upgrade</a></li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div>

</nav>

<script type="text/javascript">
    $('#searchWrapBtn').click(function () {
        $('#searchWrap').slideDown();
    })

    $('#searchWrapBtnClose').click(function () {
        $('#searchWrap').fadeOut();
    })
</script>                            