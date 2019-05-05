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



$inventory_id = $_POST["inventory_id"];

$sql= "SELECT * FROM added_inventory where id='$inventory_id'";
$result=mysqli_query($conn,$sql);

while ($row=$result->fetch_assoc()) {
?>

<script type="text/javascript">

  function deleteConfirm(){
    var item_id = <?php echo $inventory_id; ?>;
    var reason_text = $("#reason_text").val();
    $.ajax({
      type : "POST",
      url : "delete_item.php",
      data : {item_id:item_id,reason_text:reason_text},
      success : function(result1){
        $("#delete_modal_body").html(result1);
        $("#row"+item_id).remove();
        $("#table-content").load();
      }
    });
  }

</script>
<style>
    #delete_modal_body p{
        font-size: 14px;
        color: gray;
    }
</style>
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-question-circle fa-lg"></i> Permission for Delete</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true"><i class="fas fa-times"></i></span>
  </button>
</div>
<div class="modal-body" id="delete_modal_body">
  <p><i>Give a valid reason for delete inventory : <b><?php echo $row["inventory_code"]; ?></b></i></p>
  <form>
    <div class="form-group">
      <label for="message-text" class="col-form-label">Reason:</label>
      <textarea class="form-control" id="reason_text" name="reason_text" placeholder="Enter reason(s) here..."></textarea>
    </div>
  </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm();"><b>Confirm Deletion</b></button>
</div>

<?php
} 
?>

