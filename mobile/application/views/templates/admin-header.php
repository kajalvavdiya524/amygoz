<?php $session_user = Auth::instance()->get_user(); ?>
<nav class="admin-nav navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse navbar-ex1-collapse" style="padding:0px;">
            <ul id="nav-logo" class="nav navbar-nav">
                <li>
                    <a href="<?php echo url::base();?>">
                        <img class="memberlogo" alt="Callitme logo" src="<?php echo url::base().'img/member_logo.png';?>" />
                    </a>
                </li>
            </ul>
            
            <ul class="nav-menu nav navbar-nav">
                <?php echo ($page == 'index') ? "<li class='active'>" : "<li>"; ?>
                    <a href="<?php echo url::base()."admin"; ?>">Members</a>
                </li>

                <?php echo ($page == 'payments') ? "<li class='active'>" : "<li>"; ?>
                    <a href="<?php echo url::base()."admin/payment_info"; ?>">Payment Info</a>
                </li>

                <?php echo ($page == 'plans') ? "<li class='active'>" : "<li>"; ?>
                    <a href="<?php echo url::base()."admin/plans_info"; ?>">Plan Info</a>
                </li>

                <?php echo ($page == 'log_info') ? "<li class='active'>" : "<li>"; ?>
                    <a href="<?php echo url::base()."admin/log_info"; ?>">Login Information</a>
                </li>

                <?php echo ($page == 'current_users') ? "<li class='active'>" : "<li>"; ?>
                    <a href="<?php echo url::base()."admin/current_users"; ?>">Current Users</a>
                </li>
            </ul>

            <ul class="nav-menu nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo url::base()?>">Front End</a>
                </li>

                <li>
                    <a href="<?php echo url::base().'pages/logout'?>">Log out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>