<?php session_start(); 

if ($_SESSION['LoginSuccess'] == true){
	header("location:index.php"); 
}

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

//判斷所有欄位是否為空值
//確認密碼、電話、經緯度輸入的正確性



if(isset($_POST["submit"]) && $_POST["submit"] == "Sign Up")  
{	
	include("connect.php");

	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$account=$_POST['account'];
	$pass=$_POST['pass'];
	$password_hash=hash("sha512", $pass);
	$repass=$_POST['repass'];
	$latitude=$_POST['latitude'];
	$longitude=$_POST['longitude'];



	if($name == "" || $phone == "" || $account == "" || $pass == "" || $repass == "" || $latitude == "" || $longitude == "")  
	{  
		echo "<script>alert('請不要留空！'); history.go(-1);</script>";  
	}else{
	
		if ($pass != $repass){
			echo "<script>alert('兩次密碼不同！'); history.go(-1);</script>";
			die;
		}
	
	#$sql = "insert into member_table values('$name','$phone','$account','$pass','$latitude', '$longitude');";
    $insert = $db -> prepare("INSERT INTO mytable(Name,Account,PhoneNumber,Password,Latitude,Longitude)VALUES(?,?,?,?,?,?)");
	

	$stmt= $db -> prepare("select Account from mytable where Account = ? ");
	$stmt->execute(array($account));

	$row= $stmt -> fetch(PDO::FETCH_BOTH);
	if(empty($row[0]))
	{
        $insert -> execute(array($name,$account,$phone,$password_hash,$latitude,$longitude));
        $db = null;

		$_SESSION['LoginSuccess'] = True;
		$_SESSION['account'] = $account;
?>

	<script>
	alert("註冊成功!");
	
	window.location.href = "index.php";
	</script>
<?php

	

        }
        else
        {
            $db = null;

?>
	<script>
	alert("使用者名稱已存在!");
	</script>
<?php
        }
	}

}

?>


        

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Minimal and Clean Sign up / Login and Forgot Form by FreeHTML5.co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FreeHTML5.co" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FreeHTML5.co
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	

		<div class="container">
		
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					

					<!-- Start Sign In Form -->
					<form action="register.php" method="POST" class="fh5co-form animate-box" data-animate-effect="fadeIn">
						<h2>Sign Up</h2>
						<!-- <div class="form-group">
							<div class="alert alert-success" role="alert">Your info has been saved.</div>
						</div> -->
						<div class="form-group">
							<label for="name" class="sr-only">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off">
							
						</div>
						<div class="form-group">
							<label for="name" class="sr-only">phonenumber</label>
							<input type="text" class="form-control" id="phonenumber" name="phone" placeholder="PhoneNumber" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="Account" class="sr-only">Account</label>
							<input type="text" class="form-control" id="Account" name="account" placeholder="Account" autocomplete="off">
							<p id="checkid">
						</div>
						<div class="form-group">
							<label for="password" class="sr-only">Password</label>
							<input type="password" class="form-control" id="password" name="pass" placeholder="Password" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="re-password" class="sr-only">Re-type Password</label>
							<input type="password" class="form-control" id="re-password" name="repass" placeholder="Re-type Password" autocomplete="off">
							<p id="checkpass">
						</div>
						<div class="form-group">
							<label for="latitude" class="sr-only">latitude</label>
							<input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="longitude" class="sr-only">longitude</label>
							<input type="text" class="form-control" id="longitude" name="longitude" placeholder="longitude" autocomplete="off">
						</div>
				
						<div class="form-group">
							<p>Already registered? <a href="login.php">Sign In</a></p>
						</div>
						<div class="form-group">
							<input type="submit" value="Sign Up" name="submit" class="btn btn-primary">
						</div>
						
					</form>
					<!-- END Sign In Form -->

				</div>
			</div>
			<div class="row" style="padding-top: 60px; clear: both;">
				<div class="col-md-12 text-center"><p><small>&copy; All Rights Reserved. Designed by <a href="https://freehtml5.co">FreeHTML5.co</a></small></p></div>
			</div>
		</div>
	
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

	</body>




	<script>

	$(function(){

		$("#Account").blur(function(){
			var uaccount = $("#Account").val();

			$.ajax({
				type:"POST",
				url:"check.php",
				data:{uaccount:uaccount},
				dataType:"json",
				success:function(msg){
					if (msg.status == 1){
						$("#checkid").html("此用戶名已被註冊！"); 
						$("#checkid").css("color","red");
					}else{
						$("#checkid").html("此用戶名可以使用！"); 
						$("#checkid").css("color","blue");
					}
				}
			});

		});

		$("#re-password").blur(function(){
			var pwd1 = document.getElementById("password").value;
			var pwd2 = document.getElementById("re-password").value;
			console.log(pwd1);
			console.log(pwd2);
			if (pwd1 != pwd2){
				$("#checkpass").html("兩次密碼不同");
				$("#checkpass").css("color","red");
			}else{
				$("#checkpass").html("兩次密碼相同");
				$("#checkpass").css("color","blue");
			}
		});

	});

</script>
</html>
