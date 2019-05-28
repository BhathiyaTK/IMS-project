<style type="text/css">
	#profile_edit_modal_body{
		width: 90%;
		margin: 0 auto;
	}
	#profileDisplay{
		width: 100%;
		height: 190px;
		border: 1px solid gray;
		border-radius: 5px;
	}
	#profileDisplay:hover{
		cursor: pointer;
	}
	img{
		width: 100%;
	}
	.profile_labels, .form-check-label{
		font-size: 14px;
		margin-bottom: 2px;
	}
	#pass_change_div{
		background: #eee;
		padding: 5px 10px;
		border-radius: 7px;
		margin-bottom: 20px;
	}
	.profile_labels1{
		font-size: 14px;
		margin-bottom: 0;
	}
	.form-check-label{
		font-weight: normal;
		color: #c21e56;
	}
</style>

<?php
$user_id = $_SESSION["id"];
$sql_user = "SELECT * FROM users WHERE id='$user_id'";
$sql_prof_rslt = mysqli_query($conn,$sql_img);
$row = mysqli_fetch_array($sql_prof_rslt);
?>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" id="profile_edit_modal_content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-user-edit"></i> Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times"></i></span>
        </button>
      </div>
      <div class="modal-body" id="profile_edit_modal_body">
        <form id="edit_profile_form" method="POST" enctype="multipart/form-data">
			<div class="row">
			    <div class="form-group col-md-6">
			      	<label class="profile_labels">Profile Photo</label>
			      	<img src="<?php echo 'images/users/'.$row["user_image"]; ?>" id="profileDisplay" onclick="triggerClick();">
			      	<input type="file" id="profileImage" name="profileImage" onchange="displayImage(this);" style="display: none;">
			    </div>
			    <div class="form-group col-sm-12 col-md-6 col-lg-6">
			    	<div class="row">
			    		<div class="form-group col-sm-12 col-md-12 col-lg-12">
					      	<label class="profile_labels">Username</label>
					      	<input type="text" class="form-control form-control-sm" id="n_username" name="n_username" value="<?php echo $row['username']; ?>">
					    </div>
			    	</div>	
			    	<div class="row">
			    		<div class="form-group col-sm-12 col-md-12 col-lg-12">
					      	<label class="profile_labels">First Name</label>
					      	<input type="text" class="form-control form-control-sm" id="f_name" name="f_name" value="<?php echo $row['first_name']; ?>">
					    </div>
			    	</div>
			      	<div class="row">
			    		<div class="col-sm-12 col-md-12 col-lg-12">
			    			<label class="profile_labels">Last Name</label>
			      			<input type="text" class="form-control form-control-sm" id="l_name" name="l_name" value="<?php echo $row['second_name']; ?>">
			    		</div>
			    	</div>
			    </div>
			</div>
			<div class="row">
			    <div class="form-group col-sm-12 col-md-12 col-lg-12">
			      	<label class="profile_labels">E-mail</label>
			      	<input type="text" class="form-control form-control-sm" id="n_email" name="n_email" value="<?php echo $row['email']; ?>">
			    </div>
			</div>
			<button type="submit" class="btn btn-info btn-sm"><b>Save Changes</b></button>
		</form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#pass_change_div").hide();
	});
	function triggerClick() {
		document.querySelector('#profileImage').click();
	}

	function displayImage(e) {
		if (e.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e){
				document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
			}
			reader.readAsDataURL(e.files[0]);
		}
	}
	$("#edit_profile_form").submit(function(e) {
	    e.preventDefault();    
	    var formData = new FormData(this);

	    $.ajax({
	        url: 'profile_upload.php',
	        type: 'POST',
	        data: formData,
	        success: function (data) {
	            $("#profile_edit_modal_content").html(data);
	            $(".modal .close").on('click', function(){
	            	location.reload();
	            });
	            //location.reload(true);
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	});
</script>