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

$edit_item_id = $_POST["item_id"];
$edit_item_main_loc = $_POST["edit_item_main_loc"];
$edit_item_sub_loc = $_POST["edit_item_sub_loc"];
$edit_main_inv_type = $_POST["edit_main_inv_type"];
$edit_sub_inv_type = $_POST["edit_sub_inv_type"];
$edit_item_inv_code = $_POST["edit_item_inv_code"];
if ($_POST["edit_item_serial_no"]!=='') {
	$edit_item_serial_no = $_POST["edit_item_serial_no"];
}else{
	$edit_item_serial_no = "N/A";
}
$edit_item_quantity = $_POST["edit_item_quantity"];
$edit_item_price = $_POST["edit_item_price"];
$edit_item_purchased_date = $_POST["edit_item_purchased_date"];

if(($edit_item_main_loc!=='')&&($edit_item_sub_loc!=='')&&($edit_main_inv_type!=='')&&($edit_sub_inv_type!=='')&&($edit_item_inv_code!=='')&&($edit_item_quantity!=='')&&($edit_item_price!=='')&&($edit_item_purchased_date!=='')||($edit_item_serial_no!=='')){

	if(($edit_item_main_loc!=='')&&($edit_item_sub_loc!=='')&&($edit_main_inv_type!=='')&&($edit_sub_inv_type!=='')&&($edit_item_inv_code!=='')&&($edit_item_purchased_date!=='')&&($edit_item_quantity!=='')&&($edit_item_price!=='')||($edit_item_serial_no!=='')){

		$sql = "UPDATE added_inventory SET main_location='$edit_item_main_loc',sub_location='$edit_item_sub_loc',main_inventory_type='$edit_main_inv_type',sub_inventory_type='$edit_sub_inv_type',inventory_code='$edit_item_inv_code',serial_number='$edit_item_serial_no',quantity='$edit_item_quantity',price='$edit_item_price',purchased_date='$edit_item_purchased_date' WHERE id='$edit_item_id'";

	}elseif (($edit_item_main_loc!=='')&&($edit_item_sub_loc!=='')&&($edit_main_inv_type!=='')&&($edit_sub_inv_type!=='')&&($edit_item_inv_code!=='')&&($edit_item_purchased_date!=='')&&($edit_item_quantity!=='')&&($edit_item_price!=='')&&($edit_item_serial_no=='')) {
		
		$sql = "UPDATE added_inventory SET main_location='$edit_item_main_loc',sub_location='$edit_item_sub_loc',main_inventory_type='$edit_main_inv_type',sub_inventory_type='$edit_sub_inv_type',inventory_code='$edit_item_inv_code',serial_number='$edit_item_serial_no',quantity='$edit_item_quantity',price='$edit_item_price',purchased_date='$edit_item_purchased_date' WHERE id='$edit_item_id'";

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
	  Fill all the required fields.
	</div>
<?php
}


?>