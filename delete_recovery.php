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

$recovery_del = $_POST["id"];

$sql = "DELETE FROM recovered_inventory WHERE id=$recovery_del";
$result = mysqli_query($conn,$sql);

?>