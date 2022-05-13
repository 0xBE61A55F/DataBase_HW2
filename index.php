<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
/*
class Member{
	public function showMember(){
		$r_name = $this->Name;
		$r_account = $this->Account;
		$r_phone = $this->PhoneNumber;
		$r_lat = $this->Latitude;
		$r_long = $this->Longitude;
	}
}
*/

if ($_SESSION['LoginSuccess'] == False) {
  header("location:login.php");
} else {
  include 'connect.php';
  $sql = "SELECT * FROM mytable WHERE Account = ?";

  $stm = $db->prepare($sql);
  $stm->execute(array($_SESSION['account']));

  /*
	$row = $stm->fetchObject("Member");
	$row->showMember();
	*/

  $row = $stm->fetch(PDO::FETCH_ASSOC);

  $r_name = $row['Name'];
  $r_account = $row['Account'];
  $r_phone = $row['PhoneNumber'];
  $r_lat = $row['Latitude'];
  $r_long = $row['Longitude'];
  $r_wallet = $row['Wallet'];


  if (isset($_POST['edit_lat'])) {  //修改經緯度

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $sql = "UPDATE mytable SET Latitude = ?,Longitude = ? WHERE Account = ?";
    $u_stm = $db->prepare($sql);
    $u_stm->execute(array($latitude, $longitude, $r_account));
    header('location:index.php');
  }

  if (isset($_POST['add_value'])) {  //增加錢包

    $wallet = $_POST['wallet'];

    $sql = "UPDATE mytable SET Wallet = ? WHERE Account = ?";
    $u_stm = $db->prepare($sql);
    $u_stm->execute(array($wallet, $r_account));
    header('location:index.php');
  }
}


//判斷是否為店家
$sql = "SELECT * FROM business where UserID = ?";
$query_shop = $db->prepare($sql);
$query_shop->execute(array($_SESSION["account"]));

$row = $query_shop->fetch(PDO::FETCH_BOTH);

if (empty($row)) {
  $is_shop = 0;
  $_SESSION["is_shop"] = 0;
} else {
  $is_shop = 1;
  $_SESSION["is_shop"] = 1;
}



$db = null;
?>

<script>

</script>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- jQuery -->
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Placeholder -->
  <script src="js/jquery.placeholder.min.js"></script>
  <!-- Waypoints -->
  <script src="js/jquery.waypoints.min.js"></script>
  <!-- Main JS -->
  <script src="js/main.js"></script>

  <title>FUCK WEBSITE</title>
</head>

