<style>
    #imagePreview {
        width: 45px;
        height: 45px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
        position: relative;
        top: 6px;
        right:-1px;
        overflow: hidden;
        background-color: white;
        /*border-radius: 50%;*/
    }
    #inset.xs h1 {
        line-height:45px;
        margin-right:5px;
    }
    #loading {
        padding: 5px;
        margin-bottom: 0px;
        margin-top: 10px;
    }
</style>
<input type="hidden" value="view_message" id="page_name" />
<input type="hidden" value="<?php echo Request::current()->param('id'); ?>" id="username" />

<?php $session_user = Auth::instance()->get_user();?>
<?php $other_user = ($chat->from->id != Auth::instance()->get_user()->id) ? $chat->from : $chat->to; ?>
<?php $deleted_time = ($chat->from->id == Auth::instance()->get_user()->id) ? $chat->from_deleted_time : $chat->to_deleted_time; ?>

<?php 
    if($other_user->is_blocked == 0) {
        $url = url::base().$other_user->username;
        $name = "<a href='$url'>".$other_user->user_detail->get_name()."</a>";
    } else {
        $name = "Callitme User" ;
    }
?>

<div class="row" style="padding:0px;margin:-28px;margin-top:14px;">
    <div class="row" style="margin-top:-19px;padding:6px;">
        <p style="font-size:16px;font-weight:400;" class="titleName">
            <a href="<?php echo url::base()."chat";?>"/>
                <img class="web-sizing" alt="Callitme logo" src="<?php echo url::base(); ?>img/callitme-arrow.png" style="position:relative;top:0px;">
            </a> 
            <span style="color:black;"> Conversation with </span> <?php  echo $name;?>
        </p>
    </div>
    
    <div class="alert alert-info col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4 text-center" role="alert" id="loading">
        Loading <img src="<?php echo url::base(); ?>img/load_er.gif">
    </div>
    <div style="clear:both"></div>

    <div class="chat-section" id="chatContainer">
        
    </div>
    <?php if($other_user->is_blocked == 0) { ?>

        <div class="messageFooter text-right" style="display:none;">
            <code class="userTyping text-left" style="visibility:hidden;"><em><?php echo $other_user->user_detail->get_name(); ?> is typing...</em></code>

            <div class="form-group">
                <input type="hidden" name="to" value="<?php echo $other_user->id; ?>">
                <textarea style="height: 45px;width: 223px;" class="required form-control" id="message" name="message" placeholder="Type your message here" required></textarea>
            </div>

            <button class="btn btn-secondary" type="button" id="chat-reply-btn" style="margin-top: -106px;">Reply</button>

        </div>

    <?php } ?>
</div>

<div class="chat-block-sample ui-grid-a messageList" style="display:none;">
    <div class="row" style="border-bottom: 1px solid #eee;margin-bottom: 5px;">
        <div class="col-xs-2">
            <center>
                <div id="imagePreview">
                    <a href="#" class="chat-user-pic">
                        <div id="inset" class="xs" style="margin-top: 0px;">
                            <h1></h1>
                        </div>
                        <img alt="" src="#" height="100%">
                    </a>
                </div>
            </center>
        </div>
        <div class="col-xs-10" style="position: relative;left: 3px;">
            <div class="messageWrap chat-title">
                <p class="hb-mb-0 name" style="font-size:15px;font-weight: 600;color: #f06292;">
                </p>
                <p class="chat-message" style="font-size: 14px;font-weight: 500; color: black;">
                </p>
                <small class="pull-left chat-time" style="font-size: 11px; color:#595757;margin-top: -9px;margin-bottom: 1px;">
                    <i class="fa fa-clock-o"></i>
                    <input type="hidden" class="timestamp" value="" />
                    <span class="time"></span>
                </small>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<?php 
    $details = array(
        $session_user->firebase_uuid => array(
            'username' => $session_user->username,
            'profile' => url::base().$session_user->username
        ),
        $other_user->firebase_uuid => array(
            'username' => $other_user->username,
            'profile' => url::base().$other_user->username,
        )
    ); 
    
    if($other_user->is_blocked == 0 && $other_user->is_deleted == 0) { 
        $details[$other_user->firebase_uuid]['name'] = $other_user->user_detail->get_name();
        $photo = $other_user->photo->profile_pic_s;
        $photo_image = file_exists("mobile/upload/" . $photo);
        $photo_image1 = file_exists("upload/" .$photo);
        
        if(!empty($photo) && $photo_image) {
            $details[$other_user->firebase_uuid]['img'] = url::base().'mobile/upload/'.$other_user->photo->profile_pic_s;
        } else if(!empty($photo) && $photo_image1) {
            $details[$other_user->firebase_uuid]['img'] = url::base().'upload/'.$other_user->photo->profile_pic_s;
        } else {
            $details[$other_user->firebase_uuid]['img'] = null;
            $details[$other_user->firebase_uuid]['no_img'] = $other_user->user_detail->get_no_image_name();
        }
    } else { 
        $details[$other_user->firebase_uuid]['name'] = "Callitme User"; 
        $details[$other_user->firebase_uuid]['img'] = null;
        $details[$other_user->firebase_uuid]['no_img'] = 'CU';
    }
    
    if($session_user->is_blocked == 0 && $session_user->is_deleted == 0) { 
        $details[$session_user->firebase_uuid]['name'] = $session_user->user_detail->get_name();
        $photo = $session_user->photo->profile_pic_s;
        $photo_image = file_exists("mobile/upload/" . $photo);
        $photo_image1 = file_exists("upload/" .$photo);
        
        if(!empty($photo) && $photo_image) {
            $details[$session_user->firebase_uuid]['img'] = url::base().'mobile/upload/'.$session_user->photo->profile_pic_s;
        } else if(!empty($photo) && $photo_image1) {
            $details[$session_user->firebase_uuid]['img'] = url::base().'upload/'.$session_user->photo->profile_pic_s;
        } else {
            $details[$session_user->firebase_uuid]['img'] = null;
            $details[$session_user->firebase_uuid]['no_img'] = $session_user->user_detail->get_no_image_name();
        }
    } else { 
        $details[$session_user->firebase_uuid]['name'] = "Callitme User"; 
        $details[$session_user->firebase_uuid]['img'] = null;
        $details[$session_user->firebase_uuid]['no_img'] = 'CU';
    }
    
