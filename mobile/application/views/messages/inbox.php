<!--<div class="main-content-up-block">    <?php //echo
View::factory('messages/menu', array('submenu' => 'messages'));
?></div>-->     
<div class="compose-box">    
    <?php if(Session::instance()->get('error')) {?>  
  <div class="alert alert-danger">
  <strong>Error !</strong>
<?php echo Session::instance()->get_once('error');?>
</div>   
<?php } ?>
 <?php

if(Session::instance()->get('success')) {?>
<div class="alert alert-success">   
<strong>SUCCESS </strong> 
<?php echo Session::instance()->get_once('success');?>  
 </div>
 <?php }
?>                     
 <fieldset class="fieldset">
<legend> Inbox Message</legend>
     <?php $session_user = Auth::instance()->get_user();?>
 <?php
 $flag=0;
    $messages_p = ORM::factory('message')
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
              ->limit(1)
            ->find_all()
            ->as_array();


    foreach($messages_p as $msg)
     {
        $username_p= $msg->owner->username ;
         $flag=1;

     }

if($flag==1)
{
 $user = Auth::instance()->get_user();
 $user_to = ORM::factory('user', array('username' => $username_p));
 $message = ORM::factory('message')->get_conversation($user, $user_to);

 if ($message->to == $user->id) {
     $message->to_unread = 0;
 } else {
     $message->from_unread = 0;
 }
 $message->save();

 $data['message'] = $message;
 $data['username_to'] =
 $username_to = $username_p;
 ?>


 </fieldset>


</div>
<h5 class="titleName">
    <a href="<?php echo url::base() . $username_to; ?> "><?php
        echo $message->owner->user_detail->first_name . " " . $message->owner->user_detail->last_name; /* (($message->owner->user_detail->first_name." ".) ?
          ($message->owner->user_detail->first_name) :
          ($message->owner->email)); */
        ?>

</h5>

<div class="clearfix"></div>

<div id="chatContainer" style=" overflow:scroll;overflow-x:hidden;max-height:400px;">
    <?php foreach ($message->conversations->order_by('time')->find_all()->as_array() as $conversation) { ?>
        <div class=" mesgSender">
            <a href="<?php echo url::base() . $conversation->owner->username; ?>">
                <?php if ($conversation->owner->photo->profile_pic_s) { ?>
                    <img alt="" class="img-responsive"
                         src="<?php echo url::base() . 'upload/' . $conversation->owner->photo->profile_pic_s; ?>">
                <?php } else { ?>
                    <div id="inset" class="xs">
                        <h1>
                            <?php echo $conversation->owner->user_detail->first_name[0] . $conversation->owner->user_detail->last_name[0]; ?>
                        </h1>
                        <!--<span><a href=""><i class="fa fa-question-circle"></i> ask photo</a></span>-->
                    </div>
                <?php } ?>
            </a>

            <div class="mesgContainer">

                <div class="row">

                    <div class="col-xs-9">

                        <h6>
                            <strong>
                                <?php
                                echo ($conversation->owner->user_detail->first_name) ?
                                    $conversation->owner->user_detail->first_name . " " . $conversation->owner->user_detail->last_name :
                                    $conversation->owner->email;
                                ?>
                            </strong>
                            <!--<small>
                            <?php //echo substr($conversation->message, 0, 70);?>
                                <span class="read-more" style="color:#01BF01;cursor:pointer">
                                    <i> ...read more</i>
                                </span>
                            </small>-->
                        </h6>

                    </div>

                    <div class="col-xs-3">

                        <h6 class="text-right">

                            <small>
                                <i class="fa fa-calendar"></i>
                                <?php
                                $age = time() - strtotime($conversation->time);
                                if ($age >= 86400) {
                                    echo date('jS M', strtotime($conversation->time));
                                } else {
                                    echo date::time2string($age);
                                }
                                ?>

                                <?php if ($conversation->owner->id === Auth::instance()->get_user()->id) { ?>
                                    <input type="hidden" value="<?php echo strtotime($conversation->time); ?>"
                                           class="message_time"/>
                                <?php } else { ?>
                                    <input type="hidden" value="<?php echo strtotime($conversation->time); ?>"
                                           class="message_time other-user-time"/>
                                <?php } ?>
                            </small>

                        </h6>

                    </div>

                </div>

                <div class="clearfix"></div>

                <p><?php echo nl2br($conversation->message); ?></p>

            </div>

            <div class="clearfix"></div>

        </div>
    <?php } ?>



    <?php
    $other_person = ($message->owner->id != Auth::instance()->get_user()->id) ?
        $message->owner : $message->message_to;
    ?>

    <form id="reply-msg" action="<?php echo url::base() . "messages/reply/"; ?>" method="post" role="form"
          class="marTop20 validate-form">

        <div class="msg-loader marBottom10 textCenter" style="display:none;">
            <img src="<?php echo url::base(); ?>img/loader.gif"/>
        </div>

        <div class="form-group">
            <input type="hidden" name="to" value="<?php echo $other_person->id; ?>">
            <textarea class="required form-control" id="reply" name="reply"
                      placeholder="Type your message here and press enter" required></textarea>
        </div>

        <button type="submit" class="btn btn-secondary" id="target">Reply</button>

    </form>


</div>
<?php }
if($flag==0){
?>
<p>
           <h4>No Message Found</h4></p>
<?php }?>


<script type="text/javascript">

    $(function () {

        $('#chatContainer').scrollTop($('#chatContainer')[0].scrollHeight).jScrollPane();

       /// $('.demo').scrollTop($('.demo')[0].scrollHeight);

    })
</script>
