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

$refresh_tbl_val = $_POST["refresh_tbl_val"];

if ($refresh_tbl_val == "$refresh_tbl_val") {
	$sql_re_invent = "SELECT * FROM recovered_inventory";
	$sql_re_invent_results = mysqli_query($conn,$sql_re_invent);
?>
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
						<button class="btn btn-danger btn-sm" id="<?php echo $row['id']; ?>"><i class="far fa-trash-alt"></i></button>
                	</form>
				</div>
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