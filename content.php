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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="js/content_functions.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script src="js/printThis.js"></script>

	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="js/jquery.table2excel.js"></script>
	<script src="js/xlsx.core.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.12.0/validate.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.2/jspdf.plugin.autotable.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.15/jspdf.plugin.autotable.src.js"></script>
    <script src="js/html2canvas.js"></script>
	<script src="js/tableHTMLExport.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>

	<link rel="stylesheet" href="css/dcalendar.picker.css">
	<script src="js/dcalendar.picker.js"></script>

	<script src="js/script.js"></script>
	<link rel="stylesheet" href="css/style.css">
	
	<title>IMS | Home</title>
</head>
<body>
	<script type="text/javascript">
		////////////////////////////////////////document ready functions//////////////////////////////////////////
		$(document).ready(function(){
			
			$(".check-condition-div-1").hide();
			$("#item_status_check").click(function(){
				if ($(this).prop("checked")) {
					$(".check-condition-div-1").show(200);
				}else {
					$(".check-condition-div-1").hide(200);
				}
			});
			$(".check-condition-div-2").hide();
			$("#item_status_update_check").click(function(){
				if ($(this).prop("checked")) {
					$(".check-condition-div-2").show(200);
				}else {
					$(".check-condition-div-2").hide(200);
				}
			});
			$("#serial_num").hide();
			$("#serial_num_check").click(function(){
				if ($(this).prop("checked")) {
					$("#serial_num").show(200);
				}else {
					$("#serial_num").hide(200);
				}
			});

			$("#add_new_item_alert").hide();

			$("#calendar-div").dcalendar();
			$("#download-pdf-btn").addClass('disabled');
			$("#download-excel-btn").addClass('disabled');
			$("#print-table-btn").addClass('disabled');
			$("#refresh-btn").addClass('disabled');
			$("#users-tbl-show-div").hide();

			$("#user-reg-alert").hide();

			$("#form1-1-div").hide();
		});

		$( function() {
		    $("#form2 #purchased_date").datepicker({ dateFormat: 'dd/mm/yy' });
		});

		/////////////////////////////////////check inventory functions///////////////////////////////////////////
		//check form div visibility controls 
		$(function(){
			$("#search-type").click(function(){
				var searchVal = $("#search-type").val();
				if (searchVal == "val1") {
					$("#form1-div").show();
					$("#form1-1")[0].reset();
					$("#form1-1-div").hide();
				}else if(searchVal == "val2"){
					$("#form1")[0].reset();
					$("#form1-div").hide();
					$("#form1-1-div").show();
				}
			});
		});
		//location-wise inventory check
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
						$("#download-pdf-btn").removeClass('disabled');
						$("#download-excel-btn").removeClass('disabled');
						$("#print-table-btn").removeClass('disabled');
						$("#refresh-btn").removeClass('disabled');
					}
				});
			});
		});
		//inventory-wise inventory check
		$(function(){
			$("#form1-1").on('submit', function(e5){
				e5.preventDefault();

				var check_inventory_wise = $("#check_inventory_item").val();
				$.ajax({
					type: 'POST',
					url: 'check_item_wise.php',
					data: {check_inventory_wise:check_inventory_wise},
					success: function(data5){
						$("#table-content").html(data5);
						$("#download-pdf-btn").removeClass('disabled');
						$("#download-excel-btn").removeClass('disabled');
						$("#print-table-btn").removeClass('disabled');
						$("#refresh-btn").removeClass('disabled');
					}
				});
			});
		});
		//add inventory status 
		$(function(){
			$("#form_status").on('submit',function(e7){
				e7.preventDefault();

				var status_location = $("#status_locations").val();
				var status_item_name = $("#status_item_name").val();
				var status_item_code = $("#status_item_code").val();
				var item_status = $("#item_status").val();
				$.ajax({
					type: 'POST',
					url: 'status.php',
					data: {status_location:status_location,status_item_name:status_item_name,status_item_code:status_item_code,item_status:item_status},
					success: function(data7){
						$("#form_status")[0].reset();
						$("#status-alert-div").html(data7).show();
					}
				});
			});
		});
		//update inventory status
		$(function(){
			$("#form_status_update").on('submit',function(e8){
				e8.preventDefault();

				var update_status_code = $("#update_status_code").val();
				var update_status = $("#update_status").val();
				$.ajax({
					type: 'POST',
					url: 'update_status.php',
					data: {update_status_code:update_status_code,update_status:update_status},
					success: function(data8){
						$("#form_status_update")[0].reset();
						$("#status-update-alert-div").html(data8).show();
					}
				});
			});
		});
		//check item table download function
		$(function(){ 		
			$("#download-pdf-btn").click(function () {
				var oc = $("#sub_locations").val();
				var ac = $("#check_inventory_item").val();
				
				var doc = new jsPDF('l', 'pt', 'a4');
				var elem = $("#table-content table").clone();
				elem.find('tr th:nth-child(10), tr td:nth-child(10)').remove();
    			var res = doc.autoTableHtmlToJson(elem.get(0));
    			doc.setFontSize(15);
    			doc.text('Technology Faculty of SUSL', 330, 40);
    			doc.setFontSize(12);
    			doc.text('Inventory Details Report', 360, 60);
    			if (oc !== '') {
    				doc.setFontSize(11);
    				doc.text('Location : '+oc, 25, 80);
    			}
    			else if(ac !== '') {
    				doc.setFontSize(11);
    				doc.text('Inventory Name : '+ac, 25, 80);
    			}
    			
				doc.autoTable(res.columns, res.data,{
					theme: 'grid',
					margin: {top: 90, right: 25, bottom: 30, left: 25},
					bodyStyles: {rowHeight: 20, halign: 'left'},
					styles:{
						tableWidth: 'auto',
						cellWidth: 'wrap',
						font: 'helvetica',
						fontSize: 9.5,
						overflow: 'linebreak',
						halign: 'center',
						valign: 'middle'
					},
					columnStyles: {
						5: {halign: 'right'},
						6: {halign: 'right'},
						7: {halign: 'right'}
					}
				});
				doc.save('ims.pdf');
			    
			});
		});

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
				var inventory_status = $("#inventory_status").val();
				$.ajax({
					type: 'POST',
					url: 'add_new_item.php',
					data: {main_location:main_location, sub_location:sub_location, main_inventory_type:main_inventory_type, sub_inventory_type:sub_inventory_type, inventory_code:inventory_code, serial_num:serial_num, quantity:quantity, price:price, purchased_date:purchased_date,inventory_status:inventory_status},
					success: function(data3){
						$("#form2")[0].reset();
						$("#serial_num").hide(200);
						$("#add_new_item_alert").html(data3).show();
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
					success: function(data4){
						$("#users-tbl-show-div").hide();
						$("#user-reg-alert").html(data4).show();
						$("#form4")[0].reset();
					}
				});
			});
		});
		//users table show function
		$(function(){
			$("#show_user_button").click(function(){
				var show_tbl_val = $(this).val();
				$("#users-tbl-show-div").toggle(100, function(){
					$.ajax({
						type : "POST",
						url : "user_details.php",
						data : {show_tbl_val:show_tbl_val},
						success : function(show){
							$("#users-tbl-show-div").html(show);
						}
					});
				});
			});
		});
	</script>
	<div id="page-header">
		<h4>Inventory Management System</h4>
	</div>
	<div class="content-div row">
		<div class="col-md-3" id="side-panel"> 
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
				<a href="log_out.php" class="btn btn-danger btn-sm"><b>Log out</b></a>
			</div>
			<ul class="nav nav-tabs flex-column" id="nav-tab" role="tablist">
				<?php 
					if (isset($_SESSION["user_type"])) {
						if ($_SESSION["user_type"] == "admin") {
							echo '<li class="nav-item" id="check-tab"><a class="nav-link active" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check Inventory</a></li>';
							echo '<li class="nav-item" id="user-tab"><a class="nav-link" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-users"></i><span class="verticle-line"></span>Manage Users</a></li>';
						}elseif ($_SESSION["user_type"] == "manager") {
							echo '<li class="nav-item" id="check-tab"><a class="nav-link active" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check Inventory</a></li>';
							echo '<li class="nav-item" id="add-tab"><a class="nav-link" id="nav-submit-tab" data-toggle="tab" href="#nav-submit" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-plus"></i><span class="verticle-line"></span>Add Inventory</a></li>';
						}elseif ($_SESSION["user_type"] == "user") {
							echo '<li class="nav-item" id="check-tab"><a class="nav-link active" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check Inventory</a></li>';
						}
					}
				?>
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
			  			<div class="row">
			  				<div class="col-md-5">
			  					<label for="inputState">Select the Searching method</label>
			  					<select class="form-control form-control-sm" name="search-type" id="search-type">
			  						<option value="val1" selected>Sub Location wise</option>
			  						<option value="val2">Inventory wise</option>
			  					</select>
			  				</div>
			  				<div class="col-md-1">
			  					<div class="verticle-line-check"></div>
			  				</div>
			  				<div class="col-md-6" id="form1-div">
			  					<form id="form1">
									<div class="row" class="check-condition-div">
									    <div class="form-group col-md-12">
									      	<label for="inputState">Sub Location</label>
									      	<select class="form-control form-control-sm" name="sub_locations" id="sub_locations">
									        	<option value="" selected>Choose...</option>
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
							    <div class="col-md-6">
							    	<div id="check-alert-div"></div>
							    </div>
			  				</div>
			  				<div class="col-md-6" id="form1-1-div">
			  					<form id="form1-1">
									<div class="row" class="check-condition-div">
									    <div class="form-group col-md-12">
									      	<label for="inputState">Inventory Name</label>
									      	<input type="text" class="form-control form-control-sm" id="check_inventory_item" name="check_inventory_item" placeholder="Eg:- Visitor Chair">
									    </div>
									</div>
									<div class="button-div" id="check-button-div">
								    	<button type="submit" class="btn btn-success btn-sm form-button" id="check_button1"><i class="fas fa-search"></i>Check Inventory</button>
								    </div>
								</form>
							    <div class="col-md-6">
							    	<div id="check-alert-div1"></div>
							    </div>
			  				</div>
			  			</div>
			  		</div>
					<div id="table-content"></div>
					<div id="editor"></div>
					<div id="print-button-div">
						<button class="btn btn-primary btn-sm" id="download-pdf-btn"><i class="fas fa-file-pdf fa-lg"></i><b>PDF</b></button>
						<button class="btn btn-success btn-sm" id="download-excel-btn" onclick="exportTableToExcel()"><i class="fas fa-file-excel fa-lg"></i><b>EXCEL</b></button>
					</div>

					<hr><br>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group col-md-12">
				    			<div id="">
				    				<input class="form-check-input" type="checkbox" id="item_status_update_check">
					    			<label for="inputZip">Update inventory status</label>
				    			</div>
				    		</div>
  							<div class="col-md-12  check-condition-div-2">
  								<div id="status-update-alert-div"></div>
	  								<form id="form_status_update">
	  									<div class="row">
										<div class="form-group col-md-7">
											<label for="inputState">Inventory Code</label>
		  									<input type="text" class="form-control form-control-sm" id="update_status_code" name="update_status_code" placeholder="Enter inventory code here...">
										</div>
									    <div class="form-group col-md-5">
									      	<label for="inputState">Status</label>
									      	<input type="text" class="form-control form-control-sm" id="update_status" name="update_status" placeholder="Enter inventory status here...">
									    </div>
									</div>
									<div class="button-div" id="check-button-div">
								    	<button type="submit" class="btn btn-success btn-sm form-button" id="update_status_button"><i class="fas fa-edit"></i>Update Status</button>
								    </div>
  								</form>
  							</div>
						</div>
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
							<div class="row" id="status-row">
								<div class="form-group col-md-3">
									<label for="inputZip">Status</label>
							      	<input type="text" class="form-control form-control-sm" id="inventory_status" name="inventory_status" placeholder="Status here...">
								</div>
							</div>
						    <div class="button-div">
						    	<button type="submit" class="btn btn-success btn-sm form-button" id="new_item_add_btn"><i class="fas fa-plus"></i>Add Inventory</button>
						    </div>
			  			</form>
			  		</div>
			  		<div id="add_new_item_alert"></div>
			  	</div>
			  	
			<!-- User manage tab -->
			  	<div class="tab-pane fade" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
			  		<div class="check-condition-div">
			  			<form id="form4">
			  				<div class="row">
			  					<div class="form-group col-md-2">
							      	<label for="inputState">Title</label>
							      	<select id="title" class="form-control form-control-sm" name="title">
							        	<option value="" selected>Choose...</option>
							        	<option value="Mr">Mr</option>
							        	<option value="Mrs">Mrs</option>
							        	<option value="Miss">Miss</option>
							      	</select>
							    </div>
							    <div class="form-group col-md-5">
							      	<label for="inputState">First Name</label>
							      	<input type="text" class="form-control form-control-sm" id="first_name" name="first_name" placeholder="First name here...">
							    </div>
							    <div class="form-group col-md-5">
							      	<label for="inputZip">Second Name</label>
							      	<input type="text" class="form-control form-control-sm" id="second_name" name="second_name" placeholder="Second name here...">
							    </div>
							</div>
							<div class="row">
							    <div class="form-group col-md-6">
							      	<label for="inputCity">E-mail</label>
							      	<input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="E-mail address here...">
							    </div>
							    <div class="form-group col-md-3">
							      	<label for="inputState">User Role</label>
							      	<select id="userrole" class="form-control form-control-sm" name="userrole">
							        	<option value="" selected>Choose...</option>
							        	<option value="admin">Admin</option>
							        	<option value="manager">Manager</option>
							        	<option value="user">User</option>
							      	</select>
							    </div>
							</div>
							<div class="row">
							    <div class="form-group col-md-4">
							      	<label for="inputCity">Username</label>
							      	<input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Username here...">
							    </div>
							    <div class="form-group col-md-4">
							      	<label for="inputCity">Password</label>
							      	<input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password here...">
							    </div>
							    <div class="form-group col-md-4">
							      	<label for="inputCity">Confirm Password</label>
							      	<input type="password" class="form-control form-control-sm" id="re_password" name="re_password" placeholder="Re-enteer password here...">
							    </div>
							</div>
						    <div class="button-div">
						    	<button type="submit" class="btn btn-success btn-sm form-button" id="user_submit_btn"><i class="fas fa-user-plus"></i>Add User</button>
						    </div>
			  			</form>
			  		</div>
			  		<div id="user-reg-alert"></div>

			<!-- User details table -->
			  		<div id="user-details">
			  			<button type="submit" class="btn btn-warning btn-sm form-button" id="show_user_button">Show/Hide Users</button>
			  			<div id="users-tbl-show-div"></div>
			  		</div>
			  	</div>
			</div>
		</div>
	</div>
	<script>
		/*$(function(){
			$("#download-excel-btn").click(function () {
				var htmltable= document.getElementById('check-table');
			    var html = htmltable.outerHTML;
			    window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
				//$("#check-table").table2excel();
			});
		});*/
		function exportTableToExcel(tableID, filename = ''){
		    var downloadLink;
		    var dataType = 'application/vnd.ms-excel';
		    var tableSelect = document.getElementById('check-table');
		    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
		    
		    // Specify file name
		    filename = filename?filename+'.xls':'ims.xls';
		    
		    // Create download link element
		    downloadLink = document.createElement("a");
		    
		    document.body.appendChild(downloadLink);
		    
		    if(navigator.msSaveOrOpenBlob){
		        var blob = new Blob(['\ufeff', tableHTML], {type: dataType});
		        navigator.msSaveOrOpenBlob(blob, filename);
		    }else{
		        // Create a link to the file
		        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
		    
		        // Setting the file name
		        downloadLink.download = filename;
		        
		        //triggering the function
		        downloadLink.click();
		    }
		}
	</script>
</body>
</html>