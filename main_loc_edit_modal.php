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



$location_id = $_POST["location_id"];

$sql= "SELECT * FROM main_locations where id='$location_id'";
$result=mysqli_query($conn,$sql);

while ($row=$result->fetch_assoc()) {
?>

<script type="text/javascript">

  function mainSave(){
    var loc_id = <?php echo $location_id; ?>;
    var location_code = $("#location_code").val();
    var location_name = $("#location_name").val();
    $.ajax({
      type : "POST",
      url : "save_main_loc.php",
      data : {loc_id:loc_id,location_code:location_code,location_name:location_name},
      success : function(result1){
        $("#main_edit_modal_body").html(result1);
        $(".main_loc_table_view").load();
      }
    });
  }

</script>
<style>
  #edit_modal_body{
    padding: 10px 30px;
  }
  #main_edit_modal_body p{
      font-size: 14px;
      color: gray;
  }
</style>
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalCenterTitle"><i class="far fa-edit fa-lg"></i> Edit Main Location</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true"><i class="fas fa-times"></i></span>
  </button>
</div>
<div class="modal-body" id="edit_modal_body">
  <p><i>Edit main location : <b><?php echo $row["location_name"]; ?></b></i></p>
  <form>
    <div class="form-group">
      <label for="location_code" class="col-form-label">Location Code :</label>
      <input type="text" name="location_code" id="location_code" class="form-control form-control-sm" placeholder="New location code here...">
    </div>
    <div class="form-group">
      <label for="location_name" class="col-form-label">Location Name :</label>
      <input type="text" name="location_name" id="location_name" class="form-control form-control-sm" placeholder="New location name here...">
    </div>
  </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-success btn-sm" onclick="mainSave();"><b>Save Changes</b></button>
</div>

<?php
}
?>

