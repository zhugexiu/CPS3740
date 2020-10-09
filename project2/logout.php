<?php
$cookie_name = "user";
unset($_COOKIE[$cookie_name]);
$res = setcookie($cookie_name, '', time() - 3600,"/");
// empty value and expiration one hour before $res = setcookie($cookie_name, '', time() - 3600); 
echo "You successfully log out";
echo "<br><a href='login.html'>project home page</a>";


?>