//--------- tooltip------------
var firstname = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 20 character</li></ul></div>";
var lastname = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 20 character</li></ul></div>";
var username = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 20 character</li></ul></div>";
var email = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- No longer than 50 character</li><li>- Follow: xxx@xxx.xxx</li></ul></div>";
var current_pass = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- Must same your old password</li></ul></div>";
var newpass = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 1 uppercase alphabetical</li><li>- At least 1 lowercase alphabetical</li><li>- At least 1 numeric character</li><li>- At least 1 special character</li><li>- Must be 8 characters or longer</li></ul></div>";
var confpass = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- Must same new password</li></ul></div>";
var subject = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 20 character</li></ul></div>";
var message = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- At least 100 character</li></ul></div>";
var phone = "<div class='text-left'><b>Required: </b><ul><li>- Can not blank</li><li>- Must a number</li><li>- At least 10 number.</li><li>- Not greater than 10 number.</li></ul></div>";
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
