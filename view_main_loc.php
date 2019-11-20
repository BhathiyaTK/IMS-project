<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function editMainLocation(location_id){
		$.ajax({
			type : "POST",
			url : "main_loc_edit_modal.php",
			data : {location_id:location_id},
			success : function(result){
				$("#main_edit_modal_body").html(result);
			}
		});
	}
	$(function() {
        $(".delete_loc_btn").click(function() {
            var item_id = $(this).attr("id");
            var info1 = 'id=' + item_id;
            if (confirm("Sure? This cannot be undone later.")) {
                $.ajax({
                    type : "POST",
                    url : "delete_main_loc.php",
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

$show_main_loc_tbl = $_POST["show_main_loc_tbl"];

$sql_main = "SELECT * FROM main_locations";
$sql_main_results = mysqli_query($conn,$sql_main);

?>

<table class="table table-bordered table-sm table-hover" id="main_loc_table">
	<thead class="thead-dark">
		<tr>
			<th>Location Code</th>
			<th>Location Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody class="table-hover">
<?php

while ($row = mysqli_fetch_array($sql_main_results)) {

?>
<tr id="row<?php echo $row['id']; ?>">
	<td class="center_items"><?php echo $row["location_code"]; ?></td>
	<td><?php echo $row["location_name"]; ?></td>	
	<td class="center_items">
		<div id="main_loc_action_td">
        	<form id="main_loc_edit_form">
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#main_edit_modal" id="<?php echo $row['id']; ?>" onclick="editMainLocation(<?php echo $row['id']; ?>);"><i class="fas fa-marker"></i></button>
        	</form>
			<form id="main_loc_delete_form">
				<button class="btn btn-danger btn-sm delete_loc_btn" id="<?php echo $row['id']; ?>"><i class="far fa-trash-alt"></i></button>
        	</form>
		</div>
	</td>
</tr>
<?php	
}		
?>
	</tbody>
</table>

<div class="modal fade" id="main_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" id="main_edit_modal_body">

    </div>
  </div>
</div>