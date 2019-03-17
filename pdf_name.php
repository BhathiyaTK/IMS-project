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

$oc_result = $_GET["oc"];

$sql = "SELECT * FROM added_inventory WHERE sub_location=$oc_result";
$result = mysqli_query($conn,$sql);

echo "$result";

?>