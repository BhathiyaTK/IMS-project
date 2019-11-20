<?php

require_once 'db.php';

$oc_result = $_GET["oc"];

$sql = "SELECT * FROM added_inventory WHERE sub_location=$oc_result";
$result = mysqli_query($conn,$sql);

echo "$result";

?>