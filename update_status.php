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

$update_status_code = $_POST["update_status_code"];
$update_status = $_POST["update_status"];

if (($update_status_code!=='')&&($update_status!=='')) {
	$sql = "UPDATE added_inventory SET status='$update_status' WHERE inventory_code='$update_status_code'";
	$result = mysqli_query($conn,$sql);

	if ($conn->query($sql)) {
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-check-circle fa-lg"></i>
		<b>Status Updated.</b></div>';
	}else{
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-exclamation-triangle fa-lg"></i><b>Status updating failed! Check your internet connection.</b></div>';
	}
}else{
	echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-exclamation-triangle fa-lg"></i><b>All fields are required!</b></div>';
}


?>