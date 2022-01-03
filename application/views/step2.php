<link href="<?php echo url::base();?>css/imgareaselect-default.css" rel="stylesheet" >
<script src="<?php echo url::base();?>js/jquery.imgareaselect.pack.js" type="text/javascript"></script>

<div class="container">

    <div class="register-step-box">
        <div class="bubble shadow">

            <div class="ribbion shadow">
                <h2>
                    Step 3. Upload a profile picture
                </h2>
            </div>
            <div class="triangle-l"></div>
            
            <div class="clearfix"></div>
            <div class="info" style="min-height:450px;">
                
                <div class="step2-img">
                    <img src="<?php echo url::base(); ?>img/no_image.jpg" />
                    
                    <form class="upload_pp" enctype="multipart/form-data" action="<?php echo url::base()."pages/save_photo"?>" method="POST">
                        <input class="input_pp" name="picture" type="file" style="display:none;"/>
                        <input type="hidden" name="name" value="1" />
                        <button type="button" class="btn btn-secondary btn-lg btn-block marTop20 uploadProPic">Upload Picture</button>
                    </form>

                </div>  
                
                <div class="clearfix"></div>
                
                <a href="<?php echo url::base().'pages/skip_step'; ?>" class="pull-right">Skip this step >></a>
            </div>
        </div>
    </div>

    <div class="ribbion-modal modal fade" id="editImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        
            <div class="modal-content">
            
                <div class="modal-header">
                </div>
                
                <form class="crop_image_form" enctype="multipart/form-data" action="<?php echo url::base()."pages/save_photo"?>" method="POST">
                    <div class="modal-body">
                        
                        <div class="div-to-edit">
                        
                        </div>
                
                    </div>
                    
                    <input id="x1" type="hidden" value="" name="x1">
                    <input id="y1" type="hidden" value="" name="y1">
                    <input id="x2" type="hidden" value="" name="x2">
                    <input id="y2" type="hidden" value="" name="y2">
                    <input id="imag_name" type="hidden" value="" name="imag_name">
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                        <button type="submit" name="crop" value="done" class="btn btn-secondary">Selection Done</button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
            
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
                    
</div>