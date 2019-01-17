<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function() {
        $(".item_del_btn").click(function() {
            var item_id = $(this).attr("id");
            var info1 = 'id=' + item_id;
            if (confirm("Sure? This cannot be undone later.")) {
                $.ajax({
                    type : "POST",
                    url : "delete_item.php",
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

$check_sub_loc = $_POST["check_sub_location"];

if ($check_sub_loc == "$check_sub_loc") {
	$sql1 = "SELECT * FROM added_inventory WHERE sub_location='$check_sub_loc'";
	$sql1_results = mysqli_query($conn,$sql1);

	?>
	<table class="table table-bordered table-sm" id="check-table">
		<thead class="thead-dark">
			<tr>
				<th>Item Code</th>
				<th>Serial No</th>
				<th>Item Name</th>
				<th>Main Category</th>
				<th>Quantity</th>
				<th>Price per item</th>
				<th>Total Price</th>
				<th>Purchased Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody class="table-hover">
	<?php
		while ($row = mysqli_fetch_array($sql1_results)) {
	?>
			<tr id="row<?php echo $row['id']; ?>">
				<td><?php echo $row["inventory_code"]; ?></td>
				<td><?php echo $row["serial_number"]; ?></td>
				<td><?php echo $row["sub_inventory_type"]; ?></td>
				<td><?php echo $row["main_inventory_type"]; ?></td>
				<td><?php echo $row["quantity"]; ?></td>
				<td><?php echo "Rs. ".$row["price"]; ?></td>
				<td>
					<?php 
						$totol = $row["quantity"]*$row["price"];
						echo "Rs. ".number_format((float)$totol,2,'.','');
					?>
				</td>
				<td><?php echo $row["purchased_date"] ?></td>
				<td id="del-btn">
					<form id="item_delete_form">
						<button class="btn btn-danger btn-sm item_del_btn" id="<?php echo $row['id']; ?>"><i class="far fa-trash-alt"></i></button>
                	</form>
				</td>
			</tr>
	<?php		
		}
	?>
		</tbody>
	</table>
	<?php
}
?>