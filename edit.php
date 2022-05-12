<?php

    include("connect.php");

    $c_num = $_POST["c_num"];
    $e_p = $_POST["e_p"];
    $e_q = $_POST["e_q"];

    if (empty($e_p) || empty($e_q)){
        die();
    }else{
        
        $sql = "UPDATE addsection SET Price = ?, Quantity = ? WHERE MealName = ?";
        $stm = $db->prepare($sql);
        $stm->execute(array($e_p,$e_q,$c_num));
        
    }

    $arr = array();

    $arr["test"] = $c_num;

    echo json_encode($arr);
    $db = null;
?>