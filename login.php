<?php session_start(); 

if ($_SESSION['LoginSuccess'] == true){
	header("location:index.php"); 
}
?>
<?php
if(isset($_POST["submit"])){

	if( !isset($_POST['Account']) || !isset($_POST['Password']) || $_POST['Account']=="" || $_POST['Password']=="" ){
		#header("location:index.php");
	}else {
		require 'connect.php';
		$Account = $_POST['Account'];
		$Password = $_POST['Password'];
		$password_hash=hash("sha512", $Password);
		echo $password_hash;
		#$Password = md5($_POST['Password']);

		$sql = "SELECT * FROM `mytable` Where (Account = ? AND Password = ?)";	
		#$sql = "SELECT * FROM `mytable` Where (Account ='$Account' AND Password = '$Password')";	
		#$sth = $db->query($sql);

		$sth= $db->prepare($sql);
		$sth->execute(array($Account,$password_hash));
		
		$result = $sth->fetch(PDO::FETCH_OBJ);

		if( $result ) {
			$_SESSION['LoginSuccess'] = true;
			$_SESSION['account'] = $Account;
			header("location:index.php"); 
		}
		else {
			echo "<script language=javascript>alert('登入失敗');</script>";
		}
	$pdo = NULL;
	}
}

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Minimal and Clean Sign up / Login and Forgot Form by FreeHTML5.co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FreeHTML5.co" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

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
	<meta property="og:title" content="" />
	<meta property="og:image" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:description" content="" />
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
				<form action="login.php" method="POST" class="fh5co-form animate-box" data-animate-effect="fadeIn">
					<h2>Sign In</h2>
					<div class="form-group">
						<label for="Account" class="sr-only">Account</label>
						<input type="text" class="form-control" id="Account" placeholder="Account" name="Account" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="password" class="sr-only">Password</label>
						<input type="password" class="form-control" id="password" placeholder="Password" name="Password" autocomplete="off">
					</div>

					<div class="form-group">
						<p>Not registered? <a href="register.php">Sign Up</a> </p>
					</div>
					<div class="form-group">
						<input type="submit" value="Sign In" name="submit" class="btn btn-primary">
					</div>
				</form>
				<!-- END Sign In Form -->

			</div>
		</div>
		<div class="row" style="padding-top: 60px; clear: both;">
			<div class="col-md-12 text-center">
				<p><small>&copy; All Rights Reserved. Designed by <a href="https://freehtml5.co">FreeHTML5.co</a></small></p>
			</div>
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

</html>