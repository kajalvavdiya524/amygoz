<div class="container">

    <div class="static-pages-not bubble shadow row">
    
        <div class="col-md-12 marBottom20">
            <fieldset class="fieldset">
                <legend style="padding-bottom:10px;">
                    Search Results
                    <?php if(Request::current()->query('q')) {
                        echo ' for '.Request::current()->query('q');
                    } ?>
                </legend>

                <div class="fieldset-actions" style="position: absolute; top: 0px; right: 15px;">
                    <form class="form-inline" method="get">
                        <div class="input-group" style="padding:0px;">
                            <input type="text" name="q" placeholder="Search for people" class="form-control" value="<?php echo Request::current()->query('q'); ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-transparent" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="friends-block" style="border-top:none;">

                    <div class="friends">
                        <?php if(!empty($users)) { ?>
                            <?php foreach($users as $user) { ?>
                                <div class="post friend">

                                    <div class="user-img pull-left">
                                        <a href="<?php echo url::base().$user->username; ?>">
                                            <?php if($user->photo->profile_pic_s) { ?>
                                                <img src="<?php echo url::base()."upload/".$user->photo->profile_pic_s;?>">
                                            <?php } else { ?>
                                                <img src="<?php echo url::base()."img/no_image_s.png";?>">
                                            <?php } ?>
                                        </a>
                                    </div>
                                    
                                    <div class="friend-actions request_action pull-right">
                                        <a class="btn btn-secondary" href="<?php echo url::base().$user->username; ?>">
                                            <span class="glyphicon glyphicon-eye-open" style="top:2px;"></span> View Profile
                                        </a>
                                    </div>

                                    <div class="post-content">
                                        <div class="post-title">
                                            <strong>
                                                <a href="<?php echo url::base().$user->username; ?>">
                                                    <?php echo $user->user_detail->first_name." ".$user->user_detail->last_name; ?>
                                                </a>
                                            </strong>
                                        </div>
                                        
                                        <div class="post-matter collapse-description collapseable in">
                                            <p>
                                            <?php
                                                $details = array();
                                                if(!empty($user->user_detail->location)) {
                                                    $details[] = $user->user_detail->location;
                                                }
                                                
                                                // if(!empty($user->user_detail->sex)) {
                                                //     $details[] = $user->user_detail->sex;
                                                // }
                                                
                                                // if(!empty($user->user_detail->phase_of_life)) {
                                                //     $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                                //     $details[] = $phase_of_life[$user->user_detail->phase_of_life];
                                                // }
                                                
                                                echo implode(', ', $details);
                                            ?>
                                        </p>
                                        </div>
                                    </div>

                                    <div style="clear:both;"></div>

                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <h4 class="text-center"> No result found for this search. </h4>
                        <?php } ?>

                    </div>

                </div>
            </fieldset>
        </div>
    </div>
</div>