<?php
require_once('db.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
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
	<title>IMS | Reset Password</title>

	<link rel="icon" href="images/susl.png">

	<script>
		$(window).on("load",function(){
			$(".se-pre-con").fadeOut("slow", function(){
				$(this).remove();
			});
			$("#reset-msg-div").hide();
		});
		// $(function(){});
		$(function(){
			$("#verify-form").on('submit',function(e1){
				e1.preventDefault();
				var email = $("#verify-email").val();
				$.ajax({
					type: "POST",
					url: "verify_email.php",
					data: {email:email},
					success: function(verify_msg){
						$("#verify-msg-div").show();
						$(".reset-sec").html(verify_msg);
						setTimeout(function(){$("#verify-msg-div").fadeOut(300);}, 1500);
					}
				});
			});
		});
	</script>
</head>
<body>
	<style>
		.se-pre-con {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url(../images/loader.gif) center no-repeat #fff;
		}
		#reset-section{
			padding: 70px 0 0;
			text-align: center;
		}
		.reset-divs{
			width: 30%;
			margin: 0 auto;
		}
		#reset-section p{
			font-size: 13px;
			color: #555;
		}
		#verify-form input, #reset-form input{
			width: 100%;
			padding: 7.5px 10px;
			border: 1px solid #aaa;
			border-radius: 6px;
			margin-bottom: 10px;
			font-size: 14px;
		}
		#verify-form button, #reset-form button{
			margin-top: 10px;
			padding: 7px 15px;
			border-radius: 6px;
		}
		.reset-form-div{
			border: 1px solid #ccc;
			border-radius: 10px;
			padding: 20px;
		}
		#verify-msg-div, #reset-msg-div{
			margin: 15px 0;
		}
		#redirect-link{
			color: #666;
			font-size: 13px;
		}
		#redirect-link a{
			color: #0cb4ce;
			font-size: 13px;
		}
		#success-link{
			color: #666;
			font-size: 14px;
		}
		#success-link a{
			color: #0cb4ce;
			font-size: 14px;
		}
	</style>
	<section id="reset-section">
		<div class="reset-divs">
			<h3><b>Reset Your Password</b></h3>
			<br>
			<p>Enter your registered email below to verify.</p>
			<form id="verify-form">
				<input type="text" name="verify-email" id="verify-email" placeholder="Email Address">
				<button type="submit" class="btn btn-info btn-sm" name="verify-btn" id="verify-email">Verify Email</button>
			</form>
			<div class="reset-sec"></div>
			<div id="reset-msg-div"></div>
			<br>
			<div id="redirect-link">If you don't have any logging issue, Please <a href="index.php">Login Here.</a></div>
		</div>
	</section>
</body>
<div class="se-pre-con"></div>
</html>