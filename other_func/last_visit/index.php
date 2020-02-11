<?php
error_reporting(0);
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<title>Display Time of Last Visit</title>
</head>
<body style="text-align:center;">

<script type = "text/javascript">
var days = 730; // the cookie will expire = 2 years
var lastvisit=new Object();
var firstvisitmsg="<b>This is your first visit to this page.</b> <b>Welcome!</b>"; 
lastvisit.subsequentvisitmsg="<p style='font-size:250%; margin-top:10%;'>welcome back <b style='font-size:20px;   color:purple; text-shadow:1px 1px 1px black;'><?php echo strtoupper($_SESSION['user_name']); ?>!</b></p><p style='margin-bottom:245px;'> <b>Your last visit was on</b> <b style='font-size:18px; color:purple; '>[date_displayed]</b><p>";
lastvisit.getCookie=function(Name){ 
var re=new RegExp(Name+"=[^;]+", "i"); 
if (document.cookie.match(re)) 
return document.cookie.match(re)[0].split("=")[1];
return''; 
}

lastvisit.setCookie=function(name, value, days){ 
var expireDate = new Date();

var expstring=expireDate.setDate(expireDate.getDate()+parseInt(days));
document.cookie = name+"="+value+"; expires="+expireDate.toGMTString()+"; path=/";
}

lastvisit.showmessage = function() {
var wh = new Date();
if (lastvisit.getCookie("visit_record") == "") { 
lastvisit.setCookie("visit_record", wh, days); 
document.write(firstvisitmsg);
}

else {
var lv = lastvisit.getCookie("visit_record");
var lvp = Date.parse(lv);
var now = new Date();
now.setTime(lvp);
var day = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
var month = new Array ("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
var dd = now.getDate();
var dy = now.getDay();
dy = day[dy];
var mn = now.getMonth();
mn = month[mn];
yy = now.getFullYear();
var hh = now.getHours();
var ampm = "AM";
if (hh >= 12) {ampm = "PM"}
if (hh >12){hh = hh - 12};
if (hh == 0) {hh = 12}
if (hh < 10) {hh = "0" + hh};
var mins = now.getMinutes();
if (mins < 10) {mins = "0"+ mins}
var secs = now.getSeconds();
if (secs < 10) {secs = "0" + secs}
var dispDate = dy + ", " + mn + " " + dd + ", " + yy + " " + hh + ":" + mins + ":" + secs + " " + ampm
document.write(lastvisit.subsequentvisitmsg.replace("\[date_displayed\]", dispDate))
}

lastvisit.setCookie("visit_record", wh, days);

}

lastvisit.showmessage();
</script>

</body>
</html>