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

$save_loc_id = $_POST["loc_id"];
$save_main_loc_value = $_POST["main_loc_value"];
$save_location_code = $_POST["location_code"];
$save_location_name = $_POST["location_name"];

if (($save_main_loc_value!=='')||($save_location_code!=='')||($save_location_name!=='')) {
	if (($save_main_loc_value!=='')&&($save_location_code=='')&&($save_location_name=='')) {
		$sql = "UPDATE sub_locations SET main_location_code='$save_main_loc_value' WHERE id='$save_loc_id'";
	}elseif(($save_main_loc_value=='')&&($save_location_code!=='')&&($save_location_name=='')){
		$sql = "UPDATE sub_locations SET location_code='$save_location_code' WHERE id='$save_loc_id'";
	}elseif (($save_main_loc_value=='')&&($save_location_code=='')&&($save_location_name!=='')) {
		$sql = "UPDATE sub_locations SET location_name='$save_location_name' WHERE id='$save_loc_id'";
	}elseif(($save_main_loc_value!=='')&&($save_location_code!=='')&&($save_location_name=='')){
		$sql = "UPDATE sub_locations SET main_location_code='$save_main_loc_value',location_code='$save_location_code' WHERE id='$save_loc_id'";
	}elseif (($save_main_loc_value=='')&&($save_location_code!=='')&&($save_location_name!=='')) {
		$sql = "UPDATE sub_locations SET location_code='$save_location_code',location_name='$save_location_name' WHERE id='$save_loc_id'";
	}elseif (($save_main_loc_value!=='')&&($save_location_code=='')&&($save_location_name!=='')) {
		$sql = "UPDATE sub_locations SET main_location_code='$save_main_loc_value',location_name='$save_location_name' WHERE id='$save_loc_id'";
	}elseif (($save_main_loc_value!=='')&&($save_location_code!=='')&&($save_location_name!=='')) {
		$sql = "UPDATE sub_locations SET main_location_code='$save_main_loc_value',location_code='$save_location_code',location_name='$save_location_name' WHERE id='$save_loc_id'";
	}

	if ($conn->query($sql)) {
?>
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-smile fa-lg"></i> Saved Successfully!</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    <span aria-hidden="true"><i class="fas fa-times"></i></span>
		  </button>
		</div>
<?php
	}else{
?>
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-surprise fa-lg"></i> Oops! Connection Lost.</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    <span aria-hidden="true"><i class="fas fa-times"></i></span>
		  </button>
		</div>
		<div class="modal-body" id="edit_modal_body">
		  Database connection lost. Check your internet connection.
		</div>
<?php
	}
}else{
?>
	<div class="modal-header">
	  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-frown fa-lg"></i> Saving Faild!</h5>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true"><i class="fas fa-times"></i></span>
	  </button>
	</div>
	<div class="modal-body" id="edit_modal_body">
	  Filling at least one field is required.
	</div>
<?php
}


?>