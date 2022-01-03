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

<?php $session_user = Auth::instance()->get_user(); ?>

<div class="row">
    <div class="col-sm-12">
        <button href="<?php echo url::base()."chat/compose_popup"; ?>" popup-modal="#composeMessage" class="btn btn-primary btn-block btn-compose-popup hb-mb-10">New Message</button>
    </div>
</div>

<?php 
    $chats = ORM::factory('chat')
        ->where_open()
            ->where_open()
                ->where('user_to', '=', $session_user->id)
                ->where('to_deleted', '=', 0)
            ->where_close()
            ->or_where_open()
                ->where('user_from', '=', $session_user->id)
                ->where('from_deleted', '=', 0)
            ->or_where_close()
        ->where_close()
        ->order_by('last_message_time', 'desc')
        ->find_all()
        ->as_array();

?>

<div class="marTop20"></div>

<div class="marTop20"></div>
<div id="wrap">
    <h1 id="header"></h1>

    <?php echo View::factory('chat/inbox', array('chats' => $chats)); ?>
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
                
            </div>
        </div>
    </div>
</div>

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