<?php

require_once 'db.php';

$item_recover_info = $_POST["deleteID"];

if (!empty($item_recover_info)) {
	$sql_origin = "SELECT main_location,sub_location,main_inventory_type,sub_inventory_type,inventory_code,serial_number,quantity,price,purchased_date,status FROM recovered_inventory WHERE id='$item_recover_info'";
	$sql_origin_rslt = mysqli_query($conn,$sql_origin);
	$row = mysqli_fetch_array($sql_origin_rslt);

	$mloc = $row["main_location"];
	$sloc = $row["sub_location"];
	$mtype = $row["main_inventory_type"];
	$stype = $row["sub_inventory_type"];
	$code = $row["inventory_code"];
	$mcode = substr($code, 0,-4);
	$serial = $row["serial_number"];
	$qnty = $row["quantity"];
	$price = $row["price"];
	$pdate = $row["purchased_date"];
	$year = substr($pdate, 6);
	$status = $row["status"];

	$sql_copy = "INSERT INTO added_inventory(main_location,sub_location,main_inventory_type,sub_inventory_type,main_inventory_code,inventory_code,serial_number,quantity,price,purchased_date,year,status) VALUES('$mloc','$sloc','$mtype','$stype','$code','$mcode','$serial','$qnty','$price','$pdate','$year','$status')";

	if ($conn->query($sql_copy)){
		$sql = "DELETE FROM recovered_inventory WHERE id=$item_recover_info";
		$result = mysqli_query($conn,$sql);

?>
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-smile fa-lg"></i> Restored Successfully!</h5>
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
		<div class="modal-body" id="re_invent_modal_body">
		  Database connection lost. Check your internet connection.
		</div>
<?php
	}
}else{
?>
	<div class="modal-header">
	  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-frown fa-lg"></i> Recovery Faild!</h5>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true"><i class="fas fa-times"></i></span>
	  </button>
	</div>
	<div class="modal-body" id="re_invent_modal_body">
	  System error! Try again shortly.
	</div>
<?php
}
?>