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
            <legend>Who you want to message?</legend>            
            <!--<form role="form" class="validate-form" method="post">
            
                <?php if(Request::current()->query('user')) {
                    $send_user = ORM::factory('user', array('username' => Request::current()->query('user')));
                } ?>
                
                <div class="form-group" style="position:relative;">
                    <label class="control-label" for="email">Email address:</label>

                    <input class="form-control email required find_user1"id="message-email" type="text" name="email" placeholder="Type full email address here" autocomplete='off'
                        <?php if(isset($send_user)) { ?> value="<?php echo $send_user->email;?>" readonly="readonly" <?php } ?>>
                        
                    <div id="message-suggestion1" class="registered_users1 well-sm">
                    </div>
                </div>                
                <div class="form-group">
                    <label class="control-label" for="message">Message:</label>
                    <textarea class="required form-control" id="message" name="message" rows="10" placeholder="Type your message here and click on the send button below"></textarea>
                </div>                
                <button type="submit" class="btn btn-secondary">Send</button>
            </form>-->  
                <div class="row">
    <div class="col-sm-6">
        <button data-toggle="modal" data-target="#composeMessage" class="btn btn-primary btn-block hb-mb-10">Compose  Message</button>
    </div>
</div>        
        </fieldset>
    </div>    
   
