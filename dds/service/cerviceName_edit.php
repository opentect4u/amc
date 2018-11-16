<?php
require '../../lib/connection.php';
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $cname = $_POST['cname'];

    $sql = "SELECT * FROM mm_service_center WHERE center_name = '$cname'";
    $result = mysqli_query($conn, $sql);
    echo "<pre>";
    var_dump(mysqli_num_rows($result));
    if(mysqli_num_rows($result) > 0){
      $_SESSION['update_flag'] = 'wrongItem';
      header("Location: editServiceCenter.php");
    }else{
      $sql = "UPDATE mm_service_center SET center_name = '$cname' WHERE id = $id";
      mysqli_query($conn, $sql);
      $_SESSION['update_flag'] = 'updated';
      header("Location: editServiceCenter.php");
    }
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
  			<form action="" method="POST">
          <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
  				<table>
  					<tr>
  						<td>Center Name</td>
              <td><input type="text" class="input_text" name="cname" value="<?php echo $_GET['center_name'];?>" required>
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <input type="submit" class="submit" value="Update">
              </td>
            </tr>
          </table>
    </div>
  </body>
</html>
