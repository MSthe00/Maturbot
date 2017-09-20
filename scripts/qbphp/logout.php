<?php
// Log out process, unsets and destroys session variables and cookies
session_start();
setcookie("uid", "", time()-3600, "/");
setcookie("uhash", "", time()-3600, "/");
session_unset();
session_destroy(); 
header("location: http://maturbot.ddns.net/quotebot.php");
?>
