<!-- logs out all session info -->
<?php
session_start();
session_unset();
unset($_SESSION["username"]);
unset($_SESSION["password"]);
session_destroy();
header('URL = ./index.php');
exit();
?>