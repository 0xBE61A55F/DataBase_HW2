<?php


try{

    if ($_FILES["myFile"]["error"] === 0){
        #echo "檔案名稱".$_FILES["myFile"]["name"]."<br>";
        #echo "檔案類型".$_FILES["myFile"]["type"]."<br>";
        #echo "檔案大小".$_FILES["myFile"]["size"]."<br>";
        #echo "暫存名稱".$_FILES["myFile"]["tmp_name"]."<br>";

        $typeArr = explode("/",$_FILES["myFile"]["type"]);
        
        $fpath = "upload/image/";

        $imgname = "img_".time()."."."jpg";

        $bol = move_uploaded_file($_FILES["myFile"]["tmp_name"],$fpath.$imgname);

        header("location:index.php");
    }else{
        header("location:index.php");
    }

}catch(Exception $e){
    die();
}
    
?>

<?php
//meal add

include("connect.php");

if ($is_shop == 1){

    if (isset($_POST["submit"]) && $_POST["submit"] == "ADD"){

        if (empty($_POST["mealname"]) || empty($_POST["mealprice"]) || empty($_POST["mealquantity"])){
           echo "<script>window.alert(\"請勿為空!!\");</script>";
        }else{
            $n_meal = $_POST["mealname"];
            $n_price = $_POST["mealprice"];
            $n_quantity = $_POST["mealquantity"];
      
            $sql = "INSERT INTO addsection(MealName,Price,Quantity,UploadPicture) VALUES(?,?,?,?)";
            $add_sql = $db->prepare($sql);
            $add_sql->execute(array($n_meal,$n_price,$n_quantity,$imgname));
      
        }
        $db = null;
      }
}else{
    header("location:index.php");
}


?>
