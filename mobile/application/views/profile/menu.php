<ul class="submenus-nav">
    <li class="submenu nav1 <?php if($submenu == 'edit_profile') { ?> active <?php } ?>">
        <a href="<?php echo url::base();?>account/edit_profile">Edit Profile</a>
    </li>
    <li class="submenu nav2 <?php if($submenu == 'email') { ?> active <?php } ?>">
        <a href="<?php echo url::base();?>account/change_email">Change Email</a>
    </li>
    <li class="submenu nav3 <?php if($submenu == 'change_username') { ?> active <?php } ?>">
        <a href="<?php echo url::base();?>account/change_username">Change Username</a>
    </li>
    <li class="submenu nav4 <?php if($submenu == 'change_password') { ?> active <?php } ?>">
        <a href="<?php echo url::base();?>account/change_password">Change Password</a>
    </li>
    <li class="submenu nav5 <?php if($submenu == 'email_notification_settings') { ?> active <?php } ?>">
        <a href="<?php echo url::base();?>account/email_notification_settings">Email Notification</a>
    </li>
</ul>