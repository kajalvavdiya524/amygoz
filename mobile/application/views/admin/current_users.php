<div class="marTop20" style="margin-left:0px;">

    <input type="hidden" id="page_name" value="current_users" />

    <table class="table table-bordered">
        
        <?php echo View::factory('admin/ajax', array('users' => $users, 'page' => $page));?>
        
    </table>
    
    <div class="page_footer" style="text-align: center;">
        <img style="display:none;" src="<?php echo url::base()."img/ajax-loader.gif"?>" id="loading"/>
    </div>

</div>