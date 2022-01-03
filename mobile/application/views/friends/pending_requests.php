<style>
    #imagePreview {
        width: 50px;
        height: 50px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
        margin-top: 3px;
        position: relative;
        top: 2px;
        right: 9px;
        overflow: hidden;
        background-color: white;
    }
</style>
<?php $session_user = Auth::instance()->get_user(); ?>
<div class="row" style="background: rgba(221, 221, 221, 0.31);padding: 8px 0px 10px 0px;">
    <div class="col-xs-12" style="/*margin: 10px 8px 10px 12px;*/"> 
        <div class="friends-block hb-p-0">
            <div class="friends">
                <?php if (Session::instance()->get('error')) { ?>
                    <div class="alert alert-danger">
                        <strong>ERROR!</strong>
                        <?php echo Session::instance()->get_once('error'); ?>
                    </div>
                <?php } else if (Session::instance()->get('Accepted')) { ?>
                    <div class="alert alert-success">
                        <strong>SUCCESS </strong>
                        <?php echo Session::instance()->get_once('Accepted'); ?>
                    </div>
                <?php } ?>
                <?php if (!empty($requests)) { ?>
                    <?php foreach ($requests as $request) { ?>
                        <div class="post">
                            <div class="row">
                                <div class="col-xs-2">
                                    <center>
                                        <div id="imagePreview">
                                            <a href="<?php echo url::base() . $request->user->username; ?>">
                                                <?php if ($request->user->photo->profile_pic) { ?>
                                                    <img src="<?php echo url::base() . "upload/" . $request->user->photo->profile_pic; ?>" height="100%">
                                                <?php } else { ?>
                                                    <div id="inset" class="xs hb-mt-0">
                                                        <h1>
                                                            <?php echo $request->user->user_detail->get_no_image_name(); ?>
                                                        </h1>
                                                    </div>
                                                <?php } ?>
                                            </a>
                                        </div>
                                    </center>
                                </div>
                                
                                <div class="col-xs-10">
                                    <div class="post-content">
                                        <div class="">
                                            <strong>
                                                <a href="<?php echo url::base() . $request->user->username; ?>">
                                                    <?php echo $request->user->user_detail->first_name . " " . $request->user->user_detail->last_name; ?>
                                                </a>
                                            </strong>
                                        </div>
                                        <div class="post-matter collapse-description collapseable in">
                                            <p style="font-weight: 400;">
                                                <?php
                                                    $details = array();
                                                    if (!empty($request->user->user_detail->location)) {
                                                        $b = explode(',', $request->user->user_detail->location);
                                                        if(!empty($b[0]) && !empty($b[2])) {
                                                            $details[] = $b[0].", ".$b[2];
                                                        } else if(!empty($b[0])) {
                                                            $details[] = $b[0];
                                                        } else {
                                                            $details[] =  $b[2];
                                                        }
                                                    }
                                                    if (!empty($request->user->user_detail->sex)) {
                                                        $details[] = $request->user->user_detail->sex;
                                                    }
                                                    if (!empty($request->user->user_detail->phase_of_life)) {
                                                        $phase_of_life = Kohana::$config->load('profile') ->get('phase_of_life');
                                                        $details[] = $phase_of_life[$request->user->user_detail->phase_of_life];
                                                    }
                                                    echo implode(', ', $details);
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <form class="respond-friend-form dis-inline "
                                                  action="<?php echo url::base() . "friends/accept_friend"; ?>"
                                                  method="post">
                                                <input type="hidden" name="friend_id" value="<?php echo $request->user->id; ?>"/>   
                                                <button type="submit" class="btn" style="width: 100%;background: #11a7bc;color: #fff;border-radius: 10px;">Accept</button>
                                            </form>
                                        </div>
                                        <div class="col-xs-6">
                                            <form class="respond-friend-form dis-inline "
                                                  action="<?php echo url::base() . "friends/reject_request"; ?>"
                                                  method="post">
                                                <input type="hidden" name="friend_id"
                                                       value="<?php echo $request->user->id; ?>"/>
                                                <button type="submit" class="btn" style="width: 100%;color: black;border: 2px solid rgba(220, 217, 217, 0.45);border-radius: 7px;">Reject</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="">
                        <div class="">
                            </br>
                            <h4 class="text-center">No Pending Friend Requests</h4>
                            </br>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>