<body>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand " href="#">WHATTHEFUCK</a>

      </div>

      <a class="navbar-brand pull-right" href="logout.php">登出</a>

    </div>
  </nav>
  <div class="container">

    <ul class="nav nav-tabs">
      <li class="active"><a href="#home">Home</a></li>
      <li><a href="#menu1">shop</a></li>


    </ul>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
        <h3>Profile</h3>
        <div class="row">
          <div style="line-height:30px;" class="col-xs-12">
            Accouont: <?php echo $r_account; ?><br>
            Name:<?php echo $r_name; ?><br>
            PhoneNumber: <?php echo $r_phone; ?><br>
            location: <?php echo $r_lat; ?>,<?php echo $r_long; ?>

            <button type="button " style="margin-left: 5px;" class=" btn btn-info " data-toggle="modal" data-target="#location">edit location</button>
            <!--  -->
            <div class="modal fade" id="location" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog  modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">edit location</h4>
                  </div>
                  <div class="modal-body">

                    <form method="POST">
                      <label class="control-label " for="latitude">latitude</label>
                      <input type="text" class="form-control" name="latitude" id="latitude" placeholder="enter latitude">
                      <br>
                      <label class="control-label " for="longitude">longitude</label>
                      <input type="text" class="form-control" name="longitude" id="longitude" placeholder="enter longitude">
                  </div>
                  <div class="modal-footer">
                    <input type="submit" value="Edit" name="edit_lat" class="btn btn-primary">
                  </div>
                  </form>

                </div>
              </div>
            </div>



            <!--  -->
            walletbalance: <?php echo $r_wallet; ?>
            <!-- Modal -->
            <button type="button " style="margin-left: 5px;" class=" btn btn-info " data-toggle="modal" data-target="#myModal">Add value</button>
            <div class="modal fade" id="myModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog  modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add value</h4>
                  </div>
                  <div class="modal-body">
                    <form method="POST">
                      <label class="control-label " for="wallet">wallet</label>
                      <input type="text" class="form-control" name="wallet" id="wallet" placeholder="enter add value">
                  </div>
                  <div class="modal-footer">
                    <input type="submit" value="Add" name="add_value" class="btn btn-primary">
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- 
                
             -->
        <h3>Search</h3>
        <div class=" row  col-xs-8">
          <form class="form-horizontal" action="/action_page.php">
            <div class="form-group">
              <label class="control-label col-sm-1" for="Shop">Shop</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" placeholder="Enter Shop name">
              </div>
              <label class="control-label col-sm-1" for="distance">distance</label>
              <div class="col-sm-5">


                <select class="form-control" id="sel1">
                  <option>near</option>
                  <option>medium </option>
                  <option>far</option>

                </select>
              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-1" for="Price">Price</label>
              <div class="col-sm-2">

                <input type="text" class="form-control">

              </div>
              <label class="control-label col-sm-1" for="~">~</label>
              <div class="col-sm-2">

                <input type="text" class="form-control">

              </div>
              <label class="control-label col-sm-1" for="Meal">Meal</label>
              <div class="col-sm-5">
                <input type="text" list="Meals" class="form-control" id="Meal" placeholder="Enter Meal">
                <datalist id="Meals">
                  <option value="Hamburger">
                  <option value="coffee">
                </datalist>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-1" for="category"> category</label>


              <div class="col-sm-5">
                <input type="text" list="categorys" class="form-control" id="category" placeholder="Enter shop category">
                <datalist id="categorys">
                  <option value="fast food">

                </datalist>
              </div>
              <button type="submit" style="margin-left: 18px;" class="btn btn-primary">Search</button>

            </div>
          </form>
        </div>
        <div class="row">
          <div class="  col-xs-8">
            <table class="table" style=" margin-top: 15px;">
              <thead>
                <tr>
                  <th scope="col">#</th>

                  <th scope="col">shop name</th>
                  <th scope="col">shop category</th>
                  <th scope="col">Distance</th>

                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>

                  <td>macdonald</td>
                  <td>fast food</td>

                  <td>near </td>
                  <td> <button type="button" class="btn btn-info " data-toggle="modal" data-target="#macdonald">Open menu</button></td>

                </tr>


              </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="macdonald" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">menu</h4>
                  </div>
                  <div class="modal-body">
                    <!--  -->

                    <div class="row">
                      <div class="  col-xs-12">
                        <table class="table" style=" margin-top: 15px;">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Picture</th>

                              <th scope="col">meal name</th>

                              <th scope="col">price</th>
                              <th scope="col">Quantity</th>

                              <th scope="col">Order check</th>
                            </tr>
                          </thead>
                          <tbody>



                            <tr>
                              <th scope="row">1</th>
                              <td><img src="Picture/1.jpg" with="50" heigh="10" alt="Hamburger"></td>

                              <td>Hamburger</td>

                              <td>80 </td>
                              <td>20 </td>

                              <td> <input type="checkbox" id="cbox1" value="Hamburger"></td>
                            </tr>
                            <tr>
                              <th scope="row">2</th>
                              <td><img src="Picture/2.jpg" with="10" heigh="10" alt="coffee"></td>

                              <td>coffee</td>

                              <td>50 </td>
                              <td>20</td>

                              <td><input type="checkbox" id="cbox2" value="coffee"></td>
                            </tr>

                          </tbody>
                        </table>
                      </div>

                    </div>


                    <!--  -->
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Order</button>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
      <div id="menu1" class="tab-pane fade">

        <form method="POST" action="index.php">
          <h3> Start a business </h3>
          <div class="form-group ">
            <div class="row">
              <div class="col-xs-2">
                <label for="ex5">shop name</label>
                <input class="form-control" name="ShopName" id="ex5" placeholder="macdonald" type="text">
              </div>
              <div class="col-xs-2">
                <label for="ex5">shop category</label>
                <input class="form-control" name="ShopCategory" id="ex5" placeholder="fast food" type="text">
              </div>
              <div class="col-xs-2">
                <label for="ex6">latitude</label>
                <input class="form-control" name="Latitude" id="ex6" placeholder="121.00028167648875" type="text">
              </div>
              <div class="col-xs-2">
                <label for="ex8">longitude</label>
                <input class="form-control" name="Longitude" id="ex8" placeholder="24.78472733371133" type="text">
              </div>
            </div>


          </div>

          <div class=" row" style=" margin-top: 25px;">
            <div class=" col-xs-3">
              <input type="submit" value="register" name="submit" id="reg_button" class="btn btn-primary">
            </div>
          </div>
        </form>


        <hr>
        <h3>ADD</h3>
        <form method="POST" enctype="multipart/form-data" action="classicUpload.php">
          <div class="form-group ">
            <div class="row">


              <div class="col-xs-6">
                <label for="ex3">meal name</label>
                <input class="form-control" name="mealname" id="ex3" type="text">
              </div>
            </div>
            <div class="row" style=" margin-top: 15px;">
              <div class="col-xs-3">
                <label for="ex7">price</label>
                <input class="form-control" name="mealprice" id="ex7" type="text">
              </div>
              <div class="col-xs-3">
                <label for="ex4">quantity</label>
                <input class="form-control" name="mealquantity" id="ex4" type="text">
              </div>
            </div>


            <div class="row" style=" margin-top: 25px;">

              <div class=" col-xs-3">
                <label for="ex12">上傳圖片</label>
                <input id="myFile" type="file" name="myFile" multiple class="file-loading">

              </div>

              <div class=" col-xs-3">
                <input style=" margin-top: 15px;" type="submit" name="submit" id="add_button" value="ADD" class="btn btn-primary">

              </div>

            </div>
          </div>
        </form>


        <div class="row">
          <div class="  col-xs-8">
            <table class="table" id="test1" style=" margin-top: 15px;">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Picture</th>
                  <th scope="col">meal name</th>

                  <th scope="col">price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>

                <?php  //while start
                include("connect.php");

                $sql = "SELECT * FROM addsection WhERE UserID = ?";
                $meal_q = $db->prepare($sql);
                $meal_q->execute(array($_SESSION["account"]));
                $num = 1;
                while ($mealobj = $meal_q->fetch(PDO::FETCH_BOTH)) {
                  $img = $mealobj["imgSpace"];
                  $logdata = $img;

                ?>

                  <tr>
                    <th scope="row"><?php echo $num; ?></th>
                    <td><?php echo '<img width="250" height="150" src="data:' . $mealobj['imgtypeSpace'] . ';base64,' . $logdata . '" />';  ?></td>
                    <td><?php echo $mealobj["MealName"]; ?></td>

                    <td><?php echo $mealobj["Price"]; ?></td>
                    <td><?php echo $mealobj["Quantity"]; ?> </td>
                    <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#Hamburger-1">
                        Edit
                      </button></td>
                    <!-- Modal -->

                    <div class="modal fade" id="Hamburger-1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">

                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Hamburger Edit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>

                          <form method="POST" action="index.php">

                            <div class="modal-body">
                              <div class="row">
                                <div class="col-xs-6">
                                  <label for="ex71">price</label>
                                  <input class="form-control" name="update_price" id="ex71" type="text">
                                </div>
                                <div class="col-xs-6">
                                  <label for="ex41">quantity</label>
                                  <input class="form-control" name="update_quantity" id="ex41" type="text">
                                </div>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <input type="submit" name="submit" id="edit_btn" value="Edit" class="btn btn-secondary">
                            </div>



                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="obj" value=<?php echo base64_encode($mealobj["MealName"]); ?>>
                    <td><input class="btn btn-primary" id="db" type="submit" name="submit" value="Delete">

                  </tr>


                  </form>
                <?php //while end
                  $num++;
                }

                if (isset($_POST["submit"]) && $_POST["submit"] == "Edit") {
                  if (empty($_POST["update_price"]) || empty($_POST["update_quantity"])) {
                    echo "<script>window.alert(\"請勿留空\");</script>";
                  }
                }

                if (isset($_POST["submit"]) && $_POST["submit"] == "Delete") {

                  $base64_name = $_POST["obj"];
                  $c_name = base64_decode($base64_name);
                  $acc = $_SESSION["account"];

                  $sql = "DELETE FROM addsection WHERE MealName = ? AND UserID = ?";
                  $stm = $db->prepare($sql);
                  $stm->execute(array($c_name, $acc));

                  echo "<script>document.location.href='index.php';</script>";
                }
                $db = null;
                ?>

              </tbody>
            </table>
          </div>

        </div>


      </div>



    </div>
  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
  <script>
    $(document).ready(function() {
      $(".nav-tabs a").click(function() {
        $(this).tab('show');
      });

      var check_num;
      var e_price;
      var e_quantity;

      $("#test1 tr").click(function() {

        check_num = $(this).children().eq(2).html();

        $("#edit_btn").click(function() {
          e_price = document.getElementById("ex71").value;
          e_quantity = document.getElementById("ex41").value;
          window.alert(2);
          $.ajax({
            type: "POST",
            url: "edit.php",
            data: {
              c_num: check_num,
              e_p: e_price,
              e_q: e_quantity
            },
            dataType: "json",
            success: function(msg) {
              //alert(msg.test);
            },
            error: function(xhr) {
              //alert(xhr.status);
            }
          });

        });

      });

      var is_shop = <?php echo $is_shop; ?>;
      if (is_shop == 0) {
        //document.getElementById("add_button").disabled = true;
        $('#add_button').prop('disabled', true);
        $('#reg_button').prop('disabled', false);
      } else {
        $('#add_button').prop('disabled', false);
        $('#reg_button').prop('disabled', true);
      }

    });
  </script>

  <script>
    $(function() {


    });
  </script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>

