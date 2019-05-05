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

$user_title = $_POST["title"];
$user_first_name = $_POST["first_name"];
$user_second_name = $_POST["second_name"];
$user_email = $_POST["email"];
$user_userrole = $_POST["userrole"];
$user_username = $_POST["username"];
$user_password = md5($_POST["password"]);
$user_re_password = md5($_POST["re_password"]);

if (($user_first_name != "")&&($user_second_name != "")&&($user_email != "")&&($user_username != "")&&($user_password != "")&&($user_re_password != "")) {

	if ($user_password == $user_re_password) {
		$query_user = "INSERT INTO users(title,first_name,second_name,email,username,password,re_password,user_type) VALUES('$user_title','$user_first_name','$user_second_name','$user_email','$user_username','$user_password','$user_re_password','$user_userrole')";

		if ($conn->query($query_user)) {
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-check-circle fa-lg"></i>
			<b>User added successfully.</b></div>';
		}else{
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-exclamation-triangle fa-lg"></i><b>User adding failed! Check your internet connection.</b></div>';
		}
	}else{
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span><i class="fas fa-exclamation-triangle fa-lg"></i></button><b>Entered passwords are different! Please re-enter.</b></div>';
	}
}else{
	echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-exclamation-triangle fa-lg"></i><b>All fields are required!</b></div>';
}
