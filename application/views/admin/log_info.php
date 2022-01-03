<div class="admin-top">
    <form method="post" class="pull-right form-inline">
        <div class="form-group">
            <input type="text" class="form-control required selectdate" name="log_date" placeholder="Select Date: ">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
    <div class="clearfix"></div>
</div>

<div class="marTop20" style="margin-left:0px;">
    <input type="hidden" id="page_name" value="log_infor" />
    <table class="table table-bordered">
        <tr>
            <th>Email</th>
            <th>Username</th>
            <th>Name</th>
            <th>IP</th>
            <th>User Agent</th>
            <th>Login</th>
            <th>Logout</th>
        </tr>
        <?php foreach($users as $user) { ?>
            <tr>
                <input type="hidden" class="user_id" value="<?php echo $user->login_time;?>">
                <td><?php echo $user->user->email;?></td>
                <td><?php echo $user->user->username;?></td>
                <td><?php echo $user->user->user_detail->first_name ." ".$user->user->user_detail->last_name;?></td>
                <td><?php echo $user->ip;?></td>
                <td><?php echo $user->user_agent;?></td>
                <td><?php echo $user->login_time;?></td>
                <td><?php echo $user->logout_time;?></td>
            </tr>
        <?php } ?>
    </table>

    <div class="page_footer" style="text-align: center;">
        <img style="display:none;" src="<?php echo url::base()."img/ajax-loader.gif"?>" id="loading"/>
    </div>
</div>