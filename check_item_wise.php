<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function deleteNow(inventory_id){
		$.ajax({
			type : "POST",
			url : "inventory_del_modal.php",
			data : {inventory_id:inventory_id},
			success : function(result){
				$("#delete_modal_body").html(result);
			}
		});
	}
	function editNow(edit_item){
		$.ajax({
			type : "POST",
			url : "inventory_edit_modal.php",
			data : {edit_item:edit_item},
			success : function(item_result){
				$("#item_edit_modal_body").html(item_result);
        		$("#table-content").load();
			}
		});
	}
</script>

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

$inventory_wise = $_POST["check_inventory_wise"];

if ($inventory_wise == "") {
	echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fas fa-exclamation-triangle fa-lg"></i><b>Please enter inventory name!</b></div>';
}else{
	if ($inventory_wise == "$inventory_wise") {
		$sql1 = "SELECT * FROM added_inventory WHERE inventory_code='$inventory_wise'";
		$sql1_results = mysqli_query($conn,$sql1);

		?>
		<table class="table table-bordered table-sm" id="check-table">
			<thead class="thead-dark">
				<tr>
					<th>Location</th>
					<th>Item Name</th>
					<th>Serial No</th>
					<th>Main Category</th>
					<th>Quantity</th>
					<th>Price per item(Rs)</th>
					<th>Total Price(Rs)</th>
					<th>Purchased Date</th>
					<th>Status</th>
					<?php
						if (isset($_SESSION["user_type"])) {
							if ($_SESSION["user_type"] == "admin") {
					?>
					<th>Action</th>
					<?php
							}elseif($_SESSION["user_type"] == "manager") {
					?>
					<th>Edit</th>
					<?php
							}
						}
					?>
				</tr>
			</thead>
			<tbody class="table-hover">
		<?php
			while ($row = mysqli_fetch_array($sql1_results)) {
		?>
				<tr id="row<?php echo $row['id']; ?>">
					<td><?php echo $row["sub_location"]; ?></td>
					<td><?php echo $row["sub_inventory_type"]; ?></td>
					<td><?php echo $row["serial_number"]; ?></td>
					<td><?php echo $row["main_inventory_type"]; ?></td>
					<td><?php echo $row["quantity"]; ?></td>
					<td class="right-align-td numbers"><?php echo $row["price"]; ?></td>
					<td class="right-align-td numbers"><?php $totol = $row["quantity"]*$row["price"];
							echo number_format((float)$totol,2,'.',''); ?></td>
					<td class="right-align-td"><?php echo $row["purchased_date"] ?></td>
					<td><?php echo $row["status"]; ?></td>
					<?php 
						if (isset($_SESSION["user_type"])) {
							if ($_SESSION["user_type"] == "admin") {
					?>	
					<td class="del-btn">
						<form id="item_delete_form">
							<button type="button" class="btn btn-danger btn-sm item_del_btn" id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm_del_modal" onclick="deleteNow(<?php echo $row['id']; ?>)"><i class="far fa-trash-alt delete_icon"></i></button>
	                	</form>
					</td>
					<?php
							}elseif($_SESSION["user_type"] == "manager"){
					?>	
					<td class="edit-btn">
						<form id="item_edit_form">
							<button type="button" class="btn btn-info btn-sm item_edit_btn" id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#manager_edit_modal" onclick="editNow(<?php echo $row['id']; ?>)"><i class="fas fa-pen-alt edit_icon"></i></button>
	                	</form>
					</td>
					<?php
							}
						}
					?>
				</tr>
		<?php		
			}
		?>
			</tbody>
		</table>

		<div class="row" id="total-view-div" style="border:1px solid #ccced1; padding: 10px 15px; margin: auto 0px; border-radius: 10px; background-color: #f9fc5d;">
			<div class="col-md-12 numbers" id="full-total-value"><?php 
					$fullTotal = 0;
					$sql2 = "SELECT SUM(quantity*price) AS total FROM added_inventory WHERE inventory_code='$inventory_wise'";
					$sql2_results = mysqli_query($conn,$sql2);
					while ($row = mysqli_fetch_array($sql2_results)) {
						$fullTotal = $fullTotal + $row["total"];
					}
					echo "<b>Total inventory value &nbsp&nbsp=</b>&nbsp&nbsp Rs. ".number_format((float)$fullTotal,2,'.','');
				?>
			</div>
		</div>

		<div class="modal fade" id="confirm_del_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="delete_modal_body">

            </div>
          </div>
        </div>

        <div class="modal fade bd-example-modal-lg" id="manager_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" id="item_edit_modal_body">

            </div>
          </div>
        </div>
        
		<?php
	}
}

?>