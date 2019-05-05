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

$main_loc_del = $_POST["id"];

$sql = "DELETE FROM main_locations WHERE id=$main_loc_del";
$result = mysqli_query($conn,$sql);

?>