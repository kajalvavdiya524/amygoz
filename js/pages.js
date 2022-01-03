$(document).ready(function() {
    var base_url = $('#base_url').val();
    
    $('.uploadProPic').click(function(event){
        $(this).siblings('.input_pp').trigger('click');
    });
    
    $('.input_pp').change(function() {
        $(this).parent('form').submit();
    });
    
    $('.upload_pp').submit(function() {
        var element = $(this);
        $('.user-pro-pic').children('img').addClass('loading');
        $('.user-pro-pic').children('.image-loader').show();
        $(this).ajaxSubmit({
            success:function(data) {
                data = $.parseJSON(data);

                $('#editImageModal .div-to-edit').html('');
                
                $('#editImageModal .modal-dialog').css('width', data.width+'px');
                $('#editImageModal .modal-dialog').css('height', data.height+'px');
                $('#editImageModal .modal-header').hide();
                $('#editImageModal .div-to-edit').html($('<img />').attr({ id: 'selectArea', 'src': base_url+'upload/'+data.image }));
                $('input[name="imag_name"]').val(data.image);

                $('#editImageModal').modal({
                    show:true,
                    backdrop:"static",
                    keyboard: false,
                });
                
                $('#editImageModal').on('shown.bs.modal', function () {
                    $('#selectArea').imgAreaSelect({ 
                        aspectRatio: '9:8',
                        handles: true,
                        parent: '#editImageModal',
                        x1: 20,
                        y1: 20,
                        x2: 180,
                        y2: 160,
                        onSelectEnd: function (img, selection) {
                            $('input[name="x1"]').val(selection.x1);
                            $('input[name="y1"]').val(selection.y1);
                            $('input[name="x2"]').val(selection.x2);
                            $('input[name="y2"]').val(selection.y2);
                        }
                    });
                });
            }
        }); 
        return false;
    });
    
});