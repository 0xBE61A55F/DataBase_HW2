<?php
require 'connect.php';
try {
    $sql = "CREATE TABLE addsection (
    ID INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    MealName VARCHAR(50) NOT NULL,
    Price VARCHAR(50) NOT NULL,
    Quantity VARCHAR(10) NOT NULL,
    UploadPicture VARCHAR(100) NOT NULL
    )";

    $db->exec($sql);
    echo "資料表 addsection 建立成功";
}

catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
 
$conn = null;
?>