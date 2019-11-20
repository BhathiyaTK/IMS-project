<?php
require_once 'db.php';

session_start();

$s_locationVal = $_POST["s_locationVal"];
$s_m_locationCode = $_POST["s_m_locationCode"];
$s_locationCode = $_POST["s_locationCode"];
$s_locationName = $_POST["s_locationName"];

if (($s_locationVal !== '')&&($s_m_locationCode !== '')&&($s_locationCode !== '')&&($s_locationName !== '')) {
	$s_sql = "INSERT INTO sub_locations(main_location_code,location_code,location_name) VALUES('$s_m_locationCode','$s_locationCode','$s_locationName')";

	if ($conn->query($s_sql)) {
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