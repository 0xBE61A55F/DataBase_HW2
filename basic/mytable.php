<?php
require '../connect.php';
try {
    $sql = "CREATE TABLE mytable (
    ID INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    Name VARCHAR(50) NOT NULL,
    Account VARCHAR(50) NOT NULL,
    PhoneNumber VARCHAR(10) NOT NULL,
    Password VARCHAR(1000) NOT NULL,
    Latitude float(50) NOT NULL,
    Longitude float(50) NOT NULL,
    Wallet INT NOT NULL
    )";

    $db->exec($sql);
    echo "資料表 myable 建立成功";
}

catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
 
$conn = null;
?>