<?php

$host="localhost";
$db_name="root";
$db_pass= "";
$db="tech";

$conn = new mysqli($host,$db_name,$db_pass,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

	if(isset($_POST["login"])){
      	$username = $_POST["username"];
      	$password = md5($_POST["password"]);

       	$query="SELECT * FROM users WHERE username='$username' AND password='$password' UNION SELECT * FROM super_admin WHERE username='$username' AND password='$password'";
		$r=$conn->query($query);
		if($r->num_rows>0){
		    while($row=$r->fetch_assoc()){
		    	$_SESSION['id']=$row['id'];
		    	$_SESSION['title']=$row['title'];
		    	$_SESSION['first_name']=$row['first_name'];
		        $_SESSION['username']=$row['username'];
		        $_SESSION['user_type']=$row['user_type'];

		        header("location: content.php");
		    }
		}else{
			$login_message = '<i class="fas fa-exclamation-triangle fa-lg"></i>User not found. Please input correct details.';
		}
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="css/index-style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<script type="text/javascript" src="inventory-form-functions.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.12.0/validate.min.js"></script>
	<title>IMS | User Login</title>
	<script type="text/javascript">
		$(window).on("load", function() {
			$(".se-pre-con").fadeOut("slow", function(){
				$(this).remove();
			});
		});
		$(document).ready(function(){

			$("#login-form").validate({
				rules: {
					userrole: "required",
					username: "required",
					password: "required"
				},
				messages: {
					userrole: "Please choose the user type.",
					username: "Please enter username.",
					password: "Please enter correct password."
				},
			    submitHandler: function(form) {
			      	form.submit();
			    }
			});
		});

		$(function(){
			$("#userrole_select").focus(function(){
				$("#login_alert").hide();
			});
			$("#username").focus(function(){
				$("#login_alert").hide();
			});
			$("#password").focus(function(){
				$("#login_alert").hide();
			});
		});
	</script>
</head>
<body>
	
	<div class="login-section-background">
		<div id="page-header">
			<h1>Faculty of Technology - SUSL</h1>
			<h4>Inventory Management System</h4>
		</div>
		<div id="form-div">
			<div id="login-header">
				<h4>User Login</h4>
			</div>
			<form action="index.php" method="POST" id="login-form">
				<div id="inputs-set">
					<div class="row input-fields">
						<div class="form-group col-sm-12 col-md-4 col-lg-4 label_div">
							<label class="label-titles" for="exampleInputText1">Username</label>
						</div>
					    <div class="form-group col-sm-12 col-md-8 col-md-8">
					    	<input type="text" name="username" class="form-control form-control-sm inputs" id="username" aria-describedby="emailHelp" placeholder="Enter Username">
					    </div>
					</div>
					<div class="row input-fields">
						<div class="form-group col-sm-12 col-md-4 col-md-4 label_div">
							<label class="label-titles" for="exampleInputPassword1">Password</label>
						</div>
					    <div class="form-group col-sm-12 col-md-8 col-lg-8">
					    	<input type="password" name="password" class="form-control form-control-sm inputs" id="password" placeholder="Enter Password">
					    </div>
					</div>
				</div>
				<div id="index-log-divider"></div>
				<div id="login-button-div">
					<input type="submit" name="login" value="Log in" class="btn btn-primary" id="log-in-btn">
				</div>
			</form>
			<?php if(isset($login_message)){ ?>
				<div class="alert alert-danger" id="login_alert">
					<?php echo $login_message; ?>
				</div>
			<?php } ?>
			
		</div>
		<div class="developer-title">
			<div id="title1">
				<img src="images/susl.png">
			</div>
			<div id="title2">
				<span>Developed by</span><br>
				Department of Computing & Information Systems<br>
				Faculty of Applied Sciences - SUSL
			</div>
		</div>
	</div>
</body>
<div class="se-pre-con"></div>
</html>