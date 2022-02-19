$(function () {
    $('#contact').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.status == 1) {
                    $.each(data.error, function (prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    })
                }else if (data.status == 0) {
                    swal('Success', data.success, 'success');
                    setInterval('location.reload()', 2500);
                }else{
                    swal('Error', data.error, 'error');
                }
            }
        });
    })


});
