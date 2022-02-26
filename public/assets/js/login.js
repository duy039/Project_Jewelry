$(document).ready(function () {
    $('#loginForm').on('submit', function (e) {
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
                if(data.status == 0){
                    $.each(data.error, function(prefix,val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(data.status == 1){
                    $('span.password_error').text(data.invalid);
                }
                else if(data.status==2){
                    $('span.email_error').text(data.invalid);

                } else if (data.status==3){
                    swal('Success','Welcome '+data.name,'success');
                    setInterval('location.reload()', 2500);
                }else{
                    swal('Success','Welcome '+data.name,'success');
                    setTimeout(2500);
                    window.location = '/admin';
                }
            }
        });
    });
})
