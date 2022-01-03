<div class="list-group pad-ty-2">
    <div class="pad-ty-1 <?php if($submenu == 'friends') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."friends"; ?>"><i class="demo-icon icon-users"></i> My Friends</a>
    </div>
<div class="pad-ty-1 <?php if($submenu == 'requests') { ?> active <?php } ?>">
        <a  href="<?php echo url::base()."friends/requests"; ?>"><i class="fa fa-plus"></i> New Friend Requests</a>
    </div>
    <div class="pad-ty-1 <?php if($submenu == 'requests_sent') { ?> active <?php } ?>">
        <a href="<?php echo url::base()."friends/requests_sent"; ?>"><i class="fa fa-paper-plane"></i> Friend Requests Sent</a>
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