<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function() {
        $(".user_del_btn").click(function() {
            var user_id = $(this).attr("id");
            var info = 'id=' + user_id;
            if (confirm("Sure you want to delete this user? This cannot be undone later.")) {
                $.ajax({
                    type : "POST",
                    url : "delete_user.php",
                    data : info,
                    success : function() {
                    	$("#row"+user_id).remove();
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

$show_user_tbl = $_POST["show_tbl_val"];

if ($show_user_tbl == "$show_user_tbl") {
	$sql_users = "SELECT * FROM users";
	$sql_user_rslt = mysqli_query($conn,$sql_users);
?>
	<table class="table table-bordered table-sm table-hover" id="user_table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Title</th>
				<th scope="col">Name</th>
				<th scope="col">E-mail</th>
				<th scope="col">User Role</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody class="">
		<?php
			while ($row = mysqli_fetch_array($sql_user_rslt)) {
		?>
			<tr id="row<?php echo $row['id']; ?>">
				<td><?php echo $row["title"]; ?></td>
				<td><?php echo $row["first_name"]." ".$row["second_name"] ?></td>
				<td><?php echo $row["email"] ?></td>
				<td><?php echo $row["user_type"] ?></td>
				<?php
				if (isset($_SESSION["username"])) {
					if ($_SESSION["username"] !== $row["username"]) {
				?>
				<td>
					<form id="user_delete_form">
						<button class="btn btn-danger btn-sm user_del_btn" id="<?php echo $row['id']; ?>"><i class="fas fa-user-times"></i></button>
                	</form>
				</td>
				<?php
					}else{
				?>
				<td>
					<button class="btn btn-danger btn-sm user_del_disable_btn disabled" id="<?php echo $row['id']; ?>"><i class="fas fa-user-times"></i></button>
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
<?php
}
?>