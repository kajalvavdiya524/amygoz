 <?php if (Session::instance()->get('error')) { ?>
                        <div class="alert alert-danger">
                            <strong>Error !</strong>
                            <?php echo Session::instance()->get_once('error'); ?>
                        </div>
                    <?php } ?>
    <div class="row" style="margin: -45px;margin-top: -16px;margin-bottom:50px;background: #fff;">
                   <a href="<?php echo url::base()."messages";?>"><img class="web-sizing" alt="Callitme logo" src="https://www.callitme.com/mobile/img/callitme-arrow.png" style="position: relative;top: 8px;left: 25px;"></a> 
                    <p style="font-size: 17px;color: black;font-weight: 500;text-align: center;margin-top: -16px;">Send a message</p>
                    <hr/>
                    <form role="form" class="text-right" method="post" action="<?php echo url::base(); ?>messages/newsend">

                        <?php
                        if (Request::current()->query('user')) {
                            $send_user = ORM::factory('user', array('username' => Request::current()->query('user')));
                        }
                        ?>

                        <div class="form-group text-left" style="position:relative;">
                        <input style="border: none;box-shadow: none;border-bottom: 1px solid #eee;border-radius: 0px;font-size: 17px;" class="find_user form-control" type="text" name="first_name" placeholder="Enter Name" autocomplete='off'
                    value="<?php echo (isset($send_user) ? $send_user->user_detail->first_name." ".$send_user->user_detail->last_name  : Request::current()->post('first_name')); ?>"
                    <?php if(isset($recommend)) { ?> disabled="disabled" <?php }?> >
                           <div id="message-suggestion" class="registered_users well-sm">

                            </div>
                        </div>
                        <footer>
                        <div class="form-group text-left" style="margin-top: 120px;margin-bottom: 60px;">
                            <!--<p class="control-label" for="message" style="font-size: 17px;color: black;padding-left: 10px;font-weight: 400;">And, what do you want to say?</p>-->
                            <textarea class="required form-control" id="message" name="message" rows="2" placeholder="Type your message here and click on the send button below..." style="border: none;box-shadow: none;border-top: 2px solid #179fb3;border-radius: 0px;"></textarea>
                        </div>

                        <button type="submit" class="btn" style="background: none;color: #199db1;position: relative;top: -22px;font-size: 18px;font-weight: 800;margin-right: 20px;">Send</button>
                        </footer>
                    </form>
    </div>
  