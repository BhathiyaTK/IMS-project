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

$item_recover_info = $_POST["item_id1"];

if ($item_recover_info !== '') {
	$sql_copy = "INSERT INTO added_inventory(main_location,sub_location,main_inventory_type,sub_inventory_type,inventory_code,serial_number,quantity,price,purchased_date,status) SELECT main_location,sub_location,main_inventory_type,sub_inventory_type,inventory_code,serial_number,quantity,price,purchased_date,status FROM recovered_inventory WHERE id='$item_recover_info'";

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
	  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-frown fa-lg"></i> Restoration Faild!</h5>
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