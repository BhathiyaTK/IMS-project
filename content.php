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

if ((isset($_SESSION["username"])) && (isset($_SESSION["user_type"]))) {
	if (($_SESSION["username"] == '')&&($_SESSION["user_type"] == '')) {
		
		header("location: index.php");

	}else{
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="css/content-style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
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

		$(window).on("load", function() {
			$(".se-pre-con").fadeOut("slow");
		});
		////////////////////////////////////////document ready functions//////////////////////////////////////////
		$(document).ready(function(){

			$.fn.digits = function(){ 
			    return this.each(function(){ 
			        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
			    })
			}
			$(".numbers").digits();

			$(".item_del_btn").click(function(){
				$('#confirm_del_modal').modal('show');
			});
			
			$(".check-condition-div-1").hide();
			$(".check-condition-div-2").hide();
			$(".main_loc_table_view").hide();
			$(".sub_loc_table_view").hide();

			$("#item_status_check").click(function(){
				if ($(this).prop("checked")) {
					$(".check-condition-div-1").show(100);
				}else {
					$(".check-condition-div-1").hide(100);
				}
			});
			$("#update_status_check_btn").click(function(){
				if ($(this).prop("checked")) {
					$(".check-condition-div-2").show(100);
				}else {
					$(".check-condition-div-2").hide(100);
				}
			});
			$("#serial_num").hide();
			$("#serial_num_check").click(function(){
				if ($(this).prop("checked")) {
					$("#serial_num").show(100);
				}else {
					$("#serial_num").hide(100);
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

			$("#form1-div").hide();
			$("#form1-1-div").hide();

			$("#form-loc-div2").hide();
		});

		$( function() {
		    $("#form2 #purchased_date").datepicker({ dateFormat: 'dd/mm/yy' });
		});

		function showDetails(re_invent_id){
			$.ajax({
				type : "POST",
				url : "view_recover_invent.php",
				data : {re_invent_id:re_invent_id},
				success: function(result1){
					$("#re_invent_modal_content").html(result1);
				}
			});
		}

		/////////////////////////////////////check inventory functions///////////////////////////////////////////

		//main and sub location div visibility control-----------------
		$(function(){
			$("#location-type").click(function(){
				var locVal = $("#location-type").val();
				if (locVal == "main") {
					$("#form-loc-div1").show();
					$("#form-loc1")[0].reset();
					$("#form-loc-div2").hide();
				}else if(locVal == "sub"){
					$("#form-loc-div2").show();
					$("#form-loc2")[0].reset();
					$("#form-loc-div1").hide();
				}
			});
		});
		//check form div visibility controls--------------------------- 
		$(function(){
			$("#search-type").click(function(){
				var searchVal = $("#search-type").val();
				if (searchVal == "val1") {
					$("#form1-div").show();
					$("#form1-1")[0].reset();
					$("#form1-1-1")[0].reset();
					$("#form1-1-div").hide();
					$("#form1-1-1-div").hide();
				}else if(searchVal == "val2"){
					$("#form1-1-div").show();
					$("#form1")[0].reset();
					$("#form1-1-1")[0].reset();
					$("#form1-div").hide();
					$("#form1-1-1-div").hide();
				}else if(searchVal == "val3"){
					$("#form1-1-1-div").show();
					$("#form1")[0].reset();
					$("#form1-1")[0].reset();
					$("#form1-div").hide();
					$("#form1-1-div").hide();
				}
			});
		});
		//main-location-wise inventory check----------------------------
		$(function(){
			$("#form1-1-1").on('submit', function(e2){
				e2.preventDefault();

				var check_main_location = $("#main_locations").val();
				$.ajax({
					type: 'POST',
					url: 'check_item_main.php',
					data: {check_main_location:check_main_location},
					success: function(data9){
						$("#table-content").html(data9);
						$("#download-pdf-btn").removeClass('disabled');
						$("#download-excel-btn").removeClass('disabled');
						$("#print-table-btn").removeClass('disabled');
						$("#refresh-btn").removeClass('disabled');

						$.fn.digits = function(){ 
						    return this.each(function(){ 
						        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
						    })
						}
						$("#check-table .numbers").digits();
						$("#total-view-div .numbers").digits();
					}
				});
			});
		});
		//sub-location-wise inventory check-----------------------------
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

						$.fn.digits = function(){ 
						    return this.each(function(){ 
						        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
						    })
						}
						$("#check-table .numbers").digits();
						$("#total-view-div .numbers").digits();
					}
				});
			});
		});
		//inventory-wise inventory check--------------------------------
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

						$.fn.digits = function(){ 
						    return this.each(function(){ 
						        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
						    })
						}
						$("#check-table .numbers").digits();
						$("#total-view-div .numbers").digits();
					}
				});
			});
		});
		//update inventory status---------------------------------------
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
		//check item table download function----------------------------
		$(function(){ 		
			$("#download-pdf-btn").click(function () {
				var xy = $("#main_locations option:selected").text();
				var xy1 = $("#main_locations option:selected").val();
				var oc = $("#sub_locations option:selected").text();
				var oc1 = $("#sub_locations option:selected").val();
				var ac = $("#check_inventory_item").val();
				var sum = $("#table-content #total-view-div #full-total-value").text();

				var d = new Date();
				
				var doc = new jsPDF('l', 'pt', 'a4');
				var elem = $("#table-content table").clone();
				elem.find('tr th:nth-child(10), tr td:nth-child(10)').remove();
    			var res = doc.autoTableHtmlToJson(elem.get(0));
    			doc.setFontSize(19);
    			doc.text('Faculty of Technology, SUSL', 300, 40);
    			doc.setFontSize(14);
    			doc.text('Inventory Details Report', 345, 60);

    			if (oc1 !== '') {
    				doc.setFontSize(12);
    				doc.text('Location : '+oc, 25, 90);
    			}
    			else if(ac !== '') {
    				doc.setFontSize(12);
    				doc.text('Inventory Name : '+ac, 25, 90);
    			}
    			else if(xy1 !== '') {
    				doc.setFontSize(12);
    				doc.text('Location : '+xy, 25, 90);
    			}

    			doc.setFontSize(10);
    			doc.text(sum, 25, 110);
    			doc.setFontSize(10);
    			doc.text('Date : '+d, 518, 110);
    			
				doc.autoTable(res.columns, res.data,{
					theme: 'grid',
					margin: {top: 130, right: 25, bottom: 30, left: 25},
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
				doc.save('Inventory Report.pdf');
			    
			});
		});

		//add new item part---------------------------------------------
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

		//user manage part----------------------------------------------
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
						$("#show_user_button i").addClass("fa-eye");
						$("#show_user_button i").removeClass("fa-eye-slash");
					}
				});
			});
		});
		//users table show function-------------------------------------
		$(function(){
			$("#show_user_button").click(function(){
				var show_tbl_val = $(this).val();
				$("i", this).toggleClass("fa-eye-slash fa-eye");
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

		//location manage fuctions------------------------------------
		$(function(){
			$("#form-loc1").on('submit', function(e1){
				e1.preventDefault();

				var m_locationVal = $("#location-type").val();
				var m_locationCode = $("#add_main_loc_code").val();
				var m_locationName = $("#add_main_loc_name").val();
				$.ajax({
					type : "POST",
					url : "add_main_loc.php",
					data : {m_locationVal:m_locationVal,m_locationCode:m_locationCode,m_locationName:m_locationName},
					success : function(m_location){
						$("#loc-alert-div").html(m_location);
						$(".main_loc_table_view").hide();
						$(".sub_loc_table_view").hide();
						$("#form-loc1")[0].reset();
						$("#view_main_loc_btn i").addClass("fa-eye");
						$("#view_main_loc_btn i").removeClass("fa-eye-slash");
						$("#view_sub_loc_btn i").addClass("fa-eye");
						$("#view_sub_loc_btn i").removeClass("fa-eye-slash");
					}
				});
			});
		});

		$(function(){
			$("#form-loc2").on('submit', function(e6){
				e6.preventDefault();

				var s_locationVal = $("#location-type").val();
				var s_m_locationCode = $("#main_loc_select").val();
				var s_locationCode = $("#add_sub_loc_code").val();
				var s_locationName = $("#add_sub_loc_name").val();
				$.ajax({
					type : "POST",
					url : "add_sub_loc.php",
					data : {s_locationVal:s_locationVal,s_m_locationCode:s_m_locationCode,s_locationCode:s_locationCode,s_locationName:s_locationName},
					success : function(s_location){
						$("#loc-alert-div").html(s_location);
						$(".sub_loc_table_view").hide();
						$(".main_loc_table_view").hide();
						$("#form-loc2")[0].reset();
						$("#view_main_loc_btn i").addClass("fa-eye");
						$("#view_main_loc_btn i").removeClass("fa-eye-slash");
						$("#view_sub_loc_btn i").addClass("fa-eye");
						$("#view_sub_loc_btn i").removeClass("fa-eye-slash");
					}
				});
			});
		});

		$(function(){
			$("#view_main_loc_btn").click(function(){
				var show_main_loc_tbl = $(this).val();
				$("i", this).toggleClass("fa-eye-slash fa-eye");
				$("#view_sub_loc_btn i").addClass("fa-eye");
				$("#view_sub_loc_btn i").removeClass("fa-eye-slash");
				$(".main_loc_table_view").toggle(10,function(){
					$.ajax({
						type : "POST",
						url : "view_main_loc.php",
						data : {show_main_loc_tbl:show_main_loc_tbl},
						success : function(show1){
							$(".main_loc_table_view").html(show1);
							$(".sub_loc_table_view").hide();
						}
					});
				});
			});
		});

		$(function(){
			$("#view_sub_loc_btn").click(function(){
				var show_sub_loc_tbl = $(this).val();
				$("i", this).toggleClass("fa-eye-slash fa-eye");
				$("#view_main_loc_btn i").addClass("fa-eye");
				$("#view_main_loc_btn i").removeClass("fa-eye-slash");
				$(".sub_loc_table_view").toggle(10,function(){
					$.ajax({
						type : "POST",
						url : "view_sub_loc.php",
						data : {show_sub_loc_tbl:show_sub_loc_tbl},
						success : function(show2){
							$(".sub_loc_table_view").html(show2);
							$(".main_loc_table_view").hide();
						}
					});
				});
			});
		});

		//Recovery tab functions ------------------------------------
		$(function(){
			$("#refresh_btn").click(function(){
				var refresh_tbl_val = $(this).val();
				$(".re_invent_table_view").show(function(){
					$.ajax({
						type : "POST",
						url : "refresh_table.php",
						data : {refresh_tbl_val:refresh_tbl_val},
						success : function(refresh){
							$(".re_invent_table_view").html(refresh);
						}
					});
				});
			});
		});
		$(function() {
	        $(".recovery_del_btn").click(function() {
	            var item_id = $(this).attr("id");
	            var info1 = 'id=' + item_id;
	            if (confirm("Sure? This cannot be undone later.")) {
	                $.ajax({
	                    type : "POST",
	                    url : "delete_recovery.php",
	                    data : info1,
	                    success : function() {
	                    	$("#row"+item_id).remove();
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
	
	<div class="content-div">
		<div id="side-panel">
			<div id="logout-div">
				<?php if(isset($_SESSION["username"])){ ?>
					<h5>Welcome!</h5><h4><?php echo " ".$_SESSION["title"].". ".$_SESSION["first_name"]; ?></h4>
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
				<a href="log_out.php" class="btn btn-danger btn-sm"><b>LOG OUT<i id="log_out_icon" class="fas fa-sign-out-alt fa-lg"></i></b></a>
			</div>
			<div class="side-panel-divider"></div>
			<div id="calendar-div"></div>
			<br>
			<div id="clock" class="dark">
				<div class="display">
					<div class="digits"></div>
					<div class="ampm"></div>
				</div>
			</div>
		</div>
		<div id="main-content-panel">

			<div id="page-header">
				<h3>Inventory Management System</h3>
			</div>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="side-panel-troggler">
			  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			    	<span class="navbar-toggler-icon"></span>
			  	</button>
			  	<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			  		<ul class="nav nav-tabs flex-column" id="mobile-navi">
			  			<?php 
							if (isset($_SESSION["user_type"])) {
								if ($_SESSION["user_type"] == "admin") {
									echo '<li class="nav-item" id="check-tab"><a class="nav-link active" id="nav-dash-tab" data-toggle="tab" href="#nav-dash" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-chart-line"></i><span class="verticle-line"></span>Dashboard</a></li>';
									echo '<li class="nav-item" id="check-tab"><a class="nav-link" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check</a></li>';
									echo '<li class="nav-item" id="user-tab"><a class="nav-link" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-users"></i><span class="verticle-line"></span>Users</a></li>';
									echo '<li class="nav-item" id="location-tab"><a class="nav-link" id="nav-location-tab" data-toggle="tab" href="#nav-location" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-map-marker-alt"></i><span class="verticle-line"></span>Locations</a></li>';
									echo '<li class="nav-item" id="more-tab"><a class="nav-link" id="nav-more-tab" data-toggle="tab" href="#nav-more" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-trash"></i><span class="verticle-line"></span>More</a></li>';
								}elseif ($_SESSION["user_type"] == "manager") {
									echo '<li class="nav-item" id="check-tab"><a class="nav-link active" id="nav-dash-tab" data-toggle="tab" href="#nav-dash" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-chart-line"></i><span class="verticle-line"></span>Dashboard</a></li>';
									echo '<li class="nav-item" id="check-tab"><a class="nav-link" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check</a></li>';
									echo '<li class="nav-item" id="add-tab"><a class="nav-link" id="nav-submit-tab" data-toggle="tab" href="#nav-submit" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-plus"></i><span class="verticle-line"></span>Add</a></li>';
								}elseif ($_SESSION["user_type"] == "user") {
									echo '<li class="nav-item" id="check-tab"><a class="nav-link active" id="nav-dash-tab" data-toggle="tab" href="#nav-dash" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-chart-line"></i><span class="verticle-line"></span>Dashboard</a></li>';
									echo '<li class="nav-item" id="check-tab"><a class="nav-link" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check</a></li>';
								}
							}
						?>	
			  		</ul>
			  		<div id="logout-div">
						<?php if(isset($_SESSION["username"])){ ?>
							<h5>Welcome!</h5><h4><?php echo " ".$_SESSION["title"].". ".$_SESSION["first_name"]; ?></h4>
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
						<a href="log_out.php" class="btn btn-danger btn-sm"><b>Log out<i id="log_out_icon" class="fas fa-sign-out-alt fa-lg"></i></b></a>
					</div>
			  	</div>
			</nav>
			<ul class="nav nav-tabs" id="nav-tab" role="tablist">
				<?php 
					if (isset($_SESSION["user_type"])) {
						if ($_SESSION["user_type"] == "super_admin") {
							echo '<li class="nav-item" id="check-tab"><a class="nav-link active" id="nav-dash-tab" data-toggle="tab" href="#nav-dash" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-chart-line"></i><span class="verticle-line"></span>Dashboard</a></li>';
							echo '<li class="nav-item" id="check-tab"><a class="nav-link" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check</a></li>';
							echo '<li class="nav-item" id="add-tab"><a class="nav-link" id="nav-submit-tab" data-toggle="tab" href="#nav-submit" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-plus"></i><span class="verticle-line"></span>Add</a></li>';
							echo '<li class="nav-item" id="user-tab"><a class="nav-link" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-users"></i><span class="verticle-line"></span>Users</a></li>';
							echo '<li class="nav-item" id="location-tab"><a class="nav-link" id="nav-location-tab" data-toggle="tab" href="#nav-location" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-map-marker-alt"></i><span class="verticle-line"></span>Locations</a></li>';
							echo '<li class="nav-item" id="more-tab"><a class="nav-link" id="nav-more-tab" data-toggle="tab" href="#nav-more" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-trash"></i><span class="verticle-line"></span>More</a></li>';
						}elseif ($_SESSION["user_type"] == "admin") {
							echo '<li class="nav-item" id="check-tab"><a class="nav-link active" id="nav-dash-tab" data-toggle="tab" href="#nav-dash" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-chart-line"></i><span class="verticle-line"></span>Dashboard</a></li>';
							echo '<li class="nav-item" id="check-tab"><a class="nav-link" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check</a></li>';
							echo '<li class="nav-item" id="user-tab"><a class="nav-link" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-users"></i><span class="verticle-line"></span>Users</a></li>';
							echo '<li class="nav-item" id="location-tab"><a class="nav-link" id="nav-location-tab" data-toggle="tab" href="#nav-location" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-map-marker-alt"></i><span class="verticle-line"></span>Locations</a></li>';
							echo '<li class="nav-item" id="more-tab"><a class="nav-link" id="nav-more-tab" data-toggle="tab" href="#nav-more" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-trash"></i><span class="verticle-line"></span>More</a></li>';
						}elseif ($_SESSION["user_type"] == "manager") {
							echo '<li class="nav-item" id="check-tab"><a class="nav-link active" id="nav-dash-tab" data-toggle="tab" href="#nav-dash" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-chart-line"></i><span class="verticle-line"></span>Dashboard</a></li>';
							echo '<li class="nav-item" id="check-tab"><a class="nav-link" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check</a></li>';
							echo '<li class="nav-item" id="add-tab"><a class="nav-link" id="nav-submit-tab" data-toggle="tab" href="#nav-submit" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-plus"></i><span class="verticle-line"></span>Add</a></li>';
						}elseif ($_SESSION["user_type"] == "user") {
							echo '<li class="nav-item" id="check-tab"><a class="nav-link active" id="nav-dash-tab" data-toggle="tab" href="#nav-dash" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-chart-line"></i><span class="verticle-line"></span>Dashboard</a></li>';
							echo '<li class="nav-item" id="check-tab"><a class="nav-link" id="nav-check-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-search"></i><span class="verticle-line"></span>Check</a></li>';
						}
					}
				?>
			</ul>
			<div class="tab-content" id="nav-tabContent">

			<!-- Dashboard tab --->
				<div class="tab-pane fade show active " id="nav-dash" role="tabpanel" aria-labelledby="nav-dash-tab">
					<div class="tab-title">
			  			<h4>Dashboard</h4>
			  		</div>
		  			<div class="row">
		  				<div class="col-sm-12 col-md-6 col-lg-6 external_row">
		  					<div class="row main_dash_divs">
		  						<div class="col-sm-12 col-md-3 col-lg-3 main_dash_img_div">
		  							<img src="images/dollar.png">
		  						</div>
		  						<div class="col-sm-12 col-md-9 col-lg-9 main_dash_txt_div">
		  							<div class="main_dash_div_title">
		  								Total Inventory Value
		  							</div>
		  							<div class="main_dash_div_vals numbers">
	  								<?php
										$completeTotal = 0;
										$sql_dash1 = "SELECT SUM(quantity*price) AS total FROM added_inventory";
										$sql_dash1_results = mysqli_query($conn,$sql_dash1);
										while ($row = mysqli_fetch_array($sql_dash1_results)) {
											$completeTotal = $completeTotal + $row["total"];
										}
										echo "Rs. ".number_format((float)$completeTotal,2,'.','');
	  								?>
		  							</div>
		  						</div>
		  					</div>
		  				</div>
		  				<div class="col-sm-12 col-md-5 col-lg-5 external_row">
		  					<div class="row main_dash_divs">
		  						<div class="col-sm-12 col-md-4 col-lg-4 main_dash_img_div" id="warehouse">
		  							<img src="images/warehouse.png">
		  						</div>
		  						<div class="col-lg-8 col-sm-12 col-md-8 main_dash_txt_div">
		  							<div class="main_dash_div_title">
		  								Total Inventories
		  							</div>
		  							<div class="main_dash_div_vals numbers">
	  								<?php
										$totalItems = 0;
										$sql_dash2 = "SELECT SUM(quantity) AS total FROM added_inventory";
										$sql_dash2_results = mysqli_query($conn,$sql_dash2);
										while ($row = mysqli_fetch_array($sql_dash2_results)) {
											$totalItems = $totalItems + $row["total"];
										}
										echo $totalItems;
	  								?>
		  							</div>
		  						</div>
		  					</div>
		  				</div>
		  			</div>
		  			<hr>
		  			<div class="row">
		  				<div class="col-sm-12 col-md-4 col-lg-4 sub_dash_divs external1_row" id="loc_dash">
		  					<div class="sub_dash_div_img">
		  						<div class="div-curve1"><div class="div-curve2"></div></div>
		  						<img src="images/location.png">
		  					</div>
		  					<div class="sub_dash_div_txt">
	  							<div class="sub_dash_div_vals numbers">
  								<?php
  									$totalRows = 0;
									$sql_dash3 = "SELECT COUNT(*) AS total FROM sub_locations";
									$sql_dash3_results = mysqli_query($conn,$sql_dash3);
									while ($row = mysqli_fetch_array($sql_dash3_results)) {
										$totalRows = $totalRows + $row["total"];
									}
									echo $totalRows;
  								?>
	  							</div>
		  						<div class="sub_dash_div_title">
	  								Locations
	  							</div>
		  					</div>
		  				</div>
		  				<div class="col-sm-12 col-md-4 col-lg-4 sub_dash_divs external1_row" id="user_dash">
		  					<div class="sub_dash_div_img">
		  						<div class="div-curve1"><div class="div-curve2"></div></div>
		  						<img src="images/group.png">
		  					</div>
		  					<div class="sub_dash_div_txt">
	  							<div class="sub_dash_div_vals numbers">
  								<?php
									$totalRows = 0;
									$sql_dash4 = "SELECT COUNt(*) AS total FROM users";
									$sql_dash4_results = mysqli_query($conn,$sql_dash4);
									while ($row = mysqli_fetch_array($sql_dash4_results)) {
										$totalRows = $totalRows + $row["total"];
									}
									echo $totalRows;
  								?>
	  							</div>
		  						<div class="sub_dash_div_title">
	  								Authorized Users
	  							</div>
		  					</div>
		  				</div>
		  				<div class="col-sm-12 col-md-3 col-lg-3 sub_dash_divs external1_row" id="trash_dash">
		  					<div class="sub_dash_div_img">
		  						<div class="div-curve1"><div class="div-curve2"></div></div>
		  						<img src="images/trash.png">
		  					</div>
		  					<div class="sub_dash_div_txt">
	  							<div class="sub_dash_div_vals numbers">
  								<?php
									$totalRows = 0;
									$sql_dash5 = "SELECT COUNT(*) AS total FROM recovered_inventory";
									$sql_dash5_results = mysqli_query($conn,$sql_dash5);
									while ($row = mysqli_fetch_array($sql_dash5_results)) {
										$totalRows = $totalRows + $row["total"];
									}
									echo $totalRows;
  								?>
	  							</div>
		  						<div class="sub_dash_div_title">
	  								Deleted Logs
	  							</div>
		  					</div>
		  				</div>
		  			</div>
				</div>
			<!-- Check inventory tab -->
			  	<div class="tab-pane fade show " id="nav-check" role="tabpanel" aria-labelledby="nav-check-tab">
			  		<div class="tab-title">
			  			<h4>Check Inventories</h4>
			  		</div>
			  		
			  		<div class="check-condition-div">
			  			<div class="row">
			  				<div class="col-md-5">
			  					<label for="inputState">Search Method</label>
			  					<select class="form-control form-control-sm" name="search-type" id="search-type">
			  						<option value="val3" selected>Main Location wise</option>
			  						<option value="val1">Sub Location wise</option>
			  						<option value="val2">Inventory wise</option>
			  					</select>
			  				</div>
			  				<div class="col-md-1">
			  					<div class="verticle-line-check"></div>
			  				</div>
			  				<div class="col-md-6" id="form1-1-1-div">
			  					<form id="form1-1-1">
									<div class="row" class="check-condition-div">
									    <div class="form-group col-md-12">
									      	<label for="inputState">Main Location</label>
									      	<select class="form-control form-control-sm" name="main_locations" id="main_locations">
									        	<option value="" selected>Choose...</option>
									        	<?php

									    		$sql_main_locations = "SELECT * FROM main_locations";
									    		$main_loc_results = mysqli_query($conn,$sql_main_locations);

									    		while ($row = mysqli_fetch_array($main_loc_results)) {
									    			echo "<option value=".$row['location_code'].">".$row['location_name']."</option>";
									    		}

									    		?>
									      	</select>
									    </div>
									</div>
									<div class="button-div" id="check-button-div">
								    	<button type="submit" class="btn btn-success btn-sm form-button" id="check_button2"><i class="fas fa-search"></i>Check Inventory</button>
								    </div>
								</form>
							    <div class="col-md-6">
							    	<div id="check-alert-div"></div>
							    </div>
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
									      	<label for="inputState">Inventory Code</label>
									      	<input type="text" class="form-control form-control-sm" id="check_inventory_item" name="check_inventory_item" placeholder="FT/XX/XXXX/XXX/XXX">
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
					<div class="table-responsive-sm table-responsive-md" id="table-content"></div>
					<hr>
					<div id="print-button-div">
						<button class="btn btn-primary btn-sm" id="download-pdf-btn"><i class="fas fa-file-pdf fa-lg"></i><b>PDF</b></button>
						<button class="btn btn-success btn-sm" id="download-excel-btn" onclick="exportTableToExcel()"><i class="fas fa-file-excel fa-lg"></i><b>EXCEL</b></button>
					</div>

					<hr>

					<div class="row">
						<div class="col-md-8">
							<div class="form-group col-md-5" id="update-statement-div">
				    			<label class="custom_check">Update Inventory Status
								  <input type="checkbox" name="check" id="update_status_check_btn">
								  <span class="checkmark"></span>
								</label>
				    		</div>
  							<div class="col-md-12  check-condition-div-2">
  								<div id="status-update-alert-div"></div>
	  								<form id="form_status_update">
	  									<div class="row">
										<div class="form-group col-md-4">
											<label for="inputState">Inventory Code</label>
		  									<input type="text" class="form-control form-control-sm" id="update_status_code" name="update_status_code" placeholder="Enter inventory code here...">
										</div>
									    <div class="form-group col-md-8">
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
							    			echo "<option value=".$row['location_code'].">".$row['location_name']."</option>";
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
			  		<div class="tab-title">
			  			<h4>Manage Users Details</h4>
			  		</div>
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
			  		<hr>
				<!-- User details table -->
			  		<div id="user-details">
			  			<div class="form-group col-md-3 custom_btn">
  							<button class="btn" type="submit" id="show_user_button"><i class="fas fa-eye fa-lg"></i><b>Users</b></button>
			    		</div>
			  			<div class="col-md-10 table-responsive-sm table-responsive-md" id="users-tbl-show-div"></div>
			  		</div>
			  	</div>

			<!-- Location manage tab -->

			  	<div class="tab-pane fade" id="nav-location" role="tabpanel" aria-labelledby="nav-location-tab">
			  		<div class="tab-title">
			  			<h4>Manage Faculty Locations</h4>
			  		</div>
			  		<div class="check-condition-div">
			  			<div class="row">
			  				<div class="col-md-3">
			  					<label for="inputState">Select Location</label>
			  					<select class="form-control form-control-sm" name="location-type" id="location-type">
			  						<option value="main" selected>Main Location</option>
			  						<option value="sub">Sub Location</option>
			  					</select>
			  				</div>
			  				<div class="col-md-1">
			  					<div class="verticle-line-check"></div>
			  				</div>
			  				<div class="col-md-8" id="form-loc-div1">
			  					<form id="form-loc1">
									<div class="row" class="check-condition-div">
									    <div class="form-group col-md-4">
									      	<label for="inputState">Location Code</label>
									      	<input type="text" class="form-control form-control-sm" id="add_main_loc_code" name="add_main_loc_code" placeholder="Eg:- BT">
									    </div>
									    <div class="form-group col-md-8">
									      	<label for="inputState">Location Name</label>
									      	<input type="text" class="form-control form-control-sm" id="add_main_loc_name" name="add_main_loc_name" placeholder="Main location name here...">
									    </div>
									</div>
									<div class="button-div" id="check-button-div">
								    	<button type="submit" class="btn btn-success btn-sm form-button" id="add_loc_btn1"><i class="fas fa-plus"></i>Add Main Location</button>
								    </div>
								</form>
			  				</div>
			  				<div class="col-md-8" id="form-loc-div2">
			  					<form id="form-loc2">
									<div class="row" class="check-condition-div">
										<div class="form-group col-md-3">
									      	<label for="inputState">Main Location</label>
									      	<select class="form-control form-control-sm" name="main_loc_select" id="main_loc_select">
									        	<option value="" selected>Choose...</option>
									        	<?php

									    		$sql_main_locations = "SELECT * FROM main_locations";
									    		$main_loc_results = mysqli_query($conn,$sql_main_locations);

									    		while ($row = mysqli_fetch_array($main_loc_results)) {
									    			echo "<option value=".$row['location_code'].">".$row['location_name']."</option>";
									    		}

									    		?>
									      	</select>
									    </div>
									    <div class="form-group col-md-3">
									      	<label for="inputState">Location Code</label>
									      	<input type="text" class="form-control form-control-sm" id="add_sub_loc_code" name="add_sub_loc_code" placeholder="Eg:- NB01">
									    </div>
									    <div class="form-group col-md-6">
									      	<label for="inputState">Location Name</label>
									      	<input type="text" class="form-control form-control-sm" id="add_sub_loc_name" name="add_sub_loc_name" placeholder="Name of the sub location here...">
									    </div>
									</div>
									<div class="button-div" id="check-button-div">
								    	<button type="submit" class="btn btn-success btn-sm form-button" id="add_loc_btn2"><i class="fas fa-plus"></i>Add Sub Location</button>
								    </div>
								</form>
			  				</div>
			  			</div>
				  	</div>
				  	<div id="loc-alert-div"></div>
			  		<hr>
				<!-- Location details table -->
			  		<div id="location-details">
			  			<div class="row" id="loc-row">
			  				<div class="col-md-12">
			  					<div class="row">
			  						<div class="form-group col-sm-12 col-md-3 custom_btn">
			  							<button class="btn" type="submit" id="view_main_loc_btn"><i class="fas fa-eye fa-lg"></i><b>Main Locations</b></button>
						    		</div>
						    		<div class="form-group col-sm-12 col-md-3 custom_btn">
						    			<button class="btn" type="submit" id="view_sub_loc_btn"><i class="fas fa-eye fa-lg"></i><b>Sub Locations</b></button>
						    		</div>
				  				</div>
				  				<div class="row">
				  					<div class="col-sm-12 col-md-8 table-responsive-sm table-responsive-md">
			  							<div class="col-sm-12 col-md-12 main_loc_table_view"></div>
									</div>
									<div class="col-sm-12 col-md-10 table-responsive-sm table-responsive-md">
			  							<div class="col-sm-12 col-md-12 sub_loc_table_view"></div>
									</div>
				  				</div>
			  				</div>
						</div>
			  		</div>
			  	</div>

			  	<!-- More feature tab -->

			  	<div class="tab-pane fade" id="nav-more" role="tabpanel" aria-labelledby="nav-more-tab">
			  		<div class="tab-title">
			  			<h4>Analyze Deleted Inventories</h4>
			  		</div>
			  		<div class="row" id="loc-row">
	  					<div class="col-md-8" id="recover_inv_div">
	  						<div class="refresh_btn_div">
	  							<i>Below table shows all the deleted inventory logs</i>
	  							<button class="btn btn-info btn-sm" id="refresh_btn"><i class="fas fa-sync-alt fa-lg"></i><b>Refresh</b></button>
	  						</div>
  							<div class="re_invent_table_view table-responsive-sm table-responsive-md">
  								<table class="table table-bordered table-sm table-hover" id="re_invent_table">
  									<thead class="thead-dark">
										<tr>
											<th>Inventory Code</th>
											<th>Inventory Name</th>
											<th>Purchased Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody class="table-hover">
										<?php
		  								$sql_re_invent = "SELECT * FROM recovered_inventory";
		  								$sql_re_invent_results = mysqli_query($conn,$sql_re_invent);
										while ($row = mysqli_fetch_array($sql_re_invent_results)) {
										?>
										<tr id="row<?php echo $row['id']; ?>">
											<td><?php echo $row["inventory_code"]; ?></td>
											<td><?php echo $row["sub_inventory_type"]; ?></td>
											<td style="text-align: right;"><?php echo $row["purchased_date"]; ?></td>	
											<td class="center_items">
												<div id="recover_invent_btns">
													<button type="button" class="btn btn-success btn-sm" id="<?php echo $row['id']; ?>"><i class="fas fa-external-link-alt" data-toggle="modal" data-target="#re_invent_modal" onclick="showDetails(<?php echo $row['id']; ?>);"></i></button>
													<form>
														<button class="btn btn-danger btn-sm recovery_del_btn" id="<?php echo $row['id']; ?>"><i class="far fa-trash-alt"></i></button>
								                	</form>
												</div>
											</td>
										</tr>
										<?php		
										}
										?>
									</tbody>
  								</table>
  							</div>
						</div>
						<div class="modal fade" id="re_invent_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				          <div class="modal-dialog modal-dialog-centered" role="document">
				            <div class="modal-content" id="re_invent_modal_content"></div>
				          </div>
				        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
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
<div class="se-pre-con"></div>
</html>

<?php		
	}
}else{
	header("location: index.php");
}
?>