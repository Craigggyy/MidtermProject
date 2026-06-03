<?php

session_start();

session_destroy();

setcookie("cookieUsername", "", time() - 9999999, "/");
setcookie("cookiePassword", "", time() - 9999999, "/");

echo "<meta http-equiv='refresh' content='0; url=login.php'>";

?>