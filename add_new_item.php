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

$user_main_location = $_POST["main_location"];
$user_sub_location = $_POST["sub_location"];
$user_main_inventory_type = $_POST["main_inventory_type"];
$user_sub_inventory_type = $_POST["sub_inventory_type"];
$user_inventory_code = $_POST["inventory_code"];
$user_quantity = $_POST["quantity"];
$user_price = $_POST["price"];
$user_purchased_date = $_POST["purchased_date"]:
 

if (($user_inventory_name != "")&&($user_inventory_code != "")) {
	$query_item = "INSERT INTO added_inventory(main_location,sub_location,main_inventory_type,sub_inventory_type,inventory_code,quantity,price,purchased_date) VALUES('$user_main_location','$user_sub_location','$user_main_inventory_type','$user_sub_inventory_type','$user_inventory_code','$user_quantity','$user_price','$user_purchased_date')";

	if ($conn->query($query_item)) {
		echo "Inventory added successfully.";
	}else{
		echo "Inventory adding failed! Try again.";
	}
}else{
	echo "Oops! Database connection lost! Check your internet connection.";
}
