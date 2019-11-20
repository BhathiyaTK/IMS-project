<?php

require_once 'db.php';

session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST["login"])){
		if ((is_string($_POST["username"])) && (is_string($_POST["password"]))) {
			$username = mysqli_real_escape_string($conn,$_POST["username"]);
			$password = mysqli_real_escape_string($conn,$_POST["password"]);	       	
       		$stmt = $conn->prepare('SELECT * FROM users WHERE username= ? ');
	       	$stmt->bind_param('s', $username);
	       	$stmt->execute();
			$r=$stmt->get_result();
			if($r->num_rows>0){
			    while($row=$r->fetch_assoc()){
			    	if (password_verify($password, $row["password"])) {
			    		$_SESSION['id']=$row['id'];
				    	$_SESSION['title']=$row['title'];
				    	$_SESSION['first_name']=$row['first_name'];
				        $_SESSION['username']=$row['username'];
				        $_SESSION['user_type']=$row['user_type'];
				        $_SESSION['email'] = $row['email'];
				        header("location: content.php");
			       	}else{
			    		$login_message = '<i class="fas fa-exclamation-triangle fa-lg"></i> User not found. Please input correct details.';
			    	}	    		
			    }
			}else{
				$login_message = '<i class="fas fa-exclamation-triangle fa-lg"></i> No result found! Try again.';
			}
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
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
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
	<link rel="icon" href="images/susl.png">
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
		<div class="sec1">
			<div class="bg-color">
				<div id="page-header">
					<h1>Inventory Management System</h1>
					<div class="index-title-divider1"></div>
					<h3>Faculty of Technology - SUSL</h3>
				</div>
				<div class="developer-title">
					<div id="title1">
						<img src="images/susl.png">
					</div>
					<div id="title2">
						<span>Designed & Developed by</span><br>
						Department of Computing & Information Systems<br>
						Faculty of Applied Sciences - SUSL
					</div>
				</div>
			</div>
		</div>
		<div class="sec2">
			<div id="form-div">
				<div id="login-header">
					<h2>User Login</h2>
				</div>
				<div class="index-title-divider2"></div>
				<form action="index.php" method="POST" id="login-form">
					<div id="inputs-set">
						<div class="row input-fields">
					    	<input type="text" name="username" class="form-control inputs" id="username" placeholder="Username">
						</div>
						<div class="row input-fields">
					    	<input type="password" name="password" class="form-control inputs" id="password" placeholder="Password">
						</div>
					</div>
					<div id="login-button-div">
						<input type="submit" name="login" value="Log in" class="btn btn-info" id="log-in-btn">
					</div>
				</form>
				<?php if(isset($login_message)){ ?>
					<div class="alert alert-danger" id="login_alert">
						<?php echo $login_message; ?>
					</div>
				<?php } ?>
			</div>
			<div id="reset-link-div">
				Forgot Your Password? <a href="reset_password.php" name="reset">Click Here.</a>
			</div>
			<div class="developer-title1">
				<div id="title1-1">
					<img src="images/susl.png">
				</div>
				<div id="title2-1">
					<span>Designed & Developed by</span><br>
					Department of Computing & Information Systems<br>
					Faculty of Applied Sciences - SUSL
				</div>
			</div>
		</div>
	</div>
</body>
<div class="se-pre-con"></div>
</html>