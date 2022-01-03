<link href="<?php echo url::base();?>css/imgareaselect-default.css" rel="stylesheet" >
<script src="<?php echo url::base();?>js/jquery.imgareaselect.pack.js" type="text/javascript"></script>

<div class="container">

    <div class="register-step-box">
        <div class="">

            <div class="text-center">
                <h4>
                    Step 3. Upload a profile picture
                </h4>
            </div>
            <div class="clearfix"></div>
            <div class="container" style="min-height:450px;">
                <div id="">
                    <form class="text-right" id="profile_pic_dp" enctype="multipart/form-data" action="<?php echo url::base()."pages/save_photo"?>" method="POST">
                    <label for="file-upload" class="custom-file-upload" style="position: absolute;right: 16%;">
                        <i class="glyphicon glyphicon-camera" style="background: #f06163;padding: 9px;font-size: 22px;color: #fff;"></i>
                    </label>
                    <input id="file-upload" class="input_pp" name="picture" type="file" style="display:none;"/>

                    <input type="hidden" name="name" value="1" />

                </form>
                     <img class="img-responsive" src="<?php echo url::base(); ?>img/no_image.jpg" style="margin:0px auto;"/>
                
            </div>
            <script type="text/javascript">
                $( "#profile_pic_dp" ).submit(function( event ) {
                  $(".image-loader").show();
                });
            </script>  
                
                <div class="clearfix"></div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-12 text-center">
                <a href="<?php echo url::base().'pages/skip_step'; ?>" style="color: #0c0c0c;font-size: 18px !important;font-weight: 500;">Skip this step >></a>
                </div>
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