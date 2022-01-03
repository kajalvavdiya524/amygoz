<div class="admin-top">
    <form method="get" class="pull-left form-inline" style="margin-bottom:0px;">
        <div class="form-group">
        <input type="text" class="form-control required" name="search_member" value="<?php echo Request::current()->query('search_member'); ?>" placeholder="Search Member: ">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
    <div class="pull-right marRight10">
        <h4>Total Registered Users : <?php echo $total_users; ?></h4>
    </div>
    
    <div class="clearfix"></div>
</div>

<div class="marTop20" style="margin-left:0px;">
    <div id="scroll"  style="overflow:auto;">
        <input type="hidden" id="page_name" value="members" />
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Is Active</th>
                    <th>Last Login</th>
                    <th>Last Payment</th>
                    <th>Expires</th>
                </tr>
            </thead>
            <?php echo View::factory('admin/ajax', array('users' => $users, 'page' => $page));?>
        </table>
        <div class="page_footer" style="text-align: center;">
            <img style="display:none;" src="<?php echo url::base()."img/ajax-loader.gif"?>" id="loading"/>
        </div>
    </div>
</div>
