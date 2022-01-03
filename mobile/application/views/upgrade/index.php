<?php $session_user = Auth::instance()->get_user();?>
<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
<div class="profile-block">
    <div class="recommendations-compose upgrade-block">
        
        <fieldset class="fieldset">
            <legend>Upgrade to a plan that works for you</legend>
            
            <?php if(Session::instance()->get('error')) {?>
                <div class="alert alert-danger">
                   <strong>Error !</strong>
                   <?php echo Session::instance()->get_once('error');?>
                </div>
            <?php } ?>
            
            <?php 
                $python = Kohana::$config->load('stripe')->get('python');
                $cobra = Kohana::$config->load('stripe')->get('cobra');
                $rattle = Kohana::$config->load('stripe')->get('rattle');
            ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Plans</th>
                            <th>Free Plan</th>
                            <th>Python Plan <?php echo $python['dollar'];?></th>
                            <th>Cobra Plan <?php echo $cobra['dollar'];?></th>
                            <th>Rattle Plan <?php echo $rattle['dollar'];?></th>
                        </tr>
                    </thead>

                    <tr class="success">
                        <td colspan="5">
                            <b>Anonymous Activity Requests</b>
                        </td>
                    </tr>

                    <tr>
                        <td>Requests to Friends</td>
                        <td>20 / month</td>
                        <td><?php echo $python['r_to_friend'];?> / month</td>
                        <td><?php echo $cobra['r_to_friend'];?> / month</td>
                        <td><?php echo $rattle['r_to_friend'];?> / month</td>
                    </tr>

                    <tr>
                        <td>Requests to Anyone</td>
                        <td></td>
                        <td><?php echo $python['r_to_anyone'];?> / month</td>
                        <td><?php echo $cobra['r_to_anyone'];?> / month</td>
                        <td><?php echo $rattle['r_to_anyone'];?> / month</td>
                    </tr>

                    <tr class="success">
                        <td colspan="5">
                            <b>Friends</b>
                        </td>
                    </tr>

                    <tr>
                        <td>Message to Friends</td>
                        <td>Unlimited</td>
                        <td>Unlimited</td>
                        <td>Unlimited</td>
                        <td>Unlimited</td>
                    </tr>

                    <tr>
                        <td>Message to Anyone</td>
                        <td></td>
                        <td><?php echo $python['m_to_anyone'];?> / month</td>
                        <td><?php echo $cobra['m_to_anyone'];?> / month</td>
                        <td><?php echo $rattle['m_to_anyone'];?> / month</td>
                    </tr>

                    <?php if(empty($session_user->next_plan)) { ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="<?php echo url::base();?>upgrade/pay/python" class="btn btn-secondary upgrade_pop">Upgrade</a>
                        </td>
                        <td>
                            <a href="<?php echo url::base();?>upgrade/pay/cobra" class="btn btn-secondary upgrade_pop">Upgrade</a>
                        </td>
                        <td>
                            <a href="<?php echo url::base();?>upgrade/pay/rattle" class="btn btn-secondary upgrade_pop">Upgrade</a>
                        </td>
                    </tr>
                    <?php } ?>

                </table>

                <div class="clear"></div>
            
            </fieldset>

    </div>
</div>

<div class="ribbion-modal modal fade" id="upgrade-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <img src="<?php echo url::base(); ?>img/close.png" />
                </button>
            </div>
            
            <form action="<?php echo url::base().'upgrade/pay'; ?>" method="POST" id="payment-form" style="margin:0px;"  role="form">
                <div class="modal-body">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary submit-button">Pay</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
        
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->