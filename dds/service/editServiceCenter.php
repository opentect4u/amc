<?php
require '../../lib/connection.php';

if($_SESSION['insert_flag'] == "inserted") {
	echo '<script>alert("Successfully Inserted");</script>';
	$_SESSION['insert_flag']="";
}
elseif($_SESSION['update_flag'] == "updated") {
	echo '<script>alert("Successfully Updated");</script>';
	$_SESSION['update_flag']="";
}
elseif($_SESSION['update_flag'] == "wrongItem") {
	echo '<script>alert("Already Exists. Updataion Failed.");</script>';
	$_SESSION['update_flag']="";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SYNERGIC EDIT SERVICE CENTER</title>
	<link rel="icon" href="../../favicon.ico">
  <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div class="header">
		<?php require 'header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'service_nav.php';?>
	</div>
	<div class= "item_body_container">
		<div class="reports_body">
      <h1>Service Center Name</h1>
			<form name="report_form" action="" method="POST">
				<table>
					<tr>
						<td>Center Name</td>
						<td><?php
							require 'fetch_service_center.php';

								echo '<select name="id" class="input_select" >';
								if (mysqli_num_rows($result) > 0) {
									while($item_data = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $item_data['id'];?>"><?php echo $item_data['center_name'];?></option>
            <?php
									}
                }
							echo '</select>';
						?>
						</td>

						<td><input type="submit" name="submit" class ="submit" value="SEARCH"></td>
					</tr>
				</table>
			</form>
    </div>
      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $id = $_POST['id'];
          $sql = "SELECT * FROM mm_service_center WHERE id = $id";
          $result = mysqli_query($conn, $sql);
          while($item_data = mysqli_fetch_assoc($result)) {
            $id = $item_data['id'];
            $cName = $item_data['center_name'];
          }
      ?>
          <div class="report_result">
            <table>
              <tr>
                <th>Id</th>
                <th>Center Name</th>
                <th>Option</th>
              </tr>
              <tr>
                <td><?php echo $id;?></td>
                <td><?php echo $cName;?></td>
                <td><a href="cerviceName_edit.php?id=<?php echo $id;?>&center_name=<?php echo $cName;?>" class = "edit_delete">EDIT</a></td>
              </tr>
          </div>
        <?php
          }
        ?>

	</div>
</body>
