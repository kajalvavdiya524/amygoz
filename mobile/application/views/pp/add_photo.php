<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

<style>
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }
</style>

<div class="container" style="margin-top:50px">
<div class="col-md-10">
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
     <script type="text/javascript" src="<?php url::base()."js/function.js"?>"></script>
        <script src="https://www.callitme.com/js/jquery.imgareaselect.pack.js?v=1.1" type="text/javascript"></script>
         <link href="https://www.callitme.com/css/imgareaselect-default.css?v=1.1" rel="stylesheet" >
    <div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title"><strong>Who is this public personality? </strong></h3>
  </div>
  
  <div class="panel-body">
   
          
   <div class="media">

           

                <img class="image-loader" src="https://www.callitme.com/img/p-loader.gif" style="display:none;">

    
                    <form  enctype="multipart/form-data" action="https://www.callitme.com/pp/upload_pic" method="POST">

                         <input class="input_pp" name="picture" onchange="readURL(this);" type="file" style="display:none;">
                         <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                     <img id="blah" src="<?php echo url::base();?>images/images.png" alt="" style="width: 200px; height: 150px;" />
                         
                         <input type="hidden" name="name" value="1">

                        <button class="btn uploadProPic btn-primary" type="button">

                            <span class="glyphicon glyphicon-folder-open">  </span> 
                            Upload Image
                        </button>

                    </form>




 
    


                    <div class="ribbion-modal modal fade" id="editImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <div class="modal-dialog">



                            <div class="modal-content">



                                <div class="modal-header">

                                </div>



                                <form class="crop_image_form" enctype="multipart/form-data" action="https://www.callitme.com/pp/upload_pic" method="POST">
                                        <input type="hidden" name="username" value="<?php echo $username; ?>">
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

                                        <button type="submit" name="crop" value="done" data-loading-text="Uploading..." class="btn cron-selection-btn btn-secondary">Select</button>

                                    </div>

                                </form>



                            </div><!-- /.modal-content -->



                        </div>

                        <!--</div><!-- /.modal -->

                    </div>


    



    </div>
       
   
</div>
</div>
         
</div>
</div>

<script type="text/javascript">
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }</script>