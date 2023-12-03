<?php
/* To protect loggedin.php , that is to meet the 3rd requirement */
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>
