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

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="css/content-style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script src="js/functions.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
	<script src="https://unpkg.com/jspdf@1.5.3/dist/jspdf.min.js"></script>
	<script src="https://unpkg.com/jspdf-autotable@3.0.2/dist/jspdf.plugin.autotable.js"></script>
	<script src="js/tableHTMLExport.js"></script>
	<script src="js/jquery.calendar.js"></script>
	<link rel="stylesheet" href="css/jquery.calendar.css">
	<script src="js/script.js"></script>
	<link rel="stylesheet" href="css/style.css">
	
	<title>IMS | Home</title>
</head>
<body>
	<script type="text/javascript">
		//document ready functions...
		$(document).ready(function(){
			$("#serial_num").hide();
			$("#serial_num_check").click(function(){
				if ($(this).prop("checked")) {
					$("#serial_num").show(200);
				}else {
					$("#serial_num").hide(200);
				}
			});

			$("#add_new_item_alert").hide();

			var loged_id = <?php echo $_SESSION['id'] ?>;
			$('#row'+loged_id).remove();
			
			$(function () {
			  	$('#calendar-div').calendar({
			  		months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Augest', 'September', 'October', 'November', 'December'],
			  		days: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			  		color: '#198406'
			  	});
			});
		});

		//check inventory
		$(function(){
			$("#form1").on('submit', function(e2){
				e2.preventDefault();

				var check_sub_location = $("#sub_locations").val();
				$.ajax({
					type: 'POST',
					url: 'check_item.php',
					data: {check_sub_location:check_sub_location},
					success: function(data1){
						$("#table-content").html(data1);
					}
				});
			});
		});

		$(function(){
			
			$("#download-pdf-btn").click(function () {
				var doc = new jsPDF();
				//doc.autoTable({html: '#table-content'});
				var specialElementHandlers = {
				    '#table-content': function (element, renderer) {
				        return true;
				    }
				};
			    doc.fromHTML($('#table-content').html(), 10, 10,{
					'width': 110,
					'elementHandlers': specialElementHandlers
					});
			    doc.save('ims.pdf');
			});
		});
		

		//$(function(){
			//$("#download-pdf-btn").click(function(){
				//var doc = new jsPDF();

				//doc.fromHTML($("#table-content").html(), 10, 10);
				//doc.save('a4.pdf');

				
			//});
		//});

		//add new item part...
		$(function(){
			$("#form2").on('submit', function(e3){
				e3.preventDefault();

				var main_location = $("#main_location").val();
				var sub_location = $("#sub_location").val();
				var main_inventory_type = $("#main_inventory_type").val();
				var sub_inventory_type = $("#sub_inventory_type").val();
				var inventory_code = $("#inventory_code").val();
				if ($("#serial_num_check").prop("checked")) {
					var serial_num = $("#serial_num").val();
				} else {
					var serial_num = "N/A";
				}
				var quantity = $("#quantity").val();
				var price = $("#price").val();
				var purchased_date = $("#purchased_date").val();
				$.ajax({
					type: 'POST',
					url: 'add_new_item.php',
					data: {main_location:main_location, sub_location:sub_location, main_inventory_type:main_inventory_type, sub_inventory_type:sub_inventory_type, inventory_code:inventory_code, serial_num:serial_num, quantity:quantity, price:price, purchased_date:purchased_date},
					success: function(data3){
						$("#form2")[0].reset();
						$("#serial_num").hide(200);
						$("#add_new_item_alert").html(data3).show();
						$("#add_new_item_alert").fadeOut(5000);
					}
				});
			});
		});

		//user manage part...
		$(function(){
			$("#form4").on('submit', function(e4){
				e4.preventDefault();

				var title = $("#title").val();
				var first_name = $("#first_name").val();
				var second_name = $("#second_name").val();
				var email = $("#email").val();
				var userrole = $("#userrole").val();
				var username = $("#username").val();
				var password = $("#password").val();
				var re_password = $("#re_password").val();
				$.ajax({
					type: 'POST',
					url: 'add_user.php',
					data: {title:title, first_name:first_name, second_name:second_name, email:email, userrole:userrole, username:username, password:password, re_password:re_password},
					success: function(){
						alert('user added successfully');
						$("#form4")[0].reset();
						$('#user_table').load("content.php #user_table");
					}
				});
			});
		});
		$(function() {
            $(".user_del_btn").click(function() {
                var user_id = $(this).attr("id");
                var info = 'id=' + user_id;
                if (confirm("Sure you want to delete this user? This cannot be undone later.")) {
                    $.ajax({
                        type : "POST",
                        url : "delete_user.php",
                        data : info,
                        success : function() {
                        	$("#row"+user_id).remove();
                        }
                    });
                    $(this).parents(".record").animate("fast").animate({
                        opacity : "hide"
                    }, "slow");
                }
                return false;
            });
        });
	</script>
	<div id="page-header">
		<h4>Inventory Management System</h4>
	</div>
	<div class="content-div row">
		<div class="col-md-3"> 
			<div id="logout-div">
				<?php if(isset($_SESSION["username"])){ ?>
					<h4><?php echo "Hello! ".$_SESSION["username"]; ?></h4>
				<?php 
				}
				?>
				<p>
					<?php
					if (isset($_SESSION["user_type"])) {
						if ($_SESSION["user_type"] == "admin") {
							echo "You successfully logged as an Admin";
						}elseif ($_SESSION["user_type"] == "manager") {
							echo "You successfully logged as a Manager";
						}elseif($_SESSION["user_type"] == "user"){
							echo "You successfully logged as an User";
						}
					}
					?>
				</p>
				<a href="log_out.php" class="btn btn-danger">Log out</a>
			</div>
			<ul class="nav nav-tabs flex-column" id="nav-tab" role="tablist">
			  	<li class="nav-item">
			    	<a class="nav-link active" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check Inventory</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" id="nav-submit-tab" data-toggle="tab" href="#nav-submit" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-plus"></i><span class="verticle-line"></span>Add Inventory</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-users"></i><span class="verticle-line"></span>Manage Users</a>
			  	</li>
			</ul>
			<div id="calendar-div"></div>
		</div>
		<div class="col-md-9">
			<div id="clock" class="dark">
				<div class="display">
					<div class="digits"></div>
					<div class="ampm"></div>
				</div>
			</div>
			<div class="tab-content" id="nav-tabContent">

			<!-- Check inventory tab -->
			  	<div class="tab-pane fade show active " id="nav-check" role="tabpanel" aria-labelledby="nav-check-tab">
			  		<div class="check-condition-div">
			  			<form id="form1">
							<div class="row" class="check-condition-div">
							    <div class="form-group col-md-6">
							      	<label for="inputState">Sub Location</label>
							      	<select class="form-control form-control-sm" name="sub_locations" id="sub_locations">
							        	<option selected>Choose...</option>
							        	<?php

							    		$sql_sub_locations = "SELECT * FROM sub_locations";
							    		$sub_loc_results = mysqli_query($conn,$sql_sub_locations);

							    		while ($row = mysqli_fetch_array($sub_loc_results)) {
							    			echo "<option value=".$row['location_code'].">(".$row['location_code'].") ". $row['location_name']."</option>";
							    		}

							    		?>
							      	</select>
							    </div>
							</div>
							<div class="button-div" id="check-button-div">
						    	<button type="submit" class="btn btn-success btn-sm form-button" id="check_button"><i class="fas fa-search"></i>Check Inventory</button>
						    </div>
						</form>
			  		</div>
					<div id="table-content"></div>
					<div id="editor"></div>
					<div id="print-button-div">
						<button class="btn btn-primary btn-sm" id="download-pdf-btn"><i class="fas fa-download"></i>Download</button>
						<span>&nbsp&nbspDownload above inventory details table as a PDF.</span>
					</div>
			  	</div>

			<!-- Submit inventory tab -->
			  	<div class="tab-pane fade" id="nav-submit" role="tabpanel" aria-labelledby="nav-submit-tab">
			  		<div class="check-condition-div">
			  			<form id="form2">
			  				<div class="row" >
							    <div class="form-group col-md-6">
							      	<label for="inputCity">Main Location</label>
							      	<select id="main_location" class="form-control form-control-sm" name="main_location">
							        	<option selected>Choose...</option>
							        	<?php

							    		$sql_main_inventory = "SELECT * FROM main_locations";
							    		$main_inv_results = mysqli_query($conn,$sql_main_inventory);

							    		while ($row = mysqli_fetch_array($main_inv_results)) {
							    			echo "<option value=".$row['location_code'].">(".$row['location_code'].") ". $row['location_name']."</option>";
							    		}

							    		?>
							      	</select>
							    </div>
							    <div class="form-group col-md-6">
							      	<label for="inputState">Sub Location</label>
							      	<select id="sub_location" class="form-control form-control-sm" name="sub_location">
							        	<option selected>Choose...</option>
							        	<?php

							    		$sql_main_inventory = "SELECT * FROM sub_locations";
							    		$main_inv_results = mysqli_query($conn,$sql_main_inventory);

							    		while ($row = mysqli_fetch_array($main_inv_results)) {
							    			echo "<option value=".$row['location_code'].">(".$row["location_code"].") ".$row['location_name']."</option>";
							    		}

							    		?>
							      	</select>
							    </div>
							</div>
							<div class="row">
							    <div class="form-group col-md-6">
							      	<label for="inputZip">Main Inventory Category</label>
							      	<input type="text" class="form-control form-control-sm" id="main_inventory_type" name="main_inventory_type" placeholder="Main inventory category name here...">
							    </div>
							    <div class="form-group col-md-6">
							      	<label for="inputCity">Sub Inventory Type</label>
							      	<input type="text" class="form-control form-control-sm" id="sub_inventory_type" placeholder="Sub inventory name here...">
							    </div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
					    			<label for="inputState">Inventory Code</label>
					      			<input type="text" class="form-control form-control-sm" id="inventory_code" name="inventory_code" placeholder="FT/XX/XXXX/XXX/XXX">
					    		</div>
					    		<div class="form-group col-md-6">
					    			<div class="alert alert-warning" id="serial_num_check_alert">
					    				<input class="form-check-input" type="checkbox" id="serial_num_check">
						    			<label for="inputZip">Serial Number (Only if available)</label>
								      	<input type="text" class="form-control form-control-sm" id="serial_num" name="serial_num" placeholder="Serial number here...">
					    			</div>
					    		</div>
							</div>
							<div class="row">
					    		<div class="form-group col-md-3">
							      	<label for="inputZip">Quantity</label>
							      	<input type="text" class="form-control form-control-sm" id="quantity" name="quantity" placeholder="Quantity here...">
					    		</div>
							    <div class="form-group col-md-4">
							      	<label for="inputCity">Price [Rs]</label>
							      	<input type="text" class="form-control form-control-sm" id="price" name="price" placeholder="Price per item (eg:- XXXXX.XX)">
							    </div>
							    <div class="form-group col-md-5">
							      	<label for="inputState">Purchased Date</label>
							      	<input type="text" class="form-control form-control-sm" id="purchased_date" name="purchased_date" placeholder="DD/MM/YYYY">
							    </div>
							</div>
						    <div class="button-div">
						    	<button type="submit" class="btn btn-success btn-sm form-button" id="new_item_add_btn"><i class="fas fa-plus"></i>Add Inventory</button>
						    </div>
			  			</form>
			  		</div>
			  		<div class="alert alert-success" id="add_new_item_alert"></div>
			  	</div>
			  	
			<!-- User manage tab -->
			  	<div class="tab-pane fade" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
			  		<div class="check-condition-div">
			  			<form id="form4">
			  				<div class="row">
			  					<div class="form-group col-md-2">
							      	<label for="inputState">Title</label>
							      	<select id="title" class="form-control form-control-sm" name="title">
							        	<option selected>Choose...</option>
							        	<option value="Mr">Mr</option>
							        	<option value="Mrs">Mrs</option>
							        	<option value="Miss">Miss</option>
							      	</select>
							    </div>
							    <div class="form-group col-md-5">
							      	<label for="inputState">First Name</label>
							      	<input type="text" class="form-control form-control-sm" id="first_name" name="first_name" placeholder="First name here..." required>
							    </div>
							    <div class="form-group col-md-5">
							      	<label for="inputZip">Second Name</label>
							      	<input type="text" class="form-control form-control-sm" id="second_name" name="second_name" placeholder="Second name here..." required>
							    </div>
							</div>
							<div class="row">
							    <div class="form-group col-md-6">
							      	<label for="inputCity">E-mail</label>
							      	<input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="E-mail address here..." required>
							    </div>
							    <div class="form-group col-md-3">
							      	<label for="inputState">User Role</label>
							      	<select id="userrole" class="form-control form-control-sm" name="userrole">
							        	<option selected>Choose...</option>
							        	<option value="admin">Admin</option>
							        	<option value="manager">Manager</option>
							        	<option value="user">User</option>
							      	</select>
							    </div>
							</div>
							<div class="row">
							    <div class="form-group col-md-4">
							      	<label for="inputCity">Username</label>
							      	<input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Username here..." required>
							    </div>
							    <div class="form-group col-md-4">
							      	<label for="inputCity">Password</label>
							      	<input type="text" class="form-control form-control-sm" id="password" name="password" placeholder="Password here..." required>
							    </div>
							    <div class="form-group col-md-4">
							      	<label for="inputCity">Re-enter Password</label>
							      	<input type="text" class="form-control form-control-sm" id="re_password" name="re_password" placeholder="Password here..." required>
							    </div>
							</div>
						    <div class="button-div">
						    	<button type="submit" class="btn btn-success btn-sm form-button" id="user_submit_btn" onclick="return processForm();"><i class="fas fa-user-plus"></i>Add User</button>
						    </div>
			  			</form>
			  			<div id="user-added-div"></div>
			  		</div>

			<!-- User details table -->
			  		<div id="user-details">
			  			<table class="table table-bordered table-sm table-hover" id="user_table">
			  				<thead class="thead-dark">
			  					<tr>
			  						<th scope="col">Title</th>
			  						<th scope="col">Name</th>
			  						<th scope="col">E-mail</th>
			  						<th scope="col">User Role</th>
			  						<th scope="col">Action</th>
			  					</tr>
			  				</thead>
			  				<tbody class="">
			  				<?php 

			  					$sql_users = "SELECT * FROM users";
			  					$sql_users_result = mysqli_query($conn,$sql_users);

			  					while ($row = mysqli_fetch_array($sql_users_result)) {
			  				?>
			  					<tr id="row<?php echo $row['id']; ?>">
			  						<td><?php echo $row["title"]; ?></td>
			  						<td><?php echo $row["first_name"]." ".$row["second_name"] ?></td>
			  						<td><?php echo $row["email"] ?></td>
			  						<td><?php echo $row["user_type"] ?></td>
			  						<td>
			  							<form id="user_delete_form">
			  								<button class="btn btn-danger btn-sm user_del_btn" id="<?php echo $row['id']; ?>"><i class="fas fa-user-times"></i>Remove</button>
					                    </form>
			  						</td>
			  					</tr>
			  				<?php				
			  					}

			  				?>
			  				</tbody>
			  			</table>
			  		</div>
			  	</div>
			</div>
		</div>
	</div>
</body>
</html>