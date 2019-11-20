<?php

require_once 'db.php';

$sub_loc_del = $_POST["id"];

$sql = "DELETE FROM sub_locations WHERE id=$sub_loc_del";
$result = mysqli_query($conn,$sql);

?>