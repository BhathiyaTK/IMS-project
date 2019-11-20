<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function editSubLocation(location_id){
		$.ajax({
			type : "POST",
			url : "sub_loc_edit_modal.php",
			data : {location_id:location_id},
			success : function(result){
				$("#sub_edit_modal_body").html(result);
			}
		});
	}
	$(function() {
        $(".delete_s_loc_btn").click(function() {
            var item_id = $(this).attr("id");
            var info1 = 'id=' + item_id;
            if (confirm("Sure? This cannot be undone later.")) {
                $.ajax({
                    type : "POST",
                    url : "delete_sub_loc.php",
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

require_once 'db.php';

session_start();

$show_sub_loc_tbl = $_POST["show_sub_loc_tbl"];

$sql_sub = "SELECT * FROM sub_locations";
$sql_sub_results = mysqli_query($conn,$sql_sub);

?>

<table class="table table-bordered table-sm table-hover" id="sub_loc_table">
	<thead class="thead-dark">
		<tr>
			<th>Main Location Code</th>
			<th>Sub Location Code</th>
			<th>Sub Location Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody class="table-hover">

<?php

while ($row = mysqli_fetch_array($sql_sub_results)) {

?>
		<tr id="row<?php echo $row['id']; ?>">
			<td class="center_items"><?php echo $row["main_location_code"]; ?></td>
			<td class="center_items"><?php echo $row["location_code"]; ?></td>
			<td><?php echo $row["location_name"]; ?></td>	
			<td class="center_items">
				<div id="sub_loc_action_td">
	            	<form id="sub_loc_edit_form">
						<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#sub_edit_modal" id="<?php echo $row['id']; ?>" onclick="editSubLocation(<?php echo $row['id']; ?>);"><i class="fas fa-marker"></i></button>
	            	</form>
					<form id="sub_loc_delete_form">
						<button class="btn btn-danger btn-sm delete_s_loc_btn" id="<?php echo $row['id']; ?>"><i class="far fa-trash-alt"></i></button>
	            	</form>
				</div>
			</td>
		</tr>
<?php		
}
?>
	</tbody>
</table>

<div class="modal fade" id="sub_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" id="sub_edit_modal_body">

    </div>
  </div>
</div>