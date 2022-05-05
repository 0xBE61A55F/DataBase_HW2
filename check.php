<?php


$uaccount = $_POST["uaccount"];


$arr = array();
include "connect.php";


$query = $db->prepare("SELECT Account FROM mytable");
$query->execute();

while($row = $query->fetch()){

    if($row["Account"] == $uaccount){
        $arr["status"] = 1;
        break;
    }else{
        $arr["status"] = 0;
    }
}

echo json_encode($arr);
$db = null;

?>