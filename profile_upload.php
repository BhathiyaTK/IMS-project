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

$profile_id = $_SESSION["id"];
$username = $_POST["n_username"];
$f_name = $_POST["f_name"];
$l_name = $_POST["l_name"];
$n_email = $_POST["n_email"];
$image = $_FILES["profileImage"]["name"];

if (($username!=='')||($f_name!=='')||($l_name!=='')||($n_email!=='')||($image!=='')) {

	if ($image=='') {
		$sql_select = "SELECT * FROM users WHERE id='$profile_id'";
		$sql_select_rslt = mysqli_query($conn,$sql_select);
		$row = mysqli_fetch_array($sql_select_rslt);

		$image = $row["user_image"];

		$sql = "UPDATE users SET first_name='$f_name',second_name='$l_name',email='$n_email',username='$username',user_image='$image' WHERE id='$profile_id'";
	}else{
		$sql = "UPDATE users SET first_name='$f_name',second_name='$l_name',email='$n_email',username='$username',user_image='$image' WHERE id='$profile_id'";
	}

	if ($conn->query($sql)) {
		move_uploaded_file($_FILES['profileImage']['tmp_name'], 'images/users/'.$image);
?>
	<div class="modal-header">
	  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-smile fa-lg"></i> Saved Successfully!</h5>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true"><i class="fas fa-times"></i></span>
	  </button>
	</div>
	<div class="modal-body" id="profile_edit_modal_body" style="color: #636466; font-family: Roboto; font-size: 14px;">
	  Your profile updated successfully.
	</div>
<?php
	}else{
?>
	<div class="modal-header">
	  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-surprise fa-lg"></i> Oops! Connection Lost.</h5>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true"><i class="fas fa-times"></i></span>
	  </button>
	</div>
	<div class="modal-body" id="profile_edit_modal_body" style="color: #636466; font-family: Roboto; font-size: 14px;">
	  Database connection lost. Check your internet connection.
	</div>
<?php
	}
}else{
?>
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-frown fa-lg"></i> Saving Faild!</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true"><i class="fas fa-times"></i></span>
  </button>
</div>
<div class="modal-body" id="profile_edit_modal_body" style="color: #636466; font-family: Roboto; font-size: 14px;">
  Fill all the required fields or old password is incorrect.
</div>
<?php
}
?>