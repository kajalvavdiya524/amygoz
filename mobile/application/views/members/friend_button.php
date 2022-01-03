<?php $session_user = Auth::instance()->get_user(); ?>
<?php if($session_user->id != $user->id) { ?>
    <?php if($session_user->check_friends($user)) { ?>
                    <!--remove friends from your friend's list->
        <!-- <form class="add-friend-form" action="<?php echo url::base()."friends/delete_friend"?>" method="post">
            <input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>
            <button type="submit" class="btn btn-secondary <?php echo (!isset($block) ? 'btn-block' : 'btn-sm' ); ?> friend-btn">
                <span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp;<span class="btn-text">Friend</span>
            </button>
        </form> -->

    <?php } else if($session_user->has('requests', $user)) { ?>
        
        <form class="add-friend-form" action="<?php echo url::base()."friends/add_friend"?>" method="post">
            <input type="hidden" name="del_request" value="<?php echo $user->id;?>"/>
            <button type="submit" class="btn <?php if(!isset($block)) {?>btn-block<?php } ?> request-btn" style="background: #fafafa;color: #1c99ab;border: 1px solid #1c99ab;margin: 0px auto;">
                <span class="glyphicon glyphicon-send"></span> &nbsp;&nbsp;<span class="btn-text">Friend Request Sent</span>
            </button>
        </form>
        
    <?php } else if($user->has('requests', $session_user)) { ?>

        <a href="<?php echo url::base()."friends/requests";?>" role="button" class="btn <?php if(!isset($block)) {?>btn-block<?php } ?> respond-btn" title="Respond to request" data-backdrop="static" data-toggle="modal" style="background: #fafafa;color: #1c99ab;border: 1px solid #1c99ab;margin: 0px auto;">
            <span class="glyphicon glyphicon-share-alt"></span> &nbsp;&nbsp;<span class="btn-text">Respond to Request</span>
        </a>

        <div class="ribbion-modal modal fade" id="respond-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <img src="<?php echo url::base(); ?>img/close.png" />
                        </button>
                        <div class="ribbion">
                            <h2>Response Required</h2>
                        </div>
                        <div class="triangle-l"></div>
                        
                        <div class="clearfix"></div>
                    </div>

                    <div class="modal-body">
                        <h4>Do you want to be friend with '<?php echo $user->user_detail->first_name; ?>'?</h4>
                    </div>

                    <div class="modal-footer">
                        <form class="respond-friend-form dis-inline " action="<?php echo url::base()."friends/accept_friend";?>" method="post">
                            <input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>
                            <button type="submit" class="btn btn-secondary">
                                <span class="glyphicon glyphicon-thumbs-up"></span> &nbsp;&nbsp;Accept
                            </button>
                        </form>
                        <form class="respond-friend-form dis-inline " action="<?php echo url::base()."friends/reject_request";?>" method="post">
                            <input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-thumbs-down"></span> &nbsp;&nbsp;Reject
                            </button>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
                
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    <?php } else { ?>
        
        <form class="add-friend-form" action="<?php echo url::base()."friends/add_friend"?>" method="post">
            <input type="hidden" name="friend_id" value="<?php echo $user->id;?>"/>
            <button type="submit" class="btn <?php if(!isset($block)) {?>btn-block<?php } ?> add-friend-btn" style="background: #fafafa;color: #1c99ab;border: 1px solid #1c99ab;margin: 0px auto;">
                <span class="glyphicon glyphicon-plus"></span> &nbsp;&nbsp;<span class="btn-text">Add as a friend</span>
            </button>
        </form>
        
    <?php } ?>
<?php } ?>