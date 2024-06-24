<?php
// Start the session
session_start();
//print_r($_SESSION);
// if the user is already logged in then redirect user to welcome page
if (isset($_SESSION["userid"]) && $_SESSION["user"] == true) {
    header("location: index.php");
    exit;
}
?>