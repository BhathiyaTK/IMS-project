<?php

require_once 'db.php';

$user_del_info = $_POST["id"];

$sql = "DELETE FROM users WHERE id=$user_del_info";
$result = mysqli_query($conn,$sql);

?>