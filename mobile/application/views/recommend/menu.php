<div class="list-group pad-ty-2">
    <div class="pad-ty-1 <?php if($submenu == 'compose') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."peoplereview"; ?>">New Review</a>
    </div>
    <div class="pad-ty-1 <?php if($submenu == 'askreview') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."peoplereview/askreview"; ?>">Ask for Review</a>
    </div>
    <div class="pad-ty-1 <?php if($submenu == 'recommend_sent') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."peoplereview/recommend_sent"; ?>">Reviews Sent</a>
    </div>
    <div class="pad-ty-1 <?php if($submenu == 'recommend') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."peoplereview/recommend_recieve"; ?>">Reviews Received</a>
    </div>
    <div class="pad-ty-1 <?php if($submenu == 'recommend_request') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."peoplereview/recommend_request"; ?>">Reviews Requested</a>
    </div>
</div>
<style>
.pad-ty-2
{
    text-align: center;
    margin-top: 17px;
}
.pad-ty-1
{
    padding: 6px 0px 6px 0px;
    border: 1px solid #f06292;
    margin: 0px auto;
    border-radius: 40px;
    margin-bottom: 8px;
}
</style>