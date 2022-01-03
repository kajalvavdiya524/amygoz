<div class="compose-box">    
    <?php if(Session::instance()->get('error')) { ?>
        <div class="alert alert-danger">
           <strong>Error !</strong>
           <?php echo Session::instance()->get_once('error');?>
        </div>
    <?php } ?>
        
    <?php if(Session::instance()->get('success')) {?>
        <div class="alert alert-success">
           <strong>SUCCESS </strong>
           <?php echo Session::instance()->get_once('success');?>
        </div>
    <?php } ?>
        
    <fieldset class="fieldset">
        <legend>Who you want to message?</legend>            
        <?php $data = isset($user_to) ? array('user_to' => $user_to) : null; ?>
        
        <?php echo View::factory('chat/compose', $data); ?>
    </fieldset>
</div>

