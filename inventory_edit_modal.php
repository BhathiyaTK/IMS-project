<?php
require_once 'db.php';

session_start();



$edit_item = $_POST["edit_item"];

$sql= "SELECT * FROM added_inventory where id='$edit_item'";
$result=mysqli_query($conn,$sql);

while ($row=$result->fetch_assoc()) {
?>

<script type="text/javascript">

  function itemSave(){
    var item_id = <?php echo $edit_item; ?>;
    var edit_item_main_loc = $("#edit_item_main_loc").val();
    var edit_item_sub_loc = $("#edit_item_sub_loc").val();
    var edit_main_inv_type = $("#edit_main_inv_type").val();
    var edit_sub_inv_type = $("#edit_sub_inv_type").val();
    var edit_item_inv_code = $("#edit_item_inv_code").val();
    var edit_item_serial_no = $("#edit_item_serial_no").val();
    var edit_item_price = $("#edit_item_price").val();
    var edit_item_purchased_date = $("#edit_item_purchased_date").val();

    $.ajax({
      type : "POST",
      url : "save_edit_item.php",
      data : {item_id:item_id,edit_item_main_loc:edit_item_main_loc,edit_item_sub_loc:edit_item_sub_loc,edit_main_inv_type:edit_main_inv_type,edit_sub_inv_type:edit_sub_inv_type,edit_item_inv_code:edit_item_inv_code,edit_item_serial_no:edit_item_serial_no,edit_item_price:edit_item_price,edit_item_purchased_date:edit_item_purchased_date},
      success : function(result1){
        $("#item_edit_modal_body").html(result1);
      }
    });
  }

</script>
<style>
  #edit_modal_body{
    padding: 10px 30px;
  }
  #edit_modal_body span{
    color: red;
  }
  #edit_modal_body .optional_txt{
    color: gray;
    font-style: italic;
    font-weight: normal;
    margin-left: 5px;
  }
  #item_edit_modal_body p{
      font-size: 14px;
      font-weight: bold;
      color: red;
  }
</style>
<?php
$sql_item = "SELECT * FROM added_inventory WHERE id='$edit_item'";
$sql_item_rslt = mysqli_query($conn,$sql_item);
$row1 = mysqli_fetch_array($sql_item_rslt);
?>
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-edit fa-lg"></i> Edit Inventory : <b><?php echo $row["inventory_code"]; ?></b></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true"><i class="fas fa-times"></i></span>
  </button>
</div>
<div class="modal-body" id="edit_modal_body">
  <form>
    <div class="row">
      <div class="form-group col-md-6">
        <label for="inputCity">Main Location<span class="optional_txt">(Optional)</span></label>
        <select id="edit_item_main_loc" class="form-control form-control-sm" name="edit_item_main_loc">
          <option value="" selected>Choose...</option>
        <?php
          $sql_main_inventory = "SELECT * FROM main_locations";
          $main_inv_results = mysqli_query($conn,$sql_main_inventory);

          $sql_main_val = $row["location_code"];

          while ($row = mysqli_fetch_array($main_inv_results)) {
            echo "<option value=".$row['location_code'].">".$row['location_name']."</option>";
          }
        ?>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="inputState">Sub Location<span class="optional_txt">(Optional)</span></label>
        <select id="edit_item_sub_loc" class="form-control form-control-sm" name="edit_item_sub_loc">
          <option value="" selected>Choose...</option>
        <?php
          $sql_sub_inventory = "SELECT * FROM sub_locations";
          $main_inv_results = mysqli_query($conn,$sql_sub_inventory);

          while ($row = mysqli_fetch_array($main_inv_results)) {
            echo "<option value=".$row['location_code'].">(".$row["location_code"].") ".$row['location_name']."</option>";
          }
        ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-4">
        <label for="inputZip">Main Inventory Category</label>
        <input type="text" class="form-control form-control-sm" id="edit_main_inv_type" name="edit_item_inv_type" value="<?php echo $row1['main_inventory_type']; ?>">
      </div>
      <div class="form-group col-md-4">
        <label for="inputCity">Sub Inventory Type</label>
        <input type="text" class="form-control form-control-sm" id="edit_sub_inv_type" name="edit_sub_inv_type" value="<?php echo $row1['sub_inventory_type']; ?>">
      </div>
      <div class="form-group col-md-4">
        <label for="inputState">Inventory Code</label>
        <input type="text" class="form-control form-control-sm" id="edit_item_inv_code" name="edit_item_inv_code" value="<?php echo $row1['inventory_code']; ?>">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-4">
        <label for="inputCity">Price [Rs]</label>
        <input type="text" class="form-control form-control-sm" id="edit_item_price" name="edit_item_price" value="<?php echo $row1['price']; ?>">
      </div>
      <div class="form-group col-md-3">
        <label for="inputState">Purchased Date</label>
        <input type="text" class="form-control form-control-sm" id="edit_item_purchased_date" name="edit_item_purchased_date" value="<?php echo $row1['purchased_date']; ?>">
      </div>
      <div class="form-group col-md-5">
        <label for="inputCity">Serial No.</label>
        <input type="text" class="form-control form-control-sm" id="edit_item_serial_no" name="edit_item_serial_no" value="<?php echo $row1['serial_number']; ?>">
      </div>
    </div>
  </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-success btn-sm" onclick="itemSave();"><b>Save Changes</b></button>
</div>

<?php
}
?>

