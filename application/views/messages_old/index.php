<?php $session_user = Auth::instance()->get_user();?>


<div class="scroll-sec">
    <div class="messages-block" style="padding:5px;text-align:center">

        <div class="messages" >
            
            <h4 style="color:#096369; width:100%; margin-bottom:15px;" class='btn btn-primary'>Inbox</h4>
            
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
                    ->find_all()
                    ->as_array();
               
                echo View::factory('messages/ajax_messages', array('messages' => $messages)); 
            ?>
        </div>
        
    </div>

</div>