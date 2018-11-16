<?php
	require '../../lib/connection.php';
?>
<?php
if($_SESSION['update_flag'] == "item")
			{
				echo '<script>alert("Updated Successfully");</script>';
				$_SESSION['update_flag']="";
			}

elseif($_SESSION['update_flag'] == "wrongItem")
			{
				echo '<script>alert("Already Exists. Updataion Failed.");</script>';
				$_SESSION['update_flag']="";
			}	
elseif($_SESSION['update_flag'] == "approved")
			{
				echo '<script>alert("Approved Successfully");</script>';
				$_SESSION['update_flag']="";
			}
elseif($_SESSION['update_flag'] == "unapproved")
			{
				echo '<script>alert("Oops, Something Went Wrong.");</script>';
				$_SESSION['update_flag']="";
			}					
if(($_SESSION['update_flag'] != "" && $_SESSION['update_flag'] != "item") || ($_SESSION['update_flag'] != "" && $_SESSION['update_flag'] != "wrongItem")){
			header('location:'.$l_dds_logout.'');
}
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="js/delete_parts.js"></script>
	<title>SYNERGIC MACHINE VIEW</title>
	<link rel="icon" href="../../favicon.ico">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
	<script src="js/delete_stocks.js"></script>
</head>
<body>
	<div class="header">
		<?php require 'header.php';?>
	</div>
	<div class="nav_holder">
		<?php require 'service_nav.php';?>
	</div>
	<div class = "item_body_container">
	<div class="reports_body">
		<h1>MACHINE VIEW</h1>
		<form name="report_form" action="" method="POST">
		<table>
			<tr>
				<td>Machine Name</td>
				<td><?php 
					require 'fetch_machine.php';
						echo '<select name="item_code" class="input_select">';
						if (mysqli_num_rows($machine_result) > 0) {
							while($item_data = mysqli_fetch_assoc($machine_result)) {
								if ($item_data["approval_status"] == 1) {
									continue;
								}
								echo '<option value="'.$item_data["batch_no"].'">'.$item_data['batch_no'].' '.$item_data['mc_type'].'</option>';
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
	<div>
	<?php require 'machine_view.php'; ?>
	<form name="del_form" method="post" action="#">
                <input type="hidden" name="fid"/>
                <input type="hidden" name="mode" value="deleteparts"/>
    </form>
     <?php
        if(isset($_POST["mode"]) == "deleteparts")
		{
			$sqlupdate="DELETE FROM `td_new_machine` WHERE batch_no = '".$_POST["fid"]."'";
			$resultupdate = mysqli_query($conn,$sqlupdate);
			
			
			$URL = $l_dds_view_machine_stock;
			echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
		}			
    ?>
	</div>
	</div>
</body>
</html>