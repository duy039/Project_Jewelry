$(function () {
    $('#contact').validate({
        rules: {
            subject: {
                required: true,
                maxlength: 20,
            },
            message: {
                required: true,
                maxlength: 100,
            },
        },
        messages: {
            subject: {
                required: '<span class="text-danger"">Please fill this form<span>',
                maxlength: '<span class="text-danger"">Subject must at least 20 character<span>',
            },
            message: {
                required: '<span class="text-danger"">Please fill this form<span>',
                maxlength: '<span class="text-danger"">Message must at least 100 character<span>'
            }
        }
    });
    $('#contact').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success: function (data) {
                // if (data.status == 1) {
                //     $.each(data.error,function(prefix,val){
                //         $('span.'+prefix+'_error').text(val[0]);
                //     })

                 if(data.status==0){
                    swal('Success',data.success,'success');
                    setInterval('location.reload()', 2500);
                }
            }
        });
    })


});
