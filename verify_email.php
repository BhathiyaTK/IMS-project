<?php
require_once 'db.php';
session_start();

$email = $_POST["email"];
$sql = "SELECT * FROM users WHERE email='$email'";
if (!empty($email)) {
	$r=$conn->query($sql);
	if ($r->num_rows>0) {
		$_SESSION["reset_email"] = $email;
?>
		<div id="verify-msg-div"><div class="alert alert-success"><i class="fas fa-check-circle fa-lg"></i> <b>Email verified!</b></div></div>
		<br>
		<div class="reset-form-div">
			<p>Fill below field to reset password</p>
			<form id="reset-form">
				<input type="password" name="reset-pass" id="reset-pass" placeholder="New Password">
				<input type="password" name="conf-reset-pass" id="conf-reset-pass" placeholder="Re-enter New Password">
				<button type="submit" class="btn btn-success btn-sm" name="reset-btn" id="reset-btn">Reset Password</button>
			</form>
		</div>
<?php
	}else{
		echo '<div id="verify-msg-div"><div class="alert alert-danger"><i class="fas fa-times-circle fa-lg"></i> <b>Email not verified!</b></div></div>';
	}
}else{
	echo '<div id="verify-msg-div"><div class="alert alert-danger"><i class="fas fa-exclamation-circle fa-lg"></i> <b>Please enter the email!</b></div></div>';
}
?>
<script>
	$(function(){
		$("#reset-form").on('submit',function(e2){
			e2.preventDefault();
			var pass = $("#reset-pass").val();
			var conf_pass = $("#conf-reset-pass").val();
			$.ajax({
				type: "POST",
				url: "reset.php",
				data: {pass:pass,conf_pass:conf_pass},
				success: function(reset_msg){
					$("#reset-msg-div").show();
					$("#reset-msg-div").html(reset_msg);
					$("#reset-form")[0].reset();
					setTimeout(function(){$("#reset-msg-div").hide();}, 1500);
				}
			});
		});
	});
</script>