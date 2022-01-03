<ul class="submenus-nav menus-3">
    <li class="submenu nav2 <?php if($submenu == 'messages') { ?> active <?php } ?>" style="left:0px; ">
        <a href="<?php echo url::base()."messages"; ?>" style="border-right:1px solid black;">Inbox</a>
    </li>

    <li class="submenu nav3 <?php if($submenu == 'compose') { ?> active <?php } ?>" style="">
        <a href="<?php echo url::base()."messages/compose"; ?>">Compose Message</a>
    </li>
</ul>