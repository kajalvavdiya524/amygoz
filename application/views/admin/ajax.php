<?php if($page == 'members') { ?>
    <?php foreach($users as $user) { ?>
        <tr class="content <?php if($user->is_deleted == 1) { ?> error <?php } ?>">
            <input type="hidden" class="user_id" value="<?php echo $user->id;?>">
            <td><?php echo $user->email;?></td>
            <td><?php echo $user->username;?></td>
            <td><?php echo $user->user_detail->first_name ." ".$user->user_detail->last_name;?></td>
            <td class="is_active"><?php echo ($user->is_active) ? "True" : "False";?></td>
            <td><?php echo ($user->last_login) ? date('Y-m-d H:i:s', $user->last_login) : "--";?></td>
            <td><?php echo $user->last_payment;?></td>
            <td class="expires"><?php echo $user->plan->plan_expires;?></td>
        </tr>
        <tr class="operation <?php if($user->is_deleted == 1) { ?> error <?php } ?>">
            <td colspan="8" class="textRight">
                <span class="label label-success" style="display:none;">Success</span>
                <span class="label label-important" style="display:none;">Error</span>
                <span class="is_active-op">
                    <?php if($user->is_active == 0) { ?>
                        <?php 
                            $account_expires = date("Y-m-d",
                                mktime(23, 59, 59, date("m", strtotime($user->registration_date)),
                                    date("d", strtotime($user->registration_date))+3,
                                    date("Y", strtotime($user->registration_date))
                                )
                            );
                            
                            if($account_expires < date("Y-m-d")) {
                        ?>
                            <span class="label label-danger" style="font-size:90%;">Activation time expired.</span>
                        <?php } ?>
                    
                        ( Last Reminded - <strong><?php echo ($user->reminder_date) ?
                            date('j M, Y', strtotime($user->reminder_date)) : "Never";?></strong> )&nbsp
                        <?php if($user->is_deleted == 0) { ?>
                            <form class="approve-form" action="<?php echo url::base()."admin/approve"?>" method="post">
                                <input type="hidden" name="approve" value="<?php echo $user->id;?>">
                                <button class="btn btn-primary btn-small" type="submit" style="margin-left:5px;">
                                    <i class="icon-thumbs-up icon-white"></i> Approve
                                </button>
                            </form>
                            <form class="reminder-form" action="<?php echo url::base()."admin/reminder"?>" method="post">
                                <input type="hidden" name="user" value="<?php echo $user->id;?>">
                                <button class="btn btn-primary btn-small" type="submit">
                                    <i class="icon-envelope icon-white"></i> Remind
                                </button>
                            </form>
                        <?php } ?>
                    <?php } ?>
                </span>
                <?php if($user->is_deleted == 0) { ?>
                    <a href="<?php echo url::base()."admin/edit_profile/".$user->id; ?>" class="edit-form-btn btn btn-primary btn-small" id="<?php echo $user->id;?>">Edit Profile</a>
                    <form class="block-form" action="<?php echo url::base()."admin/block"?>" method="post">
                        <input type="hidden" name="<?php echo ($user->is_blocked) ? "unblock" : "block"; ?>" value="<?php echo $user->id;?>"/>
                        <button class="btn btn-primary btn-small btn-small-width" type="submit"><?php echo ($user->is_blocked) ? "Unblock" : "Block"; ?></button>
                    </form>
                    <form class="delete-form" action="<?php echo url::base()."admin/delete"?>" method="post">
                        <input type="hidden" name="user" value="<?php echo $user->id;?>">
                        <button class="btn btn-primary btn-small btn-small-width" type="submit">Delete</button>
                    </form>
                    <form class="privilege-form" action="<?php echo url::base()."admin/privilege"?>" method="post">
                        <input type="hidden" name="<?php echo ($user->has('roles', ORM::factory('role')->where('name', '=', 'admin')->find())) ? "remove" : "add"; ?>" value="<?php echo $user->id;?>">
                        <button class="btn btn-primary btn-small" type="submit">
                            <?php echo ($user->has('roles', ORM::factory('role')->where('name', '=', 'admin')->find())) ? "Remove " : "Make "; ?>
                            Admin
                        </button>
                    </form>
                <?php } else { ?>
                    <b>Deleted</b>
                    <form class="reactivate-form padLeft10" action="<?php echo url::base()."admin/reactivate"?>" method="post">
                        <input type="hidden" name="user" value="<?php echo $user->id;?>">
                        <button class="btn btn-primary btn-small btn-small-width" type="submit">Reactivate</button>
                    </form>
                <?php } ?>
            </td>
        </tr>
        
    <?php } ?>
    
<?php } else if($page == 'current_users') { ?>
    
    <tr>
        <th>Email</th>
        <th>Username</th>
        <th>Name</th>
        <th>IP</th>
        <th>User Agent</th>
        <th>Login</th>
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
        </tr>
    <?php } ?>
<?php } ?>