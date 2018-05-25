<?php
include_once("function.php");
if (!empty($_POST)){
	$username = @$_POST["username"];
	$password = @$_POST["pswd"];
	$phone = @$_POST["phone"];
	if(validate_username($username, $password)){
		$id=get_login_id();
		$id++;
		if($id>=0){
			if(insert_newUser($username,$password,$phone,$id)){
				echo '<script type="text/javascript">';
      			echo 'alert("YOUR REGISTRATION IS COMPLETED...")';
      			echo '</script>';
      			insert_new_logger($username, $password);
			}
		}

	}
	else{
		echo '<script type="text/javascript">';
      	echo 'alert("Username exists")';
      	echo '</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Sign Up</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">-->
	<style>
		body{
		background-color:#152737;	
		}
		.col-5{
		height:350px;
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
		#textUsername{
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
		#txtPhone
		{
		margin-bottom:35px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row-justify-content-center">
			<div class="col-5">
				<h3>
					<center>SIGN UP</center>
				</h3><br>
			    <form action="signup.php" method="post">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" id="txtUsername" name="username" placeholder="Username">
			         </div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" id="txtPassword" name="pswd" placeholder="password">
					</div>
					<div class="form-group has-feedback">
						<input type="phone" class="form-control" id="txtPhone" name="phone" placeholder="Phone Number">
					</div>
               		<div class="text-center">
               			<button type="submit" class="btn btn-primary btn-lg btn-block">SIGN	UP
               			</button>
               		</div>
				</form>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
