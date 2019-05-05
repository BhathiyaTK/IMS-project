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

$m_locationVal = $_POST["m_locationVal"];
$m_locationCode = $_POST["m_locationCode"];
$m_locationName = $_POST["m_locationName"];

if (($m_locationVal !== '')&&($m_locationCode !== '')&&($m_locationName !== '')) {
	$m_sql = "INSERT INTO main_locations(location_code,location_name) VALUES('$m_locationCode','$m_locationName')";

	if ($conn->query($m_sql)) {
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-check-circle fa-lg"></i>
		<b>Location added successfully.</b></div>';
	}else{
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-exclamation-triangle fa-lg"></i><b>Location adding failed! Check your internet connection.</b></div>';
	}
}else{
	echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-exclamation-triangle fa-lg"></i><b>All fields are required!</b></div>';
}
?>