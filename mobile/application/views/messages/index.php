<?php $session_user = Auth::instance()->get_user(); ?>
<script src="http://code.jquery.com/jquery-1.4.2.min.js"></script>

<div class="marTop20"></div>
<style>
    #header 
    {
        position:relative;
        line-height:1em;
    }
    .form-control {
    display: block;
    width: 100%;
    height: 30px;
    padding: 6px 12px;
    font-size: 18px;
    line-height: 1.428571429;
    color: #555555;
    vertical-align: middle;
    background-color: #ffffff;
    border-bottom: 1px solid #cccccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}

    input 
    {
        border-bottom:1px solid #ccc;
        box-sizing:border-box;
        -moz-box-sizing:border-box;
        -webkit-box-sizing:border-box;
        -ms-box-sizing:border-box;
        font-size:1em;
        height:2.25em;
        *height:1.5em;
        line-height:1.5em;
        width:100%;
    }
    .filterform 
    {
        width:100%;
        font-size:12px;
        display:block;
    }
    .filterform input 
    {
    }
</style>
<script src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
<script>

    (function ($) {
        jQuery.expr[':'].Contains = function(a,i,m){
            return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
        };

        function listFilter(header, list) {
            var form = $("<form>").attr({"class":"filterform","action":"#"}),
                input = $("<input>").attr({"class":"filterinput form-control","style":"border:none;padding-left: 32px;","type":"text","placeholder":"Search messages"});

            $(form).append(input).appendTo(header);

            $(input)
                .change( function () {
                    var filter = $(this).val();
                    if(filter) {
                        $(list).find(".mesgSender:not(:Contains(" + filter + "))").parent().slideUp();
                        $(list).find(".mesgSender:Contains(" + filter + ")").parent().slideDown();
                    } else {
                        $(list).find("li").slideDown();
                    }
                    return false;
                })
                .keyup( function () {
                    $(this).change();
                });
        }

        $(function () {
            listFilter($("#header"), $("#message_list"));
        });
    }(jQuery));

</script>
<div class="marTop20"></div>

<div id="wrap" style="margin-top: -22px;">
<p style="color: #199db1;position: relative;left: -32px;top: 12px;font-size: 17px;font-weight: 500;">Messaging</p>
<h1 id="header"></h1>
<i class="fa fa-search" aria-hidden="true" style="position: relative;top: -36px;left: 5px;color: #919191;font-size: 19px;"></i>

<hr style="margin-top: -29px;background: #cbcbcb;"/>
       <a href="<?php echo url::base() . "messages/sendmessage"; ?>"><i class="demo-icon icon-edit" style="position: relative;top: -91px;left: 236px;color: #1b9aad;font-size: 24px;"></i></a>
    <ul id="message_list" style="margin-top: -43px;margin-bottom: 40px;">
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
                    ->order_by('replied_at', 'DESC') //order of conversation
                    ->order_by('time', 'ASC')
                    ->find_all()
                    ->as_array();
            echo View::factory('messages/ajax_messages', array('messages' => $messages));
        ?>
    </ul>
</div>
