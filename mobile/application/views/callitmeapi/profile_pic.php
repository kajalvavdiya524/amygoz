<form class="" enctype="multipart/form-data" action="<?php echo url::base()."accessapi/save_photo"?>" method="POST">
        <input id="picture" name="picture" type="file">
        <input type="hidden" name="name" value="1" />
        <input type="hidden" id="user_id" name="user_id" value="3306">
        <input type="submit" id="submit" value="Profile Pic">
</form>