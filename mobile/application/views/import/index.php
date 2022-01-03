<style>
.pad-hc-10{font-size: 17px;color:black;font-weight: 400;}
.pardric-pad{border-top: 1px solid #eaeaea;padding-top: 7px;margin-bottom: 17px;}
</style>
<div class="row" style="margin-top: 10px;">
    <div class="col-sm-12">
        <div class="">
            <div class="">
                <p class="pad-hc-10 text-center">See who you already know here</p>
                <form class="form-inline" method="post" action="<?php echo URL::base(); ?>members/search_results">
                    <div class="form-group">
                        <input type="text" class="form-control" name="first_name"id="firstname" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="last_name" id="lasttname" placeholder="Last Name">
                    </div>
                    <button type="submit" class="btn btn-default" style="width: 100%;background: #fafafa;border: 1px solid #2095a7;color: #1e97a9;">Search</button>
                </form>
            </div>
        </div>
        
        <div class="" style="margin-top: 11px;">
            <div class="">
                <p class="pad-hc-10 text-center">Import your email contacts</p>

                <div class="row">
                    <div class="col-xs-12 text-center">
                        <?php 
                            $gmail_client_id = Kohana::$config->load('contact')->get('gmail_client_id');
                            $gmail_redirect_uri = Kohana::$config->load('contact')->get('gmail_redirect_uri');
                        ?>

                        <a href="https://accounts.google.com/o/oauth2/auth?client_id=<?php echo $gmail_client_id;?>&redirect_uri=<?php echo $gmail_redirect_uri;?>&scope=https://www.google.com/m8/feeds/&response_type=code">
                            <img src="<?php echo url::base()."img/gmail.png";?>" class="center-block" style="margin: 0px auto;"/>
                        </a>
                    </div>
                    <div class="col-xs-12 text-center">
                        <?php 
                            $hotmail_client_id = Kohana::$config->load('contact')->get('hotmail_client_id');
                            $hotmail_redirect_uri = Kohana::$config->load('contact')->get('hotmail_redirect_uri');
                        ?>
                        <a href="https://login.live.com/oauth20_authorize.srf?client_id=<?php echo $hotmail_client_id;?>&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri=<?php echo $hotmail_redirect_uri;?>">
                            <img src="<?php echo url::base()."img/hotmail.png";?>" class="center-block" style="margin: 0px auto;"/>
                        </a>
                    </div>
                    <div class="col-xs-12 text-center">
                        <a href="<?php echo url::base()."contactapi/get_yahoo_list";?>">
                            <img src="<?php echo url::base()."img/yahoo.png";?>" class="center-block" style="margin: 0px auto;"/>
                        </a>
                    </div>
                </div>
                
                <div class="" style="margin-top: 24px;">
                    <fieldset class="fieldset">
                        <p class="pad-hc-10 text-center">Invite friends by email</p>

                         <?php if(isset($msg)) {?>
                            <div class="alert alert-error">
                               <strong>ERROR!</strong>
                               <?php echo $msg;?>
                            </div>
                        <?php } else if(Session::instance()->get('success')) {?>
                            <div class="alert alert-success">
                               <strong>SUCCESS </strong>
                               <?php echo Session::instance()->get_once('success');?>
                            </div>
                        <?php } ?>

                        <?php if(Session::instance()->get('already')) {
                            $already = Session::instance()->get_once('already');
                        ?>
                            <p class="text-success">This member is registered in Amygoz</p>
                            <?php foreach($already as $al_reg) { 
                                $al_reg = ORM::factory('user', $al_reg);
                            ?>
                                <div class="pardric-pad container">
                                <div class="col-xs-2">
                                    <center> 
                                         <div id="imagePreview" style="top:3px;right:15px;">
                                        <a href="<?php echo url::base().$al_reg->username; ?>">
                                            <?php if($al_reg->photo->profile_pic_m) { ?>
                                                <img src="<?php echo url::base()."upload/".$al_reg->photo->profile_pic;?>" height="100%">
                                            <?php } else { ?>
                                                <div id="inset" class="xs hb-mt-0">
                                                    <h1>
                                                        <?php echo $al_reg->user_detail->first_name[0].$al_reg->user_detail->last_name[0]; ?>
                                                    </h1>
                                                    <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                                                </div>
                                            <?php } ?>
                                        </a>
                                    </div>
                                    </center>
                                    </div>

                                    
                                    <div class="col-xs-10">
                                    <div class="post-content">
                                        <!--<div class="post-title">-->
                                        <div>
                                            <strong>
                                                <a href="<?php echo url::base().$al_reg->username; ?>">
                                                    <?php echo $al_reg->user_detail->first_name." ".$al_reg->user_detail->last_name; ?>
                                                </a>
                                            </strong>
                                        </div>

                                        <div class="post-matter collapse-description collapseable in">
                                            <p>
                                                <?php
                                                    $details = array();
                                                    if(!empty($al_reg->user_detail->location)) {
                                                        $details[] = $al_reg->user_detail->location;
                                                    }

                                                    if(!empty($al_reg->user_detail->sex)) {
                                                        $details[] = $al_reg->user_detail->sex;
                                                    }

                                                    if(!empty($al_reg->user_detail->phase_of_life)) {
                                                        $phase_of_life = Kohana::$config->load('profile')->get('phase_of_life');
                                                        $details[] = $phase_of_life[$al_reg->user_detail->phase_of_life];
                                                    }

                                                    echo implode(', ', $details);
                                                ?>
                                            </p>

                                        </div>
                                    </div>
                                    </div>
                                    <div class="friend-actions request_action" style="text-align: center;margin-bottom: 14px;">
                                        <?php echo View::factory('members/friend_button', array('user' => $al_reg, 'block' => true)); ?>
                                    </div>
                                    <div style="clear:right;"></div>

                                </div>
                            <?php } ?>
                        <?php } ?>

                        <form role="form" class="validate-form" method="post" action="<?php echo url::base()."import/invite"; ?>">
                            <div class="form-group">
                                <label class="control-label" for="email">
                                    Email address

                                    <small class="text-muted dis-block">
                                        Enter multiple E-mail seperated by ; (semi-colon)
                                    </small>
                                </label>
                                <input type="text" class="required form-control" id="email" name="email" placeholder="Enter email">
                            </div>

                            <button type="submit" class="btn" style="width: 100%;background: white;border: 1px solid #2094a5;color: #1e97a9;margin-bottom: 20px;">Invite</button>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
