<ul class="list-group">
    <li class="list-group-item <?php if($submenu == 'friends') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."friends"; ?>"><i class="demo-icon icon-users"></i> My Friends</a>
    </li>
<li class="list-group-item <?php if($submenu == 'requests') { ?> active <?php } ?>">
        <a  href="<?php echo url::base()."friends/requests"; ?>"><i class="fa fa-plus"></i> New Friend Requests</a>
    </li>
    <!--<li class="list-group-item <?php if($submenu == 'requests') { ?> active <?php } ?>">
        <a id="friend-noti" class="noti-icons icon icon_user" href="<?php echo url::base()."friends/friends_for_noti"; ?>"><i class="fa fa-plus"></i> New Friend Requests</a>
    </li>-->

    <li class="list-group-item <?php if($submenu == 'requests_sent') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."friends/requests_sent"; ?>"><i class="fa fa-paper-plane"></i> Friend Requests Sent</a>
    </li>
</ul>