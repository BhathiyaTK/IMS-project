<?php

require_once 'db.php';

$user_title = $_POST["title"];
$user_first_name = $_POST["first_name"];
$user_second_name = $_POST["second_name"];
$user_email = $_POST["email"];
$user_userrole = $_POST["userrole"];
$user_username = mysqli_real_escape_string($conn,$_POST["username"]);
$password_str = mysqli_real_escape_string($conn,$_POST["password"]);
$re_password_str = mysqli_real_escape_string($conn,$_POST["re_password"]);
$user_password = password_hash($password_str, PASSWORD_BCRYPT);
$user_profile = "user_profile.png";

if (($user_first_name !== "")&&($user_second_name !== "")&&($user_email !== "")&&($user_username !== "")&&($user_password !== "")) {

	if ($password_str == $re_password_str) {

		$query_user = "INSERT INTO users(title,first_name,second_name,email,username,password,re_password,user_type,user_image) VALUES('$user_title','$user_first_name','$user_second_name','$user_email','$user_username','$user_password','$user_password','$user_userrole','$user_profile')";

			if ($conn->query($query_user)) {
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-check-circle fa-lg"></i>
				<b>User added successfully.</b></div>';
			}else{
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-exclamation-triangle fa-lg"></i><b>User adding failed! Check your internet connection.</b></div>';
			}		
	}else{
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-exclamation-triangle fa-lg"></i><b>Entered passwords are different! Please re-enter.</b></div>';
	}
}else{
	echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-exclamation-triangle fa-lg"></i><b>All fields are required!</b></div>';
}
