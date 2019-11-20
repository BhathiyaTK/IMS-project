<?php

require_once 'db.php';

$save_loc_id = $_POST["loc_id"];
$save_location_code = $_POST["location_code"];
$save_location_name = $_POST["location_name"];

if (($save_location_code!=='')||($save_location_name!=='')) {
	if(($save_location_code!=='')&&($save_location_name=='')){
		$sql = "UPDATE main_locations SET location_code='$save_location_code' WHERE id='$save_loc_id'";
	}elseif (($save_location_code=='')&&($save_location_name!=='')) {
		$sql = "UPDATE main_locations SET location_name='$save_location_name' WHERE id='$save_loc_id'";
	}elseif (($save_location_code!=='')&&($save_location_name!=='')) {
		$sql = "UPDATE main_locations SET location_code='$save_location_code',location_name='$save_location_name' WHERE id='$save_loc_id'";
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