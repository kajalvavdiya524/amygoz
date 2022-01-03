
$(document).ready(function (e) {
    $("#form").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "ajaxupload.php",
            type: "POST",
            headers: {
                'Authorization':'82e6de59c992dac9ba6d34b2cbd04c57be260333',
                // 'X_CSRF_TOKEN':'xxxxxxxxxxxxxxxxxxxx',
                // 'Content-Type':'application/json'
            },
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function ()
            {
                //$("#preview").fadeOut();
                $("#err").fadeOut();
            },
            success: function (data)
            {
                if (data == 'invalid')
                {
                    // invalid file format.
                    $("#err").html("Invalid File !").fadeIn();
                } else
                {
                    // view uploaded file.
                    $("#preview").html(data).fadeIn();
                    $("#form")[0].reset();
                }
            },
            error: function (e)
            {
                $("#err").html(e).fadeIn();
            }
        });
    }));
});

