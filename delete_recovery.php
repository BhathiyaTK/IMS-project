<?php

require_once 'db.php';

$recovery_del = $_POST["id"];

$sql = "DELETE FROM recovered_inventory WHERE id=$recovery_del";
$result = mysqli_query($conn,$sql);

?>