<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="css/content-style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<script type="text/javascript" src="inventory-form-functions.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
	<script src="js/jquery.calendar.js"></script>
	<link rel="stylesheet" href="css/jquery.calendar.css">
	<script src="js/script.js"></script>
	<link rel="stylesheet" href="css/style.css">
	
	<title>IMS | Home page</title>
</head>
<body>
	<script type="text/javascript">
		$(function () {
		  	$('#calendar-div').calendar({
		  		months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Augest', 'September', 'October', 'November', 'December'],
		  		days: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
		  		color: '#198406'
		  	});
		});
	</script>
	<div id="page-header">
		<h4>Inventory Management System</h4>
	</div>
	<div class="content-div row">
		<div class="col-md-3"> 
			<div id="logout-div">
				<h4>Hello! #user001</h4>
				<button class="btn btn-danger">Log out</button>
			</div>
			<ul class="nav nav-tabs flex-column" id="nav-tab" role="tablist">
			  	<li class="nav-item">
			    	<a class="nav-link active" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check Inventory</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" id="nav-submit-tab" data-toggle="tab" href="#nav-submit" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-list-ul"></i><span class="verticle-line"></span>Add Existing Inventory</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" id="nav-new-tab" data-toggle="tab" href="#nav-new" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-plus"></i><span class="verticle-line"></span>Add New Inventory</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-user"></i><span class="verticle-line"></span>Manage Users</a>
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
			  	<div class="tab-pane fade show active" id="nav-check" role="tabpanel" aria-labelledby="nav-check-tab">
					<form id="form1">
						<div class="form-row" id="check-condition-div">
						    <div class="form-group col-md-4">
						      	<label for="inputCity">Main Location</label>
						      	<select id="inputState" class="form-control form-control-sm">
						        	<option selected>Choose...</option>
						        	<option>All</option>
						      	</select>
						    </div>
						    <div class="form-group col-md-4">
						      	<label for="inputState">Sub Location</label>
						      	<select id="inputState" class="form-control form-control-sm">
						        	<option selected>Choose...</option>
						        	<option>All</option>
						      	</select>
						    </div>
						    <div class="form-group col-md-4">
						      	<label for="inputZip">Inventory Type</label>
						      	<select id="inputState" class="form-control form-control-sm">
						        	<option selected>Choose...</option>
						        	<option>...</option>
						      	</select>
						    </div>
						    <div id="check-button-div">
						    	<button type="button" class="btn btn-success form-button"><i class="fas fa-search"></i>Check</button>
						    </div>
						</div>
					</form>
					<div class="table-content">
						<table class="table table-bordered table-sm">
							<thead class="thead-dark">
								<tr>
									<th>Inventory Code</th>
									<th>Sub Inventory Name</th>
									<th>Quantity</th>
									<th>Price per item</th>
									<th>Total</th>
									<th>Delete</th>
								</tr>
							</thead>
						</table>
					</div>
			  	</div>

			  	<!-- Submit inventory tab -->
			  	<div class="tab-pane fade" id="nav-submit" role="tabpanel" aria-labelledby="nav-submit-tab">
			  		<div id="check-condition-div">
			  			<form id="form2">
			  				<div class="form-row" >
							    <div class="form-group col-md-6">
							      	<label for="inputCity">Main Location</label>
							      	<select id="inputState" class="form-control form-control-sm">
							        	<option selected>Choose...</option>
							        	<option>All</option>
							      	</select>
							    </div>
							    <div class="form-group col-md-6">
							      	<label for="inputState">Sub Location</label>
							      	<select id="inputState" class="form-control form-control-sm">
							        	<option selected>Choose...</option>
							        	<option>All</option>
							      	</select>
							    </div>
							</div>
							<div class="form-row">
							    <div class="form-group col-md-6">
							      	<label for="inputZip">Main Inventory Type</label>
							      	<select id="inputState" class="form-control form-control-sm">
							        	<option selected>Choose...</option>
							        	<option>...</option>
							      	</select>
							    </div>
							    <div class="form-group col-md-6">
							      	<label for="inputCity">Sub Inventory Type</label>
							      	<select id="inputState" class="form-control form-control-sm">
							        	<option selected>Choose...</option>
							        	<option>All</option>
							      	</select>
							    </div>
							</div>
							<div class="form-row">
							    <div class="form-group col-md-6">
							      	<label for="inputState">Inventory Code</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Inventory code here...">
							    </div>
							    <div class="form-group col-md-6">
							      	<label for="inputZip">Quantity</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Quantity here...">
							    </div>
							</div>
							<div class="form-row">
							    <div class="form-group col-md-6">
							      	<label for="inputCity">Price</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Price per item here...">
							    </div>
							    <div class="form-group col-md-6">
							      	<label for="inputState">Purchased Date</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Purchased date here...">
							    </div>
							</div>
						    <div id="check-button-div">
						    	<button type="button" class="btn btn-success form-button"><i class="fas fa-plus"></i>Add Inventory</button>
						    </div>
			  			</form>
			  		</div>
			  	</div>

			  	<!-- Add new inventory tab -->
			  	<div class="tab-pane fade" id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">
			  		<div id="check-condition-div">
			  			<form id="form3">
			  				<div class="form-row">
							    <div class="form-group col-md-6">
							      	<label for="inputState">Main Inventory Name</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Inventory code here...">
							    </div>
							    <div class="form-group col-md-6">
							      	<label for="inputZip">Main Inventory Code</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Quantity here...">
							    </div>
							</div>
							<div class="form-row">
							    <div class="form-group col-md-6">
							      	<label for="inputCity">Sub Inventory Name</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Price per item here...">
							    </div>
							    <div class="form-group col-md-6">
							      	<label for="inputState">Sub Inventory Code</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Purchased date here...">
							    </div>
							</div>
						    <div id="check-button-div">
						    	<button type="button" class="btn btn-success form-button"><i class="fas fa-plus"></i>Add Inventory</button>
						    </div>
			  			</form>
			  		</div>
			  	</div>

			  	<!-- User manage tab -->
			  	<div class="tab-pane fade" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
			  		<div id="check-condition-div">
			  			<form id="form4">
			  				<div class="form-row">
			  					<div class="form-group col-md-2">
							      	<label for="inputState">Title</label>
							      	<select id="inputState" class="form-control form-control-sm">
							        	<option selected>Choose...</option>
							        	<option>Mr</option>
							        	<option>Mrs</option>
							        	<option>Miss</option>
							      	</select>
							    </div>
							    <div class="form-group col-md-5">
							      	<label for="inputState">First Name</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="First name here...">
							    </div>
							    <div class="form-group col-md-5">
							      	<label for="inputZip">Second Name</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Second here...">
							    </div>
							</div>
							<div class="form-row">
							    <div class="form-group col-md-6">
							      	<label for="inputCity">E-mail</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="E-mail address here...">
							    </div>
							    <div class="form-group col-md-3">
							      	<label for="inputState">User Role</label>
							      	<select id="inputState" class="form-control form-control-sm">
							        	<option selected>Choose...</option>
							        	<option>Admin</option>
							        	<option>Manager</option>
							        	<option>User</option>
							      	</select>
							    </div>
							</div>
							<div class="form-row">
							    <div class="form-group col-md-4">
							      	<label for="inputCity">Username</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Username here...">
							    </div>
							    <div class="form-group col-md-4">
							      	<label for="inputCity">Password</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Password here...">
							    </div>
							    <div class="form-group col-md-4">
							      	<label for="inputCity">Re-enter Password</label>
							      	<input type="text" class="form-control form-control-sm" placeholder="Password here...">
							    </div>
							</div>
						    <div id="check-button-div">
						    	<button type="button" class="btn btn-success form-button"><i class="fas fa-plus"></i>Add User</button>
						    </div>
			  			</form>
			  		</div>
			  	</div>
			</div>
		</div>
	</div>
</body>
</html>