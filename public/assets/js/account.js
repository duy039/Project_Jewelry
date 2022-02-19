$(function (data) {
    $('#account').on('submit', function (e) {
        e.preventDefault();

        // var cur_pass = document.getElementById('current_pass').value;
        var pass = document.getElementById('password').value;
        var con_pass = document.getElementById('confirm_pass').value;

        if(pass =='' && con_pass ==''){
            $('#cur_pass').removeClass('text-danger')
            $('#pass').removeClass('text-danger')
            $('#con_pass').removeClass('text-danger')
        }else{
            $('#cur_pass').addClass('text-danger')
            $('#pass').addClass('text-danger')
            $('#con_pass').addClass('text-danger')
        }

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
