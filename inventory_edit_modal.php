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
    var edit_item_quantity = $("#edit_item_quantity").val();
    var edit_item_price = $("#edit_item_price").val();
    var edit_item_purchased_date = $("#edit_item_purchased_date").val();

    $.ajax({
      type : "POST",
      url : "save_edit_item.php",
      data : {item_id:item_id,edit_item_main_loc:edit_item_main_loc,edit_item_sub_loc:edit_item_sub_loc,edit_main_inv_type:edit_main_inv_type,edit_sub_inv_type:edit_sub_inv_type,edit_item_inv_code:edit_item_inv_code,edit_item_serial_no:edit_item_serial_no,edit_item_quantity:edit_item_quantity,edit_item_price:edit_item_price,edit_item_purchased_date:edit_item_purchased_date},
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
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-edit fa-lg"></i> Edit Inventory : <b><?php echo $row["inventory_code"]; ?></b></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true"><i class="fas fa-times"></i></span>
  </button>
</div>
<div class="modal-body" id="edit_modal_body">
  <p>* Required fields</p>
  <form>
    <div class="row">
      <div class="form-group col-md-6">
        <label for="inputCity">Main Location<span><b>*</b></span></label>
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
        <label for="inputState">Sub Location<span><b>*</b></span></label>
        <select id="edit_item_sub_loc" class="form-control form-control-sm" name="edit_item_sub_loc">
          <option selected>Choose...</option>
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
        <label for="inputZip">Main Inventory Category<span><b>*</b></span></label>
        <input type="text" class="form-control form-control-sm" id="edit_main_inv_type" name="edit_item_inv_type" placeholder="Inventory category name here...">
      </div>
      <div class="form-group col-md-4">
        <label for="inputCity">Sub Inventory Type<span><b>*</b></span></label>
        <input type="text" class="form-control form-control-sm" id="edit_sub_inv_type" name="edit_sub_inv_type" placeholder="Sub inventory name here...">
      </div>
      <div class="form-group col-md-4">
        <label for="inputState">Inventory Code<span><b>*</b></span></label>
        <input type="text" class="form-control form-control-sm" id="edit_item_inv_code" name="edit_item_inv_code" placeholder="FT/XX/XXXX/XXX/XXX">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-4">
        <label for="inputZip">Quantity<span><b>*</b></span></label>
        <input type="text" class="form-control form-control-sm" id="edit_item_quantity" name="edit_item_quantity" placeholder="Quantity here...">
      </div>
      <div class="form-group col-md-4">
        <label for="inputCity">Price [Rs]<span><b>*</b></span></label>
        <input type="text" class="form-control form-control-sm" id="edit_item_price" name="edit_item_price" placeholder="Price per item (eg:- XXXXX.XX)">
      </div>
      <div class="form-group col-md-4">
        <label for="inputState">Purchased Date<span><b>*</b></span></label>
        <input type="text" class="form-control form-control-sm" id="edit_item_purchased_date" name="edit_item_purchased_date" placeholder="DD/MM/YYYY">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-5">
        <label for="inputCity">Serial No.<span class="optional_txt">(Optional)</span></label>
        <input type="text" class="form-control form-control-sm" id="edit_item_serial_no" name="edit_item_serial_no" placeholder="Inventory serial number here...">
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