?>

<script src="<?php echo url::base(); ?>js/moment.min.js"></script>
<script src="<?php echo url::base(); ?>js/firebase-4.6.0.js"></script>
<script>
    // Initialize Firebase
    var config = {
        apiKey: "<?php echo Kohana::$config->load('settings')->get('firebase')['apiKey']; ?>",
        authDomain: "<?php echo Kohana::$config->load('settings')->get('firebase')['authDomain']; ?>",
        databaseURL: "<?php echo Kohana::$config->load('settings')->get('firebase')['databaseURL']; ?>",
        projectId: "<?php echo Kohana::$config->load('settings')->get('firebase')['projectId']; ?>",
        storageBucket: "<?php echo Kohana::$config->load('settings')->get('firebase')['storageBucket']; ?>",
        messagingSenderId: "<?php echo Kohana::$config->load('settings')->get('firebase')['messagingSenderId']; ?>"
    };
    if (!firebase.apps.length) {
        firebase.initializeApp(config);
    }
</script>

<script>
    <?php if($deleted_time !== null) { ?>
        var deleted_time = <?php echo strtotime($deleted_time);?>;
    <?php } else { ?>
        var deleted_time = null;
    <?php } ?>

    var update_url = '<?php echo url::base()."chat/update_last_msg/".$other_user->username; ?>';
    function send_new_message(message, currentUser, server_timestamp) {
        if(message != '') {
            firebaseRef.push().set({
                from: currentUser.uid,
                message: message,
                timestamp: server_timestamp
            });
            toggle_read_unread_status('<?php echo $other_user->id; ?>', true);
        }
    }
    
    function update_last_message(message, username) {
        $.ajax({
            type: "POST",
            url: update_url,
            data: {message: message, user: username},
            success: function(result) {

            }
        });
    }
    
    function update_time() {
        $(".chat-section .chat-time .timestamp").each(function() {
            var timestamp = $(this).val();
            $(this).closest('.chat-time').find('.time').html(moment.unix(timestamp).fromNow());
            $(this).closest('.chat-time').find('.time').attr('title', moment.unix(timestamp).format("dddd, MMMM Do YYYY, h:mm:ss a"));
        });
    }

    var firebaseUnread = firebase.database().ref().child("Unread");
    function toggle_read_unread_status(id, status) {
        firebaseUnread.child(id).child("<?php echo $chat->code; ?>").set(status);
    }

    var user_details = JSON.parse('<?php echo json_encode($details); ?>');
    var page_load_server_timestamp = <?php echo time(); ?>;
    var server_timestamp = <?php echo time(); ?>;

    setInterval(function(){ 
        server_timestamp++;
    }, 1000);

    setInterval(function(){ 
        update_time();
    }, 5000);

    $('#chat-reply-btn').click(function() {
        send_new_message($("#message").val(), currentUser, server_timestamp);
        $("#message").val('');
    });

    var timer = null;
    $("#message").keypress(function(e) {
        // block for user is typing feature.
        firebaseTyping.child('<?php echo $session_user->firebase_uuid; ?>').set(true);
        clearTimeout(timer); 
        timer = setTimeout(function() {
            firebaseTyping.child('<?php echo $session_user->firebase_uuid; ?>').set(false);
        }, 2000);

        var code = (e.keyCode ? e.keyCode : e.which);       
        if (code == 13){
            send_new_message($(this).val(), currentUser, server_timestamp);
            firebaseTyping.child('<?php echo $session_user->firebase_uuid; ?>').set(false);
            e.preventDefault();
            $(this).val('');
        }
    });

    var currentUser = firebase.auth().currentUser;
    firebase.auth().signInWithEmailAndPassword("<?php echo $session_user->email; ?>", '<?php echo $session_user->firebase_password; ?>')
    .then(function(firebaseUser) {
        currentUser = firebaseUser;
    })
    .catch(function(error) {
        alert('Error signin', error.message);
        //Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
    });
    
    var currentUser = firebase.auth().currentUser;

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            currentUser = user;
        }
    });
    
    var newItems = false;
    var firebaseRef = firebase.database().ref().child("Chats").child("<?php echo $chat->code; ?>");
    firebaseRef.on("child_added", snap => {
        if(snap.key == 'Typing') {
            return false;
        }
        
        if(deleted_time != null && snap.val().timestamp <= deleted_time) {
            return false;
        }
        var user = user_details[snap.val().from];

        var sample = $('.chat-block-sample').clone();
        sample.removeClass('chat-block-sample');
        $('.chat-section').append(sample);
        
        sample.find('.chat-user-pic').attr('href', user.profile);
        if(user.img != null) {
            sample.find('.chat-user-pic img').attr('src', user.img);
            sample.find('.chat-user-pic .xs').remove();
        } else {
            sample.find('.chat-user-pic img').remove();
            sample.find('.chat-user-pic .xs h1').html(user.no_img);
        }
        sample.find('.chat-title .name').html(user.name);
        sample.find('.chat-message').html(snap.val().message);
        
        var time_elapsed = Math.abs(page_load_server_timestamp - snap.val().timestamp);
        moment.unix(snap.val().timestamp);
        sample.find('.chat-time .time').attr('title', moment.unix(snap.val().timestamp).format("dddd, MMMM Do YYYY, h:mm:ss a"));
        if (time_elapsed >= 36000) {
            sample.find('.chat-time .timestamp').remove();
            sample.find('.chat-time .time').html(moment.unix(snap.val().timestamp).format('Do MMM'));
        } else {
            sample.find('.chat-time .timestamp').val(snap.val().timestamp);
            sample.find('.chat-time .time').html(moment.unix(snap.val().timestamp).fromNow());
        }
        
        sample.show();

        if(newItems) {
            update_last_message(snap.val().message, user.username);
            toggle_read_unread_status('<?php echo $session_user->id; ?>', false);
        }
    });
   
    firebaseRef.once('value', function(messages) {
        newItems = true;
        toggle_read_unread_status('<?php echo $session_user->id; ?>', false);
        
        $('#loading').hide();
        $('.chat-section').show();
        $('.messageFooter').show();
        
        $('#chatContainer').animate({scrollTop: $('#chatContainer').prop("scrollHeight")}, 'slow');
        $('#message').focus();
    });

    var firebaseTyping = firebaseRef.child("Typing");
    firebaseTyping.child('<?php echo $session_user->firebase_uuid; ?>').set(false);

    var newTypingItem = false;
    firebaseTyping.on("child_added", snap => {
        if(newTypingItem && snap.key === '<?php echo $other_user->firebase_uuid; ?>') {
            if(snap.val()) {
                $('.userTyping').css('visibility', 'unset');
            } else {
                $('.userTyping').css('visibility', 'hidden');
            }
        }
    });
    firebaseTyping.on("child_changed", snap => {
        if(newTypingItem && snap.key === '<?php echo $other_user->firebase_uuid; ?>') {
            if(snap.val()) {
                $('.userTyping').css('visibility', 'unset');
            } else {
                $('.userTyping').css('visibility', 'hidden');
            }
        }
    });
    firebaseTyping.once('value', function(messages) {
        newTypingItem = true;
    });

</script>
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