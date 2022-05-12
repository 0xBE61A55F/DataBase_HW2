<?php
#error_reporting(E_ERROR);
session_start();


try{

    if ($_FILES["myFile"]["error"] === 0){
        
        $file = fopen($_FILES["myFile"]["tmp_name"], "rb");
        $fileContents = fread($file, filesize($_FILES["myFile"]["tmp_name"]));
        fclose($file);
        $fileContents = base64_encode($fileContents);
        $imgType = "image/jpeg";
        $imgname = $_FILES["myFile"]["name"];
    }else{
        header("location:index.php");
    }

}catch(Exception $e){
    die();
    header("location:index.php");
}
    
?>

<?php
//meal add

include("connect.php");

if ($_SESSION["is_shop"] == 1){

    if (isset($_POST["submit"]) && $_POST["submit"] == "ADD"){

        if (empty($_POST["mealname"]) || empty($_POST["mealprice"]) || empty($_POST["mealquantity"])){
           echo "<script>window.alert(\"請勿為空!!\");history.go(-1);</script>";
           
        }else{
            $n_meal = $_POST["mealname"];
            $n_price = $_POST["mealprice"];
            $n_quantity = $_POST["mealquantity"];
            $sess_id = $_SESSION["account"];
            $sql = "INSERT INTO addsection(UserID,MealName,Price,Quantity,UploadPicture,imgSpace,imgtypeSpace) VALUES(?,?,?,?,?,?,?)";
            $add_sql = $db->prepare($sql);
            $add_sql->execute(array($sess_id,$n_meal,$n_price,$n_quantity,$imgname,$fileContents,$imgType));
            
            header("location:index.php");
        }
       
      }

}else{
    header("location:index.php");
}

$db = null;
?>
