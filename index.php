<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="css/index-style.css">
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
	<title>IMS | User Login</title>
</head>
<body>
	<div class="login-section-background">
		<div id="page-header">
			<h1>Faculty of Technology - SUSL</h1>
			<h3>Inventory Management System</h3>
		</div>
		<!--div class="home-page-title">
			<h3>Inventory Management System</h3>
		</div>
		<div class="home-page-content-divider"></div-->
		<div id="form-div">
			<div id="login-header">
				<h4>User Login</h4>
			</div>
			<form>
				<div class="form-group">
					<label class="label-titles">Select your role</label><br>
					<div class="form-check form-check-inline" id="radio-button-1">
					  	<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
					  	<label class="form-check-label" for="inlineRadio1">Admin</label>
					</div>
					<div class="form-check form-check-inline"  id="radio-button-2">
					  	<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
					  	<label class="form-check-label" for="inlineRadio2">Manager</label>
					</div>
					<div class="form-check form-check-inline"  id="radio-button-3">
					  	<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
					  	<label class="form-check-label" for="inlineRadio3">User</label>
					</div>
				</div>
				<div class="form-group">
				    <label class="label-titles" for="exampleInputText1">Username</label>
				    <input type="text" class="form-control" id="exampleInputText1" aria-describedby="emailHelp" placeholder="Enter Username">
				</div>
				<div class="form-group">
				    <label class="label-titles" for="exampleInputPassword1">Password</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
				</div>
				<div id="login-button-div">
					<button type="submit" class="btn btn-success">Login</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>