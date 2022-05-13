<?php

    $dbhost = "localhost";
    $username = "kevin";
    $password = "123";
    $dbname = "test";
    $dbcharacter = "utf8mb4";

    try{

        $db = new PDO("mysql:host={$dbhost};dbname={$dbname};charset={$dbcharacter}",$username,$password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); //禁用prepared statement 模擬
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //顯示database錯誤原因

    }catch (PDOException $e){
        die ("妳媽死了:".$e->getMessage());
    }
?>