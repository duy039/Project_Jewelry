var festivalTime = new Date(2022, 04, 14).getTime() + (1000*3600*18); // time next festival
var days, hours, minutes, seconds; // variables for time units

getCountdown();
setInterval(function () { getCountdown(); }, 1000);
function getCountdown(){
// find the amount of "seconds" between now and target
var current_date = new Date().getTime();
var seconds_left = (festivalTime - current_date) / 1000;

days = pad( parseInt(seconds_left / 86400) );
seconds_left = seconds_left % 86400;
    
hours = pad( parseInt(seconds_left / 3600) );
seconds_left = seconds_left % 3600;
    
minutes = pad( parseInt(seconds_left / 60) );

seconds = pad( parseInt( seconds_left % 60 ) );

// print in html
$("#day").html(days) ;
$("#hour").html(hours) ;
$("#minute").html(minutes) ;
$("#second").html(seconds) ;
}

function pad(n) {
    return (n < 10 ? '0' : '') + n;
}