<?php
require_once 'db.php';
session_start();

$email = $_SESSION["reset_email"];
$pass_str = mysqli_real_escape_string($conn,$_POST["pass"]);
$conf_pass_str = mysqli_real_escape_string($conn,$_POST["conf_pass"]);

if ((!empty($pass_str)) && (!empty($conf_pass_str))) {
	if ($pass_str == $conf_pass_str) {
		$pass = password_hash($pass_str, PASSWORD_BCRYPT);

		$query = "UPDATE users SET password='$pass',re_password='$pass' WHERE email='$email'";

		if ($conn->query($query)) {
			echo '<div class="alert alert-success"><i class="fas fa-check-circle fa-lg"></i> <b>Password updated successfully!</b></div>';
		}else{
			echo '<div class="alert alert-danger"><i class="fas fa-times-circle fa-lg"></i> <b>Updating process faild!</b></div>';
		}
	}else{
		echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle fa-lg"></i> <b>Password are not same!</b></div>';
	}
}else{
	echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle fa-lg"></i> <b>Both password fields are required!</b></div>';
}

?>