$(document).ready(function(){
    $('#registerForm').on('submit',function(e){
        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            type:$(this).attr('method'),
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data){
                if(data.status == 0){
                    $.each(data.error, function(prefix,val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(data.status == 1){
                    $('span.email_error').text(data.invalid);
                } else{
                    swal('Success',data.msg,'success');
                    setInterval('location.reload()', 2500);
                }
            }
        })
    })

    //--------- tooltip------------
    var firstname = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 20 character</li></ul></div>";
    var lastname = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 20 character</li></ul></div>";
    var username = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 20 character</li></ul></div>";
    var email = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 50 character</li><li>- Follow: xxx@xxx.xxx</li></ul></div>";
    var current_pass = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 12 character</li></ul></div>";
    var newpass = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 12 character</li></ul></div>";
    var confpass = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- Must same password</li><li>- At least 12 character</li></ul></div>";
    var subject = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 20 character</li></ul></div>";
    var message = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 100 character</li></ul></div>";
    var phone= "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- Must a number</li><li>- At least 10 number.</li><li>- Not greater than 11 number.</li></ul></div>";
    $('#f_name').tooltip({ 'trigger': 'hover', 'title': firstname, 'placement': 'bottom' });
    $('#l_name').tooltip({ 'trigger': 'hover', 'title': lastname, 'placement': 'bottom' });
    $('#username').tooltip({ 'trigger': 'hover', 'title': username, 'placement': 'bottom' });
    $('#email').tooltip({ 'trigger': 'hover', 'title': email, 'placement': 'bottom' });
    $('#current_pass').tooltip({ 'trigger': 'hover', 'title': current_pass, 'placement': 'bottom' });
    $('#password').tooltip({ 'trigger': 'hover', 'title': newpass, 'placement': 'bottom' });
    $('#confirm_pass').tooltip({ 'trigger': 'hover', 'title': confpass, 'placement': 'bottom' });
    $('#subject').tooltip({ 'trigger': 'hover', 'title': subject, 'placement': 'bottom' });
    $('#message').tooltip({ 'trigger': 'hover', 'title': message, 'placement': 'bottom' });
    $('#phone').tooltip({ 'trigger': 'hover', 'title': phone, 'placement': 'bottom' });
})
