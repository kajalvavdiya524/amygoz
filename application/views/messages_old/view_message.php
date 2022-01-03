<div class="main-content-up-block">
    <?php echo View::factory('messages/menu', array('submenu' => '')); ?>
    
    <input type="hidden" value="view_message" id="page_name" />
    <input type="hidden" value="<?php echo Request::current()->param('id');?>" id="username" />
</div>

<div class="scroll-sec" id="msg-scroll">
    <div class="messages-block">

        <fieldset class="fieldset">
            <legend>
                <a href="<?php echo url::base().$username_to;?> "><?php 
                    echo $message->owner->user_detail->first_name." ". $message->owner->user_detail->last_name;/*(($message->owner->user_detail->first_name." ".) ? 
                        ($message->owner->user_detail->first_name) : 
                        ($message->owner->email));*/
               
                ?></a>
            </legend>

            <div class="messages">
                <?php foreach($message->conversations->find_all()->as_array() as $conversation) { ?>

                    <div class="view-message post collapse-box">

                        <div class="collapse-header">
                            <div class="user-img pull-left">
                                <a href="<?php echo url::base().$conversation->owner->username; ?>">
                                    <?php if($conversation->owner->photo->profile_pic_s) { ?>
                                        <img src="<?php echo url::base().'upload/'.$conversation->owner->photo->profile_pic_s;?>">
                                    <?php } else { ?>
                                        <img src="<?php echo url::base().'img/no_image_m.png' ?>" />
                                    <?php } ?>
                                </a>
                            </div>
                            
                            <span class="post-time pull-right dis-block">
                                <?php 
                                    $age = time() - strtotime($conversation->time); 
                                    if ($age >= 86400) {
                                        echo date('jS M', strtotime($conversation->time));
                                    } else {
                                        echo date::time2string($age);
                                    }
                                ?>

                                <?php if($conversation->owner->id === Auth::instance()->get_user()->id) { ?>
                                    <input type="hidden" value="<?php echo strtotime($conversation->time); ?>" class="message_time" />
                                <?php } else { ?>
                                    <input type="hidden" value="<?php echo strtotime($conversation->time); ?>" class="message_time other-user-time" />
                                <?php } ?>
                            </span>
                            
                            <div class="post-content">
                                <div class="post-title">
                                    <strong>
                                        <?php echo ($conversation->owner->user_detail->first_name) ? 
                                            $conversation->owner->user_detail->first_name ." ".$conversation->owner->user_detail->last_name : 
                                            $conversation->owner->email;
                                        ?>
                                    </strong>
                                </div>
                                
                                <div class="post-matter collapse-description collapseable collapse">
                                    <p><?php echo substr($conversation->message, 0, 70);?>
                                        <span class="read-more" style="color:#01BF01;cursor:pointer"> <i> ...read more</i> </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="collapse-body collapseable in">
                            <div class="collapse-body-content">
                                <p><?php echo nl2br($conversation->message);?></p>
                            </div>
                        </div>
                    
                    </div>
                <?php } ?>

                <?php $other_person  = ($message->owner->id != Auth::instance()->get_user()->id) ?
                            $message->owner : $message->message_to; 
                ?>

                <form id="reply-msg" action="<?php echo url::base()."messages/reply/"; ?>" method="post" role="form" class="marTop20 validate-form">

                    <div class="msg-loader marBottom10 textCenter" style="display:none;">
                        <img src="<?php echo url::base(); ?>img/loader.gif" />
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="to" 
                        value="<?php echo $other_person->id; ?>">
                        <textarea class="required form-control" id="reply" name="reply" placeholder="Type your message here and press enter"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-secondary">Reply</button>
                </form>
            </div>

        </fieldset>

    </div>
</div>