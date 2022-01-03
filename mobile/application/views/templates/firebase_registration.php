<?php $session_user = Auth::instance()->get_user(); ?>
<script src="<?php echo url::base(); ?>js/firebase-4.6.0.js"></script>
<script>
    if (!firebase.apps.length) {
        // Initialize Firebase
        var config = {
            apiKey: "<?php echo Kohana::$config->load('settings')->get('firebase')['apiKey']; ?>",
            authDomain: "<?php echo Kohana::$config->load('settings')->get('firebase')['authDomain']; ?>",
            databaseURL: "<?php echo Kohana::$config->load('settings')->get('firebase')['databaseURL']; ?>",
            projectId: "<?php echo Kohana::$config->load('settings')->get('firebase')['projectId']; ?>",
            storageBucket: "<?php echo Kohana::$config->load('settings')->get('firebase')['storageBucket']; ?>",
            messagingSenderId: "<?php echo Kohana::$config->load('settings')->get('firebase')['messagingSenderId']; ?>"
        };
        firebase.initializeApp(config);
    }

    <?php if(empty($session_user->firebase_uuid)) { ?>
        firebase.auth().createUserWithEmailAndPassword('<?php echo $session_user->email; ?>', '<?php echo $session_user->firebase_password; ?>')
        .then(function(firebaseUser) {
            $.ajax({
                type:'POST',
                url:'<?php echo url::base(); ?>members/firebaseSignIn',
                data:'uuid='+firebaseUser.uid,
                success:function(msg){
                    console.log(msg);
                }
            });
        })
        .catch(function(error) {
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            console.log(error);
        });
    <?php } ?>
</script>