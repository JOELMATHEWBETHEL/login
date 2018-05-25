<?php
include_once("function.php");
//Redirect to the main page if logged in
echo redirect_if_logged_in("welcome.php");
$error1 = false;
if (!empty($_POST)){
	$username = @$_POST["username"];
	$password = @$_POST["password"];
	if(validate_user($username,$password)){
		$error1 = false;
		echo redirect_if_logged_in("welcome.php");
	}
	else{
		$error1=true;
		}
}
?>
<DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		body{
			background-color:#152737;
		}
		.col-5{
			height:300px;
			margin-top:200px;
			margin-left:300px;
			background-color:#FFF;
		}
		h3{
			padding-top:20px;
		}
		.form-group{
			margin-left:20px;
			margin-right:20px;
		}
		#textUsrname{
			margin-top:50px;
		}
		h6{
			text-align:center;
			color:#FFF;
			font-family:Times New Roman;
			padding-top:10px;
		}
		a{
			text-decoration:underline;
		}
	</style>
</head>
<body>
<?php
if($error1){?>
	<div class="alert alert-danger" role="alert">invalid username or password</div>
<?php
}
?>
	<div class="container">
		<div class="row-justify-content-center">
			<div class="col-5">
				<h3>
					<center>SIGN IN</center>
				</h3>
				<form id="form" action="login.php" method="POST">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" name="username" id="textUsrname" placeholder="Username">
						<span class="fa fa-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" name="password" id="txtPassword" placeholder="Password">
					</div>
					<div class="text-center">
						<button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<h6>Don't have an account?<a href="signup.php">Signup</a></h6>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
</body>
</html>