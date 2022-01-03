<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<style>
#imagePreview {
    width: 45px;
    height: 45px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    position: relative;top: 6px;right:-1px;overflow: hidden; background-color: white;
    /*border-radius: 50%;*/
}
</style>
<input type="hidden" value="view_message" id="page_name" />
<input type="hidden" value="<?php echo Request::current()->param('id'); ?>" id="username" />
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
<?php
    $other_person = ($message->owner->id != Auth::instance()->get_user()->id) ?
    $message->owner : $message->message_to;
?>

<div class="row" style="padding: 0px;margin: -28px;margin-top: 14px;">
<div class="row" style="margin-top: -19px;padding: 6px;">
<p style="font-size: 16px;font-weight:400; " class="titleName"><a href="<?php echo url::base()."messages";?>"/><img class="web-sizing" alt="Callitme logo" src="https://www.callitme.com/mobile/img/callitme-arrow.png" style="position: relative;top: 0px;"></a> <span style="color:black;"> Conversation with</span> <?php  echo $name;?>
</p>
</div>


<?php if(count($message->conversations->order_by('id','DESC')->find_all()->as_array()) > 4) { ?>
<hr style="margin-top: -8px;margin-bottom: 10px;">
<a href = "#" id="s_o_m" ><h4 style="margin-top: -5px;font-size: 16px;">See older messages...</h4></a>
<hr style="margin-top: 0px;margin-bottom: 9px;">
<div id="load_er" style="display: none;"><img style="margin-left:50%" src="<?php echo url::base()."img/load_er.gif"?>"></div>
<?php } ?>
<div id="nomsg"></div>
 <div id="res"></div>
