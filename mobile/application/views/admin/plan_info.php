<div>
    <?php $available_plans = Kohana::$config->load('stripe')->get('plans');?>
    <h4><?php echo "Free Plan - ".ORM::factory('user_plan')->where('name', '=', "free")->count_all()." users"; ?></h4>
    <?php foreach($available_plans as $available_plan) { ?>
        <h4><?php echo ucwords($available_plan)." Plan - ".ORM::factory('user_plan')->where('name', '=', $available_plan)->where('user_id', '!=', 0)->count_all()." users"; ?></h4>
    <?php } ?>
</div>

<div class="marTop20" style="margin-left:0px;">
    <input type="hidden" id="page_name" value="plan" />

    <table class="table table-bordered">

        <tr>
            <th>User</th>
            <th>Plan Expires</th>
        </tr>

        <tr class="success">
            <td colspan="2"><?php echo "Free Users"; ?></td>
        </tr>
        <?php $free_users = ORM::factory('user_plan')->where('name', '=', "free")->where('user_id', '!=', 0)->find_all()->as_array(); ?>
        <?php if(!empty($free_users)) { ?>
            <?php foreach($free_users as $free_user) { ?>
                <tr>
                    <td>
                        <a href="<?php echo url::base().$free_user->user->username; ?>">
                            <?php echo $free_user->user->user_detail->first_name ." ".$free_user->user->user_detail->last_name;?>
                        </a>
                    </td>
                    <td><?php echo date('j M, Y', strtotime($free_user->plan_expires));?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td class="textCenter" colspan="2"><b>No User</b></td>
            </tr>
        <?php } ?>

        <?php foreach($available_plans as $available_plan) { ?>

            <?php $user_plans = ORM::factory('user_plan')->where('name', '=', $available_plan)->where('user_id', '!=', 0)->find_all()->as_array(); ?>
            
            <tr class="success">
                <td colspan="2"><?php echo ucwords($available_plan)." Users"; ?></td>
            </tr>

            <?php if(!empty($user_plans)) { ?>
                <?php foreach($user_plans as $user_plan) { ?>
                    <tr>
                        <td>
                            <a href="<?php echo url::base().$user_plan->user->username; ?>">
                                <?php echo $user_plan->user->user_detail->first_name ." ".$user_plan->user->user_detail->last_name;?>
                            </a>
                        </td>
                        <td><?php echo date('j M, Y', strtotime($user_plan->plan_expires));?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td class="textCenter" colspan="2"><b>No User</b></td>
                </tr>
            <?php } ?>
        <?php } ?>
        
    </table>
    
    <div class="page_footer" style="text-align: center;">
        <img style="display:none;" src="<?php echo url::base()."img/ajax-loader.gif"?>" id="loading"/>
    </div>

</div>
