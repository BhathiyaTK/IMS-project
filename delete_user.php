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

$user_del_info = $_POST["id"];

$sql = "DELETE FROM users WHERE id=$user_del_info";
$result = mysqli_query($conn,$sql);

?>