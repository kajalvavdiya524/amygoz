<?php $session_user = Auth::instance()->get_user(); ?>

<div class="row">
    <div class="col-sm-12">
        <button data-toggle="modal" data-target="#composeMessage" class="btn btn-primary btn-block hb-mb-10">New Message</button>
    </div>
</div>


<div class="marTop20"></div>
<!--<div class="row">
    <div class="col-sm-12">
    	<div id="custom-search-input">
            <div class="input-group" style="padding: 0px;">
                <form class="filterform" action="#">
                <input type="text" class="filterinput form-control" placeholder="Search" />
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">
                        <span class=" glyphicon glyphicon-search"></span>
                    </button>
                </span>
                </form>
            </div>
        </div>
    </div>
</div>
-->

<style>

    #header {
        position:relative;
        line-height:1em;
    }
    input {
        border:1px solid #ccc;
        border-bottom-color:#eee;
        border-right-color:#eee;
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
    .filterform {
        width:220px;
        font-size:12px;
        display:block;
    }
    .filterform input {
        -moz-border-radius:5px;
        border-radius:5px;
        -webkit-border-radius:5px;
    }

</style>
<script>

    (function ($) {
        jQuery.expr[':'].Contains = function(a,i,m){
            return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
        };

        function listFilter(header, list) {
            var form = $("<form>").attr({"class":"filterform","action":"#"}),
                input = $("<input>").attr({"class":"filterinput form-control","type":"text","placeholder":"Search"});

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
<div id="wrap">
    <h1 id="header"></h1>
    <ul id="message_list"  class="scroll-pane hb-mt-10" style="overflow: hidden; padding: 0px; width:100%;">



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
<!-- Pop up converation modal-->

<div class="modal fade" id="composeMessage" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="lineModalLabel">Isn't it exciting to start a new conversation?</h4>
            </div>

            <div class="modal-body">
                <div class="compose-box">
                    <?php if (Session::instance()->get('error')) { ?>
                        <div class="alert alert-danger">
                            <strong>Error !</strong>
                            <?php echo Session::instance()->get_once('error'); ?>
                        </div>
                    <?php } ?>

                    <?php if (Session::instance()->get('success')) { ?>
                        <div class="alert alert-success">
                            <strong>SUCCESS </strong>
                            <?php echo Session::instance()->get_once('success'); ?>
                        </div>
                    <?php } ?>

                    <form role="form" class="validate-form" method="post" action="<?php echo url::base(); ?>messages/compose">

                        <?php
                        if (Request::current()->query('user')) {
                            $send_user = ORM::factory('user', array('username' => Request::current()->query('user')));
                        }
                        ?>

                        <div class="form-group" style="position:relative;">
                            <label class="control-label" for="email">Who do you want to message?</label>
                             <input type="text" name="first_name" class="find_user form-control" placeholder="Enter Name" autocomplete='off' value="<?php echo (isset($send_user) ? $send_user->user_detail->first_name." ".$send_user->user_detail->last_name  : Request::current()->post('first_name')); ?>"
                            <?php if(isset($send_user)) { ?> disabled="disabled" <?php }?>  id="recommend-email" />
                            
                            <input class="required email find_user form-control"id="message-email" type="hidden" name="email" placeholder="Type full email address here" autocomplete='off'
                                   <?php if (isset($send_user)) { ?> value="<?php echo $send_user->email; ?>" readonly="readonly" <?php } ?>>
                           <div id="message-suggestion" class="registered_users well-sm">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="message">And, what do you want to say?</label>
                            <textarea class="required form-control" id="message" name="message" rows="10" placeholder="Type your message here and click on the send button below"></textarea>
                        </div>

                        <button type="submit" class="btn btn-secondary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>