<?php
include("connect.php");


if (isset($_POST["submit"]) && $_POST["submit"] == "register") {

  $ShopName =  $_POST['ShopName'];
  $ShopCategory =  $_POST['ShopCategory'];
  $Latitude =  $_POST['Latitude'];
  $Longitude =  $_POST['Longitude'];

  if ($ShopName == "" || $ShopCategory == "" || $Latitude == "" || $Longitude == "") {
    echo "<script>alert('請不要留空！'); history.go(-1);</script>";
  } else {

    if ($is_shop == 0) {


      #$sql = "insert into business values(default,'$ShopName','$ShopCategory','$Latitude','$Longitude');";
      #$stmt= $dbh -> query("select ShopName from business where ShopName='$ShopName';");

      $sql = "insert into business values(default,?,?,?,?,?);";
      $stmt = $db->prepare($sql);

      $q_sql = "select ShopName from business where ShopName=?";
      $q_stmt = $db->prepare($q_sql);
      $q_stmt->execute(array($ShopName));

      $row = $q_stmt->fetch(PDO::FETCH_BOTH);
      if (empty($row[0])) {
        $stmt->execute(array($_SESSION['account'], $ShopName, $ShopCategory, $Latitude, $Longitude));
        $db = null;
?>

        <script>
          alert("註冊成功!");
          window.location.href = "index.php";
        </script>
      <?php


      } else {
        $db = null;

      ?>
        <script>
          alert("店家名稱已存在!");
        </script>
<?php
      }
    } else {
      die();
    }
  }
}

$db = null;
?>