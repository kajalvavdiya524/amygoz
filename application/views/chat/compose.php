<?php $session_user = Auth::instance()->get_user();?>
<?php $code = Text::random(null, 10); ?>


<style>
    .ui-menu {
        max-height: 400px;
        overflow-y: scroll;
    }
    .ui-menu .ui-menu-item {
        list-style-image: none !important;
    }
    .ui-autocomplete-loading {
        background: white url("<?php echo url::base(); ?>img/load_er.gif") right center no-repeat;
    }
    .ui-autocomplete {
        z-index: 9999;
    }
    
    .post.selected-user {
        background-color: #d9edf7;
        padding: 10px;
        border-color: #bce8f1;
        
    }
    .post.selected-user .xs {
        margin-top: 0px !important;
    }
    .post.selected-user .post-title {
        margin-left: 5px;
        color: #3a87ad !important;
    }
</style>

<form role="form" id="chatComposeForm" class="validate-form" method="post" action="<?php echo url::base(); ?>chat/compose">

    <div class="form-group" style="position:relative;">
        <label class="control-label" for="recommend-email">Who do you want to message?</label>

        <input type="text" name="search" id="review-search" class="find_user_autocomplete form-control required" placeholder="Enter Name" autocomplete='off' value="<?php echo (isset($user_to) ? $user_to->user_detail->first_name." ".$user_to->user_detail->last_name  : Request::current()->post('search')); ?>" <?php if(isset($user_to)) { ?> disabled="disabled" <?php } ?>  />

        <input type="hidden" id="user_email" name="email" value="<?php echo isset($user_to) ? $user_to->email : ""; ?>" />
        <input type="hidden" id="current-code" name="code" value="<?php echo $code; ?>" />

        <span class="help-block review-search-error text-danger" style="margin-top:2px;">
            <small style="font-size:90%;" class="text-danger"><strong><?php echo session::instance()->get_once('error-email'); ?></strong></small>
        </span>
    </div>
    
    <div class="alert alert-info post selected-user" <?php if(empty($user_to->user_detail->first_name)) { ?>style="display:none;"<?php } ?>>
        <?php 
            $selected_user_name = '';
            $selected_user_no_image = '';
            $img_src = '';
            $selected_user_location = '';
            if(!empty($user_to->photo->profile_pic_s)) {
                $photo = $user_to->photo->profile_pic_s;
                $user_image_mob = file_exists("mobile/upload/" .$photo);
                $user_image = file_exists("upload/" .$photo);
                if(!empty($photo) && $user_image_mob) {
                    $img_src = url::base()."mobile/upload/".$user_to->photo->profile_pic_s; 
                } else if(!empty($photo) && $user_image) {
                    $img_src = url::base()."upload/".$user_to->photo->profile_pic_s; 
                }
                
                $selected_user_no_image = $user_to->user_detail->get_no_image_name();
                $selected_user_name = $user_to->user_detail->get_name();
                if(!empty($user_to->user_detail->location)) {
                    $loc =  $user_to->user_detail->location; 
                    $b   =  explode(', ', $loc);

                    if(!empty($b[0]) && !empty($b[2])) {
                        $selected_user_location = $b[0].", ".$b[2];
                    } else if(!empty($b[0])) {
                        $selected_user_location = ucwords($b[0]);
                    } else {
                        $selected_user_location = ucwords($b[2]);
                    }
                } else if(!empty($user_to->user_detail->home_town)) { 
                    $selected_user_location = $user_to->user_detail->home_town;
                } else {
                    $selected_user_location = 'Washington, DC, United States';
                }
            }
        ?>
        <div class="user-img pull-left">
            <img src="<?php echo !empty($img_src) ? $img_src : '/'; ?>" <?php if(empty($img_src)) { ?>style="display:none;max-height:49px;"<?php } else { ?>style="max-height:49px;"<?php } ?>>
            <div class="xs" id="inset" <?php if(!empty($img_src)) { ?>style="display:none;"<?php } ?>>
                <h1><?php echo $selected_user_no_image; ?></h1>
            </div>
        </div>
        
        <div class="post-content">
            <div class="post-title">
                <strong> <?php echo $selected_user_name; ?> </strong><br />
                <span> <?php echo $selected_user_location; ?> </span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <label class="control-label" for="message">And, what do you want to say?</label>
        <textarea class="required form-control" id="message" name="message" rows="10" placeholder="Type your message here and click on the send button below"></textarea>
    </div>

    <button type="submit" id="sendMsg" class="btn btn-secondary">Send</button>
</form>


