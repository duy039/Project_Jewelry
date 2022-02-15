$(function (data) {

    $('#account').on('submit', function (e) {
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

                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                }
                else if (data.status == 2) {
                    $('span.current_password_error').text(data.invalid);
                }
                else {
                    swal('Success', data.msg, 'success');
                    setInterval('location.reload()', 2500);
                }
            }
        })
    })
});
