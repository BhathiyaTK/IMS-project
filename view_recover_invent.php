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



$re_invent_id = $_POST["re_invent_id"];

$sql= "SELECT * FROM recovered_inventory where id='$re_invent_id'";
$result=mysqli_query($conn,$sql);

while ($row=$result->fetch_assoc()) {
?>

<script type="text/javascript">

  function restore(){
    var item_id1 = <?php echo $re_invent_id; ?>;
    $.ajax({
      type : "POST",
      url : "recover_item.php",
      data : {item_id1:item_id1},
      success : function(result2){
        $("#re_invent_modal_content").html(result2);
        $("#row"+item_id1).remove();
      }
    });
  }

</script>

<style>
  #re_invent_modal_body{
    padding: 20px 50px;
    font-family: Roboto;
    font-weight: 300;
  }
  #re_invent_modal_body span{
    font-weight: 400;
  }
</style>

<div class="modal-header">
  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-info-circle fa-lg"></i> Removed Inventory Details</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true"><i class="fas fa-times"></i></span>
  </button>
</div>
<div class="modal-body" id="re_invent_modal_body">
  <ul>
    <li>Main Location : <span><?php echo $row["main_location"] ?></span></li>
    <li>Sub Location : <span><?php echo $row["sub_location"] ?></span></li>
    <li>Inventory Category : <span><?php echo $row["main_inventory_type"] ?></span></li>
    <li>Inventory Name : <span><?php echo $row["sub_inventory_type"] ?></span></li>
    <li>Inventory Code : <span><?php echo $row["inventory_code"] ?></span></li>
    <li>Serial Number : <span><?php echo $row["serial_number"] ?></span></li>
    <li>Quantity : <span><?php echo $row["quantity"] ?></span></li>
    <li>Price per Item : <span><?php echo "Rs. ".$row["price"] ?></span></li>
    <li>Purchased Date : <span><?php echo $row["purchased_date"] ?></span></li>
    <li>Reason for Remove : <span><?php echo $row["reason"] ?></span></li>
  </ul>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-success btn-sm" onclick="restore();"><b>Restore Item</b></button>
</div>

<?php
} 
?>

