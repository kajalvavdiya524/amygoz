<?php $session_user = Auth::instance()->get_user(); ?>
<?php $user = Auth::instance()->get_user(); ?>

<?php
if (!isset($side_menu)) {

    $side_menu = 'profile';
}
?>
<div id="sidemenu-up-block">
    <div class="user-pro-pic3">

        <?php
        $photo = $user->photo->profile_pic;
        $photo_image1 = file_exists("mobile/upload/" . $photo);
        $photo_image = file_exists("upload/" . $photo);
        if (!empty($photo) && $photo_image1) {
            ?>
            <img width="100%"  src="<?php echo url::base() . 'mobile/upload/' . $user->photo->profile_pic; ?>" alt="<?php echo $user->user_detail->first_name." ".$user->user_detail->last_name;?>">
            <?php }
        else if (!empty($photo) && $photo_image) {
            ?>
            <img width="100%"  src="<?php echo url::base() . 'upload/' . $user->photo->profile_pic; ?>" alt="<?php echo $user->user_detail->first_name." ".$user->user_detail->last_name;?>">
            <?php } else { ?>
            <div id="inset">
                <h1>
                   <?php echo $session_user->user_detail->get_no_image_name(); ?>
                </h1>
            </div>       
<?php } ?>

        <img class="image-loader" src="<?php echo url::base() . "img/p-loader.gif"; ?>" style="display:none;">

        <?php /*if ($side_menu == 'edit_profile') { */?>
            
        <?php //} else { ?>

            <div id="uploadProPic">
                <form id="profile_pic_dp" enctype="multipart/form-data" action="<?php echo url::base() . "profile/profile_pic" ?>" method="POST">

                    <!--<input class="input_pp" name="picture" type="file" style="display:none;"/>

                    <input type="hidden" name="name" value="1" />

                    <button class="btn" type="button">

                        <span class="glyphicon glyphicon-folder-open"></span>

                    </button>-->
                    
                    <label for="file-upload" class="custom-file-upload">
                        <i class="glyphicon glyphicon-camera"></i>
                    </label>
                    <input id="file-upload" class="input_pp" name="picture" type="file" style="display:none;"/>

                    <input type="hidden" name="name" value="1" />

                </form>
            </div>
            <script type="text/javascript">
                $( "#profile_pic_dp" ).submit(function( event ) {
                  $(".image-loader").show();
                });
            </script>
        
            



            <div class="ribbion-modal modal fade" id="editImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">



                    <div class="modal-content">



                        <div class="modal-header">

                        </div>



                        <form class="crop_image_form" enctype="multipart/form-data" action="<?php echo url::base() . "profile/profile_pic" ?>" method="POST">

                            <div class="modal-body">



                                <div class="div-to-edit">



                                </div>



                            </div>



                            <input id="x1" type="hidden" value="" name="x1">

                            <input id="y1" type="hidden" value="" name="y1">

                            <input id="x2" type="hidden" value="" name="x2">

                            <input id="y2" type="hidden" value="" name="y2">

                            <input id="imag_name" type="hidden" value="asdasdsa" name="imag_name">



                            <div class="modal-footer">

                                <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>

                                <button type="submit" name="crop" value="done" data-loading-text="Uploading..." class="btn cron-selection-btn btn-secondary">Select</button>

                            </div>

                        </form>



                    </div><!-- /.modal-content -->



                </div>

                <!--</div><!-- /.modal -->

            </div>

        <?php// } ?>


    </div>

    <div class="user-title">
        <span class="user-name">
<?php echo $user->user_detail->first_name . " " . $user->user_detail->last_name ?>
        </span>
    </div>
</div>