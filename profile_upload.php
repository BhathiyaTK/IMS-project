<?php

require_once 'db.php';

session_start();

$profile_id = $_SESSION["id"];
$username = $_POST["n_username"];
$f_name = $_POST["f_name"];
$l_name = $_POST["l_name"];
$n_email = $_POST["n_email"];
$image = $_FILES["profileImage"]["name"];

$n_pass_str = mysqli_real_escape_string($conn,$_POST["n_pass"]);
$c_n_pass_str = mysqli_real_escape_string($conn,$_POST["c_n_pass"]);
$n_pass = password_hash($n_pass_str, PASSWORD_BCRYPT);
$c_n_pass = password_hash($c_n_pass_str, PASSWORD_BCRYPT);

if (($username!=='')||($f_name!=='')||($l_name!=='')||($n_email!=='')||($image!=='')) {

	if (($image=='')&&(($n_pass_str!=='')&&($c_n_pass_str!==''))) {
		$sql_select = "SELECT * FROM users WHERE id='$profile_id'";
		$sql_select_rslt = mysqli_query($conn,$sql_select);
		$row = mysqli_fetch_array($sql_select_rslt);

		$image = $row["user_image"];
		// $currentPass = $row["password"];

		if (($n_pass_str!=='')&&($c_n_pass_str!=='')) {
				if ($n_pass_str == $c_n_pass_str) {
					$sql = "UPDATE users SET first_name='$f_name',second_name='$l_name',email='$n_email',username='$username',user_image='$image',password='$n_pass',re_password='$n_pass' WHERE id='$profile_id'";

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
	  Your profile details updated successfully.
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
	  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-frown fa-lg"></i> Process Terminated!</h5>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true"><i class="fas fa-times"></i></span>
	  </button>
	</div>
	<div class="modal-body" id="profile_edit_modal_body" style="color: #636466; font-family: Roboto; font-size: 14px;">
	  New password & confirm new password are not same.
	</div>
<?php
				}
		}else{
?>
	<div class="modal-header">
	  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-frown fa-lg"></i> Process Terminated!</h5>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true"><i class="fas fa-times"></i></span>
	  </button>
	</div>
	<div class="modal-body" id="profile_edit_modal_body" style="color: #636466; font-family: Roboto; font-size: 14px;">
		Must fill all the password change fields to change the password. 
	</div>
<?php
		}

		// $sql = "UPDATE users SET first_name='$f_name',second_name='$l_name',email='$n_email',username='$username',user_image='$image' WHERE id='$profile_id'";
	}else if(($image!=='')&&(($n_pass_str!=='')&&($c_n_pass_str!==''))){
		$sql_select = "SELECT * FROM users WHERE id='$profile_id'";
		$sql_select_rslt = mysqli_query($conn,$sql_select);
		$row = mysqli_fetch_array($sql_select_rslt);

		// $currentPass = $row["password"];

		if (($n_pass_str!=='')&&($c_n_pass_str!=='')) {
				if ($n_pass_str == $c_n_pass_str) {
					$sql = "UPDATE users SET first_name='$f_name',second_name='$l_name',email='$n_email',username='$username',user_image='$image',password='$n_pass',re_password='$n_pass' WHERE id='$profile_id'";

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
	  Your profile details updated successfully.
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
	  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-frown fa-lg"></i> Process Terminated!</h5>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true"><i class="fas fa-times"></i></span>
	  </button>
	</div>
	<div class="modal-body" id="profile_edit_modal_body" style="color: #636466; font-family: Roboto; font-size: 14px;">
	  New password & confirm new password are not same.
	</div>
<?php
				}
		}else{
?>
	<div class="modal-header">
	  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-frown fa-lg"></i> Process Terminated!</h5>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    <span aria-hidden="true"><i class="fas fa-times"></i></span>
	  </button>
	</div>
	<div class="modal-body" id="profile_edit_modal_body" style="color: #636466; font-family: Roboto; font-size: 14px;">
		Must fill all the password change fields to change the password. 
	</div>
<?php
		}
		//$sql = "UPDATE users SET first_name='$f_name',second_name='$l_name',email='$n_email',username='$username',user_image='$image' WHERE id='$profile_id'";
	}else if (($image=='')&&(($n_pass_str=='')&&($c_n_pass_str==''))) {
		$sql_select = "SELECT * FROM users WHERE id='$profile_id'";
		$sql_select_rslt = mysqli_query($conn,$sql_select);
		$row = mysqli_fetch_array($sql_select_rslt);

		$image = $row["user_image"];
		// $currentPass = $row["password"];
		$sql = "UPDATE users SET first_name='$f_name',second_name='$l_name',email='$n_email',username='$username',user_image='$image' WHERE id='$profile_id'";

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
	  Your profile details updated successfully.
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
	}else if (($image!=='')&&(($n_pass_str=='')&&($c_n_pass_str==''))) {
		$sql_select = "SELECT * FROM users WHERE id='$profile_id'";
		$sql_select_rslt = mysqli_query($conn,$sql_select);
		$row = mysqli_fetch_array($sql_select_rslt);

		// $currentPass = $row["password"];

		$sql = "UPDATE users SET first_name='$f_name',second_name='$l_name',email='$n_email',username='$username',user_image='$image' WHERE id='$profile_id'";

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
	  Your profile details updated successfully.
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
  Can not keep empty fields.
</div>
<?php
}
?>