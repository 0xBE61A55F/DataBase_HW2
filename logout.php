<?php
session_start();
$_SESSION['LoginSuccess'] = False;
$_SESSION['uname'] = "";
header('location:login.php');

?>