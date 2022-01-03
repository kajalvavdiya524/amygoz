<input type="hidden" value="view_message" id="page_name" />
<input type="hidden" value="<?php echo Request::current()->param('id'); ?>" id="username" />


<?php $res= ORM::factory('user')->with('user_detail')->where('username','=',Request::current()->param('id'))->find_all()->as_array();

    foreach($res as $ress)
    {
        if($ress->is_blocked == 0)
        {
            $url=url::base().$ress->username;
            $name = "<a href='$url'>".$ress->user_detail->first_name." ".$ress->user_detail->last_name."</a>";
        }else{
           $name="Callitme User" ;
        }
        
    }
    ?>
<h4 class="titleName"> Conversation with <?php  echo $name;?>
</h4>


<?php
        $other_person = ($message->owner->id != Auth::instance()->get_user()->id) ?
                $message->owner : $message->message_to;
        ?>



<?php if(count($message->conversations->order_by('id','DESC')->find_all()->as_array()) > 4) { ?>
<hr>
<a href = "#" id="s_o_m" ><h5>See older messages...</h5></a>
<div id="load_er" style="display: none;"><img style="margin-left:50%" src="<?php echo url::base()."img/load_er.gif"?>"></div>
<?php } ?>
<div id="nomsg"></div>

<div id="chatContainer" style="overflow:scroll;overflow-x:hidden;max-height:500px;" >
    <div id="res"></div>
    <?php foreach (array_reverse($message->conversations->order_by('id','DESC')->limit(4)->find_all()->as_array()) as $conversation) { ?>
        <input type="hidden" id="valu" value="<?php echo $conversation->id; ?>">
        <input type="hidden" id="other_person" value="<?php echo $other_person->username; ?>">
        
     <?php if($conversation->owner->is_blocked == 0 ) { ?> <!-- this is check for blocked user or not. "if user is not blocked "-->
        <div class=" mesgSender marTop20">
            <a href="<?php echo url::base() . $conversation->owner->username; ?>">
                <?php 
                    $photo = $conversation->owner->photo->profile_pic_s;
                    $con_image = file_exists("mobile/upload/" .$photo);
                    $con_image1 = file_exists("upload/" .$photo);
                if (!empty($photo) && $con_image) { ?>
                    <img alt="" class="img-responsive" src="<?php echo url::base() . 'mobile/upload/' . $conversation->owner->photo->profile_pic_s; ?>" alt="<?php echo $conversation->owner->user_detail->first_name." ".$conversation->owner->user_detail->last_name;?>">
                <?php }
                else if (!empty($photo) && $con_image1) { ?>
                    <img alt="" class="img-responsive" src="<?php echo url::base() . 'upload/' . $conversation->owner->photo->profile_pic_s; ?>" alt="<?php echo $conversation->owner->user_detail->first_name." ".$conversation->owner->user_detail->last_name;?>">
                <?php } else { ?>
                    <div id="inset" class="xs">
                        <h1>
                            <?php echo $conversation->owner->user_detail->get_no_image_name(); ?>
                        </h1>
                    </div>
                <?php } ?>
            </a>

            <div class="mesgContainer marTop203">
                <div class="row">
                    <div class="col-xs-9">
                        <h6>
                            <strong>
                                <?php
                                echo ($conversation->owner->user_detail->first_name) ?
                                        $conversation->owner->user_detail->first_name. " " . $conversation->owner->user_detail->last_name :
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
                                <i class="fa fa-clock-o"></i>
                                <?php
                                $age = time() - strtotime($conversation->time);
                                if ($age >= 86400) {
                                    echo date('jS M', strtotime($conversation->time));
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

                        </h6>

                    </div>

                </div>

                <div class="clearfix"></div>

                <p><?php echo nl2br($conversation->message); ?></p>

            </div>

            <div class="clearfix"></div>

        </div>
        <?php } else { ?><!-- if user is blocked -->

        <div class=" mesgSender marTop20">
            <img alt="" class="img-responsive" src="<?php echo url::base() . 'img/logo-sm.png'; ?>">
                
            <div class="mesgContainer marTop20">
                <div class="row">
                    <div class="col-xs-9">
                        <h6>
                            <strong>
                                <?php echo "Callitme User";?>
                            </strong>
                        </h6>

                    </div>

                    <div class="col-xs-3">
                        <h6 class="text-right">
                            <small>
                                <i class="fa fa-clock-o"></i>
                                <?php
                                $age = time() - strtotime($conversation->time);
                                if ($age >= 86400) {
                                    echo date('jS M', strtotime($conversation->time));
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

                        </h6>

                    </div>

                </div>

                <div class="clearfix"></div>

                <p><?php echo nl2br($conversation->message); ?></p>

            </div>

            <div class="clearfix"></div>

        </div>
        <?php }?>
    <?php } ?>



        
        <?php if($other_person->is_blocked == 0) { ?>
        <form id="reply-msg" action="<?php echo url::base() . "messages/reply/"; ?>" method="post" role="form" class="marTop20 validate-form">

            <div class="msg-loader marBottom10 textCenter" style="display:none;">
                <img src="<?php echo url::base(); ?>img/load_er.gif" />
            </div>

            <div class="form-group">
                <input type="hidden" name="to" value="<?php echo $other_person->id; ?>">
                <textarea class="required form-control" id="reply" name="reply" placeholder="Type your message here and press enter" required></textarea>
            </div>

            <button type="submit" class="btn btn-secondary" id="target" >Reply</button>

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

    $(function () {

        $('#chatContainer').scrollTop($('#chatContainer')[0].scrollHeight).jScrollPane();

        $('#reply').focus();

    })

</script>

