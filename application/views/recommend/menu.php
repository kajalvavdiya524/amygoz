<ul class="list-group marTop20" >
    <li class="list-group-item <?php if($submenu == 'compose') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."peoplereview"; ?>">Write a Review</a>
    </li>
    <li class="list-group-item <?php if($submenu == 'askreview') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."peoplereview/askreview"; ?>">Ask for Review</a>
    </li>
    <li class="list-group-item <?php if($submenu == 'recommend_sent') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."peoplereview/recommend_sent"; ?>">Reviews Sent</a>
    </li>
    <li class="list-group-item <?php if($submenu == 'recommend') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."peoplereview/recommend_recieve"; ?>">Reviews Received</a>
    </li>
    <li class="list-group-item <?php if($submenu == 'recommend_request') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."peoplereview/recommend_request"; ?>">Reviews Requested</a>
    </li>
</ul>