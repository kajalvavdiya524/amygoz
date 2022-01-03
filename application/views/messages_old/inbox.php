<div class="main-content-up-block">
    <?php echo View::factory('messages/menu', array('submenu' => 'messages')); ?>
</div>
    
<div class="compose-box">

    
        <?php if(Session::instance()->get('error')) {?>
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
            <legend> Inbox Message</legend>
            
            Welcome to callitme Message 
            
        </fieldset>
        
    </div>