<div id="chatContainer">
       <?php foreach (array_reverse($message->conversations->order_by('id','DESC')->limit(4)->find_all()->as_array()) as $conversation) { ?>
        <input type="hidden" id="valu" value="<?php echo $conversation->id; ?>">
        <input type="hidden" id="other_person" value="<?php echo $other_person->username; ?>">
        
     <?php if($conversation->owner->is_blocked == 0 ) { ?> <!-- this is check for blocked user or not. "if user is not blocked "-->

        <div class="ui-grid-a messageList">
        <div class="row" style="border-bottom: 1px solid #eee;margin-bottom: 5px;">
        <div class="col-xs-2">
        <center>
        <div id="imagePreview">
            <a href="<?php echo url::base() . $conversation->owner->username; ?>">
                <?php if ($conversation->owner->photo->profile_pic_s) { ?>
                    <img alt="" src="<?php echo url::base()."upload/".$conversation->owner->photo->profile_pic; ?>" alt="<?php echo $conversation->owner->user_detail->first_name." ".$conversation->owner->user_detail->last_name;?>" height="100%">
                <?php } else { ?>
                    <div id="inset" class="xs" style="margin-top: 0px;">
                        <h1>
                            <?php echo $conversation->owner->user_detail->get_no_image_name(); ?>
                        </h1>
                    </div>
                <?php } ?>
            </a>
            </div>
         </center>
            </div>
                        <div class="col-xs-10" style="position: relative;left: 3px;">
                        <div class="messageWrap">
                                    <p class="hb-mb-0" style="font-size:16px;font-weight: 600;color: #f06292;">
                                <?php
                                echo ($conversation->owner->user_detail->first_name) ?
                                        $conversation->owner->user_detail->first_name. " " . $conversation->owner->user_detail->last_name :
                                        $conversation->owner->email;
                                ?>
                                </p>
                                 <p style="font-size: 16px;font-weight: 500; color: black;">
                                   
                                    <?php echo nl2br($conversation->message); ?>  
                                </p>
                                 <small class="pull-left" style="font-size: 13px; color:#595757;margin-top: -9px;margin-bottom: 12px;">
                                <?php
                                $age = time() - strtotime($conversation->time);
                                if ($age >= 86400) {
                                    echo date('M j', strtotime($conversation->time));
                                } else {
                                    echo date::time2string($age);
                                }
                                ?>

                                <?php if ($conversation->owner->id === Auth::instance()->get_user()->id) { ?>
                                    <input type="hidden" value="<?php echo strtotime($conversation->time); ?>" class="message_time" />
                                <?php } else { ?>
                                    <input type="hidden" value="<?php echo strtotime($conversation->time); ?>" class="message_time other-user-time" />
                                <?php } ?>
                                </small>
                </div>
                <div class="clearfix"></div>
                </div>

            <div class="clearfix"></div>
            </div>
        </div>
        <?php } else { ?><!-- if user is blocked -->

        <div class="ui-grid-a messageList">
        <div class="">
        <div class="pictureWrap">
            <img alt="" class="img-responsive" src="<?php echo url::base() . 'img/logo-sm.png'; ?>">
            </div>
                
                        <div class="messageWrap">
                                    <p class="hb-mb-0" style="font-size:18px">
                                <?php echo "Callitme User";?>
                            
                            <small class="pull-right" style="font-size: 12px; color:#595757;">
                                <?php
                                $age = time() - strtotime($conversation->time);
                                if ($age >= 86400) {
                                    echo date('M j', strtotime($conversation->time));
                                } else {
                                    echo date::time2string($age);
                                }
                                ?>

                                <?php if ($conversation->owner->id === Auth::instance()->get_user()->id) { ?>
                                    <input type="hidden" value="<?php echo strtotime($conversation->time); ?>" class="message_time" />
                                <?php } else { ?>
                                    <input type="hidden" value="<?php echo strtotime($conversation->time); ?>" class="message_time other-user-time" />
                                <?php } ?>
                            </small>
                            </p>

                <p style="font-size: 16px; color: #635f5f;padding: 3px 10px 10px;"><?php echo nl2br($conversation->message); ?></p>
                <div class="clearfix"></div>
                  </div>
            <div class="clearfix"></div>
            </div>
        </div>
        <?php }?>
    <?php } ?>



        
        <?php if($other_person->is_blocked == 0) { ?>
   
        <form id="reply-msg" action="<?php echo url::base() . "messages/reply/"; ?>" method="post" role="form" class="marTop20 validate-form text-right" style="margin-bottom: 50px;">

            <div class="msg-loader marBottom10 textCenter" style="display:none;">
                <img src="<?php echo url::base(); ?>img/load_er.gif" />
            </div>

            <div class="form-group">
                <input type="hidden" name="to" value="<?php echo $other_person->id; ?>">
                <textarea style="height: 45px;width: 223px;" class="required form-control" id="reply" name="reply" placeholder="Type your message" required></textarea>
            </div>

            <button type="submit" class="btn btn-secondary" id="target" style="margin-top: -106px;">Reply</button>

        </form>

           

        <?php }else{} ?>


</div>
<script type="text/javascript">
   
   $('#s_o_m').click(function()
    {
        $('#load_er').show();
        $('#s_o_m').hide();
        var msg_id = $('#valu').val();
        var username=$('#other_person').val();
        var base_url="<?php echo url::base(); ?>";
        //alert(msg_id);
        //alert(username);
        //$( "#valu" ).remove();
        $.ajax(
        {
            type: "get",
            url: base_url+"messages/load_older_msg",
            data: {msg_id: msg_id, username: username},
            //cache: false, 
            success: function(result)
            {
                //alert(result);
                if(!$.trim(result))
                {
                    //alert("asdsadsad");
                    $('#load_er').hide();
                    $("#nomsg").prepend('<h4 align="left" style="margin-bottom: 10px;"><b>No more messages...</b></h4>');
                }
                else
                {
                    //alert('yo');
                    $('#load_er').hide();
                    $('#s_o_m').show();
                    $("#res").prepend(result);

                }
            }
        });
        
    })
    
</script>
<script type="text/javascript">
    $(function () 
    {
        $('#chatContainer').scrollTop($('#chatContainer')[0].scrollHeight).jScrollPane();
        $('#reply').focus();
    })
</script>
