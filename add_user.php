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

$user_title = $_POST["title"];
$user_first_name = $_POST["first_name"];
$user_second_name = $_POST["second_name"];
$user_email = $_POST["email"];
$user_userrole = $_POST["userrole"];
$user_username = $_POST["username"];
$user_password = md5($_POST["password"]);
$user_re_password = md5($_POST["re_password"]);

if (($user_first_name != "")&&($user_second_name != "")) {
	$query_user = "INSERT INTO users(title,first_name,second_name,email,username,password,re_password,user_type) VALUES('$user_title','$user_first_name','$user_second_name','$user_email','$user_username','$user_password','$user_re_password','$user_userrole')";

	if ($conn->query($query_user)) {
		echo "User added successfully.";
	}else{
		echo "User adding failed! Try again.";
	}
}else{
	echo "Oops! Database connection lost! Check your internet connection.";
}