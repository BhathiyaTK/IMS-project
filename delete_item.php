<?php

require_once 'db.php';

$item_del_info = $_POST["item_id"];
$del_reason = $_POST["reason_text"];

if ($del_reason !== '') {
	$sql_copy = "INSERT INTO recovered_inventory(main_location,sub_location,main_inventory_type,sub_inventory_type,inventory_code,serial_number,quantity,price,purchased_date,status,reason) SELECT main_location,sub_location,main_inventory_type,sub_inventory_type,inventory_code,serial_number,quantity,price,purchased_date,status,'$del_reason' FROM added_inventory WHERE id='$item_del_info'";

	if ($conn->query($sql_copy)){
		$sql = "DELETE FROM added_inventory WHERE id=$item_del_info";
		$result = mysqli_query($conn,$sql);

?>
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-smile fa-lg"></i> Deleted Successfully!</h5>
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
		<div class="modal-body" id="delete_modal_body">
		  Database connection lost. Check your internet connection.
		</div>
<?php
	}
}else{
?>
	<div class="modal-header">
	  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-frown fa-lg"></i> Deletion Faild!</h5>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true"><i class="fas fa-times"></i></span>
	  </button>
	</div>
	<div class="modal-body" id="delete_modal_body">
	  Please give a valid reason.
	</div>
<?php
}
?>