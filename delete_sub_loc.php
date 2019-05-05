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

$sub_loc_del = $_POST["id"];

$sql = "DELETE FROM sub_locations WHERE id=$sub_loc_del";
$result = mysqli_query($conn,$sql);

?>