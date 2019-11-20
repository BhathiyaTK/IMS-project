<?php

require_once 'db.php';

$main_loc_del = $_POST["id"];

$sql = "DELETE FROM main_locations WHERE id=$main_loc_del";
$result = mysqli_query($conn,$sql);

?>