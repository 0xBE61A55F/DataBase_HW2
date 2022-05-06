<?php
require 'connect.php';
try {
    $sql = "CREATE TABLE business (
    BID INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    ShopName VARCHAR(50) NOT NULL,
    ShopCategory VARCHAR(50) NOT NULL,
    Latitude float(50) NOT NULL,
    Longitude float(50) NOT NULL
    )";

    $db->exec($sql);
    echo "資料表 business 建立成功";
}

catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
 
$conn = null;
?>