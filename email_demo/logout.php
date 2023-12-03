<?php 
session_start();
session_unset();
session_destroy();

header("Location:/email_demo/login.php")
?>
