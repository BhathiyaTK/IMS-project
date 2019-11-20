<?php

require_once 'db.php';

session_start();

$user_main_location = $_POST["main_location"];
$user_sub_location = $_POST["sub_location"];
$user_main_inventory_type = $_POST["main_inventory_type"];
$user_sub_inventory_type = $_POST["sub_inventory_type"];
$user_inventory_code = $_POST["inventory_code"];
$user_main_item_code = substr($user_inventory_code, 0,-4);
$user_serial_num = $_POST["serial_num"];
$user_quantity = 1;
$user_price = $_POST["price"];
$user_purchased_date = $_POST["purchased_date"];
$user_item_year = substr($user_purchased_date, 6);
$user_status = $_POST["inventory_status"];
 
if (($user_main_location !== "")&&($user_sub_location !== "")&&($user_main_inventory_type !== "")&&($user_sub_inventory_type !== "")&&($user_inventory_code !== "")&&($user_quantity !== "")&&($user_price !== "")&&($user_purchased_date !== "")) {
	$query_item = "INSERT INTO added_inventory(main_location,sub_location,main_inventory_type,sub_inventory_type,main_inventory_code,inventory_code,serial_number,quantity,price,purchased_date,year,status) VALUES('$user_main_location','$user_sub_location','$user_main_inventory_type','$user_sub_inventory_type','$user_main_item_code','$user_inventory_code','$user_serial_num','$user_quantity','$user_price','$user_purchased_date','$user_item_year','$user_status')";

	if ($conn->query($query_item)) {
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-check-circle fa-lg"></i>
		<b>Inventory added successfully.</b></div>';
	}else{
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Inventory adding failed! Check your internet connection.</b></div>';
	}
}else{
	echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>All fields are required!</b></div>';
}
