<?php
header("Content-type: text/html;charset=utf-8");
$dbh = new PDO("mysql:host=localhost;dbname=test", "root", "");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>