<div class="result post suggestion-sample" style="display:none;">
    <div class="user-img pull-left">
        <img style="width:90%; height:90%;" src="">
        <div class="xs" id="inset" style="margin-top:0px;">                           
            <h1></h1>
        </div>
    </div>
    
    <div class="post-content">
        <div class="post-title">
            <strong></strong>
        </div>
        
        <div class="post-matter" style="margin-left:5px;">
            <span></span>, <strong></strong>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

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

    var chat_code = '<?php echo $code; ?>';
    var server_timestamp = <?php echo time(); ?>;
    setInterval(function(){ 
        server_timestamp++;
    }, 1000);
    
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
    var message_sent = false;
    var firebaseRef = firebase.database().ref().child("Chats");
    firebaseRef.on("child_added", snap => {
        console.log('chat_code', chat_code);
        console.log('Inside Added');
        if(!newItems) {
            return false;
        }

        if(!message_sent) {
            return false;
        }

        if(snap.key == chat_code) {
            $('#chatComposeForm')[0].submit();
        }
    });
    firebaseRef.on("child_changed", snap => {
        console.log('Inside Changed');
        if(!newItems) {
            return false;
        }
        
        if(!message_sent) {
            return false;
        }

        if(snap.key == chat_code) {
            $('#chatComposeForm')[0].submit();
        }
    });
    firebaseRef.once('value', function(messages) {
      newItems = true;
    });
    
    $(document).ready(function() {
        $('#chatComposeForm').submit(function() {
            var proceed = false;
            if($(this).valid()) {
                var email = $('#user_email').val();

                if(email == '') {
                    var email = $('#review-search').val();
                    if(!isValidEmailAddress(email)) {
                        var msg = 'The email Id is not valid. Please enter a valid email address or select any registered member';
                        $('.review-search-error strong').html(msg);
                    } else {
                        proceed = true;
                        $('#user_email').val(email);
                    }
                } else {
                    proceed = true;
                }
            }

            if(proceed) {
                $('#sendMsg').prepend("<img style='width: 15px;' src='<?php echo url::base().'img/ajax-loader.gif'?>'>");
                $('#sendMsg').addClass( "disabled" );

                $.ajax({
                    type: "POST",
                    url: '<?php echo url::base()."chat/check_message_allowed"; ?>',
                    data: {email: email},
                    dataType: "json",
                    success: function(result) {
                        if(result.allowed) {
                            if(result.code != '') {
                                chat_code = result.code;
                                $('#current-code').val(chat_code);
                            }

                            message_sent = true;
                            firebase.database().ref().child("Chats").child(chat_code).push().set({
                                from: currentUser.uid,
                                message: $('#message').val(),
                                timestamp : server_timestamp
                            });
                        } else {
                            $('#chatComposeForm')[0].submit();
                        }
                    }
                });
            }

            return false;
        });

        $(".find_user_autocomplete").autocomplete({
            source: "<?php echo url::base(); ?>members/find_user_json",
            minLength: 2,
            select: function( event, ui ) {
                event.preventDefault();
                $(".find_user_autocomplete").val(ui.item.name);
                $('#user_email').val(ui.item.email);
                
                elem = $('.selected-user');
                
                elem.find('.post-title strong').html(ui.item.name);
                elem.find('.post-title span').html(ui.item.location);

                if(ui.item.image !== '') {
                    elem.find('img').attr('src', ui.item.image);
                    elem.find('img').show();
                    elem.find('.xs').hide();
                } else {
                    elem.find('img').hide();
                    elem.find('.xs h1').html(ui.item.no_image);
                    elem.find('.xs').show();
                }
                elem.show();
                
            },
            response: function(event, ui) {
                $('#user_email').val('');
                elem = $('.selected-user');
                elem.hide();
                elem.find('.post-title strong').html('');
                elem.find('.post-title span').html('');
                elem.find('.xs h1').html('');
                elem.find('.xs').hide();
                elem.find('img').attr('src', '/');
                elem.find('img').hide();
            }
        }).autocomplete( "instance" )._renderItem = function( ul, item ) {
            elem = $('.suggestion-sample').clone();
            elem.removeClass('suggestion-sample');
            elem.show();
            
            elem.find('.post-title strong').html(item.name);
            elem.find('.post-matter span').html(item.location);
            elem.find('.post-matter strong').html("Social "+item.social+" %");

            if(item.image !== '') {
                elem.find('img').attr('src', item.image);
                elem.find('.xs').remove();
            } else {
                elem.find('img').remove();
                elem.find('.xs h1').html(item.no_image);
            }

            return $( "<li>" )
                .append( elem )
                .appendTo(ul);
        };
        
    });
</script>