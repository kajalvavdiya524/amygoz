<?php $session_user = Auth::instance()->get_user(); ?>
<?php
$messages = ORM::factory('message')
        ->where('parent_id', '=', 0)
        ->where_open()
        ->where_open()
        ->where('to', '=', $session_user->id)
        ->where('to_deleted', '=', 0)
        ->where_close()
        ->or_where_open()
        ->where('from', '=', $session_user->id)
        ->and_where('from_deleted', '=', 0)
        ->or_where_close()
        ->where_close()
        ->order_by('replied_at', 'desc')
        ->order_by('time', 'desc')
        ->limit(3)
        ->find_all()
        ->as_array();

$sent = '';
?>
<?php if (!empty($messages) || empty($messages)) { ?>
 <?php $res= ORM::factory('user')->with('user_detail')->where('username','=',Request::current()->param('id'))->find_all()->as_array();
    foreach($res as $ress)
    {
        if($ress->is_blocked == 0)
        {
            $url=url::base().$ress->username;
            $name = "<a href='$url'>".$ress->user_detail->first_name." ".$ress->user_detail->last_name."</a>";
        }
        else
        {
           $name="Callitme User" ;
        }
    }
    ?>
<?php $other_person =  Auth::instance()->get_user(); ?>
    
<?php if ($other_person != $res) { ?>
   <div class="row" style="margin: -45px;margin-top: -16px;margin-bottom:50px;background: #fff;">
                   <a href="<?php echo url::base()."messages";?>"><img class="web-sizing" alt="Callitme logo" src="https://www.callitme.com/mobile/img/callitme-arrow.png" style="position: relative;top: 8px;left: 25px;"></a> 
                    <p style="font-size: 16px;color: black;font-weight: 500;text-align: center;margin-top: -16px;">Send a message</p>
                    <hr/>
                    <form role="form" class="text-right" method="post" action="<?php echo url::base(); ?>messages/compose">

                        <?php $send_user= ORM::factory('user')->with('user_detail')->where('username','=',Request::current()->param('id'))->find_all()->as_array();
                            foreach($send_user as $send_user_email)
                            {
                                    $send_user_email = $ress->user_detail->first_name." ".$ress->user_detail->last_name;
                                    $send_email = $ress->email;
                            }
                            ?>

                        <div class="form-group text-left" style="position:relative;">
                        <input style="border: none;box-shadow: none;border-bottom: 1px solid #eee;border-radius: 0px;font-size: 17px;" class="find_user form-control" type="text" name="first_name" placeholder="Type full email address here..." autocomplete='off'
                    value="<?php echo (isset($send_user) ? $send_user_email  : Request::current()->post('first_name')); ?>"
                    <?php if(isset($send_user)) { ?> readonly="readonly" <?php }?> >

                     <input  class="find_user form-control" type="hidden" name="email"
                    value="<?php echo (isset($send_user) ? $send_email  : Request::current()->post('email')); ?>"
                    <?php if(isset($send_user)) { ?> readonly="readonly" <?php }?> >
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
<?php } ?> 
<?php } else { ?>
    <div class="post friend" style="width:160px;">
        <p class="text-center" style="color : black;">No messages.</p>
    </div>
<?php } ?>